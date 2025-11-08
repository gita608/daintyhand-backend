<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use ApiResponse;

    public function store(StoreOrderRequest $request)
    {
        $user = $request->user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return $this->errorResponse('Cart is empty', null, 400);
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $tax = $subtotal * 0.18; // 18% GST
        $shipping = 1400.00; // Fixed shipping
        $total = $subtotal + $tax + $shipping;

        $orderNumber = 'ORD-' . date('Y') . '-' . str_pad(Order::whereYear('created_at', date('Y'))->count() + 1, 6, '0', STR_PAD_LEFT);

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => $orderNumber,
            'total' => $total,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => $request->payment_method,
            'shipping_name' => $request->shipping_name,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_state' => $request->shipping_state,
            'shipping_pincode' => $request->shipping_pincode,
            'shipping_phone' => $request->shipping_phone,
            'notes' => $request->notes,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'title' => $cartItem->product->title,
                'price' => $cartItem->product->price,
                'quantity' => $cartItem->quantity,
                'image' => $cartItem->product->image,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', $user->id)->delete();

        return $this->successResponse([
            'id' => $order->id,
            'order_number' => $order->order_number,
            'total' => (string) $order->total,
            'status' => $order->status,
            'payment_status' => $order->payment_status,
            'created_at' => $order->created_at,
        ], 'Order placed successfully', 201);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $query = Order::with('items')->where('user_id', $user->id);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $perPage = $request->get('per_page', 10);
        $orders = $query->orderBy('created_at', 'desc')->paginate($perPage);

        $orders->getCollection()->transform(function ($order) {
            return $this->formatOrder($order);
        });

        return $this->successResponse($orders);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $order = Order::with('items')->where('user_id', $user->id)->find($id);

        if (!$order) {
            return $this->errorResponse('Order not found', null, 404);
        }

        return $this->successResponse($this->formatOrder($order, true));
    }

    private function formatOrder($order, $detailed = false)
    {
        $items = $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'title' => $item->title,
                'price' => (string) $item->price,
                'quantity' => $item->quantity,
                'image' => $item->image,
            ];
        });

        $data = [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'total' => (string) $order->total,
            'status' => $order->status,
            'payment_status' => $order->payment_status,
            'items' => $items,
            'shipping_address' => [
                'name' => $order->shipping_name,
                'address' => $order->shipping_address,
                'city' => $order->shipping_city,
                'state' => $order->shipping_state,
                'pincode' => $order->shipping_pincode,
                'phone' => $order->shipping_phone,
            ],
            'created_at' => $order->created_at,
        ];

        if ($detailed) {
            $data['subtotal'] = (string) $order->subtotal;
            $data['tax'] = (string) $order->tax;
            $data['shipping'] = (string) $order->shipping;
            $data['payment_method'] = $order->payment_method;
            $data['notes'] = $order->notes;
            $data['updated_at'] = $order->updated_at;
        }

        return $data;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        $query = CartItem::with('product');

        if ($user) {
            $query->where('user_id', $user->id);
        } elseif ($sessionId) {
            $query->where('session_id', $sessionId);
        } else {
            return $this->successResponse([]);
        }

        $cartItems = $query->get();

        $formattedItems = $cartItems->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'product_id' => $item->product_id,
                'title' => $item->product->title,
                'price' => (string) $item->product->price,
                'image' => $item->product->image,
                'description' => $item->product->description,
                'quantity' => $item->quantity,
            ];
        });

        return $this->successResponse($formattedItems);
    }

    public function store(StoreCartItemRequest $request)
    {
        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        if (!$user && !$sessionId) {
            return $this->errorResponse('Session ID required for guest users', null, 400);
        }

        $product = Product::findOrFail($request->product_id);

        $cartItem = CartItem::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'user_id' => $user?->id,
                'session_id' => $user ? null : $sessionId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return $this->successResponse([
            'id' => (string) $cartItem->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
        ], 'Item added to cart', 201);
    }

    public function update(UpdateCartItemRequest $request, $id)
    {
        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        $cartItem = CartItem::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->find($id);

        if (!$cartItem) {
            return $this->errorResponse('Cart item not found', null, 404);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return $this->successResponse([
            'id' => (string) $cartItem->id,
            'quantity' => $cartItem->quantity,
        ], 'Cart updated');
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        $cartItem = CartItem::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->find($id);

        if (!$cartItem) {
            return $this->errorResponse('Cart item not found', null, 404);
        }

        $cartItem->delete();

        return $this->successResponse(null, 'Item removed from cart');
    }
}

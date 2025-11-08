<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishlistItem;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        $query = WishlistItem::with('product');

        if ($user) {
            $query->where('user_id', $user->id);
        } elseif ($sessionId) {
            $query->where('session_id', $sessionId);
        } else {
            return $this->successResponse([]);
        }

        $wishlistItems = $query->get();

        $formattedItems = $wishlistItems->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'product_id' => $item->product_id,
                'title' => $item->product->title,
                'price' => (string) $item->product->price,
                'image' => $item->product->image,
                'description' => $item->product->description,
            ];
        });

        return $this->successResponse($formattedItems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        if (!$user && !$sessionId) {
            return $this->errorResponse('Session ID required for guest users', null, 400);
        }

        $existingItem = WishlistItem::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $request->product_id)->first();

        if ($existingItem) {
            return $this->errorResponse('Item already in wishlist', null, 400);
        }

        $wishlistItem = WishlistItem::create([
            'user_id' => $user?->id,
            'session_id' => $user ? null : $sessionId,
            'product_id' => $request->product_id,
        ]);

        return $this->successResponse([
            'id' => (string) $wishlistItem->id,
            'product_id' => $wishlistItem->product_id,
        ], 'Item added to wishlist', 201);
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        $sessionId = $request->header('X-Session-ID');

        $wishlistItem = WishlistItem::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->find($id);

        if (!$wishlistItem) {
            return $this->errorResponse('Wishlist item not found', null, 404);
        }

        $wishlistItem->delete();

        return $this->successResponse(null, 'Item removed from wishlist');
    }
}

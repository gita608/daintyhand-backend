<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\WishlistItem;
use App\Models\User;

class CartMergeService
{
    public function mergeGuestCartToUser(User $user, ?string $sessionId): bool
    {
        if (!$sessionId) {
            return false;
        }

        $merged = false;

        // Merge cart items
        $guestCartItems = CartItem::where('session_id', $sessionId)->get();
        
        foreach ($guestCartItems as $guestItem) {
            $existingItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existingItem) {
                // Merge quantities
                $existingItem->quantity += $guestItem->quantity;
                $existingItem->save();
                $guestItem->delete();
            } else {
                // Transfer to user
                $guestItem->user_id = $user->id;
                $guestItem->session_id = null;
                $guestItem->save();
            }
            $merged = true;
        }

        // Merge wishlist items
        $guestWishlistItems = WishlistItem::where('session_id', $sessionId)->get();
        
        foreach ($guestWishlistItems as $guestItem) {
            $existingItem = WishlistItem::where('user_id', $user->id)
                ->where('product_id', $guestItem->product_id)
                ->first();

            if (!$existingItem) {
                // Transfer to user
                $guestItem->user_id = $user->id;
                $guestItem->session_id = null;
                $guestItem->save();
                $merged = true;
            } else {
                // Already exists, just delete guest item
                $guestItem->delete();
            }
        }

        return $merged;
    }
}


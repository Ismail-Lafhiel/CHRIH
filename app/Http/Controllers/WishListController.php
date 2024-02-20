<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();

        $wishlist = WishList::where('user_id', $user_id)->with('products')->first();

        $wishlistItems = $wishlist ? $wishlist->products : collect();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function addToWishlist($id)
    {
        $user_id = auth()->id();

        // Find the wishlist for the authenticated user
        $wishlist = WishList::where('user_id', $user_id)->first();

        if (!$wishlist) {
            // If the wishlist doesn't exist, you may need to create one
            $wishlist = WishList::create(['user_id' => $user_id]);
        }

        // Check if the product is already in the wishlist
        $product = Product::find($id);

        // Attach the product to the wishlist
        if ($product) {
            if ($wishlist->products()->where('product_id', $id)->exists()) {
                return response()->json(['error' => 'Product is already in your wishlist'], 422);
            }
            $wishlist->products()->attach($id);

            return response()->json(['success' => 'Product added to your wishlist successfully']);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function removeFromWishlist($id)
    {
        $user_id = auth()->id();

        $wishlist = WishList::where('user_id', $user_id)->first();

        if (!$wishlist) {
            return response()->json(['error' => 'Wishlist not found'], 404);
        }

        $product = Product::find($id);

        if ($product) {
            $wishlist->products()->detach($id);

            return response()->json(['success' => 'Product removed from your wishlist successfully']);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}

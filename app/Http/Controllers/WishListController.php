<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function addToWishlist(Request $request, Product $product)
    {
        $user_id = auth()->id();
        $wishlist = WishList::updateOrCreate(
            ['product_id' => $product->id],
            ['user_id' => $user_id]
        );
    
        return response()->json(['success' => 'Product added to wishlist successfully']);
    }
}

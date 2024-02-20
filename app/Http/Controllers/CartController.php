<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $user_id = auth()->id();
        $cart = Cart::updateOrCreate(
            ['product_id' => $product->id],
            ['user_id' => $user_id]
        );
    
        return response()->json(['success' => 'Product added to your cart successfully']);
    }
}

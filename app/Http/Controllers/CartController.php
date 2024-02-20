<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $user_id = auth()->id();

        $cart = Cart::where('user_id', $user_id)->with('products')->first();

        if (!$cart || $cart->products->isEmpty()) {
            return view('cart.index', ['cartItems' => []]);
        }
        $cartItems = $cart->products;
        return view('cart.index', compact('cartItems'));
    }
    public function addToCart($id)
    {
        $user_id = auth()->id();

        // Find the cart for the authenticated user
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            // If the cart doesn't exist, you may need to create one
            $cart = Cart::create(['user_id' => $user_id]);
        }
        // Check if the product is already in the cart
        $product = Product::find($id);
        // Attach the product to the cart
        if ($product) {
            if ($cart->products()->where('product_id', $id)->exists()) {
                return response()->json(['error' => 'Product is already in your cart'], 422);
            }
            $cart->products()->attach($id);
            return response()->json(['success' => 'Product added to your cart successfully']);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function removeFromCart($id)
    {
        $user_id = auth()->id();

        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $product = Product::find($id);
        if ($product) {
            $cart->products()->detach($id);

            return response()->json(['success' => 'Product removed from your cart successfully']);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}

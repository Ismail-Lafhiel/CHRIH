<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $user_id = auth()->id();

        $cart = Cart::where('user_id', $user_id)->with('products')->first();

        if (!$cart || !is_a($cart->products, 'Illuminate\Database\Eloquent\Collection') || $cart->products->isEmpty()) {
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
        // Find the product
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        // Check if the product is already in the cart
        $existingCartItem = $cart->products()->find($product->id);

        if ($cart->products()->where('product_id', $id)->exists()) {
            return response()->json(['error' => 'Product is already in your cart'], 422);
        }
        if ($existingCartItem) {
            // If the product is already in the cart, increment the quantity
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $existingCartItem->pivot->quantity + 1]);
        } else {
            // If the product is not in the cart, attach it with quantity 1
            $cart->products()->attach($product->id, ['quantity' => 1]);
        }
        return response()->json(['success' => 'Product added to your cart successfully']);
    }

    public function incrementQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $user = auth()->user();

        // Check if the user has a cart
        if (!$user || !$user->cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Find the product in the cart
        $cartItem = $user->cart->products()->find($productId);

        if ($cartItem) {
            // Product already exists in the cart, increment quantity
            $user->cart->products()->updateExistingPivot($productId, ['quantity' => $cartItem->pivot->quantity + 1]);
        } else {
            // Product doesn't exist in the cart, add it
            $user->cart->products()->attach($productId, ['quantity' => 1]);
        }

        return response()->json(['newQuantity' => $user->cart->products()->find($productId)->pivot->quantity, 'total' => $this->calculateTotal($user->cart), 'success' => true]);
    }
    private function calculateTotal($cart)
    {
        return $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });
    }

    public function decrementQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $user = auth()->user();

        // Check if the user has a cart
        if (!$user || !$user->cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Find the product in the cart
        $cartItem = $user->cart->products()->find($productId);

        if (!$cartItem) {
            return response()->json(['error' => 'Product not found in the cart'], 404);
        }

        // Decrement the quantity in the pivot table, ensuring it doesn't go below 1
        if ($cartItem->pivot->quantity > 1) {
            $user->cart->products()->updateExistingPivot($productId, ['quantity' => $cartItem->pivot->quantity - 1]);
        } else {
            // Remove the item from the cart if quantity is 1    
            $user->cart->products()->detach($productId);
            return response()->json(['newQuantity' => 0, 'total' => $this->calculateTotal($user->cart), 'success' => true, 'remove' => true]);
        }

        return response()->json(['newQuantity' => $user->cart->products()->find($productId)->pivot->quantity, 'total' => $this->calculateTotal($user->cart), 'success' => true, 'remove' => false]);
    }
}

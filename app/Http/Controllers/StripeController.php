<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout()
    {
        // Fetch cart items from the database
        $user_id = auth()->id();
        $cart = Cart::where('user_id', $user_id)->with('products')->first();

        if (!$cart || $cart->products->isEmpty()) {
            return view('checkout', ['cartItems' => [], 'totalAmount' => 0]);
        }

        $cartItems = auth()->user()->cart->products;
        $totalAmount = $this->calculateTotal($cart);

        return view('checkout', compact('cartItems', 'totalAmount'));
    }

    private function calculateTotal($cart)
    {
        return $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });
    }


    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $lineItems = [];

        foreach ($cart->products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'USD',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount'  => $product->price * 100, // Convert to cents
                ],
                'quantity'   => $product->pivot->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }


    public function success()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";        
    }
}

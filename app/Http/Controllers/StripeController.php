<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;

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

        // Pass the order ID to the view
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
                    'unit_amount'  => $product->price * 100,
                ],
                'quantity'   => $product->pivot->quantity,
            ];
        }

        // Create an order
        $order = Order::create([
            'user_id'      => $user->id,
            'total_amount' => $this->calculateTotal($cart),
            'status'       => 'pending', // Set the initial status to 'pending'
        ]);

        // Create a payment
        $payment = Payment::create([
            'order_id'       => $order->id,
            'transaction_id' => 'user_' . $user->id . '_order_' . $order->id . '_' . time(),
            'amount'         => $order->total_amount,
            'status'         => 'pending', // Set the initial status to 'pending'
        ]);

        // Associate the payment with the order
        $order->payment()->save($payment);
        // Save both the order and payment
        $order->save();

        // Proceed with Stripe session creation
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        // Redirect the user to the Stripe checkout page
        return redirect()->away($session->url);
    }
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();

        try {
            $sigHeader = $request->header('Stripe-Signature');
            $endpointSecret = config('services.stripe.webhook_secret');

            // Verify the Stripe webhook signature
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

            // Handle the checkout.session.completed event
            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;

                // Retrieve the order ID from the metadata
                $orderId = $session->metadata->order_id;

                // Retrieve the order
                $order = Order::find($orderId);

                if ($order) {
                    // Update the payment status to 'success'
                    $order->payment->update(['status' => 'success']);

                    // Optionally, update the order status to 'completed'
                    $order->update(['status' => 'completed']);
                }
            }

            // Add more event handling as needed

        } catch (SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        return response()->json(['success' => true]);
    }
    public function success()
    {
        // Retrieve the user information
        $user = auth()->user();

        // Redirect the user if not authenticated
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not authenticated.');
        }

        // Retrieve the latest order for the user
        $order = Order::with('payment')->where('user_id', $user->id)->latest()->first();

        // Redirect if no order is found
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        // Check if the payment was successful
        if ($order->payment && $order->payment->status === 'success') {
            // Optionally, update the order status to 'completed'
            $order->update(['status' => 'completed']);

            // Customize the success message
            $message = "Thanks for your order (#{$order->id}). Your payment was successful. ";

            // Redirect to the home page with success message
            return redirect()->route('home')->with('successMessage', $message);
        }

        // Customize the message for pending payments
        $message = "Thanks for your order (#{$order->id}). Your payment is pending. Please wait for further updates from the seller. ";

        // Redirect to the home page with pending message
        return redirect()->route('home')->with('pendingMessage', $message);
    }
}

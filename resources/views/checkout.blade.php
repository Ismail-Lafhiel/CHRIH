<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Checkout</h2>

        <!-- Your checkout form or details go here -->

        <form id="checkout-form" action="{{ route('session') }}" method="POST">
            @csrf
            <!-- Display cart items and quantities -->
            @foreach ($cartItems as $cartItem)
                <div class="flex items-center mb-4">
                    <img src="{{ asset('storage/app/' . $cartItem->product_image) }}" alt="{{ $cartItem->name }}"
                        class="w-16 h-16 object-cover mr-4">
                    <div>
                        <p class="font-semibold">{{ $cartItem->name }}</p>
                        <p class="text-gray-600">Quantity: {{ $cartItem->pivot->quantity }}</p>
                        <p class="product-subtotal">Price: ${{ number_format($cartItem->price * $cartItem->pivot->quantity, 2) }}</p>
                    </div>
                </div>
            @endforeach

            <p class="order-total-display">Total fees: ${{ number_format($totalAmount, 2) }}</p>

            <!-- Other checkout form fields go here -->
            <button type="submit" id="checkout-button" class="bg-blue-500 text-white px-4 py-2">
                Proceed to Payment
            </button>
        </form>
    </div>
</x-app-layout>

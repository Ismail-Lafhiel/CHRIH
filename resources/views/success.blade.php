<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Order Success</h2>

        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ $message }}</p>
        </div>

        <p class="text-gray-600">
            Thank you for shopping with us. If you have any questions or concerns, please feel free to contact our customer support.
        </p>

        <div class="mt-8">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Back to Home</a>
        </div>
    </div>
</x-app-layout>

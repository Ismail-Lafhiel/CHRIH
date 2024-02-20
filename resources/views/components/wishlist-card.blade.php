@props(['productId', 'productName', 'productPrice', 'productImage'])
<div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
    <a href="{{ route('products.show', $productId) }}">
        <img class="hover:grow hover:shadow-lg"
            src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
        <div class="pt-3 flex items-center justify-between">
            <p class="text-gray-500 dark:text-gray-200">{{ $productName }}</p>
            <a href="#" data-popover-target="popover-wish-list-{{ $productId }}"
                data-product-id="{{ $productId }}" class="removeFromWishList">
                <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black dark:hover:text-white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </a>
        </div>
        <p class="pt-1 text-gray-900 dark:text-gray-100">${{ $productPrice }}</p>
    </a>
</div>

<x-guest-layout>
    <x-navbar />
    <section>
        <h1 class="text-5xl font-extrabold dark:text-white mt-10 md:mt-16 text-center">Shop Now</h1>
    </section>

    <section>
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="text-4xl font-extrabold dark:text-white text-center" href="#">
                        Store
                    </a>
                    <div class="flex items-center" id="store-nav-content">
                        <form class="">
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" oninput="search()" id="default-search"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search " required />
                            </div>
                        </form>

                    </div>
                </div>
            </nav>
            @foreach ($products as $product)
                <x-store-cards :productId='$product->id' :productName='$product->name' :productDescription='$product->description' :productPrice='$product->price'
                    :productImage='$product->product_image' />
            @endforeach
        </div>
    </section>
    <x-footer />
</x-guest-layout>

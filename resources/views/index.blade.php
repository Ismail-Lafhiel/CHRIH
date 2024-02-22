<x-guest-layout>
    <x-navbar />
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <a href="#"
                class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                role="alert">
                <span class="text-xs bg-red-600 rounded-full text-white px-4 py-1.5 mr-3">New</span> <span
                    class="text-sm font-medium">CHRIH is out! See what's new</span>
                <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Unleash Your Style, Shop with a Smile!</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Discover
                CHRIH: Elevate your style effortlessly with curated collections and unbeatable deals. Your go-to
                destination for fashion that's as unique as you are!</p>
            <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <a href="#"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                    Go To Shop
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <svg class="mr-2 -ml-1 w-5 h-5 dark:fill-gray-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>
                    Wish List
                </a>
            </div>
            <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                <span class="font-semibold text-gray-400 uppercase">FEATURED IN</span>
                <div class="flex flex-wrap justify-center items-center mt-10 text-gray-500 sm:justify-between">
                    <a href="#" class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                        <img class="h-9" src="{{ asset('featured/AliExpress.png') }}" alt="">
                    </a>
                    <a href="#" class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                        <img class="h-11" src="{{ asset('featured/Amazon.png') }}" alt="">
                    </a>
                    <a href="#" class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                        <img class="h-11" src="{{ asset('featured/Dropship-AGENT.png') }}" alt="">

                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="flex justify-center">
        <hr class="inline-block w-48 h-1 my-4 bg-gray-300 border-0 rounded md:my-10 dark:bg-gray-700">
    </div>
    <section id="default-carousel" class="relative w-full bg-white dark:bg-gray-900" data-carousel="slide">
        <h2 class="text-4xl font-extrabold dark:text-white text-center">Trending Products</h2>
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96 mt-8 md:mt-16">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/bg-1.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/bg-2.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/bg-3.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/bg-2.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/bg-3.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>
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
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-red-600 hover:bg-red-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search " required />
                                <button type="submit"
                                    class="text-white absolute end-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Search</button>
                            </div>
                            {{-- filter   --}}
                            <script>
                                function search() {

                                    var input = document.getElementById('default-search').value;

                                    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                                    var xhr = new XMLHttpRequest();

                                    xhr.open('GET', '/search?search=' + input, true);
                                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                                    xhr.onload = function() {
                                        if (xhr.status >= 200 && xhr.status < 300) {
                                            var data = JSON.parse(xhr.responseText);
                                            console.log(data);
                                            table_post_row(data.products);

                                        } else {
                                            console.error('Request failed with status', xhr.status);
                                        }
                                    };

                                    xhr.onerror = function() {
                                        console.error('Request failed');
                                    };

                                    xhr.send();
                                }

                                function table_post_row(products) {
                                    let htmlView = '';
                                    if (products.length <= 0) {
                                        htmlView += `<tr><td colspan="4"> 0 result </td></tr>`;
                                    } else {
                                        products.forEach(product => {
                                            htmlView += `
                                                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                                                        <a href="/view-product/${product.id}">
                                                            <img class="hover:grow hover:shadow-lg h-44 w-full" src="/public/product_image/${product.image}">
                                                            <div class="pt-3 flex items-center justify-between">
                                                                <p class="text-gray-700 dark:text-white">${product.name}</p>
                                                                <a href="#" data-popover-target="popover-wish-list-${product.id}"
                                                                    data-product-id="${product.id}" class="addToWishlist">
                                                                    <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black dark:hover:text-white"
                                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                                                    </svg>
                                                                </a>
                                                                <div data-popover id="popover-wish-list-${product.id}" role="tooltip"
                                                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                                                    <div
                                                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                                                        <h3 class="font-semibold text-gray-900 dark:text-white">Add To WishList</h3>
                                                                    </div>
                                                                    <div class="px-3 py-2">
                                                                        <p>Click the heart to add this item to your wish list</p>
                                                                    </div>
                                                                    <div data-popper-arrow></div>
                                                                </div>

                                                            </div>
                                                            <div class="pt-3 flex items-center justify-between">
                                                                <p class="pt-1 text-gray-900 dark:text-white">${product.price} $</p>
                                                                <a href="#" data-popover-target="popover-to-cart-${product.id}" data-product-id="${product.id}" class="addToCart">
                                                                    <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black dark:hover:text-white"
                                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                                        <path
                                                                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                                                    </svg>
                                                                </a>
                                                                <div data-popover id="popover-to-cart-${product.id}" role="tooltip"
                                                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                                                    <div
                                                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                                                        <h3 class="font-semibold text-gray-900 dark:text-white">Add To Cart</h3>
                                                                    </div>
                                                                    <div class="px-3 py-2">
                                                                        <p>Click the cart to add this item to your cart</p>
                                                                    </div>
                                                                    <div data-popper-arrow></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div> `;
                                        });
                                    }
                                    document.querySelector('#prudact-item').innerHTML = htmlView;
                                }
                            </script>
                        </form>


                    </div>
                </div>
            </nav>
            <div id="prudact-item" class="w-full flex flex-wrap">
                @foreach ($products as $product)
                    <x-store-cards :productId='$product->id' :productName='$product->name' :productDescription='$product->description' :productPrice='$product->price'
                        :productImage='$product->product_image' />
                @endforeach
            </div>
        </div>
    </section>
    <x-footer />
</x-guest-layout>

import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

// dark mode
var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
var logoImages = document.getElementsByClassName('logo-image');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function () {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

        // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }

    // Update the logo image source based on the current theme
    for (var i = 0; i < logoImages.length; i++) {
        var logoImage = logoImages[i];
        logoImage.src = '/logo/chrih-' + (document.documentElement.classList.contains('dark') ? 'white' : 'red') + '.png';
    }
});
function setLogoTheme() {
    var isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    // Iterate through all logo images and update their sources
    for (var i = 0; i < logoImages.length; i++) {
        var logoImage = logoImages[i];
        logoImage.src = '/logo/chrih-' + (isDarkMode ? 'white' : 'red') + '.png';
    }
}

// Call the function to set the initial theme
setLogoTheme();

// Listen for changes in the system theme and update the logo accordingly
if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addListener(setLogoTheme);
}


// ajax
$(document).ready(function () {
    // add to wish list
    $('.addToWishlist').on('click', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/wishlist/add/' + productId,
            data: {
                _token: csrfToken,
            },
            success: function (response) {
                Swal.fire({
                    title: "Success",
                    text: response.success,
                    icon: "success"
                });
            },
            error: function (error) {
                Swal.fire({
                    title: "Error",
                    text: error.responseJSON.message,
                    icon: "error"
                });
            }
        });
    });

    // Remove from WishList
    $('.removeFromWishList').on('click', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'DELETE',
            url: '/wishlist/remove/' + productId,
            data: {
                _token: csrfToken,
            },
            success: function (response) {
                Swal.fire({
                    title: "Success",
                    text: response.success,
                    icon: "success"
                });
            },
            error: function (error) {
                Swal.fire({
                    title: "Error",
                    text: error.responseJSON.message,
                    icon: "error"
                });
            }
        });
    });


    // add to cart
    $('.addToCart').on('click', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/cart/add/' + productId,
            data: {
                _token: csrfToken,
            },
            success: function (response) {
                Swal.fire({
                    title: "Success",
                    text: response.success,
                    icon: "success"
                });
            },
            error: function (error) {
                Swal.fire({
                    title: "Error",
                    text: error.responseJSON.message,
                    icon: "error"
                });
            }
        });
    });
    // product price and quantity
    $(document).on('click', '.increment-btn, .decrement-btn', function () {
        var productId = $(this).data('product-id');
        var action = $(this).hasClass('increment-btn') ? 'increment' : 'decrement';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/cart/' + action + '-quantity',
            data: {
                product_id: productId
            },
            success: function (response) {
                console.log(response); // Log the response to the console for debugging

                if (response.newQuantity !== undefined) {
                    // Update the UI
                    updateQuantityUI(productId, response.newQuantity);
                    updateSubtotalUI(productId);
                    updateTotalUI(response.total);

                    if (action === 'decrement' && response.newQuantity === 0) {
                        removeCartItem(productId);
                        location.reload();
                    }
                } else {
                    console.error(action.charAt(0).toUpperCase() + action.slice(1) + ' failed. Error: ' + response.error);
                }
            },
            error: function (error) {
                console.error(action.charAt(0).toUpperCase() + action.slice(1) + ' failed. Error: ' + error.responseText);
            }
        });
    });

    function updateQuantityUI(productId, newQuantity) {
        $('.quantity-input[data-product-id="' + productId + '"]').val(newQuantity);
    }

    function updateSubtotalUI(productId) {
        var quantity = parseInt($('.quantity-input[data-product-id="' + productId + '"]').val());
        var price = parseFloat($('.product-subtotal[data-product-id="' + productId + '"]').data('product-price'));

        console.log('Price:', price); // Add this line to log the price to the console

        var subtotal = (quantity * price).toFixed(2);
        $('.product-subtotal[data-product-id="' + productId + '"]').text('$' + subtotal);
    }
    function updateTotalUI(total) {
        $('.order-total-display').text('$' + total.toFixed(2));
    }

    function removeCartItem(productId) {
        $('.flex[data-product-id="' + productId + '"]').remove();
    }
});

// seach by product name:
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
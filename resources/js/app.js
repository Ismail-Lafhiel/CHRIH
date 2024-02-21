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

    // checkout
    document.addEventListener('DOMContentLoaded', function () {
        var stripe = Stripe('your-publishable-key');
        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function () {
            fetch('/stripe/session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    productname: 'Your Product Name', // Change this dynamically
                    total: calculateTotalAmount(), // Implement a function to calculate total dynamically
                }),
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (session) {
                    return stripe.redirectToCheckout({ sessionId: session.id });
                })
                .then(function (result) {
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
        });

        // Add a function to calculate the total amount dynamically
        function calculateTotalAmount() {
            // Implement your logic to calculate the total amount based on cart items
            // You can iterate through cartItems and calculate the total amount
            // For simplicity, let's assume there's a global variable named 'totalAmount'
            return totalAmount;
        }
    });

});
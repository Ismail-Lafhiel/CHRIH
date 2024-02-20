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

// add to wish list
$(document).ready(function () {
    $('.addToWishlist').on('click', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST', // Ensure this is set to 'POST'
            url: '/wishlist/add/' + productId,
            data: {
                _token: csrfToken,
            },
            success: function (response) {
                alert(response.success); // Display a success message
            },
            error: function (error) {
                console.error(error.responseJSON.message); // Display an error message
            }
        });
    });
});

// add to cart
$(document).ready(function () {
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
                alert(response.success); // Display a success message
            },
            error: function (error) {
                console.error(error.responseJSON.message); // Display an error message
            }
        });
    });
});
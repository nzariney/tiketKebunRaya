import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand-green': '#2b5336', // Dark forest green
                'brand-orange': '#e89f2a', // Warm amber/orange
                'brand-cream': '#f4efe6', // Beige/cream background
            }
        },
    },

    plugins: [forms],
};

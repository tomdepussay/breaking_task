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
            colors: {
                light: '#F2EFE7',
                primaire: '#9ACBD0',
                secondaire: '#48A6A7',
                dark: '#006A71',
                text: '#2D2D2D'
            },
            fontFamily: {
                title: ['"Droid Sans"', 'sans-serif'],
                important: ['"Source Sans Pro"', 'sans-serif'],
                base: ['Hind', 'sans-serif']
            }
        },
    },

    plugins: [forms],
};

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}'

    ],

    theme: {
        extend: {
            fontFamily: {
                primary: ['Playwrite CU', 'serif'],
                secondary: ['Poppins', 'sans-serif'],
            },
            backgroundImage: {
                
                'maya': "url('@/../img/maya.png')",
                'dog': "url('@/../img/cachorro.jpg')",
                'nena-love': "url('@/../img/nena_love.jpg')",
                'nena-angry': "url('@/../img/nena_angry.jpg')",
                'nena-sweet': "url('@/../img/nena_sweet.jpg')",
            }
        },
    },

    plugins: [forms, typography, require('flowbite/plugin')],
};

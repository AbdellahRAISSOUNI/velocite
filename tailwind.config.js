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
            animation: {
                'background-move': 'bgMove 10s ease-in-out infinite',
                'background-move-alt': 'bgMoveAlt 15s ease-in-out infinite',
            },
            keyframes: {
                bgMove: {
                    '0%, 100%': { transform: 'translateY(0px) translateX(0px)' },
                    '50%': { transform: 'translateY(-30px) translateX(30px)' },
                },
                bgMoveAlt: {
                    '0%, 100%': { transform: 'translateY(0px) translateX(0px)' },
                    '50%': { transform: 'translateY(20px) translateX(-20px)' },
                },
            },
        },
    },

    plugins: [forms],
};

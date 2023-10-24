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
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {            
                    "primary": "#140F4B",                            
                    "secondary": "#f000b8",                            
                    "accent": "#1dcdbc",                            
                    "neutral": "#2b3440",                            
                    "base-100": "#ffffff",                            
                    "info": "#3abff8",                            
                    "success": "#36d399",                            
                    "warning": "#fbbd23",                            
                    "error": "#f87272",
                    "danger": "#f87272",
                },
            },
        ],
    },

    plugins: [forms, typography , require("daisyui")],
};

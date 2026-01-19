import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

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
                'pusaka':{
                DEFAULT: '#00a099', // Warna Utama (Tosca)
                    dark: '#008c85',    // Versi agak gelap (untuk hover)
                    light: '#0ca49f',   // Versi agak terang (opsional)
                }
            }
        },
    },

    plugins: [forms],
};

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
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'pusaka': {
                    DEFAULT: '#00a099', // Warna Utama (Tosca)
                    dark: '#008c85',    // Versi agak gelap (untuk hover)
                    light: '#0ca49f',   // Versi agak terang (opsional)
                },
                'rescue-red': '#D7263D', /* Merah Darurat */
                'charcoal': '#2B2D42',   /* Abu-abu Arang */
                'light-gray': '#EDF2F4', /* Background Terang */
                blue: {
                    50: '#fdf2f3',
                    100: '#fbe5e8',
                    200: '#f6c1c8',
                    300: '#ef93a0',
                    400: '#e75b6e',
                    500: '#e1354c',
                    600: '#D7263D', // Force bg-blue-600 to Rescue Red
                    700: '#b01c30',
                    800: '#901525',
                    900: '#751421',
                    950: '#3c0a11',
                },
                indigo: {
                    50: '#fdf2f3',
                    100: '#fbe5e8',
                    200: '#f6c1c8',
                    300: '#ef93a0',
                    400: '#e75b6e',
                    500: '#e1354c',
                    600: '#D7263D', // Force bg-indigo-600 to Rescue Red
                    700: '#b01c30',
                    800: '#901525',
                    900: '#751421',
                    950: '#3c0a11',
                },
                gray: {
                    800: '#2B2D42', // Charcoal
                    900: '#1A1C2A', // Darker Charcoal
                },
                slate: {
                    800: '#2B2D42', // Charcoal
                    900: '#1A1C2A', // Darker Charcoal
                }
            },
            animation: {
                'pulse-custom': 'pulse-btn 2s infinite',
            },
            keyframes: {
                'pulse-btn': {
                    '0%': { transform: 'scale(1)', boxShadow: '0 0 0 0 rgba(215, 38, 61, 0.7)' },
                    '50%': { transform: 'scale(1.05)', boxShadow: '0 0 0 15px rgba(215, 38, 61, 0)' },
                    '100%': { transform: 'scale(1)', boxShadow: '0 0 0 0 rgba(215, 38, 61, 0)' },
                }
            }
        },
    },

    plugins: [forms],
};

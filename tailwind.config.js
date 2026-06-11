import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#1e4a76',
                    dark: '#163a5c',
                    light: '#7ab3c8',
                    soft: '#e8f0f8',
                },
                secondary: '#1e293b',
                indigo: {
                    50: '#e8f0f8',
                    100: '#d1e1f1',
                    200: '#a3c3e3',
                    300: '#75a5d5',
                    400: '#4787c7',
                    500: '#2c6ea9',
                    600: '#1e4a76',
                    700: '#163a5c',
                    800: '#112c45',
                    900: '#0b1e30',
                    950: '#071320',
                }
            }
        },
    },
    plugins: [],
}

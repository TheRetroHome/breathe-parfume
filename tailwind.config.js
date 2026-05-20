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
                sans: ['Cormorant Garamond', 'Garamond', ...defaultTheme.fontFamily.serif],
                body: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    50:  '#f5f5f0',
                    100: '#e8e8df',
                    200: '#d1d1c0',
                    300: '#b0b098',
                    400: '#8c8c70',
                    500: '#6e6e54',
                    600: '#555544',
                    700: '#414138',
                    800: '#28281f',
                    900: '#141410',
                    950: '#0a0a07',
                },
                gold: {
                    50:  '#fdf9eb',
                    100: '#faf0c7',
                    200: '#f5df8a',
                    300: '#efc84d',
                    400: '#e8b225',
                    500: '#d49517',
                    600: '#b07211',
                    700: '#8a5313',
                    800: '#724217',
                    900: '#623819',
                    950: '#3a1d09',
                },
                emerald: {
                    50:  '#edfcf4',
                    100: '#d3f8e2',
                    200: '#aaf0cb',
                    300: '#73e3ae',
                    400: '#39cd8a',
                    500: '#16b06e',
                    600: '#0a9059',
                    700: '#097349',
                    800: '#0b5b3b',
                    900: '#0a4b32',
                    950: '#042a1d',
                },
                burgundy: {
                    50:  '#fdf2f4',
                    100: '#fce7ea',
                    200: '#f9d3da',
                    300: '#f4b0bc',
                    400: '#ec7f94',
                    500: '#e05471',
                    600: '#cb3157',
                    700: '#ab2247',
                    800: '#8f2042',
                    900: '#7a1f3e',
                    950: '#500c26',
                },
                lavender: {
                    50:  '#f4f3fd',
                    100: '#ebe9fb',
                    200: '#d9d6f7',
                    300: '#bdb7f0',
                    400: '#9e93e6',
                    500: '#836fd9',
                    600: '#6f52cb',
                    700: '#5e41b5',
                    800: '#4f3796',
                    900: '#43307d',
                    950: '#281d52',
                },
            },
            animation: {
                'fade-up':   'fadeUp 0.7s ease both',
                'fade-in':   'fadeIn 0.5s ease both',
                'float':     'float 6s ease-in-out infinite',
                'shimmer':   'shimmer 2s linear infinite',
                'glow':      'glow 3s ease-in-out infinite alternate',
            },
            keyframes: {
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%':      { transform: 'translateY(-12px)' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                glow: {
                    '0%':   { textShadow: '0 0 10px rgba(212,149,23,0.3)' },
                    '100%': { textShadow: '0 0 30px rgba(212,149,23,0.8), 0 0 60px rgba(212,149,23,0.4)' },
                },
            },
        },
    },

    plugins: [forms],
};

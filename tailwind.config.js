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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#0F52BA',
                    dark: '#0A3D8F',
                    light: '#1E6FE0',
                    50: '#EEF4FF',
                    100: '#D6E4FF',
                    200: '#ADC8FF',
                },
                neutral: {
                    900: '#0F172A',
                    800: '#1E293B',
                    700: '#334155',
                    500: '#64748B',
                    300: '#CBD5E1',
                    100: '#F1F5F9',
                },
                app: '#F8FAFC',
            },
        },
    },

    plugins: [forms],
};

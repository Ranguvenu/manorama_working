import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/flowbite/**/*.js'
    ],

    theme: {

        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                primary:"#EA215A",
                secondary:"#4948A5",
                // 'rose':"#EA215A",
                rose:{
                    '50': '#fff0f3',
                    '100': '#ffe3e7',
                    '200': '#ffcbd5',
                    '300': '#ffa1b3',
                    '400': '#ff6c8a',
                    '500': '#ea215a',
                    '600': '#ea215a',
                    '700': '#c40c45',
                    '800': '#a40d41',
                    '900': '#8c0f3d',
                    '950': '#4f021d',
                }
            },
            screens: {
                'custom_md': {'min': '768px', 'max': '1023px'},
                // => @media (min-width: 768px and max-width: 1023px) { ... }
                'media_lg': {'max': '1024px'},
                // => @media (max-width: 1023px) { ... }

                'media_md': {'max': '767px'},
                // => @media (max-width: 767px) { ... }

                'media_sm': {'max': '639px'},
                // => @media (max-width: 639px) { ... }

                'media_xs': {'max': '475px'},
                // => @media (max-width: 475px) { ... }
                'custom_xs': {'min': '475px', 'max': '639px'},
                'mobile_xs': {'min': '300px', 'max': '500px'},
                // => @media (min-width: 475px and max-width: 639px) { ... }
            },
        },
    },

    plugins: [forms],
};

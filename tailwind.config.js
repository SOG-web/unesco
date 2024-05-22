import withMT from "@material-tailwind/html/utils/withMT.js";

/** @type {import('tailwindcss').Config} */
export default withMT({
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                'poppins': ['Poppins', 'sans-serif'],
            },
            colors: {
                primary: '#002979',
                background: '#E8EFF6',
                'natural-100': '#F9F8F9',
                'gray-4': '#cccccc',
                'yellow-1': '#FFAD47',
                'yellow-fade': '#FFE4C2',
                'text-1': '#272835',
                'text-2': '#9E9E9E',
                'sky-900': '#002979',
            },
            screens: {
                xl2: '1440px',
            }
        },
    },
    plugins: [
        require('flowbite/plugin'),
    ],
});


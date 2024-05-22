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
                'gray-4': '#cccccc'
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


import withMT from "@material-tailwind/html/utils/withMT.js";

/** @type {import('tailwindcss').Config} */
export default withMT({
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
    ],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                primary: "#002979",
                secondary: "#8F00FF",
                background: "#E8EFF6",
                "bg-2": "#F3E4FF",
                "natural-100": "#F9F8F9",
                "gray-4": "#cccccc",
                "gray-2": "#838383",
                "yellow-1": "#FFAD47",
                "yellow-fade": "#FFE4C2",
                "text-1": "#272835",
                "text-2": "#9E9E9E",
                "text-3": "#8F92A1",
                "text-4": "#595B61",
                "text-5": "#121212",
                "sky-900": "#002979",
            },
            screens: {
                xl2: "1440px",
            },
        },
    },
    plugins: [
        require("daisyui")
    ],
});

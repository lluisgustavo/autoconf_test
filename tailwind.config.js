import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],

    theme: {
        colors: {
            "autoconf-blue": "#52c508",
            "autoconf-orange": "#EB9036",
            "autoconf-lightblue": "#E8F0FD",
        },
        extend: {
            fontFamily: {
                sans: ["Rubik", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};

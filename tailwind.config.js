const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/app/**/*.html", "./resources/app/**/*.vue"],
    theme: {
        extend: {
            colors: {
                theme: colors.teal,
                danger: colors.red
            }
        }
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio')
    ],
};

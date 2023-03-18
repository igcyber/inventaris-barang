/** @type {import('tailwindcss').Config} */
module.exports = {
    //compile assets for production
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

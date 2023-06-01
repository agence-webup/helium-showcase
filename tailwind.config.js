/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./packages/helium-ui/resources/**/*.blade.php"
    ],
    theme: {
        extend: {},
    },
    plugins: [
      require('@tailwindcss/forms'),
    ],
}

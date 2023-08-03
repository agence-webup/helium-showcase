/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/Http/Livewire/**/*.php",
    "./packages/helium-ui/resources/**/*.blade.php",
    "./packages/laravel-helium-core/resources/**/*.blade.php",
    "./packages/laravel-helium-core/src/**/*.php" // TODO: create a file with all CSS constants for this
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

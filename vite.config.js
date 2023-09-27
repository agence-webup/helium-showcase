import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['/packages/helium-core/resources/css/app.css', '/packages/helium-core/resources/js/helium.js'],
      refresh: true,
    }),
  ],
});

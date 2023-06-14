import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['packages/helium-ui/resources/css/app.css', '/packages/helium-ui/resources/js/app.js'],
            refresh: true,
        }),
    ],
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                // CSS
                'resources/css/main.css',
                'resources/css/landing.css',
                'resources/css/auth.css',

                // JS
                'resources/js/landing.js',
            ],
            refresh: true,
        }),
    ],
});

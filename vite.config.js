import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/common.css',
                'resources/sass/app.scss',
                'node_modules/select2/dist/css/select2.css',
                'resources/css/errors/error.css',
                //js
                'resources/js/app.js',
                'node_modules/select2/dist/js/select2.js',
            ],
            refresh: true,
        }),
    ],
});

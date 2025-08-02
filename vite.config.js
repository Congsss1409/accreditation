import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            // Update the input array to point to the new .scss file
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // Add a resolve alias to make importing Bootstrap easier
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});

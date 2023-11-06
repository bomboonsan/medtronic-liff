import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

// 001 import the basicSsl Vite plugin
import basicSsl from '@vitejs/plugin-basic-ssl'

// 002 set the Laravel host and the port
const host = '127.0.0.1';
const port = '5000';



export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
        basicSsl(), // Add this line to enable basic SSL support
    ],

    // add HTTPS support
    server: {
        https: true, // Enable HTTPS
        proxy: {
            '/your-laravel-route-prefix': {
                target: `http://${host}:${port}`,
                changeOrigin: true,
            },
        },
    },
    base: 'https://cfe8-2403-6200-8830-7b74-7aeb-c882-5eec-fe34.ngrok-free.app/',
});

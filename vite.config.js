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
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
});

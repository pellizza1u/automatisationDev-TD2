import {defineConfig} from "vite";

export default defineConfig({
    root: './public/assets',
    base: '/build/',
    server: {
        port: 3000
    },
    build: {
        assetsDir: '',
        outDir: '../build/',
        rollupOptions: {
            input: {
                'script.js': './public/assets/script.js',
            }
        }
    },
});


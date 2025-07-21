import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "0.0.0.0",
        port: 5173,
        hmr: {
            host: "localhost",
        },
        cors: true,
    },
    plugins: [
        laravel({
            input: [
                // Fichiers CSS
                "resources/css/app.css",

                // Fichier JS
                "resources/js/app.js",
                "resources/js/pages/project-show.js",
                "resources/js/pages/project-create.js",
                "resources/js/pages/dashboard.js",
                "resources/js/pages/parameters.js",
            ],
            refresh: true,
        }),
    ],
});

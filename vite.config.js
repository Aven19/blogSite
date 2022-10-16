import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/assets/css/main.css",
                "resources/assets/js/blog.js",
                "resources/assets/fontawesome/js/all.min.js",
                "resources/assets/plugins/popper.min.js",
                "resources/assets/plugins/popper.min.js",
                "resources/assets/plugins/bootstrap/js/bootstrap.min.js",
                "resources/assets/custom-file-validation.js"
            ],
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1600,
    },
});

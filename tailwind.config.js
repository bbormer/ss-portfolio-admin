import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/**/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                en: ["Montserrat", "sans-serif"],
                ja: ["'M PLUS 1p'", "sans-serif"],
            },
        },
    },
};

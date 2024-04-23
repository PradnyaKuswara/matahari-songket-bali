/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php", // 👈
    ],
    theme: {
        extend: {
            animation: {
                "infinite-scroll": "infinite-scroll 25s linear infinite",
            },
            keyframes: {
                "infinite-scroll": {
                    from: { transform: "translateX(0)" },
                    to: { transform: "translateX(-100%)" },
                },
            },
        },
        screens: {
            sm: "640px",
            // => @media (min-width: 640px) { ... }

            md: "768px",
            // => @media (min-width: 768px) { ... }

            lg: "1024px",
            // => @media (min-width: 1024px) { ... }

            xl: "1290px",
            // => @media (min-width: 1280px) { ... }

            "2xl": "1536px",
            // => @media (min-width: 1536px) { ... }
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#4600ff",
                    secondary: "#dd7e00",
                    accent: "#ff6f00",
                    neutral: "#22272b",
                    "base-100": "#ffffff",
                    info: "#00b0ff",
                    success: "#698500",
                    warning: "#c0a000",
                    error: "#ff696e",
                },
            },
        ],
    },

    plugins: [require("daisyui"), require("tailwindcss-animated")],
};

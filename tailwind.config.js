/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
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

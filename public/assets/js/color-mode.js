const mode = document.getElementById("mode");

const updateTheme = () => {
    let theme = localStorage.getItem("theme");

    if (theme === "dark") {
        document.documentElement.setAttribute("data-theme", theme);
        mode.checked = theme === "dark";
    } else {
        document.documentElement.setAttribute("data-theme", "light");
        mode.checked = false;
        localStorage.setItem("theme", "light");
    }
};

mode.addEventListener("change", (e) => {
    const theme = e.target.checked ? "dark" : "light";
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);

    updateTheme();
});

updateTheme();

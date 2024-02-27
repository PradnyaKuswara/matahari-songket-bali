const nav = document.getElementById("navbar");

const resetNav = () => {
    nav.classList.remove("bg-white", "bg-neutral");
};

const updateNav = (colorTheme) => {
    resetNav();
    if (colorTheme === "light") {
        nav.classList.add("bg-white");
        nav.classList.remove("bg-neutral");
    }
    if (colorTheme === "dark") {
        nav.classList.add("bg-neutral");
        nav.classList.remove("bg-white");
    }
};

document.getElementById("mode").addEventListener("change", (e) => {
    if (e.target.checked && pageYOffset > 100) {
        updateNav("dark");
    }
    if (e.target.checked === false && pageYOffset > 100) {
        updateNav("light");
    }
});

document.addEventListener("scroll", () => {
    let theme = localStorage.getItem("theme");
    if (pageYOffset > 100) {
        updateNav(theme);
    } else {
        resetNav();
    }
});

resetNav();

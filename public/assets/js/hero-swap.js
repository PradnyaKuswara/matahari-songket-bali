const updateHero = () => {
    const theme = localStorage.getItem("hero-theme");
    if (theme === "hero-bg-dark") {
        document.getElementById("hero").classList.add("hero-bg-dark");
        document.getElementById("hero").classList.remove("hero-bg-light");
    } else {
        document.getElementById("hero").classList.add("hero-bg-light");
        document.getElementById("hero").classList.remove("hero-bg-dark");
    }
};

document.getElementById("mode").addEventListener("change", function () {
    if (this.checked) {
        localStorage.setItem("hero-theme", "hero-bg-dark");
    } else {
        localStorage.setItem("hero-theme", "hero-bg-light");
    }

    updateHero();
});

updateHero();

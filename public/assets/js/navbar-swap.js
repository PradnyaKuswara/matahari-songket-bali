const nav = document.getElementById("navbar");

window.addEventListener("scroll", () => {
    if (window.scrollY > 0) {
        nav.classList.add("bg-white");
        nav.classList.remove("bg-transparent");
    } else {
        nav.classList.add("bg-transparent");
        nav.classList.remove("bg-white");
    }
});

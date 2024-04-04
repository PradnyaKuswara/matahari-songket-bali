import "./bootstrap";
import Typed from "typed.js";
import Swiper from "swiper/bundle";
import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";

window.Typed = Typed;
window.Swiper = Swiper;
window.Alpine = Alpine;

Alpine.plugin(intersect);
Alpine.start();

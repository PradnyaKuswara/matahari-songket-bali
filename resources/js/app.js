import "./bootstrap";
import "../../vendor/masmerise/livewire-toaster/resources/js"; // 👈
import { Notyf } from "notyf";
import { debounce } from "lodash";
import Typed from "typed.js";
import Swiper from "swiper/bundle";
import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";
import AOS from "aos";

window.Typed = Typed;
window.Swiper = Swiper;
window.Alpine = Alpine;
window.Notyf = Notyf;
window.debounce = debounce;

Alpine.plugin(intersect);
Alpine.start();

AOS.init();

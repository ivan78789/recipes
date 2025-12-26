import "./bootstrap";
import Alpine from "alpinejs";
import Swiper from "swiper";
import { Pagination, Autoplay, EffectFade } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/effect-fade";
import SearchModal from "./components/SearchModal";

// Регистрируем компонент глобально
Alpine.data("searchModal", SearchModal);

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".swiper-container", {
        modules: [Pagination, Autoplay, EffectFade],
        effect: "fade",
        fadeEffect: { crossFade: true },
        loop: true,
        speed: 1000,
        autoplay: { delay: 6000, disableOnInteraction: false },
        on: {
            slideChange: function () {
                const bars = document.querySelectorAll(".swiper-progress-bar");
                bars.forEach((bar, idx) => {
                    bar.style.opacity = idx === this.realIndex ? "1" : "0.4";
                    bar.style.width = idx === this.realIndex ? "100%" : "30%";
                    bar.style.transition = "all 0.6s ease";
                });
            },
        },
    });

    const bars = document.querySelectorAll(".swiper-progress-bar");
    bars.forEach((bar, idx) => {
        bar.style.opacity = idx === swiper.realIndex ? "1" : "0.4";
        bar.style.width = idx === swiper.realIndex ? "100%" : "30%";
    });
});

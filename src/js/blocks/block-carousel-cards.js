// CAROUSEL CARDS
import Swiper from "../main.js";
document.addEventListener("DOMContentLoaded", function() {
  const modules = document.querySelectorAll(".block-carousel-cards");

  if (!modules) {
    return;
  }

  modules.forEach((module) => {
    const navPrev = module.querySelector(".carousel-cards-nav-prev");
    const navNext = module.querySelector(".carousel-cards-nav-next");
    const swiperId = `#${module.querySelector(".swiper swiper-cards").id}`;
    const cardsSwiper = new Swiper(`${swiperId}`, {
      autoHeight: true,
      spaceBetween: 10,
      slidesPerView: 1,
      centeredSlides: true,
      centeredSlidesBounds: true,
      speed: 300,
      navigation: {
        nextEl: navNext,
        prevEl: navPrev,
      },
      breakpoints: {
        1300: {
          slidesPerView: 3,
          autoHeight: true,
          spaceBetween: 30,
        },
      },
    });
  });
});

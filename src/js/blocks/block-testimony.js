import Swiper from "../main.js";

// TESTIMONY
document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-testimony").length == 0) {
    return;
  }
  const sectionsTestimony = document.querySelectorAll(".block-testimony");
  sectionsTestimony.forEach((section, index) => {
    const navPrev = section.querySelector(".prev");
    const navNext = section.querySelector(".next");
    const swiperBuffer = section.querySelector(".testimony-swiper");
    const swiperId = `#${section.querySelector(".testimony-swiper").id}`;
    swiperBuffer.classList.add("testimony-swiper" + index);
    const testimonySwiper = new Swiper(`${swiperId}`, {
      loop: true,
      spaceBetween: 30,
      slidesPerView: 1,
      navigation: {
        nextEl: navPrev,
        prevEl: navNext,
      },
      breakpoints: {
        1300: {
          slidesPerView: section.classList.contains("multi") ? 2 : 1,
          spaceBetween: 60,
        },
      },
    });
  });
});

import Swiper from "../main.js";

document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-tabs").length == 0) {
    return;
  }
  const sections = document.querySelectorAll(".block-tabs");

  sections.forEach((section) => {
    const pages = section.querySelector(".swiper-pages");
    const navPrev = section.querySelector(".prev");
    const navNext = section.querySelector(".next");
    const labelsString = pages.dataset.labels;
    const labels = labelsString.split("/-/");
    const swiperId = `#${section.querySelector(".tabs-swiper").id}`;
    const tabsSwiper = new Swiper(`${swiperId}`, {
      spaceBetween: 30,
      autoHeight: true,
      direction: "horizontal",
      slidesPerView: 1,
      navigation: {
        nextEl: navNext,
        prevEl: navPrev,
      },
      pagination: {
        el: pages,
        clickable: true,
        renderBullet: function(index) {
          return `<p class="swiper-pagination-bullet"><span>${labels[index]}</span></p>`;
        },
      },
      breakpoints: {
        1200: {
          observer: true,
          observeParents: true,
          autoHeight: true,
          slidesPerView: 1,
          centeredSlides: true,
          spaceBetween: 0,
          direction: "vertical",
        },
      },
    });
  });
});

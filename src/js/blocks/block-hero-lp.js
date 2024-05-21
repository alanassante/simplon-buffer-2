import Swiper from "../main.js";

document.addEventListener("DOMContentLoaded", function() {
  if (document.getElementsByClassName("block-hero-lp").length > 0) {
    let modules = document.querySelectorAll(".block-hero-lp");
    modules.forEach((module) => {
      const tabs = module.querySelectorAll(".tab");
      const forms = module.querySelectorAll(".form");
      const heroLpSwiper = new Swiper(".hero-lp-swiper", {
        spaceBetween: 90,
        slidesPerView: "auto",
        speed: 3000,
        autoplay: {
          delay: 1,
          disableOnInteraction: false,
        },
        loop: true,
      });
      tabs.forEach((tab, index) => {
        tab.addEventListener("click", function() {
          for (let index2 = 0; index2 < tabs.length; index2++) {
            tabs[index2].classList.remove("active");
            forms[index2].classList.remove("active");
          }
          tabs[index].classList.add("active");
          forms[index].classList.add("active");
        });
      });
    });
  }
});

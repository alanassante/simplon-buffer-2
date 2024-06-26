import Swiper from "../main.js";

// BANNER SWIPER
document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-banner-carousel").length == 0) {
    return;
  }
  const sectionBannerSwipers = document.querySelectorAll(
    ".block-banner-carousel"
  );
  sectionBannerSwipers.forEach((section) => {
    const navPrev = section.querySelector(".banner-swiper-nav-prev");
    const navNext = section.querySelector(".banner-swiper-nav-next");
    const pages = section.querySelector(".banner-swiper-pages");
    const swiperId = `#${section.querySelector(".banner-swiper").id}`;

    const bannerSwiper = new Swiper(`${swiperId}`, {
      spaceBetween: 30,
      direction: "horizontal",
      autoHeight: true,
      navigation: {
        nextEl: navNext,
        prevEl: navPrev,
      },
      pagination: {
        el: pages,
      },
      breakpoints: {
        1245: {
          spaceBetween: 60,
          direction: "vertical",
          autoHeight: true,
          slidesPerView: 1,
        },
      },
      on: {
        init: function() {
          setSlideHeight(this);
          this.update();
        },
        slideChangeTransitionEnd: function() {
          setSlideHeight(this);
          this.update();
        },
      },
    });
    function setSlideHeight(that) {
      console.log($(`${swiperId} .swiper-slide`));
      $(`${swiperId} .swiper-slide`).css({ height: "auto" });
      var currentSlide = that.activeIndex;
      var newHeight = $(that.slides[currentSlide]).height();
      $(`${swiperId} .swiper-wrapper,${swiperId} .swiper-slide`).css({
        height: newHeight,
      });
    }
  });
});

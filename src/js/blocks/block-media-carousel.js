// MEDIA CAROUSEL
import Swiper from "../main.js";

document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-media-carousel").length == 0) {
    return;
  }
  const sectionsMediaCarousel = document.querySelectorAll(
    ".block-media-carousel"
  );
  sectionsMediaCarousel.forEach((section) => {
    const videoWrappers = section.querySelectorAll(".video-wrapper");
    function onYouTubeIframeAPIReady() {
      videoWrappers.forEach((videoWrapper, index) => {
        const cover = videoWrapper.querySelector(".cover");
        if (videoWrapper.querySelector(".iframe")) {
          var player = new YT.Player(
            `${videoWrapper.querySelector(".iframe").id}`,
            {
              videoId: `${
                videoWrapper.querySelector(".iframe").dataset.videoid
              }`,
              events: {
                onReady: function() {
                  cover.addEventListener("click", function(e) {
                    e.preventDefault();
                    if (
                      player.getPlayerState() == -1 ||
                      player.getPlayerState() == 0 ||
                      player.getPlayerState() == 2 ||
                      player.getPlayerState() == 5
                    ) {
                      player.playVideo();
                      cover.classList.add("hidden");
                    } else {
                      player.stopVideo();
                      cover.classList.remove("hidden");
                    }
                  });
                },
              },
            }
          );
        } else {
          const video = videoWrapper.querySelector("video");
          cover.addEventListener("click", function(e) {
            e.preventDefault();
            playVideo(video, cover);
          });
        }
      });
    }

    function playVideo(video, cover) {
      // Video

      if (video.paused) {
        video.play();
        cover.classList.add("hidden");
      } else {
        video.pause();
        cover.classList.remove("hidden");
      }

      // Iframe
    }
    const navPrev = section.querySelector(".prev");
    const navNext = section.querySelector(".next");
    const mediaCarouselSwiper = new Swiper(".media-carousel-swiper", {
      // loop: true,
      spaceBetween: 30,
      slidesPerView: 1,
      navigation: {
        nextEl: navNext,
        prevEl: navPrev,
      },
      allowTouchMove: false,
      breakpoints: {
        1240: {
          slidesPerView: 2,
          spaceBetween: 60,
        },
      },
    });
  });
});

import Swiper from "../main.js";

document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-tabs-lp").length == 0) {
    return;
  }
  const responsiveTrigger = window.matchMedia("(max-width:1300px)");
  const sections = document.querySelectorAll(".block-tabs-lp");

  sections.forEach((section) => {
    const tabsLabels = section.querySelectorAll(".tab");
    const tabsContents = section.querySelectorAll(".content");
    const tabsContentsResponsive = section.querySelectorAll(
      ".content-responsive"
    );
    if (responsiveTrigger.matches) {
      tabsContentsResponsive.forEach((tabsContent, index) => {
        tabsContent.dataset.maxHeight = `${tabsContent.scrollHeight}px`;
        if (index != 0) {
          tabsContent.style.maxHeight = "0px";
        }
        tabsLabels[index].addEventListener("click", function() {
          if (tabsLabels[index].classList.contains("active")) {
            tabsLabels[index].classList.remove("active");
            tabsContentsResponsive[index].style.maxHeight = "0px";
          } else {
            for (
              let index2 = 0;
              index2 < tabsContentsResponsive.length;
              index2++
            ) {
              tabsLabels[index2].classList.remove("active");
              tabsContentsResponsive[index2].style.maxHeight = "0px";
            }
            tabsLabels[index].classList.add("active");
            tabsContentsResponsive[index].style.maxHeight =
              tabsContentsResponsive[index].dataset.maxHeight;
          }
        });
      });
    } else {
      tabsLabels.forEach((tabsLabel, index) => {
        tabsLabel.addEventListener("click", function() {
          for (let index2 = 0; index2 < tabsLabels.length; index2++) {
            tabsLabels[index2].classList.remove("active");
            tabsContents[index2].classList.remove("active");
          }
          tabsLabels[index].classList.add("active");
          tabsContents[index].classList.add("active");
        });
      });
    }
  });
});

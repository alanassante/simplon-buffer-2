document.addEventListener("DOMContentLoaded", function(event) {
  if (!document.querySelectorAll("header")) {
    return;
  }
  const header = document.querySelector("header");
  const mediaQuerry = window.matchMedia("(max-width:1240px)");
  const linksLists = header.querySelectorAll(".sub-nav-item .links-list");
  const subNavItems = header.querySelectorAll(".sub-nav-item");
  const responsiveToggler = header.querySelector(".responsive-toggler");

  const buffer = 70; // vertical scroll distance before nav expands
  const pinOffset = 300; // distance before nav pins and/or fills bg

  let currentScrollY = 0,
    previousScrollY = 0,
    offsetPrev = 0,
    ticking = false,
    currentDirection = "down",
    previousDirection = "down",
    HideToggleFired = false;

  window.addEventListener("scroll", requestTick, false);

  function requestTick() {
    currentScrollY = window.scrollY;
    requestAnimationFrame(update);
  }

  function update() {
    if (currentScrollY > pinOffset && !header.classList.contains("pinNav")) {
      header.classList.add("pinNav");
    } else if (
      currentScrollY <= pinOffset &&
      header.classList.contains("pinNav")
    ) {
      header.classList.remove("pinNav");
    }

    if (currentScrollY < previousScrollY) {
      currentDirection = "up";

      const offset = currentScrollY - previousScrollY;

      if (
        HideToggleFired === false &&
        (offsetPrev <= -buffer || currentScrollY <= pinOffset)
      ) {
        showHideNav();
        HideToggleFired = true;
      }

      if (currentDirection !== previousDirection) {
        offsetPrev = 0;
        HideToggleFired = false;
      }
      offsetPrev += offset;
    } else {
      currentDirection = "down";
      const offset = currentScrollY - previousScrollY;

      if (HideToggleFired === false && offsetPrev >= buffer) {
        showHideNav(true);
        HideToggleFired = true;
      }

      if (currentDirection !== previousDirection) {
        offsetPrev = 0;
        HideToggleFired = false;
      }
      offsetPrev += offset;
    }

    previousDirection = currentDirection;
    previousScrollY = window.scrollY;
  }

  const showHideNav = (slim) => {
    if (slim === true) {
      header.classList.add("slim");
    } else {
      header.classList.remove("slim");
    }
  };

  if (mediaQuerry) {
    responsiveToggler.addEventListener("click", function() {
      header.classList.toggle("open");
    });
    subNavItems.forEach((subNavItem) => {
      const linksList = subNavItem.querySelector(".links-list");
      if (linksList) {
        linksList.dataset.maxHeight = `${linksList.offsetHeight}px`;
        linksList.style.maxHeight = "0px";
        subNavItem.addEventListener("click", function() {
          subNavItem.classList.toggle("open");
          if (linksList.style.maxHeight == "0px") {
            linksLists.forEach((buffer) => {
              buffer.style.maxHeight = "0px";
            });
            linksList.style.maxHeight = `${linksList.dataset.maxHeight}`;
          } else {
            linksList.style.maxHeight = "0px";
          }
        });
      }
    });
  }
});

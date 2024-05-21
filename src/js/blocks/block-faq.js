document.addEventListener("DOMContentLoaded", function() {
  if (document.getElementsByClassName("block-faq").length > 0) {
    let modules = document.querySelectorAll(".block-faq");

    for (let i = 0; i < modules.length; i++) {
      const module = modules[i];
      const accordeons = module.querySelectorAll(".accordeon");

      for (let j = 0; j < accordeons.length; j++) {
        const accordeon = accordeons[j];
        const content = accordeon.querySelector(".accordeon-content");

        accordeon.addEventListener("click", () => {
          // Désactiver toutes les autres accordéons actives
          const activeAccordeons = module.querySelectorAll(".accordeon.active");
          activeAccordeons.forEach((activeAccordeon) => {
            if (activeAccordeon !== accordeon) {
              activeAccordeon.classList.remove("active");
              activeAccordeon.querySelector(
                ".accordeon-content"
              ).style.maxHeight = null;
            }
          });

          // Activer / désactiver cet accordéon
          accordeon.classList.toggle("active");

          if (accordeon.classList.contains("active")) {
            const contentHeight = content.scrollHeight;
            content.style.maxHeight = contentHeight + "px";
          } else {
            content.style.maxHeight = null;
          }
        });
      }
    }
  }
});

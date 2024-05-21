document.addEventListener("DOMContentLoaded", function() {
  if (document.getElementsByClassName("block-timeline-history").length > 0) {
    let modules = document.querySelectorAll(".block-timeline-history");
    for (let i = 0; i < modules.length; i++) {
      const module = modules[i];
      const wrapperCards = module.querySelector(".wrapper-cards");
      const cards = module.querySelectorAll(".card");
      const wrapperDates = module.querySelectorAll(".wrapper-date");
      const activeCard = module.querySelector(".card.active");
      const btnSliders = module.querySelectorAll(".slider-btn");
      const line = module.querySelector(".line");

      let currentIndex = 0;

      // Event slider
      btnSliders.forEach((button) => {
        button.addEventListener("click", () => {
          if (button.classList.contains("prev")) {
            // Bouton prev
            currentIndex = Math.max(currentIndex - 1, 0);
          } else {
            // Bouton suivant
            currentIndex = Math.min(
              currentIndex + 1,
              wrapperCards.children.length - 1
            );
          }
          updateActiveElements();
          displayCard(currentIndex);
          setWidthLine();
        });
      });

      // Event des dates cliquées
      wrapperDates.forEach((date) => {
        date.addEventListener("click", () => {
          let getDateIndex = date.getAttribute("data-index");

          currentIndex = parseInt(getDateIndex - 1);

          if (currentIndex == getDateIndex - 1) {
            // Retirer la classe "active" de tous les éléments wrapperDates
            wrapperDates.forEach((wrapperDate) => {
              wrapperDate.classList.remove("active");
            });

            // Ajouter la classe "active" uniquement à l'élément date actuellement cliqué et affiché la carte correspondante
            date.classList.add("active");
            displayCard(currentIndex);
            setWidthLine();
          }
        });
      });

      // Fonction pour mettre à jour les éléments actifs (dates et cartes)
      const updateActiveElements = () => {
        // Retirer la classe "active" de tous les éléments wrapperDates
        wrapperDates.forEach((wrapperDate, index) => {
          if (index === currentIndex) {
            wrapperDate.classList.add("active");
          } else {
            wrapperDate.classList.remove("active");
          }
        });
      };

      // Fonction pour afficher la carte correspondant à l'index spécifié
      const displayCard = (index) => {
        cards.forEach((card, i) => {
          if (i === index) {
            card.classList.add("active");
          } else {
            card.classList.remove("active");
          }
        });
      };

      // Charger la height du parent en fonction de la card active
      const setHeightWrapperCards = () => {
        let heightWrapperCards = 0;
        const heightActiveCard = activeCard.offsetHeight;
        heightWrapperCards = heightActiveCard;

        wrapperCards.style.height = heightWrapperCards + "px";
      };

      // Configurer les longueurs des timelines en fonction du nombre
      const setWidthWrapperDate = () => {
        if (window.matchMedia("(max-width: 768px)").matches) {
          wrapperDates.forEach((date) => {
            date.style.minWidth = "50vw";
          });
        } else {
          wrapperDates.forEach((date) => {
            date.style.width = 100 / wrapperDates.length + "%";
          });
        }
      };

      // Configurer la longueur de la line active
      const setWidthLine = () => {
        let index = 0;

        wrapperDates.forEach((date) => {
          if (date.classList.contains("active")) {
            index = parseInt(date.getAttribute("data-index"));
            return;
          }
        });

        let widthDate = wrapperDates[0].offsetWidth;
        const sizeLine = (index - 1) * widthDate + widthDate / 2;

        line.style.width = sizeLine + "px";
      };

      setHeightWrapperCards();
      setWidthWrapperDate();
      setWidthLine();

      // ---- MOBILE ----
      if (window.matchMedia("(max-width: 768px)").matches) {
        const wrapperTimeline = module.querySelector(".wrapper-timeline");

        // Configurer la longueur du wrapperTimeline
        const setWidthWrapperTimeline = () => {
          wrapperTimeline.style.width =
            wrapperDates[0].offsetWidth * wrapperDates.length + "px";
        };

        // Event slider
        btnSliders.forEach((button) => {
          button.addEventListener("click", () => {
            const activeDateIndex = Array.from(wrapperDates).findIndex((date) =>
              date.classList.contains("active")
            );
            const translation = -activeDateIndex * 50 + "vw";

            if (button.classList.contains("prev")) {
              wrapperTimeline.style.transform =
                "translate(" + translation + ")";
            } else if (button.classList.contains("next")) {
              wrapperTimeline.style.transform =
                "translate(" + translation + ")";
            }
          });
        });

        setWidthWrapperTimeline();
      }
    }
  }
});

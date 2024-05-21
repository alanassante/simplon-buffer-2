/**
 * Main.js
 *
 * @since 1.0.0
 */

import Swiper from "swiper/bundle";
import "swiper/css/bundle";
export default Swiper;

document.addEventListener("DOMContentLoaded", function(event) {
  //Système de filtrage pour le block listing cards
  const sectionsListing = document.querySelectorAll(".block-listing-cards");
  sectionsListing.forEach((section) => {
    if (section.querySelector("form")) {
      const months = [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Aout",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre",
      ];
      const inputs = section.querySelectorAll(".input");
      const form = section.querySelector("form");

      const activeFiltersTarget = section.getElementsByClassName(
        "target-active-filters"
      )[0];
      const reset = activeFiltersTarget.querySelector(".reset");
      const ajaxurl = form.dataset.action;
      let data = {
        action: section.classList.contains("formations")
          ? "get_formations_filter"
          : "get_events_filter",
        // Formation
        linked_formations: [],
        duree: [],
        domains: [],
        levels: [],
        rythms: [],
        // Event
        months: [],
        countries: [],
        types: [],
        // Both
        distant: [],
        regions: [],
      };
      reset.addEventListener("click", function() {
        inputs.forEach((input) => {
          if (input.tagName === "SELECT") {
            input.selectedIndex = 0;
            const options = input.querySelectorAll("option");
            options.forEach((option) => {
              option.disabled = false;
            });
          }
        });
        const activeFilters = activeFiltersTarget.querySelectorAll(
          ".active-filter"
        );
        activeFilters.forEach((filter) => {
          filter.remove();
        });
        let resetData = {
          action: section.classList.contains("formations")
            ? "get_formations_filter"
            : "get_events_filter",
          // Formation
          linked_formations: [],
          duree: [],
          domains: [],
          levels: [],
          rythms: [],
          // Event
          months: [],
          countries: [],
          types: [],
          // Both
          distant: [],
          regions: [],
        };
        $.ajax({
          type: "POST",
          url: ajaxurl,
          data: resetData,
          success: function(data) {
            section.querySelector(".listing").innerHTML = data;
          },
        });
      });
      inputs.forEach((input) => {
        input.addEventListener("change", function() {
          data[input.dataset.type].push(input.value);
          console.log(data);
          $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function(newData) {
              section.querySelector(".listing").innerHTML = newData;
            },
          });
          if (input.tagName === "SELECT") {
            const options = input.getElementsByTagName("option");
            options[input.selectedIndex].disabled = true;
            let activeFilter = document.createElement("p");
            activeFilter.classList.add("active-filter");
            if (input.dataset.type == "months") {
              activeFilter.innerHTML =
                months[parseInt(options[input.selectedIndex].value) - 1];
            } else {
              activeFilter.innerHTML = options[input.selectedIndex].value;
            }
            activeFilter.dataset.index = input.selectedIndex;
            activeFilter.dataset.type = input.dataset.type;

            activeFiltersTarget.append(activeFilter);

            activeFilter.addEventListener("click", function() {
              options[activeFilter.dataset.index].disabled = false;
              activeFilter.remove();
              data[activeFilter.dataset.type].splice(
                data[activeFilter.dataset.type].indexOf(activeFilter.innerText),
                1
              );
              console.log(data);
              $.ajax({
                type: "POST",
                url: ajaxurl,
                data: data,
                success: function(newData) {
                  section.querySelector(".listing").innerHTML = newData;
                },
              });
            });
          }
        });
      });
    }
  });
});

// BANNER SWIPER

import Swiper from "../main.js";

document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-map").length == 0) return;
  const section_maps = document.querySelectorAll(".block-map");
  section_maps.forEach((section) => {
    const map_wrapper = section.getElementsByClassName("map-wrapper")[0];
    const slides = section.querySelectorAll(".swiper-slide");
    const maps_switchers = section.querySelectorAll(".map-title");
    const slides_buffer = section.querySelector(".slide-buffer");
    const swiper_wrapper = section.querySelector(".swiper-wrapper");
    const veils = section.querySelectorAll(".veil");
    const responsiveTrigger = window.matchMedia("(max-width: 1300px)");
    let currentMapData = section.querySelector(".map-title.active");
    const swiperId = `#${section.querySelector(".map-swiper").id}`;
    // Map icons
    let icon_url = "";
    // Gestion corp
    if (document.getElementsByTagName("body")[0].classList.contains("corp")) {
      icon_url =
        map_wrapper.dataset.iconCorp != ""
          ? map_wrapper.dataset.iconCorp
          : map_wrapper.dataset.iconDefault;
    } else {
      icon_url =
        map_wrapper.dataset.icon != ""
          ? map_wrapper.dataset.icon
          : map_wrapper.dataset.iconDefault;
    }
    // Filtrage des slides en fonction de la map initiale
    filterSlides(
      slides,
      maps_switchers[0].dataset.title,
      slides_buffer,
      swiper_wrapper
    );

    // SWIPER
    const navPrev = section.querySelector(".prev");
    const navNext = section.querySelector(".next");
    const map_swiper = new Swiper(`${swiperId}`, {
      slidesPerView: "auto",
      spaceBetween: 30,
      speed: 300,
      navigation: {
        nextEl: navNext,
        prevEl: navPrev,
      },
    });

    // Initialisation de la carte
    mapboxgl.accessToken =
      "pk.eyJ1IjoieWthcmUiLCJhIjoiY2xzbmRoeHNxMDNjczJsbnMzMHEzbjM5bSJ9.Z9CaYLLQWhrbXMP9xwDUMw";
    let currentZoom = responsiveTrigger.matches
      ? parseFloat(maps_switchers[0].dataset.zoomresponsive)
      : parseFloat(maps_switchers[0].dataset.zoom);
    const map = new mapboxgl.Map({
      container: `${map_wrapper.id}`, // container ID
      style: maps_switchers[0].dataset.map, // style URL
      zoom: currentZoom,
      minZoom: currentZoom,
      maxZoom: parseFloat(maps_switchers[0].dataset.maxzoom),
      pitch: 0,
      center: [maps_switchers[0].dataset.long, maps_switchers[0].dataset.lat],
    });
    // No drag no zoom

    map.boxZoom.disable();
    map.dragRotate.disable();
    responsiveTrigger.matches
      ? map.scrollZoom.disable()
      : map.scrollZoom.enable();
    map.on("style.load", () => {
      map.loadImage(icon_url, (error, image) => {
        if (error) throw error;
        // Add the image to the map style.
        map.addImage("icon", image);
        // Create a popup, but don't add it to the map yet.
        const popup = new mapboxgl.Popup({
          closeButton: false,
          closeOnClick: false,
        });
        let current_slides = section.querySelectorAll(
          ".map-swiper .swiper-wrapper .swiper-slide"
        );
        addLayers(current_slides);
        map.on("zoomend", () => {
          let currentZoom = responsiveTrigger.matches
            ? parseFloat(currentMapData.dataset.zoomresponsive)
            : parseFloat(currentMapData.dataset.zoom);

          if (map.getZoom() - currentZoom <= 0.5) {
            map.easeTo({
              center: [currentMapData.dataset.long, currentMapData.dataset.lat],
              zoom: currentZoom,
            });
          }
        });
        //Au survol d'un point
        map.on("mouseenter", "places", (e) => {
          map.getCanvas().style.cursor = "pointer";

          // Copie des données du point
          const coordinates = e.features[0].geometry.coordinates.slice();
          const description = e.features[0].properties.description;

          // Gestion du zoom et affichage des popups
          while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
          }

          // Informe la popup avec les données du point
          popup
            .setLngLat(coordinates)
            .setHTML(description)
            // Affichage sur la map
            .addTo(map);
        });

        map.on("mouseleave", "places", () => {
          const popupElement = popup.getElement();
          // Si on quitte le survol du marqueur mais reste en survol sur la popup
          if (popupElement.matches(":hover")) {
            // Quand on quitte le survol de la popup
            popupElement.addEventListener("mouseleave", function() {
              popup.remove();
            });
          }
          // Si on quitte le survol du marqueur et de la popup
          else {
            map.getCanvas().style.cursor = "";
            popup.remove();
          }
        });
      });
    });

    // Au click sur selecteur de carte
    maps_switchers.forEach((map_switcher, index) => {
      map_switcher.addEventListener("click", (event) => {
        event.preventDefault;
        event.stopPropagation;
        // Obfuscation du block
        veils.forEach((veil) => {
          veil.animate([{ opacity: 1 }, { opacity: 0 }], 1500);
        });

        // Modification du style des titres
        maps_switchers.forEach((element, index2) => {
          index != index2
            ? element.classList.remove("active")
            : element.classList.add("active");
        });
        currentMapData = section.querySelector(".map-title.active");
        // Update du swiper :  Filtrage des slides
        filterSlides(
          slides,
          map_switcher.dataset.title,
          slides_buffer,
          swiper_wrapper
        );
        map_swiper.update();

        // Update de la map : nouveau style (timeout pour ne pas overlap l'animation)
        setTimeout(updateMap(map_switcher), 1000);
      });
    });

    // Functions

    function updateMap(DOMSource) {
      let currentZoom = responsiveTrigger
        ? DOMSource.dataset.zoomresponsive
        : DOMSource.dataset.zoom;
      map.setZoom(currentZoom);
      map.setMinZoom(currentZoom);
      map.setMaxZoom(DOMSource.dataset.maxzoom);
      map.setCenter([DOMSource.dataset.long, DOMSource.dataset.lat]);
      map.setStyle(DOMSource.dataset.map);
      map.flyTo({
        speed: 1,
        zoom: currentZoom,
      });
    }
    function filterSlides(slides, filterValue, slideBuffer, swiper) {
      slides.forEach((slide) => {
        if (slide.dataset.mapTitle == filterValue) {
          swiper.append(slide);
        } else {
          slideBuffer.append(slide);
        }
      });
    }
    function addLayers(current_slides) {
      let data_geoJSON = generateGeoJSONFromSlides(current_slides);
      console.log(data_geoJSON);
      // Clearing map before adding new layers + source
      if (typeof map.getLayer("clusters") !== "undefined")
        map.removeLayer("clusters");
      if (typeof map.getLayer("cluster-count") !== "undefined")
        map.removeLayer("cluster-count");
      if (typeof map.getLayer("places") !== "undefined")
        map.removeLayer("places");
      if (typeof map.getSource("places") !== "undefined")
        map.removeSource("places");

      map.addSource("places", {
        type: "geojson",
        data: data_geoJSON,
        cluster: true,
        clusterMaxZoom: 8, // Zoom maximum
        clusterRadius: 25, // par défaut 50
      });
      map.addLayer({
        id: "clusters",
        type: "circle",
        source: "places",
        filter: ["has", "point_count"],
        paint: {
          "circle-color": "#ffffff",
          "circle-radius": 20,
          "circle-stroke-width": 7,
          "circle-stroke-color": "#ffffff",
          "circle-stroke-opacity": 0.5,
        },
      });
      // Layer du compte d'élément de chaque cluster
      map.addLayer({
        id: "cluster-count",
        type: "symbol",
        source: "places",
        filter: ["has", "point_count"],
        layout: {
          "text-field": ["get", "point_count_abbreviated"],
          "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
          "text-size": 15,
        },
      });

      // Layer de points n'étant pas en cluster
      map.addLayer({
        id: "places",
        type: "symbol",
        source: "places",
        filter: ["!", ["has", "point_count"]],
        layout: {
          "icon-image": "icon", // reference the image
          "icon-size": 1,
        },
      });
    }
    function generateGeoJSONFromSlides(DOMElementArray) {
      let data_geoJSON = {
        type: "FeatureCollection",
        features: [],
      };
      DOMElementArray.forEach((element) => {
        data_geoJSON.features.push({
          type: "Feature",
          properties: {
            description: `
            <div class='popup'>
            <h4 class="title">${
              element.querySelector(".title")
                ? element.querySelector(".title").innerHTML
                : ""
            }</h4>
            
            <p class="address small" style="background-image:url(${icon_url})">${
              element.querySelector(".address")
                ? element.querySelector(".address").innerHTML
                : ""
            }</p>
            

            ${
              element.querySelector(".cta")
                ? `<a href="${element.querySelector(".cta.secondary").href}" 
            target="${element.querySelector(".cta").target}" 
            rel="noopener" 
            class="cta secondary">
            <span class="cta-label">${
              element.querySelector(".cta-label").innerHTML
            }
            </span>
            </a>`
                : ``
            }
          </div>
          `,
          },
          geometry: {
            type: "Point",
            coordinates: [`${element.dataset.long}`, `${element.dataset.lat}`],
          },
        });
      });
      return data_geoJSON;
    }
  });
});

import { gsap } from "gsap";
const { ScrollTrigger } = require("gsap/dist/ScrollTrigger");
gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", function(event) {
  if (document.getElementsByClassName("block-key-numbers").length == 0) {
    return;
  }

  const blocks = document.querySelectorAll(".block-key-numbers");

  blocks.forEach((block) => {
    const DOMvalues = block.querySelectorAll(".key-value");
    const animationLength = 2000;
    const stepsLength = 10;
    const framesNumber = animationLength / stepsLength;

    ScrollTrigger.create({
      trigger: block,
      once: true,
      onEnter: () => {
        DOMvalues.forEach((DOMvalue) => {
          let finalValue = parseInt(DOMvalue.dataset.value);
          let valueStep = finalValue / framesNumber;
          let currentValue = 0;
          let myInterval = setInterval(function() {
            if (currentValue > finalValue) {
              DOMvalue.innerHTML = `${Math.round(finalValue)}`;
              clearInterval(myInterval);
            } else {
              DOMvalue.innerHTML = `${Math.round(currentValue)}`;
              currentValue += valueStep;
            }
          }, stepsLength); // Adjust the interval based on the final value
        });
      },
    });
  });
});

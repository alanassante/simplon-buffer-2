import { gsap } from "gsap";

const { ScrollTrigger } = require("gsap/dist/ScrollTrigger.js");
const { ScrollSmoother } = require("gsap/dist/ScrollSmoother.js");
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

document.addEventListener("DOMContentLoaded", function(event) {
  if (!document.querySelectorAll(".tech-pattern-wrapper")) {
    return;
  }

  let indexLinesPattern = 1;
  let indexTilesPattern = 1;

  const sections = document.querySelectorAll(["section", "footer"]);
  sections.forEach((section) => {
    const wrappers = section.querySelectorAll(".tech-pattern-wrapper");

    if (wrappers) {
      wrappers.forEach((wrapper, index) => {
        wrapper.classList.add(`pattern-wrapper-${index}`);
        appendPatternToTarget(wrapper, indexLinesPattern, indexTilesPattern);

        if (wrapper.classList.contains("lines-pattern-wrapper")) {
          const pattern = wrapper.querySelector(".lines-pattern");

          if (pattern) {
            animateLinePattern(pattern);
          }
        }
      });
    }
  });
  let smoother = ScrollSmoother.create({
    wrapper: "#smooth-wrapper",
    content: "#smooth-content",
    smooth: 1,
    effects: true,
  });
});

// Functions -------------------
function animateLinePattern(pattern) {
  const groups = pattern.querySelectorAll(".group");

  groups.forEach((group, index) => {
    const dash = group.querySelector(".dash");
    const border = group.querySelector(".border");
    const delta = Math.random() * (index + 1) * 7;

    gsap.to(dash, {
      duration: 2,
      delay: delta,
      strokeDashoffset: 100,
      ease: "power4.in",
      repeat: -1,
      repeatDelay: delta,
    });
    gsap.to(border, {
      duration: 2,
      delay: delta,
      strokeDashoffset: 100,
      ease: "power4.in",
      repeat: -1,
      repeatDelay: delta,
    });
  });
  for (let i = 0; i < groups.length; i++) {}
}

function appendPatternToTarget(target, indexLines, indexTiles) {
  let randomId = Math.floor(Math.random() * 1000);
  if (target.classList.contains("lines-pattern-wrapper")) {
    let additionalStringClass = `lines-pattern-${indexLines}`;

    target.innerHTML = `<svg class="lines-pattern ${additionalStringClass}" width="244" height="387" viewBox="0 0 244 387" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M175.333 0.999994L155.833 18L155.833 74L139.833 91M139.833 91L175.333 127.5M139.833 91L119.333 74L119.333 0.999989M175.333 127.5L175.333 263.5L119.333 318.5L119.333 386.5M175.333 127.5L201.583 103.5M242.333 1L227.833 18L227.833 79.5L201.583 103.5M201.583 103.5L201.583 169L222.333 190L222.333 275L183.833 309.5L183.833 348L222.333 377L222.333 386.5M72.333 384.5L72.333 368L42.583 337M72.333 2.99999L72.333 26M72.333 26L87.833 40.5L87.833 112L106.833 132.5L106.833 203.5L125.583 222M72.333 26L72.333 112M144.333 294.5L144.333 240.5L125.583 222M72.333 112L72.333 151.5L42.583 181.25M72.333 112L39.833 80.5L39.833 40.5L0.833008 2.99998M42.583 181.25L12.833 211L12.833 306L42.583 337M42.583 181.25L42.583 216.5L54.8731 227.5M119.333 368L87.833 337.5L87.833 257L54.8731 227.5M54.8731 227.5L42.583 240.5L42.583 337M125.583 222L144.333 203.5L142.833 137.126L159.833 112"
          stroke="url(#paint0_linear_1375_13134${randomId})"/>
        
        <g class="group-1 group">
          <path class="dash"d="M72.333 384.5L72.333 368L42.583 337L12.833 306L12.833 211L42.583 181.25L72.333 151.5L72.333 112L39.833 80.5L39.833 40.5L0.833008 2.99999"/>
          <path class="border"d="M72.333 384.5L72.333 368L42.583 337L12.833 306L12.833 211L42.583 181.25L72.333 151.5L72.333 112L39.833 80.5L39.833 40.5L0.833008 2.99999"/>
        </g>
        <g class="group-2 group">
          <path class="dash" d="M72.333 3L72.333 26L72.333 112L72.333 151.5L42.583 181.25L42.583 216.5L54.8731 227.5L87.833 257L87.833 337.5L119.333 368L119.333 386.494"/>
          <path class="border" d="M72.333 3L72.333 26L72.333 112L72.333 151.5L42.583 181.25L42.583 216.5L54.8731 227.5L87.833 257L87.833 337.5L119.333 368L119.333 386.494"/>
        </g>
        <g class="group-3 group">
          <path class="dash" d="M175.333 1L155.833 18L155.833 74L139.833 91L160.092 111.831L142.833 137.126L144.333 203.5L125.583 222L144.333 240.5L144.333 293.94L119.333 318.5L119.333 386.5"/>
          <path class="border" d="M175.333 1L155.833 18L155.833 74L139.833 91L160.092 111.831L142.833 137.126L144.333 203.5L125.583 222L144.333 240.5L144.333 293.94L119.333 318.5L119.333 386.5"/>
        </g>
        <g class="group-4 group">
          <path class="dash" d="M119.333 386.5L119.333 318.5L175.333 263.5L175.333 127.5L139.833 91L119.333 74L119.333 0.999995"/>
          <path class="border" d="M119.333 386.5L119.333 318.5L175.333 263.5L175.333 127.5L139.833 91L119.333 74L119.333 0.999995"/>
        </g>
        <g class="group-5 group">
          <path class="dash" d="M175.333 1L155.833 18L155.833 74L139.833 91L175.333 127.5L175.333 263.5L119.333 318.5L119.333 386.5"/>
          <path class="border" d="M175.333 1L155.833 18L155.833 74L139.833 91L175.333 127.5L175.333 263.5L119.333 318.5L119.333 386.5"/>
        </g>
        <g class="group-6 group">
          <path class="dash" d="M242.333 1L227.833 18L227.833 79.5L201.583 103.5L201.583 169L222.333 190L222.333 275L183.833 309.5L183.833 348L222.333 377L222.333 386.5"/>
          <path class="border" d="M242.333 1L227.833 18L227.833 79.5L201.583 103.5L201.583 169L222.333 190L222.333 275L183.833 309.5L183.833 348L222.333 377L222.333 386.5"/>
        </g>
        <defs>
          <linearGradient id="paint0_linear_1375_13134${randomId}" x1="163" y1="383.5" x2="163" y2="2" gradientUnits="userSpaceOnUse">
            <stop offset="0.37" />
            <stop offset="1" />
          </linearGradient>
        </defs>
      </svg>`;
    indexLines++;
  } else if (target.classList.contains("tiles-pattern-wrapper")) {
    let additionalStringClass = `tiles-pattern-${indexTiles}`;

    target.innerHTML = `<svg class="tiles-pattern 
        ${additionalStringClass}
        " width="597" height="529" viewBox="0 0 597 529" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g>
            <rect data-speed="0.7" width="200" height="200" rx="20" transform="matrix(-1 0 0 1 600 0)" fill="url(#paint1_linear_792_889${randomId})"/>
            <rect data-speed="0.9" width="200" height="200" transform="matrix(-1 0 0 1 400 175)" fill="url(#paint1_linear_792_889${randomId})"/>
            <rect data-speed="0.9" width="200" height="200" rx="60" transform="matrix(-1 0 0 1 200 0)" fill="url(#paint1_linear_792_889${randomId})"/>
            <rect data-speed="1" width="200" height="200" rx="10" transform="matrix(-1 -8.74228e-08 -8.74228e-08 1 200 329)" fill="url(#paint1_linear_792_889${randomId})"/>
        </g>
        <defs>
            <linearGradient id="paint1_linear_792_889${randomId}" x1="100" y1="0" x2="100" y2="200" gradientUnits="userSpaceOnUse">
                <stop stop-opacity="0.65"/>
                <stop offset="1" stop-opacity="0"/>
            </linearGradient>
            
        </defs>
      </svg>`;
    indexTiles++;
  }
}

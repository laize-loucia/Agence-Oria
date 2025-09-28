window.addEventListener("DOMContentLoaded", init, false);

function init() {

  adjustLandingWithScroll();

  window.addEventListener("scroll", function() {
    adjustLandingWithScroll();
  });

  function adjustLandingWithScroll() {
    adjustLandingForegroundWithScroll();
    adjustLandingBackgroundWithScroll();
  }

  function adjustLandingForegroundWithScroll() {
    const distance = window.scrollY;
    const selectorLandingBackground = `section#landing > div.foreground`;
    const xNameLandingBackground = `--offset-x`;
    const yNameLandingBackground = `--offset-y`;
    const xValueLandingBackground = `${distance * -0.25 - 25}%`;
    const yValueLandingBackground = `${distance * -0.15 - 20}vh`;
    const el = document.querySelector(selectorLandingBackground);
    el.style.setProperty(
      xNameLandingBackground,
      xValueLandingBackground
    );
    el.style.setProperty(
      yNameLandingBackground,
      yValueLandingBackground
    );
  }
  function adjustLandingBackgroundWithScroll() {
    const distance = window.scrollY;
    const selectorLandingBackground = `section#landing > div.background`;
    const yNameLandingBackground = `--offset-y`;
    //const propertyValueLandingBackground = `${distance * 0.02}em`;
    const yValueLandingBackground = `${distance * 0.045}vh`;
    document.querySelector(selectorLandingBackground).style.setProperty(
      yNameLandingBackground,
      yValueLandingBackground
    );
  }
}
window.addEventListener("DOMContentLoaded", init, false);

function init() {

  const selectorReference = `section#process .timeline`;
  const elReference = document.querySelector(
    selectorReference
  );
  const selectorTimelineWrapper = `section#process .timeline-wrapper`;
  const elTimelineWrapper = document.querySelector(
    selectorTimelineWrapper
  );

  const maxHeightPropertyName = `--max-height`;

  adjustTimelineWithScroll();

  window.addEventListener("scroll", function() {
    adjustTimelineWithScroll();
  });
  
  function adjustTimelineWithScroll() {

    if ((!elTimelineWrapper) || (!elReference)) {
      return;
    }
    const percentageInViewport = percentageOfElInViewport(elReference, 1.125, 4);
    //console.log(percentageInViewport);
    const referenceHeightPx = getComputedStyle(elReference).height.replace('px', '');
    //console.log(referenceHeightPx);

    let maxHeightPropertyValue = `0px`;
    let mult = 0;
    /*if (percentageInViewport >= 100) {
      maxHeightPropertyValue = `100%`;
    } else if (percentageInViewport > 80) {
      maxHeightPropertyValue = `80%`;
    } else if (percentageInViewport > 60) {
      maxHeightPropertyValue = `60em`;
    } else if (percentageInViewport > 40) {
      maxHeightPropertyValue = `40em`;
    } else if (percentageInViewport > 20) {
      //maxHeightPropertyValue = `20em`;
      mult = 20;
      maxHeightPropertyValue = `${mult * referenceHeightPx / 100}px`;
      console.log(`${mult} * ${referenceHeightPx} / 100}px`);
      console.log(maxHeightPropertyValue);
    }*/
    /*if (percentageInViewport >= 100) {
      mult = 100;
    } else if (percentageInViewport > 80) {
      mult = 80;
    } else if (percentageInViewport > 60) {
      mult = 60;
    } else if (percentageInViewport > 40) {
      mult = 40;
    } else if (percentageInViewport > 20) {
      mult = 20;
    }*/
    if ((percentageInViewport >= 100) ||
      (percentageInViewport > 80) ||
      (percentageInViewport > 60) ||
      (percentageInViewport > 40) ||
      (percentageInViewport > 20)) {
      mult = percentageInViewport;
    }
    //mult = percentageInViewport;
    maxHeightPropertyValue = `${mult * referenceHeightPx / 100}px`;
    //console.log(`${mult} * ${referenceHeightPx} / 100}px`);
    //console.log(maxHeightPropertyValue);
    elTimelineWrapper.style.setProperty(
      maxHeightPropertyName,
      maxHeightPropertyValue
    );
    
    /*const distance = window.scrollY;
    const maxHeightPropertyName = `--max-height`;
    const maxHeightPropertyValue = `${distance * 0.045}vh`;
    //const propertyValueLandingBackground = `${distance * 0.02}em`;
    elTimelineWrapper.style.setProperty(
      maxHeightPropertyName,
      maxHeightPropertyValue
    );*/
  }

  // https://stackoverflow.com/questions/20223243/js-get-percentage-of-an-element-in-viewport

  function percentageOfElInViewport(el, cheatStartValue=null, cheatEndValue=null) {
    if (!el) {
      return;
    }
    // Get the relevant measurements and positions
    const viewportHeight = window.innerHeight;
    //const viewportHeight = window.innerHeight/2;
    const scrollTop = window.scrollY;
    const elementOffsetTop = el.offsetTop;
    const elementHeight = el.offsetHeight;
  
    // Calculate percentage of the element that's been seen
    let distance = 0;
    if (cheatStartValue) {
      distance = (scrollTop + viewportHeight/cheatStartValue) - elementOffsetTop;
    } else {
      distance = (scrollTop + viewportHeight) - elementOffsetTop;
    }

    let percentage = 0;
    if (cheatEndValue) {
      percentage = Math.round(distance / ((viewportHeight/cheatEndValue + elementHeight) / 100));
    } else {
      percentage = Math.round(distance / ((viewportHeight + elementHeight) / 100));
    }
  
    // Restrict the range to between 0 and 100
    return Math.min(100, Math.max(0, percentage));    
  }

  /*adjustLandingWithScroll();

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
  }*/
}
window.addEventListener("DOMContentLoaded", init, false);

function init() {

  // https://chriskirknielsen.com/blog/animate-an-svg-inner-stroke/

  /*let mouseOverContainer = document.querySelector(".project-card");
  let ex1Layer = document.querySelector(".project-card");*/
  //const constrain = 20;
  /*const constrainX = 21;
  const constrainY = 8;*/
  const constrainX = 30;
  const constrainY = 18;
  const perspective = "600px";
  const elsHoverableContainers = document.querySelectorAll(".project-card");
  //const layerEls = elsHoverableContainers;

  function getRotate3DTransformString(xVal, yVal, perspective = "660px") {
    return `perspective(${perspective}) rotateX(${xVal}deg) rotateY(${yVal}deg) `;
  }

  function transforms(x, y, el) {
    let box = el.getBoundingClientRect();
    let calcX = -(y - box.y - (box.height / 2)) / constrainX;
    let calcY = (x - box.x - (box.width / 2)) / constrainY;
    
    return getRotate3DTransformString(calcX, calcY, perspective);
  };

  function transformElement(el, xyEl) {
    el.style.transform = transforms.apply(null, xyEl);
  }

  elsHoverableContainers.forEach((elHoverableContainer) => {
    elHoverableContainer.onmouseenter = function(e) {
      if (this.classList.contains("transition-slow")) {
        this.classList.remove("transition-slow");
      }
    }
    elHoverableContainer.onmouseleave = function(e) {
      if (!this.classList.contains("transition-slow")) {
        this.classList.add("transition-slow");
      }
      this.style.transform = getRotate3DTransformString(0, 0, perspective);
    }
    elHoverableContainer.onmousemove = function(e) {
      const elLayer = this;
      const xy = [e.clientX, e.clientY];
      const position = xy.concat([elLayer]);

      window.requestAnimationFrame(function(){
        transformElement(elLayer, position);
      });
    };
  });

}
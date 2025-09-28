window.addEventListener("DOMContentLoaded", init, false);

function init() {
  const elWrapper = document.querySelector('#lettersHeadband > .wrapper');
  let elLastCol = document.querySelector('#lettersHeadband .lettersColumn:last-child');
  

  self.setInterval(() => {
    const selectorWrapper = "section#landing #lettersHeadband > .wrapper";
    const elWrapper = document.querySelector(selectorWrapper);
    let leftValue = elWrapper.style.left;
    if (leftValue=="") {
      leftValue = "0";
    }
    leftValue = leftValue.replace("px", "");
    leftValue = (parseFloat(leftValue) - 1.6);
    leftValue = String(leftValue) + "px";
    elWrapper.style.left = leftValue;
    
    let count = 0;
    const maxCount = 90;
    while ((isElementInViewport_RightSide(elLastCol)) && (count < maxCount)) {
      elLastCol = elWrapper.appendChild(elLastCol.cloneNode(true));
      count++;
    }
    
    const listFirst24Cols = document.querySelectorAll('#lettersHeadband .lettersColumn:not(:nth-child(n + 24)):not(.dead)');
    /*let nb = 0;
    listFirst24Cols.forEach((elCol) => {
      if (!isElementInViewport_LeftSide(elCol)) {
        nb++;
      }
    });
    console.log(nb);*/
    //console.log(listFirst24Cols);
    const index = listFirst24Cols.length - 1;
    if (listFirst24Cols[index]) {
      //console.log(isElementInViewport_LeftSide(listFirst24Cols[index]));
      
      if (!isElementInViewport_LeftSide(listFirst24Cols[index])) {
        //console.log("YOUPI");
        try {
        listFirst24Cols.forEach((elCol) => {
          //elCol.remove();
          elCol.style.display = "none";
          elCol.classList.add('dead');
        });
        } catch (e) {
          console.log("burp");
        }
      }
    }
  }, 120);


  const nbMaxGowingLetters = 5;

  self.setInterval(() => {

    let listGlowingLetters = elWrapper.querySelectorAll(`p.glow`);
    const listCommonLetters = elWrapper.querySelectorAll(`p:not(.glow):not(.dead)`);
    updateLettersStates(listGlowingLetters);

    while (listGlowingLetters.length >= nbMaxGowingLetters) {
      //const backwardIndex = 0;
      const backwardIndex = getRandomInt(0, (listGlowingLetters.length - 1));
      const elLetterBackward = listGlowingLetters[backwardIndex];
      //const listGlowingLetters = elWrapper.querySelector(`p.glow:first-of-type`);
      elLetterBackward.classList.remove("glow");
      listGlowingLetters = elWrapper.querySelectorAll(`p.glow`);
    }

    const forwardIndex = getRandomInt(0, (listCommonLetters.length - 1));
    const elLetterForward = listCommonLetters[forwardIndex];
    elLetterForward.classList.add("glow");
    elLetterForward.classList.add("keepAlive");
    elLetterForward.classList.add("state-0");

    

  }, 500);

  function updateLettersStates(listGlowingLetters) {
    // TO DO: array checks
    // OR Typescript yay
    try {
      listGlowingLetters.forEach((elGlowingLetter) => {
        
      });
    } catch (e) {
      console.log("erororooror while updating states!!!");
    }
  }


  function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

  function isElementInViewport_LeftSide (el) {
      var rect = el.getBoundingClientRect();
      return (rect.right > 0);
  }
  function isElementInViewport_RightSide (el) {
    var rect = el.getBoundingClientRect();
    return (rect.left < window.innerWidth);
  }


  /*let count = 0;
  const maxCount = 90;
  while ((isElementInViewport_RightSide(elLastCol)) && (count < maxCount)) {
    elLastCol = elWrapper.appendChild(elLastCol.cloneNode(true));
    count++;
  }*/
  //elWrapper.appendChild(elLastCol.cloneNode(true));
    
  /*
  self.setInterval(() => {
    if ((isElementInViewport_RightSide(elLastCol)) && (count < maxCount)) {
      elLastCol = elLettersHeadband.appendChild(elLastCol.cloneNode(true));
      elLettersHeadband.scrollTo(elLettersHeadband.scrollLeft - elLastCol.getBoundingClientRect().width, 0);
      //elLastCol = elLettersHeadband.appendChild( newColEl() );
      count++;
    }
  }, 500);
  */


  /*
  self.setInterval(() => {
    const elFirstCol = document.querySelector('#lettersHeadband .lettersColumn:not(.out):nth-of-type(1)');
    const elSecondCol = document.querySelector('#lettersHeadband .lettersColumn:not(.out):nth-of-type(2)');

    elLettersHeadband.scrollTo(elLettersHeadband.scrollLeft + 1.5, 0);
    if(elSecondCol) {
      if(!isElementInViewport_LeftSide(elSecondCol)){
        console.log("heyyyyyy");
        elLettersHeadband.appendChild(elSecondCol.cloneNode(true));
        //elLettersHeadband.scrollTo(elLettersHeadband.scrollLeft - elSecondCol.getBoundingClientRect().width, 0);
        
      }
    }
      
  }, 30);
  */

  
  /*self.setInterval(() => {
    const elFirstCol = document.querySelector('#lettersHeadband .lettersColumn');

    if(!isElementInViewport_LeftSide(elFirstCol)){
      elLettersHeadband.appendChild(elFirstCol.cloneNode(true));
      elLettersHeadband.scrollTo(elLettersHeadband.scrollLeft - elFirstCol.getBoundingClientRect().width, 0);
      elFirstCol.remove();
    }
    
    if (elLettersHeadband.scrollLeft !== lettersHeadbandScrollWidth) {
      elLettersHeadband.scrollTo(elLettersHeadband.scrollLeft + 1, 0);
    }

    console.log(elLettersHeadband.children.length)
      
  }, 100);*/
  



}
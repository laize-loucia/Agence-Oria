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
    const index = listFirst24Cols.length - 1;
    if (listFirst24Cols[index]) {
      if (!isElementInViewport_LeftSide(listFirst24Cols[index])) {
        try {
        listFirst24Cols.forEach((elCol) => {
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
      const backwardIndex = getRandomInt(0, (listGlowingLetters.length - 1));
      const elLetterBackward = listGlowingLetters[backwardIndex];
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
  



}
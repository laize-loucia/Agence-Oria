window.addEventListener("DOMContentLoaded", init, false);

function init() {
  const wrapperMovementInterval = 120;
  const pxPerInterval = 1.6;
  const elWrapper = document.querySelector('#lettersHeadband > .wrapper');
  let elLastCol = document.querySelector('#lettersHeadband .lettersColumn:last-child');
  
  let columnNumber = 1;
  addNecessaryColumns(255);

  self.setInterval(() => {
    updateWrapperLeft();
    addNecessaryColumns();
    //removeFirstNColumns();
    //removeUnusedCols();
    // debug_FirstColumnInViewPort();
  }, wrapperMovementInterval);


  const glowInterval = 360;
  const nbMaxGowingLetters = 6;
  const minKeepAlive = 4;
  const maxKeepAlive = 10;
  const keepAliveStatePrefix = `keepAlive-state-`;

  self.setInterval(() => {

    removeUnusedCols();
    randomTempGlowStyle();

  }, glowInterval);






  
  function removeUnusedCols() {
    const elsAliveCols = document.querySelectorAll(`.lettersColumn:not(.dead)`);
    let stop = false;
    elsAliveCols.forEach((elCol) => {
      if (!stop) {
        if (isElementInViewport_LeftSide(elCol)) {
          stop = true;
        } else {
          elCol.remove();
        }
      }
    });
  }

  
  function randomTempGlowStyle() {

    updateKeepAliveStates();
    //randomRemoveTempGlowStyle();
    removeTempGlowStyle();
    randomApplyNewTempGlowStyle();

  }

  function updateKeepAliveStates() {
    const listTempGlowingLettersWithUpdatableState = elWrapper.querySelectorAll(
      `p.glow-1[class^="${keepAliveStatePrefix}"]:not(.${keepAliveStatePrefix}0),
      p.glow-1[class*="${keepAliveStatePrefix}"]:not(.${keepAliveStatePrefix}0)`
    );

    listTempGlowingLettersWithUpdatableState.forEach((elLetter) => {
      let wasUpdated = false;
      elLetter.classList.forEach((className) => {
        if ((!wasUpdated) && (className.startsWith(`${keepAliveStatePrefix}`))) {
          let stateNum = className.replace(keepAliveStatePrefix, "");
          stateNum = parseInt(stateNum);
          stateNum--; // stateNum cannot be <0
          elLetter.classList.add(`${keepAliveStatePrefix}${stateNum}`);
          elLetter.classList.remove(className);
          wasUpdated = true;
        }
      });
    });
  }


  function removeTempGlowStyle() {
    const listTempGlowingLettersRemovables = elWrapper.querySelectorAll(
      `p.glow-1.${keepAliveStatePrefix}0,
      p.glow-1.${keepAliveStatePrefix}0`
    );

    listTempGlowingLettersRemovables.forEach((elLetter) => {
      if (elLetter.classList.contains(`glow-1`)) {
        elLetter.classList.remove(`glow-1`);
      }
      if (elLetter.classList.contains(`${keepAliveStatePrefix}0`)) {
        elLetter.classList.remove(`${keepAliveStatePrefix}0`);
      }
    });
  }

  function randomRemoveTempGlowStyle() {
    const listTempGlowingLettersRemovables = elWrapper.querySelectorAll(
      `p.glow-1.${keepAliveStatePrefix}0,
      p.glow-1.${keepAliveStatePrefix}0`
    );
    console.log(listTempGlowingLettersRemovables);

    if (listTempGlowingLettersRemovables.length >= nbMaxGowingLetters) {
      const elTargetLetter = listTempGlowingLettersRemovables[
        getRandomInt(0, listTempGlowingLettersRemovables.length-1)
      ];
      if (elTargetLetter.classList.contains(`glow-1`)) {
        elTargetLetter.classList.remove(`glow-1`);
      }
    }
  }

  function randomApplyNewTempGlowStyle() {
    const listNonGlowingLetters = elWrapper.querySelectorAll(
      `p:not([class^="glow"]),
      p:not([class*="glow"])`
    );
    const listTempGlowingLetters = elWrapper.querySelectorAll(
      `p.glow-1`
    );

    if (listTempGlowingLetters.length < nbMaxGowingLetters) {
      if (listNonGlowingLetters.length > 0) {
        const elTargetLetter = listNonGlowingLetters[getRandomInt(0, listNonGlowingLetters.length-1)];
        if (!checkLetterGlow(elTargetLetter)) {
          elTargetLetter.classList.add(`glow-1`);
          const keepAliveNum = getRandomInt(
            minKeepAlive,
            maxKeepAlive
          );
          elTargetLetter.classList.add(`${keepAliveStatePrefix}${keepAliveNum}`);
        }
      }
    }
  }




  function addNecessaryColumns(maxCount = 90) {
    let count = 0;
    while ((isElementInViewport_RightSide(elLastCol)) && (count < maxCount)) {
      elLastCol = elWrapper.appendChild(elLastCol.cloneNode(true));
      elLastCol.style.setProperty(
        `--column-number`, columnNumber
      );
      randomPermanentGlowStyle(elLastCol);

      columnNumber++;
      count++;
    }
  }
  function removeFirstNColumns(n = 48) {
    const elNCol = document.querySelector(`#lettersHeadband .lettersColumn:nth-child(${n})`);
    if (elNCol) {
      if (!isElementInViewport_LeftSide(elNCol)) {
        const elNCols = document.querySelectorAll(`#lettersHeadband .lettersColumn:nth-child(-n+${n})`);
        elNCols.forEach((elCol) => {
          elCol.remove();
        });
      }
    }
  }


  function updateWrapperLeft() {
    let leftValue = elWrapper.style.left;
    if (leftValue=="") {
      leftValue = "0";
    }
    leftValue = leftValue.replace("px", "");
    leftValue = (parseFloat(leftValue) - pxPerInterval);
    leftValue = String(leftValue) + "px";
    elWrapper.style.left = leftValue;
  }






  function randomPermanentGlowStyle(elCol) {
    removeAllGlowStyle(elCol);
    const maxGlowingLettersPerCol = 1;
    for (let i=0; i<maxGlowingLettersPerCol; i++) {
      const ratioShouldGlowPermanent = 2;
      const shouldGlow = getRandomInt(0, ratioShouldGlowPermanent);
      if ((elCol.children.length > 0) && (shouldGlow)) {
        const elTargetLetter = elCol.children[getRandomInt(0, elCol.children.length-1)];
        const targetGlowClassName = `glow-${getRandomInt(2, 4)}`;
        if (elTargetLetter) {
          let isAlreadyGlowing = checkLetterGlow(elTargetLetter);
          if (!isAlreadyGlowing) {
            elTargetLetter.classList.add(targetGlowClassName);
          }
        }
      }
    }
  }
  function removeAllGlowStyle(elCol) {
    for (var i=0; i<elCol.children.length; i++) {
      const elLetter = elCol.children[i];
      elLetter.classList.forEach((className) => {
        if (className.startsWith(`glow`)) {
          elLetter.classList.remove(className);
        }
      });
    };
  }

  function checkLetterGlow(elLetter) {
    let isGlowing = false;
    elLetter.classList.forEach((className) => {
      if ((!isGlowing) && (className.startsWith(`glow`))) {
        isGlowing = true;
      }
    });
    return isGlowing;
  }




  // -----------------------
  // DEBUG

  function debug_FirstColumnInViewPort() {
    const elCols = document.querySelectorAll(`#lettersHeadband .lettersColumn`);
    let done = false;
    for(let i=0; i<elCols.length; i++){
      const elCol = elCols[i];
      if (!done) {
        if (isElementInViewport_LeftSide(elCol)) {
          console.log(i);
          done = true;
        }
      }
    };
  }


    
  // -----------------------
  // Should be in module

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
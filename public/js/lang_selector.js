window.addEventListener("DOMContentLoaded", init, false);

function init() {
  const lang = document.querySelector(`html`).getAttribute(`lang`).toLowerCase();
  const elLangSelectorBtn = document.querySelector(`#lang-selector`);
  if (elLangSelectorBtn) {
    elLangSelectorBtn.addEventListener(`click`, () => {
      switch (lang) {
        case "fr":
          window.location.href = `./en/`;
          break;
        default:
          window.location.href = `../`;
      }
    }, false);
  }
}
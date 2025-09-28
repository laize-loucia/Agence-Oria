window.addEventListener("DOMContentLoaded", init, false);

function init() {
  const elsSelectableItems = document.querySelectorAll(`section#services.preview .subjects > .item`);
  const elsServiceAssociatedBtns = document.querySelectorAll(
    `section#services.preview #subjects-associated-btns [class^="field-"],
    section#services.preview #subjects-associated-btns [class*="field-"]`
  );
  const subjectNamePrefix = `subject-`;
  
  elsSelectableItems.forEach((elItem) => {
    elItem.addEventListener(`click`, () => {
      removeSelectedInEls(elsSelectableItems);
      removeSelectedInEls(elsServiceAssociatedBtns);
      if (!elItem.classList.contains(`selected`)) {
        elItem.classList.add(`selected`);
      }
      const subjectName = elItem.id.replace(subjectNamePrefix, ``);
      const elServiceAssociatedBtns = document.querySelector(
        `section#services.preview #subjects-associated-btns .field-${subjectName}`
      );
      if (!elServiceAssociatedBtns.classList.contains(`selected`)) {
        elServiceAssociatedBtns.classList.add(`selected`);
      }
    }, false);
  });

  function removeSelectedInEls(els) {
    els.forEach((el) => {
      if (el.classList.contains(`selected`)) {
        el.classList.remove(`selected`);
      }
    });
  }
}
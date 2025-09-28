window.addEventListener("DOMContentLoaded", init, false);

function init() {

  const WEBSITE_MENU_STATUS_ATTR_NAME = `data-websitemenu-status`;
  const WEBSITE_MENU_STATUS_OPENED = `opened`;
  const WEBSITE_MENU_STATUS_CLOSED = `closed`;

  const elBody = document.querySelector('body');
  const elBurgerMenu = document.querySelector('body > header #websiteMenu-btn');
  const elDisablingLayer = document.querySelector('body > .disablingLayer');
  const elsMenuItems = document.querySelectorAll('body > header .websiteMenu a[href]');

  elBurgerMenu.addEventListener('click', () => {
    handleWebsiteMenuBtnClick();
  }, false);
  elDisablingLayer.addEventListener('click', () => {
    openCloseWebsiteMenu();
  }, false);
  elsMenuItems.forEach((el) => {
    el.addEventListener('click', () => {
      openCloseWebsiteMenu();
    }, false);
  });
  
  function handleWebsiteMenuBtnClick() {
    if (!elBody) {
      return;
    }
    let open = true;
    switch (elBody.getAttribute(WEBSITE_MENU_STATUS_ATTR_NAME)) {
      case WEBSITE_MENU_STATUS_OPENED:
        open = false;
        break;
    }
    openCloseWebsiteMenu(open);
  }
  function openCloseWebsiteMenu(open=false) {
    if (!elBody) {
      return;
    }
    let statusValue = "opened";
    if (!open) {
      statusValue = "closed";
    }
    elBody.setAttribute(WEBSITE_MENU_STATUS_ATTR_NAME, statusValue);
  }
}
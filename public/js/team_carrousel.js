window.addEventListener("DOMContentLoaded", init, false);

function init() {

  const track = document.querySelector('.carrousel-track');
  const prevButton = document.querySelector('.carrousel-btn.prev');
  const nextButton = document.querySelector('.carrousel-btn.next');

  if ((!track) || (!prevButton) || (!nextButton)) {
    return;
  }
  
  let currentSlide = 0; 

  nextButton.addEventListener('click', () => {
      if (currentSlide < 2) { // Nombre total de slides - 1
          currentSlide++;
      } else {
          currentSlide = 0; // Retour au début
      }
      updateCarrousel();
  });

  // Bouton précédent
  prevButton.addEventListener('click', () => {
      if (currentSlide > 0) {
          currentSlide--;
      } else {
          currentSlide = 2; // Retour à la dernière slide
      }
      updateCarrousel();
  });

  function updateCarrousel() {
      const slideWidth = document.querySelector('.carrousel').offsetWidth;
      track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
  }

  
}
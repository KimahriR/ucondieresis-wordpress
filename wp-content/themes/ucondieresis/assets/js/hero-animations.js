/**
 * Hero Letter Animation
 * 
 * Staggered animation: cada letra entra secuencialmente
 * desde el fondo hacia arriba (slideUp effect)
 * 
 * Performance: Uses CSS animations, not JavaScript loops
 * Browser Support: Modern browsers (Chrome, Firefox, Safari, Edge)
 */

(function () {
  'use strict';

  // Esperar a que el DOM esté listo
  document.addEventListener('DOMContentLoaded', function () {
    animateHeroLetters();
  });

  /**
   * Animar las letras del hero
   * Cada letra obtiene un delay progresivo
   */
  function animateHeroLetters() {
    const heroTitle = document.querySelector('.hero__title');
    
    if (!heroTitle) return;

    // Obtener el texto original
    const originalText = heroTitle.textContent.trim();
    
    // Limpiar el contenido actual
    heroTitle.innerHTML = '';

    // Crear spans para cada letra (incluyendo espacios)
    const letters = originalText.split('');
    
    letters.forEach((letter, index) => {
      const span = document.createElement('span');
      span.textContent = letter;
      span.className = 'hero-letter';
      span.style.animationDelay = `${index * 0.05}s`;
      heroTitle.appendChild(span);
    });

    // Trigger reflow para que la animación se aplique correctamente
    void heroTitle.offsetWidth;

    // Agregar la clase de animación después de un pequeño delay para asegurar que se dispare
    heroTitle.classList.add('hero-animate');
  }
})();

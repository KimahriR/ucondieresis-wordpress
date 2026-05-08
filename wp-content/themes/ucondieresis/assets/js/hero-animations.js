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
   * Detectar si la navegación fue una recarga (reload)
   * y forzar el scroll al hero cuando la página termine de cargar.
   */
  function isPageReload() {
    try {
      if (performance && performance.getEntriesByType) {
        const navEntries = performance.getEntriesByType('navigation');
        if (navEntries && navEntries.length) {
          return navEntries[0].type === 'reload';
        }
      }
      // Fallback (deprecated API)
      if (performance && performance.navigation) {
        return performance.navigation.type === performance.navigation.TYPE_RELOAD;
      }
    } catch (e) {
      return false;
    }
    return false;
  }

  window.addEventListener('load', function () {
    const hero = document.querySelector('.hero');
    if (!hero) return;

    // Solo forzar scroll si la navegación fue una recarga
    if (isPageReload()) {
      // Evitar que el navegador restaure la posición por defecto
      if ('scrollRestoration' in history) {
        try { history.scrollRestoration = 'manual'; } catch (e) {}
      }

      // Pequeño delay para asegurar que layout esté listo
      setTimeout(() => {
        hero.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 80);
    }
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

    // Crear spans para cada letra (incluyendo espacios).
    // Reemplazamos los espacios por non-breaking-space para preservarlos visualmente.
    const letters = originalText.split('');

    letters.forEach((letter, index) => {
      const span = document.createElement('span');
      span.className = 'hero-letter';
      // Preservar espacios visibles en el DOM
      if (letter === ' ' || letter === '\t' || letter === '\n') {
        span.textContent = '\u00A0';
        span.classList.add('hero-space');
      } else {
        span.textContent = letter;
      }
      span.style.animationDelay = `${index * 0.05}s`;
      heroTitle.appendChild(span);
    });

    // Trigger reflow para que la animación se aplique correctamente
    void heroTitle.offsetWidth;

    // Agregar la clase de animación después de un pequeño delay para asegurar que se dispare
    heroTitle.classList.add('hero-animate');
  }
})();

/**
 * Inspiracion Social Carousel
 * 
 * Maneja la navegación del carrusel horizontal en la sección de inspiraciones
 */

(function () {
    'use strict';

    function initCarousel() {
        const carousel = document.getElementById('inspiracion-carousel');
        const prevBtn = document.getElementById('inspiracion-prev');
        const nextBtn = document.getElementById('inspiracion-next');

        if (!carousel || !prevBtn || !nextBtn) {
            return;
        }

        const cardWidth = 240;
        const gap = 24;
        const cardWithGap = cardWidth + gap;

        /**
         * Actualizar estado de los botones según la posición del scroll
         */
        function updateButtonStates() {
            const scrollLeft = carousel.scrollLeft;
            const scrollWidth = carousel.scrollWidth;
            const clientWidth = carousel.clientWidth;

            // Deshabilitar botón anterior si estamos al inicio
            prevBtn.disabled = scrollLeft <= 0;

            // Deshabilitar botón siguiente si estamos al final
            nextBtn.disabled = scrollLeft + clientWidth >= scrollWidth - 10;
        }

        /**
         * Scroll a la izquierda
         */
        function scrollPrev() {
            carousel.scrollBy({
                left: -cardWithGap * 2,
                behavior: 'smooth'
            });
        }

        /**
         * Scroll a la derecha
         */
        function scrollNext() {
            carousel.scrollBy({
                left: cardWithGap * 2,
                behavior: 'smooth'
            });
        }

        // Agregar event listeners
        prevBtn.addEventListener('click', scrollPrev);
        nextBtn.addEventListener('click', scrollNext);

        // Actualizar estado de botones cuando se scrolle
        carousel.addEventListener('scroll', updateButtonStates);

        // Actualizar estado de botones en resize de ventana
        window.addEventListener('resize', updateButtonStates);

        // Estado inicial
        updateButtonStates();
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCarousel);
    } else {
        initCarousel();
    }
})();

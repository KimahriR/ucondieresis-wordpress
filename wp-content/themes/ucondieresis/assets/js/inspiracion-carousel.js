/**
 * Inspiracion Social Carousel
 * 
 * Maneja la navegación del carrusel horizontal con auto-play en loop
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
        const autoPlayInterval = 3500; // 3.5 segundos
        let autoPlayTimer = null;
        let isAutoPlaying = true;

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
         * Auto-play: Scroll automático
         */
        function autoPlay() {
            if (!isAutoPlaying) return;

            const scrollLeft = carousel.scrollLeft;
            const scrollWidth = carousel.scrollWidth;
            const clientWidth = carousel.clientWidth;
            const isAtEnd = scrollLeft + clientWidth >= scrollWidth - 10;

            if (isAtEnd) {
                // Ir al inicio con scroll suave
                carousel.scrollTo({
                    left: 0,
                    behavior: 'smooth'
                });
            } else {
                // Scroll siguiente
                carousel.scrollBy({
                    left: cardWithGap * 2,
                    behavior: 'smooth'
                });
            }
        }

        /**
         * Iniciar auto-play
         */
        function startAutoPlay() {
            if (autoPlayTimer) {
                clearInterval(autoPlayTimer);
            }
            isAutoPlaying = true;
            autoPlayTimer = setInterval(autoPlay, autoPlayInterval);
        }

        /**
         * Pausar auto-play
         */
        function pauseAutoPlay() {
            isAutoPlaying = false;
            if (autoPlayTimer) {
                clearInterval(autoPlayTimer);
            }
        }

        /**
         * Scroll a la izquierda
         */
        function scrollPrev() {
            pauseAutoPlay();
            carousel.scrollBy({
                left: -cardWithGap * 2,
                behavior: 'smooth'
            });
            // Reanudar después de 5 segundos de inactividad
            setTimeout(startAutoPlay, 5000);
        }

        /**
         * Scroll a la derecha
         */
        function scrollNext() {
            pauseAutoPlay();
            carousel.scrollBy({
                left: cardWithGap * 2,
                behavior: 'smooth'
            });
            // Reanudar después de 5 segundos de inactividad
            setTimeout(startAutoPlay, 5000);
        }

        // Agregar event listeners
        prevBtn.addEventListener('click', scrollPrev);
        nextBtn.addEventListener('click', scrollNext);

        // Pausar auto-play cuando pasa el mouse
        carousel.addEventListener('mouseenter', pauseAutoPlay);
        carousel.addEventListener('mouseleave', startAutoPlay);

        // Actualizar estado de botones cuando se scrolle
        carousel.addEventListener('scroll', updateButtonStates);

        // Actualizar estado de botones en resize de ventana
        window.addEventListener('resize', updateButtonStates);

        // Estado inicial
        updateButtonStates();
        
        // Iniciar auto-play
        startAutoPlay();
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCarousel);
    } else {
        initCarousel();
    }
})();

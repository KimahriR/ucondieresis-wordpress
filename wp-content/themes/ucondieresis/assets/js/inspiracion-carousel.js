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
        const autoPlayDelay = 6000; // Esperar 6 segundos antes de iniciar
        const autoPlayInterval = 4000; // Autoplay cada 4 segundos
        const resumeDelay = 5000; // Reanudar después de 5 segundos de inactividad
        let autoPlayTimer = null;
        let resumeTimer = null;
        let autoplayActive = true;
        let userInteracted = false;

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
            if (!autoplayActive) return;

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
         * Iniciar auto-play (con delay inicial)
         */
        function startAutoPlay() {
            // Pausar cualquier timer pendiente
            if (autoPlayTimer) {
                clearInterval(autoPlayTimer);
            }
            if (resumeTimer) {
                clearTimeout(resumeTimer);
            }

            // Esperar 6 segundos antes de iniciar autoplay
            resumeTimer = setTimeout(() => {
                autoplayActive = true;
                autoPlayTimer = setInterval(autoPlay, autoPlayInterval);
            }, autoPlayDelay);
        }

        /**
         * Pausar auto-play y preparar para reanudar
         */
        function pauseAndScheduleResume() {
            autoplayActive = false;
            if (autoPlayTimer) {
                clearInterval(autoPlayTimer);
            }
            if (resumeTimer) {
                clearTimeout(resumeTimer);
            }

            // Reanudar después de 5 segundos de inactividad
            resumeTimer = setTimeout(() => {
                startAutoPlay();
            }, resumeDelay);
        }

        /**
         * Scroll a la izquierda
         */
        function scrollPrev() {
            userInteracted = true;
            pauseAndScheduleResume();
            carousel.scrollBy({
                left: -cardWithGap * 2,
                behavior: 'smooth'
            });
        }

        /**
         * Scroll a la derecha
         */
        function scrollNext() {
            userInteracted = true;
            pauseAndScheduleResume();
            carousel.scrollBy({
                left: cardWithGap * 2,
                behavior: 'smooth'
            });
        }

        /**
         * Manejar interacción del usuario
         */
        function handleUserInteraction() {
            userInteracted = true;
            pauseAndScheduleResume();
        }

        // Agregar event listeners
        prevBtn.addEventListener('click', scrollPrev);
        nextBtn.addEventListener('click', scrollNext);

        // Pausar auto-play en interacción del usuario
        carousel.addEventListener('mouseenter', handleUserInteraction);
        carousel.addEventListener('touchstart', handleUserInteraction);
        carousel.addEventListener('scroll', handleUserInteraction);

        // Actualizar estado de botones cuando se scrolle
        carousel.addEventListener('scroll', updateButtonStates);

        // Actualizar estado de botones en resize de ventana
        window.addEventListener('resize', updateButtonStates);

        // Estado inicial
        updateButtonStates();
        
        // Iniciar auto-play con delay
        startAutoPlay();
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCarousel);
    } else {
        initCarousel();
    }
})();

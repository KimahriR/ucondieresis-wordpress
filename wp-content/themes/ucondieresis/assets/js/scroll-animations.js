/**
 * Scroll Animations
 * 
 * Smooth fade-in and slide-up animations using IntersectionObserver
 * Only animate elements when they enter the viewport
 * Performance optimized - no animation libraries needed
 * 
 * Features:
 * - Fade in: opacity 0 → 1
 * - Slide up: translateY(30px) → 0
 * - Stagger effect on child elements
 * - One-time animation per element
 */

(function () {
  'use strict';

  // Elements to animate
  const animationSelector = '.section-header, .home-ocasiones, .featured__grid, .inspiracion-card, .cta__inner, .contact-section__left, .contact-section__right, .contact-info__item, .cta-contact-section__header, .cta-whatsapp-card, .contact-info-card';

  // Create intersection observer
  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -100px 0px',
    threshold: 0.1
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Add animation class
        entry.target.classList.add('animate-in');
        
        // Animate staggered children if they exist
        const children = entry.target.querySelectorAll(':scope > *');
        if (children.length > 0) {
          children.forEach((child, index) => {
            child.style.animationDelay = `${index * 0.08}s`;
            child.classList.add('animate-in-child');
          });
        }

        // Stop observing this element (one-time animation)
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all elements
  document.querySelectorAll(animationSelector).forEach((element) => {
    observer.observe(element);
  });

  // Also observe newly added elements (dynamic content)
  const mutationObserver = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        if (node.nodeType === 1) { // Element node
          if (node.matches(animationSelector)) {
            observer.observe(node);
          }
          node.querySelectorAll(animationSelector).forEach((el) => {
            if (!el.classList.contains('animate-in')) {
              observer.observe(el);
            }
          });
        }
      });
    });
  });

  mutationObserver.observe(document.body, {
    childList: true,
    subtree: true
  });
})();

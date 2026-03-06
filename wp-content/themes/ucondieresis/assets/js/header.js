/**
 * Header Scroll Detection
 * 
 * Adds 'header-scrolled' class when user scrolls past 30px
 * Applies blur effect and background
 * 
 * Performance optimized with throttling
 */

(function () {
  'use strict';

  const header = document.getElementById('site-header');
  if (!header) return;

  let ticking = false;
  const scrollThreshold = 30;

  function updateHeaderState() {
    const isScrolled = window.scrollY > scrollThreshold;
    
    if (isScrolled) {
      header.classList.add('header-scrolled');
    } else {
      header.classList.remove('header-scrolled');
    }
    
    ticking = false;
  }

  function onScroll() {
    if (!ticking) {
      window.requestAnimationFrame(updateHeaderState);
      ticking = true;
    }
  }

  // Listen to scroll events with throttling
  window.addEventListener('scroll', onScroll, { passive: true });

  // Initial state
  updateHeaderState();
})();

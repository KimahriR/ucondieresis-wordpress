/**
 * Mobile Menu Toggle
 * 
 * Handles hamburger menu animation and navigation on mobile devices
 * Slide animation with backdrop-filter blur
 * 
 * Features:
 * - Smooth toggle animation
 * - Auto-close on link click
 * - Escape key support
 * - Body scroll lock
 */

(function () {
  'use strict';

  const toggleBtn = document.getElementById('mobile-menu-toggle');
  const menuWrapper = document.getElementById('site-header-menu-wrapper');
  const menuLinks = document.querySelectorAll('.site-header__menu-link');

  if (!toggleBtn || !menuWrapper) {
    return;
  }

  let isMenuOpen = false;

  /**
   * Toggle menu state
   */
  function toggleMenu() {
    isMenuOpen = !isMenuOpen;
    
    if (isMenuOpen) {
      menuWrapper.classList.add('active');
      toggleBtn.classList.add('active');
      toggleBtn.setAttribute('aria-expanded', 'true');
      // Prevent body scroll
      document.body.style.overflow = 'hidden';
    } else {
      closeMenu();
    }
  }

  /**
   * Close menu
   */
  function closeMenu() {
    isMenuOpen = false;
    menuWrapper.classList.remove('active');
    toggleBtn.classList.remove('active');
    toggleBtn.setAttribute('aria-expanded', 'false');
    // Restore body scroll
    document.body.style.overflow = '';
  }

  /**
   * Handle toggle button click
   */
  toggleBtn.addEventListener('click', toggleMenu);

  /**
   * Close menu when clicking menu links
   */
  menuLinks.forEach(link => {
    link.addEventListener('click', () => {
      closeMenu();
    });
  });

  /**
   * Close menu on Escape key
   */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isMenuOpen) {
      closeMenu();
    }
  });

  /**
   * Close menu when clicking outside
   */
  document.addEventListener('click', (e) => {
    const header = document.getElementById('site-header');
    if (isMenuOpen && header && !header.contains(e.target)) {
      closeMenu();
    }
  });

  /**
   * Close menu on window resize (when switching from mobile to desktop)
   */
  window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && isMenuOpen) {
      closeMenu();
    }
  });
})();

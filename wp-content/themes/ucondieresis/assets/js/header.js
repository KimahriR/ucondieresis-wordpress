/**
 * Header Scroll Detection & Mobile Menu
 * 
 * Features:
 * - Detects when hero section ends and changes header to white
 * - Sets transparent state while on hero
 * - Mobile menu toggle
 * 
 * Performance optimized with requestAnimationFrame throttling
 * 
 * @package Ucondieresis
 */

(function () {
  'use strict';

  const header = document.getElementById('site-header');
  const hero = document.querySelector('.hero');
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const menuWrapper = document.getElementById('site-header-menu-wrapper');
  
  if (!header) return;

  // ============================================
  // Initial State: Set transparent on load
  // ============================================
  header.classList.add('header--transparent');

  // ============================================
  // Scroll Detection - Based on Hero Height
  // ============================================
  
  let ticking = false;
  const ctaSection = document.querySelector('#cta-contact');

  function getHeroBottomPosition() {
    if (!hero) return 0;
    return hero.offsetHeight;
  }

  function getCtaPosition() {
    if (!ctaSection) return document.body.scrollHeight; // Si no existe, muy lejos
    return ctaSection.offsetTop;
  }

  function updateHeaderState() {
    const heroBottom = getHeroBottomPosition();
    const ctaTop = getCtaPosition();
    const isScrolled = window.scrollY > heroBottom;
    
    if (isScrolled) {
      header.classList.remove('header--transparent');
      header.classList.add('header--scrolled');
    } else {
      header.classList.add('header--transparent');
      header.classList.remove('header--scrolled');
    }
    
    // =====================================
    // Fade out header when reaching CTA
    // =====================================
    const fadeDistance = window.innerHeight * 0.5; // Desvanecimiento en media pantalla
    const fadeStart = ctaTop;
    const fadeEnd = ctaTop + fadeDistance;
    
    if (window.scrollY >= fadeStart) {
      const fadeProgress = (window.scrollY - fadeStart) / fadeDistance;
      const opacity = Math.max(0, 1 - fadeProgress);
      header.style.opacity = opacity;
      
      // Deshabilitar clicks cuando casi invisible
      header.style.pointerEvents = opacity > 0.1 ? 'auto' : 'none';
    } else {
      header.style.opacity = 1;
      header.style.pointerEvents = 'auto';
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

  // ============================================
  // Mobile Menu Toggle
  // ============================================
  
  if (mobileToggle && menuWrapper) {
    mobileToggle.addEventListener('click', function () {
      mobileToggle.classList.toggle('active');
      menuWrapper.classList.toggle('active');
    });

    // Close menu when clicking on a link
    const menuLinks = menuWrapper.querySelectorAll('.site-header__menu-link');
    menuLinks.forEach(link => {
      link.addEventListener('click', function () {
        mobileToggle.classList.remove('active');
        menuWrapper.classList.remove('active');
      });
    });

    // Close menu when scrolling
    window.addEventListener('scroll', function () {
      if (mobileToggle.classList.contains('active')) {
        mobileToggle.classList.remove('active');
        menuWrapper.classList.remove('active');
      }
    }, { passive: true });
  }
})();

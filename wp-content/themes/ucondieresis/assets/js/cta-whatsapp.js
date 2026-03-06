/**
 * CTA + Contact Section WhatsApp Menu Handler
 * 
 * Manages the interactive WhatsApp menu in the merged CTA section
 * - Toggle menu open/close
 * - Handle menu item clicks
 * - Send WhatsApp messages with specific actions
 * 
 * Config injected via wp_localize_script in functions.php
 * @package Ucondieresis
 */

(function() {
  'use strict';

  // DOM Elements
  const mainBtn = document.getElementById('cta-whatsapp-btn');
  const menu = document.getElementById('cta-whatsapp-menu');
  const menuItems = document.querySelectorAll('[data-action]');

  // Guard clause
  if (!mainBtn || !menu) {
    return;
  }

  // Get config from wp_localize_script (safe)
  const CONFIG = typeof ucondieresisWhatsApp !== 'undefined' ? ucondieresisWhatsApp : {
    number: '521234567890',
    messages: {
      gift: 'Hola! Quiero crear un regalo personalizado',
      business: 'Hola! Tengo una consulta para mi negocio',
      quick: 'Hola! Tengo una consulta rápida',
    },
  };

  /**
   * Toggle menu visibility
   */
  function toggleMenu() {
    const isHidden = menu.hasAttribute('hidden');

    if (isHidden) {
      menu.removeAttribute('hidden');
      mainBtn.setAttribute('aria-expanded', 'true');
    } else {
      menu.setAttribute('hidden', '');
      mainBtn.setAttribute('aria-expanded', 'false');
    }
  }

  /**
   * Close menu
   */
  function closeMenu() {
    menu.setAttribute('hidden', '');
    mainBtn.setAttribute('aria-expanded', 'false');
  }

  /**
   * Send WhatsApp message based on action
   * @param {string} action - The action type (gift, business, quick)
   */
  function sendWhatsAppMessage(action) {
    const message = CONFIG.messages[action] || CONFIG.messages.quick;
    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${CONFIG.number}?text=${encodedMessage}`;

    // Close menu before redirecting
    closeMenu();

    // Delay redirect slightly for better UX
    setTimeout(() => {
      window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
    }, 150);
  }

  /**
   * Handle main button click
   */
  mainBtn.addEventListener('click', (e) => {
    e.preventDefault();
    toggleMenu();
  });

  /**
   * Handle menu item clicks
   */
  menuItems.forEach((item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      const action = item.getAttribute('data-action');
      if (action) {
        sendWhatsAppMessage(action);
      }
    });
  });

  /**
   * Close menu when clicking outside
   */
  document.addEventListener('click', (e) => {
    const isClickInside = mainBtn.contains(e.target) || menu.contains(e.target);
    if (!isClickInside && !menu.hasAttribute('hidden')) {
      closeMenu();
    }
  });

  /**
   * Handle keyboard navigation
   */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !menu.hasAttribute('hidden')) {
      closeMenu();
      mainBtn.focus();
    }
  });

})();

/**
 * Floating WhatsApp Button - Dynamic Behavior
 * 
 * Features:
 * - Rotating tooltip messages (emoji + plain + conversion soft)
 * - Expandable bubble menu with arc animation
 * - Smart show/hide logic (initial, scroll, time-based)
 * - Session-based appearance tracking
 * 
 * @package Ucondieresis
 */

(function() {
  'use strict';

  // ==========================================
  // Configuration & State
  // ==========================================

  const CONFIG = {
    tooltipDuration: 5000,
    scrollTriggerPercent: 50,
    initialDelay: 0,
    secondTooltipDelay: 25000,
    maxTooltipAppearances: 3,
    animationDuration: 300,
    menuAnimationDuration: 400,
  };

  const state = {
    menuOpen: false,
    tooltipShown: 0,
    scrollTriggerFired: false,
    lastMessageIndex: -1,
    tooltipTimers: [],
    isAnimating: false,
  };

  // ==========================================
  // Tooltip Messages Configuration
  // ==========================================

  let messages = {
    withEmoji: [
      '✨ ¿Tienes una idea?',
      '💛 ¿Creamos algo?',
      '🎨 Dale forma a tu idea',
      'Estoy listo para tu idea 😉',
    ],
    withoutEmoji: [
      'Hagámoslo realidad',
      'Personalizamos tu mundo',
      'Tu idea merece existir',
    ],
    softConversion: [
      '¿Lo hacemos único?',
    ],
  };

  // ==========================================
  // DOM Elements
  // ==========================================

  const container = document.getElementById('whatsapp-floating-container');
  const mainBtn = document.getElementById('whatsapp-main-btn');
  const tooltip = document.getElementById('whatsapp-tooltip');
  const tooltipText = document.getElementById('tooltip-text');
  const menu = document.getElementById('whatsapp-menu');
  const menuItems = document.querySelectorAll('.whatsapp-menu__item');

  // Guard clause: stop if elements not found
  if (!container || !mainBtn || !menu) {
    return;
  }

  // ==========================================
  // Message Rotation Logic
  // ==========================================

  /**
   * Get next tooltip message with intelligent rotation
   * Alternates: emoji → no emoji → soft conversion
   * Never repeats consecutive same message
   * 
   * @returns {string} Next message to display
   */
  function getNextMessage() {
    const appearance = state.tooltipShown % 3;
    let messageArray;

    if (appearance === 0) {
      messageArray = messages.withEmoji;
    } else if (appearance === 1) {
      messageArray = messages.withoutEmoji;
    } else {
      messageArray = messages.softConversion;
    }

    let nextIndex;
    do {
      nextIndex = Math.floor(Math.random() * messageArray.length);
    } while (
      nextIndex === state.lastMessageIndex &&
      messageArray.length > 1
    );

    state.lastMessageIndex = nextIndex;
    return messageArray[nextIndex];
  }

  // ==========================================
  // Tooltip Management
  // ==========================================

  /**
   * Show tooltip with rotating message
   * 
   * @param {number} duration Auto-hide after duration (ms)
   */
  function showTooltip(duration = CONFIG.tooltipDuration) {
    // Don't show if max appearances reached or menu is open
    if (
      state.tooltipShown >= CONFIG.maxTooltipAppearances ||
      state.menuOpen
    ) {
      return;
    }

    const message = getNextMessage();
    tooltipText.textContent = message;

    tooltip.classList.remove('is-hidden');

    state.tooltipShown++;

    // Clear any pending hide timers
    clearTooltipTimers();

    // Auto-hide after duration
    const hideTimer = setTimeout(() => {
      hideTooltip();
    }, duration);

    state.tooltipTimers.push(hideTimer);
  }

  /**
   * Hide tooltip with animation
   */
  function hideTooltip() {
    tooltip.classList.add('is-hidden');
  }

  /**
   * Clear all pending tooltip timers
   */
  function clearTooltipTimers() {
    state.tooltipTimers.forEach((timer) => clearTimeout(timer));
    state.tooltipTimers = [];
  }

  // ==========================================
  // Menu Positioning (Arc Layout)
  // ==========================================

  /**
   * Position menu items in arc formation above button
   * Uses CSS custom properties for positioning
   */
  function positionMenuItems() {
    const radius = 70;
    const startAngle = 180; // Top (changed from 90)
    const angleSpan = 120; // 120 degree arc (was 180)
    const itemCount = menuItems.length;

    menuItems.forEach((item, index) => {
      // Spread items in upward arc
      const angle = startAngle - (angleSpan / 2) + (angleSpan / (itemCount - 1)) * index;
      const rad = (angle * Math.PI) / 180;

      const x = Math.cos(rad) * radius;
      const y = Math.sin(rad) * radius;

      item.style.setProperty('--item-x', `${x}px`);
      item.style.setProperty('--item-y', `${y}px`);
    });
  }

  // ==========================================
  // Menu Toggle
  // ==========================================

  /**
   * Toggle menu open/closed with animation
   */
  function toggleMenu() {
    if (state.isAnimating) return;

    state.isAnimating = true;
    state.menuOpen = !state.menuOpen;

    if (state.menuOpen) {
      hideTooltip(); // Hide tooltip when menu opens
      mainBtn.setAttribute('aria-expanded', 'true');

      // Staggered expand animation
      menuItems.forEach((item, index) => {
        item.classList.add('is-expanded');
        item.style.transitionDelay = `${index * 0.08}s`;
      });
    } else {
      mainBtn.setAttribute('aria-expanded', 'false');

      // Reverse staggered collapse animation
      menuItems.forEach((item, index) => {
        item.classList.remove('is-expanded');
        item.style.transitionDelay = `${(menuItems.length - 1 - index) * 0.06}s`;
      });
    }

    setTimeout(() => {
      state.isAnimating = false;
    }, CONFIG.menuAnimationDuration);
  }

  // ==========================================
  // Load Configuration from JSON
  // ==========================================

  /**
   * Parse JSON config from script tag if available
   */
  function loadConfigFromJSON() {
    const configScript = document.getElementById('whatsapp-config');
    if (!configScript) return;

    try {
      const config = JSON.parse(configScript.textContent);

      if (config.tooltips) {
        messages = config.tooltips;
      }

      // Store WhatsApp number and messages in data attribute for JS access
      menuItems.forEach((item) => {
        const action = item.getAttribute('data-action');
        if (action && config.messages && config.messages[action]) {
          item.setAttribute(
            'data-message',
            config.messages[action]
          );
          item.setAttribute(
            'data-whatsapp',
            config.whatsappNumber
          );
        }
      });
    } catch (e) {
      console.warn('WhatsApp config parsing error:', e);
    }
  }

  // ==========================================
  // Event Listeners
  // ==========================================

  /**
   * Main button click - toggle menu
   */
  mainBtn.addEventListener('click', (e) => {
    e.preventDefault();
    toggleMenu();
  });

  /**
   * Close menu when clicking outside
   */
  document.addEventListener('click', (e) => {
    if (!container.contains(e.target) && state.menuOpen) {
      toggleMenu();
    }
  });

  /**
   * Menu item click - generate WhatsApp link and redirect
   */
  menuItems.forEach((item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault();

      const message = item.getAttribute('data-message');
      const whatsappNumber = item.getAttribute('data-whatsapp');

      if (message && whatsappNumber) {
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

        // Close menu before redirecting
        setTimeout(() => {
          if (state.menuOpen) {
            toggleMenu();
          }
          // Navigate to WhatsApp
          window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
        }, 100);
      }
    });
  });

  /**
   * Scroll trigger - show tooltip again at 50% scroll
   */
  window.addEventListener(
    'scroll',
    () => {
      if (state.scrollTriggerFired || state.menuOpen) return;

      const scrollPercent =
        (window.scrollY /
          (document.documentElement.scrollHeight - window.innerHeight)) *
        100;

      if (scrollPercent >= CONFIG.scrollTriggerPercent) {
        state.scrollTriggerFired = true;
        showTooltip(CONFIG.tooltipDuration);
      }
    },
    { passive: true }
  );

  // ==========================================
  // Initialize
  // ==========================================

  /**
   * Initialize floating button component
   */
  function init() {
    // Load messages from JSON config
    loadConfigFromJSON();

    // Position menu items in arc
    positionMenuItems();

    // Initial tooltip after delay
    const showInitialTooltip = setTimeout(() => {
      showTooltip(CONFIG.tooltipDuration);

      // Schedule second tooltip if scroll hasn't triggered it
      const secondTooltipTimer = setTimeout(() => {
        if (
          state.tooltipShown < CONFIG.maxTooltipAppearances &&
          !state.menuOpen &&
          !state.scrollTriggerFired
        ) {
          showTooltip(CONFIG.tooltipDuration);
        }
      }, CONFIG.secondTooltipDelay);

      state.tooltipTimers.push(secondTooltipTimer);
    }, CONFIG.initialDelay);

    state.tooltipTimers.push(showInitialTooltip);
  }

  // ==========================================
  // Cleanup on Unload
  // ==========================================

  /**
   * Clear all timers when page unloads
   */
  window.addEventListener('beforeunload', () => {
    clearTooltipTimers();
  });

  // ==========================================
  // Start When Ready
  // ==========================================

  // Wait for DOM to be ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

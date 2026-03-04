/**
 * Floating WhatsApp Button - Dynamic Behavior
 * 
 * Features:
 * - Rotating tooltip messages (emoji + plain + conversion soft)
 * - Bottom sheet modal (slides up diagonally)
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
  };

  const state = {
    sheetOpen: false,
    tooltipShown: 0,
    scrollTriggerFired: false,
    lastMessageIndex: -1,
    tooltipTimers: [],
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
  const sheet = document.getElementById('whatsapp-sheet');
  const backdrop = document.getElementById('whatsapp-backdrop') || sheet?.querySelector('.whatsapp-sheet__backdrop');
  const tooltip = document.getElementById('whatsapp-tooltip');
  const tooltipText = document.getElementById('tooltip-text');
  const sheetOptions = document.querySelectorAll('.whatsapp-sheet__option');

  // Guard clause: stop if elements not found
  if (!container || !mainBtn || !sheet) {
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
    // Don't show if max appearances reached or sheet is open
    if (
      state.tooltipShown >= CONFIG.maxTooltipAppearances ||
      state.sheetOpen
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
  // Sheet Modal Management
  // ==========================================

  /**
   * Open bottom sheet modal
   */
  function openSheet() {
    if (state.sheetOpen) return;

    state.sheetOpen = true;
    hideTooltip();
    mainBtn.setAttribute('aria-expanded', 'true');
    sheet.classList.add('is-open');

    // Prevent body scroll
    document.body.style.overflow = 'hidden';
  }

  /**
   * Close bottom sheet modal
   */
  function closeSheet() {
    if (!state.sheetOpen) return;

    state.sheetOpen = false;
    mainBtn.setAttribute('aria-expanded', 'false');
    sheet.classList.remove('is-open');

    // Restore body scroll
    document.body.style.overflow = '';
  }

  // ==========================================
  // Event Listeners
  // ==========================================

  /**
   * Main button click - toggle sheet
   */
  mainBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (state.sheetOpen) {
      closeSheet();
    } else {
      openSheet();
    }
  });

  /**
   * Close sheet when clicking backdrop
   */
  backdrop.addEventListener('click', (e) => {
    e.preventDefault();
    closeSheet();
  });

  /**
   * Close sheet when clicking outside
   */
  document.addEventListener('click', (e) => {
    if (state.sheetOpen && !sheet.contains(e.target) && !mainBtn.contains(e.target)) {
      closeSheet();
    }
  });

  /**
   * Sheet option click - generate WhatsApp link and redirect
   */
  sheetOptions.forEach((item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault();

      const message = item.getAttribute('data-message');
      const whatsappNumber = item.getAttribute('data-whatsapp');

      if (message && whatsappNumber) {
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

        // Close sheet before redirecting
        closeSheet();

        // Small delay to allow animation
        setTimeout(() => {
          window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
        }, 200);
      }
    });
  });

  /**
   * Close sheet on ESC key
   */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && state.sheetOpen) {
      closeSheet();
    }
  });

  /**
   * Scroll trigger - show tooltip again at 50% scroll
   */
  window.addEventListener(
    'scroll',
    () => {
      if (state.scrollTriggerFired || state.sheetOpen) return;

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
      sheetOptions.forEach((item) => {
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
  // Initialize
  // ==========================================

  /**
   * Initialize floating button component
   */
  function init() {
    // Load messages from JSON config
    loadConfigFromJSON();

    // Initial tooltip after delay
    const showInitialTooltip = setTimeout(() => {
      showTooltip(CONFIG.tooltipDuration);

      // Schedule second tooltip if scroll hasn't triggered it
      const secondTooltipTimer = setTimeout(() => {
        if (
          state.tooltipShown < CONFIG.maxTooltipAppearances &&
          !state.sheetOpen &&
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
    if (state.sheetOpen) {
      closeSheet();
    }
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

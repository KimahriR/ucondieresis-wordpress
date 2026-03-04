<?php
/**
 * Template Part: Floating WhatsApp Button with Dynamic Tooltip
 * 
 * Features:
 * - Floating button (fixed bottom-right)
 * - Dynamic rotating tooltip messages
 * - Expandable bubble menu on click
 * - Auto-hide/show logic based on scroll and time
 * 
 * @package Ucondieresis
 */

// Get WhatsApp number safely
$whatsapp_number = function_exists('ucondieresis_get_whatsapp_number') 
    ? ucondieresis_get_whatsapp_number() 
    : get_option('ucondieresis_whatsapp_numero', '34600123456');

$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);
?>

<div id="whatsapp-floating-container" style="position: fixed; bottom: 30px; right: 30px; z-index: 999; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;">
  
  <!-- Tooltip dinámico -->
  <div id="whatsapp-tooltip" style="position: absolute; bottom: 70px; right: 0; background: white; color: #667eea; padding: 12px 18px; border-radius: 20px; white-space: nowrap; font-size: 0.9rem; font-weight: 500; box-shadow: 0 4px 16px rgba(0,0,0,0.12); opacity: 0; transform: translateY(10px) translateX(10px); pointer-events: none; transition: opacity 0.3s ease, transform 0.3s ease; display: none;">
    <span id="tooltip-text">✨ ¿Tienes una idea?</span>
  </div>

  <!-- Botón flotante principal -->
  <button 
    id="whatsapp-main-btn" 
    style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-size: 1.8rem; cursor: pointer; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4); transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; animation: floatingButtonEnter 0.6s ease backwards;"
    aria-label="Abrir menú WhatsApp"
    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.5)';"
    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';">
    💬
  </button>

  <!-- Menú de burbujas (se expande al hacer clic) -->
  <div id="whatsapp-menu" style="position: absolute; bottom: 80px; right: 0; pointer-events: none; width: 60px; height: 60px;">
    
    <!-- Opción 1: Crear regalo -->
    <a 
      href="<?php echo esc_url('https://wa.me/' . $whatsapp_number_clean . '?text=' . urlencode('Hola 😊 quiero crear un regalo personalizado.')); ?>"
      target="_blank"
      rel="noopener noreferrer"
      class="whatsapp-menu-item"
      data-index="0"
      style="position: absolute; bottom: 0; right: 0; width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; font-size: 1.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-decoration: none; opacity: 0; transform: scale(0.3) translateY(0) translateX(0); pointer-events: none; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
      💛
    </a>

    <!-- Opción 2: Para negocio -->
    <a 
      href="<?php echo esc_url('https://wa.me/' . $whatsapp_number_clean . '?text=' . urlencode('Hola 👋 quiero cotizar productos personalizados para mi negocio.')); ?>"
      target="_blank"
      rel="noopener noreferrer"
      class="whatsapp-menu-item"
      data-index="1"
      style="position: absolute; bottom: 0; right: 0; width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; font-size: 1.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-decoration: none; opacity: 0; transform: scale(0.3) translateY(0) translateX(0); pointer-events: none; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
      🚀
    </a>

    <!-- Opción 3: Mensaje rápido -->
    <a 
      href="<?php echo esc_url('https://wa.me/' . $whatsapp_number_clean . '?text=' . urlencode('Hola, tengo una consulta.')); ?>"
      target="_blank"
      rel="noopener noreferrer"
      class="whatsapp-menu-item"
      data-index="2"
      style="position: absolute; bottom: 0; right: 0; width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; font-size: 1.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-decoration: none; opacity: 0; transform: scale(0.3) translateY(0) translateX(0); pointer-events: none; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
      ⚡
    </a>

  </div>

</div>

<!-- Estilos de animaciones -->
<style>
  @keyframes floatingButtonEnter {
    from {
      opacity: 0;
      transform: translateY(30px) translateX(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0) translateX(0);
    }
  }

  @keyframes tooltipFadeIn {
    from {
      opacity: 0;
      transform: translateY(10px) translateX(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0) translateX(0);
    }
  }

  @keyframes tooltipFadeOut {
    from {
      opacity: 1;
      transform: translateY(0) translateX(0);
    }
    to {
      opacity: 0;
      transform: translateY(10px) translateX(10px);
    }
  }

  @keyframes menuItemExpand {
    from {
      opacity: 0;
      transform: scale(0.3) translateY(0) translateX(0);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(var(--item-y)) translateX(var(--item-x));
    }
  }

  @keyframes menuItemCollapse {
    from {
      opacity: 1;
      transform: scale(1) translateY(var(--item-y)) translateX(var(--item-x));
    }
    to {
      opacity: 0;
      transform: scale(0.3) translateY(0) translateX(0);
    }
  }

  #whatsapp-floating-container .whatsapp-menu-item:hover {
    transform: scale(1.1) !important;
  }
</style>

<!-- JavaScript para comportamiento dinámico -->
<script>
(function() {
  'use strict';

  // Configuración
  const config = {
    showTooltipInitially: true,
    tooltipDuration: 5000,
    scrollTriggerPercent: 50,
    secondTooltipDelay: 25000,
    maxTooltipAppearances: 2,
    tooltipMessages: [
      { text: '✨ ¿Tienes una idea?', hasEmoji: true },
      { text: 'Hagámoslo realidad', hasEmoji: false },
      { text: '💛 ¿Creamos algo?', hasEmoji: true },
      { text: 'Personalizamos tu mundo', hasEmoji: false },
      { text: '🎨 Dale forma a tu idea', hasEmoji: true },
      { text: 'Tu idea merece existir', hasEmoji: false },
      { text: '¿Lo hacemos único?', hasEmoji: false },
      { text: 'Estoy listo para tu idea 😉', hasEmoji: true },
      { text: 'Cuéntame qué imaginas', hasEmoji: false },
    ]
  };

  // Estado
  let state = {
    menuOpen: false,
    tooltipShown: 0,
    scrollTriggerFired: false,
    lastMessageIndex: -1,
    tooltipTimers: [],
    isAnimating: false
  };

  // Elementos del DOM
  const container = document.getElementById('whatsapp-floating-container');
  const mainBtn = document.getElementById('whatsapp-main-btn');
  const tooltip = document.getElementById('whatsapp-tooltip');
  const tooltipText = document.getElementById('tooltip-text');
  const menu = document.getElementById('whatsapp-menu');
  const menuItems = document.querySelectorAll('.whatsapp-menu-item');

  if (!container || !mainBtn) return;

  // Función para obtener siguiente mensaje (no repite consecutivamente)
  function getNextMessage() {
    let nextIndex;
    do {
      nextIndex = Math.floor(Math.random() * config.tooltipMessages.length);
    } while (nextIndex === state.lastMessageIndex && config.tooltipMessages.length > 1);
    
    state.lastMessageIndex = nextIndex;
    return config.tooltipMessages[nextIndex];
  }

  // Mostrar tooltip
  function showTooltip(duration = config.tooltipDuration) {
    if (state.tooltipShown >= config.maxTooltipAppearances || state.menuOpen) return;

    const message = getNextMessage();
    tooltipText.textContent = message.text;
    
    tooltip.style.display = 'block';
    tooltip.style.animation = 'none';
    
    // Trigger reflow para resetear animación
    void tooltip.offsetWidth;
    
    tooltip.style.animation = 'tooltipFadeIn 0.3s ease forwards';
    tooltip.style.opacity = '1';
    tooltip.style.transform = 'translateY(0) translateX(0)';

    state.tooltipShown++;

    // Limpiar timers anteriores
    state.tooltipTimers.forEach(timer => clearTimeout(timer));
    state.tooltipTimers = [];

    // Auto-hide después de duration
    const hideTimer = setTimeout(() => {
      hideTooltip();
    }, duration);

    state.tooltipTimers.push(hideTimer);
  }

  // Ocultar tooltip
  function hideTooltip() {
    tooltip.style.animation = 'tooltipFadeOut 0.3s ease forwards';
    
    const hideTimer = setTimeout(() => {
      tooltip.style.display = 'none';
      tooltip.style.opacity = '0';
    }, 300);

    state.tooltipTimers.push(hideTimer);
  }

  // Posicionar burbujas del menú en arco
  function positionMenuItems() {
    const radius = 90;
    const startAngle = 90; // Arriba
    const angleSpan = 180; // Semicírculo
    const itemCount = menuItems.length;

    menuItems.forEach((item, index) => {
      const angle = startAngle + (angleSpan / (itemCount - 1)) * index - 180;
      const rad = (angle * Math.PI) / 180;
      
      const x = Math.cos(rad) * radius;
      const y = Math.sin(rad) * radius;
      
      item.style.setProperty('--item-x', `${x}px`);
      item.style.setProperty('--item-y', `${y}px`);
    });
  }

  // Abrir/cerrar menú
  function toggleMenu() {
    if (state.isAnimating) return;
    
    state.isAnimating = true;
    state.menuOpen = !state.menuOpen;

    if (state.menuOpen) {
      hideTooltip(); // Esconder tooltip al abrir menú
      menuItems.forEach((item, index) => {
        item.style.pointerEvents = 'auto';
        item.style.animation = `menuItemExpand 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) ${index * 0.08}s forwards`;
      });
      mainBtn.style.background = 'linear-gradient(135deg, #764ba2 0%, #667eea 100%)';
    } else {
      menuItems.forEach((item, index) => {
        item.style.pointerEvents = 'none';
        item.style.animation = `menuItemCollapse 0.3s ease-out ${(menuItems.length - 1 - index) * 0.06}s forwards`;
      });
      mainBtn.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    }

    setTimeout(() => {
      state.isAnimating = false;
    }, 400);
  }

  // Event listeners
  mainBtn.addEventListener('click', toggleMenu);

  // Cerrar menú al hacer clic fuera
  document.addEventListener('click', (e) => {
    if (!container.contains(e.target) && state.menuOpen) {
      toggleMenu();
    }
  });

  // Cerrar menú al hacer clic en un item
  menuItems.forEach(item => {
    item.addEventListener('click', () => {
      setTimeout(() => {
        if (state.menuOpen) toggleMenu();
      }, 100);
    });
  });

  // Scroll trigger para segunda aparición de tooltip
  window.addEventListener('scroll', () => {
    if (state.scrollTriggerFired || state.menuOpen) return;

    const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    
    if (scrollPercent >= config.scrollTriggerPercent) {
      state.scrollTriggerFired = true;
      showTooltip(config.tooltipDuration);
    }
  }, { passive: true });

  // Mostrar tooltip inicial
  if (config.showTooltipInitially) {
    positionMenuItems();
    showTooltip(config.tooltipDuration);

    // Segunda aparición automática después de tiempo
    const secondShowTimer = setTimeout(() => {
      if (state.tooltipShown < config.maxTooltipAppearances && !state.menuOpen && !state.scrollTriggerFired) {
        showTooltip(config.tooltipDuration);
      }
    }, config.secondTooltipDelay);

    state.tooltipTimers.push(secondShowTimer);
  } else {
    positionMenuItems();
  }

  // Limpiar timers al descargar página
  window.addEventListener('beforeunload', () => {
    state.tooltipTimers.forEach(timer => clearTimeout(timer));
  });

})();
</script>

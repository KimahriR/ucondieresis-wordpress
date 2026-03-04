<?php
/**
 * Template Part: Floating WhatsApp Button with Bottom Sheet Modal
 * 
 * Dynamic WhatsApp floating button with:
 * - Rotating tooltip messages
 * - Bottom sheet modal (slides up diagonally)
 * - Clean interaction
 * 
 * @package Ucondieresis
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Localizar helper para WhatsApp
use Ucondieresis\WhatsApp_Utils;
?>

<div id="whatsapp-floating-container" class="whatsapp-floating-container">
  
  <!-- Tooltip dinámico (cápsula) -->
  <div id="whatsapp-tooltip" class="whatsapp-tooltip is-hidden" aria-live="polite" aria-atomic="true">
    <span id="tooltip-text" class="whatsapp-tooltip__text">
      <?php esc_html_e('✨ ¿Tienes una idea?', 'ucondieresis'); ?>
    </span>
  </div>

  <!-- Botón principal circular -->
  <button 
    id="whatsapp-main-btn" 
    class="whatsapp-floating-button"
    aria-label="<?php esc_attr_e('Abrir menú de WhatsApp', 'ucondieresis'); ?>"
    aria-controls="whatsapp-menu"
    aria-expanded="false">
    <svg class="whatsapp-floating-button__icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <!-- Pink rounded square background with gradient -->
      <defs>
        <linearGradient id="floatingPinkGradient" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:#FF4B8D;stop-opacity:1" />
          <stop offset="100%" style="stop-color:#E91E63;stop-opacity:1" />
        </linearGradient>
      </defs>
      <rect x="0" y="0" width="24" height="24" rx="5.5" fill="url(#floatingPinkGradient)"/>
      
      <!-- WhatsApp speech bubble with phone receiver -->
      <g transform="translate(3.5, 2.5)">
        <!-- Chat bubble -->
        <path d="M2 0H13C14.1 0 15 0.9 15 2V11C15 12.1 14.1 13 13 13H7.5L3.5 16V13H2C0.9 13 0 12.1 0 11V2C0 0.9 0.9 0 2 0Z" fill="white"/>
        <!-- Phone handset -->
        <g transform="translate(3.5, 3)">
          <path d="M3.5 0C4.9 0 6 1.1 6 2.5C6 4.7 4.7 6.5 2.5 7.9C1.7 8.4 0.5 8.4 0 7.9C-1.2 6.5 -2.5 4.7 -2.5 2.5C-2.5 1.1 -1.4 0 0 0L3.5 0Z" fill="#E91E63"/>
        </g>
      </g>
    </svg>
  </button>

  <!-- Floating Menu Bubbles -->
  <div id="whatsapp-menu" class="whatsapp-menu" role="menu">
    
    <!-- Opción 1: Crear regalo -->
    <button
      class="whatsapp-menu__item whatsapp-menu__item--1"
      data-action="gift"
      title="<?php esc_attr_e('Crear un regalo', 'ucondieresis'); ?>"
      aria-label="<?php esc_attr_e('Crear un regalo personalizado', 'ucondieresis'); ?>">
      <span class="whatsapp-menu__item-icon">💛</span>
      <span class="whatsapp-menu__item-label"><?php esc_html_e('Crear regalo', 'ucondieresis'); ?></span>
    </button>

    <!-- Opción 2: Para negocio -->
    <button
      class="whatsapp-menu__item whatsapp-menu__item--2"
      data-action="business"
      title="<?php esc_attr_e('Para mi negocio', 'ucondieresis'); ?>"
      aria-label="<?php esc_attr_e('Cotizar productos personalizados', 'ucondieresis'); ?>">
      <span class="whatsapp-menu__item-icon">🚀</span>
      <span class="whatsapp-menu__item-label"><?php esc_html_e('Para mi negocio', 'ucondieresis'); ?></span>
    </button>

    <!-- Opción 3: Mensaje rápido -->
    <button
      class="whatsapp-menu__item whatsapp-menu__item--3"
      data-action="quick"
      title="<?php esc_attr_e('Mensaje rápido', 'ucondieresis'); ?>"
      aria-label="<?php esc_attr_e('Envía tu pregunta rápidamente', 'ucondieresis'); ?>">
      <span class="whatsapp-menu__item-icon">⚡</span>
      <span class="whatsapp-menu__item-label"><?php esc_html_e('Mensaje rápido', 'ucondieresis'); ?></span>
    </button>
  </div>

</div>

<!-- Configuración JSON para el JavaScript -->
<script id="whatsapp-config" type="application/json">
{
  "whatsappNumber": "<?php echo esc_js(preg_replace('/\D/', '', ucondieresis_get_whatsapp_number())); ?>",
  "messages": {
    "gift": "<?php echo esc_js(__('Hola 😊 quiero crear un regalo personalizado.', 'ucondieresis')); ?>",
    "business": "<?php echo esc_js(__('Hola 👋 quiero cotizar productos personalizados para mi negocio.', 'ucondieresis')); ?>",
    "quick": "<?php echo esc_js(__('Hola, tengo una consulta.', 'ucondieresis')); ?>"
  },
  "tooltips": {
    "withEmoji": [
      "✨ ¿Tienes una idea?",
      "💛 ¿Creamos algo?",
      "🎨 Dale forma a tu idea",
      "Estoy listo para tu idea 😉"
    ],
    "withoutEmoji": [
      "Hagámoslo realidad",
      "Personalizamos tu mundo",
      "Tu idea merece existir"
    ],
    "softConversion": [
      "¿Lo hacemos único?"
    ]
  }
}
</script>



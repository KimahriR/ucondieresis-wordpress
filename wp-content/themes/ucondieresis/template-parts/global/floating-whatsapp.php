<?php
/**
 * Template Part: Floating WhatsApp Button
 * 
 * Dynamic WhatsApp floating button with:
 * - Rotating tooltip messages
 * - Expandable bubble menu
 * - Smooth animations
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
    <span class="whatsapp-floating-button__icon">💬</span>
  </button>

  <!-- Contenedor de burbujas (se expande al hacer clic) -->
  <div id="whatsapp-menu" class="whatsapp-menu" role="menu">
    
    <!-- Burbuja 1: Crear regalo -->
    <a 
      href="#"
      class="whatsapp-menu__item whatsapp-menu__item--1"
      role="menuitem"
      data-action="gift">
      <span class="whatsapp-menu__icon">💛</span>
      <span class="whatsapp-menu__label"><?php esc_html_e('Crear un regalo', 'ucondieresis'); ?></span>
    </a>

    <!-- Burbuja 2: Para negocio -->
    <a 
      href="#"
      class="whatsapp-menu__item whatsapp-menu__item--2"
      role="menuitem"
      data-action="business">
      <span class="whatsapp-menu__icon">🚀</span>
      <span class="whatsapp-menu__label"><?php esc_html_e('Para mi negocio', 'ucondieresis'); ?></span>
    </a>

    <!-- Burbuja 3: Mensaje rápido -->
    <a 
      href="#"
      class="whatsapp-menu__item whatsapp-menu__item--3"
      role="menuitem"
      data-action="quick">
      <span class="whatsapp-menu__icon">⚡</span>
      <span class="whatsapp-menu__label"><?php esc_html_e('Mensaje rápido', 'ucondieresis'); ?></span>
    </a>

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


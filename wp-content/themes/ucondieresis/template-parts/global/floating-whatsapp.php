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
    <span class="whatsapp-floating-button__icon">💬</span>
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



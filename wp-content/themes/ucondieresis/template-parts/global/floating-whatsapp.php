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
    aria-controls="whatsapp-sheet"
    aria-expanded="false">
    <span class="whatsapp-floating-button__icon">💬</span>
  </button>

</div>

<!-- Bottom Sheet Modal -->
<div id="whatsapp-sheet" class="whatsapp-sheet" role="dialog" aria-labelledby="whatsapp-sheet-title" aria-modal="true">
  
  <!-- Backdrop (cierra al hacer clic) -->
  <div id="whatsapp-backdrop" class="whatsapp-sheet__backdrop"></div>
  
  <!-- Contenido del sheet -->
  <div class="whatsapp-sheet__content">
    
    <div class="whatsapp-sheet__header">
      <h2 id="whatsapp-sheet-title" class="whatsapp-sheet__title">
        <?php esc_html_e('¿Cómo podemos ayudarte?', 'ucondieresis'); ?>
      </h2>
      <p class="whatsapp-sheet__subtitle">
        <?php esc_html_e('Elige una opción para contactarnos por WhatsApp', 'ucondieresis'); ?>
      </p>
    </div>

    <div class="whatsapp-sheet__options">
      
      <!-- Opción 1: Crear regalo -->
      <a 
        href="#"
        class="whatsapp-sheet__option"
        data-action="gift">
        <span class="whatsapp-sheet__option-icon">💛</span>
        <div class="whatsapp-sheet__option-content">
          <h3 class="whatsapp-sheet__option-title">
            <?php esc_html_e('Crear un regalo', 'ucondieresis'); ?>
          </h3>
          <p class="whatsapp-sheet__option-desc">
            <?php esc_html_e('Quiero un regalo personalizado', 'ucondieresis'); ?>
          </p>
        </div>
        <span class="whatsapp-sheet__option-arrow">→</span>
      </a>

      <!-- Opción 2: Para negocio -->
      <a 
        href="#"
        class="whatsapp-sheet__option"
        data-action="business">
        <span class="whatsapp-sheet__option-icon">🚀</span>
        <div class="whatsapp-sheet__option-content">
          <h3 class="whatsapp-sheet__option-title">
            <?php esc_html_e('Para mi negocio', 'ucondieresis'); ?>
          </h3>
          <p class="whatsapp-sheet__option-desc">
            <?php esc_html_e('Cotizar productos personalizados', 'ucondieresis'); ?>
          </p>
        </div>
        <span class="whatsapp-sheet__option-arrow">→</span>
      </a>

      <!-- Opción 3: Mensaje rápido -->
      <a 
        href="#"
        class="whatsapp-sheet__option"
        data-action="quick">
        <span class="whatsapp-sheet__option-icon">⚡</span>
        <div class="whatsapp-sheet__option-content">
          <h3 class="whatsapp-sheet__option-title">
            <?php esc_html_e('Mensaje rápido', 'ucondieresis'); ?>
          </h3>
          <p class="whatsapp-sheet__option-desc">
            <?php esc_html_e('Tengo una consulta', 'ucondieresis'); ?>
          </p>
        </div>
        <span class="whatsapp-sheet__option-arrow">→</span>
      </a>

    </div>

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



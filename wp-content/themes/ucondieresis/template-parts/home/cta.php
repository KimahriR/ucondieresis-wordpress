<?php
/**
 * Template Part: Call to Action Section
 * 
 * @package Ucondieresis
 */

$productos_url = get_post_type_archive_link('productos');
?>

<section class="cta-section">
  <div class="cta-content">
    <h2 class="cta__title">
      <?php esc_html_e('Hagamos juntos un regalo que sí emocione', 'ucondieresis'); ?>
    </h2>
    <p class="cta__subtitle">
      <?php esc_html_e('Contáctanos hoy y te enviaremos nuestro catálogo completo con precios y disponibilidad.', 'ucondieresis'); ?>
    </p>

    <!-- Floating WhatsApp Button Integration Point -->
    <div class="cta__whatsapp-focus" id="cta-whatsapp-focus">
      <div class="cta__whatsapp-visual">
        <span class="cta__whatsapp-icon">💬</span>
        <p class="cta__whatsapp-text"><?php esc_html_e('¿Vamos a crear algo juntos?', 'ucondieresis'); ?></p>
      </div>
    </div>

    <div class="cta__buttons">
      <a href="<?php echo esc_url($productos_url); ?>" 
         class="btn btn--secondary">
        <?php esc_html_e('Ver todos los modelos', 'ucondieresis'); ?>
      </a>
    </div>
  </div>
</section>

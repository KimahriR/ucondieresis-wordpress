<?php
/**
 * Template Part: Call to Action Section
 * 
 * @package Ucondieresis
 */

$whatsapp_number = ucondieresis_get_whatsapp_number();
$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);
$whatsapp_message = urlencode(__('Hola, quisiera más información sobre sus productos', 'ucondieresis'));
$whatsapp_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . $whatsapp_message;

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
      <!-- Large WhatsApp Circle Button -->
      <a href="<?php echo esc_url($whatsapp_url); ?>" 
         class="cta__whatsapp-circle"
         target="_blank" 
         rel="noopener noreferrer"
         title="<?php esc_attr_e('Contactar por WhatsApp', 'ucondieresis'); ?>">
        <span class="cta__whatsapp-icon">💬</span>
      </a>
    </div>

    <div class="cta__buttons">
      <a href="<?php echo esc_url($productos_url); ?>" 
         class="btn btn--secondary">
        <?php esc_html_e('Ver todos los modelos', 'ucondieresis'); ?>
      </a>
    </div>
  </div>
</section>

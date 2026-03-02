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
?>

<section class="cta-section">
  <div class="cta-content">
    <h2 class="cta__title">
      <?php esc_html_e('Hagamos juntos un regalo que sí emocione', 'ucondieresis'); ?>
    </h2>
    <p class="cta__subtitle">
      <?php esc_html_e('Contáctanos hoy y te enviaremos nuestro catálogo completo con precios y disponibilidad.', 'ucondieresis'); ?>
    </p>

    <div class="cta__buttons">
      <a href="<?php echo esc_url($whatsapp_url); ?>" 
         class="btn btn--whatsapp" 
         target="_blank" 
         rel="noopener noreferrer">
        <?php esc_html_e('Escríbenos por WhatsApp', 'ucondieresis'); ?>
      </a>
      <a href="<?php echo esc_url(get_post_type_archive_link('productos')); ?>" 
         class="btn btn--secondary">
        <?php esc_html_e('Ver todos los modelos', 'ucondieresis'); ?>
      </a>
    </div>
  </div>
</section>

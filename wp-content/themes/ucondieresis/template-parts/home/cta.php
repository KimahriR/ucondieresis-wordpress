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
        <svg class="cta__whatsapp-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="11" fill="#E94B8A" fill-rule="evenodd"/>
          <path d="M10.64,17.59 C11.67,18.62 13.06,19.56 14.62,20.23 L15.99,20.23 C16.54,20.23 16.99,19.78 16.99,19.23 L16.99,16.76 C16.99,16.21 16.54,15.76 15.99,15.76 L14.62,15.76 C13.06,16.43 11.67,17.37 10.64,18.4 L10.64,15.93 C10.64,15.38 10.19,14.93 9.64,14.93 C9.09,14.93 8.64,15.38 8.64,15.93 L8.64,18.4 C8.64,18.95 9.09,19.4 9.64,19.4 L12.11,19.4 C12.66,19.4 13.11,18.95 13.11,18.4 C13.11,17.85 12.66,17.4 12.11,17.4 L10.64,17.4 L10.64,17.59 Z" fill="white"/>
        </svg>
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

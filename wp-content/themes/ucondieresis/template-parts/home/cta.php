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
          <!-- Pink rounded square background with gradient -->
          <defs>
            <linearGradient id="pinkGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#FF4B8D;stop-opacity:1" />
              <stop offset="100%" style="stop-color:#E91E63;stop-opacity:1" />
            </linearGradient>
          </defs>
          <rect x="0" y="0" width="24" height="24" rx="5.5" fill="url(#pinkGradient)"/>
          
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

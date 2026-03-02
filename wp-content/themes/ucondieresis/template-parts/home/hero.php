<?php
/**
 * Template Part: Home Hero Section
 * 
 * @package Ucondieresis
 */

$whatsapp_number = ucondieresis_get_whatsapp_number();
$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);
$whatsapp_message = urlencode(__('Hola, quisiera ver el catálogo de productos', 'ucondieresis'));
$whatsapp_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . $whatsapp_message;
?>

<section class="hero">
  <div class="hero__content">
    <h1 class="hero__title">
      <?php esc_html_e('Descubre nuestros modelos disponibles', 'ucondieresis'); ?>
    </h1>
    <p class="hero__subtitle">
      <?php esc_html_e('Solicita catálogo actualizado por WhatsApp.', 'ucondieresis'); ?>
    </p>
    
    <div class="hero__buttons">
      <a href="<?php echo esc_url($whatsapp_url); ?>" 
         class="btn btn--whatsapp" 
         target="_blank" 
         rel="noopener noreferrer">
        <?php esc_html_e('Solicitar catálogo por WhatsApp', 'ucondieresis'); ?>
      </a>
      <a href="<?php echo esc_url(get_post_type_archive_link('productos')); ?>" 
         class="btn btn--secondary">
        <?php esc_html_e('Ver todos los productos', 'ucondieresis'); ?>
      </a>
    </div>
  </div>
</section>

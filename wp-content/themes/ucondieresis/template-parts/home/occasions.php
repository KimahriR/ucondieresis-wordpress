<?php
/**
 * Template Part: Occasions Section
 * 
 * @package Ucondieresis
 */

// Get WhatsApp number safely
$whatsapp_number = function_exists('ucondieresis_get_whatsapp_number') 
    ? ucondieresis_get_whatsapp_number() 
    : get_option('ucondieresis_whatsapp_numero', '+34 600 123 456');

$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);

// Ocasiones con mensajes contextuales
$occasions = array(
    array(
        'icon'    => '🎂',
        'title'   => __('Cumpleaños', 'ucondieresis'),
        'message' => __('Hola 😊 quiero un regalo personalizado para cumpleaños. ¿Qué opciones me recomiendas?', 'ucondieresis'),
    ),
    array(
        'icon'    => '💕',
        'title'   => __('Pareja', 'ucondieresis'),
        'message' => __('Hola 💛 quiero un detalle personalizado para mi pareja', 'ucondieresis'),
    ),
    array(
        'icon'    => '🏢',
        'title'   => __('Empresarial', 'ucondieresis'),
        'message' => __('Hola, necesito cotizar regalos personalizados para empresa', 'ucondieresis'),
    ),
    array(
        'icon'    => '🎓',
        'title'   => __('Graduaciones', 'ucondieresis'),
        'message' => __('Hola, quiero un regalo personalizado para graduación', 'ucondieresis'),
    ),
    array(
        'icon'    => '🎄',
        'title'   => __('Temporada', 'ucondieresis'),
        'message' => __('Hola, quiero regalos personalizados para temporada festiva', 'ucondieresis'),
    ),
);
?>

<section class="occasions">
  <div class="occasions__container">
    <h2 class="occasions__title">
      <?php esc_html_e('Para ese momento especial', 'ucondieresis'); ?>
    </h2>
    
    <div class="occasions__grid">
      <?php foreach ($occasions as $occasion) : 
          $whatsapp_message = urlencode($occasion['message']);
          $whatsapp_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . $whatsapp_message;
      ?>
        <a href="<?php echo esc_url($whatsapp_url); ?>" 
           class="occasion-card" 
           target="_blank" 
           rel="noopener noreferrer">
          <div class="occasion-card__icon">
            <?php echo esc_html($occasion['icon']); ?>
          </div>
          <h3 class="occasion-card__title">
            <?php echo esc_html($occasion['title']); ?>
          </h3>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

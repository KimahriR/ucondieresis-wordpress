<?php
/**
 * Template Part: Occasions Section
 * 
 * @package Ucondieresis
 */

// Get WhatsApp number safely
$whatsapp_number = function_exists('ucondieresis_get_whatsapp_number') 
    ? ucondieresis_get_whatsapp_number() 
    : get_option('ucondieresis_whatsapp_numero', '34600123456');

$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);
?>

<section class="occasions" style="padding: 80px 20px; background: white;">
  <div class="occasions__container" style="max-width: 1200px; margin: 0 auto;">
    <h2 class="occasions__title" style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 60px; color: #333;">
      Para ese momento especial
    </h2>
    
    <div class="occasions__grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; max-width: 900px; margin: 0 auto;">
      
      <?php 
      // Pre-defined occasions
      $occasions = array(
          array(
              'emoji' => '🎂',
              'name' => 'Cumpleaños',
              'text' => 'Hola quiero un regalo personalizado para cumpleaños'
          ),
          array(
              'emoji' => '💕',
              'name' => 'Pareja',
              'text' => 'Hola quiero un detalle personalizado para mi pareja'
          ),
          array(
              'emoji' => '🏢',
              'name' => 'Empresarial',
              'text' => 'Hola necesito cotizar regalos personalizados para empresa'
          ),
          array(
              'emoji' => '🎓',
              'name' => 'Graduaciones',
              'text' => 'Hola quiero un regalo personalizado para graduacion'
          ),
          array(
              'emoji' => '🎄',
              'name' => 'Temporada',
              'text' => 'Hola quiero regalos personalizados para temporada festiva'
          ),
      );
      
      foreach ($occasions as $occ) {
          $msg_encoded = urlencode($occ['text']);
          $wa_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . $msg_encoded;
      ?>
          <a href="<?php echo esc_url($wa_url); ?>" 
             class="occasion-card" 
             style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 30px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; cursor: pointer; min-height: 150px;"
             target="_blank" 
             rel="noopener noreferrer"
             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.4)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div class="occasion-card__icon" style="font-size: 3rem; margin-bottom: 15px; display: block;">
              <?php echo $occ['emoji']; ?>
            </div>
            <h3 class="occasion-card__title" style="font-size: 1rem; font-weight: 600; text-align: center; margin: 0; line-height: 1.4;">
              <?php echo esc_html($occ['name']); ?>
            </h3>
          </a>
      <?php } ?>
      
    </div>
  </div>
</section>

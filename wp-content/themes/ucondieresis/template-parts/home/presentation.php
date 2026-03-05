<?php
/**
 * Template Part: Presentation Section
 * 
 * @package Ucondieresis
 */

// Get WhatsApp number safely
$whatsapp_number = function_exists('ucondieresis_get_whatsapp_number') 
    ? ucondieresis_get_whatsapp_number() 
    : get_option('ucondieresis_whatsapp_numero', '34600123456');

$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);
?>

<section class="presentation" style="padding: 80px 20px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);">
  <div class="presentation__container" style="max-width: 1200px; margin: 0 auto;">
    <header class="section-header">
      <h2 class="section-title">
        <?php esc_html_e('Imprime tu estilo', 'ucondieresis'); ?>
      </h2>
      <p class="section-subtitle">
        <?php esc_html_e('Elige cómo quieres sorprender', 'ucondieresis'); ?>
      </p>
    </header>
    
    <div class="presentation__grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
      
      <?php 
      // Presentación options
      $presentations = array(
          array(
              'emoji' => '📦',
              'title' => 'Clásico',
              'desc' => 'Empaque Estándar',
              'text' => 'Hola, quiero empaque clásico para mi regalo personalizado'
          ),
          array(
              'emoji' => '🎁',
              'title' => 'Caja Individual',
              'desc' => 'Presentación Premium',
              'text' => 'Hola, quiero una caja individual para mi regalo personalizado'
          ),
          array(
              'emoji' => '💝',
              'title' => 'Duo',
              'desc' => 'Pack de 2',
              'text' => 'Hola, quiero presentación Duo para mis regalos personalizados'
          ),
          array(
              'emoji' => '✨',
              'title' => 'Especial',
              'desc' => 'Presentación Exclusiva',
              'text' => 'Hola, quiero una presentación especial para mi regalo'
          ),
      );
      
      foreach ($presentations as $pres) {
          $msg_encoded = urlencode($pres['text']);
          $wa_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . $msg_encoded;
      ?>
          <a href="<?php echo esc_url($wa_url); ?>" 
             class="presentation-card" 
             style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px 20px; background: white; color: #333; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 2px solid transparent;"
             target="_blank" 
             rel="noopener noreferrer"
             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.2)'; this.style.borderColor='#667eea';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'; this.style.borderColor='transparent';">
            <div class="presentation-card__emoji" style="font-size: 2.5rem; margin-bottom: 15px;">
              <?php echo $pres['emoji']; ?>
            </div>
            <h3 class="presentation-card__title" style="font-size: 1.1rem; font-weight: 700; margin: 0 0 8px 0; text-align: center;">
              <?php echo esc_html($pres['title']); ?>
            </h3>
            <p class="presentation-card__desc" style="font-size: 0.9rem; color: #666; margin: 0; text-align: center;">
              <?php echo esc_html($pres['desc']); ?>
            </p>
          </a>
      <?php } ?>
      
    </div>
  </div>
</section>

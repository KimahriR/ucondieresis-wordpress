<?php
/**
 * Template Part: Occasions Section (Reorganized into 3 Strategic Blocks)
 * 
 * @package Ucondieresis
 */

// Get WhatsApp number safely
$whatsapp_number = function_exists('ucondieresis_get_whatsapp_number') 
    ? ucondieresis_get_whatsapp_number() 
    : get_option('ucondieresis_whatsapp_numero', '34600123456');

$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);

// Helper function to generate WhatsApp cards
function render_occasion_block($title, $subtitle, $items, $whatsapp_number_clean) {
    ?>
    <div class="occasions__block" style="margin-bottom: 80px;">
      <h3 class="occasions__block-title" style="font-size: 1.8rem; font-weight: 700; color: #333; margin: 0 0 10px 0;">
        <?php echo esc_html($title); ?>
      </h3>
      <p class="occasions__block-subtitle" style="font-size: 1rem; color: #666; margin: 0 0 40px 0; line-height: 1.6;">
        <?php echo esc_html($subtitle); ?>
      </p>
      
      <div class="occasions__grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 20px;">
        <?php 
        foreach ($items as $item) {
            $msg_encoded = urlencode($item['text']);
            $wa_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . $msg_encoded;
        ?>
          <a href="<?php echo esc_url($wa_url); ?>" 
             class="occasion-card" 
             style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 30px 15px; background: white; color: #333; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; cursor: pointer; min-height: 140px; border: 2px solid #f0f0f0; box-shadow: 0 2px 8px rgba(0,0,0,0.06);"
             target="_blank" 
             rel="noopener noreferrer"
             onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='#667eea'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.15)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f0f0f0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)';">
            <div class="occasion-card__icon" style="font-size: 2.2rem; margin-bottom: 12px; display: block;">
              <?php echo $item['emoji']; ?>
            </div>
            <h4 class="occasion-card__title" style="font-size: 0.95rem; font-weight: 600; text-align: center; margin: 0; line-height: 1.4;">
              <?php echo esc_html($item['name']); ?>
            </h4>
          </a>
        <?php } ?>
      </div>
    </div>
    <?php
}
?>

<section class="occasions" style="padding: 80px 20px; background: linear-gradient(to bottom, white 0%, rgba(102, 126, 234, 0.02) 100%);">
  <div class="occasions__container" style="max-width: 1200px; margin: 0 auto;">
    <h2 class="occasions__title" style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 70px; color: #333;">
      Para ese momento especial
    </h2>

    <?php 
    // BLOQUE 1: Momentos Memorables
    $memorable_moments = array(
        array(
            'emoji' => '🎂',
            'name' => 'Cumpleaños',
            'text' => 'Hola 😊 quiero un regalo personalizado para Cumpleaños.'
        ),
        array(
            'emoji' => '💍',
            'name' => 'Bodas',
            'text' => 'Hola 😊 quiero un regalo personalizado para Bodas.'
        ),
        array(
            'emoji' => '👑',
            'name' => 'XV Años',
            'text' => 'Hola 😊 quiero un regalo personalizado para XV Años.'
        ),
        array(
            'emoji' => '⛪',
            'name' => 'Bautizos',
            'text' => 'Hola 😊 quiero un regalo personalizado para Bautizos.'
        ),
        array(
            'emoji' => '✝️',
            'name' => 'Comuniones',
            'text' => 'Hola 😊 quiero un regalo personalizado para Comuniones.'
        ),
        array(
            'emoji' => '🤝',
            'name' => 'Padrinos',
            'text' => 'Hola 😊 quiero un regalo personalizado para mis Padrinos.'
        ),
        array(
            'emoji' => '👶',
            'name' => 'Nacimientos',
            'text' => 'Hola 😊 quiero un regalo personalizado para Nacimientos.'
        ),
    );
    
    render_occasion_block(
        'Momentos Memorables',
        'Celebraciones que marcan la vida y merecen algo único.',
        $memorable_moments,
        $whatsapp_number_clean
    );
    ?>

    <?php 
    // BLOQUE 2: Ediciones de Temporada
    $seasonal_editions = array(
        array(
            'emoji' => '💕',
            'name' => 'San Valentín',
            'text' => 'Hola 🎉 quiero un regalo personalizado para San Valentín.'
        ),
        array(
            'emoji' => '🌹',
            'name' => 'Día de Madres',
            'text' => 'Hola 🎉 quiero un regalo personalizado para Día de Madres.'
        ),
        array(
            'emoji' => '🎩',
            'name' => 'Día del Padre',
            'text' => 'Hola 🎉 quiero un regalo personalizado para Día del Padre.'
        ),
        array(
            'emoji' => '🎓',
            'name' => 'Graduaciones',
            'text' => 'Hola 🎉 quiero un regalo personalizado para Graduaciones.'
        ),
        array(
            'emoji' => '🎄',
            'name' => 'Navidad',
            'text' => 'Hola 🎉 quiero un regalo personalizado para Navidad.'
        ),
        array(
            'emoji' => '🎃',
            'name' => 'Halloween/Día de Muertos',
            'text' => 'Hola 🎉 quiero un regalo personalizado para Halloween/Día de Muertos.'
        ),
    );
    
    render_occasion_block(
        'Ediciones de Temporada',
        'Momentos que llegan cada año y se celebran mejor con intención.',
        $seasonal_editions,
        $whatsapp_number_clean
    );
    ?>

    <?php 
    // BLOQUE 3: Impulsa tu Marca
    $business_items = array(
        array(
            'emoji' => '🎴',
            'name' => 'Tarjetas',
            'text' => 'Hola, quiero cotizar productos personalizados para mi negocio.'
        ),
        array(
            'emoji' => '🎨',
            'name' => 'Banners',
            'text' => 'Hola, quiero cotizar productos personalizados para mi negocio.'
        ),
        array(
            'emoji' => '🧲',
            'name' => 'Imanes',
            'text' => 'Hola, quiero cotizar productos personalizados para mi negocio.'
        ),
    );
    
    render_occasion_block(
        'Impulsa tu Marca',
        'Detalles personalizados que también hacen crecer tu negocio.',
        $business_items,
        $whatsapp_number_clean
    );
    ?>

  </div>
</section>

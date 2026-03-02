<?php
/**
 * Template Part: Occasions Section with Modal Interface
 * 
 * Three main cards with modal dialogs for categories, 
 * direct WhatsApp link for business section.
 * 
 * @package Ucondieresis
 */

// Get WhatsApp number safely
$whatsapp_number = function_exists('ucondieresis_get_whatsapp_number') 
    ? ucondieresis_get_whatsapp_number() 
    : get_option('ucondieresis_whatsapp_numero', '34600123456');

$whatsapp_number_clean = preg_replace('/\D/', '', $whatsapp_number);
?>

<section class="occasions" style="padding: 80px 20px; background: linear-gradient(to bottom, white 0%, rgba(102, 126, 234, 0.02) 100%);">
  <div class="occasions__container" style="max-width: 1200px; margin: 0 auto;">
    <h2 class="occasions__title" style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 70px; color: #333;">
      Para ese momento especial
    </h2>

    <!-- 3 Main Category Cards -->
    <div class="occasions__main-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; max-width: 1000px; margin: 0 auto;">
      
      <!-- Card 1: Momentos Memorables -->
      <button 
        class="occasions__main-card" 
        onclick="document.getElementById('modal-memorable').style.display='flex'"
        style="background: white; border: none; border-radius: 16px; padding: 50px 30px; text-align: center; cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 220px;"
        onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.2)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)';">
        <div style="font-size: 3rem; margin-bottom: 20px;">💛</div>
        <h3 style="font-size: 1.5rem; font-weight: 700; color: #333; margin: 0 0 10px 0;">Momentos Memorables</h3>
        <p style="font-size: 0.95rem; color: #999; margin: 0;">Celebraciones que marcan.</p>
      </button>

      <!-- Card 2: Ediciones de Temporada -->
      <button 
        class="occasions__main-card" 
        onclick="document.getElementById('modal-seasonal').style.display='flex'"
        style="background: white; border: none; border-radius: 16px; padding: 50px 30px; text-align: center; cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 220px;"
        onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.2)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)';">
        <div style="font-size: 3rem; margin-bottom: 20px;">🎄</div>
        <h3 style="font-size: 1.5rem; font-weight: 700; color: #333; margin: 0 0 10px 0;">Ediciones de Temporada</h3>
        <p style="font-size: 0.95rem; color: #999; margin: 0;">Momentos que llegan cada año.</p>
      </button>

      <!-- Card 3: Impulsa tu Marca (Direct WhatsApp) -->
      <a 
        href="<?php echo esc_url('https://wa.me/' . $whatsapp_number_clean . '?text=' . urlencode('Hola 👋 quiero cotizar productos personalizados para mi negocio.')); ?>"
        target="_blank"
        rel="noopener noreferrer"
        style="background: white; border: none; border-radius: 16px; padding: 50px 30px; text-align: center; cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 220px; text-decoration: none;"
        onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.2)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)';">
        <div style="font-size: 3rem; margin-bottom: 20px;">🚀</div>
        <h3 style="font-size: 1.5rem; font-weight: 700; color: #333; margin: 0 0 10px 0;">Impulsa tu Marca</h3>
        <p style="font-size: 0.95rem; color: #999; margin: 0;">Productos para tu negocio.</p>
      </a>

    </div>
  </div>

  <!-- MODAL 1: Momentos Memorables -->
  <div 
    id="modal-memorable" 
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; animation: fadeIn 0.3s ease;"
    onclick="if(event.target.id==='modal-memorable') document.getElementById('modal-memorable').style.display='none';">
    
    <div style="background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); max-width: 700px; width: 100%; padding: 50px 30px; position: relative; animation: slideUp 0.3s ease;">
      <!-- Close Button -->
      <button 
        onclick="document.getElementById('modal-memorable').style.display='none'" 
        style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999; transition: color 0.2s ease;"
        onmouseover="this.style.color='#333';"
        onmouseout="this.style.color='#999';">
        ✕
      </button>

      <h3 style="font-size: 1.8rem; font-weight: 700; text-align: center; color: #333; margin: 0 0 10px 0;">Momentos Memorables</h3>
      <p style="font-size: 1rem; text-align: center; color: #666; margin: 0 0 40px 0;">Celebraciones que marcan la vida.</p>

      <!-- Grid of Items -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
        
        <?php 
        $memorable = array(
            array('emoji' => '🎂', 'name' => 'Cumpleaños', 'phrase' => 'Detalles que hacen sonreír.', 'text' => 'Hola 😊 quiero un regalo personalizado para Cumpleaños.'),
            array('emoji' => '💍', 'name' => 'Bodas', 'phrase' => 'Recuerdos para siempre.', 'text' => 'Hola 😊 quiero un regalo personalizado para Bodas.'),
            array('emoji' => '👑', 'name' => 'XV Años', 'phrase' => 'Un momento en grande.', 'text' => 'Hola 😊 quiero un regalo personalizado para XV Años.'),
            array('emoji' => '👶', 'name' => 'Bautizos', 'phrase' => 'Recuerdos significativos.', 'text' => 'Hola 😊 quiero un regalo personalizado para Bautizos.'),
            array('emoji' => '✨', 'name' => 'Comuniones', 'phrase' => 'Lleno de significado.', 'text' => 'Hola 😊 quiero un regalo personalizado para Comuniones.'),
            array('emoji' => '🍼', 'name' => 'Nacimientos', 'phrase' => 'Bienvenidas emocionantes.', 'text' => 'Hola 😊 quiero un regalo personalizado para Nacimientos.'),
            array('emoji' => '💞', 'name' => 'Padrinos', 'phrase' => 'Agradecimiento con intención.', 'text' => 'Hola 😊 quiero un regalo personalizado para Padrinos.'),
        );
        
        foreach ($memorable as $item) {
            $wa_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . urlencode($item['text']);
        ?>
          <a 
            href="<?php echo esc_url($wa_url); ?>"
            target="_blank"
            rel="noopener noreferrer"
            style="background: #f9f9f9; border: 2px solid #f0f0f0; border-radius: 12px; padding: 25px 15px; text-align: center; text-decoration: none; color: #333; transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;"
            onmouseover="this.style.borderColor='#667eea'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.15)';"
            onmouseout="this.style.borderColor='#f0f0f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="font-size: 2rem; margin-bottom: 10px;"><?php echo $item['emoji']; ?></div>
            <h4 style="font-size: 0.95rem; font-weight: 600; margin: 0 0 6px 0;"><?php echo esc_html($item['name']); ?></h4>
            <p style="font-size: 0.75rem; color: #999; margin: 0; line-height: 1.3;"><?php echo esc_html($item['phrase']); ?></p>
          </a>
        <?php } ?>

      </div>
    </div>
  </div>

  <!-- MODAL 2: Ediciones de Temporada -->
  <div 
    id="modal-seasonal" 
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; animation: fadeIn 0.3s ease;"
    onclick="if(event.target.id==='modal-seasonal') document.getElementById('modal-seasonal').style.display='none';">
    
    <div style="background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); max-width: 700px; width: 100%; padding: 50px 30px; position: relative; animation: slideUp 0.3s ease;">
      <!-- Close Button -->
      <button 
        onclick="document.getElementById('modal-seasonal').style.display='none'" 
        style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999; transition: color 0.2s ease;"
        onmouseover="this.style.color='#333';"
        onmouseout="this.style.color='#999';">
        ✕
      </button>

      <h3 style="font-size: 1.8rem; font-weight: 700; text-align: center; color: #333; margin: 0 0 10px 0;">Ediciones de Temporada</h3>
      <p style="font-size: 1rem; text-align: center; color: #666; margin: 0 0 40px 0;">Momentos que llegan cada año.</p>

      <!-- Grid of Items -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
        
        <?php 
        $seasonal = array(
            array('emoji' => '💘', 'name' => 'San Valentín', 'phrase' => 'Regalos que enamoran.', 'text' => 'Hola 🎉 quiero un regalo personalizado para San Valentín.'),
            array('emoji' => '🌷', 'name' => 'Día de Madres', 'phrase' => 'Gracias por todo, mamá.', 'text' => 'Hola 🎉 quiero un regalo personalizado para Día de Madres.'),
            array('emoji' => '👔', 'name' => 'Día del Padre', 'phrase' => 'Detalles con carácter.', 'text' => 'Hola 🎉 quiero un regalo personalizado para Día del Padre.'),
            array('emoji' => '🎓', 'name' => 'Graduaciones', 'phrase' => 'Logros que se celebran.', 'text' => 'Hola 🎉 quiero un regalo personalizado para Graduaciones.'),
            array('emoji' => '🎄', 'name' => 'Navidad', 'phrase' => 'Regalos con intención.', 'text' => 'Hola 🎉 quiero un regalo personalizado para Navidad.'),
            array('emoji' => '🎃', 'name' => 'Halloween/Día de Muertos', 'phrase' => 'Detalles llenos de tradición.', 'text' => 'Hola 🎉 quiero un regalo personalizado para Halloween/Día de Muertos.'),
        );
        
        foreach ($seasonal as $item) {
            $wa_url = 'https://wa.me/' . $whatsapp_number_clean . '?text=' . urlencode($item['text']);
        ?>
          <a 
            href="<?php echo esc_url($wa_url); ?>"
            target="_blank"
            rel="noopener noreferrer"
            style="background: #f9f9f9; border: 2px solid #f0f0f0; border-radius: 12px; padding: 25px 15px; text-align: center; text-decoration: none; color: #333; transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;"
            onmouseover="this.style.borderColor='#667eea'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.15)';"
            onmouseout="this.style.borderColor='#f0f0f0'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="font-size: 2rem; margin-bottom: 10px;"><?php echo $item['emoji']; ?></div>
            <h4 style="font-size: 0.95rem; font-weight: 600; margin: 0 0 6px 0;"><?php echo esc_html($item['name']); ?></h4>
            <p style="font-size: 0.75rem; color: #999; margin: 0; line-height: 1.3;"><?php echo esc_html($item['phrase']); ?></p>
          </a>
        <?php } ?>

      </div>
    </div>
  </div>

  <!-- CSS Animations -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

</section>

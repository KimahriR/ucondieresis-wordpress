<?php
/**
 * Template Part: Call to Action Section
 * 
 * @package Ucondieresis
 */

$productos_url = get_post_type_archive_link('productos');
?>

<section class="cta-section">
  <div class="cta-content">
    <header class="section-header">
      <h2 class="section-title">
        <?php esc_html_e('Hagamos juntos un regalo que sí emocione', 'ucondieresis'); ?>
      </h2>
      <p class="section-subtitle">
        <?php esc_html_e('Contáctanos hoy y te enviaremos nuestro catálogo completo con precios y disponibilidad.', 'ucondieresis'); ?>
      </p>
    </header>

    <!-- WhatsApp Menu for CTA Section -->
    <div class="cta__whatsapp-menu-container" id="cta-whatsapp-focus">
      <!-- Main Button -->
      <button 
        id="cta-whatsapp-btn" 
        class="cta__whatsapp-button-main"
        aria-label="<?php esc_attr_e('Abrir opciones de WhatsApp', 'ucondieresis'); ?>"
        aria-controls="cta-whatsapp-menu"
        aria-expanded="false">
        <span class="cta__whatsapp-icon">💬</span>
      </button>

      <!-- Menu Options -->
      <div id="cta-whatsapp-menu" class="cta__whatsapp-menu" role="menu">
        <!-- Opción 1: Crear regalo -->
        <button
          class="cta__whatsapp-menu-item cta__whatsapp-menu-item--1"
          data-action="gift"
          title="<?php esc_attr_e('Crear un regalo', 'ucondieresis'); ?>">
          <span class="cta__whatsapp-menu-item-icon">💛</span>
          <span class="cta__whatsapp-menu-item-label"><?php esc_html_e('Crear regalo', 'ucondieresis'); ?></span>
        </button>

        <!-- Opción 2: Para negocio -->
        <button
          class="cta__whatsapp-menu-item cta__whatsapp-menu-item--2"
          data-action="business"
          title="<?php esc_attr_e('Para mi negocio', 'ucondieresis'); ?>">
          <span class="cta__whatsapp-menu-item-icon">🚀</span>
          <span class="cta__whatsapp-menu-item-label"><?php esc_html_e('Para mi negocio', 'ucondieresis'); ?></span>
        </button>

        <!-- Opción 3: Mensaje rápido -->
        <button
          class="cta__whatsapp-menu-item cta__whatsapp-menu-item--3"
          data-action="quick"
          title="<?php esc_attr_e('Mensaje rápido', 'ucondieresis'); ?>">
          <span class="cta__whatsapp-menu-item-icon">⚡</span>
          <span class="cta__whatsapp-menu-item-label"><?php esc_html_e('Mensaje rápido', 'ucondieresis'); ?></span>
        </button>
      </div>
    </div>

    <div class="cta__buttons">
      <a href="<?php echo esc_url($productos_url); ?>" 
         class="btn btn--secondary">
        <?php esc_html_e('Ver todos los modelos', 'ucondieresis'); ?>
      </a>
    </div>
  </div>
</section>

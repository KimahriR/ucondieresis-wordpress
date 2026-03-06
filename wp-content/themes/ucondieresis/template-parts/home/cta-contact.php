<?php
/**
 * Sección Fusionada: CTA + Contacto
 * 
 * Two-column layout:
 * - Izquierda: Botón WhatsApp interactivo
 * - Derecha: Información de contacto + mapa
 * 
 * @package Ucondieresis
 */

namespace Ucondieresis;

if (!defined('ABSPATH')) {
    exit;
}

// Get product archive URL
$productos_url = get_post_type_archive_link('productos');
?>

<section class="cta-contact-section" id="cta-contact">
    <div class="cta-contact-section__container">
        
        <!-- Header -->
        <header class="cta-contact-section__header">
            <h2 class="cta-contact-section__title">
                <?php esc_html_e('Hagamos juntos un regalo que emocione', 'ucondieresis'); ?>
            </h2>
            <p class="cta-contact-section__subtitle">
                <?php esc_html_e('Cada regalo empieza con una idea.', 'ucondieresis'); ?>
            </p>
        </header>

        <!-- Two Column Grid -->
        <div class="cta-contact-grid">
            
            <!-- LEFT COLUMN: WhatsApp CTA -->
            <div class="cta-contact-grid__left">
                <div class="cta-whatsapp-card">
                    
                    <!-- Description -->
                    <p class="cta-whatsapp-card__description">
                        <?php esc_html_e('Cuéntanos qué imaginas y nosotros lo hacemos realidad.', 'ucondieresis'); ?>
                    </p>
                    
                    <!-- Main WhatsApp Button -->
                    <button
                        id="cta-whatsapp-btn"
                        class="cta-whatsapp-card__main-button"
                        aria-label="<?php esc_attr_e('Abrir opciones de WhatsApp', 'ucondieresis'); ?>"
                        aria-controls="cta-whatsapp-menu"
                        aria-expanded="false">
                        <span class="cta-whatsapp-card__icon">💬</span>
                        <span class="cta-whatsapp-card__text"><?php esc_html_e('Contáctanos por WhatsApp', 'ucondieresis'); ?></span>
                    </button>

                    <!-- WhatsApp Menu -->
                    <div id="cta-whatsapp-menu" class="cta-whatsapp-card__menu" role="menu" hidden>
                        
                        <!-- Option 1: Create Gift -->
                        <button
                            class="cta-whatsapp-card__menu-item"
                            data-action="gift"
                            role="menuitem"
                            title="<?php esc_attr_e('Crear un regalo personalizado', 'ucondieresis'); ?>">
                            <span class="cta-whatsapp-card__menu-icon">💛</span>
                            <span class="cta-whatsapp-card__menu-label"><?php esc_html_e('Crear regalo', 'ucondieresis'); ?></span>
                        </button>

                        <!-- Option 2: For Business -->
                        <button
                            class="cta-whatsapp-card__menu-item"
                            data-action="business"
                            role="menuitem"
                            title="<?php esc_attr_e('Soluciones para mi negocio', 'ucondieresis'); ?>">
                            <span class="cta-whatsapp-card__menu-icon">🚀</span>
                            <span class="cta-whatsapp-card__menu-label"><?php esc_html_e('Para mi negocio', 'ucondieresis'); ?></span>
                        </button>

                        <!-- Option 3: Quick Message -->
                        <button
                            class="cta-whatsapp-card__menu-item"
                            data-action="quick"
                            role="menuitem"
                            title="<?php esc_attr_e('Enviar mensaje rápido', 'ucondieresis'); ?>">
                            <span class="cta-whatsapp-card__menu-icon">⚡</span>
                            <span class="cta-whatsapp-card__menu-label"><?php esc_html_e('Mensaje rápido', 'ucondieresis'); ?></span>
                        </button>

                    </div>

                    <p class="cta-whatsapp-card__subtitle">
                        <?php esc_html_e('Responderemos en menos de 1 hora', 'ucondieresis'); ?>
                    </p>
                </div>
            </div>

            <!-- RIGHT COLUMN: Contact Information -->
            <div class="cta-contact-grid__right">
                <div class="contact-info-card">

                    <!-- Address -->
                    <div class="contact-info-card__item">
                        <span class="contact-info-card__icon">📍</span>
                        <div class="contact-info-card__content">
                            <h3 class="contact-info-card__label"><?php esc_html_e('Ubicación', 'ucondieresis'); ?></h3>
                            <p class="contact-info-card__text">
                                <?php esc_html_e('Isla Mujeres 154', 'ucondieresis'); ?><br>
                                <?php esc_html_e('Las Brisas', 'ucondieresis'); ?><br>
                                <?php esc_html_e('CP 25169', 'ucondieresis'); ?><br>
                                <?php esc_html_e('Saltillo, Coahuila', 'ucondieresis'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div class="contact-info-card__item">
                        <span class="contact-info-card__icon">🕐</span>
                        <div class="contact-info-card__content">
                            <h3 class="contact-info-card__label"><?php esc_html_e('Horario', 'ucondieresis'); ?></h3>
                            <p class="contact-info-card__text">
                                <?php esc_html_e('Lunes – Viernes', 'ucondieresis'); ?><br>
                                <?php esc_html_e('11:00 – 19:00', 'ucondieresis'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Map Embed -->
                    <div class="contact-info-card__map-wrapper">
                        <iframe
                            src="https://www.google.com/maps?q=Isla+Mujeres+154+Saltillo+Coahuila&output=embed"
                            width="100%"
                            height="200"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="contact-info-card__map"
                            title="<?php esc_attr_e('Ubicación en Google Maps', 'ucondieresis'); ?>">
                        </iframe>
                    </div>

                    <!-- How to Get There Button -->
                    <a
                        href="https://www.google.com/maps?q=Isla+Mujeres+154+Saltillo+Coahuila"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn--secondary contact-info-card__directions-button">
                        <?php esc_html_e('Cómo llegar', 'ucondieresis'); ?>
                    </a>

                </div>
            </div>

        </div>

    </div>
</section>

<?php wp_reset_postdata();

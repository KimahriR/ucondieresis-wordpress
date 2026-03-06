<?php
/**
 * Contact Section
 * 
 * Two-column contact section with WhatsApp CTA
 * Positioned before footer
 * 
 * @package Ucondieresis
 */

namespace Ucondieresis;

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="contact-section" id="contacto">
    <div class="contact-section__container">
        
        <!-- Left Column: Contact Info -->
        <div class="contact-section__left">
            <header class="contact-section__header">
                <h2 class="contact-section__title">
                    <?php esc_html_e('Hablemos de tu idea', 'ucondieresis'); ?>
                </h2>
                <p class="contact-section__subtitle">
                    <?php esc_html_e('Cada regalo empieza con una idea. Cuéntanos qué imaginas y nosotros lo hacemos realidad.', 'ucondieresis'); ?>
                </p>
            </header>

            <div class="contact-section__info">
                
                <!-- WhatsApp -->
                <div class="contact-info__item">
                    <div class="contact-info__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <div class="contact-info__content">
                        <h3 class="contact-info__label">WhatsApp</h3>
                        <p class="contact-info__text">
                            <a href="https://wa.me/1234567890" target="_blank" rel="noopener noreferrer" class="contact-info__link">
                                +52 (844) XXX-XXXX
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Location -->
                <div class="contact-info__item">
                    <div class="contact-info__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="contact-info__content">
                        <h3 class="contact-info__label"><?php esc_html_e('Ubicación', 'ucondieresis'); ?></h3>
                        <p class="contact-info__text">
                            <?php esc_html_e('Saltillo, Coahuila', 'ucondieresis'); ?>
                        </p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="contact-info__item">
                    <div class="contact-info__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="contact-info__content">
                        <h3 class="contact-info__label"><?php esc_html_e('Horario', 'ucondieresis'); ?></h3>
                        <p class="contact-info__text">
                            <?php esc_html_e('Lun - Vie: 9am - 6pm', 'ucondieresis'); ?><br>
                            <?php esc_html_e('Sábado: 10am - 4pm', 'ucondieresis'); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Column: CTA -->
        <div class="contact-section__right">
            <div class="contact-section__cta-wrapper">
                <div class="contact-section__visual">
                    <svg class="contact-section__icon-large" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="50" cy="50" r="45" opacity="0.1"/>
                        <circle cx="50" cy="50" r="35" opacity="0.15"/>
                        <path d="M 50 20 Q 80 50 50 80 Q 20 50 50 20" opacity="0.2"/>
                    </svg>
                </div>

                <h3 class="contact-section__cta-title">
                    <?php esc_html_e('¿Listo para crear algo increíble?', 'ucondieresis'); ?>
                </h3>

                <p class="contact-section__cta-text">
                    <?php esc_html_e('Nuestro equipo está listo para transformar tu idea en un regalo único que cuente tu historia.', 'ucondieresis'); ?>
                </p>

                <a href="https://wa.me/1234567890" target="_blank" rel="noopener noreferrer" class="contact-section__button">
                    <span class="contact-section__button-icon">💬</span>
                    <span class="contact-section__button-text">
                        <?php esc_html_e('Escríbenos por WhatsApp', 'ucondieresis'); ?>
                    </span>
                </a>

                <p class="contact-section__cta-footer">
                    <?php esc_html_e('Respuesta en menos de 1 hora', 'ucondieresis'); ?>
                </p>
            </div>
        </div>

    </div>
</section>

<?php
/**
 * Site Footer
 * 
 * Three-column footer with brand, navigation, and social links
 * 
 * @package Ucondieresis
 */

namespace Ucondieresis;

if (!defined('ABSPATH')) {
    exit;
}
?>

<footer class="site-footer" role="contentinfo">
    <div class="site-footer__container">
        
        <!-- Column 1: Brand & Mission -->
        <div class="site-footer__column site-footer__brand-column">
            <h3 class="site-footer__brand-title">
                <span class="logo-char logo-char--special">Ü</span><span class="logo-text">condieresis</span>
            </h3>
            <p class="site-footer__tagline">
                <?php esc_html_e('Convertimos ideas en regalos que cuentan historias.', 'ucondieresis'); ?>
            </p>
        </div>

        <!-- Column 2: Navigation -->
        <div class="site-footer__column site-footer__nav-column">
            <h4 class="site-footer__column-title"><?php esc_html_e('Navegación', 'ucondieresis'); ?></h4>
            <ul class="site-footer__nav-list">
                <li><a href="<?php echo esc_url(home_url('/catalogos')); ?>" class="site-footer__link"><?php esc_html_e('Catálogo', 'ucondieresis'); ?></a></li>
                <li><a href="#how-to-buy" class="site-footer__link"><?php esc_html_e('Cómo comprar', 'ucondieresis'); ?></a></li>
                <li><a href="#cta-contact" class="site-footer__link"><?php esc_html_e('Contacto', 'ucondieresis'); ?></a></li>
            </ul>
        </div>

        <!-- Column 3: Social Networks -->
        <div class="site-footer__column site-footer__social-column">
            <h4 class="site-footer__column-title"><?php esc_html_e('Síguenos', 'ucondieresis'); ?></h4>
            <div class="site-footer__social-links">
                <!-- Facebook -->
                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="site-footer__social-link" aria-label="Facebook">
                    <svg class="site-footer__social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 2h-3a6 6 0 0 0-6 6v3H7v4h2v8h4v-8h3l1-4h-4V8a2 2 0 0 1 2-2h1z"></path>
                    </svg>
                    <span class="site-footer__social-text">Facebook</span>
                </a>

                <!-- TikTok -->
                <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="site-footer__social-link" aria-label="TikTok">
                    <svg class="site-footer__social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                    </svg>
                    <span class="site-footer__social-text">TikTok</span>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/1234567890" target="_blank" rel="noopener noreferrer" class="site-footer__social-link" aria-label="WhatsApp">
                    <svg class="site-footer__social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span class="site-footer__social-text">WhatsApp</span>
                </a>
            </div>
        </div>

    </div>

    <!-- Copyright Bar -->
    <div class="site-footer__bottom">
        <p class="site-footer__copyright">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
            <?php esc_html_e('Hecho con creatividad.', 'ucondieresis'); ?>
        </p>
    </div>
</footer>

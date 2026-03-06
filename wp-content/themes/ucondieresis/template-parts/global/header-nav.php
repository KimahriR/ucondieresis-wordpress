<?php
/**
 * Site Header Navigation
 * 
 * Modular header component with logo and minimalist menu
 * Type: Apple Studio Display inspired
 * 
 * @package Ucondieresis
 */

namespace Ucondieresis;

if (!defined('ABSPATH')) {
    exit;
}
?>

<nav class="site-header" id="site-header" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'ucondieresis'); ?>">
    <div class="site-header__container">
        
        <!-- Brand Logo -->
        <div class="site-header__brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo" rel="home" aria-label="<?php bloginfo('name'); ?>">
                <span class="logo-char logo-char--special">Ü</span><span class="logo-text">condieresis</span>
            </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle menu', 'ucondieresis'); ?>" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Primary Menu -->
        <div class="site-header__menu-wrapper" id="site-header-menu-wrapper">
            <ul class="site-header__menu" id="site-header-menu">
                <li class="site-header__menu-item">
                    <a href="#productos" class="site-header__menu-link">
                        <?php esc_html_e('Inspiración', 'ucondieresis'); ?>
                    </a>
                </li>
                <li class="site-header__menu-item">
                    <a href="<?php echo esc_url(home_url('/catalogos')); ?>" class="site-header__menu-link">
                        <?php esc_html_e('Catálogo', 'ucondieresis'); ?>
                    </a>
                </li>
                <li class="site-header__menu-item">
                    <a href="#how-to-buy" class="site-header__menu-link">
                        <?php esc_html_e('Cómo comprar', 'ucondieresis'); ?>
                    </a>
                </li>
                <li class="site-header__menu-item">
                    <a href="#cta-contact" class="site-header__menu-link">
                        <?php esc_html_e('Contacto', 'ucondieresis'); ?>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

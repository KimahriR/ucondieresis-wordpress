<?php
/**
 * Template Part: Catalog Card
 * 
 * @package Ucondieresis
 */

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

// Obtener datos del catálogo
$pdf_url = get_post_meta(get_the_ID(), 'pdf_catalogo', true);
$has_image = has_post_thumbnail();
?>

<article class="catalogo-card" id="catalogo-<?php the_ID(); ?>">
    
    <!-- Catalog Image -->
    <?php if ($has_image) : ?>
        <div class="catalogo-card__image-wrapper">
            <img 
                src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="catalogo-card__image"
            />
        </div>
    <?php else : ?>
        <div class="catalogo-card__image-wrapper catalogo-card__image-wrapper--empty">
            <span class="catalogo-card__image-placeholder">📄</span>
        </div>
    <?php endif; ?>
    
    <!-- Catalog Info -->
    <div class="catalogo-card__content">
        
        <!-- Title -->
        <h2 class="catalogo-card__title">
            <?php the_title(); ?>
        </h2>
        
        <!-- Description -->
        <?php
        $excerpt = get_the_excerpt();
        if (!empty($excerpt)) :
            ?>
            <div class="catalogo-card__description">
                <?php echo wp_kses_post($excerpt); ?>
            </div>
        <?php endif; ?>
        
        <!-- Download Button -->
        <?php if (!empty($pdf_url)) : ?>
            <a 
                href="<?php echo esc_url($pdf_url); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
                class="catalogo-card__button btn btn--primary"
                download
            >
                <span class="catalogo-card__button-text">
                    <?php esc_html_e('Descargar catálogo', 'ucondieresis'); ?>
                </span>
                <span class="catalogo-card__button-icon">📥</span>
            </a>
        <?php else : ?>
            <div class="catalogo-card__button catalogo-card__button--disabled btn btn--disabled">
                <span class="catalogo-card__button-text">
                    <?php esc_html_e('Próximamente', 'ucondieresis'); ?>
                </span>
            </div>
        <?php endif; ?>
        
    </div>
    
</article>

<?php
/**
 * Template para sección de Inspiraciones Sociales
 * 
 * @package Ucondieresis
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

// Obtener posts de inspiraciones (máximo 6, ordenados por menu_order)
$args = [
    'post_type' => 'inspiraciones',
    'posts_per_page' => 6,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_status' => 'publish',
];

$inspirations_query = new \WP_Query($args);

// Si no hay posts, no renderizar nada
if (!$inspirations_query->have_posts()) {
    wp_reset_postdata();
    return;
}
?>

<section class="home-inspiracion" id="home-inspiracion">
    <div class="home-inspiracion__container">
        <header class="home-inspiracion__header">
            <h2 class="home-inspiracion__title">
                <?php esc_html_e('Así cobran vida nuestras ideas', 'ucondieresis'); ?>
            </h2>
            <p class="home-inspiracion__subtitle">
                <?php esc_html_e('Lo que comenzó como una idea terminó en algo especial', 'ucondieresis'); ?>
            </p>
        </header>

        <div class="inspiracion-carousel-wrapper">
            <div class="inspiracion-grid" id="inspiracion-carousel">
                <?php while ($inspirations_query->have_posts()) : $inspirations_query->the_post();
                    $url_externa = get_post_meta(get_the_ID(), '_url_externa', true);
                    $plataforma = get_post_meta(get_the_ID(), '_plataforma', true);
                    $has_image = has_post_thumbnail();
                    $image_url = $has_image ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
                    ?>

                    <article class="inspiracion-card">
                        <?php if ($has_image && $image_url) : ?>
                            <div class="inspiracion-card__image-wrapper">
                                <img 
                                    src="<?php echo esc_url($image_url); ?>" 
                                    alt="<?php the_title_attribute(); ?>" 
                                    class="inspiracion-card__image"
                                    loading="lazy"
                                    width="220"
                                    height="220"
                                />
                                
                                <?php if ($plataforma && $url_externa) : 
                                    $platform_label = ('instagram' === $plataforma) ? 'Instagram' : 'TikTok';
                                    $platform_icon = ('instagram' === $plataforma) ? '📷' : '🎵';
                                    ?>
                                    <div class="inspiracion-card__overlay">
                                        <a 
                                            href="<?php echo esc_url($url_externa); ?>" 
                                            class="inspiracion-card__link"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            aria-label="<?php printf(esc_attr__('Ver en %s - %s', 'ucondieresis'), $platform_label, the_title_attribute(['echo' => 0])); ?>"
                                        >
                                            <span class="inspiracion-card__badge">
                                                <span class="badge-icon"><?php echo esc_html($platform_icon); ?></span>
                                                <span class="badge-text"><?php echo esc_html($platform_label); ?></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="inspiracion-card__content">
                            <h3 class="inspiracion-card__title">
                                <?php the_title(); ?>
                            </h3>
                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <!-- Botones de Navegación del Carrusel -->
            <div class="inspiracion-carousel-nav">
                <button 
                    class="inspiracion-carousel-btn inspiracion-carousel-btn--prev" 
                    id="inspiracion-prev"
                    aria-label="<?php esc_attr_e('Slide anterior', 'ucondieresis'); ?>"
                >
                    &#8249;
                </button>
                <button 
                    class="inspiracion-carousel-btn inspiracion-carousel-btn--next" 
                    id="inspiracion-next"
                    aria-label="<?php esc_attr_e('Siguiente slide', 'ucondieresis'); ?>"
                >
                    &#8250;
                </button>
            </div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>

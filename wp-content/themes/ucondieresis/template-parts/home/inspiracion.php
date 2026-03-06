<?php
/**
 * Template para sección mixta de Inspiración
 * Combina productos destacados + inspiraciones sociales
 * 
 * @package Ucondieresis
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

// Query 1: Productos destacados para home (máximo 3)
$productos_args = [
    'post_type' => 'productos',
    'posts_per_page' => 3,
    'meta_query' => [
        [
            'key' => 'mostrar_en_home',
            'value' => '1',
            'compare' => '='
        ]
    ],
    'post_status' => 'publish',
];

$productos_query = new \WP_Query($productos_args);

// Query 2: Inspiraciones sociales (máximo 3)
$inspiraciones_args = [
    'post_type' => 'inspiraciones',
    'posts_per_page' => 3,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_status' => 'publish',
];

$inspiraciones_query = new \WP_Query($inspiraciones_args);

// Si no hay posts en ninguna query, no renderizar nada
if (!$productos_query->have_posts() && !$inspiraciones_query->have_posts()) {
    wp_reset_postdata();
    return;
}
?>

<section class="inspiracion-section" id="inspiracion">
    <div class="inspiracion-section__container">
        <header class="section-header">
            <h2 class="section-title">
                <?php esc_html_e('De tu idea a algo que se pueda abrazar', 'ucondieresis'); ?>
            </h2>
            <p class="section-subtitle">
                <?php esc_html_e('Mira cómo las ideas se convierten en momentos que se pueden abrazar.', 'ucondieresis'); ?>
            </p>
        </header>

        <!-- Mixed Grid: Productos + Inspiraciones -->
        <div class="inspiracion-grid">

            <!-- PRODUCTOS DESTACADOS -->
            <?php while ($productos_query->have_posts()) : $productos_query->the_post();
                $has_image = has_post_thumbnail();
                $image_url = $has_image ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
                $product_link = get_permalink();
                ?>

                <article class="inspiracion-card inspiracion-card--producto">
                    <?php if ($has_image && $image_url) : ?>
                        <div class="inspiracion-card__image-wrapper">
                            <img 
                                src="<?php echo esc_url($image_url); ?>" 
                                alt="<?php the_title_attribute(); ?>" 
                                class="inspiracion-card__image"
                                loading="lazy"
                                width="240"
                                height="240"
                            />
                            
                            <div class="inspiracion-card__overlay">
                                <a 
                                    href="<?php echo esc_url($product_link); ?>" 
                                    class="inspiracion-card__link"
                                    aria-label="<?php printf(esc_attr__('Ver producto: %s', 'ucondieresis'), the_title_attribute(['echo' => 0])); ?>"
                                >
                                    <span class="inspiracion-card__badge">
                                        <span class="badge-icon">🎁</span>
                                        <span class="badge-text"><?php esc_html_e('Ver Producto', 'ucondieresis'); ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="inspiracion-card__content">
                        <h3 class="inspiracion-card__title">
                            <?php the_title(); ?>
                        </h3>
                    </div>
                </article>

            <?php endwhile; ?>

            <!-- INSPIRACIONES SOCIALES -->
            <?php while ($inspiraciones_query->have_posts()) : $inspiraciones_query->the_post();
                $url_externa = get_post_meta(get_the_ID(), '_url_externa', true);
                $plataforma = get_post_meta(get_the_ID(), '_plataforma', true);
                $has_image = has_post_thumbnail();
                $image_url = $has_image ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
                ?>

                <article class="inspiracion-card inspiracion-card--social">
                    <?php if ($has_image && $image_url) : ?>
                        <div class="inspiracion-card__image-wrapper">
                            <img 
                                src="<?php echo esc_url($image_url); ?>" 
                                alt="<?php the_title_attribute(); ?>" 
                                class="inspiracion-card__image"
                                loading="lazy"
                                width="240"
                                height="240"
                            />
                            
                            <?php if ($plataforma && $url_externa) : 
                                if ('facebook' === $plataforma) {
                                    $platform_label = 'Ver en Facebook';
                                    $platform_icon = '📘';
                                } else {
                                    $platform_label = 'Ver en TikTok';
                                    $platform_icon = '🎵';
                                }
                                ?>
                                <div class="inspiracion-card__overlay">
                                    <a 
                                        href="<?php echo esc_url($url_externa); ?>" 
                                        class="inspiracion-card__link"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="<?php printf(esc_attr__('%s - %s', 'ucondieresis'), $platform_label, the_title_attribute(['echo' => 0])); ?>"
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
    </div>
</section>

<?php wp_reset_postdata(); ?>

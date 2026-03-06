<?php
/**
 * Template: Catálogos Archive
 * 
 * @package Ucondieresis
 */

get_header();
?>

<main id="main" class="site-main archive-catalogo">
    <div class="archive-catalogo__container">
        <!-- Page Header -->
        <header class="archive-catalogo__header">
            <h1 class="archive-catalogo__title">
                <?php esc_html_e('Catálogos disponibles', 'ucondieresis'); ?>
            </h1>
            <p class="archive-catalogo__subtitle">
                <?php esc_html_e('Descarga nuestros catálogos y conoce todas nuestras opciones de personalización', 'ucondieresis'); ?>
            </p>
        </header>

        <!-- Catalogs Grid -->
        <div class="catalogo-grid">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/catalog/card-catalogo');
                }
            } else {
                ?>
                <div class="catalogo-grid__empty">
                    <p><?php esc_html_e('No hay catálogos disponibles en este momento.', 'ucondieresis'); ?></p>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- Pagination -->
        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => esc_html__('Anterior', 'ucondieresis'),
            'next_text' => esc_html__('Siguiente', 'ucondieresis'),
        ));
        ?>
    </div>
</main>

<?php
get_footer();

<?php
/**
 * Template principal del tema
 */

get_header();
?>

<div class="container">
    <main class="content">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            }
        } else {
            echo '<p>No hay contenido disponible</p>';
        }
        ?>
    </main>
    <?php get_sidebar(); ?>
</div>

<?php get_footer();

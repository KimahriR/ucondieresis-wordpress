<?php
/**
 * Template: Page
 * 
 * Master page template. Shows template-parts for front page, 
 * standard content for other pages.
 * 
 * @package Ucondieresis
 */

get_header();
?>

<main id="main" class="site-main">
    <?php
    if (is_front_page()) {
        // Show modular home components for front page
        get_template_part('template-parts/home/hero');
        get_template_part('template-parts/home/occasions');
        get_template_part('template-parts/home/featured');
        get_template_part('template-parts/home/how-to-buy');
        get_template_part('template-parts/home/cta');
    } else {
        // Standard page content
        while (have_posts()) {
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>
            <?php
        }
    }
    ?>
</main>

<?php
get_footer();

<?php
/**
 * Template: Front Page (Homepage)
 * 
 * Modular front page using template-parts for better maintainability.
 * 
 * @package Ucondieresis
 */

get_header();
?>

<main id="main" class="site-main home-page">
    <?php get_template_part('template-parts/home/hero'); ?>
    
    <section id="occasions">
        <?php get_template_part('template-parts/home/occasions'); ?>
    </section>
    
    <section id="featured">
        <?php get_template_part('template-parts/home/featured'); ?>
    </section>
    
    <?php get_template_part('template-parts/home/inspiracion'); ?>
    
    <section id="presentation">
        <?php get_template_part('template-parts/home/presentation'); ?>
    </section>
    
    <section id="how-to-buy">
        <?php get_template_part('template-parts/home/how-to-buy'); ?>
    </section>
    
    <?php get_template_part('template-parts/home/cta'); ?>
    
    <!-- Contact Section -->
    <?php get_template_part('template-parts/home/contacto'); ?>
</main>

<?php
get_footer();

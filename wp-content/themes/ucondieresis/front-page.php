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
    <?php get_template_part('template-parts/home/featured'); ?>
    <?php get_template_part('template-parts/home/how-to-buy'); ?>
    <?php get_template_part('template-parts/home/cta'); ?>
</main>

<?php

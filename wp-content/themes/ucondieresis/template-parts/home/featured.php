<?php
/**
 * Template Part: Featured Products Section
 * 
 * @package Ucondieresis
 */
?>

<section class="featured">
  <div class="featured__container">
    <h2 class="featured__title">
      <?php esc_html_e('De tu idea a algo que se pueda abrazar', 'ucondieresis'); ?>
    </h2>

    <div class="featured__grid">
      <?php
      $args = array(
        'post_type' => 'productos',
        'posts_per_page' => 6,
        'meta_key' => 'ucondieresis_mostrar_en_home',
        'meta_value' => '1'
      );
      
      $query = new WP_Query($args);

      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
          <article class="product-card">
            <div class="product-card__image">
              <?php 
              if (has_post_thumbnail()) {
                the_post_thumbnail('medium', array('class' => 'product-card__img'));
              } else {
                echo '<div class="product-card__image--placeholder">' . esc_html__('Sin imagen', 'ucondieresis') . '</div>';
              }
              ?>
            </div>
            
            <div class="product-card__content">
              <h3 class="product-card__title">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
              
              <?php if (has_excerpt()) : ?>
                <p class="product-card__excerpt">
                  <?php the_excerpt(); ?>
                </p>
              <?php endif; ?>
              
              <a href="<?php the_permalink(); ?>" class="product-card__link">
                <?php esc_html_e('Ver detalles →', 'ucondieresis'); ?>
              </a>
            </div>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p style="text-align: center; color: #999; padding: 40px 20px; grid-column: 1 / -1;">
          <?php esc_html_e('No hay productos destacados aún. ¡Pronto actualizaremos nuestra galería!', 'ucondieresis'); ?>
        </p>
      <?php endif; ?>
    </div>

    <div class="featured__view-all">
      <a href="<?php echo esc_url(get_post_type_archive_link('productos')); ?>" class="btn btn--secondary">
        <?php esc_html_e('Ver todos los modelos', 'ucondieresis'); ?>
      </a>
    </div>
  </div>
</section>

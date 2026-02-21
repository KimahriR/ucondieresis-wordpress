<?php
/**
 * Template: Archive Page for Productos Post Type
 * 
 * @package Ucondieresis
 */

get_header();
?>

<main id="main" class="site-main archive-page archive-productos">
    
    <!-- Archive Header -->
    <div class="archive-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px 20px; text-align: center;">
        <div class="archive-header-content" style="max-width: 800px; margin: 0 auto;">
            <h1 class="page-title" style="font-size: 42px; margin: 0 0 15px 0; font-weight: bold;">
                <?php
                if (is_tax('ocasion')) {
                    $term = get_queried_object();
                    printf(
                        esc_html__('Productos para %s', 'ucondieresis'),
                        esc_html($term->name)
                    );
                } elseif (is_tax('categoria_producto')) {
                    $term = get_queried_object();
                    printf(
                        esc_html__('Categoría: %s', 'ucondieresis'),
                        esc_html($term->name)
                    );
                } else {
                    esc_html_e('Todos Nuestros Productos', 'ucondieresis');
                }
                ?>
            </h1>
            <div class="archive-description">
                <?php
                if (is_tax()) {
                    $term = get_queried_object();
                    if ($term->description) {
                        echo '<p style="font-size: 16px; margin: 0; opacity: 0.95;">' . wp_kses_post($term->description) . '</p>';
                    }
                } else {
                    echo '<p style="font-size: 16px; margin: 0; opacity: 0.95;">';
                    esc_html_e('Explora nuestro catálogo completo de productos personalizados.', 'ucondieresis');
                    echo '</p>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Filters Section -->
    <div class="filters-section" style="padding: 30px 20px; background: #f5f5f5; border-bottom: 1px solid #ddd;">
        <div class="filters-container" style="max-width: 1200px; margin: 0 auto;">
            <div class="filters-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                
                <!-- Filter by Ocasión -->
                <div class="filter-widget">
                    <h4 style="margin: 0 0 10px 0; font-size: 14px; font-weight: bold; color: #333;">
                        <?php esc_html_e('Filtrar por Ocasión:', 'ucondieresis'); ?>
                    </h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        <?php
                        $ocasiones = get_terms([
                            'taxonomy' => 'ocasion',
                            'hide_empty' => true,
                        ]);
                        
                        if (!empty($ocasiones) && !is_wp_error($ocasiones)) {
                            foreach ($ocasiones as $ocasion) {
                                $active = '';
                                if (is_tax('ocasion', $ocasion->term_id)) {
                                    $active = ' style="background: #667eea; color: white;"';
                                } else {
                                    $active = ' style="background: white; color: #333; border: 1px solid #ddd;"';
                                }
                                
                                printf(
                                    '<a href="%s" class="filter-tag"%s>%s</a>',
                                    esc_url(get_term_link($ocasion)),
                                    $active,
                                    esc_html($ocasion->name)
                                );
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Filter by Categoría -->
                <div class="filter-widget">
                    <h4 style="margin: 0 0 10px 0; font-size: 14px; font-weight: bold; color: #333;">
                        <?php esc_html_e('Filtrar por Categoría:', 'ucondieresis'); ?>
                    </h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        <?php
                        $categorias = get_terms([
                            'taxonomy' => 'categoria_producto',
                            'hide_empty' => true,
                        ]);
                        
                        if (!empty($categorias) && !is_wp_error($categorias)) {
                            foreach ($categorias as $categoria) {
                                $active = '';
                                if (is_tax('categoria_producto', $categoria->term_id)) {
                                    $active = ' style="background: #667eea; color: white;"';
                                } else {
                                    $active = ' style="background: white; color: #333; border: 1px solid #ddd;"';
                                }
                                
                                printf(
                                    '<a href="%s" class="filter-tag"%s>%s</a>',
                                    esc_url(get_term_link($categoria)),
                                    $active,
                                    esc_html($categoria->name)
                                );
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Clear Filters -->
                <?php if (is_tax()) : ?>
                <div class="filter-widget">
                    <h4 style="margin: 0 0 10px 0; font-size: 14px; font-weight: bold; color: #333;">
                        &nbsp;
                    </h4>
                    <a href="<?php echo esc_url(get_post_type_archive_link('productos')); ?>" style="display: inline-block; padding: 8px 16px; background: #ddd; color: #333; text-decoration: none; border-radius: 4px; font-size: 14px; transition: all 0.3s;">
                        <?php esc_html_e('Limpiar Filtros', 'ucondieresis'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="archive-content" style="padding: 40px 20px;">
        <div class="products-container" style="max-width: 1200px; margin: 0 auto;">
            
            <?php if (have_posts()) : ?>
                <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; margin-bottom: 40px;">
                    <?php
                    while (have_posts()) {
                        the_post();
                        
                        // Obtener datos del producto
                        $product = ucondieresis_get_product(get_the_ID());
                        $image = '';
                        $image_url = '';
                        
                        if (has_post_thumbnail()) {
                            $image_id = get_post_thumbnail_id();
                            $image_url = wp_get_attachment_image_url($image_id, 'medium');
                            $image = get_the_post_thumbnail(get_the_ID(), 'medium', [
                                'class' => 'product-image',
                                'loading' => 'lazy',
                            ]);
                        } else {
                            $image_url = '';
                            $image = '<div style="width: 100%; padding-bottom: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>';
                        }
                        
                        // Get terms
                        $ocasiones = wp_get_post_terms(get_the_ID(), 'ocasion', ['fields' => 'names']);
                        $categorias = wp_get_post_terms(get_the_ID(), 'categoria_producto', ['fields' => 'names']);
                        
                        ?>
                        <article class="product-card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease; display: flex; flex-direction: column; height: 100%;">
                            
                            <!-- Imagen -->
                            <div class="product-image-wrapper" style="width: 100%; height: 250px; overflow: hidden; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <a href="<?php the_permalink(); ?>" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; text-decoration: none; overflow: hidden;">
                                    <?php echo $image; ?>
                                </a>
                            </div>
                            
                            <!-- Contenido -->
                            <div class="product-info" style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                                
                                <!-- Taxonomías -->
                                <?php if (!empty($ocasiones) || !empty($categorias)) : ?>
                                <div class="product-meta" style="margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 5px;">
                                    <?php
                                    foreach ($ocasiones as $ocasion) {
                                        printf(
                                            '<span class="badge" style="display: inline-block; padding: 4px 10px; background: #e8f5e9; color: #2e7d32; font-size: 11px; border-radius: 4px; font-weight: bold;">%s</span>',
                                            esc_html($ocasion)
                                        );
                                    }
                                    foreach ($categorias as $categoria) {
                                        printf(
                                            '<span class="badge" style="display: inline-block; padding: 4px 10px; background: #e3f2fd; color: #1565c0; font-size: 11px; border-radius: 4px; font-weight: bold;">%s</span>',
                                            esc_html($categoria)
                                        );
                                    }
                                    ?>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Título -->
                                <h3 class="product-title" style="margin: 0 0 10px 0; font-size: 16px; color: #333; font-weight: bold;">
                                    <a href="<?php the_permalink(); ?>" style="color: #333; text-decoration: none; transition: color 0.3s;">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <!-- Descripción corta -->
                                <div class="product-excerpt" style="margin-bottom: 15px; flex: 1;">
                                    <p style="margin: 0; color: #666; font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?>
                                    </p>
                                </div>
                                
                                <!-- Rango de precio -->
                                <?php if (!empty($product['rango_precio'])) : ?>
                                <div class="product-price" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                                    <span style="display: inline-block; color: #25D366; font-weight: bold; font-size: 14px;">
                                        <?php echo esc_html($product['rango_precio']); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                
                                <!-- CTA Button -->
                                <a href="<?php the_permalink(); ?>" class="product-cta" style="display: block; padding: 12px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; text-align: center; font-weight: bold; font-size: 14px; transition: all 0.3s ease;">
                                    <?php esc_html_e('Ver Detalles', 'ucondieresis'); ?>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Pagination -->
                <nav class="pagination" style="display: flex; justify-content: center; gap: 10px; margin-top: 40px;">
                    <?php
                    echo paginate_links([
                        'type' => 'list',
                        'before_page_number' => '<span style="display: inline-block; padding: 8px 12px; background: white; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; transition: all 0.3s;">',
                        'after_page_number' => '</span>',
                        'prev_text' => '← ' . esc_html__('Anterior', 'ucondieresis'),
                        'next_text' => esc_html__('Siguiente', 'ucondieresis') . ' →',
                    ]);
                    ?>
                </nav>
                
            <?php else : ?>
                <div style="text-align: center; padding: 60px 20px; background: #f9f9f9; border-radius: 8px;">
                    <h2 style="color: #333; margin-bottom: 15px;">
                        <?php esc_html_e('No hay productos en esta categoría', 'ucondieresis'); ?>
                    </h2>
                    <p style="color: #666; margin-bottom: 20px;">
                        <?php esc_html_e('Intenta cambiar los filtros o explora otras categorías.', 'ucondieresis'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url()); ?>" style="display: inline-block; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; font-weight: bold;">
                        <?php esc_html_e('Volver al Inicio', 'ucondieresis'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
</main>

<style>
    .archive-productos .product-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }
    
    .archive-productos .product-cta:hover {
        background: #764ba2;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .archive-productos .filter-tag {
        padding: 8px 12px !important;
        border-radius: 4px !important;
        text-decoration: none !important;
        font-size: 13px !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
    }
    
    .archive-produtos .filter-tag:hover {
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .archive-header {
            padding: 40px 20px !important;
        }
        
        .archive-header h1 {
            font-size: 28px !important;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
            gap: 15px !important;
        }
        
        .product-image-wrapper {
            height: 180px !important;
        }
        
        .filters-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<?php
get_footer();

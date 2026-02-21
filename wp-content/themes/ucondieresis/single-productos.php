<?php
/**
 * Template: Single Producto Personalizado
 * 
 * @package Ucondieresis
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container single-producto">
        
        <?php
        while (have_posts()) :
            the_post();
            
            // Obtener datos del producto
            $nivel_personalizacion = get_post_meta(get_the_ID(), 'ucondieresis_nivel_personalizacion', true);
            $incluye = get_post_meta(get_the_ID(), 'ucondieresis_incluye', true);
            $personalizacion = get_post_meta(get_the_ID(), 'ucondieresis_personalizacion', true);
            $tiempo_entrega = get_post_meta(get_the_ID(), 'ucondieresis_tiempo_entrega_dias', true);
            $rango_precio = get_post_meta(get_the_ID(), 'ucondieresis_rango_precio', true);
            
            // Obtener ocasión
            $ocasiones = get_the_terms(get_the_ID(), 'ocasion');
            $ocasion_nombres = [];
            if ($ocasiones && !is_wp_error($ocasiones)) {
                $ocasion_nombres = wp_list_pluck($ocasiones, 'name');
            }
            
            // Obtener categoría
            $categorias = get_the_terms(get_the_ID(), 'categoria_producto');
            $categoria_nombres = [];
            if ($categorias && !is_wp_error($categorias)) {
                $categoria_nombres = wp_list_pluck($categorias, 'name');
            }
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('product-single'); ?>>
            
            <!-- Hero Section -->
            <div class="producto-hero">
                <?php
                if (has_post_thumbnail()) {
                    echo '<div class="producto-hero-image">';
                    the_post_thumbnail('full', [
                        'class' => 'hero-image',
                        'alt' => get_the_title(),
                    ]);
                    echo '</div>';
                } else {
                    echo '<div class="producto-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 400px; display: flex; align-items: center; justify-content: center; color: white;">';
                    echo '<span style="font-size: 18px; text-align: center;">' . esc_html__('Imagen del producto', 'ucondieresis') . '</span>';
                    echo '</div>';
                }
                ?>
            </div>
            
            <!-- Información Principal -->
            <div class="producto-info" style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
                
                <!-- Título -->
                <div class="producto-header" style="margin-bottom: 30px;">
                    <h1 class="producto-title" style="font-size: 32px; margin: 0 0 15px 0; color: #333;">
                        <?php the_title(); ?>
                    </h1>
                    
                    <!-- Ocasión y Categoría -->
                    <?php if (!empty($ocasion_nombres) || !empty($categoria_nombres)) : ?>
                    <div class="producto-taxonomy" style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <?php if (!empty($ocasion_nombres)) : ?>
                        <div class="ocasion-tags">
                            <strong><?php esc_html_e('Para:', 'ucondieresis'); ?></strong>
                            <?php foreach ($ocasion_nombres as $ocasion) : ?>
                                <span class="tag" style="display: inline-block; background: #e8f4f8; color: #0073aa; padding: 5px 12px; border-radius: 20px; margin-left: 5px; font-size: 14px;">
                                    <?php echo esc_html($ocasion); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($categoria_nombres)) : ?>
                        <div class="categoria-tags">
                            <strong><?php esc_html_e('Categoría:', 'ucondieresis'); ?></strong>
                            <?php foreach ($categoria_nombres as $categoria) : ?>
                                <span class="tag" style="display: inline-block; background: #f4e8e8; color: #8b4513; padding: 5px 12px; border-radius: 20px; margin-left: 5px; font-size: 14px;">
                                    <?php echo esc_html($categoria); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Descripción Principal -->
                <div class="producto-description" style="margin-bottom: 40px;">
                    <div class="content" style="font-size: 16px; line-height: 1.6; color: #555;">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <!-- Nivel de Personalización -->
                <?php if (!empty($nivel_personalizacion)) : ?>
                <div class="producto-nivel" style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #0073aa;">
                    <h3 style="margin: 0 0 10px 0; color: #333;">
                        <?php esc_html_e('Nivel de Personalización', 'ucondieresis'); ?>
                    </h3>
                    <p style="margin: 0; color: #666; font-size: 16px;">
                        <?php
                        $niveles = [
                            'bajo' => __('Bajo - Solo cambio de nombre', 'ucondieresis'),
                            'medio' => __('Medio - Diseño + Personalización', 'ucondieresis'),
                            'alto' => __('Alto - Diseño Custom 100%', 'ucondieresis'),
                        ];
                        echo esc_html($niveles[$nivel_personalizacion] ?? $nivel_personalizacion);
                        ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <!-- ¿Qué Incluye? -->
                <?php if (!empty($incluye)) : ?>
                <div class="producto-includes" style="margin-bottom: 30px;">
                    <h3 style="margin: 0 0 15px 0; color: #333; font-size: 18px;">
                        ✓ <?php esc_html_e('¿Qué incluye?', 'ucondieresis'); ?>
                    </h3>
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <?php
                        $items = array_filter(array_map('trim', explode("\n", $incluye)));
                        foreach ($items as $item) :
                            if (!empty($item)) :
                        ?>
                            <li style="padding: 8px 0 8px 25px; position: relative; color: #555;">
                                <span style="position: absolute; left: 0; color: #25D366; font-weight: bold;">✓</span>
                                <?php echo esc_html($item); ?>
                            </li>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <!-- Opciones de Personalización -->
                <?php if (!empty($personalizacion)) : ?>
                <div class="producto-customization" style="margin-bottom: 30px;">
                    <h3 style="margin: 0 0 15px 0; color: #333; font-size: 18px;">
                        🎨 <?php esc_html_e('Puedes personalizar:', 'ucondieresis'); ?>
                    </h3>
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <?php
                        $items = array_filter(array_map('trim', explode("\n", $personalizacion)));
                        foreach ($items as $item) :
                            if (!empty($item)) :
                        ?>
                            <li style="padding: 8px 0 8px 25px; position: relative; color: #555;">
                                <span style="position: absolute; left: 0; color: #667eea; font-weight: bold;">→</span>
                                <?php echo esc_html($item); ?>
                            </li>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <!-- Información de Entrega y Precio -->
                <div class="producto-details" style="background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                    <div class="details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                        
                        <?php if (!empty($rango_precio)) : ?>
                        <div class="detail-item">
                            <strong style="display: block; margin-bottom: 5px; color: #333;">
                                💰 <?php esc_html_e('Rango de Precio', 'ucondieresis'); ?>
                            </strong>
                            <span style="font-size: 18px; color: #0073aa; font-weight: bold;">
                                <?php echo esc_html($rango_precio); ?>
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($tiempo_entrega)) : ?>
                        <div class="detail-item">
                            <strong style="display: block; margin-bottom: 5px; color: #333;">
                                ⏱️ <?php esc_html_e('Tiempo de Entrega', 'ucondieresis'); ?>
                            </strong>
                            <span style="font-size: 16px; color: #666;">
                                <?php
                                printf(
                                    _n('%d día hábil', '%d días hábiles', $tiempo_entrega, 'ucondieresis'),
                                    $tiempo_entrega
                                );
                                ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="producto-cta" style="text-align: center; margin-bottom: 40px;">
                    <?php
                    // Usar función de WhatsApp utils para renderizar botón
                    $boton = \Ucondieresis\WhatsApp_Utils::render_dynamic_button(
                        get_the_ID(),
                        'btn btn-large btn-whatsapp'
                    );
                    
                    if ($boton) {
                        // Agregar estilos mejorados al botón
                        echo str_replace(
                            '<a ',
                            '<a style="display: inline-block; padding: 15px 40px; background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'" ',
                            $boton
                        );
                    }
                    ?>
                </div>
                
                <!-- Información Adicional -->
                <div class="producto-footer" style="border-top: 2px solid #eee; padding-top: 20px; text-align: center; color: #888; font-size: 14px;">
                    <p style="margin: 0;">
                        <?php esc_html_e('Todos los productos se cotizan de forma personalizada según tus necesidades específicas.', 'ucondieresis'); ?>
                    </p>
                    <p style="margin: 10px 0 0 0;">
                        <?php esc_html_e('Consúltanos por WhatsApp para recibir tu cotización exclusiva.', 'ucondieresis'); ?>
                    </p>
                </div>
            </div>
        </article>
        
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</main>

<style>
    .single-producto {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .producto-hero {
        margin-bottom: 40px;
    }
    
    .producto-hero-image {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 300px;
        background: #f5f5f5;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .producto-hero-image img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    @media (max-width: 768px) {
        .producto-info {
            margin: 20px auto !important;
            padding: 0 15px !important;
        }
        
        .producto-title {
            font-size: 24px !important;
        }
        
        .producto-taxonomy {
            flex-direction: column !important;
        }
        
        .details-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<?php
get_footer();

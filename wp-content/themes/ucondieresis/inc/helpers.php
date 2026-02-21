<?php
/**
 * Funciones Helper del Tema Ucondieresis
 * 
 * @package Ucondieresis
 */

use Ucondieresis\CPT_Productos;
use Ucondieresis\WhatsApp_Utils;

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtener productos destacados para home
 * 
 * @param int $limit Cantidad de productos
 * @return array
 */
function ucondieresis_get_featured_products($limit = 4) {
    return CPT_Productos::get_featured_products($limit);
}

/**
 * Renderizar producto destacado como tarjeta
 * 
 * @param array $producto Datos del producto
 * @return string HTML de la tarjeta
 */
function ucondieresis_render_product_card($producto) {
    if (empty($producto)) {
        return '';
    }
    
    ob_start();
    ?>
    <div class="ucondieresis-product-card" style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        
        <!-- Imagen -->
        <?php if (!empty($producto['imagen'])) : ?>
        <div class="product-card-image" style="height: 250px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <a href="<?php echo esc_url($producto['url']); ?>" title="<?php echo esc_attr($producto['titulo']); ?>">
                <img src="<?php echo esc_url($producto['imagen']); ?>" 
                     alt="<?php echo esc_attr($producto['titulo']); ?>" 
                     style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;">
            </a>
        </div>
        <?php else : ?>
        <div class="product-card-placeholder" style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <span><?php esc_html_e('Imagen próximamente', 'ucondieresis'); ?></span>
        </div>
        <?php endif; ?>
        
        <!-- Contenido -->
        <div class="product-card-content" style="padding: 20px;">
            
            <!-- Título -->
            <h3 class="product-card-title" style="margin: 0 0 10px 0; font-size: 18px; line-height: 1.4;">
                <a href="<?php echo esc_url($producto['url']); ?>" style="text-decoration: none; color: #333;">
                    <?php echo esc_html($producto['titulo']); ?>
                </a>
            </h3>
            
            <!-- Ocasión -->
            <?php if (!empty($producto['ocasion']) || !empty($producto['categoria'])) : ?>
            <div class="product-card-taxonomy" style="margin-bottom: 10px; font-size: 12px; color: #666;">
                <?php if (!empty($producto['ocasion'])) : ?>
                    <span style="display: block; margin-bottom: 3px;">
                        <strong><?php esc_html_e('Para:', 'ucondieresis'); ?></strong>
                        <?php 
                        $ocasiones = is_array($producto['ocasion']) ? implode(', ', $producto['ocasion']) : $producto['ocasion'];
                        echo esc_html($ocasiones);
                        ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($producto['categoria'])) : ?>
                    <span style="display: block;">
                        <strong><?php esc_html_e('Tipo:', 'ucondieresis'); ?></strong>
                        <?php 
                        $categorias = is_array($producto['categoria']) ? implode(', ', $producto['categoria']) : $producto['categoria'];
                        echo esc_html($categorias);
                        ?>
                    </span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Precio -->
            <?php if (!empty($producto['rango_precio'])) : ?>
            <div class="product-card-price" style="margin: 12px 0; padding: 10px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                <span style="color: #0073aa; font-weight: bold; font-size: 16px;">
                    <?php echo esc_html($producto['rango_precio']); ?>
                </span>
            </div>
            <?php endif; ?>
            
            <!-- Botón -->
            <div class="product-card-action" style="margin-top: 15px;">
                <?php 
                $button = WhatsApp_Utils::render_dynamic_button(
                    $producto['id'],
                    'btn btn-whatsapp'
                );
                
                if ($button) {
                    echo str_replace(
                        '<a ',
                        '<a style="display: inline-block; width: 100%; text-align: center; padding: 10px; background: #25D366; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; transition: background 0.2s;" ',
                        $button
                    );
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    
    return ob_get_clean();
}

/**
 * Renderizar grid de productos destacados con HTML semántico
 * 
 * @param int $limit Cantidad de productos
 * @param int $columns Columnas en desktop
 * @return string HTML del grid
 */
function ucondieresis_render_featured_products_grid($limit = 4, $columns = 4) {
    $productos = ucondieresis_get_featured_products($limit);
    
    if (empty($productos)) {
        return '<p style="text-align: center; color: #666; padding: 40px 20px;">' . 
            esc_html__('No hay productos destacados disponibles en este momento.', 'ucondieresis') . 
            '</p>';
    }
    
    // Validar columnas
    if ($columns < 1 || $columns > 12) {
        $columns = 4;
    }
    
    $html = '<section class="ucondieresis-featured-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; max-width: 1200px; margin: 0 auto; padding: 20px;">';
    
    foreach ($productos as $producto) {
        $html .= ucondieresis_render_product_card($producto);
    }
    
    $html .= '</section>';
    
    return $html;
}

/**
 * Obtener información de un producto por ID
 * 
 * @param int $product_id ID del producto
 * @return array
 */
function ucondieresis_get_product($product_id) {
    return CPT_Productos::get_product($product_id);
}

/**
 * Renderizar botón WhatsApp dinámico
 * 
 * @param int $product_id ID del producto
 * @param string $text Texto del botón
 * @param string $css_class Clase CSS personalizada
 * @return string HTML del botón
 */
function ucondieresis_whatsapp_button($product_id = 0, $text = '', $css_class = '') {
    return WhatsApp_Utils::render_dynamic_button($product_id, $css_class) ?: '';
}

/**
 * Obtener enlace de WhatsApp
 * 
 * @param int $product_id ID del producto
 * @return string URL de WhatsApp
 */
function ucondieresis_get_whatsapp_link($product_id = 0) {
    if (0 === $product_id && in_the_loop()) {
        $product_id = get_the_ID();
    }
    
    return WhatsApp_Utils::generate_link($product_id);
}

/**
 * Obtener mensaje de WhatsApp
 * 
 * @param int $product_id ID del producto
 * @return string Mensaje para WhatsApp
 */
function ucondieresis_get_whatsapp_message($product_id = 0) {
    if (0 === $product_id && in_the_loop()) {
        $product_id = get_the_ID();
    }
    
    return WhatsApp_Utils::generate_message($product_id);
}

/**
 * Formatear lista de items (qué incluye, personalización, etc.)
 * 
 * @param string $text Texto con items separados por líneas
 * @param bool $return Retornar o echo
 * @return string|void
 */
function ucondieresis_render_items_list($text, $return = false) {
    if (empty($text)) {
        return $return ? '' : '';
    }
    
    $items = array_filter(array_map('trim', explode("\n", $text)));
    
    if (empty($items)) {
        return $return ? '' : '';
    }
    
    ob_start();
    ?>
    <ul style="list-style: none; margin: 0; padding: 0;">
        <?php foreach ($items as $item) : ?>
            <li style="padding: 8px 0 8px 25px; position: relative; color: #555;">
                <span style="position: absolute; left: 0; color: #25D366; font-weight: bold;">✓</span>
                <?php echo esc_html($item); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    
    $output = ob_get_clean();
    
    if ($return) {
        return $output;
    }
    echo $output;
}

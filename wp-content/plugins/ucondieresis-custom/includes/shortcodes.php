<?php
/**
 * Shortcodes del Plugin
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar shortcodes
 * 
 * @return void
 */
function register_shortcodes() {
    add_shortcode('ucondieresis_whatsapp_button', 'Ucondieresis\\shortcode_whatsapp_button');
    add_shortcode('ucondieresis_featured_products', 'Ucondieresis\\shortcode_featured_products');
}
add_action('init', 'Ucondieresis\\register_shortcodes');

/**
 * Shortcode: [ucondieresis_whatsapp_button]
 * 
 * Renderiza botón de WhatsApp para el producto actual
 * 
 * Atributos:
 *  - post_id: ID del producto (opcional, usa el actual en el loop)
 *  - text: Texto del botón (opcional)
 *  - class: Clase CSS personalizada (opcional)
 * 
 * Ejemplo: [ucondieresis_whatsapp_button text="Diseña el tuyo" class="btn-lg"]
 * 
 * @param array $atts Atributos del shortcode
 * @return string HTML del botón
 */
function shortcode_whatsapp_button($atts = []) {
    $atts = shortcode_atts(
        [
            'post_id' => 0,
            'text' => '',
            'class' => '',
        ],
        $atts,
        'ucondieresis_whatsapp_button'
    );
    
    $post_id = intval($atts['post_id']);
    $button_text = sanitize_text_field($atts['text']);
    $button_class = sanitize_text_field($atts['class']);
    
    return WhatsApp_Utils::render_dynamic_button($post_id, $button_class) ?: '';
}

/**
 * Shortcode: [ucondieresis_featured_products]
 * 
 * Renderiza grid de productos destacados
 * 
 * Atributos:
 *  - limit: Cantidad de productos (default: 4)
 *  - columns: Columnas en desktop (default: 4)
 * 
 * Ejemplo: [ucondieresis_featured_products limit="6" columns="3"]
 * 
 * @param array $atts Atributos del shortcode
 * @return string HTML del grid
 */
function shortcode_featured_products($atts = []) {
    $atts = shortcode_atts(
        [
            'limit' => 4,
            'columns' => 4,
        ],
        $atts,
        'ucondieresis_featured_products'
    );
    
    $limit = intval($atts['limit']);
    $columns = intval($atts['columns']);
    
    // Validar valores
    if ($limit < 1) $limit = 4;
    if ($columns < 1 || $columns > 12) $columns = 4;
    
    // Obtener productos destacados
    $productos = CPT_Productos::get_featured_products($limit);
    
    if (empty($productos)) {
        return '<p class="text-center">' . esc_html__('No hay productos destacados disponibles.', 'ucondieresis-custom') . '</p>';
    }
    
    // Iniciar HTML
    $html = '<div class="ucondieresis-featured-products" data-columns="' . esc_attr($columns) . '">';
    $html .= '<div class="productos-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">';
    
    // Renderizar cada producto
    foreach ($productos as $producto) {
        $html .= '<div class="producto-card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; transition: transform 0.2s;">';
        
        // Imagen
        if (!empty($producto['imagen'])) {
            $html .= '<div class="producto-thumbnail" style="height: 250px; overflow: hidden; background: #f5f5f5;">';
            $html .= '<img src="' . esc_url($producto['imagen']) . '" alt="' . esc_attr($producto['titulo']) . '" style="width: 100%; height: 100%; object-fit: cover;">';
            $html .= '</div>';
        }
        
        // Contenido
        $html .= '<div class="producto-content" style="padding: 15px;">';
        
        // Título
        $html .= '<h3 class="producto-title" style="margin: 0 0 10px 0; font-size: 18px;">';
        $html .= '<a href="' . esc_url($producto['url']) . '" style="text-decoration: none; color: #333;">';
        $html .= esc_html($producto['titulo']);
        $html .= '</a>';
        $html .= '</h3>';
        
        // Ocasión si existe
        if (!empty($producto['ocasion'])) {
            $html .= '<p class="producto-occasion" style="margin: 5px 0; color: #666; font-size: 14px;">';
            $html .= '<strong>' . esc_html__('Para:', 'ucondieresis-custom') . '</strong> ';
            $html .= is_array($producto['ocasion']) ? implode(', ', array_map('esc_html', $producto['ocasion'])) : esc_html($producto['ocasion']);
            $html .= '</p>';
        }
        
        // Rango de precio si existe
        if (!empty($producto['rango_precio'])) {
            $html .= '<p class="producto-price" style="margin: 10px 0; color: #0073aa; font-weight: bold; font-size: 16px;">';
            $html .= esc_html($producto['rango_precio']);
            $html .= '</p>';
        }
        
        // Botón
        $html .= '<div class="producto-action" style="margin-top: 15px;">';
        $button = WhatsApp_Utils::render_dynamic_button($producto['id'], 'btn btn-whatsapp' . (0 === strpos($producto['boton_cta_tipo'] ?? 'whatsapp', 'whatsapp') ? '' : ' btn-primary'));
        if ($button) {
            // Agregar estilos básicos al botón si no los tiene
            $html .= str_replace('<a ', '<a style="display: inline-block; padding: 10px 20px; background: #25D366; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; " ', $button);
        }
        $html .= '</div>';
        
        $html .= '</div>'; // .producto-content
        $html .= '</div>'; // .producto-card
    }
    
    $html .= '</div>'; // .productos-grid
    $html .= '</div>'; // .ucondieresis-featured-products
    
    return $html;
}

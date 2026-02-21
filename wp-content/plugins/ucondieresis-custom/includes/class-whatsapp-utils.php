<?php
/**
 * WhatsApp Utilities - Generación de enlaces y mensajes dinámicos
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase para manejar integración con WhatsApp
 * 
 * @class WhatsApp_Utils
 */
class WhatsApp_Utils {
    
    /**
     * Obtener número de WhatsApp configurado
     * 
     * Usa la configuración del plugin para permitir cambios dinámicos
     * 
     * @return string Número de WhatsApp (sin formato +/-)
     */
    private static function get_whatsapp_number() {
        return ucondieresis_get_whatsapp_number();
    }
    
    /**
     * Generar mensaje automático para el producto
     * 
     * @param int $post_id ID del producto
     * @return string Mensaje generado
     */
    public static function generate_message($post_id = 0) {
        // Si no se proporciona ID, usar post actual
        if (0 === $post_id && in_the_loop()) {
            $post_id = get_the_ID();
        }
        
        if (0 === $post_id) {
            return '';
        }
        
        $product = get_post($post_id);
        if (!$product || CPT_Productos::POST_TYPE !== $product->post_type) {
            return '';
        }
        
        $titulo = $product->post_title;
        
        // Obtener ocasión si existe
        $ocasiones = get_the_terms($post_id, 'ocasion');
        $ocasion_texto = '';
        
        if ($ocasiones && !is_wp_error($ocasiones)) {
            $ocasion_nombre = $ocasiones[0]->name;
            $ocasion_texto = ' para ' . $ocasion_nombre;
        }
        
        // Construir mensaje
        $mensaje = sprintf(
            __('Hola, me interesa cotizar el producto %s%s. Me gustaría personalizarlo según mis necesidades.', 'ucondieresis-custom'),
            $titulo,
            $ocasion_texto
        );
        
        /**
         * Filtro para modificar el mensaje de WhatsApp
         * 
         * @param string $mensaje Mensaje generado
         * @param int $post_id ID del producto
         */
        return apply_filters('ucondieresis_whatsapp_message', $mensaje, $post_id);
    }
    
    /**
     * Generar URL de WhatsApp con mensaje prellenado
     * 
     * @param int $post_id ID del producto
     * @param string $custom_message Mensaje personalizado (opcional)
     * @return string URL completa de WhatsApp
     */
    public static function generate_link($post_id = 0, $custom_message = '') {
        // Si no se proporciona ID, usar post actual
        if (0 === $post_id && in_the_loop()) {
            $post_id = get_the_ID();
        }
        
        if (0 === $post_id) {
            return '';
        }
        
        // Determinar el mensaje a usar
        if (empty($custom_message)) {
            $custom_message = self::generate_message($post_id);
        }
        
        if (empty($custom_message)) {
            return '';
        }
        
        // Codificar el mensaje
        $encoded_message = urlencode($custom_message);
        
        // Construir URL usando número configurado
        $whatsapp_url = 'https://wa.me/' . self::get_whatsapp_number() . '?text=' . $encoded_message;
        
        /**
         * Filtro para modificar la URL de WhatsApp
         * 
         * @param string $whatsapp_url URL generada
         * @param int $post_id ID del producto
         * @param string $custom_message Mensaje utilizado
         */
        return apply_filters('ucondieresis_whatsapp_link', $whatsapp_url, $post_id, $custom_message);
    }
    
    /**
     * Renderizar botón de WhatsApp
     * 
     * @param int $post_id ID del producto (0 = post actual)
     * @param string $button_text Texto del botón
     * @param string $button_class Clase CSS personalizada (opcional)
     * @return string HTML del botón
     */
    public static function render_button($post_id = 0, $button_text = '', $button_class = '') {
        // Si no se proporciona ID, usar post actual
        if (0 === $post_id && in_the_loop()) {
            $post_id = get_the_ID();
        }
        
        if (0 === $post_id) {
            return '';
        }
        
        // Texto del botón por defecto
        if (empty($button_text)) {
            $button_text = __('Cotizar por WhatsApp', 'ucondieresis-custom');
        }
        
        // Clase CSS por defecto
        if (empty($button_class)) {
            $button_class = 'btn btn-whatsapp';
        }
        
        // Generar URL
        $whatsapp_url = self::generate_link($post_id);
        
        if (empty($whatsapp_url)) {
            return '';
        }
        
        // HTML del botón
        $button_html = sprintf(
            '<a href="%s" class="%s" target="_blank" rel="noopener noreferrer">%s</a>',
            esc_url($whatsapp_url),
            esc_attr($button_class),
            esc_html($button_text)
        );
        
        /**
         * Filtro para modificar el HTML del botón
         * 
         * @param string $button_html HTML del botón
         * @param int $post_id ID del producto
         * @param string $button_text Texto del botón
         */
        return apply_filters('ucondieresis_whatsapp_button_html', $button_html, $post_id, $button_text);
    }
    
    /**
     * Obtener mensaje personalizado desde meta del producto
     * 
     * @param int $post_id ID del producto
     * @return string Mensaje personalizado o vacío
     */
    public static function get_custom_message($post_id) {
        return get_post_meta($post_id, 'ucondieresis_mensaje_whatsapp', true);
    }
    
    /**
     * Obtener texto del botón desde meta del producto
     * 
     * @param int $post_id ID del producto
     * @return string Texto del botón o vacío
     */
    public static function get_button_text($post_id) {
        $text = get_post_meta($post_id, 'ucondieresis_boton_cta_texto', true);
        return !empty($text) ? $text : __('Cotizar por WhatsApp', 'ucondieresis-custom');
    }
    
    /**
     * Obtener tipo de contacto del producto
     * 
     * @param int $post_id ID del producto
     * @return string Tipo: whatsapp, email, formulario
     */
    public static function get_contact_type($post_id) {
        $type = get_post_meta($post_id, 'ucondieresis_boton_cta_tipo', true);
        return !empty($type) ? $type : 'whatsapp';
    }
    
    /**
     * Renderizar botón dinámico basado en tipo de contacto
     * 
     * @param int $post_id ID del producto
     * @param string $button_class Clase CSS personalizada
     * @return string HTML del botón
     */
    public static function render_dynamic_button($post_id = 0, $button_class = '') {
        // Si no se proporciona ID, usar post actual
        if (0 === $post_id && in_the_loop()) {
            $post_id = get_the_ID();
        }
        
        if (0 === $post_id) {
            return '';
        }
        
        $contact_type = self::get_contact_type($post_id);
        $button_text = self::get_button_text($post_id);
        
        // Clase por defecto
        if (empty($button_class)) {
            $button_class = 'btn btn-primary';
        }
        
        switch ($contact_type) {
            case 'whatsapp':
                $custom_message = self::get_custom_message($post_id);
                return self::render_button($post_id, $button_text, $button_class . ' btn-whatsapp');
                
            case 'email':
                $email = get_bloginfo('admin_email');
                $subject = sprintf(__('Consulta sobre producto: %s', 'ucondieresis-custom'), get_the_title($post_id));
                $mailto = sprintf(
                    '<a href="mailto:%s?subject=%s" class="%s">%s</a>',
                    esc_attr($email),
                    esc_attr($subject),
                    esc_attr($button_class . ' btn-email'),
                    esc_html($button_text)
                );
                return $mailto;
                
            case 'formulario':
                // Se manejará con un filtro para plugin de formularios
                return apply_filters(
                    'ucondieresis_contact_form_button',
                    sprintf('<a class="%s" href="#contact-form">%s</a>', esc_attr($button_class . ' btn-form'), esc_html($button_text)),
                    $post_id
                );
                
            default:
                return self::render_button($post_id, $button_text, $button_class);
        }
    }
}

<?php
/**
 * Taxonomías para Productos Personalizados
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase para Taxonomías
 * 
 * @class Taxonomies
 */
class Taxonomies {
    
    /**
     * Registrar taxonomías
     * 
     * @return void
     */
    public static function register() {
        self::register_ocasion();
        self::register_categoria();
    }
    
    /**
     * Registrar taxonomía: Ocasión
     * 
     * @return void
     */
    private static function register_ocasion() {
        $args = [
            'label' => __('Ocasiones', 'ucondieresis-custom'),
            'labels' => [
                'name' => __('Ocasiones', 'ucondieresis-custom'),
                'singular_name' => __('Ocasión', 'ucondieresis-custom'),
                'search_items' => __('Buscar Ocasión', 'ucondieresis-custom'),
                'all_items' => __('Todas las Ocasiones', 'ucondieresis-custom'),
                'view_item' => __('Ver Ocasión', 'ucondieresis-custom'),
                'edit_item' => __('Editar Ocasión', 'ucondieresis-custom'),
                'update_item' => __('Actualizar Ocasión', 'ucondieresis-custom'),
                'add_new_item' => __('Agregar Nueva Ocasión', 'ucondieresis-custom'),
                'new_item_name' => __('Nueva Ocasión', 'ucondieresis-custom'),
                'menu_name' => __('Ocasiones', 'ucondieresis-custom'),
            ],
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
            'rewrite' => [
                'slug' => 'ocasion',
                'with_front' => false,
            ],
        ];
        
        register_taxonomy('ocasion', CPT_Productos::POST_TYPE, $args);
        
        // Agregar ocasiones por defecto
        self::add_default_ocasiones();
    }
    
    /**
     * Registrar taxonomía: Categoría de Producto
     * 
     * @return void
     */
    private static function register_categoria() {
        $args = [
            'label' => __('Categorías de Producto', 'ucondieresis-custom'),
            'labels' => [
                'name' => __('Categorías', 'ucondieresis-custom'),
                'singular_name' => __('Categoría', 'ucondieresis-custom'),
                'search_items' => __('Buscar Categoría', 'ucondieresis-custom'),
                'all_items' => __('Todas las Categorías', 'ucondieresis-custom'),
                'view_item' => __('Ver Categoría', 'ucondieresis-custom'),
                'edit_item' => __('Editar Categoría', 'ucondieresis-custom'),
                'update_item' => __('Actualizar Categoría', 'ucondieresis-custom'),
                'add_new_item' => __('Agregar Nueva Categoría', 'ucondieresis-custom'),
                'new_item_name' => __('Nueva Categoría', 'ucondieresis-custom'),
                'menu_name' => __('Categorías', 'ucondieresis-custom'),
            ],
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'rewrite' => [
                'slug' => 'categoria',
                'with_front' => false,
            ],
        ];
        
        register_taxonomy('categoria_producto', CPT_Productos::POST_TYPE, $args);
        
        // Agregar categorías por defecto
        self::add_default_categorias();
    }
    
    /**
     * Agregar ocasiones por defecto
     * 
     * @return void
     */
    private static function add_default_ocasiones() {
        $ocasiones = [
            'cumpleanos' => __('Cumpleaños', 'ucondieresis-custom'),
            'bodas' => __('Bodas', 'ucondieresis-custom'),
            'aniversarios' => __('Aniversarios', 'ucondieresis-custom'),
            'reuniones-corporativas' => __('Reuniones Corporativas', 'ucondieresis-custom'),
            'regalos-empresariales' => __('Regalos Empresariales', 'ucondieresis-custom'),
            'eventos-sociales' => __('Eventos Sociales', 'ucondieresis-custom'),
        ];
        
        foreach ($ocasiones as $slug => $nombre) {
            if (!term_exists($slug, 'ocasion')) {
                wp_insert_term($nombre, 'ocasion', ['slug' => $slug]);
            }
        }
    }
    
    /**
     * Agregar categorías por defecto
     * 
     * @return void
     */
    private static function add_default_categorias() {
        $categorias = [
            'tazas' => __('Tazas', 'ucondieresis-custom'),
            'mochilas' => __('Mochilas', 'ucondieresis-custom'),
            'cuadernos' => __('Cuadernos', 'ucondieresis-custom'),
            'bolsas' => __('Bolsas', 'ucondieresis-custom'),
            'playeras' => __('Playeras', 'ucondieresis-custom'),
            'accesorios' => __('Accesorios', 'ucondieresis-custom'),
        ];
        
        foreach ($categorias as $slug => $nombre) {
            if (!term_exists($slug, 'categoria_producto')) {
                wp_insert_term($nombre, 'categoria_producto', ['slug' => $slug]);
            }
        }
    }
    
    /**
     * Obtener todas las ocasiones
     * 
     * @return array
     */
    public static function get_ocasiones() {
        return get_terms([
            'taxonomy' => 'ocasion',
            'hide_empty' => false,
        ]);
    }
    
    /**
     * Obtener todas las categorías
     * 
     * @return array
     */
    public static function get_categorias() {
        return get_terms([
            'taxonomy' => 'categoria_producto',
            'hide_empty' => false,
        ]);
    }
}

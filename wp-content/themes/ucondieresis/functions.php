<?php
/**
 * Ü con Diéresis - Funciones del tema
 */

// Definir constantes
define('UCONDIERESIS_VERSION', '1.0.0');
define('UCONDIERESIS_DIR', get_template_directory());
define('UCONDIERESIS_URI', get_template_directory_uri());

/**
 * Configuración inicial del tema
 */
function ucondieresis_setup() {
    // Soporte para WordPress features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('menus');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer' => 'Menú Footer'
    ));
}
add_action('after_setup_theme', 'ucondieresis_setup');

/**
 * Enqueue de estilos y scripts
 */
function ucondieresis_enqueue_assets() {
    // CSS
    wp_enqueue_style(
        'ucondieresis-style',
        UCONDIERESIS_URI . '/style.css',
        array(),
        UCONDIERESIS_VERSION
    );
    
    // JS
    wp_enqueue_script(
        'ucondieresis-script',
        UCONDIERESIS_URI . '/assets/js/main.js',
        array(),
        UCONDIERESIS_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'ucondieresis_enqueue_assets');

/**
 * Funciones personalizadas
 */

// Agregar más funciones aquí según necesita tu proyecto

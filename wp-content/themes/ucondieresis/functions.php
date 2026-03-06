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
    
    // Header CSS (global on all pages)
    wp_enqueue_style(
        'ucondieresis-header',
        get_template_directory_uri() . '/assets/css/header.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/header.css')
    );
    
    // Footer CSS (global on all pages)
    wp_enqueue_style(
        'ucondieresis-footer',
        get_template_directory_uri() . '/assets/css/footer.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/footer.css')
    );
    
    // CSS para home page
    if (is_front_page()) {
        wp_enqueue_style(
            'ucondieresis-home',
            get_template_directory_uri() . '/assets/css/home.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/home.css')
        );
        
        // Contact section CSS
        wp_enqueue_style(
            'ucondieresis-contacto',
            get_template_directory_uri() . '/assets/css/contacto.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/contacto.css')
        );
        
        // JS para carrusel de inspiraciones
        wp_enqueue_script(
            'ucondieresis-inspiracion-carousel',
            get_template_directory_uri() . '/assets/js/inspiracion-carousel.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/inspiracion-carousel.js'),
            true
        );
        
        // JS para scroll animations
        wp_enqueue_script(
            'ucondieresis-scroll-animations',
            get_template_directory_uri() . '/assets/js/scroll-animations.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/scroll-animations.js'),
            true
        );
    }
    
    // Header JS (global on all pages) - Scroll detection
    wp_enqueue_script(
        'ucondieresis-header',
        get_template_directory_uri() . '/assets/js/header.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/header.js'),
        true
    );
    
    // Mobile Menu JS (global on all pages)
    wp_enqueue_script(
        'ucondieresis-mobile-menu',
        get_template_directory_uri() . '/assets/js/mobile-menu.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/mobile-menu.js'),
        true
    );
    
    // JS - Floating WhatsApp Button (en todas las páginas)
    wp_enqueue_script(
        'ucondieresis-floating-whatsapp',
        get_template_directory_uri() . '/assets/js/floating-whatsapp.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/floating-whatsapp.js'),
        true
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
 * Cargar archivos del tema
 */

// Cargar helpers
if (file_exists(UCONDIERESIS_DIR . '/inc/helpers.php')) {
    require_once UCONDIERESIS_DIR . '/inc/helpers.php';
}

/**
 * Filtros personalizados para productos
 */
function ucondieresis_custom_body_class($classes) {
    if (is_singular('productos')) {
        $classes[] = 'single-producto';
    }
    
    if (is_post_type_archive('productos')) {
        $classes[] = 'archive-productos';
    }
    
    return $classes;
}
add_filter('body_class', 'ucondieresis_custom_body_class');

/**
 * Incluir productos en búsqueda global
 */
function ucondieresis_extend_search($query) {
    if (!is_admin() && $query->is_search()) {
        $query->set('post_type', ['post', 'page', 'productos']);
    }
    return $query;
}
add_filter('pre_get_posts', 'ucondieresis_extend_search');

/**
 * Funciones personalizadas
 */

// Agregar más funciones aquí según necesita tu proyecto

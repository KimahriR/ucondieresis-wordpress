<?php
/**
 * Ü con Diéresis - Funciones del tema
 */

// Definir constantes
define('UCONDIERESIS_VERSION', '1.0.3');
define('UCONDIERESIS_DIR', get_template_directory());
define('UCONDIERESIS_URI', get_template_directory_uri());

/**
 * Helper para obtener versión de archivo (cache busting)
 * 
 * @param string $file_path Ruta del archivo relativa a template directory
 * @return string Version (filemtime si existe, VERSION por defecto)
 */
function ucondieresis_get_asset_version($file_path) {
    $full_path = get_template_directory() . '/' . $file_path;
    if (file_exists($full_path)) {
        return filemtime($full_path);
    }
    return UCONDIERESIS_VERSION;
}

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
        UCONDIERESIS_URI . '/assets/css/header.css',
        array(),
        ucondieresis_get_asset_version('assets/css/header.css')
    );
    
    // Footer CSS (global on all pages)
    wp_enqueue_style(
        'ucondieresis-footer',
        UCONDIERESIS_URI . '/assets/css/footer.css',
        array(),
        ucondieresis_get_asset_version('assets/css/footer.css')
    );
    
    // CSS para home page
    if (is_front_page()) {
        wp_enqueue_style(
            'ucondieresis-home',
            UCONDIERESIS_URI . '/assets/css/home.css',
            array(),
            ucondieresis_get_asset_version('assets/css/home.css')
        );
        
        // Contact section CSS
        wp_enqueue_style(
            'ucondieresis-contacto',
            UCONDIERESIS_URI . '/assets/css/contacto.css',
            array(),
            ucondieresis_get_asset_version('assets/css/contacto.css')
        );
        
        // Inspiración section CSS (mixed grid layout)
        wp_enqueue_style(
            'ucondieresis-inspiracion',
            UCONDIERESIS_URI . '/assets/css/inspiracion.css',
            array(),
            ucondieresis_get_asset_version('assets/css/inspiracion.css')
        );
        
        // JS para scroll animations
        wp_enqueue_script(
            'ucondieresis-scroll-animations',
            UCONDIERESIS_URI . '/assets/js/scroll-animations.js',
            array(),
            ucondieresis_get_asset_version('assets/js/scroll-animations.js'),
            true
        );
        
        // CTA WhatsApp Menu Handler
        wp_enqueue_script(
            'ucondieresis-cta-whatsapp',
            UCONDIERESIS_URI . '/assets/js/cta-whatsapp.js',
            array(),
            ucondieresis_get_asset_version('assets/js/cta-whatsapp.js'),
            true
        );
        
        // Localize WhatsApp config (secure data from PHP)
        wp_localize_script('ucondieresis-cta-whatsapp', 'ucondieresisWhatsApp', array(
            'number' => '521234567890', // TODO: Mover a wp-config.php o constants
            'messages' => array(
                'gift' => __('Hola! Quiero crear un regalo personalizado 💛', 'ucondieresis'),
                'business' => __('Hola! Tengo una consulta para mi negocio 🚀', 'ucondieresis'),
                'quick' => __('Hola! Tengo una consulta rápida ⚡', 'ucondieresis'),
            ),
        ));
    }
    
    // Header JS (global on all pages) - Scroll detection
    wp_enqueue_script(
        'ucondieresis-header',
        UCONDIERESIS_URI . '/assets/js/header.js',
        array(),
        ucondieresis_get_asset_version('assets/js/header.js'),
        true
    );
    
    // Mobile Menu JS (global on all pages)
    wp_enqueue_script(
        'ucondieresis-mobile-menu',
        UCONDIERESIS_URI . '/assets/js/mobile-menu.js',
        array(),
        ucondieresis_get_asset_version('assets/js/mobile-menu.js'),
        true
    );
    
    // JS - Floating WhatsApp Button (en todas las páginas)
    wp_enqueue_script(
        'ucondieresis-floating-whatsapp',
        UCONDIERESIS_URI . '/assets/js/floating-whatsapp.js',
        array(),
        ucondieresis_get_asset_version('assets/js/floating-whatsapp.js'),
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

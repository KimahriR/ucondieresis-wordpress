<?php
/**
 * Plugin Name: Ü con Diéresis - Funcionalidades Personalizadas
 * Plugin URI: https://ucondieresis.com
 * Description: Extensiones y funcionalidades custom (CPTs, Taxonomías, Integraciones)
 * Version: 1.0.0
 * Author: Erick López
 * Author URI: https://github.com/ericklopezrmz
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: ucondieresis-custom
 * Domain Path: /languages
 * Requires PHP: 8.0
 * Requires WP: 6.0
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit('Acceso directo no permitido.');
}

// Define constantes
define('UCONDIERESIS_PLUGIN_FILE', __FILE__);
define('UCONDIERESIS_PLUGIN_DIR', dirname(UCONDIERESIS_PLUGIN_FILE));
define('UCONDIERESIS_PLUGIN_URL', plugin_dir_url(UCONDIERESIS_PLUGIN_FILE));
define('UCONDIERESIS_PLUGIN_VERSION', '1.0.0');

/**
 * Clase Principal del Plugin
 * 
 * @class Plugin
 */
class Plugin {
    /**
     * Instancia única del plugin
     * 
     * @var Plugin
     */
    private static $instance = null;

    /**
     * Constructor privado (Singleton)
     */
    private function __construct() {
        $this->load_dependencies();
        $this->setup_hooks();
    }

    /**
     * Obtener instancia única del plugin
     * 
     * @return Plugin
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Inicializar el plugin
     * 
     * @return void
     */
    public static function init() {
        self::get_instance();
    }

    /**
     * Cargar dependencias
     * 
     * @return void
     */
    private function load_dependencies() {
        // Cargar configuración primero
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/config.php';
        
        // Cargar clases
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/class-cpt-productos.php';
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/class-cpt-inspiraciones.php';
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/class-cpt-catalogos.php';
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/class-taxonomies.php';
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/class-whatsapp-utils.php';
        
        // Cargar funcionalidades
        require_once UCONDIERESIS_PLUGIN_DIR . '/includes/shortcodes.php';
    }

    /**
     * Configurar hooks
     * 
     * @return void
     */
    private function setup_hooks() {
        // Activación
        register_activation_hook(UCONDIERESIS_PLUGIN_FILE, [$this, 'on_activation']);
        
        // Desactivación
        register_deactivation_hook(UCONDIERESIS_PLUGIN_FILE, [$this, 'on_deactivation']);
        
        // Hooks del plugin
        add_action('init', [$this, 'on_init']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
    }

    /**
     * Ejecutar en activación del plugin
     * 
     * @return void
     */
    public function on_activation() {
        // Registrar CPTs
        CPT_Productos::register();
        CPT_Inspiraciones::register();
        CPT_Catalogos::register();
        Taxonomies::register();
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Ejecutar en desactivación
     * 
     * @return void
     */
    public function on_deactivation() {
        flush_rewrite_rules();
    }

    /**
     * Ejecutar en init de WordPress
     * 
     * @return void
     */
    public function on_init() {
        // Registrar CPTs
        CPT_Productos::register();
        CPT_Inspiraciones::register();
        CPT_Catalogos::register();
        
        // Registrar taxonomías
        Taxonomies::register();
        
        // Flush rewrite rules si el CPT de catálogos es nuevo
        $catalogo_version = get_option('ucondieresis_catalogo_version', '0');
        if (version_compare($catalogo_version, '1.0.3', '<')) {
            flush_rewrite_rules();
            update_option('ucondieresis_catalogo_version', '1.0.3');
        }
        
        // Cargar texto de dominio para traducción
        load_plugin_textdomain('ucondieresis-custom', false, dirname(plugin_basename(UCONDIERESIS_PLUGIN_FILE)) . '/languages');
    }

    /**
     * Enqueue scripts admin
     * 
     * @return void
     */
    public function enqueue_admin_scripts() {
        // Enqueue admin scripts aquí
    }

    /**
     * Enqueue scripts frontend
     * 
     * @return void
     */
    public function enqueue_frontend_scripts() {
        // Enqueue frontend scripts aquí
    }
}

// Inicializar el plugin
Plugin::init();

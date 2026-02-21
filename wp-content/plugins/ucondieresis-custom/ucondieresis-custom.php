<?php
/**
 * Ü con Diéresis - Plugin principal
 * 
 * Plugin Name: Ü con Diéresis - Customizations
 * Plugin URI: https://ucondieresis.com
 * Description: Funcionalidades personalizadas para Ü con Diéresis
 * Version: 1.0.0
 * Author: Erick Lopez
 * Author URI: https://ucondieresis.com
 * License: GPL v2 or later
 * Text Domain: ucondieresis
 * Domain Path: /languages
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes
define('UCONDIERESIS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('UCONDIERESIS_PLUGIN_URI', plugin_dir_url(__FILE__));
define('UCONDIERESIS_PLUGIN_VERSION', '1.0.0');

// Incluir archivos necesarios
require_once UCONDIERESIS_PLUGIN_DIR . 'includes/class-plugin.php';

// Inicializar el plugin
function ucondieresis_init() {
    $plugin = new Ucondieresis_Plugin();
    $plugin->run();
}
add_action('plugins_loaded', 'ucondieresis_init');

// Activación del plugin
function ucondieresis_activate() {
    // Código de activación aquí
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'ucondieresis_activate');

// Desactivación del plugin
function ucondieresis_deactivate() {
    // Código de desactivación aquí
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'ucondieresis_deactivate');

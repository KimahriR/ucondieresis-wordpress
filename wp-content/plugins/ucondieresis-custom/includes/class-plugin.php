<?php
/**
 * Clase principal del plugin
 */

class Ucondieresis_Plugin {
    
    private $version;
    
    public function __construct() {
        $this->version = UCONDIERESIS_PLUGIN_VERSION;
    }
    
    /**
     * Ejecutar el plugin
     */
    public function run() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    
    /**
     * Cargar dependencias
     */
    private function load_dependencies() {
        // Cargar clases del plugin aquí si es necesario
    }
    
    /**
     * Registrar hooks del admin
     */
    private function define_admin_hooks() {
        // Hooks del área admin
    }
    
    /**
     * Registrar hooks del frontend
     */
    private function define_public_hooks() {
        // Enqueue scripts y styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }
    
    /**
     * Enqueue scripts
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            'ucondieresis-custom-script',
            UCONDIERESIS_PLUGIN_URI . 'assets/js/ucondieresis.js',
            array(),
            $this->version,
            true
        );
    }
    
    /**
     * Enqueue styles
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            'ucondieresis-custom-style',
            UCONDIERESIS_PLUGIN_URI . 'assets/css/ucondieresis.css',
            array(),
            $this->version
        );
    }
}

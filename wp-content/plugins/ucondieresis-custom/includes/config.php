<?php
/**
 * Ucondieresis Configuration
 * 
 * Configuración centralizada para la plataforma de productos personalizados
 * 
 * @package Ucondieresis
 */

// WhatsApp Configuration
if (!defined('UCONDIERESIS_WHATSAPP_NUMBER')) {
    /**
     * Número de WhatsApp Business
     * Formato: +[código país][número]
     * Ejemplo para México: +528442326171
     * 
     * IMPORTANTE: Reemplaza este valor con tu número real de WhatsApp
     */
    define('UCONDIERESIS_WHATSAPP_NUMBER', '528442326171');
}

// Company Information
if (!defined('UCONDIERESIS_COMPANY_NAME')) {
    define('UCONDIERESIS_COMPANY_NAME', get_bloginfo('name'));
}

if (!defined('UCONDIERESIS_COMPANY_EMAIL')) {
    define('UCONDIERESIS_COMPANY_EMAIL', get_option('admin_email'));
}

// Product Configuration
if (!defined('UCONDIERESIS_PRODUCTS_PER_PAGE')) {
    define('UCONDIERESIS_PRODUCTS_PER_PAGE', 12);
}

if (!defined('UCONDIERESIS_FEATURED_PRODUCTS_LIMIT')) {
    define('UCONDIERESIS_FEATURED_PRODUCTS_LIMIT', 6);
}

// Message Template
if (!defined('UCONDIERESIS_WHATSAPP_MESSAGE_TEMPLATE')) {
    define('UCONDIERESIS_WHATSAPP_MESSAGE_TEMPLATE', 'Hola, me interesa cotizar el producto {NOMBRE_PRODUCTO} para {OCASION}. ¿Puedes ayudarme?');
}

// Contact Methods
if (!defined('UCONDIERESIS_CONTACT_METHODS')) {
    define('UCONDIERESIS_CONTACT_METHODS', json_encode([
        'whatsapp' => 'WhatsApp',
        'email' => 'Email',
        'form' => 'Formulario de Contacto'
    ]));
}

// Customization Levels
if (!defined('UCONDIERESIS_CUSTOMIZATION_LEVELS')) {
    define('UCONDIERESIS_CUSTOMIZATION_LEVELS', json_encode([
        'basico' => [
            'label' => 'Nivel Básico',
            'description' => 'Personalizaciones estándar'
        ],
        'intermedio' => [
            'label' => 'Nivel Intermedio',
            'description' => 'Personalizaciones avanzadas'
        ],
        'premium' => [
            'label' => 'Nivel Premium',
            'description' => 'Personalización sin límites'
        ]
    ]));
}

/**
 * Get WhatsApp Number
 * 
 * Obtiene el número de WhatsApp configurado, con filtro para extensibilidad
 * 
 * @since 1.0.0
 * @return string Número de WhatsApp con formato
 */
function ucondieresis_get_whatsapp_number() {
    $number = UCONDIERESIS_WHATSAPP_NUMBER;
    
    /**
     * Filtro: ucondieresis_whatsapp_number
     * 
     * Permite cambiar el número de WhatsApp dinámicamente
     * 
     * @param string $number Número de WhatsApp actual
     */
    return apply_filters('ucondieresis_whatsapp_number', $number);
}

/**
 * Get Company Email
 * 
 * @since 1.0.0
 * @return string Email de la empresa
 */
function ucondieresis_get_company_email() {
    $email = UCONDIERESIS_COMPANY_EMAIL;
    return apply_filters('ucondieresis_company_email', $email);
}

/**
 * Get Customization Levels
 * 
 * Obtiene los niveles de personalización disponibles
 * 
 * @since 1.0.0
 * @return array Array con niveles de personalización
 */
function ucondieresis_get_customization_levels() {
    $levels = json_decode(UCONDIERESIS_CUSTOMIZATION_LEVELS, true);
    return apply_filters('ucondieresis_customization_levels', $levels);
}

/**
 * Get Contact Methods
 * 
 * Obtiene los métodos de contacto disponibles
 * 
 * @since 1.0.0
 * @return array Array con métodos de contacto
 */
function ucondieresis_get_contact_methods() {
    $methods = json_decode(UCONDIERESIS_CONTACT_METHODS, true);
    return apply_filters('ucondieresis_contact_methods', $methods);
}

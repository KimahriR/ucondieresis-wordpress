<?php
/**
 * Custom Post Type: Productos Personalizados
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase para Productos Personalizados CPT
 * 
 * @class CPT_Productos
 */
class CPT_Productos {
    
    /**
     * Slug del CPT
     * 
     * @var string
     */
    const POST_TYPE = 'productos';
    
    /**
     * Registro del CPT
     * 
     * @return void
     */
    public static function register() {
        $args = [
            'label' => __('Productos Personalizados', 'ucondieresis-custom'),
            'labels' => [
                'name' => __('Productos Personalizados', 'ucondieresis-custom'),
                'singular_name' => __('Producto Personalizado', 'ucondieresis-custom'),
                'add_new' => __('Agregar Producto', 'ucondieresis-custom'),
                'add_new_item' => __('Agregar Nuevo Producto', 'ucondieresis-custom'),
                'edit_item' => __('Editar Producto', 'ucondieresis-custom'),
                'new_item' => __('Nuevo Producto', 'ucondieresis-custom'),
                'view_item' => __('Ver Producto', 'ucondieresis-custom'),
                'search_items' => __('Buscar Productos', 'ucondieresis-custom'),
                'not_found' => __('No hay productos', 'ucondieresis-custom'),
                'not_found_in_trash' => __('No hay productos en papelera', 'ucondieresis-custom'),
            ],
            'description' => __('Productos personalizados de Ü con Diéresis', 'ucondieresis-custom'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_rest' => true, // REST API para Gutenberg
            'has_archive' => true,
            'rewrite' => [
                'slug' => 'productos',
                'with_front' => false,
            ],
            'supports' => [
                'title',
                'editor',
                'featured-image',
                'excerpt',
                'custom-fields',
                'revisions',
                'author',
            ],
            'menu_icon' => 'dashicons-shopping-cart',
            'show_in_rest' => true,
            'rest_base' => 'productos',
        ];
        
        register_post_type(self::POST_TYPE, $args);
        
        // Registrar meta boxes
        add_action('add_meta_boxes', [self::class, 'add_meta_boxes']);
        add_action('save_post_' . self::POST_TYPE, [self::class, 'save_meta_boxes']);
    }
    
    /**
     * Agregar meta boxes
     * 
     * @return void
     */
    public static function add_meta_boxes() {
        add_meta_box(
            'ucondieresis_product_info',
            __('Información del Producto', 'ucondieresis-custom'),
            [self::class, 'render_product_info'],
            self::POST_TYPE,
            'normal',
            'high'
        );

        add_meta_box(
            'ucondieresis_product_includes',
            __('¿Qué Incluye?', 'ucondieresis-custom'),
            [self::class, 'render_product_includes'],
            self::POST_TYPE,
            'normal',
            'high'
        );

        add_meta_box(
            'ucondieresis_product_customization',
            __('Opciones de Personalización', 'ucondieresis-custom'),
            [self::class, 'render_product_customization'],
            self::POST_TYPE,
            'normal',
            'high'
        );
        
        add_meta_box(
            'ucondieresis_product_pricing',
            __('Precios y Entregas', 'ucondieresis-custom'),
            [self::class, 'render_product_pricing'],
            self::POST_TYPE,
            'normal',
            'high'
        );
        
        add_meta_box(
            'ucondieresis_product_contact',
            __('Contacto y CTA', 'ucondieresis-custom'),
            [self::class, 'render_product_contact'],
            self::POST_TYPE,
            'normal',
            'high'
        );
        
        add_meta_box(
            'ucondieresis_product_display',
            __('Mostrar en Sitio', 'ucondieresis-custom'),
            [self::class, 'render_product_display'],
            self::POST_TYPE,
            'side',
            'high'
        );
    }
    
    /**
     * Renderizar meta box: Información General
     * 
     * @param \WP_Post $post Post actual
     * @return void
     */
    public static function render_product_info($post) {
        wp_nonce_field('ucondieresis_product_nonce', 'ucondieresis_product_nonce');
        
        $nivel_personalizacion = get_post_meta($post->ID, 'ucondieresis_nivel_personalizacion', true);
        ?>
        <div class="ucondieresis-field">
            <label for="ucondieresis_nivel_personalizacion">
                <strong><?php esc_html_e('Nivel de Personalización', 'ucondieresis-custom'); ?></strong>
            </label>
            <select id="ucondieresis_nivel_personalizacion" name="ucondieresis_nivel_personalizacion" style="width: 100%;">
                <option value="">— <?php esc_html_e('Seleccionar', 'ucondieresis-custom'); ?> —</option>
                <option value="bajo" <?php selected($nivel_personalizacion, 'bajo'); ?>>
                    <?php esc_html_e('Bajo (Solo cambio de nombre)', 'ucondieresis-custom'); ?>
                </option>
                <option value="medio" <?php selected($nivel_personalizacion, 'medio'); ?>>
                    <?php esc_html_e('Medio (Diseño + Personalización)', 'ucondieresis-custom'); ?>
                </option>
                <option value="alto" <?php selected($nivel_personalizacion, 'alto'); ?>>
                    <?php esc_html_e('Alto (Diseño Custom 100%)', 'ucondieresis-custom'); ?>
                </option>
            </select>
        </div>
        <style>
            .ucondieresis-field { margin-bottom: 15px; }
            .ucondieresis-field label { display: block; margin-bottom: 5px; }
            .ucondieresis-field input,
            .ucondieresis-field select,
            .ucondieresis-field textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 3px;
                box-sizing: border-box;
            }
        </style>
        <?php
    }

    /**
     * Renderizar meta box: ¿Qué Incluye?
     * 
     * @param \WP_Post $post Post actual
     * @return void
     */
    public static function render_product_includes($post) {
        $incluye = get_post_meta($post->ID, 'ucondieresis_incluye', true);
        ?>
        <div class="ucondieresis-field">
            <label for="ucondieresis_incluye">
                <strong><?php esc_html_e('¿Qué incluye este producto?', 'ucondieresis-custom'); ?></strong>
                <br />
                <small><?php esc_html_e('Una línea por cada ítem. Se mostrará como lista con viñetas.', 'ucondieresis-custom'); ?></small>
            </label>
            <textarea id="ucondieresis_incluye" name="ucondieresis_incluye" rows="6" placeholder="Ej:&#10;Impresión en calidad 300 dpi&#10;Materiales premium&#10;Diseño original&#10;Empaque especial"><?php echo esc_textarea($incluye); ?></textarea>
        </div>
        <?php
    }

    /**
     * Renderizar meta box: Opciones de Personalización
     * 
     * @param \WP_Post $post Post actual
     * @return void
     */
    public static function render_product_customization($post) {
        $personalizacion = get_post_meta($post->ID, 'ucondieresis_personalizacion', true);
        ?>
        <div class="ucondieresis-field">
            <label for="ucondieresis_personalizacion">
                <strong><?php esc_html_e('Opciones de Personalización', 'ucondieresis-custom'); ?></strong>
                <br />
                <small><?php esc_html_e('Una línea por cada opción. Ej: Color, Tamaño, Nombre, etc.', 'ucondieresis-custom'); ?></small>
            </label>
            <textarea id="ucondieresis_personalizacion" name="ucondieresis_personalizacion" rows="6" placeholder="Ej:&#10;Color (5 opciones disponibles)&#10;Nombre personalizado&#10;Logo de empresa&#10;Tamaño ajustable"><?php echo esc_textarea($personalizacion); ?></textarea>
        </div>
        <?php
    }
    
    /**
     * Renderizar meta box: Precios y Entregas
     * 
     * @param \WP_Post $post Post actual
     * @return void
     */
    public static function render_product_pricing($post) {
        $precio_base = get_post_meta($post->ID, 'ucondieresis_precio_base', true);
        $rango_precio = get_post_meta($post->ID, 'ucondieresis_rango_precio', true);
        $tiempo_entrega = get_post_meta($post->ID, 'ucondieresis_tiempo_entrega_dias', true);
        ?>
        <div class="ucondieresis-field">
            <label for="ucondieresis_precio_base">
                <strong><?php esc_html_e('Precio Base ($)', 'ucondieresis-custom'); ?></strong>
            </label>
            <input type="number" id="ucondieresis_precio_base" name="ucondieresis_precio_base" 
                   value="<?php echo esc_attr($precio_base); ?>" min="0" step="0.01" />
        </div>
        
        <div class="ucondieresis-field">
            <label for="ucondieresis_rango_precio">
                <strong><?php esc_html_e('Rango de Precio (Mostrar)', 'ucondieresis-custom'); ?></strong>
                <br />
                <small><?php esc_html_e('Ej: "Desde $150 hasta $500"', 'ucondieresis-custom'); ?></small>
            </label>
            <input type="text" id="ucondieresis_rango_precio" name="ucondieresis_rango_precio" 
                   value="<?php echo esc_attr($rango_precio); ?>" placeholder="Desde $150 hasta $500" />
        </div>
        
        <div class="ucondieresis-field">
            <label for="ucondieresis_tiempo_entrega_dias">
                <strong><?php esc_html_e('Tiempo de Entrega (Días)', 'ucondieresis-custom'); ?></strong>
            </label>
            <input type="number" id="ucondieresis_tiempo_entrega_dias" name="ucondieresis_tiempo_entrega_dias" 
                   value="<?php echo esc_attr($tiempo_entrega); ?>" min="1" />
        </div>
        <?php
    }
    
    /**
     * Renderizar meta box: Contacto y CTA
     * 
     * @param \WP_Post $post Post actual
     * @return void
     */
    public static function render_product_contact($post) {
        $mensaje_whatsapp = get_post_meta($post->ID, 'ucondieresis_mensaje_whatsapp', true);
        $boton_cta_texto = get_post_meta($post->ID, 'ucondieresis_boton_cta_texto', true);
        $boton_cta_tipo = get_post_meta($post->ID, 'ucondieresis_boton_cta_tipo', true);
        
        // Mensaje por defecto
        if (empty($mensaje_whatsapp)) {
            $mensaje_whatsapp = sprintf(
                __('Hola, me interesa el producto: %s', 'ucondieresis-custom'),
                get_the_title($post->ID)
            );
        }
        ?>
        <div class="ucondieresis-field">
            <label for="ucondieresis_boton_cta_tipo">
                <strong><?php esc_html_e('Tipo de Contacto', 'ucondieresis-custom'); ?></strong>
            </label>
            <select id="ucondieresis_boton_cta_tipo" name="ucondieresis_boton_cta_tipo" style="width: 100%;">
                <option value="whatsapp" <?php selected($boton_cta_tipo, 'whatsapp'); ?>>WhatsApp</option>
                <option value="formulario" <?php selected($boton_cta_tipo, 'formulario'); ?>>Formulario Contacto</option>
                <option value="email" <?php selected($boton_cta_tipo, 'email'); ?>>Correo Electrónico</option>
            </select>
        </div>
        
        <div class="ucondieresis-field">
            <label for="ucondieresis_boton_cta_texto">
                <strong><?php esc_html_e('Texto del Botón', 'ucondieresis-custom'); ?></strong>
            </label>
            <input type="text" id="ucondieresis_boton_cta_texto" name="ucondieresis_boton_cta_texto" 
                   value="<?php echo esc_attr($boton_cta_texto); ?>" placeholder="Ej: Cotizar Ahora" />
        </div>
        
        <div class="ucondieresis-field">
            <label for="ucondieresis_mensaje_whatsapp">
                <strong><?php esc_html_e('Mensaje WhatsApp', 'ucondieresis-custom'); ?></strong>
                <br />
                <small><?php esc_html_e('Mensaje que aparecerá prellenado en WhatsApp', 'ucondieresis-custom'); ?></small>
            </label>
            <textarea id="ucondieresis_mensaje_whatsapp" name="ucondieresis_mensaje_whatsapp" 
                      rows="4"><?php echo esc_textarea($mensaje_whatsapp); ?></textarea>
        </div>
        <?php
    }
    
    /**
     * Renderizar meta box: Mostrar en Sitio
     * 
     * @param \WP_Post $post Post actual
     * @return void
     */
    public static function render_product_display($post) {
        $mostrar_en_home = get_post_meta($post->ID, 'ucondieresis_mostrar_en_home', true);
        $orden_home = get_post_meta($post->ID, 'ucondieresis_orden_home', true);
        ?>
        <div class="ucondieresis-field">
            <label for="ucondieresis_mostrar_en_home">
                <input type="checkbox" id="ucondieresis_mostrar_en_home" name="ucondieresis_mostrar_en_home" 
                       value="1" <?php checked($mostrar_en_home, 1); ?> />
                <strong><?php esc_html_e('Destacar en Inicio', 'ucondieresis-custom'); ?></strong>
            </label>
        </div>
        
        <div class="ucondieresis-field">
            <label for="ucondieresis_orden_home">
                <strong><?php esc_html_e('Orden en Inicio', 'ucondieresis-custom'); ?></strong>
            </label>
            <input type="number" id="ucondieresis_orden_home" name="ucondieresis_orden_home" 
                   value="<?php echo esc_attr($orden_home); ?>" min="1" />
        </div>
        <?php
    }
    
    /**
     * Guardar meta boxes
     * 
     * @param int $post_id ID del post
     * @return void
     */
    public static function save_meta_boxes($post_id) {
        // Verificar nonce
        if (!isset($_POST['ucondieresis_product_nonce']) || 
            !wp_verify_nonce($_POST['ucondieresis_product_nonce'], 'ucondieresis_product_nonce')) {
            return;
        }
        
        // Guardar meta campos
        $fields = [
            'ucondieresis_nivel_personalizacion',
            'ucondieresis_incluye',
            'ucondieresis_personalizacion',
            'ucondieresis_precio_base',
            'ucondieresis_rango_precio',
            'ucondieresis_tiempo_entrega_dias',
            'ucondieresis_boton_cta_tipo',
            'ucondieresis_boton_cta_texto',
            'ucondieresis_mensaje_whatsapp',
            'ucondieresis_mostrar_en_home',
            'ucondieresis_orden_home',
        ];
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                if ('ucondieresis_incluye' === $field || 'ucondieresis_personalizacion' === $field) {
                    // Para textarea, usar wp_kses_post para permitir saltos de línea
                    $value = wp_kses_post($_POST[$field]);
                } else {
                    $value = sanitize_text_field($_POST[$field]);
                }
                update_post_meta($post_id, $field, $value);
            }
        }
    }
    
    /**
     * Obtener un producto por ID
     * 
     * @param int $product_id ID del producto
     * @return array Datos del producto
     */
    public static function get_product($product_id) {
        $product = get_post($product_id);
        
        if (!$product || self::POST_TYPE !== $product->post_type) {
            return [];
        }
        
        return [
            'id' => $product->ID,
            'titulo' => $product->post_title,
            'contenido' => $product->post_content,
            'imagen' => get_the_post_thumbnail_url($product->ID, 'full'),
            'nivel_personalizacion' => get_post_meta($product->ID, 'ucondieresis_nivel_personalizacion', true),
            'incluye' => get_post_meta($product->ID, 'ucondieresis_incluye', true),
            'personalizacion' => get_post_meta($product->ID, 'ucondieresis_personalizacion', true),
            'precio_base' => (float) get_post_meta($product->ID, 'ucondieresis_precio_base', true),
            'rango_precio' => get_post_meta($product->ID, 'ucondieresis_rango_precio', true),
            'tiempo_entrega' => (int) get_post_meta($product->ID, 'ucondieresis_tiempo_entrega_dias', true),
            'mensaje_whatsapp' => get_post_meta($product->ID, 'ucondieresis_mensaje_whatsapp', true),
            'boton_cta_texto' => get_post_meta($product->ID, 'ucondieresis_boton_cta_texto', true),
            'boton_cta_tipo' => get_post_meta($product->ID, 'ucondieresis_boton_cta_tipo', true),
            'mostrar_en_home' => (bool) get_post_meta($product->ID, 'ucondieresis_mostrar_en_home', true),
            'url' => get_permalink($product->ID),
        ];
    }
    
    /**
     * Obtener productos destacados para Home
     * 
     * @param int $limit Cantidad a obtener
     * @return array
     */
    public static function get_featured_products($limit = 6) {
        $args = [
            'post_type' => self::POST_TYPE,
            'posts_per_page' => $limit,
            'post_status' => 'publish',
            'meta_query' => [
                [
                    'key' => 'ucondieresis_mostrar_en_home',
                    'value' => 1,
                    'compare' => '=',
                ],
            ],
            'meta_key' => 'ucondieresis_orden_home',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
        ];
        
        $products = get_posts($args);
        $result = [];
        
        foreach ($products as $product) {
            $result[] = self::get_product($product->ID);
        }
        
        return $result;
    }
}

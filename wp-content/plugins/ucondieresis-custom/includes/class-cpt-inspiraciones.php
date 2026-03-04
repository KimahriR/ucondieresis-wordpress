<?php
/**
 * Custom Post Type: Inspiraciones Sociales
 * 
 * Gestiona publicaciones curadas de Instagram y TikTok
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase para Inspiraciones Sociales CPT
 * 
 * @class CPT_Inspiraciones
 */
class CPT_Inspiraciones {
    
    /**
     * Slug del CPT
     * 
     * @var string
     */
    const POST_TYPE = 'inspiraciones';
    
    /**
     * Registro del CPT
     * 
     * @return void
     */
    public static function register() {
        $args = [
            'label' => __('Inspiraciones Sociales', 'ucondieresis-custom'),
            'labels' => [
                'name' => __('Inspiraciones Sociales', 'ucondieresis-custom'),
                'singular_name' => __('Inspiración Social', 'ucondieresis-custom'),
                'add_new' => __('Agregar Inspiración', 'ucondieresis-custom'),
                'add_new_item' => __('Agregar Nueva Inspiración', 'ucondieresis-custom'),
                'edit_item' => __('Editar Inspiración', 'ucondieresis-custom'),
                'new_item' => __('Nueva Inspiración', 'ucondieresis-custom'),
                'view_item' => __('Ver Inspiración', 'ucondieresis-custom'),
                'search_items' => __('Buscar Inspiraciones', 'ucondieresis-custom'),
                'not_found' => __('No hay inspiraciones', 'ucondieresis-custom'),
                'not_found_in_trash' => __('No hay inspiraciones en papelera', 'ucondieresis-custom'),
            ],
            'description' => __('Publicaciones curadas de redes sociales', 'ucondieresis-custom'),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'has_archive' => false,
            'rewrite' => false,
            'supports' => [
                'title',
                'featured-image',
                'page-attributes', // Para ordenamiento manual
                'custom-fields',
                'revisions',
            ],
            'menu_icon' => 'dashicons-facebook',
            'show_in_rest' => true,
            'rest_base' => 'inspiraciones',
            'menu_position' => 25,
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
            'ucondieresis_inspiracion_datos',
            __('Datos de la Inspiración', 'ucondieresis-custom'),
            [self::class, 'render_inspiracion_datos'],
            self::POST_TYPE,
            'normal',
            'high'
        );
    }
    
    /**
     * Renderizar meta box de datos
     * 
     * @param WP_Post $post Post actual
     * @return void
     */
    public static function render_inspiracion_datos($post) {
        wp_nonce_field('ucondieresis_inspiracion_nonce', 'ucondieresis_inspiracion_nonce');
        
        $url_externa = get_post_meta($post->ID, '_url_externa', true);
        $plataforma = get_post_meta($post->ID, '_plataforma', true);
        ?>
        <div style="margin-bottom: 20px;">
            <label for="url_externa" style="display: block; margin-bottom: 8px; font-weight: 600;">
                <?php esc_html_e('URL Externa (Instagram o TikTok)', 'ucondieresis-custom'); ?>
            </label>
            <input 
                type="url" 
                id="url_externa" 
                name="url_externa" 
                value="<?php echo esc_attr($url_externa); ?>" 
                placeholder="https://instagram.com/... o https://tiktok.com/..."
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;"
            />
            <p style="margin: 8px 0 0 0; font-size: 12px; color: #666;">
                <?php esc_html_e('Ingresa la URL completa de la publicación.', 'ucondieresis-custom'); ?>
            </p>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="plataforma" style="display: block; margin-bottom: 8px; font-weight: 600;">
                <?php esc_html_e('Plataforma', 'ucondieresis-custom'); ?>
            </label>
            <select 
                id="plataforma" 
                name="plataforma"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;"
            >
                <option value="" <?php selected($plataforma, ''); ?>>
                    <?php esc_html_e('Seleccionar...', 'ucondieresis-custom'); ?>
                </option>
                <option value="instagram" <?php selected($plataforma, 'instagram'); ?>>
                    <?php esc_html_e('Instagram', 'ucondieresis-custom'); ?>
                </option>
                <option value="tiktok" <?php selected($plataforma, 'tiktok'); ?>>
                    <?php esc_html_e('TikTok', 'ucondieresis-custom'); ?>
                </option>
            </select>
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
        if (!isset($_POST['ucondieresis_inspiracion_nonce']) || 
            !wp_verify_nonce($_POST['ucondieresis_inspiracion_nonce'], 'ucondieresis_inspiracion_nonce')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (isset($_POST['url_externa'])) {
            $url = esc_url_raw($_POST['url_externa']);
            update_post_meta($post_id, '_url_externa', $url);
        }
        
        if (isset($_POST['plataforma'])) {
            $plataforma = sanitize_text_field($_POST['plataforma']);
            update_post_meta($post_id, '_plataforma', $plataforma);
        }
    }
}

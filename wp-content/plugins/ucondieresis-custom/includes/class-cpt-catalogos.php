<?php
/**
 * Custom Post Type: Catálogos
 * 
 * @package Ucondieresis_Custom
 */

namespace Ucondieresis;

// Seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase para Catálogos CPT
 * 
 * @class CPT_Catalogos
 */
class CPT_Catalogos {
    
    /**
     * Slug del CPT
     * 
     * @var string
     */
    const POST_TYPE = 'catalogo';
    
    /**
     * Registro del CPT
     * 
     * @return void
     */
    public static function register() {
        $args = [
            'label' => __('Catálogos', 'ucondieresis-custom'),
            'labels' => [
                'name' => __('Catálogos', 'ucondieresis-custom'),
                'singular_name' => __('Catálogo', 'ucondieresis-custom'),
                'add_new' => __('Agregar Catálogo', 'ucondieresis-custom'),
                'add_new_item' => __('Agregar Nuevo Catálogo', 'ucondieresis-custom'),
                'edit_item' => __('Editar Catálogo', 'ucondieresis-custom'),
                'new_item' => __('Nuevo Catálogo', 'ucondieresis-custom'),
                'view_item' => __('Ver Catálogo', 'ucondieresis-custom'),
                'search_items' => __('Buscar Catálogos', 'ucondieresis-custom'),
                'not_found' => __('No hay catálogos', 'ucondieresis-custom'),
                'not_found_in_trash' => __('No hay catálogos en papelera', 'ucondieresis-custom'),
            ],
            'description' => __('Catálogos descargables de Ü con Diéresis', 'ucondieresis-custom'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'rewrite' => [
                'slug' => 'catalogos',
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
            'menu_icon' => 'dashicons-media-document',
            'rest_base' => 'catalogos',
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
            'ucondieresis_catalog_info',
            __('Información del Catálogo', 'ucondieresis-custom'),
            [self::class, 'render_catalog_info'],
            self::POST_TYPE,
            'normal',
            'high'
        );
    }
    
    /**
     * Renderizar meta box
     * 
     * @param \WP_Post $post Post object
     * @return void
     */
    public static function render_catalog_info($post) {
        wp_nonce_field('ucondieresis_catalog_nonce', 'ucondieresis_catalog_nonce');
        
        // Obtener valor actual
        $pdf_url = get_post_meta($post->ID, 'pdf_catalogo', true);
        
        ?>
        <div class="ucondieresis-meta-box">
            <p>
                <label for="pdf_catalogo">
                    <strong><?php esc_html_e('URL del Catálogo PDF:', 'ucondieresis-custom'); ?></strong>
                </label>
                <br />
                <input 
                    type="text" 
                    id="pdf_catalogo" 
                    name="pdf_catalogo" 
                    value="<?php echo esc_attr($pdf_url); ?>" 
                    style="width: 100%; padding: 8px; margin-top: 8px; box-sizing: border-box;"
                    placeholder="https://ejemplo.com/catalogo.pdf"
                />
                <span style="display: block; color: #666; font-size: 0.9em; margin-top: 8px;">
                    <?php esc_html_e('Ingresa la URL completa del archivo PDF del catálogo.', 'ucondieresis-custom'); ?>
                </span>
            </p>
            <p>
                <button type="button" class="button" id="upload_pdf_button">
                    <?php esc_html_e('Seleccionar archivo', 'ucondieresis-custom'); ?>
                </button>
            </p>
        </div>
        
        <script>
        jQuery(function($) {
            $('#upload_pdf_button').click(function() {
                var mediaUploader = wp.media({
                    title: '<?php esc_html_e('Seleccionar catálogo PDF', 'ucondieresis-custom'); ?>',
                    button: {
                        text: '<?php esc_html_e('Usar este archivo', 'ucondieresis-custom'); ?>'
                    },
                    multiple: false,
                    library: {
                        type: 'application/pdf'
                    }
                }).open()
                .on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#pdf_catalogo').val(attachment.url);
                });
                return false;
            });
        });
        </script>
        <?php
    }
    
    /**
     * Guardar meta boxes
     * 
     * @param int $post_id Post ID
     * @return void
     */
    public static function save_meta_boxes($post_id) {
        // Verificar nonce
        if (!isset($_POST['ucondieresis_catalog_nonce']) || 
            !wp_verify_nonce($_POST['ucondieresis_catalog_nonce'], 'ucondieresis_catalog_nonce')) {
            return;
        }
        
        // Revisar permisos
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Guardar PDF URL
        if (isset($_POST['pdf_catalogo'])) {
            $pdf_url = sanitize_url($_POST['pdf_catalogo']);
            update_post_meta($post_id, 'pdf_catalogo', $pdf_url);
        }
    }
}

// Registrar CPT
CPT_Catalogos::register();

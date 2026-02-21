# Plugin Ü con Diéresis - Custom Functionality

## Estructura

```
ucondieresis-custom/
├── ucondieresis-custom.php     # Archivo principal del plugin
├── includes/
│   ├── class-plugin.php        # Clase principal
│   └── (otros archivos que necesites)
└── assets/
    ├── css/
    │   └── ucondieresis.css    # Estilos del plugin
    └── js/
        └── ucondieresis.js     # Scripts del plugin
```

## Uso

### Activar el plugin

1. Ve a la carpeta `wp-content/plugins` 
2. Activa "Ü con Diéresis - Customizations" desde WordPress admin
3. El plugin automáticamente cargará estilos y scripts

### Agregar funcionalidades

#### Registrar un Custom Post Type

En `includes/class-plugin.php`:

```php
public function define_public_hooks() {
    add_action('init', array($this, 'register_post_types'));
}

public function register_post_types() {
    register_post_type('portfolio', array(
        'label' => 'Portfolio',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}
```

#### Agregar un Custom Shortcode

```php
public function define_public_hooks() {
    add_shortcode('ucondieresis_feature', array($this, 'feature_shortcode'));
}

public function feature_shortcode($atts) {
    return '<div class="feature">Tu contenido aquí</div>';
}
```

#### Agregar un Hook personalizado

```php
// Para ejecutar código en ciertos eventos:
do_action('ucondieresis_custom_event');

// Escuchar el evento:
add_action('ucondieresis_custom_event', function() {
    // Tu código aquí
});
```

## Recomendaciones

- Mantén las funciones organizadas en métodos de clase
- Usa hooks y filtros de WordPress en lugar de modificar archivos
- Sigue el estándar WordPress Coding Standards
- Documenta tu código con comentarios PHPDoc

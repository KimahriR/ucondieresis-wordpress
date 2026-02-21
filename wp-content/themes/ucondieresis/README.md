# Tema Ü con Diéresis

## Estructura

```
ucondieresis/
├── style.css              # Información y estilos principales
├── functions.php          # Funcionalidades del tema
├── index.php              # Template principal
├── header.php             # Header
├── footer.php             # Footer
├── sidebar.php            # Sidebar
├── screenshot.png         # Vista previa del tema (opcional)
└── assets/
    ├── css/
    │   └── main.css       # Estilos adicionales
    ├── js/
    │   └── main.js        # Scripts principales
    └── images/            # Imágenes del tema
```

## Features

- ✅ Soporte para title tag
- ✅ Soporte para featured images
- ✅ Soporte para custom logo
- ✅ Menús personalizados (primario y footer)
- ✅ Responsive design
- ✅ Sidebar con widgets

## Instalación

1. El tema ya está en `wp-content/themes/ucondieresis`
2. Ve a WordPress admin > Apariencia > Temas
3. Activa "Ü con Diéresis"

## Personalización

### Cambiar colores

Edita las variables CSS en `assets/css/main.css`:

```css
:root {
    --primary-color: #333;
    --secondary-color: #666;
    --accent-color: #0073aa;
}
```

### Agregar un nuevo template

Crea un archivo como `single.php` o `page.php`:

```php
<?php
get_header();
?>

<div class="container">
    <main class="content">
        <!-- Tu contenido aquí -->
    </main>
    <?php get_sidebar(); ?>
</div>

<?php get_footer();
```

### Registrar un nueva zona de widgets

En `functions.php`:

```php
register_sidebar(array(
    'name' => 'Sidebar Secundario',
    'id' => 'secondary-sidebar',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
));
```

## Estructura de carpetas recomendada

Para proyectos más grandes:

```
ucondieresis/
├── template-parts/        # Partes de templates reutilizables
│   ├── header/
│   ├── footer/
│   └── content/
├── assets/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── fonts/
└── inc/                   # Funcionalidades organizadas
    ├── customizer.php
    ├── extras.php
    └── hooks.php
```

## Recomendaciones

- Mantén `functions.php` limpio y modular
- Usa clases para código complejo
- Sigue WordPress Coding Standards
- Comenta tu código adecuadamente
- Utiliza child themes para personalizaciones mayores

# 🚀 GUÍA RÁPIDA - COMENZAR FASE 2

**Estado Actual**: Sistema limpio, estructura lista
**Próximo Paso**: Crear primeras páginas
**Tiempo Estimado**: 2-3 horas para primeras 6 páginas

---

## 1️⃣ CREAR LAS 6 PÁGINAS PRINCIPALES

### Opción A: Crear una por una (Recomendado para contenido específico)

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post create \
  --post_type=page \
  --post_title="Inicio" \
  --post_status=publish \
  --porcelain
```

**Páginas a crear**:
1. **Inicio** - Página principal, hero section, featured products
2. **Nosotros** - Información empresa, misión, valores
3. **Catálogos** (o "Productos") - Listado de productos
4. **Galería** - Galería de imágenes/portfolio
5. **Contacto** - Formulario de contacto
6. **Aviso de Privacidad** - Política de privacidad

### Opción B: Importar desde backup anterior

Si prefieres usar el contenido anterior, reimporta:

```bash
# El archivo de backup está en:
# backup-limpieza-[timestamp].xml
```

---

## 2️⃣ CREAR MENÚ DE NAVEGACIÓN

```bash
# Crear menú
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu create "Menú Principal"

# Obtener los IDs de las páginas creadas
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post list --post_type=page --format=table

# Agregar items (reemplaza [ID] con los IDs reales)
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu item add-post menú-principal [ID-INICIO] --title="Inicio"
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu item add-post menú-principal [ID-NOSOTROS] --title="Nosotros"
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu item add-post menú-principal [ID-CATALOGOS] --title="Catálogos"
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu item add-post menú-principal [ID-GALERIA] --title="Galería"
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu item add-post menú-principal [ID-CONTACTO] --title="Contacto"
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root menu item add-post menú-principal [ID-PRIVACIDAD] --title="Privacidad"
```

---

## 3️⃣ CREAR PRIMER PRODUCTO

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post create \
  --post_type=productos \
  --post_title="Mi Primer Producto" \
  --post_content="Descripción del producto aquí" \
  --post_status=publish \
  --porcelain

# Asignar taxonomías (obtén el ID del output anterior)
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post term add [ID] ocasion cumpleanos
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post term add [ID] categoria_producto tazas
```

---

## 4️⃣ DESARROLLAR TEMA

### Crear archivos básicos en: `wp-content/themes/ucondieresis/`

#### `functions.php`
```php
<?php
// Registrar ubicación de menús
register_nav_menus( array(
    'primary'   => 'Menú Principal',
    'footer'    => 'Menú Footer',
) );

// Agregar soporte tema
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
```

#### `style.css`
```css
/*
Theme Name: Ü con Diéresis
Theme URI: http://example.com
Description: Tema personalizado para ucondieresis.com
Version: 1.0
Author: Tu Nombre
*/

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

.site-header {
    background: #fff;
    border-bottom: 1px solid #ddd;
    padding: 20px 0;
}

.site-title {
    margin: 0;
    font-size: 24px;
}

.site-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
}

.site-nav a {
    text-decoration: none;
    color: #333;
}

.site-nav a:hover {
    color: #0073aa;
}
```

#### `index.php`
```php
<?php
get_header();
?>

<main id="main" class="site-main">
    <?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        }
    } else {
        echo '<p>No se encontró contenido</p>';
    }
    ?>
</main>

<?php
get_footer();
```

#### `header.php`
```php
<?php
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header id="masthead" class="site-header">
            <div class="site-branding">
                <?php
                if ( is_home() && is_front_page() ) {
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                } else {
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                }
                ?>
            </div>

            <nav id="site-navigation" class="site-nav primary-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container_class' => 'primary-menu',
                ) );
                ?>
            </nav>
        </header>
```

#### `footer.php`
```php
        </div><!-- #page -->
        <footer id="colophon" class="site-footer">
            <div class="site-info">
                <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
```

#### `archive-productos.php`
```php
<?php
get_header();
?>

<main id="main" class="site-main archive-productos">
    <header class="archive-header">
        <h1><?php post_type_archive_title(); ?></h1>
    </header>

    <?php
    if ( have_posts() ) {
        echo '<div class="productos-grid">';
        while ( have_posts() ) {
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'producto-card' ); ?>>
                <div class="producto-thumbnail">
                    <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'medium' );
                    } else {
                        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/placeholder.png' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                    }
                    ?>
                </div>
                <h2 class="producto-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="producto-excerpt"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>" class="producto-link">Ver Detalles</a>
            </article>
            <?php
        }
        echo '</div>';
        the_posts_pagination();
    }
    ?>
</main>

<?php
get_footer();
```

#### `single-productos.php`
```php
<?php
get_header();
?>

<main id="main" class="site-main">
    <?php
    while ( have_posts() ) {
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <?php if ( has_post_thumbnail() ) { ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php } ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="taxonomies">
                <?php
                $ocasiones = get_the_terms( get_the_ID(), 'ocasion' );
                if ( $ocasiones ) {
                    echo '<p><strong>Ocasión:</strong> ' . implode( ', ', wp_list_pluck( $ocasiones, 'name' ) ) . '</p>';
                }

                $categorias = get_the_terms( get_the_ID(), 'categoria_producto' );
                if ( $categorias ) {
                    echo '<p><strong>Categoría:</strong> ' . implode( ', ', wp_list_pluck( $categorias, 'name' ) ) . '</p>';
                }
                ?>
            </div>
        </article>
        <?php
    }
    ?>
</main>

<?php
get_footer();
```

---

## 5️⃣ PRÓXIMOS PASOS

1. **Completar tema CSS**
   - Responsive design
   - Mobile-first approach
   - Brand colors

2. **Crear productos iniciales**
   - 8-10 productos base
   - Con imágenes
   - Con taxonomías asignadas

3. **Setup home page**
   - Featured products section
   - Call-to-action
   - Contact integration

4. **Instalar/Configurar contacto**
   - WPForms o Gravity Forms
   - WhatsApp plugin
   - Email notifications

5. **Testing**
   - Mobile responsivo
   - Enlaces
   - Formularios
   - Performance

---

## 📞 ACCESO RÁPIDO

- **Admin**: http://localhost:8000/wp-admin
- **User**: 955510pwpadmin
- **Pass**: wordpress
- **Tema**: /wp-content/themes/ucondieresis/
- **Plugin**: /wp-content/plugins/ucondieresis-custom/

---

**Estado**: 🟢 LISTO PARA COMENZAR

**Primer paso**: Crear archivo `functions.php` en tema

**Tiempo estimado**: 30 minutos para tema base funcional


# 🎨 Ü con Diéresis - Sistema de Productos Personalizados

## 📋 Descripción General

Sistema profesional de WordPress para la captura de leads mediante WhatsApp. Transforma tu sitio en un generador inteligente de cotizaciones personalizadas sin mostrar precios en el front-end.

**Versión:** 1.0.0  
**Requiere:** WordPress 6.0+, PHP 8.0+, MySQL 5.7+

---

## 🚀 Guía de Configuración

### 1. **Instalación del Plugin**

El plugin ucondieresis-custom se incluye en `wp-content/plugins/`:

```bash
# El plugin ya está presente en la carpeta de plugins
# Solo necesita ser activado en el admin de WordPress
```

**Pasos:**
1. Ve a **WordPress Admin → Plugins**
2. Busca "Ü con Diéresis - Funcionalidades Personalizadas"
3. Haz clic en **Activar**

✅ Esto registrará:
- CPT `productos`
- Taxonomías: `ocasion` y `categoria_producto`
- Meta boxes para gestionar productos
- Shortcodes para insertar botones y productos

### 2. **Configurar Número de WhatsApp** ⚠️ CRÍTICO

**Ubicación del archivo:** `/wp-content/plugins/ucondieresis-custom/includes/config.php`

**Línea 20:** Reemplaza el número placeholder por tu número real:

```php
// ANTES (placeholder)
define('UCONDIERESIS_WHATSAPP_NUMBER', '5215551234567');

// DESPUÉS (tu número)
define('UCONDIERESIS_WHATSAPP_NUMBER', '5215559876543'); // Tu número aquí
```

**Formato requerido:**
- ✅ Correcto: `5215559876543` (sin +, sin espacios)
- ✅ Correcto: `34912345678` (código país + número)
- ❌ Incorrecto: `+52 1551 234567` (no usar símbolos)
- ❌ Incorrecto: `5551234567` (debe incluir código de país)

**Codigos de país comunes:**
- México: 52
- España: 34
- Argentina: 54
- Colombia: 57

### 3. **Estructura del Sistema**

```
📦 Plugin (ucondieresis-custom)
├── 📄 ucondieresis-custom.php (Entrada principal)
├── 📁 includes/
│   ├── config.php (⭐ Configuración global)
│   ├── class-cpt-productos.php (CPT + Meta boxes)
│   ├── class-taxonomies.php (Ocasión + Categoría)
│   ├── class-whatsapp-utils.php (Generación de links/mensajes)
│   └── shortcodes.php (Shortcodes reutilizables)

📦 Tema (ucondieresis)
├── 📄 front-page.php (🏠 Página de inicio)
├── 📄 archive-productos.php (📋 Listado de todos los productos)
├── 📄 single-productos.php (🎯 Detalle individual del producto)
├── 📁 inc/
│   └── helpers.php (🛠️ Funciones reutilizables)
└── 📄 functions.php (Configuración del tema)
```

---

## 🎯 Características Implementadas

### 1. **Custom Post Type (CPT): productos**

**Slug:** `productos`

**Meta Fields (Campos personalizados):**
- `ucondieresis_nivel_personalizacion` - Nivel (básico/intermedio/premium)
- `ucondieresis_incluye` - Texto área con características que incluye
- `ucondieresis_personalizacion` - Texto área con opciones de personalización
- `ucondieresis_tiempo_entrega_dias` - Número de días de entrega
- `ucondieresis_rango_precio` - Rango de precio (ej: $500-$2000)
- `ucondieresis_boton_cta_tipo` - Tipo de contacto (whatsapp/email/form)
- `ucondieresis_boton_cta_texto` - Texto personalizado del botón
- `ucondieresis_mensaje_whatsapp` - Mensaje personalizado (si es diferente al automático)
- `ucondieresis_mostrar_en_home` - Mostrar en página de inicio
- `ucondieresis_orden_home` - Orden en página de inicio

**Admin UI:**
- 6 Meta boxes en la pantalla de editar producto
- Campos con validación y sanitización
- Campos obligatorios y opcionales claramente marcados

### 2. **Taxonomías**

#### Ocasión (`ocasion`)
Cuándo/para qué se usa el producto:
- Cumpleaños
- Bodas
- Aniversarios
- Eventos Corporativos
- Regalos
- Otros
- *+ más según necesites*

#### Categoría de Producto (`categoria_producto`)
Tipo de producto:
- Ropa Personalizada
- Accesorios
- Decoraciones
- Regalos
- Electrónica
- *+ más según necesites*

**Para agregar términos:**
1. En Admin: **Productos → Ocasiones** (o **Categorías**)
2. Haz clic en **Agregar nueva**
3. Completa nombre y descripción
4. Guarda

### 3. **Clase WhatsApp_Utils**

Maneja toda la integración con WhatsApp automáticamente.

**Métodos principales:**

```php
// Generar mensaje automático
$mensaje = WhatsApp_Utils::generate_message($post_id);
// Resultado: "Hola, me interesa cotizar el producto [TITULO]..."

// Generar URL de WhatsApp
$url = WhatsApp_Utils::generate_link($post_id);
// Resultado: "https://wa.me/5215559876543?text=Hola..."

// Renderizar botón HTML
echo WhatsApp_Utils::render_dynamic_button($post_id);
// Resultado: <a href="..." class="btn-whatsapp">Cotizar</a>
```

### 4. **Shortcodes**

**Insertar en páginas/posts:**

#### Shortcode 1: Botón de WhatsApp
```
[ucondieresis_whatsapp_button product_id="123" text="Cotizar Ahora"]
```

**Atributos:**
- `product_id` - ID del producto (obligatorio)
- `text` - Texto del botón (opcional, default: "Cotizar")
- `class` - Clase CSS personalizada (opcional)

**Ejemplo:**
```
[ucondieresis_whatsapp_button product_id="42" text="Solicitar Cotización"]
```

#### Shortcode 2: Grid de productos destacados
```
[ucondieresis_featured_products limit="6" columns="3"]
```

**Atributos:**
- `limit` - Cantidad de productos (default: 6)
- `columns` - Columnas en la grilla (default: 3)

**Ejemplo:**
```
[ucondieresis_featured_products limit="8" columns="4"]
```

---

## 📄 Templates del Tema

### 1. **front-page.php** (Página de Inicio)
- Hero section con CTA
- 3 características destacadas
- Grid de productos destacados
- Sección de testimonios
- CTA para cotizar

**Cómo personalizar:**
```php
// En front-page.php, línea ~85
echo ucondieresis_render_featured_products_grid(6, 3);
// Cambia 6 = cantidad de productos
// Cambia 3 = columnas en desktop
```

### 2. **archive-productos.php** (Listado de Productos)
- Filtros por ocasión y categoría
- Grid de productos responsive
- Paginación
- NoIndex cuando no hay resultados

**URLs generadas automáticamente:**
- `/productos/` - Todos los productos
- `/productos/?ocasion=bodas` - Filtrado por ocasión
- `/productos/?categoria_producto=ropa` - Filtrado por categoría

### 3. **single-productos.php** (Detalle del Producto)
**Secciones:**
1. Imagen hero
2. Título y descripción
3. Etiquetas (ocasión/categoría)
4. Nivel de personalización
5. "¿Qué incluye?" - Lista de características
6. "Opciones de personalización" - Lista de opciones
7. Detalles: rango precio, tiempo entrega
8. Botón WhatsApp dinámico
9. Información de contacto

---

## 🛠️ Funciones Helper Disponibles

En el tema, puedes usar estas funciones en tus templates:

```php
// Obtener datos de un producto
$producto = ucondieresis_get_product($post_id);
echo $producto['titulo'];
echo $producto['rango_precio'];

// Renderizar tarjeta de producto
ucondieresis_render_product_card($producto);

// Renderizar grid de productos destacados
ucondieresis_render_featured_products_grid(6, 3);

// Obtener link de WhatsApp
$whatsapp_url = ucondieresis_get_whatsapp_link($post_id);

// Obtener mensaje automático
$mensaje = ucondieresis_get_whatsapp_message($post_id);

// Renderizar botón WhatsApp
ucondieresis_whatsapp_button($post_id, 'Cotizar');

// Formatear lista de textarea
$items = ucondieresis_render_items_list($texto_con_saltos);
```

**Ubicación:** `/wp-content/themes/ucondieresis/inc/helpers.php`

---

## 📱 Flujo de Operación

### Usuario en Frontend:
1. ✅ Visita `/productos`
2. ✅ Filtra por ocasión (ej: Bodas)
3. ✅ Ve grid de productos en esa categoría
4. ✅ Haz clic en un producto → Abre `single-productos.php`
5. ✅ Lee detalles completos, ve qué incluye
6. ✅ Haz clic en botón "Cotizar"
   - **Se abre WhatsApp** con mensaje prellenado:
   - "_Hola, me interesa cotizar el producto [NOMBRE] para [OCASIÓN]. ¿Puedes ayudarme?_"
7. ✅ Tú (vendedor) recibes el mensaje en WhatsApp
8. ✅ Respondes directamente con presupuesto personalizado

### Admin/Backend:
1. ✅ Crea nuevo producto: **Productos → Agregar Nuevo**
2. ✅ Completa 6 meta boxes:
   - Info general (nivel personalización)
   - Qué incluye
   - Opciones de personalización
   - Detalles (entrega, rango precio)
   - Meta extra (tipo contacto, botón custom)
3. ✅ Asigna ocasión(es) y categoría(s)
4. ✅ Sube imagen destacada
5. ✅ Guarda como borrador o publica
6. ✅ Marca como "mostrar en home" si quieres que aparezca en front-page.php

---

## 🔧 Configuración Avanzada

### Cambiar el mensaje automático

**Archivo:** `/wp-content/plugins/ucondieresis-custom/includes/config.php`

```php
// Línea ~27
define('UCONDIERESIS_WHATSAPP_MESSAGE_TEMPLATE', 'Hola, me interesa cotizar el producto {NOMBRE_PRODUCTO} para {OCASION}. ¿Puedes ayudarme?');

// Puedes usar estos placeholders:
// {NOMBRE_PRODUCTO} - Título del producto
// {OCASION} - Ocasión seleccionada (si existe)
```

### Agregar método de contacto personalizado

En `class-whatsapp-utils.php`, método `render_dynamic_button()`:

```php
switch ($contact_method) {
    case 'whatsapp':
        // WhatsApp está implementado
        break;
    case 'email':
        // Implementar envío de email
        break;
    case 'form':
        // Redirigir a formulario personalizado
        break;
    case 'tu_metodo':
        // Agregar tu lógica aquí
        break;
}
```

### Personalizar estilos

Todos los templates usan **inline CSS** para facilitar cambios rápidos:

1. **Front-page.php** - Líneas 10-20 (colores hero)
2. **Single-productos.php** - Líneas 80-120 (estilos detalle)
3. **Archive-productos.php** - Líneas 100-150 (grid de productos)

Para crear un archivo CSS externo:
1. Crea: `/wp-content/themes/ucondieresis/assets/css/productos.css`
2. En `functions.php` agrega:
```php
wp_enqueue_style('ucondieresis-productos', get_template_directory_uri() . '/assets/css/productos.css');
```

---

## 🐛 Troubleshooting

### Problema: "El plugin no se ve activado"
**Solución:** 
- Verifica que el archivo `ucondieresis-custom/ucondieresis-custom.php` exista
- En terminal: `ls -la wp-content/plugins/ucondieresis-custom/`
- Recarga la página de plugins

### Problema: "Los botones de WhatsApp no funcionan"
**Solución:**
- ✅ Verificó que el número está configurado en `config.php` ?
- ✅ El número tiene el código de país (ej: 52 para México)?
- ✅ No tiene símbolos (+, espacios, guiones)?
- Prueba el link manualmente: `https://wa.me/5215559876543?text=Hola`

### Problema: "Los productos no aparecen en archivo"
**Solución:**
- Verifica que tenga asignada una **ocasión** y **categoría**
- En editor de producto, abajo hay checkbox "_Mostrar en home_"
- Debe estar publicado, no borrador

### Problema: "Las imágenes no se ven"
**Solución:**
- En editor de producto, asigna imagen destacada
- Tamaño mínimo recomendado: 600x600px
- Formato: JPG, PNG, WebP

---

## 📊 Base de datos

### Tablas usadas:
- `wp_posts` - Almacena productos (post_type = 'productos')
- `wp_postmeta` - Almacena meta fields con prefijo `ucondieresis_`
- `wp_terms` - Almacena ocasiones y categorías
- `wp_term_taxonomy` - Relaciones de taxonomías
- `wp_term_relationships` - Asignación de términos a productos

**NO se crean nuevas tablas.** Todo usa la estructura estándar de WordPress.

---

## 🔒 Seguridad

Todo el código implementa:
- ✅ `esc_html()` - Escapar texto en HTML
- ✅ `esc_url()` - Escapar URLs
- ✅ `esc_attr()` - Escapar atributos HTML
- ✅ `sanitize_text_field()` - Sanitizar inputs
- ✅ `wp_kses_post()` - Permitir HTML seguro en contenido
- ✅ Validación de nonce (si se implementa formularios)
- ✅ Chequeos de permisos: `current_user_can()`

---

## 📞 Soporte de Contacto

Si encuentras problemas:

1. **Revisar logs de error:**
   ```bash
   tail -f wp-content/debug.log
   ```

2. **Activar modo debug en wp-config.php:**
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_DISPLAY', true);
   define('WP_DEBUG_LOG', true);
   ```

3. **Verificar permisos de archivos:**
   ```bash
   chmod -R 755 wp-content/plugins/ucondieresis-custom/
   chmod -R 755 wp-content/themes/ucondieresis/
   ```

---

## 🎯 Próximos Pasos

1. **Crear productos de prueba** en el admin
2. **Configurar el número de WhatsApp** en config.php
3. **Personalizar textos** en front-page.php
4. **Agregar CSS profesional** en assets/css/
5. **Probar flujo completo** de usuario a WhatsApp
6. **Configurar backup** automático de la base de datos
7. **Preparar migración a GoDaddy** (si aplica)

---

## 📝 Notas Importantes

- **Backups regulares:** Realiza backups antes de cambios importantes
- **Actualizaciones:** Mantén WordPress, PHP y plugins al día
- **Performance:** Usa herramientas como Lighthouse para optimizar
- **SEO:** Los productos aparecen en búsquedas automáticamente (se indexan)
- **WhatsApp Web:** Prueba los links con WhatsApp Web para asegurar que funcionen

---

**Versión:** 1.0.0  
**Última actualización:** Enero 2026  
**Mantenedor:** Sistema Ucondieresis

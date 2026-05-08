# ✅ Checklist de Verificación del Sistema

## 🚀 Verificación Inmediata (Hacer Primero)

### 1. **Plugin Activado**
- [ ] Ve a **WordPress Admin → Plugins**
- [ ] Busca "Ü con Diéresis"
- [ ] Estado debe ser: **Acciones: Desactivar** (si aparece "Activar", click para activar)
- [ ] Sin errores rojos en la página

**Resultado esperado:** El plugin ejecutará los hooks y registrará CPT + taxonomías

### 2. **Verificar CPT en Admin**
- [ ] En menú lateral debe aparecer **"Productos"**
- [ ] Click en **Productos** muestra página vacía (o con productos previos)
- [ ] Click en **"Agregar Nuevo"** muestra el formulario

**Si no aparece:**
1. Desactiva el plugin
2. Espera 5 segundos
3. Reactiva el plugin
4. Recarga la página (Ctrl+Shift+R)

### 3. **Verificar Taxonomías**
- [ ] En menú **Productos → Ocasiones** debe mostrar listado (8 términos)
- [ ] En menú **Productos → Categorías** debe mostrar listado (6 términos)

**Términos esperados - Ocasión:**
- Cumpleaños
- Bodas
- Aniversarios
- Eventos Corporativos
- Regalos
- etc.

**Términos esperados - Categoría:**
- Ropa Personalizada
- Accesorios
- Decoraciones
- etc.

---

## 📝 Crear Producto de Prueba

### 4. **Crear Producto**
- [ ] Click en **Productos → Agregar Nuevo**
- [ ] Completa campos:

```
Título: "Taza Personalizada para Cumpleaños"
Descripción: "Taza de cerámica blanca de 11oz, personalizable con fotos y textos"

Meta boxes (derecha abajo):
- Nivel de Personalización: "Intermedio"
- ¿Qué Incluye?: 
  • Impresión a color
  • Empaque de regalo
  • Tarjeta personalizada
  
- Opciones de Personalización:
  • Cambiar foto
  • Agregar texto
  • Elegir color de borde

- Tiempo de Entrega: 5
- Rango de Precio: "$150 - $300"
- Tipo de Contacto: "WhatsApp"
- Texto Botón: "Cotizar Taza"

Taxonomías (derecha):
- Ocasión: Cumpleaños ✓
- Categoría: Regalos ✓

- Mostrar en Home: ✓ (checkbox)
```

### 5. **Imagen Destacada**
- [ ] Click en **Establecer imagen destacada**
- [ ] Sube una imagen (mín. 600x600px) o elige una existente
- [ ] Confirma la selección

### 6. **Guardar Producto**
- [ ] Haz clic en **Publicar**
- [ ] Espera confirmación verde
- [ ] Copia la URL del producto

**Resultado:** URL será algo como `/productos/taza-personalizada-cumpleaños/`

---

## 🌐 Pruebas Frontend

### 7. **Verificar Página Principal**
- [ ] Ve a: **tu-sitio.local**
- [ ] Debe mostrar:
  - Hero con gradiente morado
  - "Productos Personalizados, Diseñados para Ti"
  - Botón "Ver Nuestros Productos"
  - 3 características (Personalización, Entrega, Calidad)
  - Grid con productos destacados

**Si grid está vacío:**
- Verifica que el producto tenga checkbox "Mostrar en Home" marcado
- Asegúrate que esté publicado (no borrador)
- Recarga con Ctrl+Shift+R

### 8. **Verificar Página de Listado**
- [ ] Ve a: **tu-sitio.local/productos**
- [ ] Debe mostrar:
  - Título "Todos Nuestros Productos"
  - Filtros por Ocasión
  - Filtros por Categoría
  - Grid con productos
  - Paginación (si hay +12 productos)

### 9. **Verificar Detalle de Producto**
- [ ] Haz clic en cualquier producto del grid
- [ ] Debe mostrar (en orden):
  - Imagen grande
  - Título
  - Ocasión + Categoría (etiquetas)
  - Descripción
  - Nivel de Personalización (recuadro visual)
  - "¿Qué Incluye?" (lista con ✓)
  - "Opciones de Personalización" (lista con →)
  - Detalles (Rango Precio, Tiempo Entrega)
  - **Botón WhatsApp verde**: "Cotizar Taza"

### 10. **Verificar Botón WhatsApp**
- [ ] Haz clic en el botón "Cotizar" (verde)
- [ ] Se abre WhatsApp Web o app con:
  - **Para:** +[tu-número]
  - **Mensaje prerellenado:**
  ```
  Hola, me interesa cotizar el producto Taza Personalizada para Cumpleaños. 
  ¿Puedes ayudarme?
  ```

**Si no funciona:**
1. Verifica que `config.php` tenga el número correcto
2. Número debe ser: sin +, con código país (ej: 5215559876543)
3. Abre el navegador e intenta: `https://wa.me/[tu-numero]?text=Hola`
4. Si eso funciona, el error está en el plugin

---

## 🔧 Verificar Shortcodes

### 11. **Crear página de prueba para shortcodes**
- [ ] Ve a **páginas → Agregar Nueva**
- [ ] Título: "Prueba Shortcodes"
- [ ] En contenido, agrega:

```
## Test 1: Botón Individual
[ucondieresis_whatsapp_button product_id="123" text="Solicitar Info"]

## Test 2: Grid de Destacados
[ucondieresis_featured_products limit="4" columns="2"]
```

*(Cambia 123 por el ID real de tu producto)*

- [ ] Publica la página
- [ ] Visita la página
- [ ] Verifica que:
  - Botón aparece y funciona
  - Grid muestra 4 productos en 2 columnas
  - Las imágenes cargan
  - Botones en grid funcionan

---

## 🗂️ Verificar Estructura de Archivos

### 12. **Plugin Files**
```
✓ /wp-content/plugins/ucondieresis-custom/
  ├── ucondieresis-custom.php (ARCHIVO PRINCIPAL)
  ├── includes/
  │   ├── config.php (⭐ CONFIGURACIÓN CRÍTICA)
  │   ├── class-cpt-productos.php
  │   ├── class-taxonomies.php
  │   ├── class-whatsapp-utils.php
  │   └── shortcodes.php
```

**Verificar en terminal:**
```bash
ls -la wp-content/plugins/ucondieresis-custom/includes/
# Debe listar todos los .php
```

### 13. **Theme Files**
```
✓ /wp-content/themes/ucondieresis/
  ├── front-page.php (PÁGINA INICIO)
  ├── archive-productos.php (LISTADO)
  ├── single-productos.php (DETALLE)
  ├── inc/
  │   └── helpers.php
  ├── functions.php
```

**Verificar que existan:**
```bash
ls -la wp-content/themes/ucondieresis/{front-page,archive-productos,single-productos}.php
```

---

## 🔐 Verificar Configuración

### 14. **Número de WhatsApp**
- [ ] Abre `/wp-content/plugins/ucondieresis-custom/includes/config.php`
- [ ] Línea ~20 debe tener tu número:
  ```php
  define('UCONDIERESIS_WHATSAPP_NUMBER', '5215559876543'); // TU NÚMERO AQUÍ
  ```
- [ ] ✅ NO tiene: `+`, espacios, guiones
- [ ] ✅ SÍ tiene: código de país (52 para México)
- [ ] ✅ Total 11-13 dígitos típicamente

---

## 🐛 Debug Mode

### 15. **Activar Debug si hay errores**
- [ ] Edita `/wp-config.php`
- [ ] Busca `WP_DEBUG`
- [ ] Cambia a:
  ```php
  define('WP_DEBUG', true);
  define('WP_DEBUG_DISPLAY', true);
  define('WP_DEBUG_LOG', true);
  ```
- [ ] Recarga sitio
- [ ] Si hay errores, mira `/wp-content/debug.log`

---

## 📊 Verificación de Base de Datos

### 16. **Productos creados**
```bash
# En terminal MySQL
mysql> SELECT COUNT(*) FROM wp_posts WHERE post_type='productos';
# Debe mostrar: 1 (o más si hay productos previos)
```

### 17. **Meta fields guardados**
```bash
mysql> SELECT * FROM wp_postmeta WHERE meta_key LIKE 'ucondieresis_%' LIMIT 5;
# Debe mostrar registros con prefijo ucondieresis_
```

---

## 🚨 Problemas Comunes y Soluciones

| Problema | Causa | Solución |
|----------|-------|----------|
| No aparece menú "Productos" | Plugin no activado o error | Activar plugin, verificar debug.log |
| Botón WhatsApp roto | URL incorrecta | Verificar número en config.php |
| Productos no en home | No marcados como "mostrar en home" | En editor, marcar checkbox |
| Imágenes no cargan | Sin imagen destacada | Asignar imagen en editor |
| Taxonomías no aparecen | Posts no asociados | Asignar ocasión+categoría a producto |
| CSS se ve roto | Cache navegador | Limpiar cache (Ctrl+Shift+Del) |

---

## ✅ Puntos de Verificación Finales

**ANTES de declarar sistema LISTO:**

- [ ] Plugin activado sin errores
- [ ] CPT "Productos" visible en admin
- [ ] Al menos 1 producto creado
- [ ] Producto asignado a ocasión + categoría
- [ ] Front-page muestra hero + grid
- [ ] Página /productos/ muestra listado
- [ ] Single producto muestra todas las secciones
- [ ] Botón WhatsApp abre WhatsApp con mensaje
- [ ] Número de WhatsApp está configurado
- [ ] Shortcodes funcionan en página de prueba
- [ ] No hay errores en debug.log
- [ ] Sitio se ve bien en móvil (responsive)

---

## 📱 Prueba en Móvil

### Checklist Móvil:
- [ ] Abre sitio en teléfono
- [ ] Front-page se adapta (hero centrado, grid responsive)
- [ ] Boton WhatsApp es grande y clickeable
- [ ] Producto detalle se ve completo
- [ ] Imágenes cargan rápido
- [ ] Filtros funcionan
- [ ] Botones no se superponen

---

## 🎯 Próximos Pasos Post-Verificación

1. **Crear más productos** (mín. 10) para stock
2. **Agregar imágenes reales** de tus productos
3. **Personalizar textos** en front-page.php
4. **Agregar testimonios reales** en sección testimonios
5. **Configurar Google Analytics** para tracking
6. **Prueba de carga** con herramientas como Lighthouse
7. **Backups automáticos** configurados
8. **Preparar migración** si va a GoDaddy

---

**Fecha de verificación:** ___________  
**Estado:** ✅ Listo / ⏳ En progreso / ❌ Requiere ajustes

**Notas:**
_______________________________________________________________
_______________________________________________________________

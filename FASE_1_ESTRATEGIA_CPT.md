# Estrategia: Custom Post Type "Productos Personalizados"

**Fase 1 - Fundamento Inteligente**

---

## 🎯 Objetivo Comercial

Convertir "Catálogos" de página estática → **Sistema dinámico de productos** que:
- Es editable sin código
- Genera automáticamente galerías
- Permite filtrado y búsqueda
- Mejora SEO (cada producto = página indexable)
- Prepara para automatizaciones (WhatsApp, email, formularios)
- Escala sin límite

---

## 📊 Estructura de Datos - Producto Personalizado

### Campos Clave

#### 1. **Identificación**
- `post_title` - Nombre del producto (ej: "Taza Personalizada Geometría")
- `post_excerpt` - Descripción corta (SEO meta description)
- `post_content` - Descripción completa
- `featured_image` - Imagen principal

#### 2. **Clasificación Comercial**
- `ocasion` (select) - Cumpleaños, Corporativo, Boda, Aniversario, Otro
- `categoria_producto` (taxonomy) - Tazas, Mochilas, Cuadernos, Bolsas, etc.
- `nivel_personalizacion` (select) - Bajo, Medio, Alto
  - *Bajo:* Solo cambie nombre
  - *Medio:* Diseño + personalizacion
  - *Alto:* Diseño custom 100%

#### 3. **Pricing & Operacional**
- `precio_base` (number) - Precio base del producto
- `rango_precio` (text) - "Desde $50 hasta $500" (para mostrar en web)
- `tiempo_entrega_dias` (number) - 5, 10, 15, 30 días
- `disponible` (checkbox) - ¿Está disponible para vender?

#### 4. **Conversión & Contacto**
- `mensaje_whatsapp_prefillado` (textarea) - Mensaje automático para WhatsApp
  - Por defecto: "Hola, me interesa el producto '{nombre}'..."
- `boton_cta_texto` (text) - "Cotizar ahora", "Solicitar diseño", etc.
- `boton_cta_tipo` (select) - WhatsApp, Formulario, Correo

#### 5. **SEO & Presentación**
- `color_destacado` (color picker) - Color principal del producto
- `etiquetas_seo` (tax) - "personalizado", "artesanal", etc.
- `mostrar_en_home` (checkbox) - ¿Destacar en página inicio?
- `orden_home` (number) - Orden de aparición

#### 6. **Galería Extendida**
- `galeria_imagenes` (repeater o gallery) - Múltiples fotos del producto

---

## 🗂️ Implementación Técnica

### Location del CPT
```
wp-content/plugins/ucondieresis-custom/
├── ucondieresis-custom.php
├── includes/
│   ├── class-plugin.php
│   ├── class-cpt-productos.php       ← CPT aquí
│   ├── class-taxonomies.php          ← Taxonomías aquí
│   ├── class-acf-integration.php     ← ACF (opcional)
│   └── class-display-hooks.php       ← Mostrar en front-end
└── admin/
    └── metabox-products.php          ← Si no usamos ACF
```

### ¿ACF o Código Nativo?

| Aspecto | ACF | Código Nativo |
|---------|-----|---------------|
| **Facilidad** | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ |
| **Flexibilidad** | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |
| **Costo** | Freemium ($0) | Gratis |
| **Performance** | Buena | Excelente |
| **Mantenimiento** | Fácil | Requiere código |

**Mi recomendación:** Empezar con **código nativo** (meta_boxes), porque:
- No dependemos de plugin externo
- Es más ligero
- Sabemos cómo escalarlo

Si después necesitas más flexibilidad → ACF.

---

## 🔄 Workflow de un Producto

### Por Parte del Admin
1. Ir a: Admin → **Productos Personalizados**
2. Crear nuevo
3. Llenar datos:
   - Nombre, descripción, imagen
   - Seleccionar ocasión, categoría
   - Fijar precio y tiempo entrega
   - Configurar mensaje WhatsApp
4. Guardar y publicar
5. **Automáticamente aparece:**
   - En página `/productos/`
   - Si está "Destacado" → en Home
   - Filtrable por ocasión
   - Linkeable desde emails/sociales

### En Front-end (Usuario)
1. Ve el producto en Home o en listado
2. Lee descripción, ve imágenes
3. Hace click en "Cotizar ahora" o "Preguntar"
4. Se abre WhatsApp con mensaje prefillado (o formulario)

---

## 📐 Base de Datos - Meta Fields

Usando `post_meta`:

```
post_id: 123
meta_key: ucondieresis_precio_base
meta_value: 150

post_id: 123
meta_key: ucondieresis_tiempo_entrega_dias
meta_value: 10

post_id: 123
meta_key: ucondieresis_nivel_personalizacion
meta_value: medio

post_id: 123
meta_key: ucondieresis_mensaje_whatsapp
meta_value: "Hola, me interesa el producto..."

post_id: 123
meta_key: ucondieresis_mostrar_en_home
meta_value: 1
```

---

## 🎨 Vista Rápida - Cómo Se Verá

### En Admin (WP Backend)
```
┌─────────────────────────────────────┐
│ Productos Personalizados            │
├─────────────────────────────────────┤
│ Taza Geométrica Personalizada    ✏️  │
│   Ocasión: Cumpleaños              │
│   Precio: $150 - $300              │
│   Estado: Publicado                │
│                                     │
│ Mochila Corporativa Bordada      ✏️  │
│   Ocasión: Corporativo             │
│   Precio: $500 - $800              │
│   Estado: Borrador                 │
└─────────────────────────────────────┘
```

### En Front-end (Home - Sección Productos)
```
┌──────────────────────────┐   ┌──────────────────────────┐
│ [Foto Taza]              │   │ [Foto Mochila]           │
│                          │   │                          │
│ Taza Personalizada       │   │ Mochila Corporativa      │
│ Desde $150               │   │ Desde $500               │
│ Entrega: 10 días        │   │ Entrega: 15 días        │
│ [Cotizar Ahora]         │   │ [Cotizar Ahora]         │
└──────────────────────────┘   └──────────────────────────┘
```

---

## ✅ Ventajas de Esta Estructura

### Para el Negocio
- ✅ Escalable sin límite de productos
- ✅ SEO mejorado (cada producto = URL única)
- ✅ Automatización futura (WhatsApp, email)
- ✅ Datos centralizados y ordenados
- ✅ Fácil de gestionar sin código

### Para el Desarrollo
- ✅ Código limpio y modular
- ✅ En plugin (no perdemos datos si cambiamos tema)
- ✅ Reutilizable en múltiples plantillas
- ✅ Preparado para APIs futuras

### Para el Usuario
- ✅ Encuentra productos fácilmente
- ✅ Filtra por tipo de ocasión
- ✅ Ve precio, tiempo entrega, variantes
- ✅ Cotiza con un click

---

## 🔥 Próximo Paso

Crear el archivo:

```
wp-content/plugins/ucondieresis-custom/includes/class-cpt-productos.php
```

Con:
1. Registro del CPT
2. Meta boxes para los campos
3. Taxonomías (Ocasión, Categoría)
4. Funciones de visualización

¿Comenzamos?

---

**Última actualización:** 21 de febrero de 2026

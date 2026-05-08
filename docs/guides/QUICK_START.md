# 🚀 QUICK START - Inicio Rápido (5 minutos)

## Paso 1️⃣ - Activar el Plugin (30 segundos)

```
WordPress Admin → Plugins
    ↓
Buscar "Ü con Diéresis"
    ↓
Clic "Activar"
    ↓
✅ Listo - Verás menú "Productos" en el menú lateral
```

## Paso 2️⃣ - Configurar WhatsApp (1 minuto) ⭐ CRÍTICO

**Archivo:** `wp-content/plugins/ucondieresis-custom/includes/config.php`

**Línea 20:** Cambia esto:
```php
// ANTES:
define('UCONDIERESIS_WHATSAPP_NUMBER', '5215551234567');

// DESPUÉS (tu número):
define('UCONDIERESIS_WHATSAPP_NUMBER', '525512345678');
```

**Formato:** `[código-país][número]` (sin +, sin espacios, sin guiones)
- México: `52` + tu número
- España: `34` + tu número

---

## Paso 3️⃣ - Crear Primer Producto (2 minutos)

```
WordPress Admin → Productos → Agregar Nuevo
    ↓
Rellena:
  • Título: "Mi Primer Producto"
  • Descripción: (cualquier texto)
  • Imagen: click "Establecer imagen destacada"
  
  Meta boxes a la derecha:
  • Nivel: (cualquiera)
  • Qué Incluye: (escribe algo)
  • Ocasión: ✓ Selecciona una
  • Categoría: ✓ Selecciona una
  • Mostrar en Home: ✓ Marca checkbox
    ↓
Clic "Publicar"
    ↓
✅ Producto creado
```

## Paso 4️⃣ - Verifica que Funciona (1.5 minutos)

### Opción A: Página de Inicio
```
Visita: tu-sitio.local/
Debe ver:
  ✅ Hero morado con "Productos Personalizados"
  ✅ Grid abajo con tu producto
```

### Opción B: Listado de Productos
```
Visita: tu-sitio.local/productos/
Debe ver:
  ✅ Tu producto en la grilla
  ✅ Filtros por ocasión/categoría
```

### Opción C: Detalle del Producto
```
Haz clic en el producto
Debe ver:
  ✅ Imagen grande
  ✅ Título
  ✅ Botón verde "Cotizar"
  ✅ Toda la información
  
Clic botón "Cotizar" → Se abre WhatsApp ✅
```

---

## 🎯 Ya está funcionando!

Modelo de negocio: **Cliente → Sitio → WhatsApp → Tú cotizas**

---

## 📚 Documentación Completa

Para configuración avanzada, customización y troubleshooting:
- 📖 `IMPLEMENTACION.md` - Guía completa (40 secciones)
- ✅ `VERIFICACION.md` - Checklist de pruebas
- 📝 `README.md` - Proyecto general

---

## 🔧 Comandos Útiles Rápidos

### Ver estructura creada:
```bash
ls -la wp-content/plugins/ucondieresis-custom/includes/
ls -la wp-content/themes/ucondieresis/ | grep ".php"
```

### Limpiar caché:
```bash
# En navegador: Ctrl+Shift+Del
# O: Ctrl+F5 en la página

# En servidor:
rm -rf wp-content/cache/*  # si usas plugin de cache
```

### Ver si hay errores:
```bash
tail -f wp-content/debug.log
```

---

## ⚠️ 3 Cosas Críticas

| # | Qué | Dónde |
|----|-----|-------|
| 1 | **Activar plugin** | WordPress Admin → Plugins |
| 2 | **Configurar WhatsApp** | `config.php` línea 20 |
| 3 | **Marcar "Mostrar en Home"** | Editor de producto → checkbox |

No hagas estos 3 → El sistema no funciona ❌

---

## ❓ Preguntas Rápidas

**P: ¿Dónde aparecen los productos?**  
R: 3 lugares: `/productos` (listado), home page (grid), `/productos/[slug]` (detalle)

**P: ¿Qué pasa cuando cliente clickea botón?**  
R: Se abre WhatsApp con mensaje prellenado → Tú cotizas

**P: ¿Se muestran precios al cliente?**  
R: NO. Solo tú ves precios en admin. En frontend ve "Rango de precio".

**P: ¿Puedo cambiar textos de botones?**  
R: SÍ. En editor de producto → "Texto del botón"

**P: ¿Cómo agregar más productos?**  
R: Mismo proceso: Productos → Agregar Nuevo → Rellenar → Publicar

---

## 📞 Cuando llamar al soporte:

- ❌ No aparece menú "Productos"
- ❌ Botón WhatsApp no abre WhatsApp
- ❌ Imágenes no cargan
- ❌ Grid vacío en home
- ❌ Error PHP en debug.log

**Envía:** screenshot del error + este archivo de log:
```bash
cat wp-content/debug.log
```

---

**Duración total setup:** ~5 minutos  
**Status:** ✅ Sistema productivo  
**Próximo:** Crear 10+ productos con tus datos reales

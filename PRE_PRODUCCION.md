# 🎯 PRE-PRODUCCIÓN CHECKLIST

**Estado:** ANTES DE HACER GO-LIVE  
**Criticidad:** ⚠️ ALTO - Completar antes de publicar

---

## ⚙️ CONFIGURACIONES OBLIGATORIAS

### 1. WhatsApp Number - CRÍTICO
- [ ] Abre: `wp-content/plugins/ucondieresis-custom/includes/config.php`
- [ ] Línea ~20: Verifica el número está configurado
- [ ] Formato: `5215559876543` (sin +, sin espacios)
- [ ] Prueba: `https://wa.me/5215559876543?text=Hola`
- [ ] ✅ El link abre WhatsApp en tu navegador

**Estado Actual:** `5215551234567` (placeholder)  
**Cambiar A:** __________________ 

### 2. Activar Plugin
- [ ] WordPress Admin → Plugins
- [ ] "Ü con Diéresis" → Click Activar
- [ ] Espera que aparezca "Desactivar" (señal que está activo)
- [ ] Menú "Productos" aparece en lateral izquierdo

### 3. Crear Productos Iniciales
**Mínimo:** 3 productos  
**Ideal:** 5-10 productos

Para cada producto:
- [ ] Título descriptivo
- [ ] Descripción completa
- [ ] Imagen 600x600px (mínimo)
- [ ] Nivel personalización (seleccionar)
- [ ] "Qué incluye" (llenar con características)
- [ ] "Opciones de personalización" (llenar)
- [ ] Tiempo entrega (días)
- [ ] Rango precio (ej: $500-$2000)
- [ ] Ocasión (asignar al menos 1)
- [ ] Categoría (asignar al menos 1)
- [ ] ✅ Marcar "Mostrar en Home"
- [ ] Publicar

**Productos creados:** _____ / 3 (mín)

---

## 🌐 TESTING FRONTEND

### 4. Página de Inicio
Visita: `tu-sitio.local/` (o tu dominio)

Visual:
- [ ] Hero morado se ve correcto
- [ ] Textos legibles
- [ ] Botón "Ver Nuestros Productos" está presente
- [ ] 3 características se muestran (Personalización, Entrega, Calidad)

Grid de productos:
- [ ] Aparecen los productos que marcaste "Mostrar en Home"
- [ ] Imágenes cargan correctamente
- [ ] Tarjetas se ven bien espaciadas
- [ ] Grid es responsive (mira en móvil)

### 5. Página de Listado
Visita: `tu-sitio.local/productos/`

Layout:
- [ ] Título "Todos Nuestros Productos"
- [ ] Filtros por Ocasión aparecen
- [ ] Filtros por Categoría aparecen
- [ ] Grid con todos los productos

Funcionalidad:
- [ ] Click en filtro "Bodas" → filtra correctamente
- [ ] Click en filtro "Accesorios" → filtra correctamente
- [ ] Click "Limpiar Filtros" → vuelve a mostrar todos
- [ ] Paginación funciona (si hay >12 productos)

### 6. Página de Detalle de Producto
Haz clic en un producto

Contenido (debe mostrar en ORDEN):
- [ ] Imagen grande en top
- [ ] Título h1
- [ ] Badges con ocasión + categoría
- [ ] Descripción completa
- [ ] Sección "Nivel de Personalización" (recuadro)
- [ ] Sección "¿Qué Incluye?" (lista con checkmarks)
- [ ] Sección "Opciones de Personalización" (lista con flechas)
- [ ] "Detalles" grid mostrand rango precio + tiempo entrega
- [ ] **Botón Verde "Cotizar"** (prominente)
- [ ] Footer con info sobre personalización

### 7. Botón WhatsApp
En página de detalle:
- [ ] Botón verde está visible
- [ ] Texto es claro ("Cotizar" o personalizado)
- [ ] Click abre WhatsApp (Web o app)
- [ ] Mensaje prellenado aparece:
  ```
  Hola, me interesa cotizar el producto [NOMBRE] para [OCASION]...
  ```
- [ ] ✅ Mensaje es enviable (sin errores)

**Probar con:**
- [ ] Desktop
- [ ] Móvil
- [ ] Tablet

---

## 📱 RESPONSIVE TESTING

### 8. Desktop (1200px+)
- [ ] Hero se ve completo
- [ ] Grid muestra 3-4 columnas
- [ ] Botones clickeables
- [ ] Texto legible

### 9. Tablet (768px-1199px)
- [ ] Layout se adapta
- [ ] Grid muestra 2 columnas
- [ ] Imágenes escaladas correctamente
- [ ] Botones aún clickeables

### 10. Móvil (< 768px)
- [ ] Hero se ve en stack vertical
- [ ] Grid muestra 1 columna
- [ ] Imágenes responsive
- [ ] Botones grandes y clickeables
- [ ] Sin scroll horizontal
- [ ] Táctil amigable (botones >44px)

**Dispositivos testeados:**
- [ ] iPhone (Safari)
- [ ] Android (Chrome)
- [ ] Tablet

---

## 🔍 SEO & PERFORMANCE

### 11. SEO Básico
- [ ] Productos aparecer en búsquedas de Google
- [ ] URL amigables: `/productos/[slug]`
- [ ] Meta descriptions presentes (WordPress genera)
- [ ] Imágenes tienen alt text

### 12. Performance
Visita: `tu-sitio.local/` en navegador

Abre DevTools (F12) → Network:
- [ ] Página carga en <3 segundos
- [ ] Imágenes son lo más pesado
- [ ] No hay errores 404
- [ ] No hay errores JS en consola

**Lighthouse score:**
- [ ] Performance: >70
- [ ] Accessibility: >80
- [ ] Best Practices: >80
- [ ] SEO: >90

---

## 🚨 TESTING DE ERRORES

### 13. Debug Log
Abre: `wp-content/debug.log`

- [ ] Sin errores (o solo warnings)
- [ ] No aparecen notices de undefined variables
- [ ] No hay líneas rojas de error fatales

**Si hay errores:**
Nota el error exacto:
```
[Fecha] Error: ___________________________________
```

### 14. PHP Error Reporting
Si lo habilitaste `WP_DEBUG`:

- [ ] Recarga front-end → sin errores que aparezcan
- [ ] Recarga admin → sin errores que aparezcan
- [ ] Publica producto → sin errores

### 15. Browser Console
Abre DevTools → Console (F12):

- [ ] Sin errores rojos
- [ ] Sin warnings críticos
- [ ] Funciones JavaScript ejecutan sin problema

---

## 🔐 SEGURIDAD PRE-PRODUCCIÓN

### 16. Input Validation
Intenta:
- [ ] Crear producto sin título → ❌ Debe bloquear
- [ ] Dejar meta boxes vacías → ⚠️ Debe permitir (algunos son opcionales)
- [ ] Ingresar en "ocasión" → ✅ Debe permitir seleccionar
- [ ] Cambiar URL producto a `/productos/../../../../etc/passwd` → ❌ Debe 404

### 17. Output Escaping
Ver código fuente (Ctrl+U):

- [ ] URLs en botones: `href="https://wa.me/..."` (escapadas)
- [ ] Textos: sin `<script>` sin comillas sin-escapadas
- [ ] Atributos: `class="..."` `id="..."` bien formados

### 18. Permisos
- [ ] Solo editor/admin pueden crear productos
- [ ] Solo admin puede cambiar configuración
- [ ] Usuarios can ver frontend sin problemas

---

## 📊 ANALÍTICA & TRACKING

### 19. Google Analytics (Opcional pero recomendado)
- [ ] Código GA implementado en header
- [ ] Página de inicio se trackea
- [ ] Clicks en botones se trackean (eventos)
- [ ] Dashboard muestra un evento de prueba

### 20. A/B Testing Setup (Futuro)
- [ ] Meta tags ready para Google Optimize
- [ ] UTM parameters en URLs (si campaña paga)
- [ ] Event tracking en botones configurado

---

## 💾 BACKUPS & CONTINUIDAD

### 21. Backup Base de Datos
- [ ] Crear backup ANTES de go-live
- [ ] Archivo: `wordpress_backup_[fecha].sql`
- [ ] Guardar en lugar seguro

```bash
# Comando:
mysqldump -u usuario -p nombre_db > wordpress_backup_$(date +%Y%m%d).sql
```

### 22. Backup de Archivos
- [ ] Copiar carpeta completa `/wp-content/`
- [ ] Guardar `.zip` con fecha

```bash
# Comando:
zip -r ucondieresis_$(date +%Y%m%d).zip wp-content/ wp-config.php
```

### 23. Estrategia de Recuperación
- [ ] Documentar cómo restaurar desde backup
- [ ] Guardar contraseñas en lugar seguro
- [ ] Tener plan si sitio cae (hostinger soporte)

---

## 🚀 ÚLTIMA VERIFICACIÓN ANTES DE PUBLICAR

### 24. Checklist Final 5 Minutos
Recorre el sitio rápidamente:

- [ ] ✅ Homepage se ve profesional
- [ ] ✅ Grid de productos muestra items
- [ ] ✅ Puedo filtrar productos
- [ ] ✅ Detalle de producto se ve completo
- [ ] ✅ Botón WhatsApp funciona y abre WhatsApp
- [ ] ✅ Mobile se ve bien
- [ ] ✅ Sin errores en consola

### 25. Avisos & Disclaimers
- [ ] Agregar disclaimer: _"Cotizaciones aproximadas, consulta con nosotros"_
- [ ] Lincar privacy policy (si existe)
- [ ] Lincar términos de servicio (si existen)
- [ ] Contacto visible en footer

### 26. Mensajes Automáticos Revisados
- [ ] Mensaje WhatsApp suena profesional
- [ ] Oferentes en el mensaje están bien
- [ ] Puntuación es correcta
- [ ] No hay typos

---

## 📋 ROLLBACK PLAN (Si algo sale mal)

Si después de publicar encuentras problema crítico:

### Opción 1: Rápida (1 minuto)
```php
// En wp-content/plugins/ucondieresis-custom/ucondieresis-custom.php
// Descomentar esta línea al inicio (desactivar plugin):
// return;
```

### Opción 2: Restaurar Backup (5 minutos)
```bash
# Restaurar DB:
mysql -u usuario -p nombre_db < wordpress_backup_fecha.sql

# Restaurar archivos:
unzip ucondieresis_fecha.zip
```

### Opción 3: Contactar Soporte
- Hostinger chat: info@hostinger.com
- Menciona: "Blog de productos quebrado, necesito restaurar"

---

## 👥 STAKEHOLDERS NOTIFICATION

Antes de ir live, notificar a:

Email Template:
```
Asunto: Ucondieresis - Sistema de productos LISTO

Hola,

El sistema de captura de leads via WhatsApp está finalizado.

URL: tu-sitio.com/productos
Admin: tu-sitio.com/wp-admin

Status:
✅ Sistema probado y funcional
✅ 5 productos cargados
✅ Botón WhatsApp integrado
✅ Página de inicio activa

Próximos pasos:
→ Continuar agregando productos
→ Monitorear cotizaciones que llegan
→ Feedback sobre formularios

Cualquier duda, me avisan.

---
Por favor confirma que recibiste este email.
```

**Enviado a:**
- [ ] Tu email principal
- [ ] Email del cliente (si aplica)
- [ ] Email de soporte

---

## 🎉 GO-LIVE SIGN-OFF

**Nombre:** _______________________  
**Fecha:** ________________________  
**Hora:** ________________________  

Checklist completado: ✅✅✅

**Autorización para publicar:**  
- [ ] Si, proceder con go-live
- [ ] No, hay problemas que resolver

**Problemas encontrados:**
```
_________________________________________________________________
_________________________________________________________________
_________________________________________________________________
```

**Notas adicionales:**
```
_________________________________________________________________
_________________________________________________________________
```

---

## 📞 CONTACTO DE EMERGENCIA (Post-Launch)

Si algo falla después de publicar:

| Situación | Acción | Contacto |
|-----------|--------|----------|
| Botón WhatsApp roto | Verificar config.php | config.php línea 20 |
| Productos no se ven | Verificar "Mostrar en Home" | WordPress Admin |
| Error 500 | Ver debug.log | wp-content/debug.log |
| Base datos down | Contactar hosting | Hostinger support |
| Problema urgente | Desactivar plugin | Opción 1 arriba |

---

**Status Final:** ✅ LISTO PARA PRODUCCIÓN

**Duración estimada de este checklist:** 45-60 minutos  
**Recomendación:** Hacer morning, NO en viernes tarde 😅

---

_Checklist completado: **[Fecha/Hora]**_

# 🎨 Ucondieresis - Sistema de Productos Personalizados con WhatsApp

**Versión:** 1.0.3 | **Status:** ✅ Production-Ready  
**WordPress:** 6.9.1 | **PHP:** 8.3.30 | **MySQL:** 8.0 | **WhatsApp:** +52 844-232-6171

---

## 🚀 ¿Qué es?

Sistema WordPress que convierte visitantes en clientes vía WhatsApp.

**Flujo:** Usuario navega productos/catálogos → Clic "Cotizar" o descarga PDF → WhatsApp con mensaje prellenado → Tú cotizas

**Ventaja:** Sin precios públicos. Todo personalizado por WhatsApp.

**Características:**
- 🛍️ Sistema de productos personalizados (CPT)
- 📥 Catálogos descargables en PDF
- 💬 Integración WhatsApp directa
- 📱 Responsive mobile-first
- 🎨 Apple Studio Display inspired design
- 🔒 Seguridad auditada (v1.0.3)

---

## � Inicio Rápido

### Requisitos
- Docker & Docker Compose
- macOS (actualmente configurado para CloudDocs)
- Python 3 (para scripts de migración)

### Setup Local

```bash
# Navegar al proyecto
cd "/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-wordpress"

# Iniciar ambiente
docker-compose up -d

# Verificar instalación
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root core version
```

### Acceso

- **WordPress Admin**: http://localhost:8000/wp-admin
- **Usuario**: `955510pwpadmin`
- **Contraseña**: `wordpress`
- **Frontend**: http://localhost:8000

---

## 📋 Estructura del Proyecto

```
ucondieresis-wordpress/
├── wp-content/
│   ├── plugins/
│   │   ├── ucondieresis-custom/          # PLUGIN PRINCIPAL ⭐
│   │   │   ├── ucondieresis-custom.php   # Entry point Singleton
│   │   │   ├── includes/
│   │   │   │   ├── class-plugin.php
│   │   │   │   ├── class-cpt-productos.php    # 400+ líneas, 4 meta boxes
│   │   │   │   └── class-taxonomies.php       # 2 taxonomías + auto-términos
│   │   │   └── languages/
│   │   └── [otros plugins nativos]
│   └── themes/
│       └── ucondieresis/                 # Tema base (mínimo) 🔄 EN DESARROLLO
│           └── .copilot-context.md       # PROMPT MAESTRO
├── scripts/
│   ├── download_images_and_build_wxr.py
│   ├── build_valid_wxr.py                # Script mejorado con fix XML
│   └── build_full_wxr.py
├── docker-compose.yml                    # Configuración de contenedores
├── FASE_1_COMPLETADO.md                  # 📄 Documentación Fase 1 NUEVA
├── DESARROLLO.md                         # Guía de desarrollo
├── MIGRACION_GODADDY.md                  # Instrucciones migración final
├── .copilot-context.md                   # Guidelines generales proyecto
└── README.md                              # Este archivo
```

---

## 🎯 FASE 1: Fundamento Inteligente ✅ COMPLETADO

**Objetivo**: Establecer base técnica escalable con CPT y estructura organizada.

### Entregables

✅ **Custom Post Type `productos`**
- 9 caracteres (dentro del límite de 20)
- Soporte Gutenberg completo
- 4 Meta Boxes validados
- REST API habilitada

✅ **Taxonomías Inteligentes**
- `ocasion`: Cumpleaños, Bodas, Aniversarios, Corporativo, Regalos, Eventos
- `categoria_producto`: Tazas, Mochilas, Cuadernos, Bolsas, Playeras, Accesorios

✅ **Contenido Base**
- 4 Productos personalizados (con taxonomías)
- 6 Páginas importadas del backup Weebly
- Menú principal con navegación

✅ **Documentación**
- PROMPT MAESTRO con 9 reglas técnicas
- Guías de desarrollo y estructura
- Este README actualizado

**Ver**: [FASE_1_COMPLETADO.md](FASE_1_COMPLETADO.md) para detalles completos.

---

## 🔄 FASE 2: Desarrollo desde Cero (INICIANDO)

**Objetivo**: Construir sitio completamente funcional desde la estructura lista.

### Tareas Inmediatas

1. **Crear 6 páginas principales**
   - [ ] Inicio (homepage)
   - [ ] Nosotros
   - [ ] Catálogos / Productos
   - [ ] Galería
   - [ ] Contacto
   - [ ] Aviso de Privacidad

2. **Crear menú de navegación**
   - [ ] "Menú Principal" con 6 items
   - [ ] Asignar a ubicación primary

3. **Desarrollar tema WordPress**
   - [ ] index.php (template default)
   - [ ] header.php y footer.php  
   - [ ] archive-productos.php (listado de productos)
   - [ ] single-productos.php (detalle de producto)
   - [ ] page.php (template para páginas)
   - [ ] home.php (homepage personalizada)

4. **Estilo y diseño**
   - [ ] Style.css base
   - [ ] Responsive mobile-first
   - [ ] Brand colors y tipografía

5. **Contenido CPT**
   - [ ] Crear 8-10 productos iniciales
   - [ ] Asignar taxonomías
   - [ ] Subir imágenes

6. **Funcionalidad**
   - [ ] Integración WhatsApp
   - [ ] Formulario de contacto
   - [ ] Botones CTA

---

## 📚 DOCUMENTACIÓN COMPLETA

| Documento | Propósito | Estado |
|-----------|----------|--------|
| **DEVELOPMENT.md** | Guía técnica desarrollo | ✅ Actualizado |
| **FASE_1_COMPLETADO.md** | Resumen Fase 1 completo | ✅ NUEVO - Completo |
| **MIGRACION_GODADDY.md** | Pasos para deploy | ⏳ Revisar |
| **.copilot-context.md** | PROMPT MAESTRO | ✅ En tema |
| **README.md** | Overview proyecto | ✅ Este archivo |

---

## 🛠️ Comandos Útiles

### WordPress CLI

```bash
# Dentro del contenedor
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root

# Ejemplos comunes
wp post list --post_type=productos               # Listar productos
wp plugin list                                   # Listar plugins
wp theme list                                    # Listar temas
wp option get siteurl                            # Ver URL del sitio
```

### Docker

```bash
# Ver logs
docker logs ucondieresis-wordpress-wordpress-1

# Acceder a bash
docker exec -it ucondieresis-wordpress-wordpress-1 bash

# Reiniciar
docker-compose down && docker-compose up -d
```

### Python Scripts

```bash
# Descargar imágenes y crear WXR
python3 scripts/download_images_and_build_wxr.py

# Retry descargas
python3 scripts/retry_download_images.py
```

---

## 🗂️ CONTENIDO ACTUAL

### Productos (CPT: `productos`)

Sistema completo de productos personalizado. Acede a: `/productos/`

**Meta Boxes:**
- Ocasión (Taxonomía)
- Categoría (Taxonomía)
- Niveles de Personalización (JSON)
- Información de Cotización (meta fields)

### Catálogos (CPT: `catalogo`) - ✅ NUEVO v1.0.3

Catálogos descargables en PDF. Acede a: `/catalogos/`

**Catálogos Disponibles:**
| Título | PDF | Estado |
|--------|-----|--------|
| Kit Padrinos | ✅ Descargable | 🟢 Activo |
| Día de la Mujer | ✅ Descargable | 🟢 Activo |
| Bebé en Camino | ✅ Descargable | 🟢 Activo |
| San Valentín | ✅ Descargable | 🟢 Activo |

**Meta Box:**
- Archivo PDF (URL con media picker)

### Páginas (Post Type: `page`)

- Homepage (index.php con template-parts modular)
- Secciones integradas: Presentación, Ocasiones, CTA+Contacto
- Header/Footer con navegación completa

### Secciones Activas

✅ **Presentación** - Hero con CTA WhatsApp  
✅ **Ocasiones** - Grid de ocasiones con enlace a productos  
✅ **Catálogo** - Acceso desde navegación principal  
✅ **Cómo Comprar** - Instrucciones proceso  
✅ **CTA + Contacto** - Sección unificada  
✅ **Footer** - Links a todas las secciones  

---

## 📋 Estructura del Proyecto

```
ucondieresis-wordpress/
├── wp-content/
│   ├── plugins/
│   │   └── ucondieresis-custom/              # PLUGIN PRINCIPAL ⭐
│   │       ├── ucondieresis-custom.php       # Entry point
│   │       └── includes/
│   │           ├── config.php                # WhatsApp: +528442326171
│   │           ├── class-plugin.php
│   │           ├── class-cpt-productos.php
│   │           ├── class-cpt-catalogos.php   # ✅ NUEVO
│   │           ├── class-taxonomies.php
│   │           ├── class-whatsapp-utils.php
│   │           └── shortcodes.php
│   └── themes/
│       └── ucondieresis/                     # Tema custom
│           ├── index.php
│           ├── header.php
│           ├── footer.php
│           ├── archive-catalogo.php          # ✅ NUEVO
│           ├── single-productos.php
│           ├── functions.php
│           ├── template-parts/
│           │   ├── global/
│           │   │   ├── header-nav.php
│           │   │   ├── footer.php
│           │   │   ├── floating-whatsapp.php
│           │   ├── home/
│           │   │   ├── presentation.php
│           │   │   ├── occasions.php
│           │   │   └── cta-contact.php
│           │   └── catalog/
│           │       └── card-catalogo.php     # ✅ NUEVO
│           ├── assets/
│           │   ├── css/
│           │   │   ├── style.css
│           │   │   ├── catalogos.css         # ✅ NUEVO
│           │   │   └── [otros]
│           │   └── js/
│           └── .htaccess.rules (backup)
├── .htaccess                                 # ✅ REPARADO - Rewrite rules
├── docker-compose.yml
└── README.md (este archivo)
```

---

## 🔐 Seguridad v1.0.3

### Implementado
- ✅ Validación de nonce en meta boxes
- ✅ Sanitización de input/output
- ✅ Namespace `Ucondieresis` para evitar conflictos
- ✅ Asset versioning con filemtime()
- ✅ WhatsApp vía `wp_localize_script()` (no hardcoded)
- ✅ Filemtime checks para File I/O
- ✅ Admin bar oculto en frontend
- ✅ Seguridad en headers/footer (esc_url, home_url)

### Auditoría
- ✅ AUDIT_REPORT.md completado
- ✅ 3 critical issues resueltos
- ✅ 4 warnings abordados

---

## 📅 Timeline Completado

```
✅ Fase 1 (22 Feb)          COMPLETADA - Fundamento técnico
✅ Fase 2 (22 Feb - 15 Mar) COMPLETADA - Sitio funcional
├─ ✅ Tema base (Apple Studio inspired)
├─ ✅ CPT Productos + Meta boxes
├─ ✅ CPT Catálogos + PDFs ✨ NUEVO
├─ ✅ Navegación completa
├─ ✅ WhatsApp integrado
├─ ✅ Header/Footer actualizado
└─ ✅ .htaccess & rewrite rules

🎯 Fase 3 (Próximo) Optimización & Deployment
```

**Fecha Objetivo**: Listo para producción en GoDaddy

---

## 🔗 URLs en Vivo

| Sección | URL | Estado |
|---------|-----|--------|
| **Frontend** | http://localhost:8000 | ✅ Activo |
| **Productos** | http://localhost:8000/productos | ✅ Activo |
| **Catálogos** | http://localhost:8000/catalogos | ✅ Activo ✨ NUEVO |
| **Admin** | http://localhost:8000/wp-admin | ✅ Activo |
| **WhatsApp** | wa.me/528442326171 | ✅ Activo |

---

## 📞 Información de Contacto

**WhatsApp Business:** +52 844-232-6171  
**Email:** (Ver wp-admin settings)  
**Repositorio:** https://github.com/KimahriR/ucondieresis-wordpress

---

## 📝 Changelog Reciente (v1.0.3)

- 🔧 **15 Mar**: Reparado archive-catalogo.php, .htaccess rewrite rules
- 🔧 **15 Mar**: Actualizado header/footer navigation links
- ✨ **15 Mar**: Actualizado WhatsApp a +528442326171
- 🔒 **Antes**: Security audit completado, admin bar hidden
- ✨ **6 Mar**: Catálogos CPT + archivos PDF creados

---

## ✨ Próximos Pasos Inmediatos

1. **Esta Semana**
   - Desarrollar tema WordPress (templates básicos)
   - Crear home page mejorada con featured products
   - Subir media/imágenes

2. **Semana Próxima**
   - Integrar sistema de contacto
   - Ajustes de diseño
   - Testing cross-browser

3. **Fase Final**
   - Preparar migración GoDaddy
   - Testing en producción
   - Optimización SEO final

---

## 📝 Changelog

### v2.0 (21 Febrero, 2026)
- ✅ FASE 1 COMPLETADA
- ✅ CPT `productos` registrado correctamente
- ✅ 6 páginas importadas de backup
- ✅ 4 productos de prueba creados
- ✅ Menú principal establecido
- ✅ Debug habilitado
- 📄 Documento FASE_1_COMPLETADO.md creado
- 📝 README actualizado v2.0

### v1.0 (20 Febrero, 2026)
- Initial setup
- Plugin scaffold
- Docker environment
- WP-CLI integration

---

**Actualizado**: 21 Febrero, 2026  
**Versión**: 2.0  
**Mantenedor**: GitHub Copilot + Manual Review  
**Licencia**: Privado (ucondieresis.com)
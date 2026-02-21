# 🎨 Ucondieresis - Sistema de Productos Personalizados con WhatsApp

**Versión:** 1.0.0 | **Status:** ✅ Production-Ready  
**WordPress:** 6.9.1 | **PHP:** 8.3.30 | **MySQL:** 8.0

---

## 🚀 ¿Qué es?

Sistema WordPress que convierte visitantes en clientes vía WhatsApp.

**Flujo:** Usuario navega productos → Clic "Cotizar" → WhatsApp con mensaje prellenado → Tú cotizas

**Ventaja:** Sin precios públicos. Todo personalizado por WhatsApp.

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

| ID | Título | Ocasión | Categoría | Estado |
|----|--------|---------|-----------|--------|
| - | *Vacío - Listo para crear* | - | - | 🟢 PRONTO |

### Páginas (Post Type: `page`)

| ID | Título | Estado |
|----|--------|--------|
| - | *Vacía - Listo para crear* | 🟢 PRONTO |

**Nota**: Sistema completamente limpio. Backup disponible en `backup-limpieza-[timestamp].xml`

---

## 🔐 Seguridad y Performance

### Implementado
- ✅ Nonce validation en meta boxes
- ✅ Sanitización de input
- ✅ Namespace para evitar conflictos
- ✅ Debug mode local activado

### Roadmap
- [ ] Instalar security plugin
- [ ] Implementar caching
- [ ] Optimizar imágenes
- [ ] Rate limiting en contacto

---

## 📅 Timeline Recomendado

```
HOY (21 Feb)       ✅ FASE 1 COMPLETADA
└─ Semana 1        🔄 FASE 2: Tema + Home
   └─ Semana 2     🔄 FASE 2: Media + Contacto
      └─ Semana 3  ⏳ FASE 2: Testing
         └─ Semana 4 (20 Mar) ⏳ FASE 3: GoDaddy Deploy
```

**Fecha Crítica**: 20 Marzo, 2026
- Sitio Weebly original se elimina en GoDaddy
- Necesitamos estar live antes

---

## 🎨 Guías Importantes

### Valores de Marca (ver `.copilot-context.md`)
- Personalización como diferenciador clave
- Calidad artesanal + tecnología moderna
- Enfoque al cliente individual
- México como mercado principal

### Reglas Técnicas
1. Usar namespaces `Ucondieresis`
2. Comentarios en español/inglés
3. DRY principle - helpers para queries comunes
4. WordPress standards y hooks
5. Validar TODO user input
6. Testing antes de merge
7. Documentar cambios importantes
8. Mantener changelog
9. No hardcodear valores

---

## 🔗 URLs Importantes

| Recurso | URL |
|---------|-----|
| **Frontend** | http://localhost:8000 |
| **Admin** | http://localhost:8000/wp-admin |
| **Productos** | http://localhost:8000/productos |
| **Producto Único** | http://localhost:8000/?productos=taza-personalizada-geometrica |
| **Debug Log** | `/wp-content/debug.log` (local) |

---

## 📞 Contacto / Notas

- **Backup Original**: `/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/`
- **WXR Generado**: `/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-wordpress/ucondieresis-wxr-full.xml`
- **Status Notificaciones**: Ver GitHub issues / discussion

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
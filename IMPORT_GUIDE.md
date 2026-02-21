# Guía de Importación - Backup WXR a WordPress

## Descripción
Este documento describe cómo importar el contenido del sitio estático `ucondieresis.com` a WordPress usando el archivo WXR generado.

## Archivo de Importación
**Ruta:** `/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com/ucondieresis-wxr-full.xml`

**Contenido:**
- 6 Páginas (Index, Nosotros, Catálogos, Galería, Contacto, Privacidad)
- 2 Imágenes/Attachments
- Metadatos y estructura base

**Generado:** 20 de febrero de 2026
**Tamaño:** 551 KB
**Líneas:** 183 (formato XML válido)

## Pasos para Importar

### Opción 1: Local (Docker)

1. **Accede a WordPress Admin**
   ```
   URL: http://localhost:8000/wp-admin
   Usuario: wordpress
   Contraseña: wordpress
   ```

2. **Ve a Herramientas → Importar**
   - En el panel izquierdo: Herramientas → Importar
   - O directo a: `http://localhost:8000/wp-admin/import.php`

3. **Selecciona "WordPress"**
   - Si no aparece, instala el plugin de importación WordPress
   - Click en "Instalar ahora" si es necesario
   - Click en "Activar & Ejecutar Importador"

4. **Sube el archivo WXR**
   - Click en "Elegir archivo"
   - Navega a: `ucondieresis-backup/ucondieresis.com/ucondieresis-wxr-full.xml`
   - Sube el archivo

5. **Configura la importación**
   - **Asignar autores:** Selecciona tu usuario (wordpress)
   - **Descargar adjuntos:** ✅ ACTIVADO (para las imágenes)
   - Click en "Enviar"

6. **Completa la importación**
   - WordPress descargará las imágenes automáticamente
   - Las páginas se crearán con el contenido HTML
   - Los adjuntos se subirán a la librería de medios

### Opción 2: GoDaddy (Hosting)

1. **Accede a tu WordPress**
   ```
   URL: https://tu-dominio.com/wp-admin
   (O la URL de tu hosting)
   ```

2. **Mismo proceso local:**
   - Herramientas → Importar → WordPress
   - Sube el archivo WXR
   - Completa importación

**Nota:** Necesitarás tener acceso SFTP si las imágenes no se descargan automáticamente en GoDaddy.

## Después de la Importación

### Verificar Contenido
- [ ] Las 6 páginas se crearon correctamente
- [ ] Las imágenes se descargaron en Biblioteca de Medios
- [ ] No hay errores de importación

### Ajustes Necesarios
1. **Menús de Navegación**
   - Apariencia → Menú
   - Crea menus y asigna a ubicaciones (Primary, Footer)

2. **Permaenlaces**
   - Ajustes → Permaenlaces
   - Recomendado: "Nombre de la entrada" (/2025/02/nombre-pagina/)

3. **Frontpage**
   - Ajustes → Lectura
   - Establece "index" como página principal
   - Establece "Artículos" para blog

4. **Apariencia del Tema**
   - Verifica estilos CSS (puede que necesite ajuste)
   - Personaliza logo, colores, tipografía

5. **SEO**
   - Revisa y actualiza títulos, meta descripciones
   - Instala plugin SEO si es necesario

## Recursos Generados

```
/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com/
├── ucondieresis-wxr-full.xml      ← ARCHIVO DE IMPORTACIÓN
├── ucondieresis-wxr.xml           ← Respaldo (parcial)
├── images_map.json                ← Mapeo de URLs descargadas
├── failed_images.json             ← URLs que fallaron
├── uploads/                       ← Imágenes descargadas
│   ├── fb_1307248534733486_851x315.jpg
│   └── js.jpg
└── [HTML files]                   ← Páginas del backup
    ├── index.html
    ├── nosotros.html
    ├── galería.html
    ├── catálogos-1.html
    ├── contacto.html
    └── aviso-de-privacidad.html
```

## Limitaciones

⚠️ **Lo que NO se importa automáticamente:**
- 🔴 JavaScript personalizado (deberá recrearse como plugin)
- 🔴 Framework/Boilerplate CSS (deberá customizarse en WordPress)
- 🔴 Formularios dinámicos (usar plugin como WPForms, Contact Form 7)
- 🔴 E-commerce si existía (usar WooCommerce)
- 🔴 Animaciones/Interactividad (recrear con plugins o tema)

✅ **Lo que SÍ se importa:**
- ✅ Contenido HTML de páginas
- ✅ Estructura de navegación base
- ✅ Imágenes/Media
- ✅ Metadatos de SEO
- ✅ Relaciones entre páginas

## Troubleshooting

### Las imágenes no se descargan
```bash
# Verificar que las imágenes existen localmente
ls -la /Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com/uploads/

# Reintentar descarga
cd /Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-wordpress/
python3 scripts/retry_download_images.py
```

### Error en el WXR
```bash
# Validar XML
xmllint --noout /Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com/ucondieresis-wxr-full.xml

# Regenerar si es necesario
python3 scripts/build_full_wxr.py
```

### Las páginas se crean pero sin contenido
- Verificar que los archivos HTML en el backup tienen contenido
- El WXR puede necesitar limpieza de etiquetas incompletas
- Usar un plugin de limpieza de HTML si es necesario

## Próximos Pasos

Después de importar:
1. **Personalizar el tema** (ucondieresis)
2. **Agregar plugins** necesarios (formularios, tienda, etc.)
3. **Configurar SEO** con Yoast o All in One SEO
4. **Crear nuevo contenido** específico para WordPress
5. **Subir cambios a GoDaddy** via SFTP

---
**Fecha:** 20 de febrero de 2026
**Proyecto:** Ü con Diéresis - Migración a WordPress

# Guía de Desarrollo - Ü con Diéresis

## Estructura del Proyecto

```
ucondieresis-wordpress/
├── wp-content/
│   ├── themes/
│   │   └── ucondieresis/              # Tu tema personalizado
│   │       ├── style.css
│   │       ├── functions.php
│   │       ├── index.php, header.php, footer.php, sidebar.php
│   │       ├── assets/
│   │       │   ├── css/
│   │       │   ├── js/
│   │       │   └── images/
│   │       └── README.md              # Documentación del tema
│   └── plugins/
│       └── ucondieresis-custom/       # Plugin personalizado
│           ├── ucondieresis-custom.php
│           ├── includes/
│           │   └── class-plugin.php
│           ├── assets/
│           │   ├── css/
│           │   └── js/
│           └── README.md              # Documentación del plugin
├── docker-compose.yml                 # Configuración Docker
├── .gitignore
├── SFTP_SETUP.md                     # Guía para SFTP en GoDaddy
└── README.md                         # Este archivo
```

## Desarrollo Local

### Iniciar el ambiente

```bash
# Los contenedores ya deberían estar corriendo de:
docker-compose up -d

# Ver logs
docker-compose logs -f wordpress

# Detener
docker-compose down
```

### Acceso a WordPress

- **Front**: http://localhost:8000
- **Admin**: http://localhost:8000/wp-admin
  - Usuario: wordpress
  - Contraseña: wordpress

## Workflow de Desarrollo

### 1. Tema (ucondieresis)

La estructura base ya está creada con:
- ✅ Tema responsive
- ✅ 2 menús (primario y footer)
- ✅ Sidebar con widgets
- ✅ Estilos CSS iniciales
- ✅ JavaScript base

**Para personalizar:**
- Edita `wp-content/themes/ucondieresis/assets/css/main.css` para estilos
- Edita `wp-content/themes/ucondieresis/assets/js/main.js` para JavaScript
- Crea nuevos templates (ej: `single.php`, `page.php`, etc.)

### 2. Plugin (ucondieresis-custom)

El plugin está estructurado con:
- ✅ Clase principal con hooks
- ✅ Enqueue de CSS y JS
- ✅ Estructura lista para extensiones

**Para agregar funcionalidades:**
- Edita `includes/class-plugin.php`
- Registra custom post types, taxonomies, shortcodes, etc.
- Mantén el código modular y reutilizable

### 3. Control de versiones

```bash
# Ver estado
git status

# Agregar cambios
git add .

# Hacer commit
git commit -m "Descripción clara de cambios"

# Ver historial
git log --oneline
```

## Subir cambios a GoDaddy

### Opción 1: SFTP (recomendado para cambios rápidos)

1. Configura [SFTP_SETUP.md](SFTP_SETUP.md)
2. En VS Code:
   - Presiona Cmd+Shift+P
   - Escribe "SFTP"
   - Elige "Upload File" o "Upload Folder"

### Opción 2: FTP tradicional

1. Abre FileZilla
2. Conecta con credenciales de GoDaddy
3. Sube los archivos modificados a `/public_html/wp-content/`

### Opción 3: Git + GitHub (para equipos)

```bash
# Crear repositorio en GitHub
git remote add origin https://github.com/tu-usuario/ucondieresis.git
git push -u origin main

# Luego sincronizar vía GitHub Actions o manualmente
```

## Extensiones de VS Code Recomendadas

Ya están listadas en `.vscode/extensions.json`. VS Code te lo sugerirá al abrir el proyecto.

- **PHP IntelliSense**: Autocompletado PHP
- **WordPress Development**: Snippets WordPress
- **SFTP**: Gestionar archivos remotos
- **GitLens**: Mejorar Git integration
- **Prettier**: Formateo de código

## Problemas comunes

### WordPress no aparece en http://localhost:8000

```bash
# Reinicia Docker
docker-compose restart wordpress

# O si necesitas reconstruir
docker-compose down
docker-compose up -d --build
```

### Cambios en CSS/JS no se ven

- Limpia el caché de WordPress (si tienes algún plugin de caché)
- Abre las DevTools (F12) y haz Cmd+Shift+R para forzar refresco

### Error al instalar plugins desde WordPress

Asegúrate de tener permisos correctos:

```bash
docker-compose exec wordpress chown -R www-data:www-data /var/www/html
```

## Próximos pasos

1. ✅ Configura SFTP para GoDaddy
2. ✅ Instala los plugins esenciales (WooCommerce, Elementor)
3. ✅ Personaliza el tema con tus colores y logos
4. ✅ Migra el contenido del sitio anterior
5. ✅ Pruebas completas en http://localhost:8000
6. ✅ Sube a GoDaddy via SFTP

## Recursos útiles

- [WordPress.org Developer Docs](https://developer.wordpress.org/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [PHP Official Docs](https://www.php.net/docs.php)
- [Docker Official Docs](https://docs.docker.com/)

---

¿Preguntas o problemas? Revisa los README.md en la carpeta del tema o plugin.

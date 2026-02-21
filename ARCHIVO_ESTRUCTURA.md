# Estructura del Proyecto - Ü con Diéresis

## Árbol Completo

```
Code/
└── ucondieresis-wordpress/                 ← Este proyecto
    │
    ├── 📋 DOCUMENTACIÓN (Raíz)
    │   ├── README.md                       ← Visión general (START HERE)
    │   ├── DESARROLLO.md                   ← Guía desarrollo local
    │   ├── MIGRACION_GODADDY.md            ← Pasos migración
    │   ├── ESTADO_ACTUAL.md                ← Checklist actual
    │   └── ARCHIVO_ESTRUCTURA.md           ← Este archivo
    │
    ├── 🐳 DOCKER & CONFIG
    │   ├── docker-compose.yml              ← Definición ambiente local
    │   ├── .dockerignore
    │   └── .env.example                    ← Variables de entorno
    │
    ├── 📁 wp-content/                      ← Todo el contenido personalizado
    │   │
    │   ├── themes/
    │   │   └── ucondieresis/               ← ⭐ Tema principal
    │   │       ├── style.css               ← Estilos principales
    │   │       ├── functions.php           ← Hooks y funciones
    │   │       ├── index.php               ← Template fallback
    │   │       ├── page.php                ← Plantilla de páginas
    │   │       ├── page-*.php              ← Plantillas específicas
    │   │       ├── header.php              ← Header
    │   │       ├── footer.php              ← Footer
    │   │       ├── sidebar.php             ← Sidebar (si aplica)
    │   │       ├── template-parts/         ← Componentes reutilizables
    │   │       │   ├── header-content.php
    │   │       │   ├── footer-content.php
    │   │       │   └── navigation.php
    │   │       ├── assets/
    │   │       │   ├── css/
    │   │       │   │   ├── main.css        ← CSS principal
    │   │       │   │   ├── responsive.css  ← Mobile-first
    │   │       │   │   └── print.css
    │   │       │   ├── js/
    │   │       │   │   ├── main.js         ← JS principal
    │   │       │   │   └── utils.js        ← Utilidades
    │   │       │   └── images/
    │   │       │       └── logo.svg        ← Logo
    │   │       ├── screenshot.png          ← Imagen del tema
    │   │       ├── style.css               ← Metadatos tema (WP header)
    │   │       └── README.md               ← Documentación del tema
    │   │
    │   └── plugins/
    │       └── ucondieresis-custom/        ← ⭐ Plugin personalizado
    │           ├── ucondieresis-custom.php ← Archivo principal
    │           ├── uninstall.php           ← Limpieza al desinstalar
    │           ├── includes/
    │           │   ├── class-plugin.php    ← Clase principal
    │           │   ├── class-cpt.php       ← Custom Post Types
    │           │   └── class-ajax.php      ← AJAX handlers
    │           ├── assets/
    │           │   ├── css/
    │           │   │   └── admin.css
    │           │   └── js/
    │           │       └── admin.js
    │           └── README.md               ← Documentación del plugin
    │
    ├── 🔧 SCRIPTS (Migración)
    │   ├── download_images_and_build_wxr.py    ← Descargar imágenes
    │   ├── build_valid_wxr.py                  ← Generar WXR válido
    │   ├── retry_download_images.py            ← Reintentos
    │   └── README.md                          ← Documentación scripts
    │
    ├── 📦 .vscode/
    │   ├── settings.json                   ← Configuración VS Code
    │   ├── sftp.json                       ← SFTP config (NO COMMIT)
    │   ├── launch.json                     ← Debug config
    │   └── extensions.json                 ← Extensiones recomendadas
    │
    ├── 📂 .git/
    │   └── [Historial Git]
    │
    ├── 💾 .gitignore                       ← Archivos a ignorar
    ├── LICENSE                             ← Licencia del proyecto
    └── package.json                        ← (Opcional) NPM scripts

# Externa (NO en Git)
Code/ucondieresis-backup/
└── ucondieresis.com/
    ├── [archivos HTML del backup]
    ├── uploads/
    │   ├── fb_1307248534733486_851x315.jpg
    │   └── js.jpg
    ├── ucondieresis-wxr-full.xml
    ├── images_map.json
    └── failed_images.json
```

---

## Convenciones de Nombres

### Archivos PHP
```
class-{nombre}.php       ← Clases
functions-{area}.php     ← Funciones agrupadas
template-{tipo}.php      ← Plantillas
```

### Funciones & Hooks
```
// Acciones (do_action)
ucondieresis_after_header
ucondieresis_before_footer

// Filtros (apply_filters)
ucondieresis_content_{post_type}
ucondieresis_get_option_{name}
```

### CSS
```
/* Seccionado por componentes */
/* Header */
/* Main */
/* Sidebar */
/* Footer */
/* Responsive */
/* Utilities */
```

---

## Flujo de Trabajo

### 1️⃣ Desarrollo Local
```
Edita → Guarda → Reload navegador (http://localhost:8000)
```

### 2️⃣ Commit a Git
```
git add wp-content/
git commit -m "Descripción clara"
```

### 3️⃣ Migración a GoDaddy
```
Exporta → Sube SFTP → Instala en GoDaddy
```

---

## Variables de Entorno (`.env`)

```env
# Database
MYSQL_ROOT_PASSWORD=root_password_aqui
MYSQL_DATABASE=ucondieresis
MYSQL_USER=wp_user
MYSQL_PASSWORD=wp_password_aqui

# WordPress
WORDPRESS_DB_HOST=db
WORDPRESS_DB_NAME=ucondieresis
WORDPRESS_DB_USER=wp_user
WORDPRESS_DB_PASSWORD=wp_password_aqui
WORDPRESS_TABLE_PREFIX=wp_
```

---

## Archivos a NO Incluir en Git

El `.gitignore` debe contener:
```
# Sistema
.DS_Store
.env
*.log

# WordPress
wp-config.php
wp-content/uploads/
wp-content/backup-*
wp-content/themes/*/node_modules/
wp-content/plugins/*/node_modules/

# IDE
.vscode/sftp.json
.vscode/workspace.json

# Desarrollo
node_modules/
vendor/
.sass-cache/
```

---

## Instalación de Dependencias (Si Aplica)

### NPM (Para compilar SCSS, etc.)
```bash
# En el tema
cd wp-content/themes/ucondieresis
npm install
npm run build
```

### Composer (Para librerías PHP)
```bash
# En la raíz o plugins
composer install
composer update
```

---

## Testing Básico

### Verificar Sintaxis PHP
```bash
php -l wp-content/themes/ucondieresis/functions.php
```

### Verificar CSS
```bash
# Usar validador online o lint local
stylelint wp-content/themes/ucondieresis/assets/css/
```

---

## Checklist Refactorización

- [ ] Archivo estructura limpia
- [ ] Nombres descriptivos
- [ ] Código comentado y documentado
- [ ] Sin archivos duplicados
- [ ] Sin código comentado "muerto"
- [ ] Consistencia de indentación
- [ ] Tests básicos pasan

---

**Última actualización:** 21 de febrero de 2026

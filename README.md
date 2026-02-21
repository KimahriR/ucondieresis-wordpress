# Migración de ucondieresis.com a WordPress

## Pasos para configurar el entorno local

1. **Instala Docker Desktop**:
   - Descarga e instala Docker Desktop para macOS desde https://www.docker.com/products/docker-desktop.
   - Inicia Docker Desktop.

2. **Ejecuta el entorno WordPress**:
   - Abre una terminal en esta carpeta.
   - Ejecuta: `docker-compose up -d`
   - Esto iniciará WordPress en http://localhost:8000

3. **Configura WordPress**:
   - Ve a http://localhost:8000 en tu navegador.
   - Completa la instalación inicial (idioma: Español, título: Ü con Diéresis, etc.).

4. **Instala plugins esenciales**:
   - WooCommerce para e-commerce.
   - Elementor para diseño de páginas.
   - Otros según necesidad.

## Migración del contenido

- **Imágenes**: Descarga las imágenes del sitio actual y súbelas a WordPress Media Library.
- **Contenido**: Copia el texto de las páginas y recrea en WordPress.
- **Productos**: Exporta productos de GoDaddy como CSV y importa con WooCommerce.

## Flujo de desarrollo

### 1. Instalar extensiones recomendadas en VS Code:
- **PHP IntelliSense**: Autocompletado para PHP
- **WordPress Development**: Snippets y herramientas de WordPress
- **SFTP**: Para subir archivos a GoDaddy
- **GitLens**: Mejora la visualización de Git

Abre VS Code y verás una notificación de extensiones recomendadas.

### 2. Desarrollo local:
```bash
# Los cambios se sincronizan automáticamente en:
# http://localhost:8000

# Para ver los logs:
docker-compose logs -f wordpress

# Para acceder a WordPress admin:
# http://localhost:8000/wp-admin
```

### 3. Estructura de desarrollo:
```
wp-content/
├── themes/
│   └── ucondieresis/          # Tu tema personalizado
├── plugins/
│   └── ucondieresis-custom/   # Plugins personalizados
└── uploads/                    # Imágenes (ignorado en Git)
```

### 4. Control de versiones (Git):
```bash
# Ver cambios
git status

# Confirmar cambios
git add .
git commit -m "Descripción de cambios"

# Ver historial
git log --oneline
```

## Deploying to GoDaddy

### Antes de subir a GoDaddy:

1. **Configura SFTP** en `.vscode/sftp.json`:
   - Reemplaza `your-godaddy-ftp-host.com` con tu host
   - Reemplaza `your-godaddy-username` con tu usuario
   - Reemplaza `your-godaddy-password` con tu contraseña

2. **Instala la extensión SFTP**:
   - Abre VS Code
   - Vé a Extensions (Cmd+Shift+X)
   - Busca "SFTP" y instala "SFTP" de liximomo

3. **Sube los cambios**:
   - Haz clic derecho en la carpeta `wp-content` en Explorer
   - Selecciona "Upload Folder"
   - Los archivos se subirán a GoDaddy automáticamente

### O usa Git y GitHub para CI/CD (recomendado):

```bash
# Crear repositorio en GitHub
git remote add origin https://github.com/tu-usuario/ucondieresis-wordpress.git
git branch -M main
git push -u origin main
```

## Próximos pasos

Una vez configurado localmente, migra a GoDaddy siguiendo la guía proporcionada.
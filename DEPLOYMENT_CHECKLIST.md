# 🚀 DEPLOYMENT CHECKLIST - GoDaddy

**Proyecto**: Ücondieresis v1.0.3  
**Destino**: GoDaddy Hosting  
**Fecha Target**: Antes del 20 de Marzo, 2026  
**Status**: 📋 En Preparación

---

## 📋 FASES DE DEPLOYMENT

### FASE 1: PRE-DEPLOYMENT (Local) ✅

#### 1.1. Verificaciones Finales
- [ ] **Seguridad Auditada**
  ```bash
  # Verificar que SECURITY_AUDIT_v1.0.3.md está en GitHub
  git log --oneline | grep security
  ```
  **Esperado**: Commit `security: Add comprehensive security audit report`

- [ ] **Base de Datos Limpia**
  ```bash
  # Verificar solo lo esencial en BD
  docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post list --post_type=all
  ```
  **Esperado**: 4 catálogos, productos, pages (sin spam/test posts)

- [ ] **Todos los Assets Presentes**
  ```bash
  # Verificar CSS y JS
  find wp-content/themes/ucondieresis/assets -type f | wc -l
  ```
  **Esperado**: +10 archivos (CSS + JS)

- [ ] **Plugins Correctos**
  ```bash
  docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin list
  ```
  **Esperado**: 
  - ucondieresis-custom (ACTIVO)
  - wordpress-importer (no necesario para prod)

#### 1.2. Disable WP_DEBUG
**Archivo**: `wp-config.php`

```php
// ANTES (Desarrollo):
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', __DIR__ . '/wp-content/debug.log');
define('WP_DEBUG_DISPLAY', true);

// DESPUÉS (Producción):
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', __DIR__ . '/wp-content/debug.log');
define('WP_DEBUG_DISPLAY', false);
```

- [ ] Editar `wp-config.php`
- [ ] Cambiar `WP_DEBUG` a `false`
- [ ] Cambiar `WP_DEBUG_DISPLAY` a `false`
- [ ] Verificar cambios: `docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root config get WP_DEBUG`

#### 1.3. Cambiar Table Prefix
**Archivo**: `wp-config.php`

```php
// ANTES:
$table_prefix = 'wp_';

// DESPUÉS:
$table_prefix = 'ucond_';
```

⚠️ **NOTA**: Esto requiere UPDATE de base de datos. **VER FASE 3.2**

- [ ] Editar `wp-config.php`
- [ ] Cambiar prefix de `wp_` a `ucond_`

#### 1.4. Agregar Security Headers
**Archivo**: `wp-config.php` (o `.htaccess`)

Agregar antes de `/* All done! */`:

```php
// Security Headers
if (!function_exists('wp_security_headers')) {
    function wp_security_headers() {
        header('X-Frame-Options: SAMEORIGIN');
        header('X-Content-Type-Options: nosniff');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
    add_action('send_headers', 'wp_security_headers');
}
```

- [ ] Agregar headers a `functions.php` (línea final)

#### 1.5. Configurar SALTS y Constants
**Archivo**: `wp-config.php`

Verificar que existan (deben estar auto-generados):

```php
define('AUTH_KEY', '...');
define('SECURE_AUTH_KEY', '...');
define('LOGGED_IN_KEY', '...');
define('NONCE_KEY', '...');
// ... etc
```

- [ ] Verificar salts: `grep "AUTH_KEY" wp-config.php`
- [ ] Si faltan, generar en https://api.wordpress.org/secret-key/1.1/salt/

#### 1.6. Crear Backup Local
```bash
# Backup BD
docker exec ucondieresis-wordpress-mysql-8.0 mysqldump -u wordpress -pwordpress wordpress > backup-16-marzo-2026.sql

# Backup de archivos
zip -r ucondieresis-wordpress-16-marzo.zip wp-content/ wp-config.php
```

- [ ] BD backup: `backup-16-marzo-2026.sql` ✅
- [ ] Files backup: `ucondieresis-wordpress-16-marzo.zip` ✅
- [ ] Almacenar en carpeta `backups/` local

#### 1.7. Exportar WXR para Backup
```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root export > ucondieresis-exporta-16-marzo-2026.xml
```

- [ ] Crear WXR export
- [ ] Verificar que contiene productos, catálogos, pages

#### 1.8. Test Final en Local
```bash
# Reiniciar Docker con cambios
docker-compose down
docker-compose up -d

# Esperar 30 segundos
sleep 30

# Test key pages
curl -I http://localhost:8000/
curl -I http://localhost:8000/catalogos/
curl -I http://localhost:8000/productos/

# Verificar WP_DEBUG off
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root config get WP_DEBUG
```

- [ ] Homepage carga (200 OK)
- [ ] Catálogos carga (200 OK)
- [ ] Productos carga (200 OK)
- [ ] WP_DEBUG muestra "false"

---

### FASE 2: PREPARACIÓN EN GODADDY

#### 2.1. Crear Hosting Account
**Si aún no existe**

- [ ] Acceder a https://www.godaddy.com
- [ ] Comprar / Activar plan de hosting
- [ ] Dominio: `ucondieresis.com` (o similar)
- [ ] Recibir credentials por email

#### 2.2. Obtener Credenciales
GoDaddy proporciona:
- [ ] **FTP/SFTP Credentials**:
  - Host: `ftp.ucondieresis.com` (o `ftp.ejemplo.com`)
  - User: (ej. `ericklopez_ucond`)
  - Password: (guardado de email GoDaddy)
  - Port: 21 (FTP) o 22 (SFTP)

- [ ] **Database Credentials**:
  - Host: (ej. `db-mysql.ucondieresis.com`)
  - User: (ej. `ucond_user`)
  - Password: (de GoDaddy)
  - Name: (ej. `ucond_wordpress`)

- [ ] **SSH Credentials** (si aplica):
  - Host: SSH hostname
  - User: (Same as FTP)
  - Key: Private key SSH

- [ ] Guardar en archivo seguro (1Password, LastPass, etc.)

#### 2.3. Activar HTTPS/SSL
- [ ] En panel GoDaddy SSL:
  - [ ] Comprar SSL certificate (o free Let's Encrypt)
  - [ ] Instalar certificado
  - [ ] Activar HTTPS en dominio
  - [ ] Verificar: https://ucondieresis.com

#### 2.4. Preparar wp-config.php para GoDaddy

Editar `wp-config.php` **ANTES de subir**:

```php
// ============ GODADDY SPECIFIC ============

/** Database name */
define('DB_NAME', 'ucond_wordpress');

/** Database user */
define('DB_USER', 'ucond_user');

/** Database password */
define('DB_PASSWORD', 'PASSWORD_DE_GODADDY');

/** Database host */
define('DB_HOST', 'db-mysql.ucondieresis.com');

// Force HTTPS
define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

// Disable File Editing (seguridad)
define('DISALLOW_FILE_EDIT', true);

// Limit Revisions (performance)
define('WP_POST_REVISIONS', 3);

// Disable XML-RPC (seguridad)
define('XMLRPC_REQUEST_METHODS_ALLOWED', false);
```

- [ ] Actualizar `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`
- [ ] Agregar defines de HTTPS, SSL
- [ ] Agregar disallow edit/revisions
- [ ] Commit to GitHub (con valores de EXAMPLE)

#### 2.5. Actualizar .htaccess
Crear `.htaccess` para GoDaddy:

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]

# Force HTTPS
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>

# Disable directory listing
Options -Indexes

# Protect wp-config
<files wp-config.php>
    order allow,deny
    deny from all
</files>
</IfModule>
# END WordPress
```

- [ ] Crear `.htaccess` con rules HTTPS + rewrites
- [ ] Copiar a deployment folder

---

### FASE 3: SUBIR A GODADDY

#### 3.1. Opción A: Via SFTP (Recomendado)

**Requisitos**:
- Cyberduck, FileZilla, o WinSCP instalado
- SFTP credentials de GoDaddy

**Pasos**:

1. **Conectar SFTP**
   - [ ] Host: `ftp.ucondieresis.com`
   - [ ] User: `ericklopez_ucond` (o similar)
   - [ ] Password: (de GoDaddy)
   - [ ] Port: `22` (SFTP)

2. **Subir archivos WordPress**
   ```
   LOCAL                                 REMOTE
   /wp-content/                    →     /html/wp-content/
   /wp-admin/                      →     /html/wp-admin/
   /wp-includes/                   →     /html/wp-includes/
   /index.php                      →     /html/index.php
   /wp-config.php                  →     /html/wp-config.php
   /.htaccess                      →     /html/.htaccess
   /wp-load.php, wp-login.php, etc →     /html/
   ```
   
   - [ ] Click derecho en carpeta local
   - [ ] "Sync" o "Upload"
   - [ ] Esperar confirmación

3. **Permisos de archivos**
   - [ ] Carpeta `/wp-content/uploads/`: `755`
   - [ ] Otros directorios: `755`
   - [ ] wp-config.php: `640` (lectura solo)

#### 3.2. Opción B: Via SSH + WP-CLI (Más rápido)

```bash
# SSH a GoDaddy
ssh ericklopez_ucond@ucondieresis.com

# Navegar a public_html
cd public_html/

# Descargar WordPress
wget https://wordpress.org/wordpress-6.9.1.tar.gz
tar -xzf wordpress-6.9.1.tar.gz

# Copiar wp-config (que preparaste localmente)
scp wp-config.php ericklopez_ucond@ucondieresis.com:~/public_html/

# Crear BD desde SSH
mysql -h db-mysql.ucondieresis.com -u ucond_user -p
CREATE DATABASE ucond_wordpress CHARACTER SET utf8mb4;
EXIT;
```

- [ ] Conectar SSH exitosamente
- [ ] WordPress files subidos
- [ ] Base de datos creada

#### 3.3. Importar Base de Datos

**Opción 1: Via PHP/cPanel**
- [ ] Acceder a cPanel de GoDaddy
- [ ] Abrir "phpMyAdmin"
- [ ] Crear BD: `ucond_wordpress`
- [ ] Importar SQL dump: `backup-16-marzo-2026.sql`
- [ ] Esperar completación

**Opción 2: Via SSH**
```bash
mysql -h db-mysql.ucondieresis.com -u ucond_user -p ucond_wordpress < backup-16-marzo-2026.sql
```

- [ ] BD importada
- [ ] Tablas verificadas: `SELECT COUNT(*) FROM ucond_posts;`

#### 3.4. Actualizar URLs en BD

**CRÍTICO**: Los URLs de desarrollo apuntan a `localhost:8000`

```bash
# Via WP-CLI sobre SSH
wp search-replace "http://localhost:8000" "https://ucondieresis.com" --allow-root

# Verificar cambios
wp option get siteurl --allow-root
wp option get home --allow-root
```

Alternativa (cPanel):
1. [ ] phpMyAdmin → `ucond_wordpress` → tabla `ucond_options`
2. [ ] Buscar filas: `siteurl`, `home`
3. [ ] Cambiar `http://localhost:8000` → `https://ucondieresis.com`

- [ ] URLs actualizados en BD

---

### FASE 4: TESTING EN PRODUCCIÓN

#### 4.1. Pruebas Básicas
```bash
# Test homepage
curl -I https://ucondieresis.com/
# Esperado: HTTP/1.1 200 OK

# Test catálogos
curl -I https://ucondieresis.com/catalogos/
# Esperado: HTTP/1.1 200 OK

# Test productos
curl -I https://ucondieresis.com/productos/
# Esperado: HTTP/1.1 200 OK
```

- [ ] Homepage carga (200 OK)
- [ ] Catálogos carga (200 OK)
- [ ] Productos carga (200 OK)
- [ ] HTTPS funciona
- [ ] Redirección HTTP → HTTPS

#### 4.2. Pruebas de Admin
- [ ] Acceder a `https://ucondieresis.com/wp-admin`
- [ ] Login: `955510pwpadmin` / `wordpress`
- [ ] Verificar dashboard carga
- [ ] Ir a Catálogos → Ver todos
- [ ] Verificar 4 catálogos presentes
- [ ] Descargar un PDF
- [ ] Ir a Productos → Ver todos
- [ ] Verificar botones WhatsApp

#### 4.3. Pruebas de Seguridad
```bash
# Verificar no hay debug.log público
curl -I https://ucondieresis.com/wp-content/debug.log
# Esperado: HTTP/1.1 404 Not Found

# Verificar WP_DEBUG off
# (No debe mostrar errores en frontend)

# Verificar wp-config protegido
curl -I https://ucondieresis.com/wp-config.php
# Esperado: HTTP/1.1 403 Forbidden

# Verificar SSL certificate
openssl s_client -connect ucondieresis.com:443
# Esperado: certificate data sin errores
```

- [ ] debug.log no accesible
- [ ] wp-config.php no accesible
- [ ] SSL válido y confiado
- [ ] No hay warnings en frontend

#### 4.4. Pruebas de Responsivos
- [ ] Abrir en navegador escritorio
- [ ] Abrir en móvil (viewport 375px)
- [ ] Verificar:
  - [ ] Header responsive
  - [ ] Catálogos en grid
  - [ ] Botones WhatsApp funcionales
  - [ ] Footer legible

#### 4.5. Pruebas de WhatsApp
- [ ] Click botón flotante
- [ ] Debe abrir: `https://wa.me/528442326171?text=...`
- [ ] Click en CTA section
- [ ] Mismo número debe aparecer
- [ ] Click en Footer
- [ ] Mismo número

- [ ] WhatsApp linking correcto
- [ ] Número correcto en todos lados

---

### FASE 5: POST-DEPLOYMENT

#### 5.1. Configurar Monitoreo
- [ ] Instalar security plugin:
  ```bash
  wp plugin install wordfence --activate --allow-root
  # o
  wp plugin install sucuri-scanner --activate --allow-root
  ```

- [ ] Configurar uptime monitoring:
  - [ ] https://uptimerobot.com
  - [ ] Crear monitor: `https://ucondieresis.com`
  - [ ] Interval: 5 minutos
  - [ ] Alert email: (tu email)

- [ ] Configurar backups automáticos:
  - [ ] cPanel → Backup
  - [ ] Configurar backup diario
  - [ ] Copiar a cloud (Google Drive, Dropbox)

#### 5.2. Cambiar Contraseña Admin
```bash
# Via WP-CLI
wp user update 1 --prompt=user_pass --allow-root

# O via admin panel
# Dashboard → Usuarios → Editar perfil → Nueva Contraseña
```

- [ ] Contraseña admin cambiada
- [ ] Guardar nueva en gestor de passwords

#### 5.3. Configurar Backups
**Recomendado: Duplicator or Backup Buddy plugin**

```bash
wp plugin install duplicator --activate --allow-root
```

- [ ] Backup plugin instalado
- [ ] Configurar backup semanal
- [ ] Almacenar en cloud

#### 5.4. Verificar Email
```bash
wp mail-check --allow-root
# o en admin panel: Tools → Send Test Email
```

- [ ] Email de admin funcional
- [ ] Recibir notificaciones

#### 5.5. Crear DEPLOYMENT_LOG.md

```markdown
# Deployment Log - ucondieresis.com

**Fecha**: 16 Marzo 2026  
**Versión**: 1.0.3  
**Hora Inicio**: HH:MM UTC  
**Hora Fin**: HH:MM UTC  
**Status**: ✅ ÉXITO / ❌ ERROR

## Pasos Completados
- [x] Security audit pasado
- [x] WP_DEBUG desactivado
- [x] BD migrada a GoDaddy
- [x] URLs actualizadas
- [x] SSL instalado
- [x] Testing completado

## Issues Encontrados
(ninguno)

## Acciones Post-Deploy
- Security plugin instalado
- Backups configurados
- Monitoreo activado
```

---

### FASE 6: DESMANTELAR SITIO WEEBLY (DESPUÉS DE 48 HORAS)

⚠️ **ESPERAR 48 HORAS ANTES DE ESTO**

En GoDaddy:
1. [ ] Apuntar DNS al nuevo dominio (si aplica)
2. [ ] Desactivar sitio Weebly
3. [ ] Archivar/Desactivar cuenta Weebly

---

## 🆘 ROLLBACK PLAN (Si algo falla)

**Si el deployment falla**, usar backup local:

```bash
# 1. Restaurar BD local
mysql wordpress < backup-16-marzo-2026.sql

# 2. Restaurar files
unzip ucondieresis-wordpress-16-marzo.zip

# 3. Cambiar wp-config.php a valores locales
# (Revert DB_HOST, DB_USER, etc.)

# 4. Reiniciar Docker
docker-compose down
docker-compose up -d

# 5. Test en localhost:8000
curl http://localhost:8000/
```

**Plan B - Usar WXR backup**:
```bash
# Crear WordPress limpio en GoDaddy
# Importar WXR dump
wp import ucondieresis-exporta-16-marzo-2026.xml --authors=create --allow-root
```

---

## 📊 CHECKLIST FINAL

```
PRE-DEPLOYMENT
  [ ] WP_DEBUG = false
  [ ] Security headers agregados
  [ ] Table prefix = ucond_
  [ ] wp-config.php actualizado
  [ ] .htaccess con HTTPS
  [ ] Backups locales creados
  [ ] Testing local OK

GODADDY
  [ ] Hosting activado
  [ ] SSL instalado
  [ ] SFTP/SSH credentials obtenidas
  [ ] BD creada

DEPLOYMENT
  [ ] Archivos subidos
  [ ] BD importada
  [ ] URLs actualizados
  [ ] Permisos correctos

TESTING
  [ ] Homepage OK (200)
  [ ] Catálogos OK (200)
  [ ] Productos OK (200)
  [ ] Admin login funciona
  [ ] WhatsApp funciona
  [ ] SSL válido
  [ ] Responsive OK

POST-DEPLOYMENT
  [ ] Security plugin instalado
  [ ] Backups configurados
  [ ] Monitoreo activado
  [ ] Password admin cambiada
  [ ] Email configurado
  [ ] Log creado
```

---

## 📞 CONTACTOS Y RECURSOS

**GoDaddy Support**: 1-833-4-GODADDY  
**WordPress Support**: https://wordpress.org/support/  
**Security Plugins**: Wordfence, Sucuri  
**Monitoring**: UptimeRobot, Pingdom  
**Backups**: Duplicator, Backwpup  

---

## ⏰ TIMELINE ESTIMADO

| Fase | Duración | Status |
|------|----------|--------|
| Pre-Deployment | 30 min | Ready |
| Preparación GoDaddy | 1 hora | Ready |
| Upload Files | 15 min | Ready |
| Importar BD | 10 min | Ready |
| Testing | 30 min | Ready |
| Post-Deploy | 20 min | Ready |
| **TOTAL** | **~2.5 horas** | ✅ |

**Target Final**: 16 de Marzo, 2026 (Tarde)

---

**Actualizado**: 16 Marzo 2026  
**Versión**: 1.0.3  
**Estado**: 🟢 LISTO PARA DEPLOYMENT


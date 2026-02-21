# Migración a GoDaddy - Guía Paso a Paso

## Antes de Migrar

- [ ] Sitio funcional locally (http://localhost:8000)
- [ ] Todas las páginas se ven correctamente
- [ ] Menús están configurados
- [ ] Imágenes están cargadas
- [ ] Formularios funcionan (si aplican)
- [ ] Backup local creado

---

## Paso 1: Preparar Hosting en GoDaddy

### 1.1 Acceder a GoDaddy
1. Ve a https://www.godaddy.com y inicia sesión
2. Ve a "Mis Productos" → busca tu hosting de WordPress
3. Click en "Administrar"

### 1.2 Verificar Información
Anota:
- **Host SFTP:** `sftp.godaddy.com` o similar
- **Usuario FTP:** Generalmente el mismo de la cuenta
- **Contraseña FTP:** De la cuenta GoDaddy
- **Ruta raíz:** `/public_html/`

### 1.3 Crear Base de Datos (si no existe)
En el panel de GoDaddy:
1. Busca "Bases de Datos"
2. Crea una nueva:
   - Nombre: `ucondieresis_com_db` (o similar)
   - Usuario: `ucondieresis_user` (o similar)
   - Contraseña: [Usar contraseña segura]
   - Anota estos datos

---

## Paso 2: Exportar Contenido Local

### 2.1 Exportar WordPress (WXR)
```bash
cd ~/Code/ucondieresis-wordpress

# Crear backup en formato WordPress
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root export > ucondieresis_backup.xml
```

Esto crea un archivo `ucondieresis_backup.xml` con:
- Todas las páginas
- Usuarios
- Menús
- Attachments
- Metadatos

### 2.2 Verificar el Backup
```bash
ls -lh ucondieresis_backup.xml
# Debería tener varios KB
```

---

## Paso 3: Instalar WordPress en GoDaddy

### 3.1 Opción A: Usando instalador automático de GoDaddy
1. En el panel de GoDaddy, busca "Instalar WordPress"
2. Sigue el asistente:
   - Dominio: `ucondieresis.com`
   - Título: `Ü con Diéresis`
   - Usuario admin: Crear uno nuevo
   - Contraseña: Fuerte y segura
3. Completar instalación

### 3.2 Opción B: Manual (si necesitas más control)
1. Vía SFTP, subir archivos de WordPress a `/public_html/`
2. Crear base de datos desde PHPMyAdmin
3. Ejecutar instalación en `ucondieresis.com/wp-admin/install.php`

---

## Paso 4: Importar Contenido

### 4.1 Acceder a GoDaddy WordPress Admin
```
URL: https://ucondieresis.com/wp-admin
(Usa credenciales creadas en Paso 3)
```

### 4.2 Instalar WordPress Importer
1. Plugins → Agregar nuevo
2. Busca "WordPress Importer"
3. Click en "Instalar ahora"
4. Activar

### 4.3 Importar el Backup
1. Herramientas → Importar
2. Selecciona "WordPress"
3. Sube el archivo `ucondieresis_backup.xml`
4. Asigna autores a tu usuario admin
5. ✅ Marca "Descargar adjuntos"
6. Click "Enviar"

**Esperar a que termine la importación** (~2-5 minutos)

---

## Paso 5: Configurar WordPress en GoDaddy

### 5.1 Configuración General
1. Ajustes → General
   - Título del sitio: `Ü con Diéresis`
   - Eslogan: [Tu eslogan]
   - URL de WordPress: `https://ucondieresis.com`
   - URL del sitio: `https://ucondieresis.com`
   - Guardar cambios

### 5.2 Permaenlaces
1. Ajustes → Permaenlaces
   - Selecciona: "Nombre de la entrada" (/%postname%/)
   - Guardar cambios

### 5.3 Lectura
1. Ajustes → Lectura
   - "La página frontal muestra": Selecciona "Una página estática"
   - "Página frontal": "Inicio" (o la que sea tu home)
   - "Página de entradas": "Entradas" (o crear "Blog")

### 5.4 Menús
1. Apariencia → Menús
   - Verificar que los menús se importaron
   - Asignar a ubicaciones si es necesario

---

## Paso 6: Verificar Contenido

### Checklist de Verificación
- [ ] Las 6 páginas aparecen en "Páginas"
- [ ] El menú está visible en el sitio
- [ ] Las imágenes cargan correctamente
- [ ] Los formularios funcionan (si aplican)
- [ ] Las URLs son limpias (sin ?p=123)
- [ ] El sitio es responsive (probar en móvil)

### Pruebas de Navegación
1. Abre https://ucondieresis.com
2. Click en cada página del menú
3. Verifica que las URLs cambien a: `/nosotros/`, `/contacto/`, etc.
4. Atrás y adelante funciona
5. Formulario funciona (si existe)

---

## Paso 7: Migrar Tema Personalizado (Opcional)

Si creaste cambios en el tema local:

### 7.1 Via SFTP
1. Abre VS Code
2. Instala extensión "SFTP"
3. Configura `.vscode/sftp.json` con credenciales GoDaddy:
```json
{
  "host": "sftp.godaddy.com",
  "username": "tu-usuario-ftp",
  "password": "tu-contraseña-ftp",
  "remotePath": "/public_html/wp-content/themes/ucondieresis/"
}
```
4. Click derecho en `wp-content/themes/ucondieresis/`
5. "SFTP: Upload Folder"

### 7.2 Via FTP Manual
- Usar cliente FTP (como CyberDuck, FileZilla)
- Subir `wp-content/themes/ucondieresis/` a `/public_html/wp-content/themes/`

---

## Paso 8: SSL y Seguridad

### 8.1 Activar HTTPS
1. GoDaddy generalmente lo hace automático
2. Ajustes → General
   - URL de WordPress: `https://ucondieresis.com` (con HTTPS)
   - URL del sitio: `https://ucondieresis.com` (con HTTPS)

### 8.2 Plugins de Seguridad (Recomendado)
1. Instala "Wordfence Security"
2. O "iThemes Security"
3. Configura firewall básico

---

## Paso 9: Redireccionamiento del Sitio Antiguo

Después de verificar que todo funciona en WordPress:

### 9.1 Redireccionamiento 301
En GoDaddy WHM/cPanel:
1. Busca "Redireccionamientos"
2. Redirige `ucondieresis.weebly.com` → `ucondieresis.com`

Esto ayuda con SEO (mantiene ranking)

### 9.2 Eliminar Sitio Antiguo
1. Después de verificar todo
2. Elimina/desactiva el sitio Weebly
3. Actualiza DNS si es necesario

---

## Troubleshooting

| Problema | Solución |
|----------|----------|
| "Error de conexión a BD" | Verificar credenciales BD en `wp-config.php` |
| URLs dan 404 | Ajustes → Permaenlaces → Guardar |
| Imágenes no cargan | Verificar rutas en `wp-config.php` |
| Admin es lento | Instalar "WP-Optimize" |
| Correos no se envían | Plugin "WP Mail SMTP" |

---

## Rollback (Si Algo Sale Mal)

Si necesitas volver atrás:

### 1. Eliminar WordPress en GoDaddy
1. En cPanel, elimina carpeta `/public_html/wordpress/`
2. En phpMyAdmin, elimina la base de datos

### 2. Reinstalar
1. Volver a hacer Paso 3 ("Instalar WordPress")
2. Intentar importación nuevamente

---

## Monitoreo Post-Migración

Después de Go Live:

- [ ] Monitorear tráfico 24 horas
- [ ] Verificar no hay errores (ver logs)
- [ ] Backup automático configurado
- [ ] Antivirus activo (Wordfence)
- [ ] Updates de WordPress cuando estén disponibles

---

## Contactos Útiles

- **GoDaddy Soporte:** https://www.godaddy.com/help
- **WordPress Soporte:** https://wordpress.org/support/
- **Errores comunes:** Ver logs en GoDaddy cPanel

---

**Estimado: 2-3 horas para completa migración**

**Última actualización:** 21 de febrero de 2026

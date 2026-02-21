# Guía de Desarrollo Local

## Ambiente Local - Docker

### Iniciar
```bash
docker-compose up -d

# Esperar ~30 segundos a que MySQL esté listo
```

### Acceso
```
URL: http://localhost:8000
Admin: http://localhost:8000/wp-admin
Usuario: 955510pwpadmin
Contraseña: wordpress (cambiar después!)
```

### Ver Logs
```bash
docker logs -f ucondieresis-wordpress-wordpress-1
```

### Detener
```bash
docker-compose down
```

### Reiniciar
```bash
docker-compose restart
```

## Cambios en el Código

Los archivos en `wp-content/` se sincronizan automáticamente a:
```
/var/www/html/wp-content/
```

### Estructura para Editar
```
wp-content/
├── themes/ucondieresis/
│   ├── style.css           ← Estilos principales
│   ├── functions.php       ← Hooks y funciones
│   ├── header.php
│   ├── footer.php
│   ├── page.php
│   ├── index.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
└── plugins/ucondieresis-custom/
    └── ucondieresis-custom.php  ← Plugin principal
```

## Workflow de Desarrollo

### 1. Hacer Cambios Locales
Edita archivos en tu editor (VS Code):
```
wp-content/themes/ucondieresis/style.css
wp-content/themes/ucondieresis/functions.php
etc.
```

### 2. Verificar en Navegador
Los cambios aparecen automáticamente en:
```
http://localhost:8000
```

*Nota: Algunos cambios requieren limpiar caché o hard-refresh (Cmd+Shift+R)*

### 3. Control de Versiones
```bash
# Ver cambios
git status

# Agregar cambios
git add wp-content/

# Commit
git commit -m "Descripción clara del cambio"

# Ver historial
git log --oneline
```

## Servidor Local con WP-CLI

Algunos comandos útiles con WP-CLI:

```bash
# Listar páginas
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post list --post_type=page

# Crear página nueva
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post create --post_type=page --post_title="Mi Página"

# Activar plugin
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin activate ucondieresis-custom

# Cambiar contraseña
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root user update 1 --prompt=user_pass

# Exportar contenido a WXR
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root export > backup.xml
```

## Troubleshooting

### WordPress no carga
```bash
# Verificar que está corriendo
docker ps | grep wordpress

# Si no aparece, iniciar
docker-compose up -d

# Esperar 30s y verificar logs
docker logs ucondieresis-wordpress-wordpress-1
```

### Cambios no aparecen
- Hacer hard-refresh (Cmd+Shift+R en Mac)
- Limpiar caché del navegador
- Si es JavaScript, verifica console (F12)
- Si es CSS, verifica el archivo esté salvado

### Error de permisos al editar
```bash
# Otorgar permisos correctos
docker exec ucondieresis-wordpress-wordpress-1 chown -R www-data:www-data /var/www/html/wp-content
```

### Base de datos no conecta
```bash
# Reiniciar servicios
docker-compose down
docker-compose up -d

# Esperar ~1 minuto y reintentar
```

## Desarrollo del Tema

### Jerarquía de Templates (WordPress)
```
1. page-{slug}.php          ← Página específica (ej: page-nosotros.php)
2. page-{id}.php            ← Por ID de página
3. page.php                 ← Plantilla genérica de página
4. index.php                ← Fallback
```

### Estructura CSS
```
wp-content/themes/ucondieresis/style.css
├── Reset/Normalize
├── Variables de color
├── Tipografía
├── Layout general
├── Header
├── Footer
├── Páginas específicas
└── Responsive queries
```

### Agregar Scripts/Estilos Personalizados
En `functions.php`:
```php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', [], null, true);
});
```

## Plugin Personalizado

Ver: `wp-content/plugins/ucondieresis-custom/README.md`

---

**Última actualización:** 21 de febrero de 2026

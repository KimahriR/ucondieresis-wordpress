# ⚙️ ACTIVACIÓN DE PLUGINS - GUÍA PASO A PASO

**Fecha**: 7 de mayo 2026  
**Acción**: Activar plugins después de no trabajar en 44 días

---

## 📋 ESTADO ACTUAL DE PLUGINS

### ✅ Instalados:
- **ucondieresis-custom** - Custom plugin v1.0.0 (REQUERIDO)
- **akismet** - Antispam (Opcional pero recomendado)
- **hello.php** - Default WordPress plugin

### ❌ Removidos (limpieza marzo):
- wordpress-importer (Setup tool, eliminado)
- widget-importer-exporter (Setup tool, eliminado)

---

## 🚀 PASOS PARA ACTIVAR PLUGINS

### OPCIÓN 1: VÍA WORDPRESS ADMIN (RECOMENDADO)

#### Paso 1: Acceder al admin
```
URL: http://localhost:8000/wp-admin
(O tu URL de producción en GoDaddy)
```

#### Paso 2: Ir a Plugins
```
Admin Dashboard 
  → Plugins en barra lateral izquierda
  → O clic en "Plugins > All Plugins"
```

#### Paso 3: Verificar y activar plugins

**Plugin 1: Ücondieresis Custom**
```
Nombre: Ücondieresis Custom
Versión: 1.0.0
Descripción: Extensiones y funcionalidades custom
Ruta: wp-content/plugins/ucondieresis-custom/

Status: ¿Desactivo?
  → Clic en "ACTIVATE"
  → Esperar a que cargue
  → Confirmar: ✅ Activo
```

**Plugin 2: Akismet Spam Protection**
```
Nombre: Akismet Spam Protection
Versión: [latest]
Descripción: Spam protection for comments
Ruta: wp-content/plugins/akismet/

Status: ¿Desactivo?
  → Clic en "ACTIVATE"
  → Esperar a que cargue
  → Confirmar: ✅ Activo
```

**Plugin 3: Hello Dolly (OPCIONAL)**
```
Nombre: Hello Dolly
Ruta: wp-content/plugins/hello.php

Status: Puede estar activo o inactivo
Decisión: 
  → Si está activo: "DEACTIVATE" (no es necesario)
  → Si está inactivo: Dejar así (no actives)
```

---

### OPCIÓN 2: VÍA WP-CLI (TERMINAL - AVANZADO)

Si tienes WP-CLI instalado:

```bash
# Activar ucondieresis-custom
wp plugin activate ucondieresis-custom

# Activar akismet
wp plugin activate akismet

# Ver estado de todos los plugins
wp plugin list

# Output deseado:
# ucondieresis-custom     1.0.0       active
# akismet                 [version]   active
# hello                   [version]   inactive (está bien)
```

---

### OPCIÓN 3: VÍA DATABASE (NO RECOMENDADO)

⚠️ Solo si wp-admin no funciona:

```sql
-- Activar ucondieresis-custom
UPDATE wp_options 
SET option_value = 'a:2:{i:0;s:34:"ucondieresis-custom/ucondieresis-custom.php";i:1;s:9:"akismet/index.php";}' 
WHERE option_name = 'active_plugins';

-- Verificar
SELECT option_value FROM wp_options WHERE option_name = 'active_plugins';
```

---

## ✅ VALIDACIÓN POST-ACTIVACIÓN

Después de activar los plugins, verifica:

### En WordPress Admin:
- [ ] Dashboard carga sin errores
- [ ] Plugins page muestra ambos activos
- [ ] No hay mensajes de error rojo

### En Frontend:
- [ ] Home page carga (http://localhost:8000)
- [ ] Header responde al scroll
- [ ] Footer tipografía correcta
- [ ] WhatsApp button visible
- [ ] Catálogos cargan

### En Browser Console (F12):
- [ ] No hay errores en rojo
- [ ] No hay warnings críticos
- [ ] No hay console.log spam

---

## 🔍 TROUBLESHOOTING

### Problema: Plugin "ucondieresis-custom" dice "Error"
**Solución**:
1. Verificar que archivo existe: `wp-content/plugins/ucondieresis-custom/ucondieresis-custom.php`
2. Revisar `wp-content/debug.log` para ver error específico
3. Si es parse error en PHP: revisar setup de PHP 8.3.30

### Problema: Akismet pide API key
**Solución**:
1. Puedes ignorar por ahora (no necesario en local)
2. En producción: obtener key gratis en https://akismet.com
3. Si no lo necesitas: desactivar

### Problema: Hello.php causa conflicto
**Solución**:
```
Opción A: Eliminar
rm wp-content/plugins/hello.php

Opción B: Dejar inactivo (está bien)
Dejar como "Inactive" en plugins list
```

### Problema: Cambios en footer.css no se ven
**Solución**:
```bash
# Hard refresh en navegador:
Cmd+Shift+R (macOS)
Ctrl+Shift+R (Windows/Linux)

# Si sigue sin funcionar: Limpiar cache
docker-compose exec wordpress bash
rm -rf /var/www/html/wp-content/cache/*
exit
```

---

## 📊 CHECKLIST FINAL

- [ ] **Plugins verificados**: ✅ Al menos ucondieresis-custom activo
- [ ] **WordPress carga**: ✅ Sin errores críticos
- [ ] **Frontend funcional**: ✅ Home page carga
- [ ] **Tipografía footer**: ✅ Logo elegante visible
- [ ] **Git pusheado**: ✅ Cambios en GitHub

---

## 🎯 PRÓXIMO PASO

Una vez activados los plugins:

1. **Hacer test completo del sitio**
   - Todas las páginas
   - Responsiveness
   - Browser compatibility

2. **Si todo está bien**: Preparar para GoDaddy
   - Cambiar wp-config.php
   - Configurar HTTPS
   - Preparar base de datos

3. **Si hay problemas**: Revisar `SOPORTE_TECNICO.md`

---

## 📞 SOPORTE

Si necesitas más info:
- Leer: `DEPLOYMENT_FINAL_CHECKLIST.md`
- Leer: `SECURITY_AUDIT_v1.0.3.md`
- Revisar: `debug.log` en `wp-content/`

**Estado actual**: 🟡 Esperando activación de plugins  
**Disponible en**: http://localhost:8000/wp-admin


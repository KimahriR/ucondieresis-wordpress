# 🔧 SOPORTE TÉCNICO - Guía para el Equipo

**Para:** Personal de soporte técnico  
**Propósito:** Troubleshooting rápido y efectivo

---

## 🚨 Problemas Comunes

### 1️⃣ "No aparece menú Productos en WordPress"

**Síntoma:** Admin → Sidebar no muestra "Productos"

**Solución:**
```
1. WordPress Admin → Plugins
2. Busca "Ü con Diéresis"
3. Si dice "Activar" → Click activar
4. Espera 5 segundos
5. Recarga navegador (F5 o Cmd+R)
6. Verifica que aparezca menú
```

**Si sigue sin aparecer:**
- Ver: `wp-content/debug.log`
- Busca líneas con **ERROR**
- Reporta el error exacto

---

### 2️⃣ "Botón WhatsApp no abre WhatsApp"

**Síntoma:** Click en botón "Cotizar" → No pasa nada o error

**Verificar:**

```bash
# 1. Número de WhatsApp está configurado?
Archivo: wp-content/plugins/ucondieresis-custom/includes/config.php
Línea 20: define('UCONDIERESIS_WHATSAPP_NUMBER', '???');

# Formato correcto:
525512345678     ✅ (9-13 dígitos, sin +, sin espacios)
+52 1551234567   ❌ (No - tiene símbolos)
5551234567       ❌ (No - falta código país)
```

**Si número está bien:**
```
1. Abre navegador
2. Marca URL manualmente:
   https://wa.me/5215559876543?text=Hola
   (Usa el número configurado)
3. ¿Se abre WhatsApp? → Problema en botón HTML
4. ¿No se abre? → Problema en número configurado
```

---

### 3️⃣ "Productos no aparecen en home/listado"

**Síntoma:** Home se ve vacía, grid sin productos

**Verificar:**
```
1. ¿Existen productos creados?
   WordPress Admin → Productos
   ¿Hay al menos 1 producto?
   
2. Si no hay → Crear producto (ver QUICK_START.md)

3. Si hay productos:
   a) Abre cada producto
   b) Busca checkbox "Mostrar en Home"
   c) Marca todas las 3 casillas
   d) Click Actualizar
   e) Recarga front-end

4. ¿Aún no aparecen?
   → Ver wp-content/debug.log para errores
```

---

### 4️⃣ "Las imágenes de productos no cargan"

**Síntoma:** Espacio gris/vacío donde debe ir la imagen

**Solución:**
```
1. WordPress Admin → Productos → Editar producto
2. Busca "Imagen destacada" (abajo a la derecha)
3. Click "Establecer imagen destacada"
4. Sube foto: mín. 600x600px, JPG o PNG
5. Confirma selección
6. Click "Actualizar"
7. Recarga front-end
```

---

### 5️⃣ "Error 500 o página rota"

**Síntoma:** Página blanca, error de servidor

**Pasos:**
```
1. Ver archivo: wp-content/debug.log
   cat wp-content/debug.log | tail -20

2. Copiar líneas de error

3. Si error menciona:
   - "Parse error" → Problema en código PHP
   - "Undefined variable" → Variable no existe
   - "Class not found" → Clase no cargada
   
4. Reportar error completo al desarrollador

5. Mientras tanto:
   - Desactivar plugin "Ü con Diéresis"
   - Sitio debe volver a funcionar
   - Significa problema está en plugin
```

**Reporte formato:**
```
Error en archivo: [archivo]::[línea]
Mensaje: [error exacto]
Stack trace: [si hay]
```

---

### 6️⃣ "Base de datos desconectada"

**Síntoma:** "Error connecting to database"

**Verificar:**
```
1. ¿Docker running?
   docker ps | grep ucondieresis
   
   Debe mostrar contenedores corriendo
   Si no → Iniciar:
   docker-compose up -d

2. ¿Contenedor MySQL corriendo?
   docker ps | grep mysql
   
   Si no → Reiniciar:
   docker-compose restart

3. Espera 10 segundos
4. Recarga WordPress

Si sigue fallando → Contactar DevOps
```

---

## 🔧 Verificaciones Rápidas

### ¿El sitio está funcionando?

```bash
# Test 1: Frontend cargas?
curl http://localhost:8000 -I

# Test 2: WordPress CLI responde?
docker exec ucondieresis-wordpress-wordpress-1 \
  wp --allow-root core version

# Test 3: Plugin está activado?
docker exec ucondieresis-wordpress-wordpress-1 \
  wp --allow-root plugin list | grep ucondieresis
```

---

## 📊 Archivos Importantes

| Archivo | Propósito | Ubicación |
|---------|-----------|-----------|
| **config.php** | ⭐ Configuración WhatsApp | `/wp-content/plugins/ucondieresis-custom/includes/config.php` |
| **debug.log** | Errores técnicos | `/wp-content/debug.log` |
| **.htaccess** | Rewrite rules | `/root/.htaccess` |
| **wp-config.php** | Config WordPress | `/root/wp-config.php` |

### Cómo leer debug.log

```bash
# Ver últimas 20 líneas
tail -20 wp-content/debug.log

# Ver líneas con ERROR
grep "ERROR" wp-content/debug.log

# Ver líneas con WARNING
grep "WARNING" wp-content/debug.log

# Filtrar por fecha/hora
grep "2026-02-21" wp-content/debug.log
```

---

## 🚀 Acciones Comunes

### Activar/Desactivar Plugin

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin activate ucondieresis-custom
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin deactivate ucondieresis-custom
```

### Ver estado plugins

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin list
```

### Limpiar caché (si existe)

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root cache flush
```

### Ver logs Docker

```bash
docker logs ucondieresis-wordpress-wordpress-1 --tail 50
docker logs ucondieresis-wordpress-wordpress-1 -f  # En vivo
```

---

## ⚠️ NO Hacer

❌ Editar archivos en `/wp-content/plugins/ucondieresis-custom/` sin backup  
❌ Cambiar permisos de archivos sin saber consecuencias  
❌ Desactivar múltiples plugins a la vez para troubleshoot  
❌ Borrar debug.log sin copiar primero  
❌ Modificar base de datos directamente  

---

## 📞 Escalar a DevOps

**Reportar cuando:**
- Error PHP que no se resolve activando/desactivando
- Problema de base de datos
- Problemas Docker
- Cambios de configuración de servidor

**Información que dar:**
1. Descripción del problema
2. Pasos para reproducir
3. Error exacto de debug.log
4. Output de: `docker ps`
5. Output de: `docker logs [container]`

---

## ✅ Checklist de Verificación

Usar cuando usuario reporta "algo no funciona":

- [ ] ¿Plugin está activado?
- [ ] ¿Hay errores en debug.log?
- [ ] ¿Docker containers están running?
- [ ] ¿Se puede acceder al admin?
- [ ] ¿Recargaste el navegador (Ctrl+Shift+R)?
- [ ] ¿Problema persiste después de reiniciar Docker?
- [ ] ¿Otro navegador o dispositivo tiene el mismo problema?

Si todas son SÍ → Escalar a DevOps con información

---

**Versión:** 1.0  
**Última actualización:** 21 Feb 2026

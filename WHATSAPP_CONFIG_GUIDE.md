# 🔐 ESTABLECER NÚMERO WHATSAPP DE FORMA SEGURA

## ⚠️ PROBLEMA ACTUAL
El número de WhatsApp está hardcodeado en `functions.php`:
```php
'number' => '521234567890', // TODO: Mover a wp-config.php o constants
```

---

## ✅ SOLUCIONES (Elige una)

### OPCIÓN 1: WordPress Config (RECOMENDADO)
Más seguro en almacenamiento privado

**1. Editar `wp-config.php`:**
```php
// Después de define('ABSPATH', ...)
define('UCONDIERESIS_WHATSAPP_NUMBER', '521234567890');
```

**2. Usar en `functions.php`:**
```php
wp_localize_script('ucondieresis-cta-whatsapp', 'ucondieresisWhatsApp', array(
    'number' => defined('UCONDIERESIS_WHATSAPP_NUMBER') 
        ? UCONDIERESIS_WHATSAPP_NUMBER 
        : '521234567890',
    'messages' => array(
        'gift' => __('Hola! Quiero crear un regalo personalizado 💛', 'ucondieresis'),
        'business' => __('Hola! Tengo una consulta para mi negocio 🚀', 'ucondieresis'),
        'quick' => __('Hola! Tengo una consulta rápida ⚡', 'ucondieresis'),
    ),
));
```

**Ventajas:**
- ✅ No está en control de versiones
- ✅ Seguro si `wp-config.php` está fuera del web root
- ✅ Se puede cambiar sin modificar código

---

### OPCIÓN 2: Options Table (WordPress)
Guardado en base de datos, configurable desde admin

**1. Crear función en `functions.php`:**
```php
/**
 * Get WhatsApp number from options
 * Falls back to constant or hardcoded value
 */
function ucondieresis_get_whatsapp_number() {
    return get_option('ucondieresis_whatsapp_number', 
        defined('UCONDIERESIS_WHATSAPP_NUMBER') 
            ? UCONDIERESIS_WHATSAPP_NUMBER 
            : '521234567890'
    );
}

/**
 * Register settings
 */
function ucondieresis_register_settings() {
    register_setting('general', 'ucondieresis_whatsapp_number', array(
        'type' => 'string',
        'sanitize_callback' => function($value) {
            // Validar formato de número (solo dígitos)
            return sanitize_text_field(preg_replace('/\D/', '', $value));
        },
        'show_in_rest' => true,
    ));
}
add_action('admin_init', 'ucondieresis_register_settings');
```

**2. Usar en `functions.php`:**
```php
wp_localize_script('ucondieresis-cta-whatsapp', 'ucondieresisWhatsApp', array(
    'number' => ucondieresis_get_whatsapp_number(),
    // ... messages ...
));
```

**Ventajas:**
- ✅ Configurable desde WordPress admin
- ✅ Se puede cambiar sin acceso a servidor
- ✅ Más flexible

---

### OPCIÓN 3: Archivo .env (si usas roots/bedrock o similar)
```bash
# .env
UCONDIERESIS_WHATSAPP_NUMBER=521234567890
```

Luego en `functions.php`:
```php
'number' => getenv('UCONDIERESIS_WHATSAPP_NUMBER') ?: '521234567890',
```

---

## 📋 PASO A PASO: IMPLEMENTAR OPCIÓN 1 (RECOMENDADA)

1. **Acceder al servidor:**
   ```bash
   ssh user@server
   cd /ruta/a/site/app/
   ```

2. **Editar `wp-config.php`:**
   ```bash
   nano wp-config.php
   ```

3. **Agregar al inicio (antes de `require('wp-settings.php');`):**
   ```php
   /**
    * WhatsApp Configuration
    */
   define('UCONDIERESIS_WHATSAPP_NUMBER', '521234567890'); // Cambiar a número real
   ```

4. **Guardar (Ctrl+O, Enter, Ctrl+X)**

5. **No requiere cambios en código (ya está implementado)**

6. **Hard refresh en navegador:**
   - Mac: `Cmd + Shift + R`
   - Windows: `Ctrl + Shift + F5`

---

## 🔒 VALIDACIÓN DE SEGURIDAD

✅ El número está protegido en `wp-config.php`  
✅ Se pasa vía `wp_localize_script()` (no desde HTML)  
✅ JavaScript usa variable global inyectada  
✅ No se expone en HTML source  
✅ No está en control de versiones  

---

## ✋ IMPORTANTE

**NO hagas esto:**
```php
// ❌ NEVER - Expone en HTML
<script>
  const whatsapp = '521234567890'; // ¡PÚBLICO!
</script>

// ❌ NEVER - Expone en logs
echo 'WhatsApp: ' . $number; // ¡VISIBLE!

// ❌ NEVER - En comentarios
// Our WhatsApp: 521234567890 // ¡EN GIT!
```

**SIEMPRE:**
```php
// ✅ Usa wp_localize_script()
wp_localize_script('handle', 'window.obj', ['number' => $num]);

// ✅ Usa sanitized values
$number = sanitize_text_field(preg_replace('/\D/', '', $input));

// ✅ Guarda en wp-config.php o options table
```

---

**Próxima auditoría**: 15 marzo 2026

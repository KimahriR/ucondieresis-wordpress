# 🧹 PLAN DE LIMPIEZA DEL PROYECTO v1.0.4

**Status**: Identificados archivos a eliminar  
**Fecha**: 24 de marzo de 2026  
**Tamaño Total a Liberar**: ~50-100MB aproximadamente

---

## 📊 ARCHIVOS A ELIMINAR

### 1. 🔴 BACKUPS XML (6 archivos - 80MB+)
**Razón**: Copias de seguridad ancianas, no necesarias en repo

```
❌ backup-estado-limpio-20260221-002156.xml          (20MB aprox)
❌ backup-limpieza-20260221-001802.xml               (20MB aprox)
❌ backup-workspace-20260221-020920.xml              (20MB aprox)
❌ ucondieresis-backup-antes-limpieza-20260221...xml (15MB aprox)
❌ ucondieresis-wxr-full.xml                         (15MB aprox)
❌ backups/backup-previo-refactor-20260301...xml     (10MB aprox)
```

**Acción**: Eliminar todos, mantener en local si necesitas de respaldo

---

### 2. 🟡 PLUGINS DE SETUP (3 - solo para desarrollo)
**Razón**: Solo se usan para importar contenido, no necesarios en producción

```
❌ wp-content/plugins/wordpress-importer/            (Setup tool)
❌ wp-content/plugins/widget-importer-exporter/      (Setup tool)
❌ wp-content/plugins/hello.php                      (Default plugin)
```

**Acción**: Desactivar en admin WordPress, luego eliminar

---

### 3. 🟡 TEMAS NO USADOS (3 - fallbacks default)
**Razón**: WordPress viene con temas por defecto, no necesarios

```
❌ wp-content/themes/twentytwentythree/
❌ wp-content/themes/twentytwentyfour/
❌ wp-content/themes/twentytwentyfive/
```

**Acción**: Eliminar (tenemos ucondieresis como tema principal)

---

### 4. 🟡 SCRIPTS DE DESARROLLO (4 - export de datos)
**Razón**: Scripts para build de catálogos, uso local únicamente

```
❌ scripts/build_full_wxr.py
❌ scripts/build_valid_wxr.py
❌ scripts/download_images_and_build_wxr.py
❌ scripts/retry_download_images.py
```

**Acción**: Mantener en carpeta local pero no en GoDaddy (o si necesitas, documentar)

---

### 5. 🟡 DOCUMENTOS DUPLICADOS/ANTIGUOS (5)
**Razón**: Documentación anterior reemplazada por versiones más recientes

```
❌ AUDIT_REPORT.md                    (Reemplazado por AUDIT_DEBUGGING_v1.0.4.md)
❌ DEPRECATION_CHECKLIST.md           (Obsoleto)
❌ PRE_PRODUCCION.md                  (Obsoleto)
❌ DEPLOYMENT_CHECKLIST.md            (Reemplazado por DEPLOYMENT_FINAL_CHECKLIST.md)
❌ WORKSPACE_STATUS.md                (Obsoleto)
```

**Acción**: Archivar localmente si necesitas referencia, eliminar del repo

---

### 6. ✅ ARCHIVOS A MANTENER

```
✅ .env.example                       (Plantilla de config)
✅ .gitignore                         (Control de versionado)
✅ .htaccess                          (Security headers)
✅ docker-compose.yml                 (Development local)
✅ README.md                          (Documentación principal)
✅ AUDIT_DEBUGGING_v1.0.4.md          (Último audit)
✅ DEPLOYMENT_FINAL_CHECKLIST.md      (GoDaddy steps)
✅ RESUMEN_FINAL_CONFIG.md            (Estado actual)
✅ SECURITY_AUDIT_v1.0.3.md           (Histórico)
✅ WHATSAPP_CONFIG_GUIDE.md           (Setup WhatsApp)
✅ SOPORTE_TECNICO.md                 (Support docs)
✅ QUICK_START.md                     (Getting started)
```

---

## 📁 ESTRUCTURA DESPUÉS DE LIMPIEZA

```
✅ LIMPIO - Producción Ready

ucondieresis-wordpress/
├── .env.example
├── .gitignore
├── .htaccess
├── docker-compose.yml
├── README.md
├── wp-config.php (NO en repo)
│
├── 📖 Documentación
│   ├── AUDIT_DEBUGGING_v1.0.4.md
│   ├── DEPLOYMENT_FINAL_CHECKLIST.md
│   ├── RESUMEN_FINAL_CONFIG.md
│   ├── SECURITY_AUDIT_v1.0.3.md
│   ├── WHATSAPP_CONFIG_GUIDE.md
│   ├── SOPORTE_TECNICO.md
│   └── QUICK_START.md
│
├── 📦 WordPress Core (no mostrado)
│
└── wp-content/
    ├── plugins/
    │   ├── ucondieresis-custom/    ✅ MANTENER
    │   └── akismet/                ✅ MANTENER (antispam, opcional)
    │
    └── themes/
        └── ucondieresis/            ✅ MANTENER (tema activo)
```

---

## ⚡ PROCESO RECOMENDADO DE LIMPIEZA

### FASE 1: Local Development (AHORA)
```bash
# 1. Identificar archivos (HECHO ✅)
# 2. Crear documento de limpieza (HECHO ✅)
# 3. Verificar que nada importante se perderá
# 4. Git rm los archivos
# 5. Commit con mensaje "chore: Remove obsolete files"
```

### FASE 2: Antes de GoDaddy
```bash
# En wp-admin:
1. Desactivar: WordPress Importer
2. Desactivar: Widget Importer Exporter
3. Ir a Plugins > Installed
4. Eliminar (Delete) ambos plugins
5. Eliminar (Delete) Hello Dolly plugin
```

### FASE 3: En GoDaddy
```bash
# Via SFTP:
1. NO subir: scripts/
2. NO subir: .vscode/
3. NO subir: .git/
4. NO subir: node_modules/ (si existe)
5. Incluir: wp-content/plugins/ucondieresis-custom/ SOLO
6. Incluir: wp-content/themes/ucondieresis/ SOLO
```

---

## 📊 IMPACTO DE LA LIMPIEZA

| Métrica | Antes | Después | Ahorrado |
|---------|-------|---------|----------|
| **XML Backups** | 6 archivos | 0 archivos | 100MB+ |
| **Plugins Setup** | 3 | 0 | 5MB |
| **Temas Default** | 3 | 0 | 10MB |
| **Scripts** | 4 | 0 | 1MB |
| **Docs Obsoleta** | 5 | 0 | 0.5MB |
| **Tamaño Total** | 116.5MB | ~30MB | 86.5MB |

**Beneficio**: Repo más pequeño, más rápido de clonar y desplegar

---

## ✅ CHECKLIST ANTES DE ELIMINAR

- [ ] Backups XML están guardados localmente (si los necesitas después)
- [ ] Verificar que no tengas datos críticos solo en esos backups
- [ ] Confirmar que ucondieresis-custom tiene todo lo necesario
- [ ] Verificar que no hay datos en plugins de setup
- [ ] Documentar la limpieza en un commit

---

## 🚀 QUIERES QUE PROCEDA CON LA LIMPIEZA?

Opciones:

1. **Limpieza TOTAL** - Eliminar todo lo que listó
2. **Limpieza PARCIAL** - Solo backups + plugins setup
3. **Limpieza CONSERVADORA** - Solo backups
4. **Sin cambios** - Mantener todo como está

¿Cuál prefieres?


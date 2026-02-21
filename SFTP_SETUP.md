# Configuración de SFTP para GoDaddy

## Obtener credenciales SFTP de GoDaddy

1. **Inicia sesión en tu cuenta de GoDaddy**:
   - Ve a https://www.godaddy.com/
   - Inicia sesión con tu usuario y contraseña

2. **Accede al hosting**:
   - Ve a "Productos" > "Hosting de WordPress" (o tu plan de hosting)
   - Haz clic en "Administrar"

3. **Obtén credenciales SFTP**:
   - En el panel, busca "Gestor de archivos" o "SFTP"
   - O ve a "Configuración" > "Información de conexión"
   - Copia:
     - **Host**: sftp.godaddy.com o tu-dominio.com
     - **Username**: Tu usuario FTP de GoDaddy
     - **Password**: Tu contraseña FTP
     - **Port**: 22 (para SFTP)

4. **Actualiza `.vscode/sftp.json`**:
   - Abre el archivo `.vscode/sftp.json`
   - Reemplaza los valores con tus credenciales reales:
   ```json
   {
     "host": "sftp.godaddy.com",
     "username": "tu-usuario-ftp",
     "password": "tu-contraseña-ftp",
     "remotePath": "/public_html"
   }
   ```

## Usando SFTP en VS Code

1. **Comando palette** (Cmd+Shift+P):
   - Escribe "SFTP" y elige entre:
     - "SFTP: Upload File" - subir un archivo
     - "SFTP: Upload Folder" - subir una carpeta
     - "SFTP: Download File" - descargar un archivo
     - "SFTP: Compare to Remote" - comparar con servidor

2. **O clic derecho en Explorer**:
   - Haz clic derecho en una carpeta
   - Selecciona "Upload" o "Download"

## Seguridad

⚠️ **IMPORTANTE**: No subas `.vscode/sftp.json` a GitHub sin eliminar las credenciales.

Puedes:
- Agregar credenciales seguras usando variables de entorno
- O usar una rama local sin publicar en GitHub

Para mayor seguridad, usa SSH key en lugar de contraseña:
- Reemplaza `"password"` con `"privateKeyPath": "/Users/tu-usuario/.ssh/id_rsa"`

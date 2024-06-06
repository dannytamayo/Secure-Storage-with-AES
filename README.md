# 🗃️ Proyecto Laravel: Gestión de Usuarios y Roles

Este proyecto está diseñado para gestionar usuarios y asignarles roles específicos. Incluye funcionalidades para la creación de usuarios, asignación de roles, gestión de permisos, y manejo de archivos encriptados.

## ✨ Características

1. **👥 Gestión de Usuarios**: Permite crear, editar y eliminar usuarios.
2. **🛡️ Asignación de Roles**: Asigna roles específicos a los usuarios (Super Usuario, Secretaria General, Secretaria).
3. **🔒 Gestión de Permisos**: Define los paths de acceso para cada usuario basado en su rol.
4. **📁 Gestión de Archivos**: Permite crear carpetas, subir archivos que se encriptan con AES y descargar los archivos encriptados.

## 🧰 Tecnología Utilizada

- **🔧 Backend**: Laravel
- **💻 Frontend**: Livewire, HTML, CSS, JS

## 📋 Requisitos

- PHP >= 7.3
- Composer
- MySQL o MariaDB
- Node.js y npm

## 🚀 Instalación

### Paso 1: Clonar el repositorio

```bash
https://github.com/dannytamayo/Secure-Storage-with-AES.git
cd Secure-Storage-with-AES
```

### Paso 2: Instalar dependencias de PHP

```bash
composer install
```

### Paso 3: Configurar el archivo .env

Copia el archivo de ejemplo .env.example a .env:

```bash
cp .env.example .env
```

Edita el archivo .env con tus credenciales de base de datos:

DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=nombre_de_tu_base_de_datos<br>
DB_USERNAME=tu_usuario<br>
DB_PASSWORD=tu_contraseña<br>

### Paso 4: Ejecutar las migraciones

```bash
php artisan migrate
```

## ⚙️ Uso

### 👤 Crear Usuarios y Asignar Roles

Para crear un usuario y asignarle un rol, navega a [http://tu_dominio.com/rol/create]. Llena el formulario con los datos del usuario y selecciona el rol adecuado.

### 📂 Gestión de Archivos

Los usuarios pueden crear carpetas y subir archivos encriptados desde su panel de usuario. Los archivos se encriptan usando AES y pueden ser descargados de manera segura.

### 🛡️ Roles y Permisos

- **🌟 Super Usuario:** Tiene acceso completo a todas las funcionalidades y paths.
- **📋 Secretaria General:** Tiene acceso a la mayoría de las funcionalidades con ciertas restricciones.
- **🗂️ Secretaria:** Tiene acceso limitado basado en las necesidades de su rol.




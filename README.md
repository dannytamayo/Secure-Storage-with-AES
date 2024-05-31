# Proyecto Laravel: Gestión de Usuarios y Roles

Este proyecto está diseñado para gestionar usuarios y asignarles roles específicos. Incluye funcionalidades para la creación de usuarios, asignación de roles, gestión de permisos, y manejo de archivos encriptados.

## Características

1. **Gestión de Usuarios**: Permite crear, editar y eliminar usuarios.
2. **Asignación de Roles**: Asigna roles específicos a los usuarios (Super Usuario, Secretaria General, Secretaria).
3. **Gestión de Permisos**: Define los paths de acceso para cada usuario basado en su rol.
4. **Gestión de Archivos**: Permite crear carpetas, subir archivos que se encriptan con AES y descargar los archivos encriptados.

## Requisitos

- PHP >= 7.3
- Composer
- MySQL o MariaDB
- Node.js y npm

## Instalación

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

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña



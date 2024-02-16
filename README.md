# Prueba API RESTful TUXPAN

Esta API RESTful está diseñada para manejar la gestión de usuarios, tareas y estados de tarea.

## Instalación

1. Clona el repositorio de la aplicación:

git clone https://github.com/eliezer302/tuxpan.git

2. Accede al directorio de la aplicación:

cd tuxpan

3. Instala las dependencias de PHP utilizando Composer:

composer install

4. Copia el archivo de configuración de ejemplo .env.example y crea tu propio archivo .env:

cp .env.example .env

5. Genera una clave de aplicación única:

php artisan key:generate

6. Configura tu base de datos en el archivo .env:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=nombre_de_tu_base_de_datos

DB_USERNAME=usuario_de_tu_base_de_datos

DB_PASSWORD=contraseña_de_tu_base_de_datos

7. Ejecuta las migraciones para crear las tablas y los seeder para alimentar las bases de datos:

php artisan migrate

php artisan db:seed

php artisan db:seed --class=TaskStatusesSeeder

8. Inicia el servidor de desarrollo:

php artisan serve

## URLs de Solicitudes

### Usuarios

#### Obtener todos los usuarios
GET /api/users

#### Crear un nuevo usuario
POST /api/users

#### Obtener un usuario por su ID
GET /api/users/{id}

#### Actualizar un usuario existente
PUT /api/users/{id}

#### Eliminar un usuario existente
DELETE /api/users/{id}

### Tareas

#### Obtener todas las tareas
GET /api/tasks

#### Crear una nueva tarea
POST /api/tasks

#### Obtener una tarea por su ID
GET /api/tasks/{id}

#### Actualizar una tarea existente
PUT /api/tasks/{id}

#### Eliminar una tarea existente
DELETE /api/tasks/{id}

### Estados de Tarea

#### Obtener todos los estados de tarea
GET /api/taskStatuses

## Autorización

Para poder obtener la información se debe ingresar con usuario por autenticación básica:

### Usuario: eliezer.rubio90@gmail.com
### Contraseña: 12345678

Estas instrucciones proporcionan un conjunto básico de pasos para instalar la aplicación y comenzar a usarla. Asegúrate de adaptar las configuraciones de la base de datos en el archivo `.env` según tu entorno de desarrollo local. Una vez que hayas seguido estos pasos, podrás acceder a la API y utilizar las rutas definidas para gestionar usuarios, tareas y estados de tarea.

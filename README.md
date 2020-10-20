# Pruebabackend

## Instrucciones

1. Clonar repo:

`git clone https://github.com/fedeSp/Pruebabackend.git`

2. Abrir la carpeta generada, con git

### Instalar composer

>https://getcomposer.org/doc/00-intro.md#installation-windows

### Instalar Laravel

`composer global require laravel/installer`

### Con git, ingresar en la carpeta "Proyecto_Backend"

`cd Proyecto_Backend`

### Ejecutar composer

`composer install`

### Y el comando:

`composer update`

### Levantar MySQL y crear la base de datos "prueba"

### Copiar el archivo .env.example, pegarlo en la misma carpeta quitandole el ".example" del nombre

### Modificar dentro del .env creado, "DB_DATABASE" añadiendo el nombre de la base de datos

### Crear la key con el comando:

`php artisan key:generate`

### Cargar las migraciones

`php artisan migrate`

### Por ultimo levantar el proyecto

`php artisan serv o php artisan serve`



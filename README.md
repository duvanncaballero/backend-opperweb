# OpperWeb - Prueba Técnica

[![GitHub license](https://img.shields.io/github/license/gothinkster/laravel-realworld-example-app.svg)](https://raw.githubusercontent.com/gothinkster/laravel-realworld-example-app/master/LICENSE)
<img src="https://img.shields.io/badge/php-8.1.1-blue" />

# Instalación

Consulte la guía de instalación oficial de laravel para conocer los requisitos del servidor antes de comenzar. [Documentación Oficial](https://laravel.com/docs/9.x)

Clonar el repositorio

    git clone https://github.com/duvanncaballero/backend-opperweb

Cambiar a la carpeta del repositorio

    cd backend-opperweb

Instala todas las dependencias usando composer

    composer install

Copie el archivo env de ejemplo y realice los cambios de configuración necesarios en el archivo .env

    cp .env.example .env

Generar una nueva clave de aplicación

    php artisan key:generate

Ejecutar las migraciones de base de datos (**Establezca la conexión de la base de datos en .env antes de migrar**)

    php artisan migrate

Ejecutar la migraciones de informacion que se encuentran en los seeder

    php artisan db:seed

Inicie el servidor de desarrollo local

    php artisan serve

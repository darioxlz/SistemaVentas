# Software requerido:

### PostgreSQL

### PHP --- Habilitar extension gd en php.ini

### Composer

### Laravel

1. Ejecuta `composer install`
2. Crea la base de datos `sistemaventas` en tu servidor postgres
3. Configura las credenciales de tu base de datos en el archivo `.env`
4. Ejecuta `php artisan migrate:fresh --seed`
5. Run `php artisan serve`

Si quieres ejecutar el contenedor docker debes:

1. Copiar el contenido de tu archivo `.env` a un archivo llamado `.env.docker`
2. Ejecuta `docker-compose --env-file=.env.docker up -d`

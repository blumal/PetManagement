### Pasos para la descarga y prueba de la aplicación:

1. clonar el repositorio

2. instalar las dependencias que faltan mediante el comando `composer install`

   > puede que, por problemas de compatibilidad, nos pida correr el comando`composer update`

3. crear el fichero `.env` en el directorio principal del proyecto con el contenido pertinente

   > se puede utilizar el fichero `.env.example` para generar el nuevo `.env`
   >
   > `mv .env.example .env`

4. finalmente, Laravel puede pedir que se ejecute el comando `php artisan key:generate` para generar una nueva variable de entorno APP_KEY

5. crear la base de datos mediante migraciones o manualmente (este proyecto utiliza migraciones, se ha de correr el comando `php artisan migrate` para generar la migración)


INSTALAR PDF

1. Dentro de la carpeta del proyecto ejecutamos
    > composer create-project laravel/laravel laravel-pdf --prefer-dist
2. Le pedimos al composer que pida el plugin
    > composer require barryvdh/laravel-dompdf
3. AHora pedimos que nos lo meta
    > php artisan vendor:publish
4. EN caso que nos pida que modulo queremos instalar, podemos ingresar el numeor del modulo deseado o que meta todos (0)

INSTALAR PAYPAL

1. Ejecutar el siguiente comando 
    > composer require paypal/rest-api-sdk-php:*

    1.b Tambien es posible que te funcione este como a mi (Gerard)
    > composer require "paypal/rest-api-sdk-php:*"

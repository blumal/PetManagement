<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-home.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-about.css')}}">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <title>Sobre nosotros</title>
</head>
<body>
    @include('comun.navegacion')
    <div class="row-c flex">
        <div class="column-1">
            <img src="{{asset('img/imagenesWeb/logo.png')}}" class="foto">
        </div>
        <div class="content">
            <h1>Pet Management</h1>
            <br><br>
            <h3>¿Quiénes somos?</h3>
            <p>PetManagement está compuesto por un equipo multidisciplinario de profesionales que trabajan cada día siendo conscientes de que tu mascota es un miembro más de la familia y merece todo nuestro esfuerzo, cariño y dedicación.</p>
            <br>
            <h3>¿Con que finalidad esta creada esta web?</h3>
            <p>Tiene muchas finalidades, pero una de las más importantes es que está pensada para que tengas mucha más facilidad a la hora de pedir una cita para tu mascota como a la hora de cuando vas a tu cita.</p>
            <br>
            <h3>¿Que ofrece nuestra web?</h3>
            <p>Ofrecemos varias cosas como una tienda donde vendemos productos alimentarios o extras para tu mascota como collares, juguetes entre otros productos. También ofrecemos la opción de pedir cita para tu mascota de una forma mucho más eficaz, otra función que ofrecemos a nuestro público es que pueden crear anuncios de sus mascotas si las pierden.</p>

        </div>
    </div>
    <footer>
        <img src="{{asset('img/imagenesWeb/logo.png')}}" alt="" class="logo">
        <div class="social-icons-container">
            <a href="https://www.twitter.com/petmanagement" class="social-icon"></a>
            <a href="https://www.t.me/petmanagement" class="social-icon"></a>
        </div>
        <ul class="footer-menu-container">
            <li class="footer-item">Legal</li>
            <li class="footer-item">Cookies</li>
            <li class="footer-item">Privacy</li>
            <li class="footer-item">Shipping</li>
            <li class="footer-item">Refunds</li>
        </ul>
        <span class="copyright">&copy;2021, Krey Academy. All rights reserved.</span>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-home.css')}}">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <title>Home</title>
</head>
<body>
    @include('comun.navegacion')
    <div>
        <img src="./img/imagenesWeb/home.jpg" class="foto">
    </div>
    </br>
    <center>
        <div class="tittle-home">
            <img src="{{asset('img/pawprint.png')}}" alt="">
        </div>
    </center>
    <div class="row-c flex">
        <div class="content1 column-2">
            <h1>Team</h1>
            </br>
            <p>PetManagement está compuesto por un equipo multidisciplinar de profesionales que trabajan cada día siendo conscientes de que tu mascota es un miembro más de la familia y merece todo nuestro esfuerzo, cariño y dedicación. </p>
            </br>
            <p>L’Hospitalet está compuesto por un equipo multidisciplinar de profesionales que trabajan cada día siendo conscientes de que tu mascota es un miembro más de la familia y merece todo nuestro esfuerzo, cariño y dedicación.</p>
            <center>
                <img src="{{asset('img/brainstorm.png')}}" alt="">
            </center>
        </div>
        <img src="{{asset('img/clinica.jpg')}}" class="content2 column-2" alt="">
    </div>
    <div class="row-c flex">
        <div class="servicesinfo">
            <center>
                <h2>Servicios destacados</h2>
                </br>
                <p>En nuestra clínica podrás encontrar una amplia gama de servicios veterinarios destinados a ofrecer una atención integral a tu animal de compañía en cualquiera de las etapas de su vida.</p>
            </center>
        </div>
    </div>
    <div class="row-c flex">
        <div class="services-box">
            <h3>Servicios Veterinarios</h3>
            </br>
            <p>Ponemos especial énfasis en la prevención de enfermedades y realizamos las pruebas oportunas para obtener diagnósticos precisos y aplicar los tratamientos más adecuados. </p>
            <center>
                <img src="{{asset('img/veterinarian (2).png')}}" alt="">
            </center>
        </div>
        <div class="specialities-box">
            <h3>Especialidades veterinarias</h3>
            </br>
            <p>Abordamos diversas disciplinas de la medicina veterinaria: dermatología, oftalmología, sistema cardiorespiratorio, traumatología, neurología, oncología, y animales exóticos.</p>
            <center>
                <img src="{{asset('img/veterinarian (1).png')}}" alt="">
            </center>
        </div>
        <div class="shopinfo-box">
            <h3>Tienda para mascotas</h3>
            </br>
            <p>Una amplia gama de productos te espera en nuestro centro. Desde la mejor oferta alimenticia. hasta cualquier tipo de accesorio para el aseo, el descanso o el ocio.</p>
            <center>
                <img src="{{asset('img/pet-shop.png')}}" alt="">
            </center>
        </div>
    </div>
    <div class="row-c flex">
        <div class="twitter column-2">
            <h3>Conoce nuestras últimas noticias y actualizaciones desde twitter</h3>
            </br>
            <a class="twitter-timeline" data-lang="en" data-width="550" data-height="500" data-dnt="true" data-theme="dark" href="https://twitter.com/thedeadpol">Tweets by Pet Management</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div class="contenedor_grafico column-2">
            <h3>Hazte una idea de cuantos clientes tenemos por mes, ¿serás tú el próximo?</h3>
            <canvas id="chart_visitasxmeses"></canvas>
        </div>
    </div>
    </br>
    <footer>
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <div class="social-icons-container">
            <a href="https://www.twitter.com/petmanagement" class="social-icon"></a>
            <a href="https://www.t.me/petmanagement" class="social-icon"></a>
        </div>
        <ul class="footer-menu-container">
            <li class="footer-item">Legal</li>
            <li class="footer-item">Cookies</li>
            <li class="footer-item">Privacidad</li>
            <li class="footer-item">Shipping</li>
            <li class="footer-item">Equipo</li>
        </ul>
        <span class="copyright">&copy;2021, Pet Management. Todos los derechos reservados.</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/estadisticas/graficos.js')}}"></script>
</body>
</html>
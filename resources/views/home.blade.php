<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-home.css')}}">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <title>Home</title>
</head>
<body>
    @include('comun.navegacion')
    <div>
        <img src="{{asset('img/imagenesWeb/home.jpg')}}" class="foto">
    </div>
    <div class="row-c flex">
        <div class="column-2">
            <div class="twitter">
                <a class="twitter-timeline" data-lang="en" data-width="850" data-height="700" data-dnt="true" data-theme="dark" href="https://twitter.com/management_pet">Tweets by Pet Management</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>

        <div class="column-2">
            <div class="contenedor_grafico">
                <canvas id="chart_visitasxmeses"></canvas>
            </div>
        </div>
    </div>
    <footer>
        <img src="{{asset('img/imagenesWeb/logo.png')}}" alt="" class="logo">
        <div class="social-icons-container">
            <a href="https://www.twitter.com/management_pet" class="social-icon"></a>
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
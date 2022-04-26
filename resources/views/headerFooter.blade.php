<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-home.css')}}">
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <title>Home</title>
</head>
<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <form action="{{url("home")}}" method="get"><li class="menu-item">Home</li></form>
            <form action="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></form>
            <form action="{{url("clinica")}}" method="get"><li class="menu-item">Clínica</li></form>
            <form action="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></form>
            <form action="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></form>
            <form action="{{url("login")}}" method="get"><li class="cta">Login</li></form>
        </ul>
        <script src="./js/home.js"></script>
    </header>

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
</body>
</html>
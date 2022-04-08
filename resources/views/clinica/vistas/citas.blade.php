<!--Método comprobación de sesión-->
@if (!Session::get('email_session'))
    <?php
        //Si la session no esta definida te redirige al login, la session se crea en el método.
        return redirect()->to('login')->send();
    ?>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Api-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales-all.js"></script>
    <!---->
    <script src="{{asset('js/fullcalendar/calendar.js')}}"></script>
    <!---->
    <link rel="stylesheet" href="{{asset('css/fullcalendar/calendar.css')}}">
    <title>Citas</title>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">

        <!--Menu header-->
        <ul class="main-menu">
            <li class="menu-item">Home</li>
            <li class="menu-item" href="./views/tienda.blade.php">Tienda</li>
            <li class="menu-item">Clínica</li>
            <li class="menu-item">Contacto</li>
            <li class="menu-item">Sobre Nosotros</li>
            <li class="cta"><a href="{{url("citas")}}">LOGIN</a></li>
        </ul>
        <script src="./js/home.js"></script>
    </header>
    <div class="row-c flex">
        <div class="calendarestructure column-1">
            <h1>Citas</h1>
            <div id="calendar"></div>
            <h1>Solicitud de Citas</h1>
            {{-- <form action="{{url('insertcita')}}" method="post"> --}}
            <form onsubmit="insertDatas(); return false;">
                @csrf
                <input type="date" name="fecha_vi" id="fecha_vi">
                <input type="time" name="hora_vi" id="hora_vi" >
                <input type="submit">
            </form>
        </div>
    </div>
    <form action="{{url("/FacturasClinica")}}" method="post">
        @csrf
        <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
        </br></br>
        </br></br>
        <input type="submit" value="Ver mis Visitas Anteriores">
    </form>
    <footer>
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
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
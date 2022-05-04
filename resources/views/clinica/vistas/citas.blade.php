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
            <a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a>
            <a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a>
            <a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a>
            <a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a>
            <a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a>
            <a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a>
            <a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a>
            @if (Session::get('email_session'))
                <a href="{{url("logout")}}" method="get"><li class="cta">Logout</li></form></a>
            @else
                <a href="{{url("login")}}" method="get"><li class="cta">Login</li></form></a>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
   
    {{--Calendario--}}
    <div class="row-c flex">
        <div class="calendarestructure column-1">
            <h1>Calendario de citas</h1>
            <div id="calendar"></div>
            <center>
                <h1>Solicitud de Citas</h1>
                {{-- <form action="{{url('insertcita')}}" method="post"> --}}
                {{-- <form onsubmit="insertDatas(); return false;">
                    @csrf
                    <input type="date" name="fecha_vi" id="fecha_vi">
                    <input type="time" name="hora_vi" id="hora_vi">
                    <input type="submit">
                </form> --}}
                <!-- Trigger/Open The Modal -->
                <button id="btnModal" onclick="modalCitas();">Reservar cita</button>
                <!-- The Modal -->
                <div id="modalCitas" class="modal-citas">
                    <!-- Modal content -->
                    <div class="modal-citas-content">
                        <h3>Solicitud cita</h3>
                        <form onsubmit="insertDatas(); return false;">
                        {{-- <form action="{{url('insertcita')}}" method="post"> --}}
                            @csrf
                            <span class="close">&times;</span>
                            <label for="fecha_vi">Introduzca la fecha de la visita:</label><br/>
                                <input type="date" name="fecha_vi" id="fecha_vi"><br/><br/>
                            <label for="hora_vi">Introduzca la hora de la visita:</label><br/>
                                <input type="time" name="hora_vi" id="hora_vi"><br/><br/>
                            <label for="asunto_vi">Motivo de visita:</label><br/>
                                <input type="text" name="asunto_vi" id="asunto_vi"><br/><br/>
                            <input type="submit" value="Agendar">
                            <input type='hidden' name='id_us' id="id_us" value={{Session::get('id_user_session')}} />
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </div>
     {{--Boton para ver visitas anteriores, solo para clientes--}}
    @if (session()->get('id_rol_session')==2)
        <center>
            <form action="{{url("/FacturasClinica")}}" method="post">
                @csrf
                <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
                <input type="submit" class="previous_visits_button" value="Ver mis Visitas Anteriores">
            </form>
        </center>
    @endif
    {{--Generar facturas a partir de visitas, solo para trabajadores--}}
    @if (session()->get('id_rol_session')==3)
        <center>
            <form action="{{url("/directorioGenerarFactura")}}" method="post">
                @csrf
                <input type="submit" class="previous_visits_button" value="  Rellenar Visita  ">
            </form>
            <form action="{{url("/FacturasClinica")}}" method="post">
                @csrf
                <input type="submit" class="previous_visits_button" value="Ver antiguas visitas">
            </form>
        </center>
    @endif
    <br><br>
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
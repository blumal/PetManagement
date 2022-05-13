<!--Método comprobación de sesión-->
@if (Session::get('id_rol_session')=="")

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
    <!--Librería Alertify-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    <!--JS-->
    <script src="{{asset('js/fullcalendar/calendar.js')}}"></script>
    <!--CSS-->
    <link rel="stylesheet" href="{{asset('css/fullcalendar/calendar.css')}}">
    <title>Citas</title>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            @if (Session::get('cliente_session'))
                <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
                <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
                <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
                {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
                <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
                <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
                <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
                <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
                <form><a href="{{url("modificarPerfil")}}" method="get"><li class="menu-item">Mi Perfil</li>
                    <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                </form>
                <form><a href="{{url("logout")}}" method="get"><li class="cta-logout">Logout</li></a></form>
            @else
                <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
                <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
                <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
                {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
                <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
                <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
                <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
                <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
                <form><a href="{{url("login")}}" method="get"><li class="cta">Login</li></a></form>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
   
    {{--Calendario--}}
    <div class="row-c flex">
        <div class="slider">
           <ul>
               <li><img src="{{url("img/visitas/slider1.jpeg")}}" alt=""></li>
               <li><img src="{{url("img/visitas/slider2.jpeg")}}" alt=""></li>
               <li><img src="{{url("img/visitas/slider1.jpeg")}}" alt=""></li>
               <li><img src="{{url("img/visitas/slider2.jpeg")}}" alt=""></li>
           </ul>
        </div>
    </div>
    <div class="row-c flex">
        <center>
            <div class="tittlecalendar column-1">
                <h1>Calendario de citas</h1>
            </div>
        </center>
    </div>
    <div class="row-c flex">
        <div class="calendarestructure column-1">
            <center>
                <div id="calendar"></div>
                <h1>Solicitud de Citas</h1>
                <!-- Trigger/Open The Modal -->
                <button id="btnModal" onclick="modalCitas();">Reservar cita</button>
                <!-- The Modal -->
                    <div id="modalCitas" class="modal-citas">
                        <!-- Modal content -->
                        <div class="modal-citas-content">
                            <span class="close">&times;</span>
                            <h3>Solicitud cita</h3><br/>
                            <div class="modal-citas-content-form">
                                {{-- <form action="{{url('insertcita')}}" method="get"> --}}
                                <form onsubmit="insertDatas(); return false;">
                                    @csrf
                                    <label for="fecha_vi">Introduzca la fecha de la visita: *</label><br/><br/>
                                        <input type="date" name="fecha_vi" id="fecha_vi" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> onchange="hourOptions(); return false;"><br/><br/>
                                    {{-- <label for="hora_vi">Introduzca la hora de la visita:</label><br/>
                                        <input type="time" name="hora_vi" id="hora_vi"><br/><br/> --}}
                                    <label for="hora_vi">Seleccione la hora de la visita: *</label><br/><br/>
                                    <select name="hora_vi" id="hora_vi">
                                        <option value="">--Horas disponibles--</option>
                                    </select><br/><br/>
                                    <label for="an_asociado">Pacientes asociados a ústed:</label><br/><br/>
                                    <select name="an_asociado" id="an_asociado">
                                        <option value="">--Seleccione la mascota--</option>
                                        <!--Recogemos datos de la variable de sesión-->
                                        @if (Session::get('id_rol_session')==2)
                                            @foreach (Session::get('animales_asociados') as $results)
                                            <option value="{{$results->id_pa}}">{{$results->nombre_pa}} - {{$results->raza_pa}}</option> 
                                            @endforeach
                                        @else
                                            
                                        @endif

                                    </select><br/><br/>
                                    <label for="asunto_vi">Motivo de visita: *</label><br/><br/>
                                        <textarea name="asunto_vi" id="asunto_vi" cols="" rows="5" placeholder="Breve descripción del motivo de la visita, síntomas, observaciones, etc..."></textarea><br/><br/>
                                        {{-- <input type="text" name="asunto_vi" id="asunto_vi"><br/><br/> --}}
                                        <input type="submit" value="Agendar">  
                                    <!--Enviamos el valor de la session obtenida-->
                                    <input type='hidden' name='id_us' id="id_us" value={{Session::get('id_user_session')}} />
                                    <input type='hidden' name='email_us' id="email_us" value={{Session::get('email_session')}} />
                                </form>
                            </div>
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
            <form action="{{url("/adminPacientes")}}" method="get">
                @csrf
                <input type="submit" class="previous_visits_button" value="Administrar Pacientes">
            </form>

            <form action="{{url("/directorioGenerarFactura")}}" method="post">
                @csrf
                <input type="submit" class="previous_visits_button" value="   Rellenar Visita   ">
            </form>

            <form action="{{url("/FacturasClinica")}}" method="get">
                @csrf
                <input type="submit" class="previous_visits_button" value="Ver  antiguas visitas">
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
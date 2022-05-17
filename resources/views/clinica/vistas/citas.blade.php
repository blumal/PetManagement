<!--Método comprobación de sesión-->
@if (!Session::get('id_user_session'))
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
    <nav id="nav">
        <div class="nav_container">
            <img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo">
            <label for="menu" class="nav_label">
                <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
            </label>
            <input type="checkbox" id="menu" class="nav_input">
            <!--Menu header-->
            <div class="nav_menu">
                <a href="{{url("/")}}" class="nav_item">Home</a>
                <a href="{{url("tienda")}}" class="nav_item">Tienda</a>
                <a href="{{url("citas")}}" class="nav_item">Clínica</a>
                <a href="{{url("contacto")}}" class="nav_item">Contacto</a>
                <a href="{{url("about")}}" class="nav_item">Sobre Nosotros</a>
                <a href="{{url("mapa_animales_perdidos")}}" class="nav_item">Perdidos</a>
                <a href="{{url("mapa_establecimientos")}}" class="nav_item">Establecimientos</a>
                @if (!Session::get('email_session'))
                    <form class="nav_item">
                        <a href="{{url("modificarPerfil")}}" class="nav_ite">Mi Perfil</a>
                        <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                    </form>
                    <a href="{{url("logout")}}" class="login_item">Logout</a>
                @else
                    <a href="{{url("login")}}" class="login_item">Login</a>
                @endif
            </div>
        </div>
        <script src="./js/home.js"></script>
    </nav>
    <div class="row-c flex">
        <div class="slider">
           <ul>
               <li><img src="{{url("img/visitas/slider1.jpg")}}" alt=""></li>
               <li><img src="{{url("img/visitas/slider2.jpg")}}" alt=""></li>
               <li><img src="{{url("img/visitas/slider3.jpg")}}" alt=""></li>
               <li><img src="{{url("img/visitas/slider4.jpg")}}" alt=""></li>
           </ul>
        </div>
    </div>
    <div class="row-c">
        <div class="info-citas column-2">
            <h1>¿Qué son las citas?</h1>
            <p>Nuestro apartado de citas consiste en mostrar la disponibilidad de la clínica</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa corporis quos a, sit quisquam quia similique, dolore ullam atque, delectus neque. Natus placeat perspiciatis magni autem? Quasi a nisi similique!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad voluptatum tenetur recusandae accusantium ipsam nam in cumque mollitia odio nemo dolor illum repellendus quaerat, nihil nostrum magnam! Repudiandae, aut repellendus?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae harum vero dolorem deserunt doloribus nam debitis perferendis. Similique iste deleniti sapiente repellat excepturi accusamus unde, odit modi dolore illum aut?
            </p>
        </div>
        <div class="info-citas column-2">
            <h1>¿Cómo funcionan?</h1>
            <p>Nuestro apartado de citas consiste en mostrar la disponibilidad de la clínica</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa corporis quos a, sit quisquam quia similique, dolore ullam atque, delectus neque. Natus placeat perspiciatis magni autem? Quasi a nisi similique!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad voluptatum tenetur recusandae accusantium ipsam nam in cumque mollitia odio nemo dolor illum repellendus quaerat, nihil nostrum magnam! Repudiandae, aut repellendus?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae harum vero dolorem deserunt doloribus nam debitis perferendis. Similique iste deleniti sapiente repellat excepturi accusamus unde, odit modi dolore illum aut?
            </p>
        </div>
    </div>
    {{-- <div class="row-c flex">
        <center>
            <div class="tittlecalendar column-1">
                <h1>Calendario de citas</h1>
            </div>
        </center>
    </div> --}}
    <div class="row-c flex">
        <div class="calendarestructure column-1">
            <center>
                <h1>CALENDARIO DE CITAS</h1>
                <div id="calendar"></div>
                <!--Solicitud de citas-->
                <!-- Trigger/Open The Modal -->
                <button class="previous_visits_button" id="btnModal" onclick="modalCitas();">Reservar cita</button>
                <!-- The Modal -->
                    <div id="modalCitas" class="modal-citas">
                        <!-- Modal content -->
                        <div class="modal-citas-content">
                            <span class="close">&times;</span>
                            <h3>Solicitud próxima visita</h3><br/>
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
                    {{--Boton para ver visitas anteriores, solo para clientes--}}
                    @if (session()->get('id_rol_session')==2)
                        <center>
                            <form action="{{url("/FacturasClinica")}}" method="post">
                                @csrf
                                <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
                                <input type="submit" class="previous_visits_button" value="Consultar mis visitas anteriores">
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
            </center>
        </div>
    </div>
     {{--Boton para ver visitas anteriores, solo para clientes--}}
    {{-- @if (session()->get('id_rol_session')==2)
        <center>
            <form action="{{url("/FacturasClinica")}}" method="post">
                @csrf
                <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
                <input type="submit" class="previous_visits_button" value="Ver mis Visitas Anteriores">
            </form>
        </center>
    @endif --}}
    {{--Generar facturas a partir de visitas, solo para trabajadores--}}
    {{-- @if (session()->get('id_rol_session')==3)
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
    @endif --}}
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
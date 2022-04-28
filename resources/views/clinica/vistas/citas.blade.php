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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <h3>Solicitud cita</h3><br/>
                        <div class="modal-citas-content-form">
                            <form onsubmit="insertDatas(); return false;">
                            {{-- <form action="{{url('insertcita')}}" method="post"> --}}
                                @csrf
                                <span class="close">&times;</span>
                                <label for="fecha_vi">Introduzca la fecha de la visita:</label><br/>
                                    <input type="date" name="fecha_vi" id="fecha_vi"><br/><br/>
                                {{-- <label for="hora_vi">Introduzca la hora de la visita:</label><br/>
                                    <input type="time" name="hora_vi" id="hora_vi"><br/><br/> --}}
                                <label for="hora_vi">Seleccione la hora de la visita: </label><br/><br/>
                                <select name="hora" id="hora_vi">
                                    <option value="">--Horas disponibles--</option>
                                    <option value="00:00">00:00</option>
                                    <option value="01:00">01:00</option>
                                    <option value="02:00">02:00</option> 
                                    <option value="03:00">03:00</option>
                                    <option value="04:00">04:00</option>
                                    <option value="05:00">05:00</option>
                                    <option value="06:00">06:00</option>
                                    <option value="07:00">07:00</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option> 
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option> 
                                    <option value="21:00">21:00</option>
                                    <option value="22:00">22:00</option>
                                    <option value="23:00">23:00</option>
                                </select><br/><br/>
                                <label for="animales_p">Pacientes asociados a ústed:</label><br/><br/>
                                    <select name="pets" id="pet_select">
                                        <option value="">--Seleccione la mascota--</option>
                                        <!--Recogemos datos de la variable de sesión-->
                                        @foreach (Session::get('animales_asociados') as $results)
                                            <option value="{{$results->id_pa}}">{{$results->nombre_pa}} - {{$results->raza_pa}}</option> 
                                        @endforeach
                                    </select><br/><br/>
                                <label for="asunto_vi">Motivo de visita:</label><br/><br/>
                                    <textarea name="asunto_vi" id="asunto_vi" cols="" rows="5"></textarea><br/><br/>
                                    {{-- <input type="text" name="asunto_vi" id="asunto_vi"><br/><br/> --}}
                                    <input type="submit" value="Agendar">  
                                <!--Enviamos el valor de la session obtenida-->
                                <input type='hidden' name='id_us' id="id_us" value={{Session::get('id_user_session')}} />
                            </form>
                    </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <form action="{{url("/FacturasClinica")}}" method="post">
        @csrf
        <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
        </br></br>
        </br></br>
        <input type="submit" value="Ver mis Visitas Anteriores">
    </form>
    <form action="{{url("/generarFactura")}}" method="post">
        @csrf
        <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
        <input type="number" name="id_visita">
        </br></br>
        </br></br>
        <input type="submit" value="Rellenar Visita">
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
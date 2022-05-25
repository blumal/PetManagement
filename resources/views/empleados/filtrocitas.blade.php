@if (!Session::get('id_rol_session') == 3)
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
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Librería Sweet Alert-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script> --}}
    <!--Librería Alertify-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    <!--JS-->
    <script src="{{asset('js/gestioncitas/gestioncitas.js')}}"></script>
    <!--CSS--> 
    <link rel="stylesheet" href="{{asset('css/empleados/gestioncitas.css')}}">
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <!--TOKEN-->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>Gestión de citas</title>
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
                <a href="{{url("/calendaremp")}}" class="nav_item">Calendario</a>
                <a href="#{{-- {{url("tienda")}} --}}" class="nav_item">Gestión de citas</a>
                <a href="#{{-- {{url("citas")}} --}}" class="nav_item">Administración de pacientes</a>
                <a href="#{{-- {{url("contacto")}} --}}" class="nav_item">Administración de visitas</a>
                <a href="#{{-- {{url("contacto")}} --}}" class="nav_item">Animales perdidos</a>
                <a href="#{{-- {{url("contacto")}} --}}" class="nav_item">Mi perfil</a>
                <a href="{{url("logout")}}" class="login_item">Logout</a>
            </div>
        </div>
        <script src="./js/home.js"></script>
    </nav>
    <center>
        <div class="row-c flex">
            <div class="container p-5">
                <h1>Visitas agendadas</h1>
                <div class="form-group pt-3">
                    <input type="number" class="form-control" id="id_vi" placeholder="nº de cita" onkeyup="idFilters(); return false;">
                </div>
                <div class="form-group pt-3">
                    <input type="text" class="form-control" id="dni_us" placeholder="DNI del cliente" onkeyup="idFilters(); return false;">
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-hover" id="table-g"></table>
                </div>
            </div>
        </div>
    </center>
</body>
</html>

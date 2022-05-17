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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--Style--> 
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
                <a href="#{{-- {{url("/")}} --}}" class="nav_item">Calendario</a>
                <a href="#{{-- {{url("tienda")}} --}}" class="nav_item">Gestión de citas</a>
                <a href="#{{-- {{url("citas")}} --}}" class="nav_item">Administración de pacientes</a>
                <a href="#{{-- {{url("contacto")}} --}}" class="nav_item">Administración de visitas</a>
                <a href="{{url("logout")}}" class="login_item">Logout</a>
            </div>
        </div>
        <script src="./js/home.js"></script>
    </nav>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <center>
        <div class="table-responsive"></div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID de visita</th>
                        <th>DNI de cliente</th>
                        <th>Fecha de cita</th>
                        <th>Hora de cita</th>
                        <th>Cliente</th>
                        <th>Paciente</th>
                        <th>Motivo de la visita</th>
                        <th>Estado de la visita</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                    @foreach ($quotes as $results)
                        <tr>
                            <td>{{$results->id_vi}}</td>
                            <td>{{$results->dni_us}}</td>
                            <td>{{$results->fecha_vi}}</td>
                            <td>{{$results->hora_vi}}</td>
                            <td>{{$results->nombre_us}}</td>
                            <td>{{$results->nombre_pa}}</td>
                            <td>{{$results->asunto_vi}}</td>
                            <td>{{$results->estado_est}}</td>
                            <td><input type="submit" value="Modificar"><input type="submit" value="Eliminar"></td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </center>
</body>
</html>

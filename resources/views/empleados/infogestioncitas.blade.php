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
    <!--Librería Alertify-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>    
    <!--JS-->
    <script src="{{asset('js/empleados/editcita.js')}}"></script>
    <!--TOKEN-->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>Información de la cita</title>
</head>
<body>
    <center>
        <h1>Datos de la cita</h1>
    </center>
    <div class="container p-5">
        @foreach ($quotedatas as $item)
            <h3>Datos del cliente</h3>
                <p>Visita nº: {{$item->id_vi}}</p>
                <p>Fecha de la visita: {{$item->fecha_vi}}</p>
                <p>Hora agendada: {{$item->hora_vi}}h</p>
                <p>Estado de la visita: {{$item->estado_est}}</p>
                <p>Nombre del cliente: {{$item->nombre_us}} {{$item->apellido1_us}} {{$item->apellido2_us}}</p>
                <p>Contacto del cliente: {{$item->contacto1_tel}}-{{$item->contacto2_tel}}</p>
                <h3>Datos del paciente</h3>
            @if ($item->nombre_pa != '')
                <p>Nombre: {{$item->nombre_pa}} </p>
                <p>Raza: {{$item->raza_pa}}</p>
                <p>Peso: {{$item->peso_pa}}Kg</p>
            @endif
            <p>Motivo de la visita: {{$item->asunto_vi}}</p>
        @endforeach
        <form method="post" onsubmit="preChange({{$item->id_vi}}); return false;">
            @csrf
            <div class="form-group pt-3">
                <input class="btn btn-success" type="submit" value="Iniciar cita">
            </div>
        </form>
        <form action="{{url('/homeempleado')}}" method="get">
            @csrf
            <div class="form-group pt-3">
                <input class="btn btn-dark" type="submit" value="Back">
            </div>
        </form>
    </div>
</body>
</html>
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
    <title>Animales Perdidos</title>
    <link rel="stylesheet" href="css/styleadminmapaestbl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="head_admin">
        {{-- Boton para volver a la vista del panel de control --}}
    <div class="back">
        <div><a class="btn btn-info" href="">Back</a></div>
    </div>
        @if($errors->any())
        <div>
            <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="ttl">
            <h1><b>Animales Perdidos</b></h1>
        </div>
        
        <div class="log_out">
            <form action="{{url('/logout')}}" method="GET">
                <button type="submit" value="logout" class="btn btn-danger logout">LOGOUT</button><br><br>
            </form>
        </div>
    </div>
    <p id="mensaje"></p>
    <div class="an_div">
        <form id="form_an_perd" onsubmit="crear(); return false;" enctype="multipart/form-data">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <input type="text" name="descrip" id="descrip" placeholder="Descripcion/info"><br><br>
            <span>Día de la desaparición</span>
            <input type="date" name="dia_desa" id="dia_desa" placeholder="Dia desaparición">
            <span>Hora de la desaparición</span>
            <input type="time" name="horario_desa" id="horario_desa" placeholder="Horario desaparición"><br><br>
            <input type="text" name="direccion" id="direccion" placeholder="Calle que se perdió">
            <input type="number" name="num" id="num" placeholder="N Calle">
            <input type="number" name="cp" id="cp" placeholder="CP"><br><br>
            <span>Foto</span>
            <input type="file" name="foto" id="foto">
            <input type="hidden" name="id_user" id="id_user" value="<?php echo session('id_user_session');?>">
            <input type="hidden" name="estado" id="estado" value="1"><br><br>
            <input type="submit" class="btn btn-success" value="Crear">
        </form>
    </div>
    <div class="ver_an">
        <form action="{{url('mapa_animales_perdidos')}}" method="GET">
            <button class="btn btn-outline-info" type="submit">Ver Mapa animales perdidos</button>
        </form>
    </div>
    <script src="js/crear_animales_perdidos.js"></script>
</body>
</html>
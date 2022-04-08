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
    <title>Animales Perdidos</title>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <form action="{{url('/logout')}}" method="GET">
        <button type="submit" value="logout">LOGOUT</button><br><br>
    </form>
    <p id="mensaje"></p>
    <form id="form_an_perd" onsubmit="crear(); return false;" enctype="multipart/form-data">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre">
        <input type="text" name="descrip" id="descrip" placeholder="Descripcion/info">
        <span>Día de la desaparición</span>
        <input type="date" name="dia_desa" id="dia_desa" placeholder="Dia desaparición">
        <span>Hora de la desaparición</span>
        <input type="time" name="horario_desa" id="horario_desa" placeholder="Horario desaparición">
        <input type="text" name="direccion" id="direccion" placeholder="Calle que se perdió">
        <input type="number" name="num" id="num" placeholder="N Calle">
        <input type="number" name="cp" id="cp" placeholder="CP">
        <span>Foto</span>
        <input type="file" name="foto" id="foto">
        <input type="hidden" name="id_user" id="id_user" value="<?php echo session('id_user_session');?>">
        <input type="hidden" name="estado" id="estado" value="1">
        <input type="submit" value="Crear">
    </form>
    <form action="{{url('mapa_animales_perdidos')}}" method="GET">
        <button type="submit">Ver Mapa animales perdidos</button><br><br>
    </form>
    <script src="js/crear_animales_perdidos.js"></script>
</body>
</html>
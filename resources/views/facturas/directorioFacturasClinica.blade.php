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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/facturas/directorio.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Historial Facturas Clinica</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>
<body>
    <header id="Header">
        <div class="logo">
            <a href="{{url("/")}}"><img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo"></a>
        </div>
        <div class="logout">
            <a href="{{url("logout")}}"><img class="logout" src="./img/imagenesWeb/logout.png" width="50px" height="50px"></a>
        </div>
    </header>
    
    <div class="row-c">
        @for ($i = 0; $i < count($facturas); $i++)
            <div class="column-3">
                <div class="seccion">
                    <form action="FacturaClinica/view" method="post">
                        @csrf
                        Factura {{$facturas[$i]->fecha_fc}}
                        <br>
                        Hora -> {{$facturas[$i]->hora_fc}}
                        <br>
                        Total -> {{$facturas[$i]->total_fc}}€
                        <br>
                        Veterinario -> {{$facturas[$i]->nombre_us}} {{$facturas[$i]->apellido1_us}}
                        <br>
                        <input type="hidden" name="id_factura_clinica" value="<?php echo $facturas[$i]->id_fc?>">
                        <input class="ver_factura" type="submit" value="Ver factura">
                    </form>     
                </div>
            </div>
        @endfor
    </div>
</body>
</html>
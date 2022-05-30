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
        <link rel="stylesheet" href="{{asset('css/facturas/directorio.css')}}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
        <title>Historial Facturas Tienda</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    </head>
<body>

    @include('comun.navegacion')
    <div id="cuerpo">
        <div class="row-c">
            @for ($i = 0; $i < count($facturas); $i++)
                <div class="column-3">
                    <div class="seccion">
                        <form action="FacturaTienda/view" method="post">
                            @csrf
                            Factura {{$facturas[$i]->fecha_ft}}
                            <br>
                            Hora -> {{$facturas[$i]->hora_ft}}
                            <br>
                            Total -> {{$facturas[$i]->total_ft}}€
                            <br>
                            <input type="hidden" name="id_factura_tienda" value="<?php echo $facturas[$i]->id_ft?>">
                            <input class="ver_factura" type="submit" value="Ver factura">
                        </form>
                    </div>

                </div>
            @endfor
        </div>
    </div>
</body>
</html>
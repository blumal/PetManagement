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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/facturas/directorio.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Historial Facturas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>
<body>
    <header id="Header">
        <div class="logo">
            <img src="./img/imagenesWeb/logo.png">
        </div>
        <div class="logout">
            <img onclick="location.href = '/logout'" class="logout" src="./img/imagenesWeb/logout.png" width="50px" height="50px">
        </div>
    </header>
    <div class="row-c">
    @for ($i = 0; $i < count($facturas); $i++)
        <div class="column-3">
            <div class="seccion">
                <form action="FacturaClinica/view" method="post">
                    @csrf
                    Factura <?php echo $facturas[$i]->fecha_fc?>
                    <br>
                    
                    <input type="hidden" name="id_factura_clinica" value="<?php echo $facturas[$i]->id_fc?>">
                    <input class="ver_factura" type="submit" value="Ver factura">
                </form>
            <br>
            </div>
        </div>
    @endfor
    </div>

    
        <!--
                <img class="sala" src="./img/imagenesWeb/usuario.png" width="200px" height="200px"><br>
                Usuarios
            </div>
        </div>
        <div class="column-3">
            <div class="seccion">
                <img class="sala" src="./img/imagenesWeb/carrito-de-compras.png" width="200px" height="200px"><br>
                Productos tienda
            </div>
        </div>
        <div class="column-3">
            <div class="seccion">
                <img class="sala" src="./img/imagenesWeb/pata.png" width="200px" height="200px"><br>
                Animales
            </div>
        </div>
        <div class="column-2">
            <div class="seccion">
                <img class="sala" src="./img/imagenesWeb/buscar.png" width="200px" height="200px"><br>
                Mascotas perdidas
            </div>
        </div>
        <div class="column-2">
            <div class="seccion">
                <img class="sala" src="./img/imagenesWeb/veterinario.png" width="200px" height="200px"><br>
                Establecimientos
            </div>
        </div>
    </div>
-->
</body>
</html>

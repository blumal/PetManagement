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
    <title>Buscador de Visitas</title>
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
        <div class="column-3">
            <div class="input">
                <form onchange="leerVisitas(); return false;" method="post">
                    <input type="date" name="fecha_visita" id="fecha_visita">
                </form>
            </div>
        </div>
    </div>
    <div class="row-c" id="div_visitas">
    </div>
</body>
<script src="./js/visita/ajax_ru_visitas_directorio.js"></script>
</html>
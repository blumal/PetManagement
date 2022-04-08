<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/secciones.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <header id="Header">
        <div class="logo">
            <img src="./img/imagenesWeb/logo.png">
        </div>
        <div class="logout">
            <img class="logout" src="./img/imagenesWeb/logout.png" width="50px" height="50px">
        </div>
    </header>
    
        {{-- <div class="inicio">
            <div>
                <?php
                    /* session_start();
                    if(!empty($_SESSION['nom_user'])){
                        echo "Hola ".$_SESSION['nom_user'];
                        $nom=$_SESSION['nom_user'];
                    } */
                ?>
            </div>
        </div> --}}
    <div class="row-c">
        <div class="column-3">
            <div class="seccion">
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
</body>
</html>
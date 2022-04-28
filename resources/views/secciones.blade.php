<?php
ob_start();
?>
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
    <link rel="stylesheet" href="{{asset('css/secciones.css')}}">
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <header id="Header">
        <div class="logo">
            <img src="./img/imagenesWeb/logo.png">
        </div>
        <h2>PANEL DEL ADMINISTRADOR</h2>
        <form action="{{url('/logout')}}" method="GET" class="logout">
                <a><button><img class="imglogout" src="./img/imagenesWeb/logout.png" width="50px" height="50px"></button></a>
        </form>
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
        <div class="secciones">
            <div class="column-3">
                <div class="seccion">
                    <form {{-- action="{{url('/cpanelUsrs')}}" --}} method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit" ><img class="sala" src="./img/imagenesWeb/usuario.png" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Usuarios
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/cpanelTienda')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit" ><img class="sala" src="./img/imagenesWeb/carrito-de-compras.png" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Productos tienda
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form {{-- action="{{url('/cpanelAnimales')}}" --}} method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit" ><img class="sala" src="./img/imagenesWeb/pata.png" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Animales
                </div>
            </div>
            <div class="column-2">
                <div class="seccion">
                    <form {{-- action="{{url('/cpanelAnimalesPerdidos')}}" --}} method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit" ><img class="sala" src="./img/imagenesWeb/buscar.png" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Mascotas perdidas
                </div>
            </div>
            <div class="column-2">
                <div class="seccion">
                    <form action="{{url('/cpanelMapa')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit" ><img class="sala" src="./img/imagenesWeb/veterinario.png" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Establecimientos
                </div>
            </div>
        </div>    
    </div>
</body>
</html>
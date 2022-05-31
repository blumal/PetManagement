<?php
ob_start();
?>
<!--Método comprobación de sesión-->
@if (!Session::get('admin_session'))
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
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <title>cPanel</title>
</head>
<body>
    <nav id="nav">
        <div class="nav_container">
            <img src="{{url('/img/visitas/Logo.png')}}" alt="" class="nav_logo">
            <h2>PANEL DEL ADMINISTRADOR</h2>
            <label for="menu" class="nav_label">
                <img src="{{url('/img/visitas/menu (4).png')}}" alt="" class="nav_img">
            </label>
            <input type="checkbox" id="menu" class="nav_input">
            <!--Menu header-->
            <div class="nav_menu">
                <a href="{{url('/logout')}}" class="login_item">Logout</a>
            </div>
        </div>
    <script src="{{asset('js/home.js')}}"></script>
    </nav>
    
    <div class="row-c">
        <div class="secciones">
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/adminUsuarios')}}"method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit"><img class="sala" src="./img/imagenesWeb/usuario.png" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Usuarios
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/admincrud')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit"><img class="sala" src="{{asset('img/imagenesWeb/carrito-de-compras.png')}}" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Productos tienda
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/adminPacientes')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit"><img class="sala" src="{{asset('img/imagenesWeb/pata.png')}}" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Animales
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/cpanelAnimalesPerdidos')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit"><img class="sala" src="{{asset('img/imagenesWeb/buscar.png')}}" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Mascotas perdidas
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/cpanelMapa')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit"><img class="sala" src="{{asset('img/imagenesWeb/veterinario.png')}}" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Establecimientos
                </div>
            </div>
            <div class="column-3">
                <div class="seccion">
                    <form action="{{url('/stats')}}" method="GET">
                        <input type="hidden" name="_method" value="POST" id="postFiltro">
                        <div class="form-outline">
                            <button type="submit"><img class="sala" src="{{asset('img/imagenesWeb/analisis.png')}}" width="200px" height="200px"></button><br><br>
                        </div>
                    </form>
                    Gráficos / Estadisticas
                </div>
            </div>
        </div>    
    </div>

</body>
</html>
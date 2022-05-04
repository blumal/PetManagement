<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style-contacto.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LOGIN</title>
    <link rel="icon" href="./img/imagenesWeb/logo.png">

    <title>Login</title>
</head>

<body>
    <header id="Header" style="background-color: transparent;">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public" method="get"><li class="menu-item">Home</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/tienda" method="get"><li class="menu-item">Tienda</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/citas" method="get"><li class="menu-item">Clínica</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/contacto" method="get"><li class="menu-item">Contacto</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/about" method="get"><li class="menu-item">Sobre Nosotros</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/mapa_animales_perdidos" method="get"><li class="menu-item">Perdidos</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/mapa_establecimientos" method="get"><li class="menu-item">Establecimientos</li></a>
            @if (Session::get('email_session'))
                <a href="{{url("logout")}}" method="get"><li class="cta">Logout</li></form></a>
            @else
                <a href="{{url("login")}}" method="get"><li class="cta">Login</li></form></a>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
    <div class="row-c flex">
        <div class="column-2">
            
                <div class="row-c flex justify-content-center pt-8 mt-5 m-2">
                    <div class="col-md-6 col-sm-8 col-xl-10 col-lg-5 formulario" style="margin-top: 9%;">
                        <form action="" method="post">
                            <input type="hidden" name="_token" value="1LNjq4DrhkFR5EQO4YO2OEnfA0l7dQydHoO5tDjx">                            <div class="form-group text-center pt-3">
                                <h1 class="text-light">Consultanos cualquier duda que tengas!</h1>
                            </div>
                            <div class="form-group mx-sm-4 pb-2">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                            </div>
                            <div class="form-group mx-sm-4 pb-2">
                                <input type="password" class="form-control" placeholder="Apellido" name="Apellido">
                            </div>
                            <div class="form-group mx-sm-4 pb-2">
                                <input type="password" class="form-control" placeholder="Correo" name="Correo">
                            </div>
                            <div class="form-group mx-sm-4 pb-2">
                                <textarea class="form-control" placeholder="Mensaje" name="Mensaje" id="Mensaje" cols="30" rows="5.5"></textarea>
                            </div>
                            <div class="form-group mx-sm-4 pb-4">
                                <input type="submit" class="btn btn-block ingresar" value="ENVIAR">
                            </div>
                        </form>
                    </div>
                </div>
            
        </div>
        <div class="column-2">
            <div class="container">
                <div class="row-c flex justify-content-center pt-8 mt-5 m-2">
                    <div class="col-md-6 col-sm-8 col-xl-10 col-lg-5 formulario" style="margin-top: 9%; padding-right: 75px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2359.633997111862!2d2.109928312080577!3d41.34998745902146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a498d64bd023fd%3A0x26089fc39cb352a3!2sCentro%20de%20Estudios%20Joan%20XXIII!5e0!3m2!1ses!2ses!4v1651241294826!5m2!1ses!2ses" width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="form-group sm-5" style="margin-right: 33px;">
                            <h3 class="text-light">Telf: +34 612345678</h3>
                            <h3 class="text-light">mailcontact@aservices.com</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>


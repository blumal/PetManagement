<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/contacto/style-contacto.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--Librería Alertify-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    <script src="{{asset('js/valid_contacto.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/style-contacto.css')}}">  
    <title>Contacto</title>
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>

<body>
    @include('comun.navegacion')
    <div>
        <img src="{{asset('img/fotosAnimal/fondo-contacto3.jpg')}}" class="foto">
    </div>
    <div class="explicacion">
        <h2>Contacta con el servicio de Pet Management</h2>
        <p>¿Tienes alguna duda o consulta relacionada con la salud o los cuidados de tu mascota?
            Si es así ponte en contacto con nosotros.
            Donde un especialista, se encargará de atenderte y asesorarte en todo lo que pueda.
            Estaremos encantados de poder ayudarte.</p>
    </div>
    <div class="row-c flex" style="margin-top: 5%;">
        <div class="column-4">
            <div class="cuadro">
                <img src="{{asset('img/contacto/ubicacion.gif')}}" alt="">
                <h4>Dirección</h4>
                <p class="cuerpo" style="margin-top: 5%;">Av. Mare de Déu de Bellvitge, 100, 110, 08907 L'Hospitalet de Llobregat, Barcelona</p>
            </div>
        </div>
        <div class="column-4">
            <div class="cuadro">
                <img src="{{asset('img/contacto/reloj.gif')}}" alt="">
                <h4>Horarios</h4>
                <p class="titulo" style="margin-top: 5%;">Consultas/Dudas</p>
                <p class="cuerpo">Lunes a sábado 9h a 20:30h</p>
                <p class="titulo">Reservar cita</p>
                <p class="cuerpo">Reserva tu cita a cualquier hora a través de nuestra web</p>
            </div>
        </div>
        <div class="column-4">
            <div class="cuadro">
                <img src="{{asset('img/contacto/llamada-de-emergencia.gif')}}" alt="">
                <h4>Teléfonos</h4>
                <p class="titulo" style="margin-top: 5%;">Teléfono</p>
                <p class="cuerpo">93 483 74 58</p>
                <p class="titulo">WhatsApp</p>
                <p class="cuerpo">612 345 678</p>
            </div>
        </div>
        <div class="column-4">
            <div class="cuadro">
                <img src="{{asset('img/contacto/mensaje.gif')}}" alt="">
                <h4>Email</h4>
                <p class="cuerpo" style="margin-top: 12%;">grouppetmanagement@gmail.com</p>
            </div>
        </div>
    </div>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2359.633997111862!2d2.109928312080577!3d41.34998745902146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a498d64bd023fd%3A0x26089fc39cb352a3!2sCentro%20de%20Estudios%20Joan%20XXIII!5e0!3m2!1ses!2ses!4v1651241294826!5m2!1ses!2ses" width="100%" height="350" style="border:0;margin-top: 5%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <div class="row-c flex">
        <div class="column-2">
            <div class="row-c flex formulario-1">
                <div class="col-md-8 col-sm-4 col-lg-12 formulario">
                    <form action="{{url('/enviarCorreoContacto')}}" method="post" onsubmit="return validateContacto();">
                        @csrf
                        <div class="form-group text-center pt-3">
                            <h1>Consultanos cualquier duda que tengas!</h1>
                        </div>
                        <div class="form-group mx-sm-4 pb-2">
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="Nombre">
                        </div>
                        <div class="form-group mx-sm-4 pb-2">
                            <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="Apellido">
                        </div>
                        <div class="form-group mx-sm-4 pb-2">
                            <input type="email" class="form-control" id="correo" placeholder="Correo" name="Correo">
                        </div>
                        <div class="form-group mx-sm-4 pb-2">
                            <textarea class="form-control" placeholder="Mensaje" name="Mensaje" id="mensaje" cols="30" rows="5.5"></textarea>
                        </div>
                        <div class="form-group mx-sm-4 pb-4">
                            <input id="submitContacto" type="submit" class="btn btn-block ingresar" value="ENVIAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <img src="{{asset('img/imagenesWeb/logo.png')}}" alt="" class="logo">
        <div class="social-icons-container">
            <a href="https://www.twitter.com/petmanagement" class="social-icon"></a>
            <a href="https://www.t.me/petmanagement" class="social-icon"></a>
        </div>
        <ul class="footer-menu-container">
            <li class="footer-item">Legal</li>
            <li class="footer-item">Cookies</li>
            <li class="footer-item">Privacidad</li>
            <li class="footer-item">Shipping</li>
            <li class="footer-item">Equipo</li>
        </ul>
        <span class="copyright">&copy;2021, Pet Management. Todos los derechos reservados.</span>
    </footer>

</body>

</html>


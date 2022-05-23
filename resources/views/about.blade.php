<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-home.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-about.css')}}">
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <title>About Us</title>
</head>
<body>
    @include('comun.navegacion')
    <div class="column-1">
        <img src="./img/imagenesWeb/logo.png" class="foto">
    </div>
    <div class="content">
        <h1>Pet Management</h1>
        <br>
        <p>
            Clínica Veterinaria Animal Services nace con la idea de crear una Clínica Veterinaria que se diferencie del resto por la calidad de servicio, responsabilidad y compromiso que tu engreído merece.
            
            Consideramos a las mascotas como un miembro más de la familia y estamos conscientes de lo que eso representa. Es por esto que nos caracterizamos por poseer una línea ética definida y compartida por todo nuestro equipo.
            
            Clínica Veterinaria ROKA es sinónimo de responsabilidad, dedicación y entrega.</p>
        <br>
        <p>Prestamos servicios veterinarios de medicina, cirugía, asesoramientos técnicos y proyectos veterinarios en nuestras modernas y completas instalaciones como Hospital Veterinario. Contamos con servicio de Urgencias Veterinarias las 24h.</p>
        <br>
        <p>Este ha sido el reusltado de un trabajo creado por cuatro estudiantes con el fin de aprobar un proyecto final</p>

    </div>
    <footer>
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <div class="social-icons-container">
            <a href="https://www.twitter.com/petmanagement" class="social-icon"></a>
            <a href="https://www.t.me/petmanagement" class="social-icon"></a>
        </div>
        <ul class="footer-menu-container">
            <li class="footer-item">Legal</li>
            <li class="footer-item">Cookies</li>
            <li class="footer-item">Privacy</li>
            <li class="footer-item">Shipping</li>
            <li class="footer-item">Refunds</li>
        </ul>
        <span class="copyright">&copy;2021, Krey Academy. All rights reserved.</span>
    </footer>
</body>
</html>
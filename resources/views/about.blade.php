<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-about.css')}}">
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <title>About Us</title>
</head>
<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
                <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
                <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
                {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
                <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
                <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
                {{-- <form><a href="{{url("entretenimiento")}}" method="get"><li class="menu-item">Entretenimiento</li></a></form> --}}
                <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
                <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
            @if (Session::get('cliente_session'))
                <form><a href="{{url("modificarPerfil")}}" method="get"><li class="menu-item">Mi Perfil</li>
                    <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                </form>
                <form><a href="{{url("logout")}}" method="get"><li class="cta-logout">Logout</li></a></form>
            @else
                <form><a href="{{url("login")}}" method="get"><li class="cta">Login</li></a></form>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
    <div class="column-1">
        <img src="./img/imagenesWeb/logo.png" class="foto">
    </div>
    <div class="content">
        <h1>Pet Management</h1>
        <p>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
        "There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec dignissim libero. Sed pellentesque volutpat metus, sit amet efficitur velit rutrum id. Phasellus condimentum justo nec magna viverra tristique. Praesent faucibus luctus libero, et tempus augue eleifend ut. In ac commodo urna. Vivamus vel lacinia augue. Donec hendrerit, odio non auctor rhoncus, mi justo tempus erat, sit amet dictum nisi urna sed orci. Nam hendrerit lacus sed risus sollicitudin, non volutpat lorem tempus. Sed non elit aliquam, hendrerit dolor sit amet, condimentum metus. Phasellus dictum nunc turpis, at porttitor erat convallis nec. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas posuere elit id nibh dictum, at fringilla mi euismod. In quis accumsan nibh, a vulputate nibh.</p>

        <p>Pellentesque vehicula mollis nibh sed ullamcorper. Vivamus pretium nunc a orci laoreet, eget vulputate risus rutrum. Sed fermentum sapien urna. Nunc tempus quam varius ante laoreet, sed luctus urna mattis. Sed venenatis fermentum sodales. Donec justo neque, dapibus in bibendum non, auctor ut nisl. Vivamus orci felis, euismod non rhoncus nec, congue hendrerit ex. Mauris pellentesque, mauris ullamcorper fermentum pretium, turpis nisl accumsan mi, in semper justo nisl ut nunc. Sed elementum eros sit amet augue ullamcorper mollis.</p>

        <p>Mauris ut nunc at felis vulputate varius id id sem. Mauris mollis faucibus eros, ultricies iaculis leo. Morbi placerat sed dui et interdum. Etiam volutpat ex posuere dolor egestas fringilla. Integer sagittis nunc sed ex efficitur interdum. Phasellus egestas enim in turpis volutpat finibus. Nullam vulputate venenatis egestas. Nulla eu massa vehicula, dapibus lorem eu, bibendum erat. Cras vel pellentesque sapien. Quisque egestas varius ipsum vel vestibulum. Vestibulum pharetra placerat elit nec pellentesque. Pellentesque consectetur turpis vel vulputate facilisis. Sed bibendum, nibh id fermentum fringilla, lacus turpis facilisis magna, et tristique est purus nec velit. Maecenas rutrum luctus cursus. Ut et aliquet neque, eget imperdiet quam. Donec sed leo sit amet dui imperdiet semper a vitae est.</p>

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
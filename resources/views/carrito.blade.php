<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="js/iconos_g.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script language="javascript" src="js/carrito.js"></script>
    <link rel="stylesheet" href="{{asset('css/carrito.css')}}">
    <title>PetManagment - Carrito</title>
</head>
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
<body>
    <div class="div-1">
    <table id="cart" class="table table-hover table-condensed border">
        <thead>
        <tr>
            <th style="width:50%">Producto</th>
            <th style="width:10%">Precio</th>
            <th style="width:8%">Cantidad</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0 ?>
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                <?php $total += $details['precio'] * $details['cantidad'] ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="storage/uploads/{{ $details['foto'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['nombre'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['precio'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['cantidad'] }}" class="form-control quantity" max="5001"/>
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['precio'] * $details['cantidad'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{ $total }}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('tienda') }}" class="btn btn-volver"><i class="fa fa-angle-left"></i> Seguir comprando</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td><form action="{{url('enviarDinero/'.$total)}}" method="GET">
                <button class= "pagar" id="logout" type="submit" name="Pagar" value="Pagar"><i class="far fa-shopping-cart"> </i> Pagar</button>
            </form></td>
            <td class="hidden-xs text-center"><strong>Total {{ $total }}€</strong></td>
            <td colspan="2"><form action="{{url('enviarDinero/'.$total)}}" method="GET">
                <button class= "btn btn-volver pagar" id="logout" type="submit" name="Pagar" value="Pagar"><i class="far fa-shopping-cart i-pagar"> </i> Pagar</button>
            </form></td>
        </tr>
        </tfoot>
    </table>
</div>
    
</body>
<footer>
    <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
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
<script type="text/javascript">
    $(".update-cart").click(function (e) {
       e.preventDefault();
       var ele = $(this);
        $.ajax({
           url: '{{ url('update-cart') }}',
           method: "patch",
           data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
           success: function (response) {
               window.location.reload();
           }
        });
    });
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
    });
    var header = document.getElementById('Header')

    window.addEventListener("scroll", function() {
        var scroll = window.scrollY;
        if (scrollY > 0) {
            header.style.backgroundColor = '#8590ff';

        } else {
            header.style.backgroundColor = '#8590ff';
        }

    })
</script>
</html>
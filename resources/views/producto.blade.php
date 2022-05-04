<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="../js/iconos_g.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script language="javascript" src="../js/producto.js"></script>
    <link rel="stylesheet" href="{{asset('css/producto.css')}}">
    <title>PetManagment - {{$producto[0]->nombre_art}}</title>
</head>
<header id="Header">
    <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
    <!--Menu header-->
    <ul class="main-menu">
        <a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a>
        <a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a>
        <a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a>
        <a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a>
        <a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a>
        <a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a>
        <a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a>
        @if (Session::get('email_session'))
            <a href="{{url("logout")}}" method="get"><li class="cta">Logout</li></form></a>
        @else
            <a href="{{url("login")}}" method="get"><li class="cta">Login</li></form></a>
        @endif
    </ul>
    <script src="./js/home.js"></script>
</header>
<body>
    <div class="div1">
        <div class="container_prod" id="galeria">
            <div class="img_pral" id="principal"><img src="../storage/uploads/{{$producto[0]->foto_art}}"></div>
            @php
                $cont=1
            @endphp
            @foreach ($fotos as $foto)
                <div class="subImg_1" name="thumb" id="@php echo $cont; $cont++; @endphp"><img src="../storage/uploads/{{$foto->foto_f}}"></div>
            @endforeach
        </div>
        <div class="producto" id-producto="{{$producto[0]->id_art}}">
            <div class="nombre"><h4>{{$producto[0]->nombre_art}}</h4></div>
            <div class="descripcion"><p>{{$producto[0]->descripcion_art}}</p></div>
            <div class="marca"><p>Vendido por <strong>{{$producto[0]->marca_ma}}</strong></p></div>
            <div class="precio"><p>{{$producto[0]->precio_art}}€</p></div>
            <div class="carrito-cantidad">
                <div class="cantidad">
                    <div class="input-cantidad"><input type="number" value="1" class="form-control quantity" max="5001" min="1" id="input-cantidad"/></div>
                    <div class="cantidad-precio"><p id="precio-final">{{$producto[0]->precio_art}}€</p></div>
                </div>
                <div class="anadir-carrito"><a href="../add-to-cart-producto/{{$producto[0]->id_art}}/1" class="btn btn-block btn-carrito">Añadir al carrito</a></div>
            </div>
            <div class="div-dropmenu">
                <div class="dropdown">
                    <button type="button" class="btn btn-info carrito-drop" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </div>
                            <?php $total = 0 ?>
                            @foreach((array) session('cart') as $id => $details)
                                <?php $total += $details['precio'] * $details['cantidad'] ?>
                            @endforeach
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p>Total: <span class="color"> {{ $total }}€</span></p>
                            </div>
                        </div>
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img src="../storage/uploads/{{ $details['foto'] }}"/>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{ $details['nombre'] }}</p>
                                        <span class="price color"> ${{ $details['precio'] }}</span> <span class="count"> Cantidad:{{ $details['cantidad'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{ url('carrito') }}" class="btn btn-block btn-carrito">Ir al carrito</a>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <img src="../storage/img/imagenesWeb/logo.png" alt="" class="logo">
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
</html>
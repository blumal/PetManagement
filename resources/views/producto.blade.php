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
<nav id="nav">
    <div class="nav_container">
        <img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo">
        <label for="menu" class="nav_label">
            <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
        </label>
        <input type="checkbox" id="menu" class="nav_input">
        <!--Menu header-->
        <div class="nav_menu">
            <a href="{{url("/")}}" class="nav_item">Home</a>
            <a href="{{url("tienda")}}" class="nav_item">Tienda</a>
            <a href="{{url("citas")}}" class="nav_item">Clínica</a>
            <a href="{{url("contacto")}}" class="nav_item">Contacto</a>
            <a href="{{url("about")}}" class="nav_item">Sobre Nosotros</a>
            <a href="{{url("mapa_animales_perdidos")}}" class="nav_item">Perdidos</a>
            <a href="{{url("mapa_establecimientos")}}" class="nav_item">Establecimientos</a>
            @if (Session::get('cliente_session'))
                    <a class="nav_item" href="{{url("modificarPerfil")}}">Mi Perfil</a>
                    <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                <a href="{{url("logout")}}" class="login_item">Logout</a>
            @else
                <a href="{{url("login")}}" class="login_item">Login</a>
            @endif
        </div>
    </div>
    <script src="./js/nav_mapas.js"></script>
</nav>
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
    <img src="../img/imagenesWeb/logo.png" alt="" class="logo">
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
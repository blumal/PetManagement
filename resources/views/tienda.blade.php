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
    <script language="javascript" src="js/tienda.js"></script>
    <link rel="stylesheet" href="css/tienda.css">
    <title>PetManagment - Tienda</title>
</head>
<header id="Header">
    <img src="storage/img/imagenesWeb/logo.png" alt="" class="logo">
    <!--Menu header-->
    <ul class="main-menu">
        <form action="{{url("home")}}" method="get"><li class="menu-item">Home</li></form>
        <form action="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></form>
        <form action="{{url("clinica")}}" method="get"><li class="menu-item">Clínica</li></form>
        <form action="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></form>
        <form action="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></form>
        <form action="{{url("login")}}" method="get"><li class="cta">Login</li></form>
    </ul>
    <script src="./js/home.js"></script>
</header>
<body>
    <div class="row-c">

    
    <div class="div1">
        <div class="filtros-precio-marca">
            <div class="filtro-precio">
                <p>Precio:</p>
                <form  method="post">
                    <label>
                        <input type="radio" name="precio" checked value="ASC" onclick='filtro4()'/>
                        <span> Más barato</span>
                    </label>
                    <label>
                        <input type="radio" name="precio" value="DESC" onclick='filtro4()'/>
                        <span> Más caro</span>
                    </label>
                </form>
            </div>
            <div class="filtro-marca">
                <p>Marca:</p>
                <label class="container">Animal's Care
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                  <label class="container">Pharma Pets
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
            </div>
        </div>
        <div class="filtro-search-bar">
            <i class="fa fa-search"></i> 
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto o categoria" id="search" aria-label="Search" onkeyup="filtro(); return false;">
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
                                    <img src="storage/uploads/{{ $details['foto'] }}"/>
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['nombre'] }}</p>
                                    <span class="color"> ${{ $details['precio'] }}</span> <span class="count"> Cantidad:{{ $details['cantidad'] }}</span>
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
        <div class="fitro-categoria">
            <div class="categoria">
                <p>Comida</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
            <div class="categoria">
                <p>Productos Higiene</p>
            </div>
        </div>
        <div class="productos">
            <p>Lo más vendido</p>
            <div class="producto">
                <div class="thumbnail">
                    <div class="thumbnail-img"><img src="" width="500" height="200"></div>
                    <div class="caption">
                        <div class="caption-titulo"><h5>Pienso Criadores para perros adultos Cordero y arroz</h5></div>
                        <div class="caption-descripcion"><p>El pienso natural super premium Criadores Adulto con cordero...</p></div>
                        <div class="producto-precio"><p>59.99€</p></div>
                        <p class="btn-holder"><a href="" class="btn btn-block btn-carrito" role="button">Añadir al carrito</a> </p>
                    </div>
                </div>
            </div>
            <div class="producto">
                <div class="thumbnail">
                    <div class="thumbnail-img"><img src="" width="500" height="250"></div>
                    <div class="caption">
                        <h5>Pienso Criadores para perros adultos Cordero y arroz</h5>
                        <p>El pienso natural super premium Criadores Adulto con cordero...</p>
                        <div class="producto-precio"><p>59.99€</p></div>
                        <p class="btn-holder"><a href="" class="btn btn-block btn-carrito" role="button">Añadir al carrito</a> </p>
                    </div>
                </div>
            </div>
            <div class="producto">
                <div class="thumbnail">
                    <div class="thumbnail-img"><img src="" width="500" height="250"></div>
                    <div class="caption">
                        <h5>Pienso Criadores para perros adultos Cordero y arroz</h5>
                        <p>El pienso natural super premium Criadores Adulto con cordero...</p>
                        <div class="producto-precio"><p>59.99€</p></div>
                        <p class="btn-holder"><a href="" class="btn btn-block btn-carrito" role="button">Añadir al carrito</a> </p>
                    </div>
                </div>
            </div>
            <div class="producto">
                <div class="thumbnail">
                    <div class="thumbnail-img"><img src="" width="500" height="250"></div>
                    <div class="caption">
                        <h5>Pienso Criadores para perros adultos Cordero y arroz</h5>
                        <p>El pienso natural super premium Criadores Adulto con cordero...</p>
                        <div class="producto-precio"><p>59.99€</p></div>
                        <p class="btn-holder"><a href="" class="btn btn-block btn-carrito" role="button">Añadir al carrito</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer>
    <img src="storage/img/imagenesWeb/logo.png" alt="" class="logo">
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
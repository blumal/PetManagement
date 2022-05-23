<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="js/iconos_g.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script language="javascript" src="./js/tienda.js"></script>
    <link rel="stylesheet" href="{{asset('css/tienda.css')}}">
    <title>PetManagment - Tienda</title>
</head>
<header id="Header">
    <form action="FacturasTienda" method="post">
        @csrf
        
        <input type="hidden" name="id_user" value={{Session::get('id_user_session')}}>
        <input class="ver_factura" type="submit" value="Ver facturas anteriores">
    </form>
    <img src="storage/img/imagenesWeb/logo.png" alt="" class="logo">
    <!--Menu header-->
    <ul class="main-menu">
        @if (Session::get('cliente_session'))
            <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
            <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
            <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
            {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
            <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
            <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
            <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
            <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
            <form><a href="{{url("modificarPerfil")}}" method="get"><li class="menu-item">Mi Perfil</li>
                <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
            </form>
            <form><a href="{{url("logout")}}" method="get"><li class="cta-logout">Logout</li></a></form>
        @else
            <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
            <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
            <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
            {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
            <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
            <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
            <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
            <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
            <form><a href="{{url("login")}}" method="get"><li class="cta">Login</li></a></form>
        @endif
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
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto o categoria" id="search" aria-label="Search" onkeyup="filtro(); return false;" onpaste="filtro();">
        </div>
        <div class="div-dropmenu">
            <div class="dropdown" id="dropdown">
                <button type="button" class="btn btn-info carrito-drop" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
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
                                    <p>{{ $details['nombre'] }} ({{ $details['subcategoria_texto'] }})</p>
                                    <span class="color"> {{ $details['precio'] }}€</span> <span class="count"> Cantidad: {{ $details['cantidad'] }}</span>
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
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Perros
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Pienso para perro' onclick='filtro2(this)'>Pienso para perro</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida humeda para perro' onclick='filtro2(this)'>Comida húmeda</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Snacks para perro' onclick='filtro2(this)'>Snacks</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Repelentes para perro' onclick='filtro2(this)'>Repelentes para perro</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios para perro' onclick='filtro2(this)'>Accesorios para perro</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Juguetes para perro' onclick='filtro2(this)'>Juguetes</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud e higiene para perro' onclick='filtro2(this)'>Salud e higiene</a></li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Gatos
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Pienso para gato' onclick='filtro2(this)'>Pienso para gato</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida humeda para gato' onclick='filtro2(this)'>Comida húmeda</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Snacks para gato' onclick='filtro2(this)'>Snacks</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Repelentes para gato' onclick='filtro2(this)'>Repelentes para gato</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios para gato' onclick='filtro2(this)'>Accesorios para gato</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Juguetes para gato' onclick='filtro2(this)'>Juguetes</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud e higiene para gato' onclick='filtro2(this)'>Salud e higiene</a></li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Roedores y hurones
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li class="dropdown-submenu dropright">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Jerbos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida y snacks para jerbo' onclick='filtro2(this)'>Comida y snacks</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios para roedores' onclick='filtro2(this)'>Accesorios</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Henos' onclick='filtro2(this)'>Henos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Higiene y desinfección para jerbo' onclick='filtro2(this)'>Higiene y desinfección</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud para jerbo' onclick='filtro2(this)'>Salud</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropright">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Hamsters<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida y snacks para hamster' onclick='filtro2(this)'>Comida y snacks</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios para roedores' onclick='filtro2(this)'>Accesorios</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Henos' onclick='filtro2(this)'>Henos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Higiene y desinfección para hamster' onclick='filtro2(this)'>Higiene y desinfección</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud para hamster' onclick='filtro2(this)'>Salud</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropright">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Ratas y ratones<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='comida y snacks para raton' onclick='filtro2(this)'>Comida y snacks</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios para roedores' onclick='filtro2(this)'>Accesorios</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Henos' onclick='filtro2(this)'>Henos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Higiene y desinfección para raton' onclick='filtro2(this)'>Higiene y desinfección</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud para raton' onclick='filtro2(this)'>Salud</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropright">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Hurones<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para huron' onclick='filtro2(this)'>Comida</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Jaulas para huron' onclick='filtro2(this)'>Jaulas</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Snacks para huron' onclick='filtro2(this)'>Snacks</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Juguetes para huron' onclick='filtro2(this)'>Juguetes</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Higiene y desinfección para huron' onclick='filtro2(this)'>Higiene</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud para huron' onclick='filtro2(this)'>Salud</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropright">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Conejos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para conejo' onclick='filtro2(this)'>Comida y snacks</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Henos' onclick='filtro2(this)'>Henos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Lechos y viruta' onclick='filtro2(this)'>Lechos y viruta</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Higiene y desinfección para conejo' onclick='filtro2(this)'>Higiene</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud para conejo' onclick='filtro2(this)'>Salud</a></li>
                    </ul>
                  </li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Pajaros
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li class="dropdown-submenu dropleft">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Comida<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para canario' onclick='filtro2(this)'>Canarios</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para periquito' onclick='filtro2(this)'>Periquitos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para loro' onclick='filtro2(this)'>Loros</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para cotorra' onclick='filtro2(this)'>Cotorras</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para paloma' onclick='filtro2(this)'>Palomas</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para gallina' onclick='filtro2(this)'>Gallinas</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para papagayo' onclick='filtro2(this)'>Papagayos</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropleft">
                    <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Accesorios<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comederos para pajaro' onclick='filtro2(this)'>Comederos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Bebederos para pajaro' onclick='filtro2(this)'>Bebederos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Nidos para pajaro' onclick='filtro2(this)'>Nidos</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Juguetes para pajaro' onclick='filtro2(this)'>Juguetes</a></li>
                      <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Bañeras para pajaro' onclick='filtro2(this)'>Bañeras</a></li>
                    </ul>
                  </li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Jaulas para pajaro' onclick='filtro2(this)'>Jaulas</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Semillas' onclick='filtro2(this)'>Semillas</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Antiparasitarios para pajaro' onclick='filtro2(this)'>Antiparasitarios</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Desinfección para pajaro' onclick='filtro2(this)'>Desinfección</a></li>
                  <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Vitaminas para pajaro' onclick='filtro2(this)'>Vitaminas y suplementos</a></li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Reptiles y Tortugas
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Comida<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para reptil' onclick='filtro2(this)'>Piensos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida vegetariana para reptil' onclick='filtro2(this)'>Vegetariana</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para tortugas agua' onclick='filtro2(this)'>Tortugas Agua</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para tortugas tierra' onclick='filtro2(this)'>Tortugas Tierra</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para iguana' onclick='filtro2(this)'>Iguanas</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para camaleones' onclick='filtro2(this)'>Camaleones</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Calefacción<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Lamparas calefactoras' onclick='filtro2(this)'>Lamparas Calefactoras</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Mantas térmicas' onclick='filtro2(this)'>Mantas Térmicas</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Rocas calefactoras' onclick='filtro2(this)'>Rocas Calefactoras</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Mantenimiento<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Bombas' onclick='filtro2(this)'>Bombas</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Filtros' onclick='filtro2(this)'>Filtros</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Recambios' onclick='filtro2(this)'>Recambios</a></li>
                        </ul>
                    </li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Terrarios para reptil' onclick='filtro2(this)'>Terrarios</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comederos para reptil' onclick='filtro2(this)'>Comederos</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Bebederos para reptil' onclick='filtro2(this)'>Bebederos</a></li>
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Salud e Higiene<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Cuidado agua para reptil' onclick='filtro2(this)'>Cuidado agua</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Vitaminas para reptil' onclick='filtro2(this)'>Vitaminas</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Desinfección para reptil' onclick='filtro2(this)'>Desinfección</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Salud para reptil' onclick='filtro2(this)'>Salud</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Higiene para reptil' onclick='filtro2(this)'>Higiene</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Peces
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Comida<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para peces tropicales' onclick='filtro2(this)'>Peces tropicales</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para peces de agua fría' onclick='filtro2(this)'>Peces de agua fría</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para peces de fondo' onclick='filtro2(this)'>Peces de fondo</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para peces discos' onclick='filtro2(this)'>Peces Discos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para copos y escamas' onclick='filtro2(this)'>Copos y Escamas</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para invertebrados' onclick='filtro2(this)'>Invertebrados</a></li>
                        </ul>
                    </li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Acuarios' onclick='filtro2(this)'>Acuarios</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Filtros para acuario' onclick='filtro2(this)'>Filtros</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Bombas' onclick='filtro2(this)'>Bombas</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comederos automáticos' onclick='filtro2(this)'>Comederos automáticos</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Clarificadores de agua' onclick='filtro2(this)'>Clarificadores de agua</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Decoración de acuarios' onclick='filtro2(this)'>Decoración de acuarios</a></li>
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Salud de los peces<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Medicamentos para peces' onclick='filtro2(this)'>Medicamentos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Vitaminas para peces' onclick='filtro2(this)'>Vitaminas</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Animales de granja
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Gallinas y aves de corral<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Pienso y snacks para gallinas' onclick='filtro2(this)'>Pienso y snacks</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comederos y bebederos para gallinas' onclick='filtro2(this)'>Comederos y bebederos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Jaulas y ponederos para gallinas' onclick='filtro2(this)'>Jaulas y ponederos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropright">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Ovejas y cabras<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comederos y bebederos para ovejas' onclick='filtro2(this)'>Comederos y bebederos</a></li>
                        </ul>
                    </li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Limpieza animales de granja' onclick='filtro2(this)'>Limpieza</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Herramientas animales de granja' onclick='filtro2(this)'>Herramientas de granja</a></li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Vallado y cerramiento' onclick='filtro2(this)'>Vallado y cerramiento</a></li>
                </ul>
            </div>
            <div class="btn-group div-categoria">
                <button class="btn btn-lg btn-categoria dropdown-toggle" type="button" data-toggle="dropdown">Caballos
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu dropleft">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Equipamiento del caballo<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Sillas de montar para caballo' onclick='filtro2(this)'>Sillas de montar</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Mantas para caballos para caballo' onclick='filtro2(this)'>Mantas para caballos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios para caballos' onclick='filtro2(this)'>Accesorios para caballos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Material de cuadra' onclick='filtro2(this)'>Material de cuadra</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Protectores y vendas para caballos' onclick='filtro2(this)'>Protectores y vendas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropleft">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Equipamiento del jinete<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Cascos de equitación' onclick='filtro2(this)'>Cascos de equitación</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Botas y botines de montar para caballo' onclick='filtro2(this)'>Botas y botines de montar</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Accesorios de montar para caballo' onclick='filtro2(this)'>Accesorios para caballos</a></li>
                        </ul>
                    </li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Juguetes y entretenimiento para caballo' onclick='filtro2(this)'>Juguetes y entretenimiento</a></li>
                    <li class="dropdown-submenu dropleft">
                        <a class="dropdown-item btn btn-lg btn-sub-categoria dropdown-toggle">Higiene y cuidados<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Peines y adornos para caballo' onclick='filtro2(this)'>Peines y adornos</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Insecticidas y repelentes para caballo' onclick='filtro2(this)'>Insecticidas y repelentes</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Antiparasitarios para caballo' onclick='filtro2(this)'>Antiparasitarios</a></li>
                          <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Champús para caballos' onclick='filtro2(this)'>Champús para caballos</a></li>
                        </ul>
                    </li>
                    <li><a class='dropdown-item btn btn-lg categoria' data-categoria='Comida para caballos' onclick='filtro2(this)'>Comida y golosinas</a></li>
                </ul>
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
<div id="myModal2" class="modal2">
    <div class="modal-content2">
      <div class="div-modal">
        <span class="close2">&times;</span>
        
      </div>
    </div>
</div>
<div id="myModal3" class="modal3">
    <div class="modal-content3">
      <div class="div-modal3">
        
        
      </div>
    </div>
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
</html>

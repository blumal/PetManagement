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
    <link rel="stylesheet" href="../css/producto.css">
    <title>PetManagment - {{$producto[0]->nombre_art}}</title>
</head>
<body>
    <div class="div1">
        <div class="container_prod" id="galeria">
            <div class="img_pral" id="principal"><img src=""></div>
            <div class="subImg_1" name="thumb" id=""><img src=""></div>
            <div class="subImg_2" name="thumb" id=""><img src=""></div>
            <div class="subImg_3" name="thumb" id=""><img src=""></div>
            <div class="subImg_4" name="thumb" id=""><img src=""></div>
        </div>
        <div class="producto">
            <div class="nombre"><h4>{{$producto[0]->nombre_art}}</h4></div>
            <div class="descripcion"><p>Royal Canin Maxi Adult es un alimento para perros de 26 a 44 kg, desde los 15 meses a los 5 años; que ayudará a tu mascota a mantener el peso ideal y un óptimo estado de salud, cubriendo las</p></div>
            <div class="marca"><p>Vendido por <strong>{{$producto[0]->marca_ma}}</strong></p></div>
            <div class="precio"><p>{{$producto[0]->precio_art}}€</p></div>
            <div class="carrito-cantidad">
                <div class="cantidad">
                    <div class="input-cantidad"><input type="number" value="1" class="form-control quantity" max="5001" min="1" id="input-cantidad"/></div>
                    <div class="cantidad-precio"><p id="precio-final">{{$producto[0]->precio_art}}€</p></div>
                </div>
                <div class="anadir-carrito"><a href="" class="btn btn-block btn-carrito">Añadir al carrito</a></div>
            </div>
            <div class="div-dropmenu">
                <div class="dropdown">
                    <button type="button" class="btn btn-info" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito <span class="badge badge-pill badge-danger">0</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </div>
                            <?php $total = 0 ?>
                            @foreach((array) session('cart') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity'] ?>
                            @endforeach
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p>Total: <span class="text-info"> {{ $total }}€</span></p>
                            </div>
                        </div>
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img src="{{ $details['photo'] }}" />
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{ $details['name'] }}</p>
                                        <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Cantidad:{{ $details['quantity'] }}</span>
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
</html>
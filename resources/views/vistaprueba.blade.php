<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style_principal.css">
    <title>Document</title>
</head>
<body>
    <div class="one-column-s1">
        <a href="{{ url('carritoview')}}">
            @php
                if (isset($array3)){
            @endphp
                <p><b class="cesta" onclick=""><img src="../public/img/carrito.png" alt="carrito" width="25px">
            @php
                    $numbb = count($array3);
                    print_r($numbb);
                }else{
            @endphp
                    <p><b class="cesta" onclick=""><img src="../public/img/carritonull.png" alt="carrito" width="25px">
            @php
                    echo "";
                }
            @endphp</b></p>
        </a>
    </div>
    <div>
        <div>
            <h2>prueba</h2>
        </div>
    </div>
    @foreach ($listaProducto as $producto)
    <div>
        <div>
            <p><b>{{$producto->nombre_art}}</b></p>
            <form action="{{url('carritoadd')}}" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{$producto->id_art}}">
                <button class="añadir" id="logout" type="submit" name="Pagar" value="Pagar">Añadir al carrito</button>
            </form>
        </div>
    </div>
    @endforeach
</body>
</html>
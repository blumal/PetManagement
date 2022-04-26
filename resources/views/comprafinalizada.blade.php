<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camisetas Baratas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style_cesta.css')}}">
</head>
<body>

<div class="row" id="section1">

    <div class="one-column-s1-l">
        <a href="{{ url('logout')}}">
        </a>
        </div>
        <div>
            <marquee behavior="scroll" direction="right" scrolldelay="1">Compra realizada! @php echo Session::get('email_us') @endphp</marquee>
            <br>
            <br>
        </div>
</div>

<div class="row" id="">
    <div class="titulo">
        <h2>La compra se ha realizado con éxito</h2>
    </div> 
    <a href="{{ url('tienda')}}" >
        <p class="seguir"><b>Ir a la página principal</b></p>
    </a>
</div>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Animal Geoguesser</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/geoguesser.css')}}">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
</head>
<body>
    @include('comun.navegacion')
    <div id="img_geo" class="img_geo">
        <h1>ANIMAL GEOGUESSER</h1>
    </div>
    <form class="jugar" action="{{url('geoguesser-game')}}" method="GET">
        <button class="btn_jugar" type="submit">JUGAR</button>
    </form>
</body>
</html>
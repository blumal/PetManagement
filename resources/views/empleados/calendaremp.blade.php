<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <!--Api-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales-all.js"></script>
    <!--JS-->
    <script src="{{asset('js/empleados/viewcalendar.js')}}"></script>
    <!--CSS-->
    <link rel="stylesheet" href="{{asset('css/empleados/calendaremp.css')}}">
    <!--TOKEN-->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <title>Calendario</title>
</head>
<body>
    @include('comun.navegacion')
    <div class="row-c flex">
        <div class="calendarestructure column-1">
            <center>
                <h1>Calendario de citas</h1>
                <div id="calendar"></div>
            </center>
        </div>
    </div>
</body>
</html>
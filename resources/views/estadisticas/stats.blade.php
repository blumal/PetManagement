<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-stats.css')}}">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/estadisticas/graficos.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>STATS</title>
</head>
<body>
    <form class="head" action="{{url('/cpanel')}}" method="GET">
        <button type="submit" value="logout" class="btn btn-info">Back</button>
        <h1>Estadísticas</h1>
    </form>
    <div class="caja">
        <div class="column-2">
            <div class="contenedor_grafico">
                <canvas id="chart_visitasxhoras"></canvas>
            </div>      
        </div>
        <div class="column-2">
            <div class="contenedor_grafico">
                <canvas class="contenedor_grafico" id="chart_pedidosxmes"></canvas>
            </div>
        </div>
        <div class="column-2">
            <div class="contenedor_grafico">
                <canvas id="chart_pacientesxnombre"></canvas>
            </div>
        </div>
        <div class="column-2">
            <div class="contenedor_grafico">
                <canvas id="chart_visitasxmeses"></canvas>
            </div>
        </div>
        <div class="column-1">
            <div class="contenedor_grafico">
                <canvas id="chart_sociedadesxtipo"></canvas>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <title>La Ranita</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{asset('css/juegos/ranita/ranita.css')}}">
  <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="/img/juego_ranita/48.png">
</head>

<body>
  
<canvas width="624" height="720" id="game"></canvas>
<img hidden src="/img/juego_ranita/48.png" id="jose">
<img hidden src="/img/juego_ranita/water.webp" id="agua">
<img hidden src="/img/juego_ranita/sand.jpeg" id="arena">
<img hidden src="/img/juego_ranita/grass.jpeg" id="cesped">
<img hidden src="/img/juego_ranita/lava.jpeg" id="lava">
<img hidden src="/img/juego_ranita/road.jpeg" id="carretera">
<img hidden src="/img/juego_ranita/see.jpeg" id="gold">
<img hidden src="/img/juego_ranita/left1.png" id="izquierda">
<img hidden src="/img/juego_ranita/right.png" id="derecha">
<img hidden src="/img/juego_ranita/heart8.png" id="corazon">

<script src="{{asset('js/juegos/ranita/script.js')}}"></script>
</body>
</html>
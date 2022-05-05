<!DOCTYPE html>
<html>
<head>
  <title>Basic Frogger HTML Game</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{asset('css/juegos/ranita/ranita.css')}}">
</head>

<body>
  
<canvas width="624" height="720" id="game"></canvas>
<img hidden src="/storage/img/48.png" id="jose" width="48" height="48">
<img hidden src="/storage/img/agua.jpeg" id="agua" width="48" height="48">
<img hidden src="/storage/img/arena.jpeg" id="arena" width="48" height="48">
<img hidden src="/storage/img/cesped.jpeg" id="cesped" width="48" height="48">
<img hidden src="/storage/img/lava.jpeg" id="lava" width="48" height="48">
<img hidden src="/storage/img/carre.jpeg" id="carretera" width="48" height="48">
<img hidden src="/storage/img/Logo_ranita.png" id="logo" width="48" height="48">
<script src="{{asset('js/juegos/ranita/script.js')}}"></script>
</body>
</html>
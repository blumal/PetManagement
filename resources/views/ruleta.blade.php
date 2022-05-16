@if (!Session::get('cliente_session'))
    <?php
        //Si la session no esta definida te redirige al login, la session se crea en el método.
        return redirect()->to('login')->send();
    ?>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mapa Establecimientos</title>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/ruleta.css')}}">
</head>

<body>
    <input type="hidden" id="id_usr" value="<?php echo session('id_user_session')?>">
    <div class="contenedor">
      <h1>Ruleta de premios</h1>
      <div class="concursantes">
        <canvas id="idcanvas" width="500" height="500"></canvas><br>
        <button id="btn_srt" onclick="sortear()"><span id="idestado" value="Sortear">Sortear</span></button>
        <div class="mark-winner"></div>
      </div>
    </div>
  {{-- <div id="premio">

    <table style=" margin: 0 auto;">
      <tr>
        <td>
          <p class="elije">ELIJE TU CORTESIA:</p>
        </td>
        <td><img src="{{asset('http://localhost/www/PetManagement/storage/app/public/img/cortesia.png')}}" class="imgSorpresa"></td>

      </tr>
      <tr>
        <td>
          <p class="contador">TURNOS: 0</p>
        </td>
      </tr>
    </table>
  <div class="vara"></div>
  <div>
    <img src="{{asset('http://localhost/www/PetManagement/storage/app/public/img/imagen.png')}}" id="ruleta">
  </div>
  <div>
    <div id="sonido" style="display: none;">
      <iframe src="sonido/ruleta.mp3" id="audio"></iframe>

    </div>
  </div> --}}


  {{-- <script src="js/jquery.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/ruleta.js"></script>
</body>

</html>
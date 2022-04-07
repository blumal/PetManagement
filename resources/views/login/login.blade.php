<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style-login.css">
    <link rel="icon" href="./img/imagenesWeb/logo.png">

    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <div class="login-form">
        <form action="{{url("login-proc")}}" method="post">
            @csrf
            <input type="email" placeholder="Ex: rauw@petmanagement.net" name="email_us"></br></br>
            <input type="password" name="pass_us"></br></br>
            <input type="submit">
        </form>

    <div class="row flex">
        <div class="column-60">
            <div class="slider-frame">
                <ul>
                    <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-1.jpg" alt=""></li>
                    <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-2.jpg" alt=""></li>
                    <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-3.jpg" alt=""></li>
                    <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-4.jpg" alt=""></li>
                </ul>
            </div>
        </div>
        <div class="column-40">
            <img src="./img/imagenesWeb/fotosSlider/foto-slider-2.jpg" class="foto">
        </div>
    </div>
</body>
</html>
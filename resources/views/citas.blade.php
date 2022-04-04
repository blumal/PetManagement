<!--Método comprobación de sesión-->
@if (!Session::get('email_session'))
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

    <title>Citas</title>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <div>
        <form action="{{url("/logout")}}" method="post">
            @csrf
            ID Usuario -> {{ session()->get('id_user_session') }}
            <input type="submit" value="Logout">
        </form>
    </div>
    <h1>Citas</h1>
    <div class="form-citas">
        <form action="{{url("citas-proc")}}" method="post">
            @csrf
            </br></br>
            </br></br>
            <input type="submit" value="reservar">
        </form>
    </div>
    <form action="{{url("/FacturasClinica")}}" method="post">
        @csrf
        <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
        </br></br>
        </br></br>
        <input type="submit" value="Ver mis Visitas Anteriores">
    </form>

    
    <form action="{{url("/FacturasTienda")}}" method="post">
        @csrf
        <input type="hidden" name="id_user" value={{ session()->get('id_user_session') }}>
        </br></br>
        </br></br>
        /////// ESTO ES SOLO TEST //////////
        <BR>
        <input type="submit" value="Ver mis Compras Anteriores">
    </form>
    ////// ESTO ES SOLO TEST //////////
</body>
</html>
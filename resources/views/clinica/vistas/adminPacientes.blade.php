<!--Método comprobación de sesión-->

@if (Session::get('id_rol_session')==2)

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script src="js/visita/crud_pacientes.js"></script>
    <link rel="stylesheet" href="{{asset('css/CRUDPacientes/estilos_crud.css')}}">
    <title>Admin pacientes</title>
</head>
<body>
    <form class="head" action="{{url('/cpanel')}}" method="GET">
        <button type="submit" value="logout" class="btn btn-info">Back</button>
        <h1>Pacientes</h1>
    </form>  
    <div>
        <div id="mensaje"></div>
        <form id="boton">
            @csrf
            <a class="crear" href="{{url("/registrarPaciente")}}" method="get" name="Crear" value="Crear" id="botoncrear" type="submit">CREAR</a>
        </form>
        <form class="filtro" method="post" onsubmit="return false;">
            <input type="hidden" name="_method" value="POST" id="postFiltro">
            <div class="form-outline">
               <input type="search" id="search" name="nombre_paciente" class="form-control" placeholder="Buscar por nombre del paciente..." aria-label="Search" onkeyup="leerPacientes(); return false;"/>
            </div>
         </form>
    </div>
    <div {{-- class="table-responsive" --}}>
        <table class="table" id="mytable">
            
        </table>
        </div>
    </div>
    <script>leerPacientes();</script>
</body>
</html>
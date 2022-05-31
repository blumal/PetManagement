<!--Método comprobación de sesión-->

@if (!Session::get('id_rol_session')==1)

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
    <script src="{{asset('js/usuarios/crud_clientes.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/CRUDPacientes/estilos_crud.css')}}">
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    <title>Admin Pacientes</title>
</head>
<body>
    <form class="head" action="{{url('/cpanel')}}" method="GET">
        <button type="submit" value="logout" class="btn btn-info">Back</button>
        <h1>Pacientes</h1>
    </form>  
    <div>
        <div id="mensaje"></div>
        <form class="filtro" method="post" onsubmit="return false;">
            <input type="hidden" name="_method" value="POST" id="postFiltro">
            <div class="form-outline">
               <input type="search" id="search" name="nombre_paciente" class="form-control" placeholder="Filtrar por nombre" aria-label="Search" onkeyup="leerClientes(); return false;"/>
            </div>
         </form>
    </div>
    <div class="table-responsive">
        <table class="table" id="mytable">
            <tr class="fila-1">
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">DNI</th>
                <th scope="col">eMail</th>
                <th scope="col">Numero de telefono</th>
                <th scope="col">Domicilio</th>
                <th scope="col">Rol</th>
                <th scope="col">Activar/Desactivar</th>
            </tr>
            @forelse ($clientes as $cliente)
            <tr class="fila-2">
                <td>{{$cliente->nombre_us}}</td>
                <td>{{$cliente->apellido1_us}} {{$cliente->apellido2_us}}</td>
                <td>{{$cliente->dni_us}}</td>
                <td>{{$cliente->email_us}}</td>
                <td>{{$cliente->contacto1_tel}}</td>
                <td>{{$cliente->nombre_di}} {{$cliente->numero_di}}, {{$cliente->piso_di}} {{$cliente->puerta_di}}, {{$cliente->cp_di}}</td>
                @if ($cliente->id_rol_fk==3)
                <td>Trabajador</td>
                @elseif($cliente->id_rol_fk==2)
                <td>Cliente</td>
                @else
                <td>Admin</td> 
                @endif
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarCliente('{{$cliente->id_us}}')">Eliminar</button>
                </td>
            </tr>
            @empty
            <tr class="fila-2"><td>No hay clientes registrados</td></tr>
            @endforelse
            </table>
        </div>
    </div>
    <script>leerClientes();</script>
</body>
</html>
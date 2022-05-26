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
        <h1>Animales</h1>
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
               <input type="search" id="search" name="nombre_paciente" class="form-control" placeholder="Filtrar por nombre" aria-label="Search" onkeyup="leerPacientes(); return false;"/>
            </div>
         </form>
    </div>
    <div class="table-responsive">
        <table class="table" id="mytable">
            <tr class="fila-1">
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Peso (kg)</th>
                <th scope="col">Nº Identifiación</th>
                <th scope="col">Propietario</th>
                <th scope="col">Fecha nacimiento</th>
                <th scope="col">Nombre científico</th>
                <th scope="col">Raza</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
            @forelse ($pacientes as $paciente)
            <tr class="fila-2">
                <td><img src="../storage/{{$paciente->foto_pa}}" class="avatar"></td>
                <td>{{$paciente->nombre_pa}}</td>
                <td>{{$paciente->peso_pa}}</td>
                <td>{{$paciente->n_id_nacional}}</td>
                <td>{{$paciente->nombre_us}} {{$paciente->apellido1_us}}</td>
                <td>{{$paciente->fecha_nacimiento}}</td>
                <td>{{$paciente->nombrecientifico_pa}}</td>
                <td>{{$paciente->raza_pa}}</td>
                <td>
                    <form action="{{url("/editarPaciente")}}" method="post">
                        @csrf
                        <input type="hidden" name="id_paciente" value="{{$paciente->id_pa}}">
                        <input type="submit" value="Editar" class="btn btn-secondary">
                    </form>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarPaciente('{{$paciente->id_pa}}')">Eliminar</button>
                </td>
            </tr>
            @empty
            <tr class="fila-2"><td>No hay pacientes registrados</td></tr>
            @endforelse
            </table>
        </div>
    </div>
    <script>leerPacientes();</script>
</body>
</html>
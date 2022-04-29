<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>Admin pacientes</title>

    <link href="css/CRUDPacientes/estilos_crud.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="d-flex bd-highlight mb-3">
          <div class="me-auto p-2 bd-highlight"><h2>Pacientes</div>
          <div class="p-2 bd-highlight">
            <form action="{{url("/registrarPaciente")}}" method="post">
                @csrf
                <input type="submit" value="Crear" class="btn btn-success">
            </form>
          </div>
        </div>
        <div id="mensaje"></div>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
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
                </thead>
                <tbody id="mytable">

                    @forelse ($pacientes as $paciente)
                        <tr>
                            <td>{{$paciente->id_pa}}</td>
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
                                    <input type="submit" value="Editar" class="btn btn-outline-secondary">
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger" onclick="eliminarPaciente('{{$paciente->id_pa}}')">Eliminar</button>
                            </td>
                        </tr>
                    @empty
                    </table>
                        <p>No hay mas</p>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</body>
<script src="js/visita/crud_pacientes.js"></script>
</html>
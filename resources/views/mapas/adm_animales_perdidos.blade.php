<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Animales Perdidos USR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleadminmapaperdidos.css">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <center><h1>Aministrar Animales Perdidos</h1></center>
    <div class="table-responsive">
        <table class="table" id="table">
            <tr class="fila-1"><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Foto</th><th scope="col">Fecha Perdida</th><th scope="col">Hora perdida</th><th scope="col">Calle</th><th scope="col">Númeor de la calle</th><th scope="col">CP</th><th scope="col">Estado</th><th scope="col">Editar</th></tr>
    @foreach ($datos as $item)
        <tr class="fila-2">
        <td scope="row">{{$item->nombre_ape}}</td>
        <td scope="row">{{$item->descripcion_ape}}</td>
        <td scope="row"><img src="../storage/app/public/{{$item->foto_ape}}"></td>
        <td scope="row">{{$item->fecha_perdida_ape}}</td>
        <td scope="row">{{$item->hora_des_ape}}</td>
        <td scope="row">{{$item->direccion_perdida_ape}}</td>
        <td scope="row">{{$item->calle_ape}}</td>
        <td scope="row">{{$item->cp_ape}}</td>
        <td scope="row">{{$item->estado_est}}</td>
        <td scope="row"><button class="btn btn-warning" >Editar</button></td>
        </tr>
    @endforeach
</table>
</div>
</body>
</html>
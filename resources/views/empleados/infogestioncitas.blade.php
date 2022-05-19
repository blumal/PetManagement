<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <!--JS-->
    <title>Información de la cita</title>
</head>
<body>
    <center>
        <h1>Datos de la cita</h1>
    </center>
    @foreach ($quotedatas as $item)
        <h3>Datos del cliente</h3>
            <p>Visita nº: {{$item->id_vi}}</p>
            <p>Fecha de la visita: {{$item->fecha_vi}}</p>
            <p>Hora agendada: {{$item->hora_vi}}h</p>
            <p>Estado de la visita: {{$item->estado_est}}</p>
            <p>Nombre del cliente: {{$item->nombre_us}}</p>
        <h3>Datos del paciente</h3>
            <p>Nombre: {{$item->nombre_pa}} </p>
            <p>Raza: {{$item->raza_pa}}</p>
            <p>Peso: {{$item->peso_pa}}Kg</p>
            <p>Motivo de la visita: {{$item->asunto_vi}}</p>
    @endforeach
</body>
</html>
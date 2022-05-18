<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Mail</title>
</head>
<body>
    <h1>Recordatorio de cita </h1>
    <ul>
        <li>Nº cita: 000{{$lastid}}</li>
        <li>Fecha agendada: {{$datas['fecha_vi']}}</li>
        <li>Hora de visita: {{$datas['hora_vi']}}</li>
        <li>Motivo de la visita: {{$datas['asunto_vi']}}</li>
        <br/><br/>
    </ul><br/><br/><br/><br/><br/><br/><br/><br/>
    <center>
        <h3>Gracias por la confianza</h3>
    </center>
</body>
</html>
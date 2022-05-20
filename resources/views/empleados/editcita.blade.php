<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--JS-->
    <script src="{{asset('js/empleados/editcita.js')}}"></script>
    <!--TOKEN-->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>Actualización de cita</title>
</head>
<body>
    <center>
        <h1>Actualización de cita</h1>
    </center>
        @foreach ($quoteedit as $item)
            <div class="container p-5">
                @foreach ($quoteedit as $item)
                <h3>{{$item->nombre_us}} {{$item->apellido1_us}} {{$item->apellido2_us}}</h3>
                    <form class="form-horizontal" {{-- action="{{route('clientes.update',['cliente'=>$cliente->id])}}" method="post" --}}>
                        @csrf
                        <div class="form-group pt-3">
                            <label>Fecha agendada</label>
                            <input type="date" class="form-control" name="fecha_vi" id="fecha_vi" value="{{$item->fecha_vi}}" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> onchange="hourOptions(); return false;">
                        </div>
                        <div class="form-group pt-3">
                            <label for="hora_vi">Hora programada</label>
                                <select class="form-control" name="hora_vi" id="hora_vi">
                                    <option value="{{$item->hora_vi}}"></option>
                                </select>
                        </div>
                        <div class="form-group pt-3">
                            <input class="btn btn-success" type="submit" value="Guardar">
                        </div>
                        <div class="form-group pt-3">
                            <input class="btn btn-success" type="submit" value="Guardar">
                        </div>
                    </form>
                    <form action="{{route('')}}" method="post">
                        @csrf
                        {{method_field('GET')}}
                        <div class="form-group pt-3">
                            <input class="btn btn-secondary" type="submit" value="Cancelar">
                        </div>
                    </form>
                @endforeach
        @endforeach
</body>
</html>
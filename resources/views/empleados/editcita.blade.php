<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Librería Alertify-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
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
        <div class="container p-5">
            @foreach ($quoteedit as $item)
            <h3>{{$item->nombre_us}} {{$item->apellido1_us}} {{$item->apellido2_us}}</h3>
                <form class="form-horizontal" {{-- action="{{url('updatingquote')}}" --}} method="POST" onsubmit="UpdateQuote(); return false;">
                    @csrf
                    <div class="form-group pt-3">
                        <label>Fecha programada</label>
                        <input type="date" class="form-control" id="fecha_old" value="{{$item->fecha_vi}}" disabled=»disabled»>
                    </div>
                    <div class="form-group pt-3">
                        <label for="hora_vi">Hora programada</label>
                        <input type="text" class="form-control" id="hora_old" value="{{$item->hora_vi}}" disabled=»disabled»>
                    </div>
                    <div class="form-group pt-3">
                        <label>Programar nueva fecha</label>
                        <input type="date" class="form-control" name="fecha_vi" id="fecha_vi" value="" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> onchange="hourOptions(); return false;">
                    </div>
                    <div class="form-group pt-3">
                        <label for="hora_vi">Programar nueva hora</label>
                            <select class="form-control" name="hora_vi" id="hora_vi">
                                <option value="">--Horas disponibles--</option>
                            </select>
                    </div>
                    <div class="form-group pt-3">
                        <input class="btn btn-success" type="submit" value="Guardar">
                        <input type="hidden" id ="id_vi" value="{{$item->id_vi}}">
                        <input type="hidden" id="email_us" value="{{$item->email_us}}">
                    </div>
                </form>
                <!--Boton Retorno a home-->
                <form action="{{url('/homeempleado')}}" method="get">
                    @csrf
                    <div class="form-group pt-3">
                        <input class="btn btn-dark" type="submit" value="Back">
                    </div>
                </form>
            @endforeach
        </div>
</body>
</html>
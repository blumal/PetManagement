<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Asociar Paciente a Visita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/fontsawe/css/all.css" rel="stylesheet">
    <script defer src="/fontsawe/js/all.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/Visitas/style-asociPacienteVisita.css">
    


</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Visita {{$visita[0]->id_vi}}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row mb-5">
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text">
                                    <p><span>Dirección:</span> {{$cliente[0]->nombre_di}} {{$cliente[0]->numero_di}}</p>
                                    <p>Piso: {{$cliente[0]->piso_di}}, Puerta: {{$cliente[0]->puerta_di}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>Telefono</span> <a href="tel://1234567920">{{$cliente[0]->contacto1_tel}}</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email: </span>{{$cliente[0]->email_us}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-id-card"></span>
                                </div>
                                <div class="text">
                                    <p><span>DNI </span>{{$cliente[0]->dni_us}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Datos de la visita</h3>
                                <div id="form-message-warning" class="mb-4"></div>
                                <div id="form-message-success" class="mb-4">
                                    Your message was sent, thank you!
                                </div>
                                <form method="POST" id="contactForm" name="contactForm" class="contactForm" action="{{url("cerrarAsociacion")}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" >Fecha Visita</label>
                                                <p name="name" id="asunto" placeholder="Name">{{$visita[0]->fecha_vi}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" >Hora Visita</label>
                                                <p name="name" id="asunto" placeholder="Name">{{$visita[0]->hora_vi}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="subject">Asunto</label>
                                                <p name="name" id="asunto" placeholder="Name">{{$visita[0]->asunto_vi}}</p>
                                                <!--<input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto de la visita..." value="">-->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="subject">Cliente Visita</label>
                                                <p name="name" id="asunto" placeholder="Name">{{$cliente[0]->nombre_us}} {{$cliente[0]->apellido1_us}}</p>
                                                <!--<input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto de la visita..." value="">-->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="productos" class="label" for="#">Selecciona paciente:</label>
                                                <select id="productos" name="id_paciente">        
                                                    @for ($i = 0; $i < count($pacientes); $i++)
                                                        <option class="form-control"  value="{{$pacientes[$i]->id_pa}}">{{$pacientes[$i]->nombre_pa}}</option>
                                                    @endfor
                                                        <!--<option class="form-control"  value="paco">Paquito</option>-->
                                                    
                                                </select>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" value="{{$visita[0]->id_vi}}" name="id_visita">
                                                <input type="submit" value="Asociar paciente" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap w-100 p-5 img" style="background-image:url(storage/uploads/incognito.png); background-size: fill;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script defer src="./js/visita/script.js"></script>
<script src="./js/visita/ajax_ru_visitas_directorio.js"></script>
</html>
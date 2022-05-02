window.onload = function() {
    eventos = [];
    calendar();
}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

//Recogida de datos SQL + inserción de los mismo en la API
function calendar() {
    //Inicialización objeto Ajax
    var ajax = objetoAjax();
    //Nuevo objeto
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'GET');

    //Datos fichero web que apunta a la función que recoge el JSON
    ajax.open("GET", "showcitas", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //Json enviado desde el controler
            console.log(this.responseText);
            //JSON desde web file
            var citas = JSON.parse(this.responseText);
            //console.log(citas);
            for (let i = 0; i < citas.length; i++) {
                //Array global
                eventos.push({
                    title: "Agendada",
                    start: citas[i].fecha_vi + 'T' + citas[i].hora_vi,
                    borderColor: '#8590FF'
                })
            }
            //Funcion API
            montarCalendario();
        }
    }
    ajax.send(formdata);
}

//Inserción de citas
function insertDatas() {
    //Recogemos los datos del Form
    //formdata.append('fecha_vi', document.getElementById('fecha_vi').value);

    var fecha_vi = document.getElementById('fecha_vi').value;
    var hora_vi = document.getElementById('hora_vi').value;
    var an_asociado = document.getElementById('an_asociado').value;
    var asunto_vi = document.getElementById('asunto_vi').value;
    var id_us = document.getElementById('id_us').value;

    //Validación de datos
    if (fecha_vi == "" || hora_vi == "" || asunto_vi == "") {
        alertify.error('Rellene los campos obligatorios *');
    }

    //inicializamos objeto ajax
    var ajax = objetoAjax();
    //Nuevo objeto, añadimos datos al objeto, como las variables previamente recogidas, token, método..., etc
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('fecha_vi', fecha_vi);
    formdata.append('hora_vi', hora_vi);
    formdata.append('an_asociado', an_asociado);
    formdata.append('asunto_vi', asunto_vi);
    formdata.append('id_us', id_us);
    formdata.append('_method', 'POST');


    ajax.open("POST", "insertcita", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText);
            var respuesta = JSON.parse(this.responseText);
            if (respuesta.resultado == "OK") {
                alertify
                    .alert("Información de la visita", "Se enviará un mail a tu dirección de correo electrónico con toda la información de la cita", function() {
                        alertify.success('Visita agendada correctamente');
                    });
            } else {
                alert("Error:" + respuesta.resultado);
            }
            //Limpiamos Array
            vaciarArrEventos();
            //Iteramos eventos
            calendar();
            //Montamos el calendario
            montarCalendario();
        }
    }
    ajax.send(formdata);
}

//API
function montarCalendario() {
    var calendarEl = document.getElementById('calendar');
    //calendarEl = "";
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        //Language
        locale: "es",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek',
            borderColor: '#8590FF',
        },
        //Recogemos los campos previamente rellenados
        events: eventos,
    });
    calendar.render();
}

//Sin esta función cada vez que añadamos nuevos datos se duplicarán en la api
function vaciarArrEventos() {
    eventos = [];
    var calendarEl = document.getElementById('calendar');
    calendarEl = "";
}

//Modal form de citas
function modalCitas() {
    // Get the modal
    var modal = document.getElementById("modalCitas");

    // Get the button that opens the modal
    //var btn = document.getElementById("btnModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal 

    modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

}

function hourOptions() {
    //Fecha
    var fecha_vi = document.getElementById('fecha_vi').value;
    var fecha_comp = fecha_comp.toLocaleDateString();
    alert(fecha_comp);
    //Hora
    var currentTime = new Date();
    currentTime = currentTime.getHours();
    var res = 24 - currentTime;
    var horasDispo = "";
    for (let index = currentTime; index < 24; index++) {
        horasDispo += "<option value='" + index + ":00'>" + index + ":00 </option>";
    }
    document.getElementById('hora_vi').innerHTML = horasDispo;
    /* "<option value='01:00'>01:00 a.m</option>" + +
    "<option value='02:00'>02:00 a.m</option>" +
    "<option value='03:00'>03:00 a.m</option>" +
    "<option value='04:00'>04:00 a.m</option>" +
    "<option value='05:00'>05:00 a.m</option>" +
    "<option value='06:00'>06:00 a.m</option>" +
    "<option value='07:00'>07:00 a.m</option>" +
    "<option value='08:00'>08:00 a.m</option>" +
    "<option value='09:00'>09:00 a.m</option>" +
    "<option value='10:00'>10:00 a.m</option>" +
    "<option value='11:00'>11:00 a.m</option>" +
    "<option value='12:00'>12:00 p.m</option>" +
    "<option value='13:00'>13:00 p.m</option>" +
    "<option value='14:00'>14:00 p.m</option>" +
    "<option value='15:00'>15:00 p.m</option>" +
    "<option value='16:00'>16:00 p.m</option>" +
    "<option value='17:00'>17:00 p.m</option>" +
    "<option value='18:00'>18:00 p.m</option>" +
    "<option value='19:00'>19:00 p.m</option>" +
    "<option value='20:00'>20:00 p.m</option>" +
    "<option value='21:00'>21:00 p.m</option>" +
    "<option value='22:00'>22:00 p.m</option>" +
    "<option value='23:00'>23:00 p.m</option>"; */

}
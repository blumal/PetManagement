//Verificación select
function hourOptions() {
    //Fecha
    var fecha_vi = document.getElementById('fecha_vi').value;
    //Hora
    var currentTime = new Date();
    var year = currentTime.getFullYear();
    var mes = currentTime.getMonth();
    var mes = mes + 1;
    var horas = new Date();
    horas = horas.getHours();
    dia = currentTime.getDate();
    var horasDispo = "";

    if ((mes) < 10) {
        mes = "0" + mes;
    }

    if (dia < 10) {
        dia = "0" + dia;
    }

    if ((year + "-" + mes + "-" + dia) == fecha_vi) {
        for (let index = horas; index < 24; index++) {
            horasDispo += "<option value='" + index + ":00'>" + index + ":00 </option>";
        }
    } else {
        for (let index = 0; index < 24; index++) {
            horasDispo += "<option value='" + index + ":00'>" + index + ":00 </option>";
        }
    }
    document.getElementById('hora_vi').innerHTML = horasDispo;
}

//Objeto ajax
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

function UpdateQuote(){
    //Variables
    var fecha_vi = document.getElementById('fecha_vi').value;
    var hora_vi = document.getElementById('hora_vi').value;

    //Validación datos cliente
    if (fecha_vi == '' && hora_vi == ''){
        alertify.error("Los campos fecha y hora son obligatorios *");
    }else if(fecha_vi == ''){
        alertify.warning("Rellene el campo fecha *");
    }

    //Inicialización objeto Ajax
    var ajax = objetoAjax();
    //Nuevo objeto
    formdata = new FormData();
    //Datos del html
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');
    formdata.append('id_vi', document.getElementById('id_vi').value);
    formdata.append('email_us', document.getElementById('email_us').value);
    formdata.append('fecha_vi', fecha_vi);
    formdata.append('hora_vi', hora_vi);

    //Datos fichero web que apunta a la función que recoge el JSON
    //Debo volver a la raíz para poder llamar a la ruta
    ajax.open("POST", "../updatingquote", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText);
            var reply = JSON.parse(this.responseText);
            if (reply.result == "OK") {
                //Intercambio los datos antiguos con los actualizados
                document.getElementById('fecha_old').value = document.getElementById('fecha_vi').value;
                document.getElementById('hora_old').value = document.getElementById('hora_vi').value;
                alertify
                    .alert("Actualización de visitas", "Se ha enviado un mail al cliente con las modificaciones previamente efectuadas", function() {
                        alertify.success('Visita modificada correctamente');
                    });
            } else {
                alertify.error("Ha ocurrido un error en la actualización de datos");
            }
        }
    }
    ajax.send(formdata);
}

function preChange(id_vi){
    swal({
            title: "¿Segur@ de que deseas iniciar la cita?",
            text: "La acción no se podrá revertir!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("La cita se ha iniciado correctamente :)", {
                    icon: "success",
                });
                changeStatus(id_vi);
            }
        });
}

function changeStatus(id_vi){
    //Inicialización objeto Ajax
    var ajax = objetoAjax();

    //Nuevo objeto
    formdata = new FormData();

    //Datos del form
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'PUT');
    formdata.append('id_vi', id_vi);

    //Datos fichero web que apunta a la función que recoge el JSON
    //Debo volver a la raíz para poder llamar a la ruta
    ajax.open("POST", "../updatestatus/" + id_vi, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText);
            var reply = JSON.parse(this.responseText);
            if (reply.result == "OK") {
                console.log('success');
            } else {
                swal("Opss...", "Error: " + result);
            }
        }
    }
    ajax.send(formdata);
}
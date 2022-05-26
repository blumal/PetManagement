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

//Validación de datos
function validateContacto() {
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var correo = document.getElementById('correo').value;
    var mensaje = document.getElementById('mensaje').value;

    if (nombre == "" && apellido == "" && correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "" && apellido == "" && correo == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "" && apellido == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "" && correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (apellido == "" && correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "" && apellido == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "" && correo == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (apellido == "" && correo == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (apellido == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    } else if (nombre == "") {
        alertify.error('Te has olvidado escribir el nombre');
        return false;
    } else if (apellido == "") {
        alertify.error('Te has olvidado escribir el apellido');
        return false;
    } else if (correo == "") {
        alertify.error('Te has olvidado escribir el correo');
        return false;
    } else if (mensaje == "") {
        alertify.error('Te has olvidado escribir un mensaje');
        return false;
    } else {
        enviarCorreo(nombre, apellido, correo, mensaje)
        return false;
    }
}

function enviarCorreo(nombre, apellido, correo, mensaje) {

    var formData = new FormData();

    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('nombre', nombre);
    formData.append('apellido', apellido);
    formData.append('correo', correo);
    formData.append('mensaje', mensaje);

    var ajax = objetoAjax();
    ajax.open("POST", "enviarCorreoContacto", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText)
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta['resultado']);
            if (respuesta['resultado'] == "OK") {
                alertify.success('Se ha enviado el correo satisfactoriamente');
                document.getElementById("submitContacto").disabled = true;
                return true;
            } else {
                alertify.error('Ha habido un problema al mandar el correo');
                return false;
            }
        }
    }
    ajax.send(formData);
}
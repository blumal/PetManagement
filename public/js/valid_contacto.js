//Validación de datos
function validateContacto(){
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var correo = document.getElementById('correo').value;
    var mensaje = document.getElementById('mensaje').value;

    if (nombre == "" && apellido == "" && correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "" && apellido == "" && correo == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "" && apellido == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "" && correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (apellido == "" && correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "" && apellido == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "" && correo == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (apellido == "" && correo == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (apellido == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (correo == "" && mensaje == "") {
        alertify.error('Te has dejado campos por rellenar');
        return false;
    }else if (nombre == "") {
        alertify.error('Te has olvidado escribir el nombre');
        return false;
    }else if (apellido == "") {
        alertify.error('Te has olvidado escribir el apellido');
        return false;
    }else if (correo == "") {
        alertify.error('Te has olvidado escribir el correo');
        return false;
    }else if (mensaje == "") {
        alertify.error('Te has olvidado escribir un mensaje');
        return false;
    }else{
        return true;
    }
}
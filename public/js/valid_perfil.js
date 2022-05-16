//Validación de datos
function validatePerfil(){
    var pass_us = document.getElementById('pass_us').value;
    var pass_us = document.getElementById('pass_us').value;
    var email_us = document.getElementById('email_us').value;
    var contacto1_tel = document.getElementById('contacto1_tel').value;
    var nombre_di = document.getElementById('nombre_di').value;
    var cp_di = document.getElementById('cp_di').value;
    var numero_di = document.getElementById('numero_di').value;
    var piso_di = document.getElementById('piso_di').value;
    var puerta_di = document.getElementById('puerta_di').value;

    if (pass_us == "" || pass_us == "" || email_us == "" || contacto1_tel == "" || nombre_di == "" || cp_di == "" || numero_di == "" || piso_di == "" || puerta_di == "") {
        alertify.error('Rellene los campos obligatorios marcados con un *');
        return false;
    }else{
        return true;
    }
}
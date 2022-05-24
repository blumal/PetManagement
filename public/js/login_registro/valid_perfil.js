//Validación de datos
function validatePerfil() {
    var nombre_us = document.getElementById('nombre_us').value;
    var apellido1_us = document.getElementById('apellido1_us').value;
    var email_us = document.getElementById('email_us').value;
    var contacto1_tel = document.getElementById('contacto1_tel').value;
    var nombre_di = document.getElementById('nombre_di').value;
    var cp_di = document.getElementById('cp_di').value;
    var numero_di = document.getElementById('numero_di').value;

    if (nombre_us == "" || apellido1_us == "" || email_us == "" || contacto1_tel == "" || nombre_di == "" || cp_di == "" || numero_di == "") {
        console.log("falso")
        alertify.error('Rellene los campos obligatorios marcados con un *');

        return false;
    } else {
        console.log("true")
        return true;
    }
}
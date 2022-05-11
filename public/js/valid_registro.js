//Validación de datos
function validateRegistro(){
    var nombre_us = document.getElementById('nombre_us').value;
    var dni_us = document.getElementById('dni_us').value;
    var apellido1_us = document.getElementById('apellido1_us').value;
    var apellido2_us = document.getElementById('apellido2_us').value;
    var pass_us = document.getElementById('pass_us').value;
    var pass_us = document.getElementById('pass_us').value;
    var email_us = document.getElementById('email_us').value;
    var contacto1_tel = document.getElementById('contacto1_tel').value;
    var nombre_di = document.getElementById('nombre_di').value;
    var cp_di = document.getElementById('cp_di').value;
    var numero_di = document.getElementById('numero_di').value;
    var piso_di = document.getElementById('piso_di').value;
    var puerta_di = document.getElementById('puerta_di').value;

    if (nombre_us == "" || dni_us == "" || apellido1_us == "" || apellido2_us == "" || pass_us == "" || pass_us == "" || email_us == "" || contacto1_tel == "" || nombre_di == "" || cp_di == "" || numero_di == "" || piso_di == "" || puerta_di == "") {
        alertify.error('Rellene los campos obligatorios marcados con un *');
    }
}
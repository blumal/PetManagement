const { subtract, toUpper } = require("lodash");

//Validación de datos
function validateRegistro() {


    var nombre_us = document.getElementById('nombre_us').value;
    var dni_us = document.getElementById('dni_us').value;
    var apellido1_us = document.getElementById('apellido1_us').value;
    var apellido2_us = document.getElementById('apellido2_us').value;
    var pass_us1 = document.getElementById('pass_us1').value;
    var pass_us2 = document.getElementById('pass_us2').value;
    var email_us = document.getElementById('email_us').value;
    var contacto1_tel = document.getElementById('contacto1_tel').value;
    var nombre_di = document.getElementById('nombre_di').value;
    var cp_di = document.getElementById('cp_di').value;
    var numero_di = document.getElementById('numero_di').value;
    var piso_di = document.getElementById('piso_di').value;
    var puerta_di = document.getElementById('puerta_di').value;

    if (nombre_us == "" || dni_us == "" || apellido1_us == "" || pass_us1 == "" || pass_us2 == "" || email_us == "" || contacto1_tel == "" || nombre_di == "" || cp_di == "" || numero_di == "") {
        alertify.error('Rellene los campos obligatorios marcados con un *');
        console.log("falso")
        return false;
    } else {

        if (dni_us.length != 9) {
            alertify.error('El DNI no es correcto');
            return false;
        } else {
            letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"]
            dni_us_digi = dni_us.substr(0, 8)
            resto = dni_us_digi % 23

            if (letras[resto] == dni_us.substr(8).toUpperCase()) {
                return true;
            } else {
                return false;
            }
        }
    }
}
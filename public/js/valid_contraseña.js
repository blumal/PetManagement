//Validación de datos
function validateContraseña(){
    var email_us = document.getElementById('email_us').value;

    if (email_us == "") {
        alertify.error('Escribe un correo para recuperar la contraseña.');
        return false;
    }else{
        alertify.success('Se te ha enviado un correo con tu contraseña.');
        
    }
}
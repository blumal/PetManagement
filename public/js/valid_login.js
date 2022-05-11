//Validación de datos
function validateLogin(){
    var email_us = document.getElementById('email_us').value;
    var pass_us = document.getElementById('pass_us').value;

    if (email_us == "" && pass_us == "") {
        alertify.error('El usuario y la contraseña están vacios');
        return false;
    }else if(email_us == ""){
        alertify.error('El usuario está vacío');
        return false;
    }else if(pass_us == ""){
        alertify.error('La contraseña está vacía');
        return false;
    }else{
        return true;
    }
}
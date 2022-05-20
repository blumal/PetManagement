window.onload = function() {
    hourOptions();
}

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

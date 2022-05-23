console.log("Entramos en el JS")

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

function leerVisitas() {
    var div_visitas = document.getElementById("div_visitas");
    var fecha_visita = document.getElementById("fecha_visita").value;
    var token = document.getElementById('token').getAttribute("content");

    if (fecha_visita == "") {
        let yourDate = new Date()
        fecha = yourDate.toISOString().split('T')[0]
        fecha_visita = fecha
    }

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('fecha_visita', fecha_visita);
    visita = ""

    //estoy filtrando el valor, si es 0 es el valor del texto
    // y si es diferente de 0 es el valor de los botones "String"

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    //abrimos la ruta web pasando el objeto ajax con todas las variables
    ajax.open("POST", "leer_visitas", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)

            for (let i = 0; i < respuesta.length; i++) {
                visita += '<div class="column-3">' +
                    '<div class="seccion">'

                if (respuesta[i]['nombre_pa'] == null) {
                    visita += '<form action="/asociarPacienteVisita" method="post">' +
                        'Factura ' + respuesta[i]['fecha_vi'] +
                        '<br><br>Propietario -> ' + respuesta[i]['nombre_us'] +
                        '<br><br>' +
                        '<input type="hidden" name="_token" value="' + token + '">' +
                        '<input type="hidden" name="id_usuario" value="' + respuesta[i]['id_us'] + '">' +
                        '<input type="hidden" name="id_visita" value="' + respuesta[i]['id_vi'] + '">' +
                        '<input class="ver_factura" type="submit" value="Asociar paciente">' +
                        '</form>' +
                        '<br>' +
                        '</div>' +
                        '</div>'
                } else {
                    visita += '<form action="/generarFactura" method="post">' +
                        'Factura ' + respuesta[i]['fecha_vi'] +
                        '<br><br>Paciente -> ' + respuesta[i]['nombre_pa'] +
                        '<br><br>Propietario -> ' + respuesta[i]['nombre_us'] +
                        '<br><br>' +
                        '<input type="hidden" name="_token" value="' + token + '">' +

                        '<input type="hidden" name="id_visita" value="' + respuesta[i]['id_vi'] + '">' +
                        '<input class="ver_factura" type="submit" value="Rellenar factura">' +
                        '</form>' +
                        '<br>' +
                        '</div>' +
                        '</div>'
                }


            }
            div_visitas.innerHTML = visita

        }

    }
    ajax.send(formData);
}

function validarFacturas() {

    total_factura = document.getElementById('total_factura').value
    fecha_factura = document.getElementById('fecha_factura').value
    hora_factura = document.getElementById('hora_factura').value
    diagnostico = document.getElementById('diagnostico').value

    if (total_factura == "" || fecha_factura == "" || hora_factura == "" || diagnostico == "") {
        alertify.error('Rellene los campos obligatorios');
        return false;
    } else {
        return true;
    }
}
leerVisitas();
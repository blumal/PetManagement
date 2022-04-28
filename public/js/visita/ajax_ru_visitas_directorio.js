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
                    '<div class="seccion">' +
                    '<form action="/generarFactura" method="post">' +
                    'Factura ' + respuesta[i][0]['fecha_vi'] +
                    '<br><br>Animal ' + respuesta[i][0]['nombre_pa'] +
                    '<br><br>Cliente ' + respuesta[i][0]['nombre_us'] +
                    '<br><br>' +
                    '<input type="hidden" name="_token" value="' + token + '">' +

                    '<input type="hidden" name="id_visita" value="' + respuesta[i][0]['id_vi'] + '">' +
                    '<input class="ver_factura" type="submit" value="Rellenar factura">' +
                    '</form>' +
                    '<br>' +
                    '</div>' +
                    '</div>'
            }
            div_visitas.innerHTML = visita

        }

    }
    ajax.send(formData);
}
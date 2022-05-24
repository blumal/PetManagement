console.log("Entramos en el JS")
    //este es el objeto de ajax el cual nos permitira hacer todas las peticiones XMLHTTP
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

function leerPacientes() {
    tabla = document.getElementById('mytable');

    var formData = new FormData();
    var token = document.getElementById('token').getAttribute("content");
    var busqueda = document.getElementById('search').value;

    formData.append('_token', token);
    formData.append('nombre_paciente', busqueda);
    var ajax = objetoAjax();
    ajax.open("POST", "leerPacientes", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            tabla.innerHTML = ""
            tabla.innerHTML = "<tr class='fila-1'>" +
                "<th scope='col'>Foto</th>" +
                "<th scope='col'>Nombre</th>" +
                "<th scope='col'>Peso (kg)</th>" +
                "<th scope='col'>Nº Identifiación</th>" +
                "<th scope='col'>Propietario</th>" +
                "<th scope='col'>Fecha nacimiento</th>" +
                "<th scope='col'>Nombre científico</th>" +
                "<th scope='col'>Raza</th>" +
                "<th scope='col'>Editar</th>" +
                "<th scope='col'>Activar/Desactivar</th>" +
                "</tr>"
            for (let i = 0; i < respuesta.length; i++) {

                if (respuesta[i].raza_pa == null) {
                    respuesta[i].raza_pa = ""
                }
                if (respuesta[i].n_id_nacional == null) {
                    respuesta[i].n_id_nacional = ""
                }
                if (respuesta[i].activo == 1) {
                    tabla.innerHTML += "<tr class='fila-2'>" +
                        "<td><img src='../storage/" + respuesta[i].foto_pa + "' class='avatar' ></td>" +
                        "<td>" + respuesta[i].nombre_pa + "</td>" +
                        "<td>" + respuesta[i].peso_pa + "</td>" +
                        "<td>" + respuesta[i].n_id_nacional + "</td>" +
                        "<td>" + respuesta[i].nombre_us + " " + respuesta[i].apellido1_us + "</td>" +
                        "<td>" + respuesta[i].fecha_nacimiento + "</td>" +
                        "<td>" + respuesta[i].nombrecientifico_pa + "</td>" +
                        "<td>" + respuesta[i].raza_pa + "</td>" +
                        "<td>" +
                        "<form action='/editarPaciente' method='post'>" +
                        "<input type='hidden' name='_token' id='csrf-token' value=" + token + " />" +
                        "<input type='hidden' name='id_paciente' value=" + respuesta[i].id_pa + ">" +
                        "<input type='submit' value='Editar' class='btn btn-secondary'>" +
                        "</form>" +
                        "</td>" +
                        "<td>" +
                        "<button type='button' class='btn btn-danger' onclick='eliminarPaciente(" + respuesta[i].id_pa + ")'>Desactivar</button>" +
                        "</td>"
                } else {
                    tabla.innerHTML += "<tr class='fila-2'>" +
                        "<td><img src='../storage/" + respuesta[i].foto_pa + "' class='avatar' style='filter: grayscale(100%);'></td>" +
                        "<td>" + respuesta[i].nombre_pa + "</td>" +
                        "<td>" + respuesta[i].peso_pa + "</td>" +
                        "<td>" + respuesta[i].n_id_nacional + "</td>" +
                        "<td>" + respuesta[i].nombre_us + " " + respuesta[i].apellido1_us + "</td>" +
                        "<td>" + respuesta[i].fecha_nacimiento + "</td>" +
                        "<td>" + respuesta[i].nombrecientifico_pa + "</td>" +
                        "<td>" + respuesta[i].raza_pa + "</td>" +
                        "<td>" +
                        "<form action='/editarPaciente' method='post'>" +
                        "<input type='hidden' name='_token' id='csrf-token' value=" + token + " />" +
                        "<input type='hidden' name='id_paciente' value=" + respuesta[i].id_pa + ">" +
                        "<input type='submit' value='Editar' class='btn btn-secondary'>" +
                        "</form>" +
                        "</td>" +
                        "<td>" +
                        "<button type='button' class='btn btn-success' onclick='activarPaciente(" + respuesta[i].id_pa + ")'>Activar</button>" +
                        "</td>"
                }

            }
        }
    }
    ajax.send(formData);
}

function eliminarPaciente(id_paciente) {
    if (window.confirm("Quieres desactivar al paciente?")) {
        var formData = new FormData();

        formData.append('_token', document.getElementById('token').getAttribute("content"));
        formData.append('id_paciente', id_paciente);

        var ajax = objetoAjax();
        ajax.open("POST", "eliminarPaciente", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                console.log(this.responseText)
                var respuesta = JSON.parse(this.responseText);
                console.log(respuesta);
                if (respuesta == "OK") {
                    document.getElementById('mensaje').style.color = "red";
                    document.getElementById('mensaje').innerHTML = "Registro desactivado correctamente"
                } else {
                    document.getElementById('mensaje').innerHTML = "Registro no desactivado"
                }
            }
        }
        ajax.send(formData);

    }
    leerPacientes()
}

function activarPaciente(id_paciente) {
    if (window.confirm("Quieres activar al paciente?")) {
        var formData = new FormData();

        formData.append('_token', document.getElementById('token').getAttribute("content"));
        formData.append('id_paciente', id_paciente);

        var ajax = objetoAjax();
        ajax.open("POST", "activarPaciente", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                console.log(respuesta);
                if (respuesta == "OK") {
                    document.getElementById('mensaje').style.color = "red";
                    document.getElementById('mensaje').innerHTML = "Registro activado correctamente"
                } else {
                    document.getElementById('mensaje').innerHTML = "Registro no activado"
                }
            }
        }
        ajax.send(formData);

    }
    leerPacientes()
}

function calcular_total(e) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    cantidades = document.getElementsByName('cantidad[]');

    formData.append('id_promo', id_promocion);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    //abrimos la ruta web pasando el objeto ajax con todas las variables
    ajax.open("POST", "calcular_total", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
        }
    }
    ajax.send(formData);
}

function validarCreacionEdicionPaciente() {

    nombre = document.getElementById('name').value
    nombre_cientifico_paciente = document.getElementById('nombre_cientifico_paciente').value
    peso_paciente = document.getElementById('peso_paciente').value
    fecha_nacimiento_paciente = document.getElementById('fecha_nacimiento_paciente').value

    if (nombre == "" || nombre_cientifico_paciente == "" || peso_paciente == "" || fecha_nacimiento_paciente == "") {
        alertify.error('Rellene los campos obligatorios');
        return false;
    } else {
        return true;
    }

}
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

function cambiarRol(id_user, mail) {
    var id_rol = document.getElementById(mail).value

    var formData = new FormData();
    var token = document.getElementById('token').getAttribute("content");

    formData.append('_token', token);
    formData.append('id_rol', id_rol);
    formData.append('id_user', id_user);

    var ajax = objetoAjax();
    ajax.open("POST", "cambiarRol", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {

            var respuesta = JSON.parse(this.responseText);
            if (respuesta == "OK") {
                document.getElementById('mensaje').style.color = "green";
                document.getElementById('mensaje').innerHTML = "Rol ajustado correctamente"
            } else {
                document.getElementById('mensaje').style.color = "red";
                document.getElementById('mensaje').innerHTML = "Rol ajustado incorrectamente. Intentalo de nuevo más tarde"
            }

        }
    }
    ajax.send(formData);
}

function leerClientes() {
    tabla = document.getElementById('mytable');

    var formData = new FormData();
    var token = document.getElementById('token').getAttribute("content");
    var busqueda = document.getElementById('search').value;

    console.log(busqueda)

    formData.append('_token', token);
    formData.append('nombre_usuario', busqueda);
    var ajax = objetoAjax();
    ajax.open("POST", "leerClientes", true);
    ajax.onreadystatechange = function() {
        console.log(respuesta)
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            tabla.innerHTML = ""
            tabla.innerHTML = "<tr class='fila-1'>" +
                "<th scope='col'>Nombre</th>" +
                "<th scope='col'>Apellidos</th>" +
                "<th scope='col'>DNI</th>" +
                "<th scope='col'>eMail</th>" +
                "<th scope='col'>Numero de telefono</th>" +
                "<th scope='col'>Domicilio</th>" +
                "<th scope='col'>Rol</th>" +
                "<th scope='col'>Activar/Desactivar</th>" +
                "</tr>"
            for (let i = 0; i < respuesta.length; i++) {

                if (respuesta[i].piso_di == null) {
                    respuesta[i].piso_di = ""
                }
                if (respuesta[i].puerta_di == null) {
                    respuesta[i].puerta_di = ""
                }
                if (respuesta[i].apellido2_us == null) {
                    respuesta[i].apellido2_us = ""
                }

                if (respuesta[i].id_rol_fk == 1) {
                    respuesta[i].id_rol_fk_name = "Admin"
                } else if (respuesta[i].id_rol_fk == 3) {
                    respuesta[i].id_rol_fk_name = "Trabajador"
                } else {
                    respuesta[i].id_rol_fk_name = "Cliente"
                }

                var select_rol = ""
                if (respuesta[i].id_rol_fk == 1) {
                    select_rol = "<option selected value = 1>Admin</option>" +
                        "<option value = 2>Cliente </option>" +
                        "<option value = 3>Trabajador</option>"
                } else if (respuesta[i].id_rol_fk == 2) {
                    select_rol = "<option value = 1>Admin</option>" +
                        "<option selected value = 2>Cliente </option>" +
                        "<option value = 3> Trabajador</option>"
                } else {
                    select_rol = "<option value = 1>Admin</option>" +
                        "<option value = 2> Cliente </option>" +
                        "<option selected value = 3> Trabajador</option>"
                }

                var user_activo = ""
                if (respuesta[i].activo_us == 1) {
                    user_activo = "<td>" +
                        "<button type='button' class='btn btn-danger' onclick='eliminarCliente(" + respuesta[i].id_us + ")'>Desactivar</button>" +
                        "</td>"
                } else {
                    user_activo = "<td>" +
                        "<button type='button' class='btn btn-success' onclick='activarCliente(" + respuesta[i].id_us + ")'>Activar</button>" +
                        "</td>"
                }

                tabla.innerHTML += "<tr class='fila-2'>" +
                    "<td>" + respuesta[i].nombre_us + "</td>" +
                    "<td>" + respuesta[i].apellido1_us + " " + respuesta[i].apellido2_us + "</td>" +
                    "<td>" + respuesta[i].dni_us + "</td>" +
                    "<td>" + respuesta[i].email_us + "</td>" +
                    "<td>" + respuesta[i].contacto1_tel + "</td>" +
                    "<td>" + respuesta[i].nombre_di + " " + respuesta[i].numero_di + ", " + respuesta[i].piso_di + " " + respuesta[i].puerta_di + ", " + respuesta[i].cp_di + "</td>" +
                    "<td>" +
                    "<select name='id_rol' id=" + respuesta[i].email_us + " onchange=cambiarRol(" + respuesta[i].id_us + ",'" + respuesta[i].email_us + "')> " +
                    select_rol +
                    "</select>" +
                    "</td>" +
                    user_activo
            }
        }
    }
    ajax.send(formData);
}

function eliminarCliente(id_cliente) {
    if (window.confirm("Quieres desactivar al cliente?")) {
        var formData = new FormData();

        formData.append('_token', document.getElementById('token').getAttribute("content"));
        formData.append('id_cliente', id_cliente);

        var ajax = objetoAjax();
        ajax.open("POST", "eliminarCliente", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                console.log(this.responseText)
                var respuesta = JSON.parse(this.responseText);
                console.log(respuesta);
                if (respuesta == "OK") {
                    document.getElementById('mensaje').style.color = "red";
                    document.getElementById('mensaje').innerHTML = "Cliente desactivado correctamente"
                } else {
                    document.getElementById('mensaje').innerHTML = "Cliente no desactivado"
                }
            }
        }
        ajax.send(formData);

    }
    leerClientes()
}

function activarCliente(id_cliente) {
    if (window.confirm("Quieres activar al cliente?")) {
        var formData = new FormData();

        formData.append('_token', document.getElementById('token').getAttribute("content"));
        formData.append('id_cliente', id_cliente);

        var ajax = objetoAjax();
        ajax.open("POST", "activarCliente", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                console.log(respuesta);
                if (respuesta == "OK") {
                    document.getElementById('mensaje').style.color = "red";
                    document.getElementById('mensaje').innerHTML = "Cliente activado correctamente"
                } else {
                    document.getElementById('mensaje').innerHTML = "Cliente no activado"
                }
            }
        }
        ajax.send(formData);

    }
    leerClientes()
}
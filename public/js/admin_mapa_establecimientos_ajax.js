window.onload = function() {
    leerJS();
    // Get the modal
    modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var cerrar = document.getElementById("cerrar");
    // When the user clicks on <span> (x), close the modal
    cerrar.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

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

function leerJS() {
    //Cogemos el elemento correspondiente al id y lo almacenamos en una variable
    var tabla = document.getElementById("tabla");
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'get');
    formData.append('filtro', document.getElementById('filtro').value);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "filtroMapasEstablecimientos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<br>'
            recarga += '<div>';
            recarga += '<tr><th>NOMBRE</th><th>NIF</th><th>EMAIL</th><th>HORARIO APERTURA</th><th>HORARIO CIERRE</th><th>TELF1</th><th>TELF2</th><th>DIRECCION</th><th>NÚMERO</th><th>CP</th><th>FOTO</th><th>TIPO</th><th>Modificar</th><th>Eliminar</th></th>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr>';
                recarga += '<td>' + respuesta[i].nombre_s + '</td>'
                recarga += '<td>' + respuesta[i].nif_s + '</td>'
                recarga += '<td>' + respuesta[i].email_s + '</td>'
                recarga += '<td>' + respuesta[i].horario_apertura_s + '</td>'
                recarga += '<td>' + respuesta[i].horario_cierre_s + '</td>'
                recarga += '<td>' + respuesta[i].contacto1_tel + '</td>'
                recarga += '<td>' + respuesta[i].contacto2_tel + '</td>'
                recarga += '<td>' + respuesta[i].nombre_di + '</td>'
                recarga += '<td>' + respuesta[i].numero_di + '</td>'
                recarga += '<td>' + respuesta[i].cp_di + '</td>'
                recarga += '<td>foto</td>'
                recarga += '<td>' + respuesta[i].sociedad_ts + '</td>'
                recarga += '<td><button onclick="modificar(' + respuesta[i].id_s + ',\'' + respuesta[i].nombre_s + '\',\'' + respuesta[i].horario_apertura_s + '\',\'' + respuesta[i].horario_cierre_s + '\',\'' + respuesta[i].contacto1_tel + '\',\'' + respuesta[i].contacto2_tel + '\',\'' + respuesta[i].nombre_di + '\',\'' + respuesta[i].numero_di + '\',\'' + respuesta[i].cp_di + '\',\'' + respuesta[i].id_tel + '\',\'' + respuesta[i].id_di + '\',\'' + respuesta[i].id_ts + '\'); return false;">Modificar</button></td>'
                recarga += '<td><button onclick="borrar(' + respuesta[i].id_s + ',\'' + respuesta[i].id_tel + ',\'' + respuesta[i].id_di + ',\'' + respuesta[i].id_ts + '\'); return false;">Eliminar</button></td>'
                recarga += '</tr>';
                recarga += '</div>'
            }
            //Introducimos la recarga en la tabla
            tabla.innerHTML = recarga;
        }
    }
    ajax.send(formData);
}

function modificar(id_s, nombre_s, horario_apertura_s, horario_cierre_s, contacto1_tel, contacto2_tel, nombre_di, numero_di, cp_di, id_tel, id_di, id_ts) {
    modal.style.display = "block";
    enter = document.getElementById("contenido")
    var contenido = ''
    contenido += '<form onsubmit="editar(); return false;">'
    contenido += '<h3><b>Modificar</b></h3><br>'
    contenido += '<p><b>Nombre</b><p>'
    contenido += '<input type="text" id="nombre_s" value="' + nombre_s + '"><br>'
    contenido += '<p><b>Horario apertura</b><p>'
    contenido += '<input type="time" id="horario_apertura_s" value="' + horario_apertura_s + '">'
    contenido += '<p><b>Horario cierre</b><p>'
    contenido += '<input type="time" id="horario_cierre_s" value="' + horario_cierre_s + '">'
    contenido += '<p><b>Contacto 1</b><p>'
    contenido += '<input type="number" id="contacto1_tel" value="' + contacto1_tel + '">'
    contenido += '<p><b>Contacto 2</b><p>'
    contenido += '<input type="number" id="contacto2_tel" value="' + contacto2_tel + '">'
    contenido += '<p><b>Direccion</b><p>'
    contenido += '<input type="text" id="nombre_di" value="' + nombre_di + '">'
    contenido += '<p><b>Numero</b><p>'
    contenido += '<input type="number" id="numero_di" value="' + numero_di + '">'
    contenido += '<p><b>CP</b><p>'
    contenido += '<input type="number" id="cp_di" value="' + cp_di + '">'
    contenido += '<p><b>Tipo Sociedad</b><p>'
    contenido += '<select name="tipo" id="tipo_s">'
    contenido += '<option value="clinica">Clínica</option>'
    contenido += '<option value="protectora">Protectora de animales</option>'
    contenido += '</select>'
    contenido += '<input type="hidden" id="id_s" value="' + id_s + '"><br><br/>'
    contenido += '<input type="hidden" id="id_tel" value="' + id_tel + '"><br><br/>'
    contenido += '<input type="hidden" id="id_di" value="' + id_di + '"><br><br/>'
    contenido += '<input type="hidden" id="id_ts" value="' + id_ts + '"><br><br/>'
    contenido += '<input type="submit" value="Modificar">'
    contenido += '</form>'
    enter.innerHTML = contenido;
}

function editar() {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'PUT');
    formData.append('nombre_s', document.getElementById('nombre_s').value);
    formData.append('horario_apertura_s', document.getElementById('horario_apertura_s').value);
    formData.append('horario_cierre_s', document.getElementById('horario_cierre_s').value);
    formData.append('contacto1_tel', document.getElementById('contacto1_tel').value);
    formData.append('contacto2_tel', document.getElementById('contacto2_tel').value);
    formData.append('nombre_di', document.getElementById('nombre_di').value);
    formData.append('numero_di', document.getElementById('numero_di').value);
    formData.append('cp_di', document.getElementById('cp_di').value);
    formData.append('tipo_s', document.getElementById('tipo_s').value);
    formData.append('id_s', document.getElementById('id_s').value);
    formData.append('id_tel', document.getElementById('id_tel').value);
    formData.append('id_di', document.getElementById('id_di').value);
    formData.append('id_ts', document.getElementById('id_ts').value);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "modificarMapasEstablecimientos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            /* Leerá la respuesta que es devuelta por el controlador: */
            if (respuesta.resultado == 'OK') {
                document.getElementById('mensaje').innerHTML = "Actualización correcta."
            } else if (respuesta.resultado == 'Contraseña no actualizada') {
                document.getElementById('mensaje').innerHTML = "Contraseña no actualizada."
            } else {
                document.getElementById('mensaje').innerHTML = "Fallo en la actualización: " + respuesta.resultado;
            }
            leerJS();
            modal.style.display = "none";

        }
    }

    ajax.send(formData);
}


//funcion de borrar con AJAX
function borrar(id_s, id_tel, id_di, id_ts) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');
    formData.append('id_s', id_s);
    formData.append('id_tel', id_tel);
    formData.append('id_di', id_di);
    formData.append('id_ts', id_ts);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "eliminar", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            /* Leerá la respuesta que es devuelta por el controlador: */
            if (respuesta.resultado == 'OK') {
                document.getElementById('mensaje').innerHTML = "Eliminacion correcta!!"
            } else {
                document.getElementById('mensaje').innerHTML = "Fallo en la eliminacion: " + respuesta.resultado;
            }
            leerJS();
        }
    }

    ajax.send(formData);
}

/* Función implementada con AJAX que inserta un archivo */
function crear() {
    let nombre = document.getElementById('nombre').value;
    let email = document.getElementById('email').value;
    let pwd = document.getElementById('pwd').value;
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('pwd', document.getElementById('pwd').value);
    formData.append('tipo_usu', document.getElementById('tipo_usu').value);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "crear", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            /* Leerá la respuesta que es devuelta por el controlador: */
            if (respuesta.resultado == 'OK') {
                document.getElementById('mensaje').innerHTML = "Inserción correcta."
            } else {
                document.getElementById('mensaje').innerHTML = "Fallo en la inserción: " + respuesta.resultado;
            }
            leerJS();
        }
    }

    ajax.send(formData);
}
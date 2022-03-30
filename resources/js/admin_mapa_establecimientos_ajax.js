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
    var tabla = document.getElementById("contenido");
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
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
            recarga += '<tr><th>NOMBRE</th><th>DIRECCION</th><th>TELF</th><th>HORARIO</th><th>WEB</th><th>FOTO</th><th>TIPO</th><th>Modificar</th><th>Eliminar</th></th>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr>';
                recarga += '<td>' + respuesta[i].nombre + '</td>'
                recarga += '<td>' + respuesta[i].direccion + '</td>'
                recarga += '<td>' + respuesta[i].telf + '</td>'
                recarga += '<td>' + respuesta[i].horarioa + '</td>'
                recarga += '<td>' + respuesta[i].horarioc + '</td>'
                recarga += '<td>' + respuesta[i].web + '</td>'
                recarga += '<td>' + respuesta[i].foto + '</td>'
                recarga += '<td>' + respuesta[i].tipo + '</td>'
                recarga += '<td><button onclick="modificar(' + respuesta[i].id + ',\'' + respuesta[i].nombre + '\',\'' + respuesta[i].direccion + '\'); return false;">Modificar</button></td>'
                recarga += '<td><button onclick="borrar(' + respuesta[i].id + '); return false;">Eliminar</button></td>'
                recarga += '</tr>';
                recarga += '</div>'
            }
            //Introducimos la recarga en la tabla
            tabla.innerHTML = recarga;
        }
    }

    ajax.send(formData);
}

function modificar(id, nombre, direccion, telf, horarioa, horarioc, web, foto, tipo) {
    modal.style.display = "block";
    enter = document.getElementById("contenido")
    var contenido = ''
    contenido += '<form onsubmit="editar(); return false;">'
    contenido += '<h3><b>Modificar</b></h3><br>'
    contenido += '<p><b>Nombre</b><p>'
    contenido += '<input type="text" id="nombre_modificar" value="' + nombre + '"><br>'
    contenido += '<p><b>Direccion</b><p>'
    contenido += '<input type="text" id="direccion_modificar" value="' + direccion + '">'
    contenido += '<p><b>Telf</b><p>'
    contenido += '<input type="number" id="telf_modificar" value="' + telf + '">'
    contenido += '<p><b>Horario apertura</b><p>'
    contenido += '<input type="time" id="horarioa_modificar" value="' + horarioa + '">'
    contenido += '<p><b>Horario cierre</b><p>'
    contenido += '<input type="time" id="horarioc_modificar" value="' + horarioc + '">'
    contenido += '<p><b>Web</b><p>'
    contenido += '<input type="text" id="web_modificar" value="' + web + '">'
    contenido += '<p><b>Foto</b><p>'
    contenido += '<input type="file" id="foto_modificar" value="' + foto + '">'
    contenido += '<p><b>Tipo</b><p>'
    contenido += '<input type="text" id="tipo_modificar" value="' + tipo + '">'
    contenido += '<select name="tipo" id="tipo">'
    contenido += '<option value="clinica">Clínica</option>'
    contenido += '<option value="protectora">Protectora de animales</option>'
    contenido += '</select>'
    contenido += '<input type="hidden" id="id" value="' + id + '"><br><br/>'
    contenido += '<input type="submit" value="Modificar">'
    contenido += '</form>'
    contenido += ''
    enter.innerHTML = contenido;
}

function editar() {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'PUT');
    formData.append('nombre', document.getElementById('nombre_modificar').value);
    formData.append('email', document.getElementById('email_modificar').value);
    formData.append('pwd', document.getElementById('pwd').value);
    formData.append('pwd_n', document.getElementById('pwd_nueva').value);
    formData.append('id', document.getElementById('id').value);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "modificar", true);
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
function borrar(id_estbl) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');
    formData.append('id', id_estbl);

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
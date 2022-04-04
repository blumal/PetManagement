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
            recarga += '<tr><th>NOMBRE</th><th>NIF</th><th>EMAIL</th><th>DIRECCION</th><th>NÚMERO</th><th>CP</th><th>TELF 1</th><th>TELF 2</th><th>HORARIO APERTURA</th><th>HORARIO CIERRE</th><th>URL</th><th>FOTO</th><th>ICONO</th><th>TIPO</th><th>MODIFICAR</th><th>OPERATIVO</th></th>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr>';
                recarga += '<td>' + respuesta[i].nombre_s + '</td>'
                recarga += '<td>' + respuesta[i].nif_s + '</td>'
                recarga += '<td>' + respuesta[i].email_s + '</td>'
                recarga += '<td>' + respuesta[i].nombre_di + '</td>'
                recarga += '<td>' + respuesta[i].numero_di + '</td>'
                recarga += '<td>' + respuesta[i].cp_di + '</td>'
                recarga += '<td>' + respuesta[i].contacto1_tel + '</td>'
                recarga += '<td>' + respuesta[i].contacto2_tel + '</td>'
                recarga += '<td>' + respuesta[i].horario_apertura_s + '</td>'
                recarga += '<td>' + respuesta[i].horario_cierre_s + '</td>'
                recarga += '<td>' + respuesta[i].url_web + '</td>'
                recarga += '<td><img src="img/' + respuesta[i].foto_sociedad + '"></td>'
                recarga += '<td><img src="img/' + respuesta[i].foto_icono_sociedad + '"></td>'
                recarga += '<td>' + respuesta[i].sociedad_ts + '</td>'
                recarga += '<td><button onclick="modificar(' + respuesta[i].id_s + ',\'' + respuesta[i].nombre_s + '\',\'' + respuesta[i].nif_s +
                    '\',\'' + respuesta[i].email_s + '\',\'' + respuesta[i].nombre_di + '\',' + respuesta[i].numero_di + ',' +
                    respuesta[i].cp_di + ',' + respuesta[i].contacto1_tel + ',' + respuesta[i].contacto2_tel + ',\'' +
                    respuesta[i].horario_apertura_s + '\',\'' + respuesta[i].horario_cierre_s + '\',\'' + respuesta[i].url_web + '\',\'' +
                    respuesta[i].foto_sociedad + '\',\'' + respuesta[i].foto_icono_sociedad + '\',\'' + respuesta[i].sociedad_ts + '\',' + respuesta[i].operatividad_s + ',' +
                    respuesta[i].id_tel + ',' + respuesta[i].id_di + ',' + respuesta[i].id_ts + '); return false;">Modificar</button></td>'
                    /* recarga += '<td><button onclick="borrar(' + respuesta[i].id_s + ',' + respuesta[i].id_ts + ',' + respuesta[i].id_di + ',' + respuesta[i].id_tel + '); return false;">Eliminar</button></td>' */
                    //Activo =1 inactivo=0 1 verde 0 rojo hacer if
                if (respuesta[i].operatividad_s == 1) {
                    recarga += '<td><img src="img/verde.png"></td>'
                } else if (respuesta[i].operatividad_s == 0) {
                    recarga += '<td><img src="img/rojo.png"></td>'
                }
                recarga += '</tr>';
                recarga += '</div>'
            }
            //Introducimos la recarga en la tabla
            tabla.innerHTML = recarga;
        }
    }
    ajax.send(formData);
}

function modificar(id_s, nombre_s, nif_s, email_s, nombre_di, numero_di, cp_di, contacto1_tel, contacto2_tel, horario_apertura_s,
    horario_cierre_s, url_web, foto_sociedad, foto_icono_sociedad, sociedad_ts, operatividad_s, id_tel, id_di, id_ts) {
    modal.style.display = "block";
    enter = document.getElementById("contenido")
    var contenido = ''
    contenido += '<form id="form_modif" onsubmit="editar(); return false;">'
    contenido += '<h3><b>Modificar</b></h3><br>'
    contenido += '<p><b>Nombre</b><p>'
    contenido += '<input type="text" name="nombre_s" id="nombre_s" value="' + nombre_s + '"><br>'
    contenido += '<p><b>NIF</b><p>'
    contenido += '<input type="text" name="nif_s" id="nif_s" value="' + nif_s + '"><br>'
    contenido += '<p><b>Email</b><p>'
    contenido += '<input type="email" name="email_s" id="email_s" value="' + email_s + '"><br>'
    contenido += '<p><b>Calle</b><p>'
    contenido += '<input type="text" name="nombre_di" id="nombre_di" value="' + nombre_di + '"><br>'
    contenido += '<p><b>Numero calle</b><p>'
    contenido += '<input type="number" name="numero_di" id="numero_di" value="' + numero_di + '"><br>'
    contenido += '<p><b>Num telf 1</b><p>'
    contenido += '<input type="number" name="contacto1_tel" id="contacto1_tel" value="' + contacto1_tel + '"><br>'
    contenido += '<p><b>Num telf 2</b><p>'
    contenido += '<input type="number" name="contacto2_tel" id="contacto2_tel" value="' + contacto2_tel + '"><br>'
    contenido += '<p><b>Horario apertura</b><p>'
    contenido += '<input type="time" name="horario_apertura_s" id="horario_apertura_s" value="' + horario_apertura_s + '">'
    contenido += '<p><b>Horario cierre</b><p>'
    contenido += '<input type="time" name="horario_cierre_s" id="horario_cierre_s" value="' + horario_cierre_s + '">'
    contenido += '<p><b>URL Web</b><p>'
    contenido += '<input type="text" name="url_web" id="url_web" value="' + url_web + '"><br>'
    contenido += '<p><b>Foto sociedad</b><p>'
    contenido += '<input type="file" name="foto_sociedad" id="foto_sociedad"><br>'
    contenido += '<p><b>Foto icono sociedad</b><p>'
    contenido += '<input type="file" name="foto_icono_sociedad" id="foto_icono_sociedad"><br>'
    contenido += '<p><b>CP</b><p>'
    contenido += '<input type="number" name="cp_di" id="cp_di" value="' + cp_di + '">'
    contenido += '<p><b>Tipo Sociedad</b><p>'
    if (sociedad_ts == 'clinica') {
        contenido += '<select name="sociedad_ts" id="sociedad_ts">'
        contenido += '<option value="clinica" selected>Clínica</option>'
        contenido += '<option value="protectora">Protectora de animales</option>'
        contenido += '</select>'
    } else {
        contenido += '<select name="sociedad_ts" id="sociedad_ts'
        contenido += '<option value="protectora" selected>Protectora de animales</option>'
        contenido += '<option value="clinica">Clínica</option>'
        contenido += '</select>'
    }
    contenido += '<p><b>Operatividad</b><p>'
    if (operatividad_s == 0) {
        contenido += '<select name="operatividad_ts" id="operatividad_ts">'
        contenido += '<option value="0" selected>Inactivo</option>'
        contenido += '<option value="1">Activo</option>'
        contenido += '</select>'
    } else {
        contenido += '<select name="operatividad_ts" id="operatividad_ts">'
        contenido += '<option value="1" selected>Activo</option>'
        contenido += '<option value="0">Inactivo</option>'
        contenido += '</select>'
    }
    contenido += '<input type="hidden" name="id_s" id="id_s" value="' + id_s + '"><br><br/>'
    contenido += '<input type="hidden" name="id_tel" id="id_tel" value="' + id_tel + '"><br><br/>'
    contenido += '<input type="hidden" name="id_di" id="id_di" value="' + id_di + '"><br><br/>'
    contenido += '<input type="hidden" name="id_ts" id="id_ts" value="' + id_ts + '"><br><br/>'
    contenido += '<input type="submit" value="Modificar">'
    contenido += '</form>'
    enter.innerHTML = contenido;
}

function editar() {
    var formData = new FormData(document.getElementById('form_modif'));
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'PUT');
    /* formData.append('id_s', document.getElementById('id_s').value);
    formData.append('nombre_s', document.getElementById('nombre_s').value);
    formData.append('nif_s', document.getElementById('nif_s').value);
    formData.append('email_s', document.getElementById('email_s').value);
    formData.append('nombre_di', document.getElementById('nombre_di').value);
    formData.append('numero_di', document.getElementById('numero_di').value);
    formData.append('cp_di', document.getElementById('cp_di').value);
    formData.append('contacto1_tel', document.getElementById('contacto1_tel').value);
    formData.append('contacto2_tel', document.getElementById('contacto2_tel').value);
    formData.append('horario_apertura_s', document.getElementById('horario_apertura_s').value);
    formData.append('horario_cierre_s', document.getElementById('horario_cierre_s').value);
    formData.append('url_web', document.getElementById('url_web').value);
    if (document.getElementById('foto_sociedad').files[0].name == undefined) {
        formData.append('foto_sociedad', '');
    } else {
        formData.append('foto_sociedad', document.getElementById('foto_sociedad').files[0].name);
    }
    if (document.getElementById('foto_icono_sociedad').files[0].name == undefined) {
        formData.append('foto_icono_sociedad', '');
    } else {
        formData.append('foto_icono_sociedad', document.getElementById('foto_icono_sociedad').files[0].name);
    }
    formData.append('sociedad_ts', document.getElementById('sociedad_ts').value);
    formData.append('operatividad_ts', document.getElementById('operativo').value);
    formData.append('id_tel', document.getElementById('id_tel').value);
    formData.append('id_di', document.getElementById('id_di').value);
    formData.append('id_ts', document.getElementById('id_ts').value); */

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
function borrar(id_s, id_ts, id_di, id_tel) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');
    formData.append('id_s', id_s);
    formData.append('id_tel', id_tel);
    formData.append('id_di', id_di);
    formData.append('id_ts', id_ts);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "eliminarMapasEstablecimientos", true);
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
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('nif', document.getElementById('nif').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('direccion', document.getElementById('direccion').value);
    formData.append('num', document.getElementById('num').value);
    formData.append('cp', document.getElementById('cp').value);
    formData.append('telf', document.getElementById('telf').value);
    formData.append('telf2', document.getElementById('telf2').value);
    formData.append('horario_aper', document.getElementById('horario_aper').value);
    formData.append('horario_cierre', document.getElementById('horario_cierre').value);
    formData.append('url_web', document.getElementById('url_web').value);
    formData.append('foto', document.getElementById('foto').files[0].name);
    formData.append('foto_icono', document.getElementById('foto_icono').files[0].name);
    formData.append('tipo', document.getElementById('tipo').value);
    formData.append('operativo', document.getElementById('operativo').value);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "crearMapasEstablecimientos", true);
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
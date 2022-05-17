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

    ajax.open("POST", "filtroMapasPerdidos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';
            recarga += '<table class="table" id="table">';
            recarga += '<tr class="fila-1"><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de perdida</th><th scope="col">Propietario</th><th scope="col">Calle donde se perdió</th><th scope="col">Foto</th><th scope="col">CP</th><th scope="col">Númeor de la calle</th><th scope="col">Hora de desaparición</th><th scope="col">Estado</th><th scope="col"></th><th scope="col">Editar</th></tr>';
            for (let i = 0; i < respuesta.length; i++) {
                recarga += '<tr class="fila-2">';
                recarga += '<td scope="row">' + respuesta[i].nombre_ape + '</td>'
                recarga += '<td scope="row">' + respuesta[i].descripcion_ape + '</td>'
                recarga += '<td scope="row">' + respuesta[i].fecha_perdida_ape + '</td>'
                recarga += '<td scope="row">' + respuesta[i].nombre_us + '</td>'
                recarga += '<td scope="row">' + respuesta[i].direccion_perdida_ape + '</td>'
                recarga += '<td scope="row"><img class="fotoMascota" src="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/' + respuesta[i].foto_ape + '"></td>'
                recarga += '<td scope="row">' + respuesta[i].cp_ape + '</td>'
                recarga += '<td scope="row">' + respuesta[i].calle_ape + '</td>'
                recarga += '<td scope="row">' + respuesta[i].hora_des_ape + '</td>'
                recarga += '<td scope="row">' + respuesta[i].estado_est + '</td>'
                if (respuesta[i].estado_est = 4) {
                    recarga += '<td scope="row"><img src="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/img/rojo.png"></td>'
                } else if (respuesta[i].estado_est == 5) {
                    recarga += '<td scope="row"><img src="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/img/verde.png"></td>'
                }
                recarga += '<td scope="row"><button class="btn btn-warning" onclick="modificar(' + respuesta[i].id_ape + ',\'' + respuesta[i].nombre_ape + '\',\'' + respuesta[i].descripcion_ape +
                    '\',\'' + respuesta[i].fecha_perdida_ape + '\',\'' + respuesta[i].nombre_us + '\',' + respuesta[i].direccion_perdida_ape + ',' +
                    respuesta[i].estado_est + ',' + respuesta[i].cp_ape + ',' + respuesta[i].calle_ape + ',\'' +
                    respuesta[i].hora_des_ape + '); return false;">Editar</button></td>'
                    /* recarga += '<td><button onclick="borrar(' + respuesta[i].id_ape + ',' + respuesta[i].id_ts + ',' + respuesta[i].id_di + ',' + respuesta[i].id_tel + '); return false;">Eliminar</button></td>' */
                    //Activo =1 inactivo=0 1 verde 0 rojo hacer if
                recarga += '</tr>';
                recarga += '</table>';
            }
            //Introducimos la recarga en la tabla
            tabla.innerHTML = recarga;
        }
    }
    ajax.send(formData);
}

function modificar(id_ape, nombre_ape, descripcion_ape, fecha_perdida_ape, nombre_us, direccion_perdida_ape, estado_est, cp_ape, calle_ape, hora_des_ape,
    id_us, id_est) {
    modal.style.display = "block";
    enter = document.getElementById("contenido")
    var contenido = ''
    contenido += '<form id="form_modif" onsubmit="editar(); return false;" enctype="multipart/form-data">'
    contenido += '<h3><b>Modificar</b></h3><br>'
    contenido += '<p><b>Nombre</b><p>'
    contenido += '<input type="text" name="nombre_ape" id="nombre_ape" value="' + nombre_ape + '"><br>'
    contenido += '<p><b>Descripción</b><p>'
    contenido += '<input type="text" name="descripcion_ape" id="descripcion_ape" value="' + descripcion_ape + '"><br>'
    contenido += '<p><b>Fecha de perdida</b><p>'
    contenido += '<input type="email" name="fecha_perdida_ape" id="fecha_perdida_ape" value="' + fecha_perdida_ape + '"><br>'
    contenido += '<p><b>Propietario</b><p>'
    contenido += '<input type="text" name="nombre_us" id="nombre_us" value="' + nombre_us + '"><br>'
    contenido += '<p><b>Dirección de la perdida</b><p>'
    contenido += '<input type="number" name="direccion_perdida_ape" id="direccion_perdida_ape" value="' + direccion_perdida_ape + '"><br>'
    contenido += '<p><b>CP</b><p>'
    contenido += '<input type="number" name="cp_ape" id="cp_ape" value="' + cp_ape + '"><br>'
    contenido += '<p><b>Calle</b><p>'
    contenido += '<input type="number" name="calle_ape" id="calle_ape" value="' + calle_ape + '"><br>'
    contenido += '<p><b>Hora de desaparición</b><p>'
    contenido += '<input type="time" name="hora_des_ape" id="hora_des_ape" value="' + hora_des_ape + '">'
    contenido += '<p><b>Foto Mascota (Si no quieres cambiar la foto deja el campo vacio)</b><p>'
    contenido += '<input type="file" name="foto_ape" id="foto_ape"><br>'
    contenido += '<p><b>Estado</b><p>'
    contenido += '<input type="number" name="estado_est" id="estado_est" value="' + estado_est + '">'

    contenido += '<input type="hidden" name="id_ape" id="id_ape" value="' + id_ape + '">'
    contenido += '<input type="hidden" name="id_us" id="id_us" value="' + id_us + '">'
    contenido += '<input type="hidden" name="id_est" id="id_est" value="' + id_est + '">'
    contenido += '<input type="submit" class="btn btn-success" value="Modificar">'
    contenido += '</form>'
    enter.innerHTML = contenido;
}

function editar() {
    var formData = new FormData(document.getElementById('form_modif'));
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'PUT');
    /* formData.append('id_ape', document.getElementById('id_ape').value);
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

    ajax.open("POST", "modificarMapasPerdidos", true);
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
function borrar(id_ape, id_us, id_est) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('_method', 'DELETE');
    formData.append('id_ape', id_ape);
    formData.append('id_us', id_us);
    formData.append('id_est', id_est);
    

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "eliminarMapasPerdidos", true);
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
    var formData = new FormData(document.getElementById('form_crear'));
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    /*formData.append('nombre', document.getElementById('nombre').value);
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
    formData.append('operativo', document.getElementById('operativo').value); */

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();

    ajax.open("POST", "crearMapasPerdidos", true);
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

function crearJS() {
    modal.style.display = "block";
    enter = document.getElementById("contenido")
    var contenido = ''
    contenido += '<div class="modal-h1">'
    contenido += '<h1>Crear Mascota Perdida</h1>'
    contenido += '</div>'
    contenido += '<form id="form_crear" onsubmit="crear(); return false;" enctype="multipart/form-data">'
    contenido += '    <input type="text" class="btn btn-outline-dark" name="nombre" id="nombre" placeholder="Nombre">'
    contenido += '    <textarea type="text" class="btn btn-outline-dark" name="descripcion" id="descripcion" placeholder="Descripción"></textarea>'
    contenido += '    <span>Fecha de la perdida</span>'
    contenido += '    <input type="date" class="btn btn-outline-dark" name="fecha_perdida_ape" id="fecha_perdida_ape" placeholder="Fecha de la perdida">'
    contenido += '    <input type="text" class="btn btn-outline-dark" name="propietario" id="propietario" placeholder="Nombre del propietario"><br><br>'
    contenido += '    <input type="text" class="btn btn-outline-dark" name="direccion_perdida_ape" id="direccion_perdida_ape" placeholder="Calle donde se perdió">'
    contenido += '    <span>Foto</span>'
    contenido += '    <input type="file" class="btn btn-outline-dark" name="foto_ape" id="foto_ape">'
    contenido += '    <span>Estado</span>'
    contenido += '    <select name="estado_est" class="btn btn-outline-dark" id="estado_est">'
    contenido += '        <option value="null">---</option>'
    contenido += '        <option value="4">Desaparecido</option>'
    contenido += '        <option value="5">Encontrado</option>'
    contenido += '    </select><br><br>'
    contenido += '    <input type="number" class="btn btn-outline-dark" name="cp_ape" id="cp_ape" placeholder="CP">'
    contenido += '    <input type="text" class="btn btn-outline-dark" name="calle_ape" id="calle_ape" placeholder="Número de la calle">'
    contenido += '    <span>Hora de la desparición</span>'
    contenido += '    <input type="time" class="btn btn-outline-dark" name="hora_des_ape" id="hora_des_ape" placeholder="Hora de la desaparición"><br><br>'
    contenido += '    <input type="submit" class="btn btn-success" value="Crear">'
    contenido += '</form>'
    enter.innerHTML = contenido;
}
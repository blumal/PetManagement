// window.onload = function() {
//     filtro();
// }

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

function filtro() {
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */
    var table = document.getElementById('table');
    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");


    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('postFiltro').value;
    var filtro = document.getElementById('search').value;

    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', method);
    formData.append('nombre_art', filtro);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "filtro", true);
    ajax.onreadystatechange = function() {

            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                /* Crear la estructura html que se devolverá dentro de una variable recarga*/
                var recarga = '';
                recarga += '<tr class="fila-1">';

                recarga += '<th scope="col">#</th>';
                recarga += '<th scope="col">Nombre</th>';
                recarga += '<th scope="col">Descripcion</th>';
                recarga += '<th scope="col">Precio</th>';
                recarga += '<th scope="col">Código de Barras</th>';
                recarga += '<th scope="col">Marca</th>';
                recarga += '<th scope="col">Tipo de Artículo</th>';
                recarga += '<th scope="col" colspan="2">Acciones</th>';
                recarga += '</tr>';
                for (let i = 0; i < respuesta.length; i++) {
                    recarga += '<tr class="fila-2">';
                    recarga += '<td scope="row">' + respuesta[i].id_art + '</td>';
                    recarga += '<td>' + respuesta[i].nombre_art + '</td>';

                    recarga += '<td>' + respuesta[i].descripcion_art + '</td>';


                    recarga += '<td>' + respuesta[i].precio_art + '</td>';
                    recarga += '<td>' + respuesta[i].codigobarras_art + '</td>';
                    recarga += '<td>' + respuesta[i].marca_ma + '</td>';
                    recarga += '<td>' + respuesta[i].tipo_articulo_ta + '</td>';
                    recarga += '<td>';
                    // editar
                    recarga += '<button class="btn btn-secondary" type="submit" value="Edit" onclick="abrirmodal_editar(' + respuesta[i].id_art + ',\'' + respuesta[i].nombre_art + '\',\'' + respuesta[i].descripcion_art + '\',\'' + respuesta[i].precio_art + '\',\'' + respuesta[i].codigobarras_art + '\',\'' + respuesta[i].id_marca_fk + '\',\'' + respuesta[i].id_tipo_articulo_fk + '\');return false;">Editar</button>';

                    recarga += '</td>';
                    recarga += '<td>';
                    // eliminar
                    recarga += '<form method="post">';
                    recarga += '<input type="hidden" name="_method" value="DELETE" id="deleteNote">';

                    recarga += '<button class= "btn btn-danger" type="submit" value="Delete" onclick="eliminar(' + respuesta[i].id_art + ');return false;">Eliminar</button>';

                    recarga += '</form>';
                    recarga += '</td>';
                    recarga += '</tr>';
                }
                table.innerHTML = recarga;
            }
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)
}

function crear() {
    var message = document.getElementById('message');
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */

    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");
 
    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('createNote').value;
    var formData = new FormData(document.getElementById('formcrear'));
    formData.append('_token', token);
    formData.append('_method', method);
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "crear", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = '<p>Producto creado correctamente.</p>';

                } else {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    //    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
                filtro();
            }
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)
}

function eliminar(id) {
    var message = document.getElementById('message');
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */

    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");
 
    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    var token = document.getElementById('token').getAttribute("content");
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', 'DELETE');
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "eliminar/" + id, true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    //    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = '<p>Producto eliminado correctamente.</p>';

                } else {
                    //    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
            }
            filtro();
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)
}


function actualizar() {
    var message = document.getElementById('message');
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */

    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");
 
    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    var token = document.getElementById('token').getAttribute("content");
    var formData = new FormData(document.getElementById('formUpdate'));
    formData.append('_token', token);
    formData.append('_method', 'PUT');
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("POST", "actualizar", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    //    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = '<p>Producto modificado correctamente.</p>';

                } else {
                    //    /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                    /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
            }
            filtro();
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)

}
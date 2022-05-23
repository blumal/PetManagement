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

function anadir_item() {
    /* Si hace falta obtenemos el elemento HTML donde introduciremos la recarga (datos o mensajes) */
    /* Usar el objeto FormData para guardar los parámetros que se enviarán:
       formData.append('clave', valor);
       valor = elemento/s que se pasarán como parámetros: token, method, inputs... */
    var items_adicionales = document.getElementById("items_adicionales");
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //estoy filtrando el valor, si es 0 es el valor del texto
    // y si es diferente de 0 es el valor de los botones "String"

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    //abrimos la ruta web pasando el objeto ajax con todas las variables
    ajax.open("POST", "anadir_item_factura_visita", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            new_item = '<div class="col-md-12">' +
                '<label for="productos" class="label" for="#">Selecciona producto:</label>' +
                '<select id="productos" name="productos[]">'
            for (let i = 0; i < respuesta.length; i++) {
                new_item += '<option class="form-control"  value="' + respuesta[i]['id_prod'] + '">' + respuesta[i]['producto_pro'] + '</option>'
            }
            new_item +=
                '</select>' +
                '<label class="label" for="#">Selecciona cantidad de producto</label>' +
                '<input type="number" class="form-control" name="cantidad[]" value=1>' +
                '</div>';
            items_adicionales.innerHTML += new_item

        }

    }
    ajax.send(formData);
}

function calcular_total(e) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    cantidades = document.getElementsByName('cantidad[]');
    productos = document.getElementsByName('productos[]');
    promocion = document.getElementsByName("promocion");

    id_promocion = promocion[0]['selectedOptions'][0]['value'];

    array_cantidades = []
    array_productos = []

    numero_items = productos.length
    for (let j = 0; j < numero_items; j++) {
        array_cantidades.push(cantidades[j]['value'])
        array_productos.push(productos[j]['value'])
    }

    formData.append('no_items', numero_items);
    formData.append('cantidades', array_cantidades);
    formData.append('productos', array_productos);
    formData.append('cantidades', array_cantidades);
    formData.append('id_promo', id_promocion);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    //abrimos la ruta web pasando el objeto ajax con todas las variables
    ajax.open("POST", "calcular_total", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            document.getElementById('total_factura').value = respuesta
        }
    }
    ajax.send(formData);
}
/*
jose.innerHTML = '<div class="col-md-12">' +
    '<label for="productos" class="label" for="#">Selecciona producto:</label>' +
    '<select id="productos" name="productos[]">' +
    '@for ($i = 0; $i < count($items_clinica); $i++)' +
    '<option class="form-control"  value="{{$items_clinica[$i]->id_prod}}">{{$items_clinica[$i]->producto_pro}}</option>' +
    '@endfor' +
    '</select>' +
    '<label class="label" for="#">Selecciona cantidad de producto</label>' +
    '<input type="number" class="form-control" name="cantidad[]" value=1>' +
    '</div>';
*/
window.onload = function() {
    idFilters();
}

//Objeto ajax
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

function idFilters() {
    //Recojo variables
    var table = document.getElementById('table-g');
    //Inicialización objeto Ajax
    var ajax = objetoAjax();
    //Nuevo objeto
    formdata = new FormData();
    //Datos del html
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('id_vi', document.getElementById('id_vi').value);
    formdata.append('dni_us', document.getElementById('dni_us').value);

    //Datos fichero web que apunta a la función que recoge el JSON
    ajax.open("POST", "filter", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var reply = JSON.parse(this.responseText);
            var reload = '';
            reload += `<tr>
                <th scope="col">ID de visita</th>
                <th scope="col">DNI de cliente</th>
                <th scope="col">Fecha de cita</th>
                <th scope="col">Hora de cita</th>
                <th scope="col">Estado de la visita</th>
                <th scope="col">Acciones</th>
            </tr>`;
            console.log(reply);
            for (let i = 0; i < reply.length; i++) {
                reload += `<tr><td>${reply[i].id_vi}</td>
                    <td>${reply[i].dni_us}</td>
                    <td>${reply[i].fecha_vi}</td>
                    <td>${reply[i].hora_vi}</td>
                    <td>${reply[i].estado_est}</td>
                    <td><button type="button" class="btn btn-success" onclick="openModalInfo('${reply[i].nombre_us}', '${reply[i].nombre_pa}', '${reply[i].asunto_vi}', ); return false;">Información</button></td>
                    <td><button type="button" class="btn btn-warning" onclick="openModalUpdate(${reply[i].id_vi}); return false;">Actualizar</button></td>
                    <td><button type="button" class="btn btn-danger" onclick="openModalCancel(${reply[i].id_vi}); return false;">Cancelar</button></td>
                    </tr>`;
            }
            //Montar registros tabla
            table.innerHTML = reload;
        }
    }
    ajax.send(formdata);
}
/*<th scope="col">Cliente</th>
<th scope="col">Motivo de la visita</th>*/
/*<td>${reply[i].nombre_us}</td>
                    <td>${reply[i].asunto_vi}</td>*/

//Modal info quote
function openModalInfo(nombre_us, nombre_pa, asunto_vi) {
    alert(nombre_us);
    alert(nombre_pa);
    alert(asunto_vi);
}

//Update quote
function openModalUpdate(id_vi) {
    alert(id_vi);
}
//Delete quote
function openModalCancel(id_vi) {
    alert(id_vi);
}
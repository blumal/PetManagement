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

//Filtro AJAX citas
function idFilters() {
    //Recojo variables
    var table = document.getElementById('table-g');
    var token = document.getElementById('token').getAttribute("content");
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
            console.log(reply);
            var reload = '';
            reload += `<tr>
                <th scope="col">ID de visita</th>
                <th scope="col">DNI de cliente</th>
                <th scope="col">Fecha de cita</th>
                <th scope="col">Hora de cita</th>
                <th scope="col">Estado de la visita</th>
                <th scope="col">Acciones</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>`;
            for (let i = 0; i < reply.length; i++) {
                reload += `<tr><td>${reply[i].id_vi}</td>
                    <td>${reply[i].dni_us}</td>
                    <td>${reply[i].fecha_vi}</td>
                    <td>${reply[i].hora_vi}</td>
                    <td>${reply[i].estado_est}</td>
                    <td>
                        <form action="infocitaempleado/${reply[i].id_vi}" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="${token}"/>
                            <button type="submit" class="btn btn-success">Información</button>
                        </form>
                    </td>
                    <td>
                        <form action="editarcitaempleado/${reply[i].id_vi}" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="${token}"/>
                            <button type="submit" class="btn btn-warning">Actualizar</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" onsubmit="confirmDel(${reply[i].id_vi}); return false;">
                            <input type="hidden" id="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                        </form>
                    </td>
                    </tr>`;
            }
            //Montar registros tabla
            table.innerHTML = reload;
        }
    }
    ajax.send(formdata);
}

function confirmDel(id_vi){
    swal({
            title: "¿Segur@ de que deseas cancelar esta cita?",
            text: "La acción no se podrá revertir!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Se ha eliminado el registro correctamente :)", {
                    icon: "success",
                });
                DeleteQuote(id_vi);
            }
        });
}

//Eliminar cita
function DeleteQuote(id_vi){
    //Inicialización objeto Ajax
    var ajax = objetoAjax();
    //Nuevo objeto
    formdata = new FormData();
    //form
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'DELETE');
    formdata.append('id_vi', id_vi);

    //Datos fichero web que apunta a la función que recoge el JSON
    ajax.open("POST", "deletequote/" + id_vi, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText);
            var reply = JSON.parse(this.responseText);
            if (reply.result == "OK") {
                console.log('Success');
            } else {
                swal("Opss...", "Error: " + result, "success");
            }
            //Para poder ver los cambios sin recargar la página debemos volver a llamar a la función del filtro
            idFilters()
        }
    }
    ajax.send(formdata);
}



/* Modal registrar */

function abrirmodal() {
    modal = document.getElementById('modalbox')
    modal.style.display = "block";
    modal_login = document.getElementById('modalregistro')
    modal_login.style.display = "block";
}

function closeModal() {
    let modal = document.getElementById("modalbox");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal crear */

function abrirmodal_crear() {
    modal = document.getElementById('modalbox_crear')
    modal.style.display = "block";
    modal_login = document.getElementById('modalcrear')
    modal_login.style.display = "block";
}

function closeModal_crear() {
    let modal = document.getElementById("modalbox_crear");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_crear");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal editar */

function abrirmodal_editar(id_art, nombre_art, descripcion_art, precio_art, codigobarras_art, id_marca_fk, id_tipo_articulo_fk) {
    document.getElementById('nombre_art_e').value = nombre_art;
    document.getElementById('descripcion_art_e').value = descripcion_art;
    document.getElementById('precio_art_e').value = precio_art;
    document.getElementById('codigobarras_art_e').value = codigobarras_art;
    console.log(precio_art)
    document.getElementById('id_marca_fk_e').value = id_marca_fk;
    document.getElementById('id_tipo_articulo_fk_e').value = id_tipo_articulo_fk;
    document.getElementById('idUpdate').value = id_art;
    modal = document.getElementById('modalbox_editar');
    modal.style.display = "block";
    modal_login = document.getElementById('modaleditar')
    modal_login.style.display = "block";
}

function closeModal_editar() {
    let modal = document.getElementById("modalbox_editar");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_editar");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
2

// function val() {
//     var nombre_art = document.getElementById('nombre_art').value;
//     var descripcion_art = document.getElementById('descripcion_art').value;
//     var precio_art = document.getElementById('precio_art').value;
//     var codigobarras_art = document.getElementById('codigobarras_art').value;
//     var foto = document.getElementById('foto').value;

//     if (nombre_art == "" || descripcion_art == "" || precio_art == "" || codigobarras_art == "" || foto == "") {
//         document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun Email</p>";
//         document.getElementById('mensaje').style.color = "red";
//         return false;
//     }
// }

function error_registro1() {
    var nombre_art = document.getElementById('nombre_art').value;
    if (nombre_art == "") {
        document.getElementById('mensaje1').innerHTML = "<p>No se ha especificado ningun Nombre</p>";
        document.getElementById('mensaje1').style.color = "red";
    }
}

function error_validar1() {
    document.getElementById('mensaje1').innerHTML = "";
}

//

function error_registro2() {
    var nombre_art = document.getElementById('descripcion_art').value;
    if (nombre_art == "") {
        document.getElementById('mensaje2').innerHTML = "<p>No se ha especificado ninguna descripción</p>";
        document.getElementById('mensaje2').style.color = "red";
    }
}

function error_validar2() {
    document.getElementById('mensaje2').innerHTML = "";
}

//

function error_registro3() {
    var nombre_art = document.getElementById('precio_art').value;
    if (nombre_art == "") {
        document.getElementById('mensaje3').innerHTML = "<p>No se ha especificado ningun precio</p>";
        document.getElementById('mensaje3').style.color = "red";
    }
}

function error_validar3() {
    document.getElementById('mensaje3').innerHTML = "";
}

//

function error_registro4() {
    var nombre_art = document.getElementById('codigobarras_art').value;
    if (nombre_art == "") {
        document.getElementById('mensaje4').innerHTML = "<p>No se ha especificado ningun Código de barras</p>";
        document.getElementById('mensaje4').style.color = "red";
    }
}

function error_validar4() {
    document.getElementById('mensaje4').innerHTML = "";
}
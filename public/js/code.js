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

/*Modal 2*/

function abrirmodal_2(id_art, nombre_art, descripcion_art, precio_art, codigobarras_art, id_marca_fk, id_tipo_articulo_fk) {
    id_art_p = id_art
    nombre_art_p = nombre_art
    descripcion_art_p = descripcion_art
    precio_art_p = precio_art
    codigobarras_art_p = codigobarras_art
    id_marca_fk_p = id_marca_fk
    id_tipo_articulo_fk_p = id_tipo_articulo_fk
    modal = document.getElementById('modalbox_2')
    modal.style.display = "block";
    modal_login = document.getElementById('modal2')
    modal_login.style.display = "block";
}

function closeModal_2() {
    let modal = document.getElementById("modalbox_2");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_2");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/*Modal sub*/

function abrirmodal_s() {
    document.getElementById('idajax').value = id_art_p
    modal = document.getElementById('modalbox_s')
    modal.style.display = "block";
    modal_login = document.getElementById('modal_s')
    modal_login.style.display = "block";
}

function closeModal_s() {
    let modal = document.getElementById("modalbox_s");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_s");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal editar */


function abrirmodal_editar() {
    document.getElementById('nombre_art_e').value = nombre_art_p;
    document.getElementById('descripcion_art_e').value = descripcion_art_p;
    document.getElementById('precio_art_e').value = precio_art_p;
    document.getElementById('codigobarras_art_e').value = codigobarras_art_p;
    document.getElementById('id_marca_fk_e').value = id_marca_fk_p;
    document.getElementById('id_tipo_articulo_fk_e').value = id_tipo_articulo_fk_p;
    document.getElementById('idUpdate').value = id_art_p;
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
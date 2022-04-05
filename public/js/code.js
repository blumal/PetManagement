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

function abrirmodal_editar(id_art, nombre_art, precio_art, codigobarras_art, id_marca_fk, id_tipo_articulo_fk) {
    document.getElementById('nombre_art_e').value = nombre_art;
    document.getElementById('precio_art_e').value = precio_art;
    document.getElementById('codigobarras_art_e').value = codigobarras_art;
    console.log(id_tipo_articulo_fk)
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
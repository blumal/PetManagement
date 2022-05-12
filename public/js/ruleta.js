window.onload = function() {
    comprobar_compra();
    n_promo = [];
    v_promo = [];
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

function ruleta() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    var ajax = objetoAjax();
    ajax.open("POST", "ruleta_promo", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            for (let i = 0; i < respuesta.length; i++) {
                n_promo.push(respuesta[i].promocion_pro);
                v_promo.push(respuesta[i].porcentaje_pro);
            }
            console.log(n_promo);
            console.log(v_promo);
        }
    }
    ajax.send(formData);
}

function comprobar_compra() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    var id_usr = document.getElementById('id_usr');
    formData.append('id_usr', id_usr);
    var ajax = objetoAjax();
    ajax.open("POST", "comprobar_compra", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta);
            if (respuesta % 5) {
                //Comprobamos si ha jugado ya
                comprobar_promo();
            } else {
                //Lo sacamos de la página
                comprobar_promo();
            }
        }
    }
    ajax.send(formData);
}

function comprobar_promo() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    var ajax = objetoAjax();
    ajax.open("POST", "comprobar_promo", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta);
            if (respuesta.comprobar_cli_pro == 0) {
                //Le dejamos Jugar
                console.log(respuesta.comprobar_cli_pro);
                /* ruleta(); */
            } else {
                //Lo sacamos de la página
            }
        }
    }
    ajax.send(formData);
}
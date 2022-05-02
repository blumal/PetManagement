window.onload = function() {
    /* geoguesser(); */
    //Llamamos a la funcion markers, la cual nos mostrara los marcadores en el mapa
    //declaramos la variable global ruta elim que utilizaremos para eliminar las rutas
    arr_marker = [];
    ruta_elim = null;
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

/*MOSTRAR MAPA*/

map = L.map('map').setView([35.96730926867194, -13.417163902896636], 2);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v10',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibGF1cmFmZXJuYW5kZXoxODIiLCJhIjoiY2wwYjg0MTRqMDhpYTNkbWp6ajlscHlkOCJ9.Cdxv8cBGcFJsPag19TXOVQ'
}).addTo(map);

cord_click = null;

function geoguesser() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("POST", "markersEstablecimientos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            for (let i = 0; i < respuesta.length; i++) {

            }
        }
    }
    ajax.send(formData);
}

function onMapClick(e) {
    cord_click = e.latlng.toString();
}

map.on('click', onMapClick)

console.log(cord_click);
window.onload = function() {
    //Llamamos a la funcion markers, la cual nos mostrara los marcadores en el mapa
    markers();
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

map = L.map('map').setView([41.3882842630049, 2.167713726307117], 15);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v10',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibGF1cmFmZXJuYW5kZXoxODIiLCJhIjoiY2wwYjg0MTRqMDhpYTNkbWp6ajlscHlkOCJ9.Cdxv8cBGcFJsPag19TXOVQ'
}).addTo(map);

function markers() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("POST", "markersAnimalesPerdidos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            //hacemos un bucle for para mostrar los datos guardados en el array respuesta
            for (let i = 0; i < respuesta.length; i++) {
                //Creo una variable local donde almaceno la imagen del marcador
                var markerIcon = L.icon({
                    //Url de la imagen
                    iconUrl: src = '../public/img/' + respuesta[i].foto_icon + '',
                    //Tamaño del icono
                    iconSize: [30, 30]
                });
                //Le asignamos al marcador la coordenadas del marcador y la variable que le asigna la imagen
                marker = L.marker([respuesta[i].latitud, respuesta[i].longitud], { icon: markerIcon });
                //Añadimos el marcador al mapa
                marker.addTo(map);
                //Creamos el popup del marcador y le introducimos los datos que nos interesa y un tamaño maximo del popup
                marker.bindPopup("", { maxWidth: 190 }).openPopup();
            }
        }
        mapa.innerHTML = recarga;
    }
    ajax.send(formData);
}
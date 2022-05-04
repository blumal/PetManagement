window.onload = function() {
    geoguesser();
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
    maxZoom: 18,
    id: 'mapbox/streets-v10',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibGF1cmFmZXJuYW5kZXoxODIiLCJhIjoiY2wwYjg0MTRqMDhpYTNkbWp6ajlscHlkOCJ9.Cdxv8cBGcFJsPag19TXOVQ'
}).addTo(map);

cords_click = '';

function geoguesser(cords_click) {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    //Nivel animal
    valor_geo = document.getElementById('valor_cons_geo').value;
    formData.append('nivel', valor_geo);
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("POST", "geoguesser_ajax", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            var geocoder = L.esri.Geocoding.geocodeService();
            for (let i = 0; i < respuesta.length; i++) {
                geocoder.geocode().text(respuesta[i].direccion_dir_geo).run(function(error, response) {
                    cooordenadas = response.results[0].latlng;
                })
                console.log('Result ' + i)
                console.log(respuesta[i]);
                console.log('Distancia: ' + respuesta[i].radio_dir_geo + ' . Coordenadas click: ' + cords_click.lat + ',' + cords_click.lng);
                console.log('Coordenadas lugar: ' + cooordenadas.lat + ',' + cooordenadas.lng);
                distancia_lugar = map.distance(cords_click, cooordenadas);
                console.log('Distancia: ' + distancia_lugar);
                //cambio tipos distinto puede ser el problema
                if (parseInt(respuesta[i].radio_gir_geo) < parseInt(distancia_lugar)) {
                    console.log('ok');
                    break;
                } else {
                    console.log('nok');
                }
            }
        }
    }
    ajax.send(formData);
}

/* function onMapClick(e) {
    var geocoder = L.esri.Geocoding.geocodeService();
    geocoder.reverse().latlng(e.latlng).run(function(error, response) {
            cords_click = e.latlng;
        }) */
/* lat = e.latlng.lat.toString();
lng = e.latlng.lng.toString(); */
/*   cords_click = e.latlng;
    geoguesser(cords_click);
} */


map.on('click', function(e) {
    var geocodeService = L.esri.Geocoding.geocodeService({
        apikey: 'AAPKbbec8a40852d418489a6942c6bb999c0OGoOpdlPwk4Ze41rBXv4-nlfUv4gdC9eF1nl2D03hpX5NdYqZGw0fZmYgcfzS_60' // replace with your api key - https://developers.arcgis.com
    });
    geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
        if (error) {
            return;
        }

        L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
    });
});
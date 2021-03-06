window.onload = function() {
    //Llamamos a la funcion markers, la cual nos mostrara los marcadores en el mapa
    markers();
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

map = L.map('map').setView([41.35255013466578, 2.1086745025454907], 15);

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
    ajax.open("POST", "markersEstablecimientos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            //hacemos un bucle for para mostrar los datos guardados en el array respuesta
            var geocoder = L.esri.Geocoding.geocodeService();
            for (let i = 0; i < respuesta.length; i++) {
                geocoder.geocode().text(respuesta[i].nombre_di + ', ' + respuesta[i].numero_di + ' ' + respuesta[i].cp_di).run(function(error, response) {
                    cooordenadas = response.results[0].latlng;
                    console.log(cooordenadas);
                    //Creo una variable local donde almaceno la imagen del marcador
                    var markerIcon = L.icon({
                        //Url de la imagen
                        iconUrl: src = 'http://localhost/www/PetManagement/storage/app/public/' + respuesta[i].foto_icono_sociedad,
                        //Tamaño del icono
                        iconSize: [30, 30]
                    });
                    //Le asignamos al marcador la coordenadas del marcador y la variable que le asigna la imagen
                    marker = L.marker([cooordenadas.lat, cooordenadas.lng], { icon: markerIcon });
                    //Añadimos el marcador al mapa
                    marker.addTo(map);
                    //Creamos el popup del marcador y le introducimos los datos que nos interesa y un tamaño maximo del popup
                    marker.bindPopup("<p>" + respuesta[i].nombre_s + "</p><p>Contacto: <br>" + respuesta[i].email_s + " " + respuesta[i].contacto1_tel + "</p><p>Horario:<br>" + respuesta[i].horario_apertura_s + "-" + respuesta[i].horario_cierre_s + "</p><p>Web:<br><a href='" + respuesta[i].url_web + "'>" + respuesta[i].url_web + "</a></p><img class='img_an' src = 'http://localhost/www/PetManagement/storage/app/public/" + respuesta[i].foto_sociedad + "'><button class='btn_rut' onclick='ruta(" + cooordenadas.lat + ',' + cooordenadas.lng + "); return false;'>Ir</button><button class='btn_rut' onclick='limpiarRuta(); return false;'>Quitar Ruta</button>", { maxWidth: 200 }).openPopup();
                    arr_marker.push(marker);
                })
            }
        }
    }
    ajax.send(formData);
}

//Creamos un marcador de la persona donde este en el mapa
var markerIconPerson = L.icon({
    iconUrl: src = 'https://cdn-icons-png.flaticon.com/512/57/57117.png',
    iconSize: [30, 30]
});
//Lo seteamos manualmente
marker_person = L.marker([0, 0], { icon: markerIconPerson });
//Lo añadimos al mapa

//Creamos la funcion ruta para trazar una ruta hasta el lugar que elijamos
function ruta(lat, long) {
    //Llamamos a la funcion limpiar ruta por si ya hay alguna ruta trazada eliminar esta
    limpiarRuta();
    //Pedimos la localizacion al navegador si esta podemos realizar las funciones programadas
    if (!"geolocation" in navigator) {
        return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
    };
    //Utilizamos la funcion para crear la ruta hacia el destino
    const onUbicacionConcedida = ubicacion => {
        console.log("Tengo la ubicación: ", ubicacion);
        //Almacenamos las coordenadas de la persona en una variable
        ubi_user = [ubicacion.coords.latitude, ubicacion.coords.longitude];
        //Creamos un marcador de la ubicacion donde esta la persona
        marker_person.setLatLng(ubi_user);
        //Trazamos la ruta
        ruta_elim = L.Routing.control({
            waypoints: [
                //coordenadas de origen
                L.latLng(ubicacion.coords.latitude, ubicacion.coords.longitude),
                //coordenadas de destino
                L.latLng(lat, long)
            ],
            //idioma en español de las indicaciones
            language: 'es',
            routeWhileDragging: true,
            createMarker: function() { return null; }
        });
        ruta_elim.addTo(map);
    }

    const onErrorDeUbicacion = err => {
        console.log("Error obteniendo ubicación: ", err);
    }

    const opcionesDeSolicitud = {
        enableHighAccuracy: true, // Alta precisión
        maximumAge: 0, // No queremos caché
        timeout: 5000 // Esperar solo 5 segundos
    };
    // Solicitamos la ubicacion cada x segundos para ir actualizando la ruta
    setInterval(navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud), 5000);
}

//Funcion para limpiar la ruta actual
function limpiarRuta() {
    //comprobamos si hay datos en el array, si los hay eliminamos los marcadores correspondientes a sus lugares
    if (ruta_elim != null) {
        map.removeControl(ruta_elim);
    }
}

function settypeJS(id_tipo) {
    //Poner id como indefinido para k no filtre
    //Add class and remove class si tiene o no clase es el condicional
    if (id_tipo == 1) {
        var boton = document.getElementsByClassName('btn_filtro');
        for (i = 0; i < boton.length; i++) {
            boton[i].classList.remove('classtype');
        }
        document.getElementById(id_tipo).classList.add('classtype');
    } else {
        var boton = document.getElementsByClassName('btn_filtro');
        for (i = 0; i < boton.length; i++) {
            boton[i].classList.remove('classtype');
        }
        document.getElementById(id_tipo).classList.add('classtype');
    }

    if (arr_marker != []) {
        for (let i = 0; i < arr_marker.length; i++) {
            map.removeLayer(arr_marker[i]);
        }
    }
    arr_marker = [];

    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    formData.append('id_tipo', id_tipo);
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("POST", "filtromarkersEstablecimientos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            //hacemos un bucle for para mostrar los datos guardados en el array respuesta
            var geocoder = L.esri.Geocoding.geocodeService();
            for (let i = 0; i < respuesta.length; i++) {
                geocoder.geocode().text(respuesta[i].nombre_di + ', ' + respuesta[i].numero_di + ' ' + respuesta[i].cp_di).run(function(error, response) {
                    cooordenadas = response.results[0].latlng;
                    //Creo una variable local donde almaceno la imagen del marcador
                    var markerIcon = L.icon({
                        //Url de la imagen
                        iconUrl: src = '../public/' + respuesta[i].foto_icono_sociedad,
                        //Tamaño del icono
                        iconSize: [30, 30]
                    });
                    //Le asignamos al marcador la coordenadas del marcador y la variable que le asigna la imagen
                    marker = L.marker([cooordenadas.lat, cooordenadas.lng], { icon: markerIcon });
                    //Añadimos el marcador al mapa
                    marker.addTo(map);
                    //Creamos el popup del marcador y le introducimos los datos que nos interesa y un tamaño maximo del popup
                    marker.bindPopup("<p>" + respuesta[i].nombre_s + "</p><p>Contacto: <br>" + respuesta[i].email_s + " " +
                        respuesta[i].contacto1_tel + "</p><p>Horario:<br>" + respuesta[i].horario_apertura_s + "-" +
                        respuesta[i].horario_cierre_s + "</p><p>Web:<br><a href='" + respuesta[i].url_web + "'>" +
                        respuesta[i].url_web + "</a></p><img class='img_an' src = '../public/" +
                        respuesta[i].foto_sociedad + "'><button class='btn_rut' onclick='ruta(" + cooordenadas.lat + ',' +
                        cooordenadas.lng + "); return false;'>Ir</button><button class='btn_rut' onclick='limpiarRuta(); return false;'>Quitar Ruta</button>", { maxWidth: 200 }).openPopup();
                    arr_marker.push(marker);
                })
            }
        }
    }
    ajax.send(formData);
}
window.onload = function() {
        cords_click = null;
        valor_geo = document.getElementById('valor_cons_geo').value;
        geoguesser(cords_click);
    }
    /* if (!alertify.ok) {
        //define a new dialog
        alertify.dialog('ok', function() {
            return {
                main: function(message) {
                    this.message = message;
                },
                setup: function() {
                    return {
                        buttons: [{ text: "Continuar", key: 27 }],
                        focus: { element: 0 }
                    };
                },
                prepare: function() {
                    this.setContent(this.message);
                }
            }
        });
    }

    if (!alertify.final) {
        //define a new dialog
        alertify.dialog('final', function() {
            return {
                main: function(message) {
                    this.message = message;
                },
                setup: function() {
                    return {
                        buttons: [{ text: "Se acabo el juego!", key: 27 }],
                        focus: { element: 0 }
                    };
                },
                prepare: function() {
                    this.setContent(this.message);
                }
            }
        });
    } */

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

function geoguesser(cords_click) {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    //Nivel animal
    formData.append('nivel', valor_geo);
    var datos_an = document.getElementById('img_geo');
    arr_codes = [];
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("POST", "geoguesser_ajax", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            if (respuesta == '') {
                /* alertify
                    .alert("Se ha acabado el juego.", function() {
                        alertify.message('OK');
                    }); */
                /* alertify.final("Se ha acabdo el juego!"); */
                /* alertify.warning('Se ha acabdo el juego!'); */
                /* alert('Se ha acabado el juego.'); */
                /* swal({
                    title: "Se ha acabado el juego.",
                    text: "Se te redigirá a otra página en 5 segundos.",
                    timer: 5000,
                    showConfirmButton: true
                }); */
                swal.fire({
                    title: "Se ha acabado el juego!!",
                    text: "Se te redigirá a otra página en cinco segundos",
                    icon: "success",
                    timer: 5000,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                setTimeout(function() {
                    window.location.href = "geoguesser";
                }, 5000);
            } else {
                /* var geocoder = L.esri.Geocoding.geocodeService(); */
                var recarga = '';
                for (let i = 0; i < respuesta.length; i++) {
                    /* console.log(i) */
                    /* console.log(respuesta[i]); */
                    /* console.log('Codigo pais: ' + respuesta[i].codigo_pais_dir_geo); */
                    /* console.log('Codigo país click: ' + cords_click); */
                    if (arr_codes.includes(respuesta[i].codigo_pais_dir_geo)) {

                    } else {
                        arr_codes.push(respuesta[i].codigo_pais_dir_geo);
                    }
                    if (recarga.includes('<p>' + respuesta[i].nombre_geo + '</p>')) {

                    } else {
                        recarga += '<p>' + respuesta[i].nombre_geo + '</p>';
                    }
                    if (recarga.includes('<img class="img_an" src="' + respuesta[i].img_geo + '">')) {

                    } else {
                        recarga += '<img class="img_an" src="' + respuesta[i].img_geo + '">';
                    }
                    /* onsole.log(valor_geo); */
                    /* geocoder.geocode().text(respuesta[i].direccion_dir_geo).run(function(error, response) {
                        cooordenadas = response.results[0].latlng;
                    }) */
                    /* console.log('Distancia: ' + respuesta[i].radio_dir_geo + ' . Coordenadas click: ' + cords_click.lat + ',' + cords_click.lng);
                    console.log('Coordenadas lugar: ' + cooordenadas.lat + ',' + cooordenadas.lng);
                    distancia_lugar = map.distance(cords_click, cooordenadas);
                    console.log('Distancia: ' + distancia_lugar);
                    //cambio tipos distinto puede ser el problema
                    if (parseInt(respuesta[i].radio_gir_geo) < parseInt(distancia_lugar)) {
                        console.log('ok');
                        break;
                    } else {
                        console.log('nok');
                    } */
                    /* if (cords_click == null) {

                    } else if (cords_click == respuesta[i].codigo_pais_dir_geo) {
                        alert('Has acertado');
                    } else {
                        alert('Has fallado');
                        i--;
                    } */
                }
                datos_an.innerHTML = recarga;
                /* console.log(recarga); */
                console.log('Codigo país click: ' + cords_click);
                console.log('Array paises: ' + arr_codes);
                if (cords_click == null) {

                } else {
                    comprobarAnimal(cords_click, arr_codes);
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

function comprobarAnimal(cords_click, arr_codes) {
    for (let i = 0; i < arr_codes.length; i++) {
        if (cords_click == arr_codes[i]) {
            /* alertify
                .alert("Has acertado!", function() {
                    alertify.message('Continuar');
                }); */
            /* alertify.confirm('', 'Has acertado', function() { alertify.success('Ok') }); */
            /* alertify.ok('Has acertado!'); */
            /* alert('Has acertado!'); */
            /* swal("Has acertado!", "success"); */
            swal.fire({
                title: "Has acertado!!",
                icon: "success",
                timer: 2000,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            /* swal({
                title: "Has acertado!!",
                text: "Se te redigirá a otra página en 5 segundos.",
                timer: 5000,
                showConfirmButton: true
            }); */
            console.log('Correcto');
            valor_geo++;
            console.log('valor geo: ' + valor_geo);
            /* arr_codes = [];
            console.log('Array vacio: ' + arr_codes); */
            cords_click = null;
            recarga = '';
            setTimeout(function() {
                geoguesser(cords_click);
            }, 2000);
        } else if (cords_click == null) {

        } else {
            /* alertify
                .alert("Has fallado!", function() {
                    alertify.message('Probar de nuevo');
                }); */
            /* alertify.confirm('', 'Has fallado', function() { alertify.success('Ok') }); */
            /* alertify.ok('Has fallado, prueba de nuevo!'); */
            /* arr_codes = []; */
            /* alert('Has fallado!'); */
            swal.fire({
                title: "Has fallado!!",
                icon: "error",
                timer: 2000,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            console.log('Incorrecto');
            cords_click = null;
            recarga = '';
            setTimeout(function() {
                geoguesser(cords_click);
            }, 2000);
        }
    }
}


map.on('click', function(e) {
    /* arr_codes = []; */
    var geocodeService = L.esri.Geocoding.geocodeService({
        apikey: 'AAPKbbec8a40852d418489a6942c6bb999c0OGoOpdlPwk4Ze41rBXv4-nlfUv4gdC9eF1nl2D03hpX5NdYqZGw0fZmYgcfzS_60' // replace with your api key - https://developers.arcgis.com
    });
    geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
        console.log('code click: ' + result.address.CountryCode);
        cords_click = result.address.CountryCode;
        geoguesser(cords_click);
        /* if (error) {
            return;
        }

        L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup(); */
    });
});
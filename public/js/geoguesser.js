window.onload = function() {
        /* cords_click = null;
        valor_geo = document.getElementById('valor_cons_geo').value; */
        geoguesser( /* cords_click */ );
        i = 0;
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

map.setLayoutProperty('country-label', 'text-field', ['get', `name_es`]);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 18,
    id: 'mapbox/streets-v10',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibGF1cmFmZXJuYW5kZXoxODIiLCJhIjoiY2wwYjg0MTRqMDhpYTNkbWp6ajlscHlkOCJ9.Cdxv8cBGcFJsPag19TXOVQ'
}).addTo(map);

function geoguesser( /* cords_click */ ) {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    //Nivel animal
    /* formData.append('nivel', valor_geo);
    var datos_an = document.getElementById('img_geo');
    arr_codes = []; */
    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("POST", "geoguesser_ajax", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            /* if (respuesta == '') { */
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
            /* swal.fire({
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
            } else { */
            /* var geocoder = L.esri.Geocoding.geocodeService(); */
            /* var recarga = ''; */
            var animales = new Map();
            keys = [];
            //https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Map
            for (let i = 0; i < respuesta.length; i++) {
                if (animales.get(respuesta[i].nombre_geo) == undefined) {
                    animales.set(respuesta[i].nombre_geo, [respuesta[i].img_geo, [respuesta[i].codigo_pais_dir_geo]]);
                    /* valor = animales.get(respuesta[i].nombre_geo); */
                    /* valor[1].push(respuesta[i].codigo_pais_dir_geo) */
                    /* animales.set(respuesta[i].nombre_geo, valor); */
                    console.log(animales.get(respuesta[i].nombre_geo));
                } else {
                    valor = animales.get(respuesta[i].nombre_geo);
                    valor[1].push(respuesta[i].codigo_pais_dir_geo)
                    animales.set(respuesta[i].nombre_geo, valor);
                }
                if (!keys.includes(respuesta[i].nombre_geo)) {
                    keys.push(respuesta[i].nombre_geo);
                }
                console.log(animales[i]);
                /* array_animal.respuesta.nombre_geo = [];
                array_pais_animal[i] = [];
                if (array_animal[i].includes(respuesta.nombre_geo)) {} else {
                    array_animal[i].push(respuesta.nombre_geo);
                }
                if (array_animal[i].includes(respuesta.img_geo)) {} else {
                    array_animal[i].push(respuesta.img_geo);
                }
                if (respuesta.nombre_geo == respuesta.nombre_geo) {
                    array_pais_animal[i].push(respuesta.codigo_pais_dir_geo);
                } */
                /* console.log(i) */
                /* console.log(respuesta[i]); */
                /* console.log('Codigo pais: ' + respuesta[i].codigo_pais_dir_geo); */
                /* console.log('Codigo país click: ' + cords_click); */
                /* if (arr_codes.includes(respuesta[i].codigo_pais_dir_geo)) {

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
                } */
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
            console.log(animales);
            /* console.log(Object.entries(animales)); */
            random(animales, keys);
            /* datos_an.innerHTML = recarga; */
            /* console.log(recarga); */
            /* console.log('Codigo país click: ' + cords_click);
            console.log('Array paises: ' + arr_codes);
            if (cords_click == null) {

            } else {
                comprobarAnimal(cords_click, arr_codes);
            } */

            /* } */
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

/* function comprobarAnimal(cords_click, arr_codes) {
    for (let i = 0; i < arr_codes.length; i++) {
        if (cords_click == arr_codes[i]) { */
/* alertify
    .alert("Has acertado!", function() {
        alertify.message('Continuar');
    }); */
/* alertify.confirm('', 'Has acertado', function() { alertify.success('Ok') }); */
/* alertify.ok('Has acertado!'); */
/* alert('Has acertado!'); */
/* swal("Has acertado!", "success"); */
/* swal.fire({
    title: "Has acertado!!",
    icon: "success",
    timer: 2000,
    showConfirmButton: false,
    allowOutsideClick: false
}); */
/* swal({
    title: "Has acertado!!",
    text: "Se te redigirá a otra página en 5 segundos.",
    timer: 5000,
    showConfirmButton: true
}); */
/* console.log('Correcto');
valor_geo++;
console.log('valor geo: ' + valor_geo); */
/* arr_codes = [];
console.log('Array vacio: ' + arr_codes); */
/* cords_click = null;
            recarga = '';
            setTimeout(function() {
                geoguesser(cords_click);
            }, 2000);
        } else if (cords_click == null) {

        } else { */
/* alertify
    .alert("Has fallado!", function() {
        alertify.message('Probar de nuevo');
    }); */
/* alertify.confirm('', 'Has fallado', function() { alertify.success('Ok') }); */
/* alertify.ok('Has fallado, prueba de nuevo!'); */
/* arr_codes = []; */
/* alert('Has fallado!'); */
/* swal.fire({
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
} */

function random(animales, keys) {
    var array_random = [];
    for (let i = 0; i < animales.size; i++) {
        array_random.push(i);
    }
    console.log(array_random);
    rnd_ord = keys.sort(function(a, b) { return 0.5 - Math.random() });
    console.log(rnd_ord);
    var rand_animales = new Map();
    for (let i = 0; i < rnd_ord.length; i++) {
        rand_animales.set(rnd_ord[i], animales.get(rnd_ord[i]));
    }
    console.log(rand_animales);
    /* for (let i = 0; i < rand_animales.length; i++) {
        rand_animales[i].forEach((values, keys) => {
            console.log(keys + ' img: ' + values[0] + ' paises: ' + values[1])
        })
    } */
    /* nom_an = []; */
    /* var i = 0;
    rand_animales.forEach(keys => {
        nom_an[i] = keys;
        i++;
    }); */
    /* var i = 0; */
    /* for (var key in rand_animales) {
        alert(key);
        i++;
    } */
    arr = [];
    arr_nom = [];
    for (const [name, value] of rand_animales) {
        arr.push({ name, value });
        arr_nom.push({ name });
    }
    console.log(arr);
    console.log(arr_nom);
    comprobarAnimal();
    /* anterior = ''; */
    /*  console.log(nom_an); */
}

map.on('click', function(e) {
    /* arr_codes = []; */
    var geocodeService = L.esri.Geocoding.geocodeService({
        apikey: 'AAPKbbec8a40852d418489a6942c6bb999c0OGoOpdlPwk4Ze41rBXv4-nlfUv4gdC9eF1nl2D03hpX5NdYqZGw0fZmYgcfzS_60' // replace with your api key - https://developers.arcgis.com
    });
    geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
        console.log('code click: ' + result.address.CountryCode);
        cords_click = result.address.CountryCode;
        comprobarAnimal();
        /* random(cords_click); */
        /* geoguesser(cords_click); */
        /* if (error) {
            return;
        }

        L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup(); */
    });
});

function comprobarAnimal() {
    cont_fin_jug = arr.length;
    console.log('Valor del contador: ' + cont_fin_jug)
    var datos_an = document.getElementById('img_geo');
    /* for (let i = k; i < arr.length; i++) { */
    datos_an.innerHTML = '<p>' + arr_nom[i]['name'] + '</p><img class="img_an" src="' + arr[i]['value'][0] + '">';
    /* alert(arr_nom[i]['name']); */
    console.log(arr_nom[i]['name']);
    console.log('Img: ' + arr[i]['value'][0]);
    console.log('Codes: ' + arr[i]['value'][1]);
    /*  if (cords_click == null) {
         alert('Clica en el lugar donde creas que es el animal');
     } else  */
    if (arr[i]['value'][1].includes(cords_click)) {
        /* alert('Has acertado'); */
        swal.fire({
            title: "Has acertado!!",
            icon: "success",
            timer: 2000,
            showConfirmButton: false,
            allowOutsideClick: false
        });
        console.log('Correcto');
        /* cords_click = null; */
        /* setTimeout(function() {
            geoguesser(cords_click);
        }, 2000); */
        i++;
        if (i == cont_fin_jug) {
            /* alert('Juego finalizado'); */
            console.log('Juego finalizado');
            /* swal({
                title: "Has acertado!!",
                text: "Se te redigirá a otra página en 5 segundos.",
                timer: 5000,
                showConfirmButton: true
            }); */
            /* swal.fire({
                title: "Has acertado!!",
                text: 'Se te redigirá a otra página en 5 segundos.',
                icon: "success",
                timer: 5000,
                showConfirmButton: false,
                allowOutsideClick: false
            }); */

            let timerInterval

            Swal.fire({
                title: 'Se ha acabado el juego.',
                html: 'Se te redigirá a otra página en <strong></strong> segundos.<br/><br/>',
                icon: "info",
                timer: 5000,
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    timerInterval = setInterval(() => {
                        Swal.getHtmlContainer().querySelector('strong')
                            .textContent = (Swal.getTimerLeft() / 1000)
                            .toFixed(0)
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })

            setTimeout(function() {
                window.location.href = "geoguesser";
            }, 5000);
            /* swal({
            title: "Has acertado!!",
            text: "Se te redigirá a otra página en 5 segundos.",
            timer: 5000,
            showConfirmButton: true
        }); */
        } else {
            setTimeout(function() {
                datos_an.innerHTML = '<p>' + arr_nom[i]['name'] + '</p><img class="img_an" src="' + arr[i]['value'][0] + '">';;
            }, 2000);
        }
    } else {
        /* alert('Has fallado!'); */
        swal.fire({
            title: "Has fallado!!",
            icon: "error",
            timer: 2000,
            showConfirmButton: false,
            allowOutsideClick: false
        });
        console.log('Incorrecto');
        /* cords_click = null; */
        /* setTimeout(function() {
            geoguesser(cords_click);
        }, 2000); */
    }
    console.log('Valor de i: ' + i);
}
/* } */
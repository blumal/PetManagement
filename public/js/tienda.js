window.onload = function() {
    marcas();
    tiposPrincipales()
    productos()
    document.getElementById('search').addEventListener("input", function(event) {
        searchBarEmpty()
    });
}

window.back = function() {
    marcas();
    tiposPrincipales()
    productos()
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


function marcas() {
    var divMarcas = document.getElementsByClassName("filtro-marca")[0];
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    var ajax = objetoAjax();

    ajax.open("POST", "marcas", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            divMarcas.innerHTML = "";
            var html = "<p>Marca:</p>";
            for (let i = 0; i < respuesta.length; i++) {
                html += "<label class='container'>" + respuesta[i].marca_ma + "";
                html += "<input type='checkbox' id='marca" + respuesta[i].id_ma + "' name='marcas' value=" + respuesta[i].id_ma + " onclick='filtro3()' data-nombre='" + respuesta[i].marca_ma + "'>";
                html += "<span class='checkmark'></span>";
                html += "</label>";
            }
            divMarcas.innerHTML = html;
        }
    }

    ajax.send(formData);
}

function tiposPrincipales() {
    var divTipos = document.getElementsByClassName("fitro-categoria")[0];
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    var ajax = objetoAjax();

    ajax.open("POST", "tiposPrincipales", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            divTipos.innerHTML = "";
            var html = "";
            for (let i = 0; i < respuesta.length; i++) {
                html += " <div class='categoria' data-categoria='" + respuesta[i].tipo_articulo_ta + "' onclick='filtro2(this)'>";
                html += "<p>" + respuesta[i].tipo_articulo_ta + "</p>";
                html += "</div>";
            }
            divTipos.innerHTML = html;
        }
    }

    ajax.send(formData);
}

function productos() {
    var divProductos = document.getElementsByClassName("productos")[0];
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    var ajax = objetoAjax();

    ajax.open("POST", "productos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            divProductos.innerHTML = "";
            var html = "<p>Lo más vendido</p>";
            for (let i = 0; i < respuesta.length; i++) {
                var nombre = respuesta[i].nombre_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>El pienso natural super premium Criadores Adulto con cordero...</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a href='add-to-cart/" + respuesta[i].id_art + "' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</a>";
            }
            divProductos.innerHTML = html;
        }
    }

    ajax.send(formData);
}


function filtro() {
    var nombre = document.getElementById("search").value;
    var formData = new FormData();
    //var selected = [];
    $('input[name="marcas"]:checked').each(function() {
        //selected.push(this.value);
        formData.append('marcas[]', this.value);
    });
    var orden = document.querySelector('input[name="precio"]:checked').value;


    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('nombre', nombre);
    formData.append('_method', 'POST');


    formData.append('orden', orden);
    var ajax = objetoAjax();

    ajax.open("POST", "filtroSearchBar", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var divProductos = document.getElementsByClassName("productos")[0];
            var respuesta = JSON.parse(this.responseText);
            divProductos.innerHTML = "";
            var marcasHTML = []
            $('input[name="marcas"]:checked').each(function() {
                marcasHTML.push(this.getAttribute("data-nombre"));
            });
            marcasHTML = marcasHTML.join(" '");
            marcasHTML = marcasHTML.toString();
            if (marcasHTML == "") {
                var html = "<p>Resultados por '" + document.getElementById("search").value + "'</p>";
            } else {
                var html = "<p>Resultados por '" + document.getElementById("search").value + "' en marcas '" + marcasHTML + "'</p>";
            }
            for (let i = 0; i < respuesta.length; i++) {
                var nombre = respuesta[i].nombre_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>El pienso natural super premium Criadores Adulto con cordero...</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a href='add-to-cart/" + respuesta[i].id_art + "' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</a>";
            }
            divProductos.innerHTML = html;
            searchBarEmpty()

        }
    }

    ajax.send(formData);

}


function filtro2(categoria) {
    document.getElementById("search").value = ""
    categoria = $(categoria).attr("data-categoria");
    var formData = new FormData();
    $('input[name="marcas"]:checked').each(function() {
        //selected.push(this.value);
        formData.append('marcas[]', this.value);
    });
    var orden = document.querySelector('input[name="precio"]:checked').value;

    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('categoria', categoria);
    formData.append('_method', 'POST');

    formData.append('orden', orden);
    var ajax = objetoAjax();

    ajax.open("POST", "filtroCatPrinc", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var divProductos = document.getElementsByClassName("productos")[0];
            var respuesta = JSON.parse(this.responseText);
            divProductos.innerHTML = "";
            var marcasHTML = []
            $('input[name="marcas"]:checked').each(function() {
                marcasHTML.push(this.getAttribute("data-nombre"));
            });
            marcasHTML = marcasHTML.join(" '");
            marcasHTML = marcasHTML.toString();
            if (marcasHTML == "") {
                var html = "<p>Resultados por '" + categoria + "'</p>";
            } else {
                var html = "<p>Resultados por '" + categoria + "' en marcas '" + marcasHTML + "'</p>";
            }

            for (let i = 0; i < respuesta.length; i++) {
                var nombre = respuesta[i].nombre_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>El pienso natural super premium Criadores Adulto con cordero...</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a href='add-to-cart/" + respuesta[i].id_art + "' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</a>";
            }
            divProductos.innerHTML = html;

        }
    }

    ajax.send(formData);


}

function filtro3() {
    var nombre = document.getElementById("search").value;
    var formData = new FormData();
    $('input[name="marcas"]:checked').each(function() {
        formData.append('marcas[]', this.value);
    });
    var orden = document.querySelector('input[name="precio"]:checked').value;


    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('nombre', nombre);
    formData.append('_method', 'POST');


    formData.append('orden', orden);
    var ajax = objetoAjax();

    ajax.open("POST", "filtroSearchBar", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var divProductos = document.getElementsByClassName("productos")[0];
            var respuesta = JSON.parse(this.responseText);
            divProductos.innerHTML = "";
            var marcasHTML = []
            $('input[name="marcas"]:checked').each(function() {
                marcasHTML.push(this.getAttribute("data-nombre"));
            });
            marcasHTML = marcasHTML.join(" '");
            marcasHTML = marcasHTML.toString();
            if (document.getElementById("search").value == "") {
                resultado = "Resultados por marcas '" + marcasHTML + "'"
            } else {
                resultado = "Resultados por '" + document.getElementById("search").value + "' y marcas '" + marcasHTML + "' "
            }
            var html = "<p>" + resultado + "</p>";
            for (let i = 0; i < respuesta.length; i++) {
                var nombre = respuesta[i].nombre_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>El pienso natural super premium Criadores Adulto con cordero...</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a href='add-to-cart/" + respuesta[i].id_art + "' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</a>";
            }
            divProductos.innerHTML = html;
            marcasEmpty()

        }
    }

    ajax.send(formData);

}

function filtro4() {
    var orden = document.querySelector('input[name="precio"]:checked').value;
    var resultadoBusqueda = $('.productos').find('p:first').text();
    var divProductos = document.getElementsByClassName("productos")[0];
    var productos = [];
    $(".producto").each(function() {
        var producto = []

        var href = $(this).find('a').attr('href');
        var id = $(this).attr('data-id');
        var nombre = $(this).find('h5').text();
        var descripcion = $(this).find('.caption-descripcion').find('p').text();
        var precio = $(this).find('.producto-precio').find('p').text();
        var precio2 = precio.substring(0, precio.length - 1);
        producto.push(href)
        producto.push(id)
        producto.push(nombre)
        producto.push(descripcion)
        producto.push(precio)
        producto.push(precio2)
        productos.push(producto)
    });

    if (orden == "ASC") {

        productos.sort(function(a, b) {
            a = a[5];
            b = b[5];

            return parseFloat(a) - parseFloat(b);
        });
    } else {
        productos.sort(function(a, b) {
            a = a[5];
            b = b[5];

            return parseFloat(b) - parseFloat(a);
        });
    }
    var divProductos = document.getElementsByClassName("productos")[0];
    divProductos.innerHTML = "";
    console.log(productos[0][0])
    console.log(productos[0][1])
    console.log(productos[0][2])
    console.log(productos[0][3])
    console.log(productos[0][4])
    console.log(productos[0][5])
    var html = "<p>" + resultadoBusqueda + "</p>";
    for (let i = 0; i < productos.length; i++) {
        var nombre = productos[i][2];
        if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
        html += "<a href='" + productos[i][0] + "'>";
        html += " <div class='producto' data-id='" + productos[i][1] + "'>";
        html += "<div class='thumbnail'>";
        html += "<div class='thumbnail-img'><img src='' width='500' height='200'></div>";
        html += "<div class='caption'>";
        html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
        html += "<div class='caption-descripcion'><p>" + productos[i][3] + "</p></div>";
        html += "<div class='producto-precio'><p>" + productos[i][4] + "</p></div>";
        html += "<p class='btn-holder'><a href='add-to-cart/" + respuesta[i].id_art + "' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</a>";
    }
    divProductos.innerHTML = html;
}

function searchBarEmpty() {
    if (document.getElementById("search").value == "") {
        //$('.productos').find('p:first').text("Lo más vendido")
        marcasEmpty()
    }
}

function marcasEmpty() {
    if ($('input[name="marcas"]:checkbox:checked').length == 0) {
        $('.productos').find('p:first').text("Lo más vendido")
    } else {
        var marcasHTML = []
        $('input[name="marcas"]:checked').each(function() {
            marcasHTML.push(this.getAttribute("data-nombre"));
        });
        marcasHTML = marcasHTML.join(" '");
        marcasHTML = marcasHTML.toString();
        $('.productos').find('p:first').text("Resultados por marcas '" + marcasHTML + "'")
    }
}
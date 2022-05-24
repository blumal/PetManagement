window.onload = function() {

        marcas();
        //tiposPrincipales()
        productos()
        document.getElementById('search').addEventListener("input", function(event) {
            searchBarEmpty()
        });
        var header = document.getElementById('Header')

        window.addEventListener("scroll", function() {
                var scroll = window.scrollY;
                if (scrollY > 0) {
                    header.style.backgroundColor = '#8590ff';


                } else {
                    header.style.backgroundColor = '#8590ff';

                }

            })
            //funcionalidad menu desplegable
        $(document).ready(function() {
            $('.dropdown-submenu').hover(function() {
                $('.dropdown-submenu>.dropdown-toggle', this).trigger('click');
            });
            $('.dropdown-submenu a.btn-sub-categoria').on("click", function(e) {
                //$('.dropdown-submenu>ul').hide();
                //$(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });


        });
    }
    /*
    window.onbeforeunload = function() {
        cartBack()
    }
    */
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

/*
function tiposPrincipales() {
    var divTipos = document.getElementsByClassName("fitro-categoria")[0];
    divTipos.innerHTML = "";
    var html = "";
    //perro
    html += "<div class='btn-group div-categoria'>";
    html += "<button type='button' class='btn btn-lg btn-categoria dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Perros</button>";
    html += "<span class='sr-only'>Toggle Dropdown</span>";
    html += "</button>";
    html += "<div class='dropdown-menu'>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='pienso para perro' onclick='filtro2(this)'>Pienso para perro</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='comida humeda para perro' onclick='filtro2(this)'>Comida húmeda</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='snacks para perro' onclick='filtro2(this)'>Snacks</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='repelentes para perro' onclick='filtro2(this)'>Repelentes para perro</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='accesorios para perro' onclick='filtro2(this)'>Accesorios para perro</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='juguetes para perro' onclick='filtro2(this)'>Juguetes</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='salud e higiene para perro' onclick='filtro2(this)'>Salud e higiene</button>";
    html += "</div>";
    html += "</div>";
    //gato
    html += "<div class='btn-group div-categoria'>";
    html += "<button type='button' class='btn btn-lg btn-categoria dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Gatos</button>";
    html += "<span class='sr-only'>Toggle Dropdown</span>";
    html += "</button>";
    html += "<div class='dropdown-menu'>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='pienso para gato' onclick='filtro2(this)'>Pienso para gato</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='comida humeda para gato' onclick='filtro2(this)'>Comida húmeda</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='snacks para gato' onclick='filtro2(this)'>Snacks</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='repelentes para gato' onclick='filtro2(this)'>Repelentes para gato</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='accesorios para gato' onclick='filtro2(this)'>Accesorios para gato</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='juguetes para gato' onclick='filtro2(this)'>Juguetes</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='salud e higiene para gato' onclick='filtro2(this)'>Salud e higiene</button>";
    html += "</div>";
    html += "</div>";
    //roedores
    html += "<div class='btn-group div-categoria'>";
    html += "<button type='button' class='btn btn-lg btn-categoria dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Roedores</button>";
    html += "<span class='sr-only'>Toggle Dropdown</span>";
    html += "</button>";
    html += "<div class='dropdown-menu'>";
    //roedores-jerbos
    html += "<button type='button' class='btn btn-lg btn-sub-categoria dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Jerbos</button>";
    html += "<span class='sr-only'>Toggle Dropdown</span>";
    html += "<div class='dropdown-menu'>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='comida y snacks para jerbo' onclick='filtro2(this)'>Comida y snacks</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='accesorios' onclick='filtro2(this)'>Accesorios</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='henos' onclick='filtro2(this)'>Henos</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='higiene y desinfección para jerbo' onclick='filtro2(this)'>Higiene y desinfección</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='salud para jerbo' onclick='filtro2(this)'>Salud</button>";
    html += "</div>";
    //roedores-hamsters
    html += "<button type='button' class='btn btn-lg btn-sub-categoria dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hamsters</button>";
    html += "<span class='sr-only'>Toggle Dropdown</span>";
    html += "</button>";
    html += "<div class='dropdown-menu'>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='comida y snacks para hamster' onclick='filtro2(this)'>Comida y snacks</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='accesorios' onclick='filtro2(this)'>Accesorios</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='henos' onclick='filtro2(this)'>Henos</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='higiene y desinfección para hamster' onclick='filtro2(this)'>Higiene y desinfección</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='salud para hamster' onclick='filtro2(this)'>Salud</button>";
    html += "</div>";
    //roedores-ratones
    html += "<button type='button' class='btn btn-lg btn-sub-categoria dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Ratas y ratones</button>";
    html += "<span class='sr-only'>Toggle Dropdown</span>";
    html += "</button>";
    html += "<div class='dropdown-menu'>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='comida y snacks para raton' onclick='filtro2(this)'>Comida y snacks</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='jaulas y transportines' onclick='filtro2(this)'>Jaulas y transportines</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='accesorios' onclick='filtro2(this)'>Accesorios</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='henos' onclick='filtro2(this)'>Henos</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='higiene y desinfección para raton' onclick='filtro2(this)'>Higiene y desinfección</button>";
    html += "<button class='dropdown-item btn btn-lg categoria' data-categoria='salud para raton' onclick='filtro2(this)'>Salud</button>";
    html += "</div>";
    //
    html += "</div>";
    html += "</div>";
    divTipos.innerHTML = html;

}
*/

function productos() {
    var divProductos = document.getElementsByClassName("productos")[0];
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    var ajax = objetoAjax();

    ajax.open("POST", "productos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText)
            var respuesta = JSON.parse(this.responseText);
            divProductos.innerHTML = "";
            var html = "<p>Lo más vendido</p>";
            for (let i = 0; i < respuesta.length; i++) {
                var nombre = respuesta[i].nombre_art;
                var descripcion = respuesta[i].descripcion_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                if (descripcion.length > 50) descripcion = descripcion.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='storage/uploads/" + respuesta[i].foto_art + "' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>" + descripcion + "</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a onclick='modal(" + respuesta[i].id_art + ")' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
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

/*
function addToCart(id) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    formData.append('_method', 'get');
    var ajax = objetoAjax();
    ajax.open("get", "add-to-cart/" + id, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(Object.keys(respuesta).length)
            var div = document.getElementsByClassName("div-dropmenu")[0];
            html = "<div class='dropdown' id='dropdown'>";
            html += "<button type='button' class='btn btn-info carrito-drop' data-toggle='dropdown'>";
            html += "<i class='fa fa-shopping-cart' aria-hidden='true'></i> Carrito <span class='badge badge-pill badge-danger'>" + Object.keys(respuesta).length + "</span>";
            html += "</button>";
            html += "<div class='dropdown-menu' id='dropdown-menu'>";
            html += "<div class='row total-header-section'>";
            html += "<div class='col-lg-6 col-sm-6 col-6'>";
            html += "<i class='fa fa-shopping-cart' aria-hidden='true'></i> <span class='badge badge-pill badge-danger'>" + Object.keys(respuesta).length + "</span>";
            html += "</div>";
            total = 0
            for (let i in respuesta) {
                total += respuesta[i].precio * respuesta[i].cantidad;
            }
            html += "<div class='col-lg-6 col-sm-6 col-6 total-section text-right'>";
            html += "<p>Total: <span class='color'>" + total.toFixed(2) + "€</span></p>";
            html += "</div>";
            html += "</div>";
            for (let i in respuesta) {
                html += "<div class='row cart-detail'>";
                html += "<div class='col-lg-4 col-sm-4 col-4 cart-detail-img'>";
                html += "<img src='storage/uploads/" + respuesta[i].foto + "'/>";
                html += "</div>";
                html += "<div class='col-lg-8 col-sm-8 col-8 cart-detail-product'>";
                html += "<p>" + respuesta[i].nombre + " (" + respuesta[i].subcategoria_texto + ")</p>";
                html += "<span class='color'>" + respuesta[i].precio + "€</span> <span class='count'> Cantidad: " + respuesta[i].cantidad + "</span>";
                html += "</div>";
                html += "</div>";
            }
            html += "<div class='row'>";
            html += "<div class='col-lg-12 col-sm-12 col-12 text-center checkout'>";
            html += "<a href='carrito' class='btn btn-block btn-carrito'>Ir al carrito</a>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            div.innerHTML = html;
        }


    }
    ajax.send(formData);
}
*/
function addToCart() {
    var subcategoria = document.querySelector('input[name="tipos"]:checked').value;
    var cantidad = $('#input-cantidad').val();
    var id = $('.modal-texto').attr('id-producto');
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    formData.append('cantidad', cantidad);
    formData.append('subcategoria', subcategoria);
    var ajax = objetoAjax();

    ajax.open("get", "add-to-cart-producto/" + id + "/" + cantidad + "/" + subcategoria, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(Object.keys(respuesta).length)
            var div = document.getElementsByClassName("div-dropmenu")[0];
            html = "<div class='dropdown' id='dropdown'>";
            html += "<button type='button' class='btn btn-info carrito-drop' data-toggle='dropdown'>";
            html += "<i class='fa fa-shopping-cart' aria-hidden='true'></i> Carrito <span class='badge badge-pill badge-danger'>" + Object.keys(respuesta).length + "</span>";
            html += "</button>";
            html += "<div class='dropdown-menu' id='dropdown-menu'>";
            html += "<div class='row total-header-section'>";
            html += "<div class='col-lg-6 col-sm-6 col-6'>";
            html += "<i class='fa fa-shopping-cart' aria-hidden='true'></i> <span class='badge badge-pill badge-danger'>" + Object.keys(respuesta).length + "</span>";
            html += "</div>";
            total = 0
            for (let i in respuesta) {
                total += respuesta[i].precio * respuesta[i].cantidad;
            }
            html += "<div class='col-lg-6 col-sm-6 col-6 total-section text-right'>";
            html += "<p>Total: <span class='color'>" + total.toFixed(2) + "€</span></p>";
            html += "</div>";
            html += "</div>";
            for (let i in respuesta) {
                html += "<div class='row cart-detail'>";
                html += "<div class='col-lg-4 col-sm-4 col-4 cart-detail-img'>";
                html += "<img src='storage/uploads/" + respuesta[i].foto + "'/>";
                html += "</div>";
                html += "<div class='col-lg-8 col-sm-8 col-8 cart-detail-product'>";
                html += "<p>" + respuesta[i].nombre + " (" + respuesta[i].subcategoria_texto + ")</p>";
                html += "<span class='color'>" + respuesta[i].precio + "€</span> <span class='count'> Cantidad: " + respuesta[i].cantidad + "</span>";
                html += "</div>";
                html += "</div>";
            }
            html += "<div class='row'>";
            html += "<div class='col-lg-12 col-sm-12 col-12 text-center checkout'>";
            html += "<a href='carrito' class='btn btn-block btn-carrito'>Ir al carrito</a>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            div.innerHTML = html;
            var subcategoriaTexto = document.querySelector('input[name="tipos"]:checked').getAttribute("data-texto");
            var nombre = $('.modal-texto').find("h5:first").text();
            var modal = document.getElementById("myModal2");
            modal.style.display = "none";
            var divModal = document.getElementsByClassName("div-modal3")[0];
            html = "<span class='close3'>&times;</span>"
            html += "<p class='text-center mt-5'><i class='fa fa-thumbs-up fa-5x'></i></p>";
            html += "<h4 class='text-center mt-3'>Has añadido x" + cantidad + " " + nombre + " (" + subcategoriaTexto + ") al carrito!</h4>";
            html += "<div class='div-seguir3 mr-1'><button type='button' class='btn btn-outline-primary btn-block btn-mas3 salir3'>Seguir mirando</button></div>";
            html += "<div class='div-pagar3 ml-1'><a href='carrito'><button type='button' class='btn btn-primary btn-block btn-pagar3'>Ir a pagar</button></a></div>";
            divModal.innerHTML = html;
            var modal = document.getElementById("myModal3");
            var span = document.getElementsByClassName("close3")[0];
            var span2 = document.getElementsByClassName("salir3")[0];
            modal.style.display = "block";
            span.onclick = function() {
                modal.style.display = "none";
            }
            span2.onclick = function() {
                modal.style.display = "none";

            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
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

    //NUEVO
    var palabras = nombre.split(" ");
    console.log(palabras)
    for (let i = 0; i < palabras.length; ++i) {
        if (palabras[i] == "de" || palabras[i] == "para" || palabras[i] == "e" || palabras[i] == "y" || palabras[i] == "") {} else {
            formData.append('palabras[]', palabras[i]);
        }
    };
    //FIN NUEVO
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
                var descripcion = respuesta[i].descripcion_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                if (descripcion.length > 50) descripcion = descripcion.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='storage/uploads/" + respuesta[i].foto_art + "' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>" + descripcion + "</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a onclick='modal(" + respuesta[i].id_art + ")' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
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
                var descripcion = respuesta[i].descripcion_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                if (descripcion.length > 50) descripcion = descripcion.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='storage/uploads/" + respuesta[i].foto_art + "' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>" + descripcion + "</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a onclick='modal(" + respuesta[i].id_art + ")' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
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

    //NUEVO
    if (nombre == "") {} else {
        var palabras = nombre.split(" ");
        for (let i = 0; i < palabras.length; ++i) {
            if (palabras[i] == "de" || palabras[i] == "para" || palabras[i] == "e" || palabras[i] == "y") {} else {
                formData.append('palabras[]', palabras[i]);
            }
        };
    }

    //FIN NUEVO
    var ajax = objetoAjax();

    ajax.open("POST", "filtroSearchBar", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var divProductos = document.getElementsByClassName("productos")[0];
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
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
                var descripcion = respuesta[i].descripcion_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                if (descripcion.length > 50) descripcion = descripcion.substring(0, 50) + "...";
                html += "<a href='producto/" + respuesta[i].id_art + "'>";
                html += " <div class='producto' data-id='product" + respuesta[i].id_art + "'>";
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='storage/uploads/" + respuesta[i].foto_art + "' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>" + descripcion + "</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "<p class='btn-holder'><a onclick='modal(" + respuesta[i].id_art + ")' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
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
        var foto = $(this).find('.thumbnail-img').find('img').attr('src');
        var id2 = id.substring(id.length, 7);
        producto.push(href)
        producto.push(id)
        producto.push(nombre)
        producto.push(descripcion)
        producto.push(precio)
        producto.push(precio2)
        productos.push(producto)
        producto.push(foto)
        producto.push(id2)
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
    console.log(productos[0][6])
    console.log(productos[0][7])
    var html = "<p>" + resultadoBusqueda + "</p>";
    for (let i = 0; i < productos.length; i++) {
        var nombre = productos[i][2];
        if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
        html += "<a href='" + productos[i][0] + "'>";
        html += " <div class='producto' data-id='" + productos[i][1] + "'>";
        html += "<div class='thumbnail'>";
        html += "<div class='thumbnail-img'><img src='" + productos[i][6] + "' width='500' height='200'></div>";
        html += "<div class='caption'>";
        html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
        html += "<div class='caption-descripcion'><p>" + productos[i][3] + "</p></div>";
        html += "<div class='producto-precio'><p>" + productos[i][4] + "</p></div>";
        html += "<p class='btn-holder'><a onclick='modal(" + productos[i][7] + ")' class='btn btn-block btn-carrito' role='button'>Añadir al carrito</a> </p>";
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
        if (document.getElementById("search").value == "") {
            $('.productos').find('p:first').text("Lo más vendido")
            productos();
        } else {
            $('.productos').find('p:first').text("Resultados por '" + document.getElementById("search").value + "'")
        }
    } else {
        var marcasHTML = []
        $('input[name="marcas"]:checked').each(function() {
            marcasHTML.push(this.getAttribute("data-nombre"));
        });
        marcasHTML = marcasHTML.join(" '");
        marcasHTML = marcasHTML.toString();
        if (document.getElementById("search").value == "") {
            $('.productos').find('p:first').text("Resultados por marcas '" + marcasHTML + "'")
            filtro3();
        } else {
            $('.productos').find('p:first').text("Resultados por '" + document.getElementById("search").value + "' y marcas '" + marcasHTML + "'")
        }

    }
}

function modal(id) {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    var ajax = objetoAjax();
    ajax.open("post", "getProduct", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var divModal = document.getElementsByClassName("div-modal")[0];
            var html = "<span class='close2'>&times;</span>";
            html += "<div class='div-img'><img src='storage/uploads/" + respuesta[0][0].foto_art + "'></div>";
            html += "<div class='modal-texto' id-producto='" + respuesta[0][0].id_art + "'>";
            html += "<h5>" + respuesta[0][0].nombre_art + "</h5>";
            html += "<p class='text-uppercase bold'>" + respuesta[0][0].tipo_categoria_art + ":</p>";
            html += "<div>";
            for (let i = 0; i < respuesta[1].length; i++) {
                if (i == 0) {
                    html += "<input type='radio' class='btn-check' name='tipos' value='" + respuesta[1][i].id_cat + "' id='tipo" + respuesta[1][i].id_cat + "' data-texto='" + respuesta[1][i].texto_cat + "' checked>";
                } else {
                    html += "<input type='radio' class='btn-check' name='tipos' value='" + respuesta[1][i].id_cat + "' id='tipo" + respuesta[1][i].id_cat + "' data-texto='" + respuesta[1][i].texto_cat + "'>";
                }
                html += "<label class='btn btn-secondary tipo' for='tipo" + respuesta[1][i].id_cat + "' data-id='" + respuesta[1][i].id_cat + "'>";
                html += "<div class='tipo-texto'><p class='text-left'>" + respuesta[1][i].texto_cat + "</p></div>";
                html += "<div class='precio-texto'><p class='text-left'>" + respuesta[1][i].precio_cat + "€</p></div>";
                html += "</label>";
            }
            html += "</div>";
            html += "<div class='div-pagar'>";
            html += "<div class='input-cantidad'><input type='number' value='1' class='form-control quantity' max='5001' min='1' id='input-cantidad'/></div>";
            html += "<div class='cantidad-precio'><p id='precio-final'>" + respuesta[0][0].precio_art + "€</p></div>";
            html += "<div class='anadir-carrito'><a onclick='limite()' class='btn btn-block btn-carrito'>Añadir al carrito</a></div>";
            html += "</div>";
            html += "</div>";
            html += "";

            divModal.innerHTML = html;
            var precio = $(".tipo:first").find('p:eq(1)').text();
            precio = precio.substring(0, precio.length - 1);
            $('.tipo').click(function() {
                precio = $(this).find('p:eq(1)').text();
                $("#precio-final").text(precio)
                calcularPrecio(precio);
            });

            $("#input-cantidad").bind('keyup mouseup', function() {
                calcularPrecio(precio);
            });


            var modal = document.getElementById("myModal2");
            var span = document.getElementsByClassName("close2")[0];
            modal.style.display = "block";
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    }
    ajax.send(formData);
}


function calcularPrecio(precio) {
    var cantidad = document.getElementById("input-cantidad").value
    precio = precio.substring(0, precio.length - 1);
    var final = cantidad * precio;
    final = final.toFixed(2);
    $("#precio-final").text(final + "€")
        //sesiones
        //var id = $('.producto').attr('id-producto');
    var divHtml = document.getElementsByClassName("anadir-carrito")[0];
    divHtml.innerHTML = "<a onclick='limite()' class='btn btn-block btn-carrito'>Añadir al carrito</a>";

}

function limite() {
    /*NO ESTA SOLUCIONADO, HABRIA QUE CAMBIAR TODA LA ESTRUCTURA DEL ARRAY DE SESION, RECORRERLO, VER
    SI ESE PRODUCTO YA ESTÁ EN LA SESION, SUMAR LA CANTIDAD YA METIDA CON LA QUE SE VA A METER, Y COMPARAR*/
    var subcategoria = document.querySelector('input[name="tipos"]:checked').value;
    var cantidad = $('#input-cantidad').val();
    //console.log(sesion)
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('subcategoria', subcategoria);
    var ajax = objetoAjax();
    ajax.open("post", "limiteCarrito", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            if (cantidad > respuesta[0].cantidad) {
                alert("Solo puedes comprar un máximo de " + respuesta[0].cantidad + " unidades de este producto.")
            } else {
                addToCart()
            }
        }
    }
    ajax.send(formData);
}
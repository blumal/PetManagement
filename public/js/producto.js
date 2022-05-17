window.onload = function() {
    $("#input-cantidad").bind('keyup mouseup', function() {
        calcularPrecio(precio);
    });
    opiniones()
    productosSimilares()
    modalImg()

    var header = document.getElementById('Header')

    window.addEventListener("scroll", function() {
        var scroll = window.scrollY;
        if (scrollY > 0) {
            header.style.backgroundColor = '#8590ff';

        } else {
            header.style.backgroundColor = '8590ff';
        }

    })

    var precio = $(".tipo:first").find('p:eq(1)').text();
    precio = precio.substring(0, precio.length - 1);

    $('.tipo').click(function() {
        //$(".tipo").css({ border: "1px solid rgba(185, 178, 178, 0.37)" });
        //$(this).css({ border: "1px solid #1f2cc4" });
        precio = $(this).find('p:eq(1)').text();
        console.log(precio)
        $("#precio-final").text(precio)
        calcularPrecio(precio);
    });
    fotos();

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

function calcularPrecio(precio) {
    var cantidad = document.getElementById("input-cantidad").value
    precio = precio.substring(0, precio.length - 1);
    var final = cantidad * precio;
    final = final.toFixed(2);
    $("#precio-final").text(final + "€")
        //sesiones
    var id = $('.producto').attr('id-producto');
    var divHtml = document.getElementsByClassName("anadir-carrito")[0];
    console.log(cantidad)
    divHtml.innerHTML = "<a onclick='addToCart()' class='btn btn-block btn-carrito'>Añadir al carrito</a>";

}

function addToCart() {
    var subcategoria = document.querySelector('input[name="tipos"]:checked').value;
    var cantidad = $('#input-cantidad').val();
    var id = $('.producto').attr('id-producto');
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    formData.append('cantidad', cantidad);
    formData.append('subcategoria', subcategoria);
    var ajax = objetoAjax();

    ajax.open("get", "../add-to-cart-producto/" + id + "/" + cantidad + "/" + subcategoria, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(Object.keys(respuesta).length)
            var subcategoriaTexto = document.querySelector('input[name="tipos"]:checked').getAttribute("data-texto");
            $(".div-modal:first").find('h4:first').text("Has añadido x" + cantidad + " " + $(".nombre:first").find('h4:first').text() + " (" + subcategoriaTexto + ") al carrito!");
            modal()
            var div = document.getElementsByClassName("div-dropmenu")[0];
            html = "<div class='dropdown'>";
            html += "<button type='button' class='btn btn-info carrito-drop' data-toggle='dropdown'>";
            html += "<i class='fa fa-shopping-cart' aria-hidden='true'></i> Carrito <span class='badge badge-pill badge-danger'>" + Object.keys(respuesta).length + "</span>";
            html += "</button>";
            html += "<div class='dropdown-menu'>";
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
                html += "<img src='../storage/uploads/" + respuesta[i].foto + "'/>";
                html += "</div>";
                html += "<div class='col-lg-8 col-sm-8 col-8 cart-detail-product'>";
                html += "<p>" + respuesta[i].nombre + " (" + respuesta[i].subcategoria_texto + ")</p>";
                html += "<span class='color'>" + respuesta[i].precio + "€</span> <span class='count'> Cantidad: " + respuesta[i].cantidad + "</span>";
                html += "</div>";
                html += "</div>";
            }
            html += "<div class='row'>";
            html += "<div class='col-lg-12 col-sm-12 col-12 text-center checkout'>";
            html += "<a href='../carrito' class='btn btn-block btn-carrito'>Ir al carrito</a>";
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



function fotos() {
    var prin = document.getElementById("principal")
    var uno = document.getElementById("1")
    var dos = document.getElementById("2")
    var tres = document.getElementById("3")
    var cuatro = document.getElementById("4")
    if (uno != null) {
        var fotoPrinc = $('.img_pral:first').find('img').attr('src');
        var nomPrinc = $('.img_pral:first').find('img').attr('alt');
        var foto1 = $('.subImg_1:first').find('img').attr('src');
        var foto2 = $('.subImg_1:eq(1)').find('img').attr('src');
        var foto3 = $('.subImg_1:eq(2)').find('img').attr('src');
        var foto4 = $('.subImg_1:eq(3)').find('img').attr('src');


        uno.addEventListener('click', function(event) {
            prin.innerHTML = "<img id='myImg' alt='" + nomPrinc + "' src='" + foto1 + "'>"
            uno.innerHTML = "<img src='" + fotoPrinc + "'>"
            uno.style.border = "1px solid #1f2cc4"
            dos.style.border = "1px solid #ffffff"
            tres.style.border = "1px solid #ffffff"
            cuatro.style.border = "1px solid #ffffff"
            fotos()
            modalImg()
        });
        dos.addEventListener('click', function(event) {
            prin.innerHTML = "<img id='myImg' alt='" + nomPrinc + "' src='" + foto2 + "'>"
            dos.innerHTML = "<img src='" + fotoPrinc + "'>"
            dos.style.border = "1px solid #1f2cc4"
            uno.style.border = "1px solid #ffffff"
            tres.style.border = "1px solid #ffffff"
            cuatro.style.border = "1px solid #ffffff"
            fotos()
            modalImg()
        });
        tres.addEventListener('click', function(event) {
            prin.innerHTML = "<img id='myImg' alt='" + nomPrinc + "' src='" + foto3 + "'>"
            tres.innerHTML = "<img src='" + fotoPrinc + "'>"
            tres.style.border = "1px solid #1f2cc4"
            dos.style.border = "1px solid #ffffff"
            uno.style.border = "1px solid #ffffff"
            cuatro.style.border = "1px solid #ffffff"
            fotos()
            modalImg()
        });
        cuatro.addEventListener('click', function(event) {
            prin.innerHTML = "<img id='myImg' alt='" + nomPrinc + "' src='" + foto4 + "'>"
            cuatro.innerHTML = "<img src='" + fotoPrinc + "'>"
            cuatro.style.border = "1px solid #1f2cc4"
            dos.style.border = "1px solid #ffffff"
            tres.style.border = "1px solid #ffffff"
            uno.style.border = "1px solid #ffffff"
            fotos()
            modalImg()
        });
    }



}


//modal img
function modalImg() {
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        document.getElementsByTagName("html")[0].style.overflow = "hidden"
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        document.getElementsByTagName("html")[0].style.overflow = "scroll"
    }
}


function productosSimilares() {
    var id_tipo = $('.producto').attr('id_tipo_articulo_fk');
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id_tipo);
    var ajax = objetoAjax();

    ajax.open("POST", "../productosSimilares", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var divProductos = document.getElementsByClassName("productos-similares")[0];
            divProductos.innerHTML = "";
            var html = "<p>Productos similares</p>";
            html += "<div class='carousel-inner'>";
            for (let i = 0; i < respuesta.length; i++) {
                var nombre = respuesta[i].nombre_art;
                var descripcion = respuesta[i].descripcion_art;
                if (nombre.length > 50) nombre = nombre.substring(0, 50) + "...";
                if (descripcion.length > 50) descripcion = descripcion.substring(0, 50) + "...";
                html += "<a href='../producto/" + respuesta[i].id_art + "'>";
                if (i > 3) { html += " <div class='producto-similar carousel-item' data-id='product" + respuesta[i].id_art + "'>"; } else { html += " <div class='producto-similar carousel-item active' data-id='product" + respuesta[i].id_art + "'>"; }
                html += "<div class='thumbnail'>";
                html += "<div class='thumbnail-img'><img src='../storage/uploads/" + respuesta[i].foto_art + "' width='500' height='200'></div>";
                html += "<div class='caption'>";
                html += "<div class='caption-titulo'><h5>" + nombre + "</h5></div>";
                html += "<div class='caption-descripcion'><p>" + descripcion + "</p></div>";
                html += "<div class='producto-precio'><p>" + respuesta[i].precio_art + "€</p></div>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                html += "</a>";
            }
            html += "</div>";
            html += "<a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'><span class='carousel-control-prev-icon' aria-hidden='true'></span><span class='sr-only'>Previous</span></a>";
            html += "<a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'><span class='carousel-control-next-icon' aria-hidden='true'></span><span class='sr-only'>Next</span>";
            divProductos.innerHTML = html;
        }
    }

    ajax.send(formData);
}

function opiniones() {
    var id = $('.producto').attr('id-producto');
    var nombreProducto = $('.nombre:first').find('h4').text();
    console.log(nombreProducto)
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    var ajax = objetoAjax();
    ajax.open("POST", "../productosOpiniones", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var divProductos = document.getElementsByClassName("opiniones")[0];
            var media = 0;
            divProductos.innerHTML = "";
            var html = "<div style='width: 100%'><p style='float:left; margin: 0%'>Opiniones sobre " + nombreProducto + "</p><span class='badge badge-pill badge-danger ml-2'>" + respuesta.length + "</span></div>";
            if (respuesta.length > 0) {
                html += "<div class='div-opiniones mb-5'>";
                html += "";
                for (let i = 0; i < respuesta.length; i++) {
                    media += respuesta[i].valoracion_op
                }
                media = media / respuesta.length;
                for (let i = 0; i < 2; i++) {
                    html += "<div class='opinion mb-2'>";
                    html += "<div class='opinion-nombre'><p><strong>" + respuesta[i].nombre_us + " " + respuesta[i].apellido1_us + "</strong></p>";
                    html += "<p><span>";
                    var valoracion = respuesta[i].valoracion_op;
                    for (let i = 0; i < valoracion; i++) {
                        html += "<i class='fas fa-star fa-1x'></i>";
                    }
                    html += "</span>";
                    html += "</p>";
                    html += "</div>";
                    html += "<div class='opinion-texto'><p>" + respuesta[i].texto_op + "</p></div>";
                    html += "</div>";
                }

                html += "<div class='text-center'><button type='button' class='btn btn-outline-primary btn-sm btn-mas' onclick='opinionesTodas()'>Leer más opiniones</button></div>"
                html += "</div>";
                html += "<div class='div-valoracion'>";
                html += "<p style='font-size: 3vh; font-weight: bold;'>Valoración</p>";
                html += "<p><strong>" + media + "</strong> de <strong>5</strong>";
                html += "<span class='ml-3'>";
                for (let i = 0; i < media; i++) {
                    html += "<i class='fas fa-star fa-1x'></i>";
                }
                html += "</span>";
                html += "</p>";
                if (respuesta.length > 1) {
                    html += "<p><strong>" + respuesta.length + "</strong> clientes han valorado este producto</p>";
                } else {
                    html += "<p><strong>" + respuesta.length + "</strong> cliente ha valorado este producto</p>";
                }
                html += "<div><button type='button' class='btn btn-primary btn-sm btn-valorar' onclick='modalValorar()'>Valorar este producto</button></div>";
                html += "</div>";
            } else {
                html += "<div class='div-valoracion'>";
                html += "<p class='mt-4'>Nadie ha valorado este producto todavía. Sé el primero.</p>";
                html += "<div><button type='button' class='btn btn-primary btn-sm btn-valorar' onclick='modalValorar()'>Valorar este producto</button></div>";
                html += "</div>";

            }

            divProductos.innerHTML = html;
        }
    }

    ajax.send(formData);
}

function opinionesTodas() {
    var id = $('.producto').attr('id-producto');
    var nombreProducto = $('.nombre:first').find('h4').text();
    console.log(nombreProducto)
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    var ajax = objetoAjax();
    ajax.open("POST", "../productosOpinionesTodas", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var divProductos = document.getElementsByClassName("opiniones")[0];
            var media = 0;
            divProductos.innerHTML = "";
            var html = "<div style='width: 100%'><p style='float:left; margin: 0%'>Opiniones sobre " + nombreProducto + "</p><span class='badge badge-pill badge-danger ml-2'>" + respuesta.length + "</span></div>";
            if (respuesta.length > 0) {
                html += "<div class='div-opiniones mb-5'>";
                html += "";
                for (let i = 0; i < respuesta.length; i++) {
                    media += respuesta[i].valoracion_op
                    html += "<div class='opinion mb-2'>";
                    html += "<div class='opinion-nombre'><p><strong>" + respuesta[i].nombre_us + " " + respuesta[i].apellido1_us + "</strong></p>";
                    html += "<p><span>";
                    var valoracion = respuesta[i].valoracion_op;
                    for (let i = 0; i < valoracion; i++) {
                        html += "<i class='fas fa-star fa-1x'></i>";
                    }
                    html += "</span>";
                    html += "</p>";
                    html += "</div>";
                    html += "<div class='opinion-texto'><p>" + respuesta[i].texto_op + "</p></div>";
                    html += "</div>";
                }
                media = media / respuesta.length;
                html += "<div class='text-center'><button type='button' class='btn btn-outline-primary btn-sm btn-mas' onclick='opiniones()'>Leer menos</button></div>"
                html += "</div>";
                html += "<div class='div-valoracion'>";
                html += "<p style='font-size: 3vh; font-weight: bold;'>Valoración</p>";
                html += "<p><strong>" + media + "</strong> de <strong>5</strong>";
                html += "<span class='ml-3'>";
                for (let i = 0; i < media; i++) {
                    html += "<i class='fas fa-star fa-1x'></i>";
                }
                html += "</span>";
                html += "</p>";
                if (respuesta.length > 1) {
                    html += "<p><strong>" + respuesta.length + "</strong> clientes han valorado este producto</p>";
                } else {
                    html += "<p><strong>" + respuesta.length + "</strong> cliente ha valorado este producto</p>";
                }
                html += "<div><button type='button' class='btn btn-primary btn-sm btn-valorar' onclick='modalValorar()'>Valorar este producto</button></div>";
                html += "</div>";
            } else {
                html += "<div class='div-valoracion'>";
                html += "<p class='mt-2'>Nadie ha valorado este producto todavía</p>";
                html += "</div>";
            }

            divProductos.innerHTML = html;
        }
    }

    ajax.send(formData);
}

function modal() {
    var modal = document.getElementById("myModal2");
    var span = document.getElementsByClassName("close2")[0];
    var span2 = document.getElementsByClassName("salir")[0];
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

function modalValorar() {
    var modal = document.getElementById("myModal3");
    var span = document.getElementsByClassName("close3")[0];
    modal.style.display = "block";
    span.onclick = function() {
        modal.style.display = "none";

    }
    window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";

            }
        }
        //NO TOCAR
    const ratingStars = [...document.getElementsByClassName("rating__star")];
    const ratingResult = document.querySelector(".rating__result");

    printRatingResult(ratingResult);

    function executeRating(stars, result) {
        const starClassActive = "rating__star fas fa-star";
        const starClassUnactive = "rating__star far fa-star";
        const starsLength = stars.length;
        let i;
        stars.map((star) => {
            star.onclick = () => {
                i = stars.indexOf(star);

                if (star.className.indexOf(starClassUnactive) !== -1) {
                    printRatingResult(result, i + 1);
                    for (i; i >= 0; --i) stars[i].className = starClassActive;
                } else {
                    printRatingResult(result, i);
                    for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
                }
                valoracion = $('.rating__star.fas').length;
            };
        });
    }

    function printRatingResult(result, num = 0) {
        result.textContent = `${num}/5`;
        console.log(num)
    }

    executeRating(ratingStars, ratingResult);
    //NO TOCAR
}
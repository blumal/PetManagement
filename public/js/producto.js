window.onload = function() {
    $("#input-cantidad").bind('keyup mouseup', function() {
        calcularPrecio(precio);
    });
    fotos();
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
        $("#precio-final").text(precio)
        calcularPrecio(precio);
    });

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
    var cantidad = $('#input-cantidad').val();
    var id = $('.producto').attr('id-producto');
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    formData.append('cantidad', cantidad);
    var ajax = objetoAjax();

    ajax.open("get", "../add-to-cart-producto/" + id + "/" + cantidad + "", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(Object.keys(respuesta).length)
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
            html += "<p>Total: <span class='color'>" + total + "€</span></p>";
            html += "</div>";
            html += "</div>";
            for (let i in respuesta) {
                html += "<div class='row cart-detail'>";
                html += "<div class='col-lg-4 col-sm-4 col-4 cart-detail-img'>";
                html += "<img src='../storage/uploads/" + respuesta[i].foto + "'/>";
                html += "</div>";
                html += "<div class='col-lg-8 col-sm-8 col-8 cart-detail-product'>";
                html += "<p>" + respuesta[i].nombre + "</p>";
                html += "<span class='color'>" + respuesta[i].precio + "€</span> <span class='count'> Cantidad:" + respuesta[i].cantidad + "</span>";
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



function fotos() {
    var prin = document.getElementById("principal")
    var uno = document.getElementById("1")
    var dos = document.getElementById("2")
    var tres = document.getElementById("3")
    var cuatro = document.getElementById("4")

    var fotoPrinc = $('.img_pral:first').find('img').attr('src');
    var foto1 = $('.subImg_1:first').find('img').attr('src');
    var foto2 = $('.subImg_1:eq(1)').find('img').attr('src');
    var foto3 = $('.subImg_1:eq(2)').find('img').attr('src');
    var foto4 = $('.subImg_1:eq(3)').find('img').attr('src');

    uno.addEventListener('mouseover', function(event) {
        prin.innerHTML = "<img src='" + foto1 + "'>"
    });
    dos.addEventListener('mouseover', function(event) {
        prin.innerHTML = "<img src='" + foto2 + "'>"
    });
    tres.addEventListener('mouseover', function(event) {
        prin.innerHTML = "<img src='" + foto3 + "'>"
    });
    cuatro.addEventListener('mouseover', function(event) {
        prin.innerHTML = "<img src='" + foto4 + "'>"
    });

    uno.addEventListener('mouseout', function(event) {
        prin.innerHTML = "<img src='" + fotoPrinc + "'>"
    });
    dos.addEventListener('mouseout', function(event) {
        prin.innerHTML = "<img src='" + fotoPrinc + "'>"
    });
    tres.addEventListener('mouseout', function(event) {
        prin.innerHTML = "<img src='" + fotoPrinc + "'>"
    });
    cuatro.addEventListener('mouseout', function(event) {
        prin.innerHTML = "<img src='" + fotoPrinc + "'>"
    });
}

function subcategorias() {
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    var ajax = objetoAjax();

    ajax.open("POST", "p", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            var html = "<p>aaa</p>";
            for (let i = 0; i < respuesta.length; i++) {

            }
        }
    }

    ajax.send(formData);
}
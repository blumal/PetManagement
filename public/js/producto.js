window.onload = function() {
    $("#input-cantidad").bind('keyup mouseup', function() {
        calcularPrecio();
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

function calcularPrecio() {
    var cantidad = document.getElementById("input-cantidad").value
    var precio = $(".precio").find("p").text();
    precio = precio.substring(0, precio.length - 1);
    var final = cantidad * precio;
    final = final.toFixed(2);
    $("#precio-final").text(final + "€")
        //sesiones
    var id = $('.producto').attr('id-producto');
    var divHtml = document.getElementsByClassName("anadir-carrito")[0];
    console.log(cantidad)
    divHtml.innerHTML = "<a href='../add-to-cart-producto/" + id + "/" + cantidad + "' class='btn btn-block btn-carrito'>Añadir al carrito</a>";

}
/*
function addToCart() {
    var cantidad = $('#input-cantidad').val();
    var id = $('.producto').attr('id-producto');
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id', id);
    formData.append('cantidad', cantidad);
    var ajax = objetoAjax();

    ajax.open("POST", "add-to-cart-producto", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            window.location.reload();
        }
    }

    ajax.send(formData);

}*/

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
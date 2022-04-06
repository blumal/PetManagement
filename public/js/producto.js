window.onload = function() {
    $("#input-cantidad").bind('keyup mouseup', function() {
        calcularPrecio();
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

function calcularPrecio() {
    var cantidad = document.getElementById("input-cantidad").value
    var precio = $(".precio").find("p").text();
    precio = precio.substring(0, precio.length - 1);
    var final = cantidad * precio;
    final = final.toFixed(2);
    $("#precio-final").text(final + "€")

}

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

}
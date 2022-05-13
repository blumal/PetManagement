window.onload = function() {
    id_usr = document.getElementById('id_usr').value;
    comprobar_compra();
    n_promo = [];
    v_promo = [];
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

function comprobar_compra() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    /* var id_usr = document.getElementById('id_usr'); */
    formData.append('id_usr', id_usr);
    var ajax = objetoAjax();
    ajax.open("POST", "comprobar_compra", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            compra = '';
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            /* console.log(respuesta[0]['id_fc']); */
            compra = /* JSON.stringify( */ respuesta[0]['id_fc'] /* ) */ ;
            console.log('Compra: ' + compra);
            /* for (let i = 0; i < respuesta.length; i++) {
                console.log('N COMPRAS: ' + respuesta[i].id_fc);
                compra += respuesta[i];
            } */
            if (compra % 5 == 0) {
                //Comprobamos si ha jugado ya
                comprobar_promo();
            } else {
                //Lo sacamos de la página
                /*  console.log('No'); */
                /*  comprobar_promo(); */
                volver_home();
            }
        }
    }
    ajax.send(formData);
}

function comprobar_promo() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    /* var id_usr = document.getElementById('id_usr'); */
    formData.append('id_usr', id_usr);
    var ajax = objetoAjax();
    ajax.open("POST", "comprobar_promo", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            promo = '';
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            console.log('Promo: ' + respuesta[0]['comprobar_cli_pro']);
            /* for (let i = 0; i < respuesta.length; i++) {
                console.log('Promo usada: ' + respuesta[i].comprobar_cli_pro);
                promo += respuesta[i];
            } */
            if (promo == 0) {
                //Le dejamos Jugar
                /* console.log('Ok'); */
                ruleta_jug();
            } else {
                //Lo sacamos de la página
                volver_home();
            }
        }
    }
    ajax.send(formData);
}

function volver_home() {
    window.location.href = "/www/PetManagement/public/";
}

function ruleta_jug() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('_method', 'get');
    var ajax = objetoAjax();
    ajax.open("POST", "ruleta_promo", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            for (let i = 0; i < respuesta.length; i++) {
                n_promo.push(respuesta[i].promocion_pro);
                v_promo.push(respuesta[i].porcentaje_pro);
            }
            console.log(n_promo);
            console.log(v_promo);
        }
    }
    ajax.send(formData);
}
array_premios = ["Hola", "Mundo"];
let canvas = document.getElementById("idcanvas");
let context = canvas.getContext("2d");
let center = canvas.width / 2;

for (let i = 0; i < array_premios.length; i++) {
    context.beginPath();
    context.moveTo(center, center);
    context.arc(center, center, center - 20, i * 2 * Math.PI / array_premios.length, (i + 1) * 2 * Math.PI /
        array_premios.length);
    context.lineTo(center, center);
    context.fillStyle = random_color();
    context.fill();
    context.save();
    context.translate(center, center);
    context.rotate(3 * 2 * Math.PI / (5 * array_premios.length) + i * 2 * Math.PI / array_premios.length);
    context.translate(-center, -center);
    context.font = "13px Sans Serif";
    context.textAlign = "right";
    context.fillStyle = "white";
    context.fillTest(array_premios[i], canvas.width - 30, center);
    context.restore();
}

function random_color() {
    let ar_digit = ['2', '3', '4', '5', '6', '7', '8', '9'];
    let color = '';
    let i = 0;
    while (i < 6) {
        let pos = Math.round(Math.random() * ar_digit.length - 1);
        color = color + '' + ar_digit[pos];
        i++;
    }
    return '#' + color;
}

/* const ruleta = document.querySelector('#ruleta');

ruleta.addEventListener('click', girar);
giros = 0;

function girar() {
    if (giros < 1) {
        let rand = Math.random() * 7200;
        calcular(rand);
        giros++;
        var sonido = document.querySelector('#audio');
        sonido.setAttribute('src', 'sonido/ruleta.mp3');
        document.querySelector('.contador').innerHTML = 'TURNOS: ' + giros;
    } else {
        Swal.fire({
            icon: 'success',
            title: 'VUELVA PRONTO EL JUEGO TERMINO!!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value == true) {
                giros = 0;
                document.querySelector('.elije').innerHTML = 'TU CORTESIA ES: ';
                document.querySelector('.contador').innerHTML = 'TURNOS: ' + giros;
            }
        })
    }


    function premio(premios) {

        document.querySelector('.elije').innerHTML = 'TU CORTESIA ES: ' + premios;

    }


    function calcular(rand) {

        valor = rand / 360;
        valor = (valor - parseInt(valor.toString().split(".")[0])) * 360;
        ruleta.style.transform = "rotate(" + rand + "deg)";

        setTimeout(() => {
            switch (true) {
                case valor > 0 && valor <= 45:
                    premio(n_promo[0]);
                    break;
                case valor > 45 && valor <= 90:
                    premio("5 Piezas");
                    break;
                case valor > 90 && valor <= 135:
                    premio("2 Corazón");
                    break;
                case valor > 135 && valor <= 180:
                    premio("2 Nigiri");
                    break;
                case valor > 180 && valor <= 225:
                    premio("Handroll Mini");
                    break;
                case valor > 225 && valor <= 270:
                    premio("NO HAY CORTESIAS ESTA VEZ");
                    break;
                case valor > 270 && valor <= 315:
                    premio("Una Coca Cola de 2L");
                    break;
                case valor > 315 && valor <= 360:
                    premio("2 Enjoy");
                    break;
            }

        }, 500000);
    }
} */
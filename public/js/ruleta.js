window.onload = function() {
    id_usr = document.getElementById('id_usr').value;
    comprobar_compra();
    id_promo = [];
    n_promo = [];
    v_promo = [];
    n_promo_rand = [];
    id_promo_rand = [];
    /* ruleta_colores(); */
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
    comprobar_promo();
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
            /* promo = ''; */
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            console.log('Promo: ' + respuesta[0]['comprobar_cli_pro']);
            /* for (let i = 0; i < respuesta.length; i++) {
                console.log('Promo usada: ' + respuesta[i].comprobar_cli_pro);
                promo += respuesta[i];
            } */
            if (respuesta[0]['comprobar_cli_pro'] == 0) {
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
    window.location.href = "/";
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
                id_promo.push(respuesta[i]);
                n_promo.push(respuesta[i].promocion_pro);
                v_promo.push(respuesta[i].porcentaje_pro);
            }
            /* console.log(n_promo);
            console.log(v_promo); */
        }
        console.log(id_promo);
        console.log(n_promo);
        n_promo_rand = n_promo.sort(function() { return Math.random() - 0.5 });
        id_promo_rand = id_promo.sort(function() { return Math.random() - 0.5 });
        console.log(n_promo_rand);
        console.log(id_promo_rand);
        ruleta_colores();
    }
    ajax.send(formData);
}

function ruleta_colores() {
    /* array_premios = ["Hola", "Mundo"]; */
    let canvas = document.getElementById("idcanvas");
    let context = canvas.getContext("2d");
    let center = canvas.width / 2;

    for (let i = 0; i < id_promo_rand.length; i++) {
        context.beginPath();
        context.moveTo(center, center);
        context.arc(center, center, center - 20, i * 2 * Math.PI / id_promo_rand.length, (i + 1) * 2 * Math.PI /
            id_promo_rand.length);
        context.lineTo(center, center);
        context.fillStyle = random_color();
        context.fill();
        context.save();
        context.translate(center, center);
        context.rotate(3 * 2 * Math.PI / (5 * id_promo_rand.length) + i * 2 * Math.PI / id_promo_rand.length);
        context.translate(-center, -center);
        context.font = "22px Sans Serif";
        context.textAlign = "right";
        context.fillStyle = "white";
        context.fillText(id_promo_rand[i]['promocion_pro'], canvas.width - 30, center);
        context.restore();
    }
}

function random_color() {
    /* let ar_digit = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    let color = '';
    let i = 0;
    while (i < 6) {
        let pos = Math.round(Math.random() * ar_digit.length - 1);
        color = color + '' + ar_digit[pos];
        i++;
    }
    return '#' + color; */
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

let clic = 0;
let pos_ini = 0;
let movement;

function sortear() {
    btn = document.getElementById("btn_srt");
    if (clic == 0) {
        btn.disabled = true;
        /* let rand = Math.random() * 7200; */
        clic++;
        let canvas = document.getElementById("idcanvas");
        /* valor = rand / 360;
        valor = (valor - parseInt(valor.toString().split(".")[0])) * 360;
        canvas.style.transform = "rotate(" + rand + "deg)"; */
        movement = setInterval(function() {
            pos_ini += 10;
            canvas.style.transform = 'rotate(' + pos_ini + 'deg)';
        }, 10);
        setTimeout(function() {
            clearInterval(movement);
            premio();
        }, 5000);
    } else {
        /* swal.fire({
            title: 'Ya has jugado!',
            icon: "error",
            timer: 2000,
            showConfirmButton: false,
            allowOutsideClick: false
        }); */
    }
}

function premio() {
    swal.fire({
        /* title: id_promo_rand[1], */
        /* icon: "success", */
        imageUrl: 'https://c.tenor.com/6B-Jw3LhNpMAAAAC/felicidades-congratulations.gif',
        title: 'Te ha tocado: ',
        html: id_promo_rand[1]['promocion_pro'],
        timer: 2000,
        showConfirmButton: false,
        allowOutsideClick: false
    });
    setTimeout(function() {
        usr_jug();
    }, 2000);
    /* alert(id_promo_rand[1]); */
    console.log(id_promo_rand[1]['id_pro']);
}

function usr_jug() {
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('id_usr', id_usr);
    formData.append('_method', 'get');
    var ajax = objetoAjax();
    ajax.open("POST", "premio", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText);
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta['resultado']);
            if (respuesta['resultado'] == 'Ok') {
                console.log(respuesta)
                premio_promo();
            }
        }
    }
    ajax.send(formData);
}


function premio_promo() {
    id_premio = id_promo_rand[1]['id_pro'];
    var formData = new FormData();
    //Enviamso el token
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //Enviamos el metodo que en este caso es get
    formData.append('id_usr', id_usr);
    formData.append('id_promo', id_premio);
    formData.append('_method', 'get');
    var ajax = objetoAjax();
    ajax.open("POST", "premio_promo", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(this.responseText);
            //recogemos los datos que nos devuelve el json en la variable respuesta
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta);
            if (respuesta['resultado'] == 'OK') {
                Swal.fire({
                    icon: "info",
                    title: 'Podrás utilizar este descuento a partir de la próxima visita.',
                    html: 'Se te redigirá a otra página en <strong></strong> segundos.<br/><br/>',
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
                    volver_home();
                }, 5000);
            }
        }
    }
    ajax.send(formData);
}
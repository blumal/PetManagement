window.onload = function() {
    leer();
    labelsX = [];
    dataY = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    colores = [];

    leerCompras();
    labelsXmeses = [];
    dataYcompras = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    leerEspecies();
    labelsXEspecies = [];

    leerVisitasMeses();
    dataYvisitaspormeses = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    leerSociedades();
    labelsXsociedades = [];
    dataYsociedades = [];

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

//VISITAS POR HORAS
var horas = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12",
    "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"
]

function leer() {

    var ajax = objetoAjax();
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');

    ajax.open("POST", "estadisticas/visitas_por_horas", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            //console.log(respuesta)

            horas.forEach(hora => {
                labelsX.push(hora)
            });
            //labelsX.push(meses);

            for (var i = 0; i < respuesta.length; i++) {

                dataY[respuesta[i].hour - 1] = respuesta[i].COUNT
            }
            // creamos el chart
            chartCreate();
        }
    }

    ajax.send(formdata)
}

function chartCreate() {
    const data = {
        labels: labelsX,
        datasets: [{
            label: 'Numero de visitas por horas',
            backgroundColor: 'black',
            borderColor: 'white',
            data: dataY,
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
    const myChart2 = new Chart(
        document.getElementById('chart_visitasxhoras'),
        config
    );
}
//COMPRAS POR MES//
var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]


function leerCompras() {

    var ajax = objetoAjax();
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');

    ajax.open("POST", "estadisticas/recogerStats", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            meses.forEach(mes => {
                labelsXmeses.push(mes)
            });
            //labelsXmeses.push(meses);

            for (var i = 0; i < respuesta.length; i++) {

                dataYcompras[respuesta[i].MONTH - 1] = respuesta[0].COUNT
            }
            // creamos el chart
            chartCreateCompras();
        }
    }

    ajax.send(formdata)
}

function chartCreateCompras() {
    const datacompras = {
        labels: labelsXmeses,
        datasets: [{
            label: 'Numero de pedidos por mes',
            backgroundColor: 'black',
            borderColor: 'white',
            data: dataYcompras,
            //data: [10, 20, 30, 40, 50, 60, 70],
        }]
    };
    const configcompras = {
        type: 'line',
        data: datacompras,
        options: {}
    };
    const myChartcompras = new Chart(
        document.getElementById('chart_pedidosxmes'),
        configcompras
    );
}

//GRAFICO DE PACIENTES POR NOMBRE CIENTIFICO

function leerEspecies() {

    var ajax = objetoAjax();
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');

    ajax.open("POST", "estadisticas/animales_por_especie", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            //console.log(respuesta)

            for (let i = 0; i < respuesta[0].length; i++) {
                labelsXEspecies.push(respuesta[0][i].nombrecientifico_pa)
            }

            //labelsXEspecies.push(meses);

            for (var i = 0; i < respuesta[1].length; i++) {

                dataY[i] = respuesta[1][i].cont
            }
            // creamos el chart
            chartCreateEspecies();
        }
    }

    ajax.send(formdata)
}

function chartCreateEspecies() {
    const dataespecies = {
        labels: labelsXEspecies,
        datasets: [{
            label: 'Pacientes por especie',
            backgroundColor: 'white',
            borderColor: 'black',
            data: dataY,
        }]
    };
    const configespecies = {
        type: 'bar',
        data: dataespecies,
        options: {}
    };
    const myChart3 = new Chart(
        document.getElementById('chart_pacientesxnombre'),
        configespecies
    );
}

// GRAFICO DE VISITAS POR MESES

function leerVisitasMeses() {

    var ajax = objetoAjax();
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');

    ajax.open("POST", "estadisticas/visitas_por_meses", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            //console.log(respuesta)
            //meses.forEach(mes => { labelsX.push(mes)});
            //labelsXmeses.push(meses);

            for (var i = 0; i < respuesta.length; i++) {

                dataYvisitaspormeses[respuesta[i].MONTH - 1] = respuesta[i].COUNT
            }
            // creamos el chart
            chartCreateVisitasMeses();
        }
    }

    ajax.send(formdata)
}

function chartCreateVisitasMeses() {
    const datacompras = {
        labels: labelsXmeses,
        datasets: [{
            label: 'Numero de visitas por mes',
            backgroundColor: 'black',
            borderColor: 'white',
            data: dataYvisitaspormeses,
            //data: [10, 20, 30, 40, 50, 60, 70],
        }]
    };
    const configcompras = {
        type: 'line',
        data: datacompras,
        options: {}
    };
    const myChartVisitas = new Chart(
        document.getElementById('chart_visitasxmeses'),
        configcompras
    );
}

//GRAFICO DE TIPOS DE PROTECTORAS

function leerSociedades() {

    var ajax = objetoAjax();
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');

    ajax.open("POST", "estadisticas/tipos_sociedades", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)

            for (let i = 0; i < respuesta.length; i++) {
                labelsXsociedades.push(respuesta[i].sociedad_ts)
            }

            //labelsXEspecies.push(meses);

            for (var i = 0; i < respuesta.length; i++) {

                dataYsociedades[i] = respuesta[i].cont
            }
            // creamos el chart
            charCreateSociedades();
        }
    }

    ajax.send(formdata)
}

function charCreateSociedades() {
    const datasociedades = {
        labels: labelsXsociedades,
        datasets: [{
            label: 'Sociedades por tipo',
            backgroundColor: 'white',
            borderColor: 'black',
            data: dataYsociedades,
        }]
    };
    const configespecies = {
        type: 'pie',
        data: datasociedades,
        options: {}
    };
    const myChart4 = new Chart(
        document.getElementById('chart_sociedadesxtipo'),
        configespecies
    );
}
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
    color = ['blue','red','yellow','green','orange','pink','purple','white'];

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


// --------------- VISITAS POR HORAS --------------- //
var horas = ["00 a.m.", "01 a.m.", "02 a.m.", "03 a.m.", "04 a.m.", "05 a.m.", "06 a.m.", "07 a.m.", "08 a.m.", "09 a.m.", "10 a.m.", "11 a.m.", "12 p.m.",
    "13 p.m.", "14 p.m.", "15 p.m.", "16 p.m.", "17 p.m.", "18 p.m.", "19 p.m.", "20 p.m.", "21 p.m.", "22 p.m.", "23 p.m."]

// const NAMED_COLORS = [CHART_COLORS.red, CHART_COLORS.orange, CHART_COLORS.yellow, CHART_COLORS.green, CHART_COLORS.blue, CHART_COLORS.purple, CHART_COLORS.grey];

const CHART_COLORS = {
    red: 'rgb(255, 255, 255)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'};

let width, height, gradient;
function getGradient(ctx, chartArea) {
  const chartWidth = chartArea.right - chartArea.left;
  const chartHeight = chartArea.bottom - chartArea.top;
  if (!gradient || width == chartWidth || height == chartHeight) {
    // Create the gradient because this is either the first render
    // or the size of the chart has changed
    width = chartWidth;
    height = chartHeight;
    gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
    gradient.addColorStop(0, Utils.CHART_COLORS.red);
    gradient.addColorStop(0.5, Utils.CHART_COLORS.yellow);
    gradient.addColorStop(1, Utils.CHART_COLORS.green);
  }

  return gradient;
}

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
            data: horas,
            // data: Utils.colors(CHART_COLORS),
            borderColor: function(context) {
                const chart = context.chart;
                const {ctx, chartArea} = chart;
                if (!chartArea) {
                    // This case happens on initial chart load
                    return;
                }
                return getGradient(ctx, chartArea);
            },
            backgroundColor: 'black',
            borderColor: 'fuchsia',
            data: dataY
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
              x: {
                ticks: {
                    color: 'black',
                }
              },
              y: {
                ticks: {
                    color: 'black',
                }
              }
            }
        }
    };
    const myChart2 = new Chart(
        document.getElementById('chart_visitasxhoras'),
        config
    );
}

// --------------- COMPRAS POR MES --------------- //
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
            borderColor: 'red',
            data: dataYcompras,
            //data: [10, 20, 30, 40, 50, 60, 70],
        }]
    };
    const configcompras = {
        type: 'line',
        data: datacompras,
        options: {
            scales: {
              x: {
                ticks: {
                    color: 'black',
                }
              },
              y: {
                ticks: {
                    color: 'black',
                }
              }
            }
        }
    };
    const myChartcompras = new Chart(
        document.getElementById('chart_pedidosxmes'),
        configcompras
    );
}

// --------------- GRAFICO DE PACIENTES POR NOMBRE CIENTIFICO --------------- //

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
            backgroundColor: 'lime',
            borderColor: 'black',
            borderWidth: 3,
            data: dataY,
        }]
    };
    const configespecies = {
        type: 'bar',
        data: dataespecies,
        options: {
            scales: {
              x: {
                ticks: {
                    color: 'black',
                }
              },
              y: {
                ticks: {
                    color: 'black',
                }
              }
            }
        }
    };
    const myChart3 = new Chart(
        document.getElementById('chart_pacientesxnombre'),
        configespecies
    );
}

// --------------- GRAFICO DE VISITAS POR MESES --------------- //

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
            borderColor: 'blue',
            data: dataYvisitaspormeses,
            //data: [10, 20, 30, 40, 50, 60, 70],
        }]
    };
    const configcompras = {
        type: 'line',
        data: datacompras,
        options: {
            scales: {
              x: {
                ticks: {
                    color: 'black',
                }
              },
              y: {
                ticks: {
                    color: 'black',
                }
              }
            }
        }
    };
    const myChartVisitas = new Chart(
        document.getElementById('chart_visitasxmeses'),
        configcompras
    );
}

// --------------- GRAFICO DE TIPOS DE PROTECTORAS --------------- //



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
                color.push(respuesta[i].sociedad_ts)
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
        labels: labelsXsociedades, dataYsociedades,
        datasets: [{
            label: 'Tipo de sociedad',
            backgroundColor: 'grey',
            borderColor: 'black',
            borderWidth: 3,
            data: dataYsociedades
        }]
    };
    const configespecies = {
        type: 'bar',
        data: datasociedades,
        options: {
            scales: {
                x: {
                    ticks: {
                        color: 'black'
                    }
                },
                y: {
                    ticks: {
                        color: 'black'
                    }
                }
            }
        }
    };
    const myChart4 = new Chart(
        document.getElementById('chart_sociedadesxtipo'),
        configespecies
    );
}
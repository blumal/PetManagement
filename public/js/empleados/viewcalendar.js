window.onload = function() {
    eventos = [];
    calendar();
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

//Recogida de datos SQL + inserción de los mismo en la API
function calendar() {
    //Inicialización objeto Ajax
    var ajax = objetoAjax();
    //Nuevo objeto
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'GET');

    //Datos fichero web que apunta a la función que recoge el JSON
    ajax.open("GET", "showquotes", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //Json enviado desde el controler
            console.log(this.responseText);
            //JSON desde web file
            var citas = JSON.parse(this.responseText);
            console.log(citas);
            for (let i = 0; i < citas.length; i++) {
                //Array global
                eventos.push({
                    title: "Agendada",
                    start: citas[i].fecha_vi + 'T' + citas[i].hora_vi,
                    borderColor: '#8590FF'
                })
            }
            //Funcion API
            montarCalendario();
        }
    }
    ajax.send(formdata);
}

//API
function montarCalendario() {
    var calendarEl = document.getElementById('calendar');
    //calendarEl = "";
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        //Language
        locale: "es",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek',
            borderColor: '#8590FF',
        },
        //Recogemos los campos previamente rellenados
        events: eventos,
    });
    calendar.render();
}

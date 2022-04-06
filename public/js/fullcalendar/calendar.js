window.onload = function() {
    eventos = []
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

function calendar() {
    alert('hola');
    //Inicialización objeto Ajax
    var ajax = objetoAjax();
    //Nuevo objeto
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'GET');

    //Datos fichero web
    ajax.open("GET", "showcitas", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //Json enviado desde el controler
            console.log(this.responseText);
            var citas = JSON.parse(this.responseText);
            //console.log(citas);
            for (let i = 0; i < citas.length; i++) {
                /* fechasArr.push(citas[i].fecha_vi);
                horasArr.push(citas[i].hora_vi); */
                eventos.push({
                    title: "Testing" + i,
                    start: citas[i].fecha_vi + 'T' + citas[i].hora_vi
                })
            }
            montarCalendario();
        }
    }
    ajax.send(formdata);

}

//API
function montarCalendario() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        //Language
        locale: "es",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek',
            color: 'Yellow'
        },
        events: eventos
    });
    calendar.render();
}
$(document).ready(function () {

    $.post("../../db/actualizarHorario.php", {}, function (response) {
        //Horario del peluquero
        var datos = JSON.parse(response);

        function tiempo(horaBD) {
            var tiempo = new Date(new Date().toDateString() + ' ' + horaBD);
            var hour = tiempo.getHours();
            var mins = tiempo.getMinutes();
            if(mins == '0'){
                mins += '0';
            }
            var morning_start = hour + ":" + mins;
            return morning_start;
        }
        //TODOS los select de la vista horario
        var morningStartSelects = document.querySelectorAll("#morning_start");
        var morningEndSelects = document.querySelectorAll("#morning_end");
        var afternoonStartSelects = document.querySelectorAll("#afternoon_start");
        var afternoonEndSelects = document.querySelectorAll("#afternoon_end");

        //recorre el horario del peluquero por dia
        datos.forEach(element => {

            var morning_start = tiempo(element['morning_start']);
            var morning_end = tiempo(element['morning_end']);
            var afternoon_start = tiempo(element['afternoon_start']);
            var afternoon_end = tiempo(element['afternoon_end']);

            if (element['active_morning'] == 1) {
                $("input:checkbox[value='" + element['day'] + "'][name='active_morning']").prop("checked", true)
            }
            if (element['active_afternoon'] == 1) {
                $("input:checkbox[value='" + element['day'] + "'][name='active_afternoon']").prop("checked", true)
            }
           
            for (i = 0; i < morningStartSelects[element['day']].length; i++) {                
                if (morningStartSelects[element['day']][i].value == morning_start) {
                    morningStartSelects[element['day']][i].setAttribute("selected", true);
                }
            }

            for (i = 0; i < morningEndSelects[element['day']].length; i++) {
                if (morningEndSelects[element['day']][i].value == morning_end) {
                    morningEndSelects[element['day']][i].setAttribute("selected", true);
                }
            }

            for (i = 0; i < afternoonStartSelects[element['day']].length; i++) {
                if (afternoonStartSelects[element['day']][i].value == afternoon_start) {
                    afternoonStartSelects[element['day']][i].setAttribute("selected", true);
                }
            }

            for (i = 0; i < afternoonEndSelects[element['day']].length; i++) {
                if (afternoonEndSelects[element['day']][i].value == afternoon_end) {
                    afternoonEndSelects[element['day']][i].setAttribute("selected", true);
                }
            }
        });
    });

});


$('#formHorario').submit('submit', (event) => {
    event.preventDefault();

    var active_morning = [];
    var active_afternoon = [];
    var morning_startAll, morning_start = [];
    var morning_endAll, morning_end = [];
    var afternoon_startAll, afternoon_start = [];
    var afternoon_endAll, afternoon_end = [];

    $(":checkbox[name=active_morning]").each(function () {
        if (this.checked) {
            // agregas cada elemento.            
            //active_morning.push($(this).val());
            active_morning.push(1);
        } else {
            active_morning.push(0);
        }
    });
    //console.log(active_morning)


    $(":checkbox[name=active_afternoon]").each(function () {
        if (this.checked) {
            // agregas cada elemento.
            active_afternoon.push(1);
        } else {
            active_afternoon.push(0);
        }
    });
    var morning_startAll = document.querySelectorAll('#morning_start');
    morning_startAll.forEach(element => {
        morning_start.push(element.value);
    });
    var morning_endAll = document.querySelectorAll('#morning_end');
    morning_endAll.forEach(element => {
        morning_end.push(element.value);
    });
    var afternoon_startAll = document.querySelectorAll('#afternoon_start');
    afternoon_startAll.forEach(element => {
        afternoon_start.push(element.value);
    });
    var afternoon_endAll = document.querySelectorAll('#afternoon_end');
    afternoon_endAll.forEach(element => {
        afternoon_end.push(element.value);
    });

    $.ajax({
        url: '../../db/horario.php',
        type: 'POST',
        datatype: 'json',
        data: {
            active_morning: active_morning,
            active_afternoon: active_afternoon,
            morning_start: morning_start,
            morning_end: morning_end,
            afternoon_start: afternoon_start,
            afternoon_end: afternoon_end,
        },
        success: (data) => {
            console.log(data)
            if (data[0] === '0') {
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario y/o Contraseña incorrecta',
                    background: 'darkslategrey',
                });
            } else {
                //window.location.href = '../../redirect.php';
            }
        },
    });

});
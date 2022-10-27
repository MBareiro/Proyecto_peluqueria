$(document).ready(function () {

    $("#nombre").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key) ||  $("#nombre").val().length > 50) {
          event.preventDefault();
          return false;
        }
      });

      $("#apellido").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key) ||  $("#apellido").val().length > 50) {
          event.preventDefault();
          return false;
        }
      });
   

      $("#telefono").bind('keypress', function(event) {
        if ($("#telefono").val().length > 25) {
          event.preventDefault();
          return false;
        }
      });
      

    $('#crear_turno').submit((event) => {
        event.preventDefault();
        const nombre = $.trim($('#nombre').val());
        const apellido = $.trim($('#apellido').val());
        const email = $.trim($('#email').val());
        const telefono = $.trim($('#telefono').val());
        const peluqueros = parseInt($.trim($('#peluqueros').val()));
        const fecha = $.trim($('#fecha').val());
        const horaMañana = $.trim($('#horaMañana').val());
        const horaTarde = $.trim($('#horaTarde').val());
        if (
            nombre.length === 0 ||
            typeof nombre === 'undefined' ||
            apellido.length === 0 ||
            typeof apellido === 'undefined' ||
            telefono.length === 0 ||
            typeof telefono === 'undefined' ||
            peluqueros.length === 0 ||
            typeof peluqueros === 'undefined' ||
            fecha.length === 0 ||
            typeof fecha === 'undefined' ||
            ((horaMañana.length === 0 ||
                typeof horaMañana === 'undefined') && (
                    horaTarde.length === 0 ||
                    typeof horaTarde === 'undefined'))

        ) {
            Swal.fire({
                icon: 'warning',
                title: 'Debe completar todos los campos para crear un turno',
                background: 'darkslategrey',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
            });
            return false;
        } else {
            $.ajax({
                url: '../../db/turno_crear.php',
                type: 'POST',
                datatype: 'json',
                data: {
                    nombre: nombre,
                    apellido: apellido,
                    email: email,
                    telefono: telefono,
                    peluqueros: peluqueros,
                    fecha: fecha,
                    horaMañana: horaMañana,
                    horaTarde: horaTarde,
                },
                success: (data) => {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Turno Creado Correctamente!',
                        background: 'darkslategrey',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                    $("#crear_turno").trigger("reset");
                    document.getElementById("fecha").value = "";
                    $("#hoursMorning").empty();
                    $("#hoursAfternoon").empty();
                    $('#turnoMañana').prop("checked", false);
                    $('#turnoTarde').prop("checked", false);

                },
            });
        }

    });


    $.post("../../db/turno.php", {}, function (response) {
        var datos = JSON.parse(response);
        datos.sort();
        //console.log(datos)
        var peluqueros = document.getElementById("peluqueros");
        //console.log(peluqueros)
        const option = document.createElement('option');
        peluqueros.appendChild(option);
        datos.forEach(element => {
            const option = document.createElement('option');
            option.value = element['id'];
            option.text = element['nombre'] + ' ' + element['apellido'];
            peluqueros.appendChild(option);
        });
    });

    $('#turnoMañana').change(function () {
        document.getElementById('hoursAfternoon').innerHTML = "";
        var fecha = $('#fecha').val();

        if (fecha != '') {
            var peluquero_id = $('#peluqueros').val();
            $.post("../../db/disponibilidadTurno.php", { fecha, peluquero_id }, function (response) {
                //console.log(response)
                var datos = JSON.parse(response);                
                var hoursMorning = document.getElementById("hoursMorning");
                if(datos.length != 0){
                    if (datos[0].length !== 0) {
                        var arr = Object.values(datos[0]);
                        arr.forEach(element => {
                            var horaMorn = element.slice(0, -3);
                            hoursMorning.innerHTML += `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="horaMañana" value=" ${element}">
                                <label class="form-check-label" for="flexRadioDefault1">
                                ${horaMorn}
                                </label>
                            </div>`;
                        });
                    } else {                                         
                        hoursMorning.innerHTML += `
                            <div class="form-check">
                                No hay turnos disponibles
                            </div>`;
                    }
                } else {                                    
                    hoursMorning.innerHTML += `
                        <div class="form-check">
                            No hay turnos disponibles
                        </div>`;
                }
               
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Debe seleccionar una fecha',
                background: 'darkslategrey',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
            });

            $('#turnoMañana').prop("checked", false);
        }


    });

    $('#turnoTarde').change(function () {
        document.getElementById('hoursMorning').innerHTML = "";
        var fecha = $('#fecha').val();

        if (fecha != '') {
            var peluquero_id = $('#peluqueros').val();

            $.post("../../db/disponibilidadTurno.php", { fecha, peluquero_id }, function (response) {
                
                var datos = JSON.parse(response);              
                var hoursAfternoon = document.getElementById("hoursAfternoon");
                if(datos.length != 0){
                    if (datos[1].length !== 0) {
                        var arr = Object.values(datos[1]);
                        arr.forEach(element => {
                            var horaTarde = element.slice(0, -3);
                            hoursAfternoon.innerHTML += `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="horaTarde" value=" ${element}">
                                <label class="form-check-label" for="flexRadioDefault1">
                                ${horaTarde}
                                </label>
                            </div>`;
                        });
                    } else {                    
                        hoursAfternoon.innerHTML += `
                            <div class="form-check">
                                No hay turnos disponibles
                            </div>`;
                    }
                } else {
                    hoursAfternoon.innerHTML += `
                            <div class="form-check">
                                No hay turnos disponibles
                            </div>`;
                }
                
            });


        } else {
            Swal.fire({
                icon: 'error',
                title: 'Debe seleccionar una fecha',
                background: 'darkslategrey',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
            });
            $('#turnoTarde').prop("checked", false);
        }
    });

    $('#peluqueros').change(function () {
        document.getElementById("fecha").value = "";
        $("#hoursMorning").empty();
        $("#hoursAfternoon").empty();
        $('#turnoMañana').prop("checked", false);
        $('#turnoTarde').prop("checked", false);
    });

    $('#fecha').change(function () {
        var peluquero = document.getElementById("peluqueros");
        if(peluquero.value == ""){
            Swal.fire({
                icon: 'error',
                title: 'Seleccione su peluquero',
                background: 'darkslategrey',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
            });
            document.getElementById("fecha").value = "";
        }
        $("#hoursMorning").empty();
        $("#hoursAfternoon").empty();
        $('#turnoMañana').prop("checked", false);
        $('#turnoTarde').prop("checked", false);
    });
});




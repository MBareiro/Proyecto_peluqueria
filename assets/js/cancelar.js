$(document).ready(function () {
    const turno_id = $.trim($('#turno_id').val());
    const fecha = $.trim($('#fecha').val());

    let date = new Date()
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    var hoy = year + '-' + month + '-' + day;

    if (fecha > hoy) {
        $.post("../../db/cancelarTurno.php", { turno_id }, function (response) {
            var datos = JSON.parse(response);
            if (datos === 1) {          

                Swal.fire({
                    icon: 'success',
                    title: '¡Turno cancelado!',
                    background: 'darkslategrey',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value) {
                        window.close();
                    }
                });
            } 
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: '¡No es posible cancelar el turno en el mismo dia!',
            background: 'darkslategrey',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
        }).then((result) => {
            if (result.value) {
                window.close();
            }
        });
    }
})

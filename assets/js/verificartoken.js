$('#verificartoken').submit('submit', (event) => {
    event.preventDefault();

    const p2 = $.trim($('#p2').val());
    const p1 = $.trim($('#p1').val());
    const email = $.trim($('#email').val());

    if (
        p1.length === 0 ||
        typeof p1 === 'undefined' ||
        p2.length === 0 ||
        typeof p2 === 'undefined'
    ) {
        Swal.fire({
            icon: 'warning',
            title: 'Debe completar todos los campos',
            background: 'darkslategrey',
        });
        return false;
    } else {
        $.ajax({
            url: '../../email/php/cambiarpassword.php',
            type: 'POST',
            datatype: 'json',
            data: {
                p1: p1,
                p2: p2,
                email: email
            },
            success: (data) => {
                console.log(data)
                if (data[0] === '2') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Las contraseñas no coinciden',
                        background: 'darkslategrey',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Contraseña restablecida!',
                        background: 'darkslategrey',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = '../../index.html';
                        }
                    });

                }
            },
        });
    }
});
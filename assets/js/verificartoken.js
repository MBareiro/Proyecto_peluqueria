$('#verificartoken').submit('submit', (event) => {
    event.preventDefault();

    const p2 = $.trim($('#p2').val());
    const password = $.trim($('#password').val());
    const email = $.trim($('#email').val());

    if (password !== p2) {
        Swal.fire({
            icon: 'warning',
            title: 'Ops! Las contraseñas no coinciden',
            background: 'darkslategrey',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
        });
    } else {
        if (
            password.length === 0 ||
            typeof password === 'undefined' ||
            p2.length === 0 ||
            typeof p2 === 'undefined'
        ) {
            Swal.fire({
                icon: 'warning',
                title: 'Debe completar todos los campos',
                background: 'darkslategrey',
            });
            return false;
        } else if (val_pass() != '') {
            Swal.fire({
                icon: 'warning',
                title: 'Verifique su contraseña',
                background: 'darkslategrey',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
            });
        } else {
            $.ajax({
                url: '../../email/php/cambiarpassword.php',
                type: 'POST',
                datatype: 'json',
                data: {
                    password: password,
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
    }


});

function val_pass() {
    const formato = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if (($("#password").val()).length < 8) {
        error_password = "El minimo de carácteres es 8*";
    } else if (($("#password").val()).length > 15) {
        error_password = "El maximo de carácteres es 15*";
    } else if (!$("#password").val().match(/[A-Z]/)) {
        error_password = "Debe tener al menos una letra mayúscula*";
    } else if (!$("#password").val().match(/[0-9]/)) {
        error_password = "Debe tener al menos un número*";
    } else if (formato.test($("#password").val())) {
        error_password = "Solo se aceptan numeros y letras*";
    } else {
        error_password = "";
    }
    $("#error_password").text(error_password);
    return error_password;
}

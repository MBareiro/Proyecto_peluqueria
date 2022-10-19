$('#formCorreo').submit((event) => {
    event.preventDefault();
    const email = $.trim($('#email').val());
  
    if (email === '') {
      Swal.fire({
        icon: 'warning',
        title: 'Debes completar el campo para continuar',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
      return false;
    }  else {
      $.ajax({
        url: '../../db/cambiarCorreo.php',
        type: 'POST',
        datatype: 'json',
        data: {
          email: email,
        },
        success: (data) => {
          let response = JSON.parse(data);
          if (response === false) {
            Swal.fire({
              icon: 'error',
              title: 'OOPS! Ha ocurrido un error',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
            $('#email').val('');
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Su correo se modifico correctamente!',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
          }
        },
      });
    }
  });

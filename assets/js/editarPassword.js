// Evento Submit de Editar Contraseña
$('#formPass').submit((event) => {
    event.preventDefault();
    const currentPassword = $.trim($('#currentPassword').val());
    const newPassword = $.trim($('#newPassword').val());
    const confirmPassword = $.trim($('#confirmPassword').val());
  
    if (currentPassword === '' || newPassword === '' || confirmPassword === '') {
      Swal.fire({
        icon: 'warning',
        title: 'Debes completar los 3 campos para continuar',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
      return false;
    } else if (newPassword !== confirmPassword) {
      Swal.fire({
        icon: 'warning',
        title: 'Las Contraseñas no coinciden',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
      $('#confirmPassword').val('');
    } else {
      $.ajax({
        url: '../../db/cambiarContraseña.php',
        type: 'POST',
        datatype: 'json',
        data: {
          currentPassword: currentPassword,
          newPassword: newPassword,
          confirmPassword: confirmPassword,
        },
        success: (data) => {
          let response = JSON.parse(data);
          if (response.verificar === false || response.error === 'vacio') {
            Swal.fire({
              icon: 'warning',
              title: 'La Contraseña ingresada es incorrecta',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
            $('#currentPassword').val('');
          } else if (
            response.usuario === 'no se concretó la conexion' ||
            response.error === 'vacio' ||
            response.error === 'error al inicio'
          ) {
            Swal.fire({
              icon: 'error',
              title: 'OOPS! Ha ocurrido un error',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
            $('#currentPassword').val('');
            $('#newPassword').val('');
            $('#confirmPassword').val('');
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Tu Contraseña fue modificada correctamente!',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
            $('#currentPassword').val('');
            $('#newPassword').val('');
            $('#confirmPassword').val('');
          }
        },
      });
    }
  });


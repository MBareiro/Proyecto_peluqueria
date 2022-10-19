$('#restablecerPass').submit('submit', (event) => {
    event.preventDefault();
    
    const email = $.trim($('#email').val());
  
    if (
      email.length === 0 ||
      typeof email === 'undefined' 
    ) {
      Swal.fire({
        icon: 'warning',
        title: 'Debe ingresar un email',
        background: 'darkslategrey',
      });
      return false;
    } else {
      $.ajax({
        url: '../email/php/restablecer.php',
        type: 'POST',
        datatype: 'json',
        data: {
          email: email,
        },
        success: (data) => {
          console.log(data)
          if (data === false) {
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
              title: 'Verifica tu email para restablecer tu cuenta!',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
          }
        },
      });
    }
  });
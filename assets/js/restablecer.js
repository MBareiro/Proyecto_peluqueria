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
      success: () => {
        Swal.fire({
          icon: 'success',
          title: 'Verifica tu email para restablecer tu cuenta!',
          background: 'darkslategrey',
          confirmButtonColor: '#ffa361',
          confirmButtonText: 'Ok',
        });

      },
    });
  }
});
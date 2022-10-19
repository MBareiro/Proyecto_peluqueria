$('#reset').submit('submit', (event) => {
    event.preventDefault();    
    const codigo = $.trim($('#codigo').val());  
    if (
      codigo.length === 0 ||
      typeof codigo === 'undefined' 
    ) {
      Swal.fire({
        icon: 'warning',
        title: 'Debe ingresar un codigo',
        background: 'darkslategrey',
      });
      return false;
    } else {
      $.ajax({
        url: '../email/php/verificartoken.php',
        type: 'POST',
        datatype: 'json',
        data: {
          codigo: codigo,
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
            $('#codigo').val('');
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Verifica tu codigo para restablecer tu cuenta!',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
          }
        },
      });
    }
  });
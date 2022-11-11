$('#formLogin').submit('submit', (event) => {
    event.preventDefault();
    
    const email = $.trim($('#email').val());
    const password = $.trim($('#password').val());
  
    if (
      email.length === 0 ||
      typeof email === 'undefined' ||
      password.length === 0 ||
      typeof password === 'undefined'
    ) {
      Swal.fire({
        icon: 'warning',
        title: 'Debe ingresar un email y/o contraseña',
        background: 'darkslategrey',
      });
      return false;
    } else {
      $.ajax({
        url: '../../db/login.php',
        type: 'POST',
        datatype: 'json',
        data: {
          email: email,
          password: password,
        },
        success: (data) => {
          if (data[0] === '0') {
            Swal.fire({
              icon: 'error',
              title: 'Email y/o contraseña incorrecta',
              background: 'darkslategrey',
            });
          } else {
              window.location.href = '../../redirect.php';      
          }
        },
      });
    }
  });
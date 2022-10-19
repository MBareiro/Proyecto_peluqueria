$('#formSignUp').submit((event) => {
  event.preventDefault();

  const nombre = $.trim($('#nombre').val());
  const apellido = $.trim($('#apellido').val());
  const email = $.trim($('#email').val());
  const rol = parseInt($.trim($('#rol').val()));
  const password = $.trim($('#password').val());
  const confirmPassword = $.trim($('#confirmPassword').val());

  if (password !== confirmPassword) {
    Swal.fire({
      icon: 'warning',
      title: 'OOPS! Las contraseñas no coinciden',
      background: 'darkslategrey',
      confirmButtonColor: '#ffa361',
      confirmButtonText: 'Ok',
    });
  } else {
    if (     
      nombre.length === 0 ||
      typeof nombre === 'undefined' ||
      apellido.length === 0 ||
      typeof apellido === 'undefined' ||
      email.length === 0 ||
      typeof email === 'undefined' ||
      password.length === 0 ||
      typeof password === 'undefined' ||
      rol.length === 0 ||
      typeof rol === 'undefined' ||
      confirmPassword.length === 0 ||
      typeof confirmPassword === 'undefined'
    ) {
      Swal.fire({
        icon: 'warning',
        title: 'Debe completar todos los campos para crear un Usuario',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
      return false;
    } else {
      $.ajax({
        url: '../../db/signup.php',
        type: 'POST',
        datatype: 'json',
        data: {
          nombre: nombre,
          apellido: apellido,
          email: email,          
          rol: rol,
          password: password,
        },
        success: (data) => {
          //console.log(data)
          if (data === 'false') {
            Swal.fire({
              icon: 'error',
              title: 'OOPS! Ha Ocurrido un Error Creando el Usuario',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
          } else if(data === '2'){
            Swal.fire({
              icon: 'error',
              title: 'Email existente, ingrese un email diferente',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
          }else{
            Swal.fire({
              icon: 'success',
              title: '¡Usuario Creado Correctamente!',
              background: 'darkslategrey',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            });
          }
        },
      });
    }
  }
});

$("#nombre").bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

$("#apellido").bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

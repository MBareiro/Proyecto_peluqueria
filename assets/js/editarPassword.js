$("#error_password").hide();
// Evento Submit de Editar Contraseña
$('#formPass').submit((event) => {
    event.preventDefault();
    const currentPassword = $.trim($('#currentPassword').val());
    const password = $.trim($('#password').val());
    const confirmPassword = $.trim($('#confirmPassword').val());
  
    if (currentPassword === '' || password === '' || confirmPassword === '') {
      Swal.fire({
        icon: 'warning',
        title: 'Debes completar los 3 campos para continuar',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
      return false;
    } else if (password !== confirmPassword) {
      Swal.fire({
        icon: 'warning',
        title: 'Las Contraseñas no coinciden',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
      $('#confirmPassword').val('');
    } else if(val_pass() != ''){
      Swal.fire({
        icon: 'warning',
        title: 'Verifique su contraseña',
        background: 'darkslategrey',
        confirmButtonColor: '#ffa361',
        confirmButtonText: 'Ok',
      });
    } else {      
      $.ajax({
        url: '../../db/cambiarContraseña.php',
        type: 'POST',
        datatype: 'json',
        data: {
          currentPassword: currentPassword,
          password: password,
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
            $('#password').val('');
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
            $('#password').val('');
            $('#confirmPassword').val('');
          }
        },
      });
    }
  });


  function val_pass(){    
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
    } else{
      error_password = "";
    }
    $("#error_password").text(error_password);  
    return error_password;
  }
    
  
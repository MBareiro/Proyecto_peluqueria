
$("#password").bind('keyup', function () {
    const formato = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if (($("#password").val()).length < 8) {
      $("#error_password").show();  
      error_password = "El minimo de carácteres es 8*";
    } else if (($("#password").val()).length > 15) {
      $("#error_password").show();  
      error_password = "El maximo de carácteres es 15*";
    } else if (!$("#password").val().match(/[A-Z]/)) {
      $("#error_password").show();  
      error_password = "Debe tener al menos una letra mayúscula*";
    } else if (!$("#password").val().match(/[0-9]/)) {
      $("#error_password").show();  
      error_password = "Debe tener al menos un número*";
    } else if (formato.test($("#password").val())) {
      $("#error_password").show();  
      error_password = "Solo se aceptan numeros y letras*";
    } else{
      $("#error_password").hide();  
      error_password = "";
    }
    $("#error_password").text(error_password);  
    return error_password;
});

$("#nombre").bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$("#apellido").bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

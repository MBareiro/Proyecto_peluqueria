$("#formEdit").submit(function (e) {
    e.preventDefault();   
   
    console.log($("#user_id").val())
    const postData = {
      //Toma los valores cargados en los inputs
      id: $("#user_id").val(),
      username: $("#username").val(),
      nombre: $("#nombre").val(),
      apellido: $("#apellido").val(),
      email: $("#email").val(),
      rol: $("#rol").val()
    };

    //comprueba si se esta creando un nuevo reg o actualizando
    const url = "../../db/user-edit.php";

    $.post(url, postData, function (response) {
      // Resetea el formulario despues de presionar el boton guardar
      $("#form-user").trigger("reset");
      //console.log(response);
      fetchExps();

      //document.getElementById('form-exp').reset();
    });
  });

//------------------------------------------------------------------------------------------------------Lista los registros
function fetchExps() {
    $.ajax({
        url: "../../db/user-list.php",
        type: "GET",
        success: function (response) {
            //console.log(response);
            const users = JSON.parse(response);
            let template = "";
            users.forEach((users) => {
                template += `
                <tr user_id="${users.id}">   
                  <td>${users.id}</td>          
                  <td>${users.nombre}</td>
                  <td>${users.apellido}</td>
                  <td>${users.email}</td>
                  <td>${users.rol}</td>
                  <td>                    
                    <!-- Button trigger modal -->
                    <button type="button" id="user-item" class="btn btn btn-warning user-item" data-toggle="modal" data-target="#myModal">
                        Editar
                    </button>
                  </td>    
                  <td>
                    <button class="user-delete btn btn-danger" style="width: 100%;">
                      Borrar
                    </button>
                  </td>                                
                </tr>                   
                `;
            });
            $("#users").html(template);
        },
    });
}

$(document).on("click", ".user-delete", function () {
    const element = $(this)[0].parentElement.parentElement;
    const id = $(element).attr("user_id");
    //console.log(element)
    //console.log(id)

    $.post("../../db/user-delete.php", { id }, function (response) {
        fetchExps();
        $("#form-user").trigger("reset");
    });
});

//-----------------------------------------------------------------------------------------------Editar
$(document).on("click", ".user-item", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("user_id");

    $.post("../../db/user-single.php", { id }, function (response) {
        const user = JSON.parse(response);
        //console.log(user.username)
        $("#user_id").val(user.id);
        $("#username").val(user.username);
        $("#nombre").val(user.nombre);
        $("#apellido").val(user.apellido);
        $("#email").val(user.email);
        $("#rol option[value="+ user.rol +"]").attr("selected",true);
    });
});

$(document).on("click", "#cerrarModal", function () {
    fetchExps();
});

fetchExps();


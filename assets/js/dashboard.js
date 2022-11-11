
$(document).ready(function () {
  fetchHorario(document.getElementById("fecha").value);
  mostrar();

});

$(document).on("click", "#cerrarModal", function () {
  // e.preventDefault();
  const postData = {
    //Toma los valores cargados en los inputs
    peluqueros: $("#id_user").val(),
    nombre: $("#nombre").val(),
    apellido: $("#apellido").val(),
    fecha: $("#fecha").val(),
    hora: $("#hora").val(),
  };
  //comprueba si se esta creando un nuevo reg o actualizando
  const url = "../../db/turno_crear.php";
  $.post(url, postData, function (response) {
    // Resetea el formulario despues de presionar el boton guardar
    console.log(response)
    
    $('#myModal').modal('hide');
   
    fetchHorario(document.getElementById("fecha").value);
    mostrar();
  });
  Swal.fire({
    icon: 'success',
    title: 'Correcto!',
    background: 'darkslategrey',
  });  
});


function fetchturns(fecha) {
  $.ajax({
    url: "../../db/turnos-list.php",
    type: "POST",
    data: "&fecha=" + fecha,
    success: function (response) {
      if (response !== '') {
        const turnos = JSON.parse(response);

        let horariosM = [];
        elementList = document.querySelectorAll('.hora');
        elementList.forEach(element => {
          const hora = $(element)[0].firstElementChild;
          horariosM.push(hora.innerHTML)
        });

        let horariosT = [];
        elementList = document.querySelectorAll('.hora');
        elementList.forEach(element => {
          const hora = $(element)[0].firstElementChild;
          horariosT.push(hora.innerHTML)
        });

        if (turnos[0].length !== 0) {
          let template = "";
          horariosM.forEach(hora => {

            turnos[0].forEach((turnos) => {
              if (turnos.hora.slice(0, -3) == hora) {
                let container = document.querySelector('tr[horario="' + hora + '"]');
                while (container.firstChild) {
                  container.removeChild(container.firstChild);
                  container.removeAttribute('data-toggle', 'data-target', 'onclick');
                }
                template += `                  
                    <td class='1'>${turnos.hora.slice(0, -3)}</td>
                    <td class='2'>${turnos.nombre}</td>
                    <td class='3'>${turnos.apellido}</td>
                    <td class='4' style="display:none">${turnos.telefono}</td>  
                    <td class='5' style="display:none">${turnos.email}</td> 
                    <td align='right'><button class="turn-delete btn btn btn-danger">Cancelar</button></td> 
                  `;
                $('tr[horario="' + hora + '"]').html(template);
                container.setAttribute('user_id', turnos.id);
                template = "";
              }
            });
          });
        }
        if (turnos[1].length !== 0) {
          let template2 = "";
          horariosT.forEach(hora => {

            turnos[1].forEach((turnos2) => {
              if (turnos2.hora.slice(0, -3) == hora) {
                let container = document.querySelector('tr[horario="' + hora + '"]');
                while (container.firstChild) {
                  container.removeChild(container.firstChild);
                  container.removeAttribute('data-toggle', 'data-target', 'onclick');
                }
                template2 += `
                        <td class='1'>${turnos2.hora.slice(0, -3)}</td>
                        <td class='2'>${turnos2.nombre}</td>
                        <td class='3'>${turnos2.apellido}</td> 
                        <td class='4' style="display:none">${turnos2.telefono}</td>                     
                        <td class='5' style="display:none">${turnos2.email}</td>                         
                        <td align='right'><button class="turn-delete btn btn btn-danger">Cancelar</button></td> 
                          `;
                $('tr[horario="' + hora + '"]').html(template2);
                container.setAttribute('user_id', turnos2.id);
                template2 = "";
              }
            });
          });
        }
      }
    },
  });
  mostrar();
}

function fetchHorario(fecha) {
  $.ajax({
    url: "../../db/horario-list.php",
    type: "POST",
    data: "&fecha=" + fecha,
    success: function (response) {
      if (response !== '') {
        const horario = JSON.parse(response);

        //Horarios de la ma;ana
        if (horario[0].length !== 0) {
          let template = "";
          horario[0].forEach((horario) => {
            var horaMorn = horario.slice(0, -3);
            template += `
                  <tr class="hora" horario="${horaMorn}" data-toggle="modal" data-target="#myModal" href="#" onclick="myFunction(this)" >  
                    <td class='1' ">${horaMorn}</td>
                    <td COLSPAN="5" align='right' ></td>                                      
                  </tr>                   
                  `;
          });
          $("#turnos_mañana").html(template);
        }

        //Horarios de la tarde
        if (horario[1].length !== 0) {
          let template2 = "";
          horario[1].forEach((horario2) => {
            var horaTarde = horario2.slice(0, -3);
            template2 += `
            <tr class="hora" horario="${horaTarde}" data-toggle="modal" data-target="#myModal" href="#" onclick="myFunction(this)">  
              <td class='1'>${horaTarde}</td>
              <td COLSPAN="5" align='right'></td>                                      
            </tr>                  
                `;
          });
          $("#turnos_tarde").html(template2);
        }
        fetchturns(fecha);
        mostrar();
      }
    },
  });

}

$(document).on("click", ".turn-delete", function () {
  Swal.fire({
    title: 'Estas seguro?',
    icon: 'warning',
    background: 'darkslategrey',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'No!',
    confirmButtonText: 'Si!'
  }).then((result) => {
    if (result.isConfirmed) {
      const element = $(this)[0].parentElement.parentElement;
      const turno_id = $(element).attr("user_id");

      $.post("../../db/cancelarTurno.php", { turno_id }, function (response) {
        $("#form-turn").trigger("reset");
        Swal.fire({
          title: 'Borrado!',
          icon: 'success',
          background: 'darkslategrey',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok!',
          showConfirmButton: false,
          timer: 1000
        })
        fetchHorario(document.getElementById("fecha").value);
        mostrar();
      });
      
    }
  })
});

$('#ver').change(function () {
  mostrar();
});

$('#fecha').change(function () {
  fetchHorario(document.getElementById("fecha").value);
  mostrar();
});

function mostrar() {
  var ver = $("option:selected").map(function () { return this.value }).get();
  var ops = $("option").map(function () { return this.value }).get();
  ops.forEach(dato => {
    var found = ver.find(element => element == dato);
    if (found == undefined) {
      $("." + dato + "").hide();
    } else {
      $("." + dato + "").show();
    }
  });
}

function myFunction(row) {
  $("#nombre").val("");
  $("#apellido").val("");
  $("#hora").val(row.getAttribute("horario"));
}
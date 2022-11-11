<?php
session_start();
require('../../db/conexionDb.php');

if (!isset($_SESSION['id_user']) && !isset($_SESSION['id_rol'])) {
  header('location: ../../pages/samples/error-404.html');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->

  <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

  <link rel="stylesheet" href="../../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../../assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="../../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->

  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
  <input type="hidden" value='<?php echo $_SESSION['id_rol'] ?>' id="rol">
  <div class="container-scroller">

    <?php include("../../partials/_sidebar.php"); ?>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_navbar.html -->
      <?php include("../../partials/_navbar.html"); ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col col-lg-2">
                    <h4 class="card-title">Agenda de turnos</h4>
                  </div>
                  <div class="col col-lg-3">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" value="<?php echo date('Y-m-d');?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col col-md-auto">
                    <div class="form-group">
                      <label>Ver:</label>
                      <select id="ver" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                        <option value="1" selected>Hora</option>
                        <option value="2" selected>Nombre</option>
                        <option value="3" selected>Apellido</option>
                        <option value="4">Telefono</option>
                        <option value="5">Email</option>                        
                      </select>
                    </div>
                  </div>
                </div>
                <div class="table-responsive" id='tabla'>
                  <table class="table table-dark">
                    <p>Turnos de la mañana</p>
                    <thead>
                      <tr style="background-color: black;">
                        <td class='1'>Hora</td>
                        <td class='2'>Nombre</td>
                        <td class='3'>Apellido</td>                        
                        <td class='4'>Telefono</td>
                        <td class='5'>Email</td>
                        <td class='6'></td>
                      </tr>
                    </thead>
                    <tbody id="turnos_mañana"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <div class="table-responsive" name='tabla'>
                  <table class="table table-dark">
                    <p>Turnos de la tarde</p>
                    <thead>
                      <tr style="background-color: black;">
                        <td class='1'>Hora</td>
                        <td class='2'>Nombre</td>
                        <td class='3'>Apellido</td>
                        <td class='4'>Telefono</td>
                        <td class='5'>Email</td>
                        <td class='6'></td>
                      </tr>
                    </thead>
                    <tbody id="turnos_tarde"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include("../../partials/_footer.html"); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/vendors/select2/select2.min.js"></script>
  <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- endinject -->

  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script><!-- -->
  <script src="../../assets/js/misc.js"></script><!-- -->
  <!-- endinject -->

  <!-- Custom js for this page -->
  <script src="../../assets/js/select2.js"></script>
  <script src="../../assets/js/typeahead.js"></script>
  <script src="../../assets/js/dashboard.js"></script>
  <!-- endinject -->


</body>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear turno</h4>
      </div>
      <div class="modal-body">
      <input type="hidden" value='<?php echo $_SESSION['id_user'] ?>' id="id_user">
      <input type="hidden" id="hora">
        <form id="formTurno" action="" method="POST" class="forms-sample">
          <input type="hidden" id="hora">
          <input type="hidden" id="peluquero">
          <div class="form-group row">
            <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            </div>
          </div>

          <div class="form-group row">
            <label for="apellido" class="col-sm-3 col-form-label">Apellido</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="apellido" placeholder="Apellido">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" id="cerrarModal" class="btn btn-primary mr-2">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

</html>
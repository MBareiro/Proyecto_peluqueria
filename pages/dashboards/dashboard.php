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
                  <div class="col col-lg-3" >
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha">
                  </div>
                </div>
                <div class="row">
                  <div class="col col-lg-4">
                    <div class="form-group">
                      <label>Ver:</label>
                      <select id="ver" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                        <option value="1" selected>Hora</option>
                        <option value="2" selected>Nombre</option>
                        <option value="3" selected>Apellido</option>                        
                        <option value="4">Email</option>
                        <option value="5">Telefono</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <p>Turnos de la mañana</p>
                    <thead>
                      <tr>
                        <td class='1'>Hora</td>
                        <td class='2'>Nombre</td>
                        <td class='3'>Apellido</td>      
                        <td class='4'>Email</td>
                        <td class='5'>Telefono</td>
                      </tr>
                    </thead>
                    <tbody id="users"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <div class="table-responsive">
                  <table class="table table-striped">
                    <p>Turnos de la tarde</p>
                    <thead>
                      <tr>
                      <td>Hora</td>
                        <td class='2'>Nombre</td>
                        <td class='3'>Apellido</td>                        
                        <td class='4'>Fecha</td>
                        <td class='5'>Telefono</td>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- endinject -->

  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script><!-- -->
  <script src="../../assets/js/misc.js"></script><!-- -->
  <!-- endinject -->

  <!-- Custom js for this page -->

  <script src="../../assets/vendors/select2/select2.min.js"></script>
  <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../assets/js/dashboard.js"></script>
  <script src="../../assets/js/select2.js"></script>
  <script src="../../assets/js/typeahead.js"></script>


  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../../assets/js/typeahead.js"></script>
  <script src="../../assets/js/select2.js"></script>
  <!-- End custom js for this page -->
</body>

</html>
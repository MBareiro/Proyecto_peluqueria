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
                  <div class="col col-lg-3">
                    <h4 class="card-title">Agenda de turnos</h4>
                  </div>
                  <div class="col col-lg-4"><label for="fecha">
                      Seleccione una fecha:
                      <input type="date" id="fecha">
                    </label></div>
                </div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <p>Turnos de la mañana</p>
                    <thead>
                      <tr>
                        <td>N</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Hora</td>
                        <td>Fecha</td>
                        <td>Telefono</td>
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
                        <td>N</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Hora</td>
                        <td>Fecha</td>
                        <td>Telefono</td>
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
  <script src="../../assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>
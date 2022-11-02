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
  <title>Cambiar correo</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->

  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_sidebar.html -->
    <?php include("../../partials/_sidebar.php"); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_navbar.html -->
      <?php include("../../partials/_navbar.html"); ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Actualizar correo electronico</h4>

                <form id="formCorreo" class="forms-sample">
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" id="email" class="form-control" id="exampleInputUsername2" placeholder="Email" value="<?php echo $_SESSION['email'] ?>">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                </form>

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
  <script src="../../assets/js/cambiar-correo.js"></script>  
  <!-- End custom js for this page -->
</body>

</html>
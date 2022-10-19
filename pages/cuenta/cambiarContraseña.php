<?php
session_start();
require('../../db/conexionDb.php');

if (isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])) {
	$sql = 'SELECT id from roles where descripcion = "administrador"';
	$resultado = mysqli_query($conexion, $sql);
	if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
		$row = mysqli_fetch_assoc($resultado);
	}
	if (isset($row['idrol'])) {
		if ($_SESSION['id_rol'] != $row['idrol']) {
			header('location: ../../db/logout.php');
		}
	}
	mysqli_close($conexion);
} else {
	header('location: ../../pages/samples/error-404.html');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
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
                  <h4 class="card-title">Cambiar contraseña</h4>
                  
                  <form id="formPass" class="forms-sample">
                    <div class="form-group row">
                      <label for="currentPassword" class="col-sm-5 col-form-label">Contraseña actual</label>
                      <div class="col-sm-7">
                        <input type="password" class="form-control" id="currentPassword" placeholder="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="newPassword" class="col-sm-5 col-form-label">Contraseña nueva</label>
                      <div class="col-sm-7">
                        <input type="password" class="form-control" id="newPassword" placeholder="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="confirmPassword" class="col-sm-5 col-form-label">Confirmar contraseña</label>
                      <div class="col-sm-7">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="">
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                    <button class="btn btn-dark">Cancelar</button>
                  </form>
                </div>
              </div>              
            </div>           

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../../assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom js for this page -->
    <script src="../../assets/js/editarPassword.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
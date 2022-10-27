<?php
session_start();
require('../../db/conexionDb.php');

if (isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])) {
  $sql = 'SELECT id from roles where descripcion = "administrador"';
  $resultado = mysqli_query($conexion, $sql);
  if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
    $row = mysqli_fetch_assoc($resultado);
  }

  if (isset($row['id'])) {
    if ($_SESSION['id_rol'] != $row['id']) {
      header('location: ../../db/logout.php');
    }
  }
  mysqli_close($conexion);
} else {
  header('location: ../../pages/samples/error-404.html');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Crear usuario</title>
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
                <h4 class="card-title">Crear Usuario</h4>
                <form id="formSignUp" action="signup.php" method="POST" class="forms-sample">

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

                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="rol" class="col-sm-3 col-form-label">Rol</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="rol">
                        <option></option>
                        <option value="1">Administrador</option>
                        <option value="2">Peluquero</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" placeholder="Password">
                      <p id="error_password" class="text-danger"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-3 col-form-label">Re Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Crear</button>
                  <button type="reset" class="btn btn-dark">Cancelar</button>
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
  <script src="../../assets/js/createUser.js"></script>
  <script src="../../assets/js/validaciones.js"></script>
  <!-- End custom js for this page -->

</body>

</html>
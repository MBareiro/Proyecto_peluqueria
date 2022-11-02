<?php
include "../../db/conexionDb.php";

$email = $_POST['email'];
$token = $_POST['token'];
$codigo = $_POST['codigo'];

$res = $conexion->query("SELECT * from passwords_reset where 
        email='$email' and token ='$token' and codigo = $codigo") or die($conexion->error);
$correcto = false;

if (mysqli_num_rows($res) > 0) {
    $fila = mysqli_fetch_row($res);
    $fecha = $fila[4];
    $fecha_actual = date("Y-m-d h:m:s");
    $seconds = strtotime($fecha_actual) - strtotime($fecha);
    $minutos = $seconds / 60;
    /* if($minutos > 10 ){
            echo "token vencido";
        }else{
            echo "todo correcto";
        }*/
    $correcto = true;
} else {
    $correcto = false;
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
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Restablecer Password</h3>
                            <?php if ($correcto) { ?>
                                <form id="verificartoken" class="" action="" method="POST">

                                    <div class="mb-3">
                                        <label for="p1" class="form-label">Nuevo Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <p id="error_password" class="text-danger"></p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="p2" class="form-label">Confirmar Password</label>
                                        <input type="password" class="form-control" id="p2" name="p2">      
                                    </div>
                                    
                                    <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                                    <button type="submit" class="btn btn-primary">Cambiar</button>
                                </form>
                            <?php } else { ?>
                                <div class="alert alert-danger">Código incorrecto o vencido</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/verificartoken.js"></script>
    <script src="../../assets/js/validaciones.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- endinject -->
</body>

</html>
<?php
include '../../db/dias.php';
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
    <title>Horario</title>
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


                    <form id="formHorario" action="" method="POST">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gestión de horario</h4>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">

                                            <thead>
                                                <tr style="background-color: black;">
                                                    <th>Dia</th>
                                                    <th>Activo</th>
                                                    <th>Turno mañana</th>
                                                    <th>Activo</th>
                                                    <th>Turno tarde</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $dias = dias();
                                                foreach ($dias as $key => $valor) {
                                                    echo "
                                                    <tr>
                                                        <th>$valor</th>
                                                        <td>
                                                            <div class='form-check form-switch'>
                                                                <input type='checkbox' id='active_morning' name='active_morning' class='form-check-input' value='$key'>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class='row'>
                                                                <div class='col'>
                                                                    <select id='morning_start' name='morning_start[]'>";
                                                                        for ($i = 8; $i <= 12; $i++) {
                                                                            echo "<option value='$i:00'>$i:00 AM</option>";
                                                                            echo "<option value='$i:30'>$i:30 AM</option>";
                                                                        }
                                                                        echo "
                                                                    </select>
                                                                </div>
                                                                <div class='col'>
                                                                    <select id='morning_end' name='morning_end[]'>";
                                                                        for ($i = 8; $i <= 12; $i++) {
                                                                            echo "<option value='$i:00' name='$key' >$i:00 AM</option>";
                                                                            echo "<option value='$i:30' name='$key'>$i:30 AM</option>";
                                                                        }
                                                                        echo "
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class='form-check form-switch'>
                                                                <input id='active_afternoon' name='active_afternoon' class='form-check-input' type='checkbox' value='$key' >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class='row'>
                                                                <div class='col'>
                                                                    <select id='afternoon_start' name='afternoon_start[]'>";
                                                                        for ($i = 16; $i <= 20; $i++) {
                                                                            echo "<option value='$i:00'>$i:00 PM</option>";
                                                                            echo "<option value='$i:30'>$i:30 PM</option>";
                                                                        }
                                                                        echo "
                                                                    </select>
                                                                </div>
                                                                <div class='col'>
                                                                    <select id='afternoon_end' name='afternoon_end[]'>";
                                                                        for ($i = 16; $i <= 20; $i++) {
                                                                            echo "<option value='$i:00'>$i:00 PM</option>";
                                                                            echo "<option value='$i:30'>$i:30 PM</option>";
                                                                        }
                                                                        echo "
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    ";
                                                }
                                                ?>


                                            </tbody>

                                        </table>

                                    </div>
                                    </p>
                                    <div class="container"><button type="submit" class="btn btn-primary btn-fw">Guardar cambios</button></div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script src="../../assets/js/horario.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
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
    <title>Ver usuarios</title>
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
    <input type="hidden" value='<?php echo $_SESSION['id_rol'] ?>' id="rol">
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

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar Usuarios</h4>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>Id</td>
                                                <td>Nombre</td>
                                                <td>Apellido</td>
                                                <td>Email</td>
                                                <td>Rol</td>
                                            </tr>
                                        </thead>
                                        <tbody id="users"></tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar</h4>
                                </div>
                                <div class="modal-body">

                                    <form id="formEdit" action="" method="POST" class="forms-sample">
                                        <input type="hidden" class="form-control" id="user_id" placeholder="">

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
                                                <select class="form-control" id="rolEdit">
                                                    <option></option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Peluquero</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="cerrarModal" class="btn btn-primary mr-2">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
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
    <script src="../../assets/js/verUsuarios.js"></script>
    <script src="../../assets/js/validaciones.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
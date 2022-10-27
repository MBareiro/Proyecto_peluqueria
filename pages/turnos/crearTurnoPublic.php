<?php 
$Object = new DateTime();
$DateAndTime = $Object->format("Y-m-d");
$max = $Object->modify('+14 day')->format("Y-m-d");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crear turno</title>
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
                    <div class="card col-lg-5 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Crear turno</h3>
                            <form id="crear_turno" action="../../db/turnos" method="POST" class="forms-sample">

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
                                        <input type="email" class="form-control" id="email" placeholder="Email (Opcional)">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="telefono" class="col-sm-3 col-form-label">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="tel" class="form-control" id="telefono" placeholder="Telefono">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="peluqueros" class="col-sm-3 col-form-label">Peluquero</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="peluqueros"></select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fecha" class="col-sm-3 col-form-label">Fecha</label>
                                    <div class="col-sm-9">
                                        <input type="date" id="fecha" min="<?php echo $DateAndTime ?>" max="<?php echo $max  ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="disponibilidad" class="col-sm-4 col-form-label">Disponibilidad</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="turnoMañana" value="">Turno mañana</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="turnoTarde" value="">Turno tarde</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="container">
                                        <div class="row justify-content-end">
                                            <div class="col-sm-4">
                                                <div id='hoursMorning'></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div id='hoursAfternoon'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mr-2">Crear</button>
                                <button type="reset" class="btn btn-dark">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
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
    <script src="../../assets/js/crearTurno.js"></script>    
    <!-- endinject -->
</body>

</html>
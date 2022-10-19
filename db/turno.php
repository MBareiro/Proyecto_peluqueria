<?php
require('conexionDb.php');

$datos = mysqli_query($conexion, "SELECT id, nombre, apellido FROM users");
$datos = mysqli_fetch_all($datos, MYSQLI_ASSOC);

print json_encode($datos);
mysqli_close($conexion);

<?php
session_start();
require('conexionDb.php');
$user_id = $_SESSION['id_user'];
$datos = mysqli_query($conexion, "SELECT * FROM horarios where user_id = '$user_id'");
$datos = mysqli_fetch_all($datos, MYSQLI_ASSOC);


print json_encode($datos);
mysqli_close($conexion);

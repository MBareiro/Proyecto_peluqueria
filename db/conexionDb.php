<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$servername = "localhost";
// $servername = "https://iaes.edu.ar/phpmyadmin";
$username = "root";
// $username = "lgi21@iaes.edu.ar";
$password = "";
// $password = "lwBx0c4dPEpKsgA";
$db = "breeze";
// $db = "iaes_lgi21";

$conexion = mysqli_connect($servername, $username, $password, $db);

if (!$conexion) {
  die("conexion fallida, error: " . mysqli_connect_error());
}
?>

<?php
include "../../db/conexionDb.php";
$email = $_POST['email'];
$bytes = random_bytes(5);
$token = bin2hex($bytes);

include "mail_reset.php";
$data = false;
if ($enviado) {
    $conexion->query("INSERT into passwords(email, token, codigo) 
         values('$email','$token','$codigo') ") or die($conexion->error);
    $data = true;
}
print json_encode($data);
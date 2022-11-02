<?php
include "../../db/conexionDb.php";
$email = $_POST['email'];
$bytes = random_bytes(5);
$token = bin2hex($bytes);

$result = $conexion->query("SELECT email FROM users WHERE email= '$email'") or die($conexion->error);
if (!empty($result) && mysqli_num_rows($result) != 0) {
    include "mail_reset.php";    
    if ($enviado) {
        $conexion->query("INSERT into passwords_reset(email, token, codigo) 
             values('$email','$token','$codigo') ") or die($conexion->error);
    }
}
mysqli_close($conexion);
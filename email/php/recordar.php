<?php
include "../../db/conexionDb.php";

$Object = new DateTime();  
$Object = $Object->modify('+1 day');  
$date= $Object->format("Y-m-d");  
print($date);

$sql = "SELECT C.email, T.hora, T.fecha, T.peluquero_id FROM clientes C, turnos T WHERE C.id = T.cliente_id AND T.fecha = '$date'";

$resultado = mysqli_query($conexion, $sql);

$hora = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
var_dump($hora);

foreach ($resultado as $recordatorio) {
    $email = $recordatorio['email'];
    
    $hora = new DateTime($recordatorio['hora']);;
    $fecha = $recordatorio['fecha'];
    $peluquero_id = $recordatorio['peluquero_id'];
    include "mail_recordatorio.php";
}
mysqli_close($conexion);
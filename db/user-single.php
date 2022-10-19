<?php

require('conexionDb.php');
$id = $_POST['id'];

$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!');
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'email' => $row['email'],
        'rol' => $row['rol']
    );
}
mysqli_close($conexion);
$jsonstring = json_encode($json[0]);
echo $jsonstring;
?>

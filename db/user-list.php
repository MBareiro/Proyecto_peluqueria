
<?php
require('conexionDb.php');

try {
    //Selecciona todas las experiencias de un usuario 
    $query = "SELECT * FROM users";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Query failed!' . mysqli_error($conexion));
    }
} catch (Exception $e) {
    //echo 'Message: ' . $e->getMessage();
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'email' => $row['email'],
        'rol' => $row['rol'],
    );
}
mysqli_close($conexion);
$jsonstring = json_encode($json);
echo $jsonstring;

?>
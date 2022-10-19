<?php
session_start();
require('./db/conexionDb.php');
print($_SESSION['id_user']);
if (isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])) {
    $sql = 'SELECT id from roles where id in(SELECT rol from users where
     id =' . $_SESSION['id_user'] . ')';

    $resultado = mysqli_query($conexion, $sql);
   
    if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        $row = mysqli_fetch_assoc($resultado);
    }  

    // Compruebo de que exista
    if (isset($row['id'])) {
        if ($row['id'] == 1 || $row['id'] == 2) {
            header('location: /peluqueria/pages/dashboards/dashboardAdmin.php');
        } 
    }
    mysqli_close($conexion);
} else {
    header('location: /peluqueria/index.html');
}
?>
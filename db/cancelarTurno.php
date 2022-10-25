
<?php
require('./conexionDb.php');
    $data = false;
    if (isset($_POST['turno_id'])) {
        $id = $_POST['turno_id'];
        $query = "DELETE FROM turnos WHERE id=$id";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query failed');
        } else {
            $data = 1;
        }
    }
    print json_encode($data);
    mysqli_close($conexion);
?>
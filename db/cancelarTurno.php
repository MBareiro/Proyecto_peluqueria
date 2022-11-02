
<?php
require('./conexionDb.php');
    $data = false;
    if (isset($_POST['turno_id'])) {
        $id = $_POST['turno_id'];

        $query = "SELECT C.email, T.fecha, T.hora FROM clientes C, turnos T WHERE C.id = (SELECT cliente_id FROM turnos WHERE id = '$id' )";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($result);
        $email = $row[0];
        $fecha = $row[1];
        $hora = $row[2];

        $query = "DELETE FROM turnos WHERE id=$id";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query failed');
        } else {
            include "../email/php/mail_cancelar.php";
            $data = 1;
        }
    }
    print json_encode($data);
    mysqli_close($conexion);
?>
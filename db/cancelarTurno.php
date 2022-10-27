
<?php
require('./conexionDb.php');
    $data = false;
    if (isset($_POST['turno_id'])) {
        $id = $_POST['turno_id'];
        print($id);

        $query = "SELECT email FROM clientes WHERE id = (SELECT cliente_id FROM turnos WHERE id = '$id' )";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($result);
        $email = $row[0];

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

<?php
require('conexionDb.php');

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE horarios FROM users, horarios WHERE users.id=$id AND users.id=horarios.user_id";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query failed');
        }
        $query = "DELETE FROM users WHERE id=$id";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query failed');
        }
    }
    mysqli_close($conexion);
?>

<?php 
    include "../../db/conexionDb.php";
    print('assssssssdasd');
    $data = false;
    if(isset($_POST['p1']) 
      && isset($_POST['p2']) 
      && isset($_POST['email'])){
        $email = $_POST['email'];
        $p1 =$_POST['p1'];
        $p2 =$_POST['p2'];
        $data = false;
        if($p1 == $p2){
            $passwordHash = password_hash($p1, PASSWORD_BCRYPT);
            $conexion->query("UPDATE users set password='$passwordHash' where email='$email' ")or die($conexion->error);
            $data = true;   
        }else{
            $data = 2;
        }
    }
    
    print json_encode($data);
    mysqli_close($conexion);

?>
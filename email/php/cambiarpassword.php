<?php 
    include "../../db/conexionDb.php";
    $data = false;
    if(isset($_POST['password']) 
      && isset($_POST['p2']) 
      && isset($_POST['email'])){
        $email = $_POST['email'];
        print($email);
        $password =$_POST['password'];
        $p2 =$_POST['p2'];
        $data = false;
        if($password == $p2){
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $result = $conexion->query("UPDATE users SET password='$passwordHash' where email='$email' ")or die($conexion->error);
            if($result){
                $data = true;   
            }
            
        }else{
            $data = 2;
        }
    }
    
    print json_encode($data);
    mysqli_close($conexion);

?>
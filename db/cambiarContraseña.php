<?php
require('./verificarUsuario.php');

if(isset($_POST['currentPassword']) 
  && isset($_POST['newPassword']) 
  && isset($_POST['confirmPassword']))
{
    $data = ['error' => 'vacio'];
    $correctPassword = false;
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];//Este no sirve para nada pero por las dudas xd
    $passwordHash = "";
    $idUser = $_SESSION['id_user']; // recupero el ID del usuario (sesion)

    $query = "SELECT password FROM users WHERE id=$idUser;";
    $resultado =  mysqli_query($conexion, $query);
    if(!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        
        $row = mysqli_fetch_assoc($resultado);
        if(password_verify($currentPassword, $row['password'])){
           $correctPassword = true;
        }
    }
    if($correctPassword == true){
        $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password='".$passwordHash."' WHERE id=$idUser";
        if (mysqli_query($conexion, $sql)) {
            $data = array('usuario'=>$_SESSION['email'], 'verificar'=> true);
        }else{
            $data = array('usuario'=>'no se concretó la conexion', 'verificar'=> false);
        }
    }
}else{
    $data = array('error'=>'error al inicio', 'verificar'=> false);
}

print json_encode($data);
mysqli_close($conexion);

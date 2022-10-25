<?php
require('./verificarUsuario.php');

if(isset($_POST['email']))
{
    $data = ['error' => 'vacio'];
  
    $email = $_POST['email'];
    $idUser = $_SESSION['id_user']; // recupero el ID del usuario (sesion)

    $query = "SELECT email FROM users WHERE id=$idUser;";
    $resultado =  mysqli_query($conexion, $query);
    if(!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        $row = mysqli_fetch_assoc($resultado);
        
    }
    $sql = "UPDATE users SET email='".$email."' WHERE id=$idUser";
        if (mysqli_query($conexion, $sql)) {
            $data =  true;
            $_SESSION['email'] = $email;
        }else{
            $data = false;
        }
}else{
    $data = false;
}

print json_encode($data);
mysqli_close($conexion);
?>

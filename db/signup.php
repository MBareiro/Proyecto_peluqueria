<?php 
// require('../db/verificarAdminSecretaria.php');

// require("../db/conexionDb.php");
require("./conexionDb.php");
session_start();
// if(!isset($_SESSION['id_user'])||!isset($_SESSION['nombre'])){
//     header('location: ./logout.php');
// }
// $query = "SELECT descripcion from roles where idrol in(SELECT rol from login 
//             WHERE idlog=".$_SESSION['id_user'].");";

// $result = mysqli_query($conexion, $query);
// $rolUser = mysqli_fetch_assoc($result);
// if($rolUser['rol'] != 'Admin'){
//     header('location: ./logout.php');
// }

if(!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["email"]) && !empty($_POST["rol"]) && !empty($_POST["password"]) ){
    $nombre = ucwords($_POST["nombre"]);
    $apellido = ucwords($_POST["apellido"]);
    $email = $_POST["email"];
    $rol = (int)$_POST["rol"];
    $password = $_POST["password"];
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        //Selecciona todas las experiencias de un usuario 
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conexion, $query);
        if (!$result) {
            die('Query failed!' . mysqli_error($conexion));
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }

    if (!empty($result) && mysqli_num_rows($result) != 0) {
        $data = 2;
    } else {
        $sql = "INSERT INTO users (nombre, apellido, email, rol, password) 
        VALUES ('".$nombre."','".$apellido."','".$email."','".$rol."','".$passwordHash."')";
    
        if (mysqli_query($conexion, $sql)) {
            $data = array('email'=>$email,'password'=>$password);
        }else{
            $data = false;
        }
    }
} else {
    $data = false;
}

print json_encode($data);
mysqli_close($conexion);
?>
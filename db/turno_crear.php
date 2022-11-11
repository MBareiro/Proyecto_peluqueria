<?php 

require("./conexionDb.php");
session_start();

if(!empty($_POST["peluqueros"]) && !empty($_POST["fecha"]) && (!empty($_POST["horaMañana"]) || !empty($_POST["horaTarde"]) || !empty($_POST["hora"]))){
    $nombre = ucwords($_POST["nombre"]);
    $apellido = ucwords($_POST["apellido"]);
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
    $peluquero_id = (int)$_POST["peluqueros"];
    $fecha = $_POST["fecha"];

    if(isset($_POST['horaMañana']) && !empty($_POST["horaMañana"])){
        $hora = $_POST['horaMañana'];
    } else if(isset($_POST['horaTarde']) && !empty($_POST["horaTarde"])){
        $hora = $_POST['horaTarde'];
    } else if(isset($_POST['hora']) && !empty($_POST["hora"])) {
        $hora = $_POST['hora'];
    }
    $sql = "INSERT INTO clientes (nombre, apellido, email, telefono) VALUES ('".$nombre."','".$apellido."','".$email."','".$telefono."');";

    if (mysqli_query($conexion, $sql)) {
        $data = true;
    }else{
        $data = false;
    }
    $cliente_id = mysqli_insert_id($conexion); 

    $sql = "INSERT INTO turnos (fecha, hora, peluquero_id , cliente_id) 
    VALUES ('".$fecha."','".$hora."','".$peluquero_id."','".$cliente_id."');";
    
    if (mysqli_query($conexion, $sql)) {
        $data = true;
        $turno_id = mysqli_insert_id($conexion); 
        //include "../email/php/mail_turnoCreado.php";
    }else{
        $data = false;
    }    
} else {
    $data = false;
}

print json_encode($data);
mysqli_close($conexion);
?>
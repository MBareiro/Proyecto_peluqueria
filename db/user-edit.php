
<?php 

require('conexionDb.php');

$id = $_POST['id'];
$username = $_POST['username'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$rol = $_POST['rol'];


$query = "UPDATE `users` SET `nombre`='$nombre', `username`='$username', `apellido`='$apellido', `email`='$email', `rol`='$rol' WHERE id='$id'";
$result = mysqli_query($conexion, $query);

if (!$result) {
    die('Query failed!');
}
echo "Task Update Successfully";  
mysqli_close($conexion);
?>
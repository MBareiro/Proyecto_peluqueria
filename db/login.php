<?php
session_start();
require('./conexionDb.php');

$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$sql = 'SELECT * FROM users where email="' . $email . '";';
$resultado = mysqli_query($conexion, $sql);
$verificar = false;

if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {        
        if (password_verify($password, $row['password'])) {
            $verificar = true;
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['id_rol'] = $row['rol'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellido'] = $row['apellido'];
            $_SESSION['email'] = $row['email'];
            $data = array('id' => $row['id'], 'rol' => $row['rol'], 'nombre' => $row['nombre'], 'apellido' => $row['apellido'], 'email' => $row['email']);
        }
    }
    if ($verificar != true) {
        $data = 0;
    }
} else {
    $data = 0;
}

print json_encode($data); // returned data as json
mysqli_close($conexion);
?>
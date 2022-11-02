<?php
$sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
session_set_cookie_params($sessionTime);
session_start();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    require('./conexionDb.php');
    mysqli_set_charset($conexion, "utf8");    
  
    $verificar = false;   

    // prepare and bind
    $stmt = $conexion->prepare("SELECT * FROM users where email= (?)");
    $stmt->bind_param("s", $email);
    
    $email = mysqli_real_escape_string($conexion, (isset($_POST['email'])) ? $_POST['email'] : '');
    $password =  mysqli_real_escape_string($conexion, (isset($_POST['password'])) ? $_POST['password'] : '');

    $stmt->execute();
    $resultado = $stmt->get_result();

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
}



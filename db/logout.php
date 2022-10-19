<?php
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['email']);
unset($_SESSION['id_rol']);
unset($_SESSION['nombre']);
unset($_SESSION['apellido']);
session_destroy();
// header('location: /index.php');
 header('location: /peluqueria/index.html');
?>
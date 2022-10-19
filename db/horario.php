<?php
session_start();
require('conexionDb.php');

if (empty($_POST["active_morning"])) {
    $active_morning = 0;
} else {
    $active_morning = $_POST["active_morning"];
}

if (empty($_POST["active_afternoon"])) {
    $active_afternoon = 0;
} else {
    $active_afternoon = $_POST["active_afternoon"];
    //print(sizeof($active_afternoon));
}

$data = true;
if (!empty($_POST["morning_start"])  && !empty($_POST["morning_end"]) && !empty($_POST["afternoon_start"]) && !empty($_POST["afternoon_start"])) {
    $user = $_SESSION['id_user'];
   // print($user);
    $sql = 'SELECT * FROM horarios where user_id = "' . $user . '";';
    $resultado = mysqli_query($conexion, $sql);

    if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        $morning_start = $_POST["morning_start"];
        $morning_end = $_POST["morning_end"];
        $afternoon_start = $_POST["afternoon_start"];
        $afternoon_end = $_POST["afternoon_end"];

        for ($i = 0; $i <= 6; $i++) {
            $result = mysqli_query($conexion, "UPDATE `horarios` SET `active_morning`='$active_morning[$i]',`morning_start`='$morning_start[$i]',`morning_end`='$morning_end[$i]',
            `active_afternoon`='$active_afternoon[$i]',`afternoon_start`='$afternoon_start[$i]',`afternoon_end`='$afternoon_end[$i]' WHERE user_id = $user AND day = $i");
            if (!$result) {
                $error = print('errooor');
            }
        }
    } else {
        $morning_start = $_POST["morning_start"];
        $morning_end = $_POST["morning_end"];
        $afternoon_start = $_POST["afternoon_start"];
        $afternoon_end = $_POST["afternoon_end"];

        for ($i = 0; $i <= 6; $i++) {
            $sql = "INSERT INTO horarios (day, active_morning, morning_start, morning_end, active_afternoon, afternoon_start, afternoon_end, user_id) 
                        VALUES ('" . $i . "','" . $active_morning[$i] . "','" . $morning_start[$i] . "','" . $morning_end[$i] . "','" . $active_afternoon[$i] . "','" . $afternoon_start[$i] . "','" . $afternoon_end[$i] . "','" . $user . "');";
            mysqli_query($conexion, $sql);
        }
    }
} else {
    $data = false;
}

print json_encode($data); // returned data as json
mysqli_close($conexion);

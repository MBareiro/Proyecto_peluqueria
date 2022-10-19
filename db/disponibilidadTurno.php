<?php
require('conexionDb.php');

$peluquero_id = $_POST["peluquero_id"];
$fecha = $_POST["fecha"];
$date = strtotime($fecha);
$dia = date("w", $date);
$intervalos = [];
$result2 = [];
$result1 = [];
//Busca los horarios de un peluquero

$sql = "SELECT * FROM horarios WHERE user_id = '$peluquero_id' AND day = '$dia' ";
$resultHorarios = mysqli_query($conexion, $sql);


//Trae el horario del dia elegido
$horarios = mysqli_query($conexion, "SELECT * FROM horarios WHERE user_id = '$peluquero_id' AND day = '$dia' ");
$hora = mysqli_fetch_array($horarios, MYSQLI_ASSOC);

if (!empty($horarios) && mysqli_num_rows($horarios) != 0) {
    //Busca los turnos reservados con dicho peluquero
    $turnosdb = mysqli_query($conexion, "SELECT hora FROM turnos WHERE peluquero_id = '$peluquero_id' AND fecha = '$fecha' ");
    $turnos = mysqli_fetch_all($turnosdb, MYSQLI_ASSOC);
    $turnoReservados = [];
    foreach ($turnosdb as $turno) {
        array_push($turnoReservados, $turno['hora']);
    }

    $morning_start = new DateTime($hora['morning_start']);
    $morning_end = new DateTime($hora['morning_end']);
    $intervalosMorn = [];

    if (!empty($turnosdb) && mysqli_num_rows($turnosdb) != 0) {
        for ($i =  $morning_start; $i < $morning_end; $i->modify('+30 minute')) {
            array_push($intervalosMorn, $i->format('H:i:s'));
        }
    } else {
        while ($morning_start->format('H:i:s') <= $morning_end->format('H:i:s')) {
            array_push($intervalosMorn, $morning_start->format('H:i:s'));
            $morning_start->modify('+30 minute');
        }
    }

    if ($hora['active_morning'] == 1) {
        $result1 = array_diff($intervalosMorn, $turnoReservados);
    }

    $afternoon_start = new DateTime($hora['afternoon_start']);
    $afternoon_end = new DateTime($hora['afternoon_end']);
    $intervalosAfter = [];

    if (!empty($turnosdb) && mysqli_num_rows($turnosdb) != 0) {
        for ($i =  $afternoon_start; $i < $afternoon_end; $i->modify('+30 minute')) {
            array_push($intervalosAfter, $i->format('H:i:s'));
        }
    } else {
        while ($afternoon_start->format('H:i') < $afternoon_end->format('H:i:s')) {
            array_push($intervalosAfter, $afternoon_start->format('H:i:s'));
            $afternoon_start->modify('+30 minute');
        }
    }    
    if ($hora['active_afternoon'] == 1) {
        $result2 = array_diff($intervalosAfter, $turnoReservados);
    }

    
    $intervalos = [$result1, $result2];
}


print json_encode($intervalos);
mysqli_close($conexion);

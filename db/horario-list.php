<?php
session_start();
require('conexionDb.php');
$id = $_SESSION['id_user'];
$fecha = $_POST['fecha'];

$Object = new DateTime(); 
$DateAndTime = $Object->format("Y-m-d");  
$date = strtotime($DateAndTime);
$dia = date("w", $date);

if($fecha == 'undefined'){    
    $fecha = $DateAndTime;
}

try {
    //Selecciona todas las experiencias de un usuario 
    $query = "SELECT morning_start, morning_end, afternoon_start, afternoon_end FROM horarios Where user_id = '$id' AND day = '$dia'";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Query failed!' . mysqli_error($conexion));
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

$horarios=[];
$turnos = [];
if (!empty($result) && mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_array($result);

    $morning_start = $row['morning_start'];    
    $morning_end = $row['morning_end'];
    $afternoon_start = $row['afternoon_start'];
    $afternoon_end = $row['afternoon_end'];
    $intervaloM = [];
    $intervaloT = [];
    
    $mornParse = date_parse($morning_start);
    $objMornStart = new DateTime();
    $objMornStart = $objMornStart->setTime($mornParse['hour'],$mornParse['minute'],$mornParse['second']);

    $mornParseEnd = date_parse($morning_end);
    $objMornEnd = new DateTime();
    $objMornEnd = $objMornEnd->setTime($mornParseEnd['hour'],$mornParseEnd['minute'],$mornParseEnd['second']);
    
    for($i = $objMornStart; $i <= $objMornEnd; date_modify($i,"+30 minutes")){
        array_push($intervaloM, date_format($i, 'H:i:s'));
    }
    //var_dump($intervaloM);

    $afterParse = date_parse($afternoon_start);
    $objAfterStart = new DateTime();
    $objAfterStart = $objAfterStart->setTime($afterParse['hour'],$afterParse['minute'],$afterParse['second']);

    $afterParseEnd = date_parse($afternoon_end);
    $objAfterEnd = new DateTime();
    $objAfterEnd = $objAfterEnd->setTime($afterParseEnd['hour'],$afterParseEnd['minute'],$afterParseEnd['second']);
    
    for($i = $objAfterStart; $i <= $objAfterEnd; date_modify($i,"+30 minutes")){
        array_push($intervaloT, date_format($i, 'H:i:s'));
    }
    //var_dump($intervaloT);
    
    $intervalos = [$intervaloM, $intervaloT];
    mysqli_close($conexion);
    print json_encode($intervalos);
}


//print json_encode($turnos);

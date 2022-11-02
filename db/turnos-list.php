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
    $query = "SELECT morning_end, afternoon_start FROM horarios Where user_id = '$id' AND day = '$dia'";
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
    $morning_end = $row['morning_end'];
    $afternoon_start = $row['afternoon_start'];
    
    try {
        //Selecciona todos los turnos de la ma;ana
        $query = "SELECT t.id, t.fecha, t.hora, c.nombre, c.apellido, c.email, c.telefono FROM turnos t, clientes c Where t.peluquero_id = '$id' AND t.fecha = '$fecha' AND t.cliente_id = c.id AND  t.hora <= '$morning_end' Order by t.hora";
        $result1 = mysqli_query($conexion, $query);
        if (!$result1) {
            die('Query failed!' . mysqli_error($conexion));
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    
    $turnos_morning = array();
    while ($row = mysqli_fetch_array($result1)) {        
        $turnos_morning[] = array(
            'id' => $row['id'],
            'hora' => $row['hora'],
            'fecha' => $row['fecha'],
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'email' => $row['email'],
            'telefono' => $row['telefono'],
        );
    }
    
    try {
        //Selecciona todos los turnos de la tarde
        $query = "SELECT t.id, t.fecha, t.hora, c.nombre, c.apellido, c.email, c.telefono FROM turnos t, clientes c Where t.peluquero_id = '$id' AND t.fecha = '$fecha' AND t.cliente_id = c.id AND t.hora >= '$afternoon_start' Order by t.hora";
        $result2 = mysqli_query($conexion, $query);
        if (!$result2) {
            die('Query failed!' . mysqli_error($conexion));
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    
    $turnos_afternoon = array();
    while ($row = mysqli_fetch_array($result2)) {        
        $turnos_afternoon[] = array(
            'id' => $row['id'],
            'hora' => $row['hora'],
            'fecha' => $row['fecha'],
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'email' => $row['email'],
            'telefono' => $row['telefono'],
        );
    }    
    
    $turnos = [$turnos_morning, $turnos_afternoon];
    mysqli_close($conexion);
    print json_encode($turnos);
}
//print json_encode($turnos);
?>
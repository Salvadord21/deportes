<?php
include '../../php/conexion.php';

$jornada=$_POST['jornada'];
$jugador= $_POST['jugador'];
$equipo=$_POST['equipo'];
$gol=$_POST['gol'];
$data = array();

$goleador="INSERT INTO `goleadores_fifa`( `usuarios_id`, `torneo_id`, `equipos_id`, `goles`, `jornada`)
 VALUES ('$jugador','2','$equipo','$gol','$jornada')";
$query = mysqli_query($conexion, $goleador);
if ($query){
    $data['estatus']="ok";
}

echo json_encode($data);

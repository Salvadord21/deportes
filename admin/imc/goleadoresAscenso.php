<?php
include '../../php/conexion.php';

$jornada=$_POST['jornada'];
$jugador= $_POST['jugador'];
$torneo= $_POST['torneo'];
$equipo=$_POST['equipo'];
$gol=$_POST['gol'];
$data = array();

$goleador="INSERT INTO `goleadores_ascenso`( `usuarios_id`, `torneo_id`, `equipos_id`, `jornada`, `goles`)
 VALUES ('$jugador','$torneo','$equipo','$jornada','$gol')";
$query = mysqli_query($conexion, $goleador);
if ($query){
    $data['estatus']="ok";
}

echo json_encode($data);

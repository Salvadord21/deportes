<?php
include '../../php/conexion.php';

$jornada=$_POST['jornada'];
$jugador= $_POST['jugador'];
$gol=$_POST['gol'];
$data = array();

$goleador="INSERT INTO `goleadores_fifa`( `id_usuario`, `id_torneo`, `jornada`, `goles`) 
VALUES ('$jugador','2','$jornada','$gol')";
$query = mysqli_query($conexion, $goleador);
if ($query){
    $data['estatus']="ok";
}

echo json_encode($data);

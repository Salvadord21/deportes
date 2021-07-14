<?php
require '../php/conexion.php';

$fbardas="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='futbol bardas'";
$resultadoB = mysqli_query($conexion, $fbardas);
$mostrarB=mysqli_fetch_array($resultadoB);
$idBaas2=$mostrarB['id'];

$fascenso="SELECT MAX(`id`) as id2 FROM creacion_torneo WHERE disciplina='ascenso'";
$resultadoA = mysqli_query($conexion, $fascenso);
$mostrarA=mysqli_fetch_array($resultadoA);
$idAs2 = $mostrarA['id2'];

$fifa="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='fifa'";
$resultadoF = mysqli_query($conexion, $fifa);
$mostrarF=mysqli_fetch_array($resultadoF);
$idFif2= $mostrarF['id'];

$voley="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='voleibol'";
$resultadoV = mysqli_query($conexion, $voley);
$mostrarV=mysqli_fetch_array($resultadoV);
$idVol2 = $mostrarV['id'];

$basquet="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='Basquetbol'";
$resultadoBa = mysqli_query($conexion, $basquet);
$mostrarBa=mysqli_fetch_array($resultadoBa);
$idBasquet2 = $mostrarBa['id'];

$torneosregis = "SELECT * FROM creacion_torneo WHERE `id`='$idBaas2' or `id`='$idAs2' or `id`='$idBasquet2' or `id`='$idFif2' or `id`='$idVol2'";

$query = mysqli_query($conexion, $torneosregis);

while ($torneos = mysqli_fetch_array($query)){
    echo '<option value ="'.$torneos['disciplina'].'">'.$torneos['nombre_torneo'].'</option>';
}
?>
<?php
include 'conexion.php';
$fbardas="SELECT id FROM `creacion_torneo` WHERE `fecha_inicio`<=CURDATE() AND `fecha_limite`>=CURDATE() and disciplina='futbol bardas'";
$resultadoB = mysqli_query($conexion, $fbardas);
$mostrarB=mysqli_fetch_array($resultadoB);
$idBaas=$mostrarB['id'];

$fascenso="SELECT id FROM `creacion_torneo` WHERE `fecha_inicio`<=CURDATE() AND `fecha_limite`>=CURDATE() and disciplina='ascenso'";
$resultadoA = mysqli_query($conexion, $fascenso);
$mostrarA=mysqli_fetch_array($resultadoA);
$idAs = $mostrarA['id'];

$fifa="SELECT id FROM `creacion_torneo` WHERE `fecha_inicio`<=CURDATE() AND `fecha_limite`>=CURDATE() and disciplina='fifa'";
$resultadoF = mysqli_query($conexion, $fifa);
$mostrarF=mysqli_fetch_array($resultadoF);
$idFif = $mostrarF['id'];

$voley="SELECT id FROM `creacion_torneo` WHERE `fecha_inicio`<=CURDATE() AND `fecha_limite`>=CURDATE() and disciplina='voleibol'";
$resultadoV = mysqli_query($conexion, $voley);
$mostrarV=mysqli_fetch_array($resultadoV);
$idVol = $mostrarV['id'];

$basquet="SELECT id FROM `creacion_torneo` WHERE `fecha_inicio`<=CURDATE() AND `fecha_limite`>=CURDATE()and  disciplina='Basquetbol'";
$resultadoBa = mysqli_query($conexion, $basquet);
$mostrarBa=mysqli_fetch_array($resultadoBa);
$idBasquet = $mostrarBa['id'];



$torneosregis = "SELECT * FROM creacion_torneo WHERE disciplina!='Otro' and (`id`='$idBaas' or `id`='$idAs' or `id`='$idBasquet' or `id`='$idFif' or `id`='$idVol')";

$query = mysqli_query($conexion, $torneosregis);

while ($torneos = mysqli_fetch_array($query)){
    echo '<option value ="'.$torneos['id'].'">'.$torneos['nombre_torneo'].'</option>';
}
?>
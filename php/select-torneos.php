<?php
include 'conexion.php';

$torneosregis = "SELECT * FROM creacion_torneo WHERE disciplina!='Otro'";

$query = mysqli_query($conexion, $torneosregis);

while ($torneos = mysqli_fetch_array($query)){
    echo '<option value ="'.$torneos['id'].'">'.$torneos['nombre_torneo'].'</option>';
}
?>
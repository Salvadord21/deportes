<?php
include 'conexion.php';

$torneosregis = "SELECT * FROM creacion_torneo";

$query = mysqli_query($conexion, $torneosregis);

while ($torneos = mysqli_fetch_array($query)){
    echo '<option value ="'.$torneos['nombre_torneo'].'">'.$torneos['nombre_torneo'].'</option>';
}
?>
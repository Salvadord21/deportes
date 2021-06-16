<?php
include 'conexion.php';

$listado = "SELECT `id`,`nombre_equipo` FROM `equipos` WHERE `id_torneo`=(
    SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=(
        SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='futbol bardas'))";

$query = mysqli_query($conexion, $listado);

while ($FIFAequi = mysqli_fetch_array($query)){
    echo '<option value ="'.$FIFAequi['id'].'">'.$FIFAequi['nombre_equipo'].'</option>';
}

?>
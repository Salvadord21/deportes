<?php
include 'conexion.php';

$listado = "SELECT equipos.nombre FROM equipos_participantes LEFT JOIN equipos 
ON equipos.id = equipos_participantes.id_equipo LEFT JOIN torneos ON 
equipos_participantes.id_torneo = torneos.id WHERE torneos.id = 14";

$query = mysqli_query($conexion, $listado);

while ($FIFAequi = mysqli_fetch_array($query)){
    echo '<option value ="'.$FIFAequi['nombre'].'">'.$FIFAequi['nombre'].'</option>';
}

?>
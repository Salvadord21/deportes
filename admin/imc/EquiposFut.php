<?php
include 'conexion.php';

//$listado = "SELECT equipos.nombre FROM equipos_participantes LEFT JOIN equipos
//ON equipos.id = equipos_participantes.id_equipo LEFT JOIN torneos ON
//equipos_participantes.id_torneo = torneos.id WHERE torneos.id = 15";

$listado="SELECT `id`,`nombre_equipo` FROM `equipos` WHERE `id_torneo`=(SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=(SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='futbol bardas'))";

$query = mysqli_query($conexion, $listado);

while ($FIFAequi = mysqli_fetch_array($query)){
    echo '<option value ="'.$FIFAequi['id'].'">'.$FIFAequi['nombre_equipo'].'</option>';
}

?>
<?php
include '../../php/conexion.php';

$id = $_POST['actualizar'];
$nombre_reto = $_POST['nomtor'];
$num_jornadas = $_POST['nojorna'];
$fecha_ini = $_POST['feini'];
$fecha_lim = $_POST['felim'];
$areas = $_POST['diciplinas'];
$areaselect=0;

for ($i = 0; $i < count($areas); $i ++){
    $areaselect = $areas[$i];
}
echo $id;
$insert = "UPDATE creacion_torneo SET nombre_torneo = '$nombre_reto', disciplina = '$areaselect', jornadas = '$num_jornadas', fecha_inicio= '$fecha_ini', fecha_limite = '$fecha_lim' WHERE id = '$id'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../crear_torneo.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>
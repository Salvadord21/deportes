<?php


include '../../php/conexion.php';


$nombre = $_POST['nomtor'];
$disciplina = $_POST['diciplinas'];
$numero_jornadas = $_POST['nojorna'];
$fecha_ini = $_POST['feini'];
$fecha_lim = $_POST['felim'];


for ($i = 0; $i < count($disciplina); $i ++){
    $areaselect = $disciplina[$i];
}

$insert = "insert into creacion_torneo (nombre_torneo, disciplina,numero_equipos, jornadas,fecha, fecha_inicio, fecha_limite, fecha_creacion)
        values ('$nombre', '$areaselect',0,'$numero_jornadas',NOW(),'$fecha_ini','$fecha_lim',NOW())";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../crear_torneo.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>


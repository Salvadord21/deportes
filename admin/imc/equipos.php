<?php


include '../../php/conexion.php';


$nombre = $_POST['nomtor'];
$disciplina = $_POST['disci'];
$numero_jornadas = $_POST['nojorna'];
$fecha_ini = $_POST['feini'];
$fecha_lim = $_POST['felim'];



$insert = "insert into torneos (nombre, tipo,cupo, jornadas, fecha_inscripcion, fecha_limite, fecha_creacion)
        values ('$nombre', '$disciplina',0,'$numero_jornadas','$fecha_ini','$fecha_lim',NOW())";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../crear_torneo.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>

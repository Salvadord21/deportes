<?php


include '../../php/conexion.php';

$nombre = $_POST['ncarrera'];


$insert = "insert into carrera (nombre_carrera)
        values ('$nombre')";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../carreras.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}

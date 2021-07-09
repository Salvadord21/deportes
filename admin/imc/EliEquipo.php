<?php
include '../../php/conexion.php';
$id = $_POST['eliminar'];


$insert = "UPDATE `equipos` SET `delete`=NOW() WHERE `id`= '$id'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../equipos.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}

?>

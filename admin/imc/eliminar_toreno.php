<?php
include '../../php/conexion.php';
$id = $_POST['eliminar'];


$insert = "DELETE FROM creacion_torneo WHERE id = $id ";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../crear_torneo.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}

?>
<?php
include '../../php/conexion.php';
$id2 = $_POST['eliminar'];
$insert2="DELETE FROM carrera WHERE id = $id2";
$resultado = mysqli_query($conexion, $insert2);
if ($resultado) {
    header('location: ../carreras.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}

?>


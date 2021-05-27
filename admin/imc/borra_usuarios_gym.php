<?php
include '../../php/conexion.php';
$id = $_POST['borra'];


$insert = "UPDATE usuarios SET status_gym='0' WHERE status_gym='1' OR status_gym='2'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../gym.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}

?>
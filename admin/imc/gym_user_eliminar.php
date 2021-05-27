<?php


include '../../php/conexion.php';
$matricula = $_POST['ids'];




$insert = "update usuarios set status_gym=0 where id ='$matricula'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../gym.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>
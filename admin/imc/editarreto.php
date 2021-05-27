<?php
include '../../php/conexion.php';

$id = $_POST['actualizar'];
$nombre_reto = $_POST['reton1'];
$descri = $_POST['retod1'];
$url = $_POST['returl1'];
$fecha_crea = $_POST['retofi1'];
$fecha_lim = $_POST['retoff1'];



$insert = "UPDATE retos_deportivos SET nombre_reto = '$nombre_reto', descripcion = '$descri', url = '$url', fecha_creacion= '$fecha_crea', fecha_limite = '$fecha_lim' WHERE id = $id";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../index.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>
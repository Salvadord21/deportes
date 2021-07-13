<?php


include '../../php/conexion.php';


$nombrereto = $_POST['reton'];
$url = $_POST['returl'];
$fecha_ini = $_POST['retofi'];
$fecha_fin = $_POST['retoff'];
$descrip = $_POST['retod'];



$insert = "insert into creacion_reto(nombre_reto, descripcion, url, fecha_inicio, fecha_fin)
        values ('$nombrereto', '$descrip','$url','$fecha_ini','$fecha_fin')";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../index.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>

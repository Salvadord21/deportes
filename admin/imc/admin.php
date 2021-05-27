<?php
include '../../php/conexion.php';
$id=$_POST['idadmin'];
$areas = $_POST['admin'];
$areaselect=0;

for ($i = 0; $i < count($areas); $i ++){
    $areaselect = $areas[$i];
}

$x=9;
if ($areaselect=='Usuario'){
    $x=0;
}elseif ($areaselect=='Administrador'){
    $x=1;
}elseif ($areaselect=='Revisor'){
    $x=2;
}
$insert = "UPDATE `usuarios` SET admin = '$x' WHERE id = '$id'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../usuarios.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}

?>
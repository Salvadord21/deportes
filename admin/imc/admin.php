<?php
include '../../php/conexion.php';
$id=$_POST['idadmin'];
$areas = $_POST['admin'];
$areaselect=0;
$data = array();


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
$insert = "UPDATE `usuarios` SET administrador = '$x' WHERE id = '$id'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    $data['estatus'] = "ok";

} else {
    echo mysqli_error($conexion);
    $data['estatus'] = "error";
}
echo json_encode($data);


?>
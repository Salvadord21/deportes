<?php
include '../../php/conexion.php';
$semana =$_POST['oculto'];
$y= $_POST['equipos'];
echo $semana;
if (($y%2)==0){
    $partidos=($y/2);
}else{
    $partidos=($y/2)-0.5;
}

for ($partidoscont=1; $partidoscont<$partidos+1; $partidoscont++) {

    $locales=$_POST["local$semana-$partidoscont"];
    for ($i = 0; $i < count($locales); $i ++){
        $areaselect = $locales[$i];
    }
    $visita=$_POST["visita$semana-$partidoscont"];
    for ($i = 0; $i < count($visita); $i ++){
        $areaselect2 = $visita[$i];
    }

    $set1local = $_POST["set1local$semana-$partidoscont"];
    $set2local = $_POST["set2local$semana-$partidoscont"];
    $set3local = $_POST["set3local$semana-$partidoscont"];
    $set1visita=$_POST["set1visita$semana-$partidoscont"];
    $set2visita=$_POST["set2visita$semana-$partidoscont"];
    $set3visita=$_POST["set3visita$semana-$partidoscont"];


    $insert = "insert into partido(localesa,visita,setl1,setl2,setl3,setv1,setv2,setv3, semana, fecha_creacion)
        values ('$areaselect', '$areaselect2','$set1local','$set2local','$set3local','$set1visita','$set2visita','$set3visita', '$semana',NOW())";
    $resultado = mysqli_query($conexion, $insert);
    if ($resultado) {
        header('location: ../voleibol.php');

    } else {
        echo mysqli_error($conexion);
        $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
    }
}





?>
<?php
include '../../php/conexion.php';

$semana =$_POST['oculto'];
$y= $_POST['equipos'];
$id=$_POST['idtor'];
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

    $gollocal = $_POST["gollocal$semana-$partidoscont"];
    $golvisita=$_POST["golvisita$semana-$partidoscont"];



    $insert = "insert into partidos_fifa (localx,visitante,id_torneo, goles_local, goles_visitante, semana, fecha_creacion)
        values ('$areaselect', '$areaselect2','$id','$gollocal','$golvisita', '$semana',NOW())";
    $resultado = mysqli_query($conexion, $insert);
    if ($resultado) {
        header('location: ../fifa.php');

    } else {
        echo mysqli_error($conexion);
        $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
    }
}





?>
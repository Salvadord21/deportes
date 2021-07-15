<?php
include '../../php/conexion.php';

$jornada=$_POST['jornada'];
$idLocal= $_POST['local'];
$idVisita=$_POST['visita'];
$idTorneo=$_POST['torneo'];
$golVisita=$_POST['golV'];
$golLocal=$_POST['golL'];
$data = array();
if ($golVisita<$golLocal){//gano local
    $resultado=1;$puntosL=3;$puntosV=0;$jgl=1;$jel=0;$jpl=0;$jgv=0;$jev=0;$jpv=1;
}else if($golVisita==$golLocal){
    $resultado=0;$puntosL=1;$puntosV=1;$jgl=0;$jel=1;$jpl=0;$jgv=0;$jev=1;$jpv=0;
}else{$resultado=2;$puntosL=0;$puntosV=3;$jgl=0;$jel=0;$jpl=1;$jgv=1;$jev=0;$jpv=0;
}///Gano visita

$insert="UPDATE `partidos_fifa` SET `gol_local`='$golLocal',`gol_visita`='$golVisita',`resultado`='$resultado' WHERE `id_local`='$idLocal' and `id_visita`='$idVisita' and `jornada`='$jornada'";
$query = mysqli_query($conexion, $insert);
if ($query){

    //buscar el ultimo id  SELECT MAX(id) as id FROM `partidos_fifa`
    $maxid="SELECT MAX(id) as id FROM `partidos_fifa`";
    $queryid=mysqli_query($conexion, $maxid);
    $fila3 = mysqli_fetch_assoc($queryid);
    $idPartido = $fila3['id'];

    $golesL="INSERT INTO `puntos_fifa`(`equipos_id`, `id_partido`, `golesF`, `golesC`, `puntos`, `jg`, `je`, `jp`,`jornada`,`torneo_id`)
    VALUES ('$idLocal','$idPartido','$golLocal','$golVisita','$puntosL','$jgl','$jel','$jpl','$jornada','$idTorneo')";
    $golesV="INSERT INTO `puntos_fifa`( `equipos_id`, `id_partido`, `golesF`, `golesC`, `puntos`, `jg`, `je`, `jp`,`jornada`,`torneo_id`) 
    VALUES ('$idVisita','$idPartido','$golVisita','$golLocal','$puntosV','$jgv','$jev','$jpv','$jornada','$idTorneo')";
    $queryl=mysqli_query($conexion, $golesL);
    $queryv=mysqli_query($conexion, $golesV);
    if ($queryl and $queryv){
        $data['estatus']="ok";
    }


}else{
    $data['estatus']="error";
}

echo json_encode($data);



?>
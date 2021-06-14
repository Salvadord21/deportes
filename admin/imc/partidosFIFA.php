<?php
include '../../php/conexion.php';

$jornada=$_POST['jornada'];
$idLocal= $_POST['local'];
$idVisita=$_POST['visita'];
//$idTorneo=$_POST['idtor'];
$golVisita=$_POST['golV'];
$golLocal=$_POST['golL'];
$data = array();
if ($golVisita<$golLocal){//gano local
    $resultado=1;$puntosL=3;$puntosV=0;
}else if($golVisita==$golLocal){
    $resultado=0;$puntosL=1;$puntosV=1;
}else{$resultado=2;$puntosL=0;$puntosV=3;
}///Gano visita

$insert="INSERT INTO `partidos_fifa`(`gol_local`, `gol_visita`, `resultado`, `jornada`, `fecha`, `creacion_torneo_id`, `local_id`, `visita_id`) 
VALUES ('$golLocal','$golVisita','$resultado','$jornada',NOW(),'2','$idLocal','$idVisita')";
$query = mysqli_query($conexion, $insert);
if ($query){

    //buscar el ultimo id  SELECT MAX(id) as id FROM `partidos_fifa`
    $maxid="SELECT MAX(id) as id FROM `partidos_fifa`";
    $queryid=mysqli_query($conexion, $maxid);
    $fila3 = mysqli_fetch_assoc($queryid);
    $idToreneo = $fila3['id'];


    $golesL="INSERT INTO `puntos_fifa`( `id_equipo`, `puntos`, `golesF`, `golesC`, `id_partido_fifa`) VALUES ('$idLocal','$puntosL','$golLocal','$golVisita','$idToreneo')";
    $golesV="INSERT INTO `puntos_fifa`( `id_equipo`, `puntos`, `golesF`, `golesC`, `id_partido_fifa`) VALUES ('$idVisita','$puntosV','$golVisita','$golLocal','$idToreneo')";
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
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
    $resultado=1;$puntosL=3;$puntosV=0;$jgl=1;$jel=0;$jpl=0;$jgv=0;$jev=0;$jpv=1;
}else if($golVisita==$golLocal){
    $resultado=0;$puntosL=1;$puntosV=1;$jgl=0;$jel=1;$jpl=0;$jgv=0;$jev=1;$jpv=0;
}else{$resultado=2;$puntosL=0;$puntosV=3;$jgl=0;$jel=0;$jpl=1;$jgv=1;$jev=0;$jpv=0;
}///Gano visita

$insert="INSERT INTO `partidos_futbol`( `gol_local`, `gol_visita`, `resultado`, `jornada`, `fecha`, `torneo_id`, `equipo_local_id`, `equipo_visita_id1`) 
VALUES ('$golLocal','$golVisita','$resultado','$jornada',NOW(),'1','$idLocal','$idVisita')";
$query = mysqli_query($conexion, $insert);
if ($query){

    //buscar el ultimo id  SELECT MAX(id) as id FROM `partidos_fifa`
    $maxid="SELECT MAX(id) as id FROM `partidos_fifa`";
    $queryid=mysqli_query($conexion, $maxid);
    $fila3 = mysqli_fetch_assoc($queryid);
    $idToreneo = $fila3['id'];


    $golesL="INSERT INTO `puntos_futbol`(`equipos_id`, `puntos`,`golesF`, `golesC`, `partidos_futbol_id`, `jg`, `je`, `jp`) VALUES ('$idLocal','$puntosL','$golLocal','$golVisita','$jornada','$jgl','$jel','$jpl')";
    $golesV="INSERT INTO `puntos_futbol`( `equipos_id`, `puntos`,`golesF`, `golesC`, `partidos_futbol_id`, `jg`, `je`, `jp`) VALUES ('$idVisita','$puntosV','$golVisita','$golLocal','$jornada','$jgv','$jev','$jpv')";
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
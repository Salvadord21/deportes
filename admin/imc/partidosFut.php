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
///
///
///
$insert="INSERT INTO `partidos_futbol`(`gol_local`, `gol_visita`, `resultado`, `jornada`, `fecha`, `torneo_id`, `id_local`, `id_visita`)
 VALUES ('$golLocal','$golVisita','$resultado','$jornada',NOW(),'$idTorneo','$idLocal','$idVisita')";
$query = mysqli_query($conexion, $insert);
if ($query){
    //buscar el ultimo id  SELECT MAX(id) as id FROM `partidos_fifa`
    $maxid="SELECT MAX(id) as id FROM `partidos_futbol`";
    $queryid=mysqli_query($conexion, $maxid);
    $fila3 = mysqli_fetch_assoc($queryid);
    $idPartido = $fila3['id'];

    $golesL="INSERT INTO `puntos_futbol`(`golesF`, `golesC`, `partidos_futbol_id`, `equipos_id`, `puntos`, `jg`, `je`, `jp`, `jornada`)
 VALUES ('$golLocal', '$golVisita','$idPartido','$idLocal', '$puntosL','$jgl','$jel','$jpl','$jornada')";


    $golesV="INSERT INTO `puntos_futbol`(`golesF`, `golesC`, `partidos_futbol_id`, `equipos_id`, `puntos`, `jg`, `je`, `jp`, `jornada`) 
VALUES ('$golVisita', '$golLocal','$idPartido','$idVisita','$puntosV','$jgv','$jev','$jpv','$jornada')";
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
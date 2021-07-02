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
    $resultado=1;$puntosL=2;$puntosV=1;$jgl=1;$jpl=0;$jgv=0;$jpv=1;
}else{///Gano visita
    $resultado=2;$puntosL=1;$puntosV=2;$jgl=0;$jpl=1;$jgv=1;$jpv=0;
}


$insert="INSERT INTO `partidos_basquetbol`( `canastasL`, `canastasV`, `jornada`, `fecha`, `idLocal`, `idVisita`, `resultado`, `creacion_torneo_id`) 
            VALUES ('$golLocal','$golVisita','$jornada',NOW(),'$idLocal','$idVisita','$resultado', '$idTorneo')";
$query = mysqli_query($conexion, $insert);
if ($query){
    //buscar el ultimo id  SELECT MAX(id) as id FROM `partidos_fifa`
    $maxid="SELECT MAX(id) as id FROM `partidos_basquetbol`";
    $queryid=mysqli_query($conexion, $maxid);
    $fila3 = mysqli_fetch_assoc($queryid);
    $idPartido = $fila3['id'];

    $golesL="INSERT INTO `puntos_basquetbol`(`equipo_id`,`canastasF`, `canastasC`, `puntos`, `jg`, `jp`, `jornada`, `partidos_basquetbol_id`, `creacion_torneo_id`) 
                        VALUES ('$idLocal','$golLocal','$golVisita','$puntosL','$jgl','$jpl','$jornada','$idPartido','$idTorneo')";
    $golesV="INSERT INTO `puntos_basquetbol`(`equipo_id`,`canastasF`, `canastasC`, `puntos`, `jg`, `jp`, `jornada`, `partidos_basquetbol_id`, `creacion_torneo_id`) 
                        VALUES ('$idVisita','$golVisita','$golLocal','$puntosV','$jgv','$jpv','$jornada','$idPartido','$idTorneo')";
    $queryl=mysqli_query($conexion, $golesL);
    $queryv=mysqli_query($conexion, $golesV);
    if ($queryl and $queryv){
        $data['estatus']="ok";
    }

}
echo json_encode($data);

?>
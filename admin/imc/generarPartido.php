<?php
require '../../php/conexion.php';

$jornada=$_POST['jornada'];
$idLocal= $_POST['local'];
$idVisita=$_POST['visita'];
$idTorneo=$_POST['torneo'];
$tipo=$_POST['tipo'];

$data = array();
if ($tipo=='bardas'){
    $insert="INSERT INTO `partidos_futbol`( `jornada`, `fecha`, `torneo_id`, `id_local`, `id_visita`)
 VALUES ('$jornada',NOW(),'$idTorneo','$idLocal','$idVisita')";
    $query = mysqli_query($conexion, $insert);
    if ($query){
        $data['estatus']="ok";
    }

}elseif ($tipo=='ascenso'){
    $insert="INSERT INTO `partidos_ascenso`( `jornada`, `fecha`, `torneo_id`, `id_local`, `id_visita`)
 VALUES ('$jornada',NOW(),'$idTorneo','$idLocal','$idVisita')";
    $query = mysqli_query($conexion, $insert);
    if ($query){
        $data['estatus']="ok";
    }
}elseif ($tipo=='fifa'){
    $insert="INSERT INTO `partidos_fifa`( `jornada`, `fecha`, `torneo_id`, `id_local`, `id_visita`)
 VALUES ('$jornada',NOW(),'$idTorneo','$idLocal','$idVisita')";
    $query = mysqli_query($conexion, $insert);
    if ($query){
        $data['estatus']="ok";
    }
}elseif ($tipo=='vole'){
    $insert="INSERT INTO `partidos_vole`( `jornada`, `fecha`, `torneo_id`, `id_local`, `id_visita`)
 VALUES ('$jornada',NOW(),'$idTorneo','$idLocal','$idVisita')";
    $query = mysqli_query($conexion, $insert);
    if ($query){
        $data['estatus']="ok";
    }
}elseif ($tipo=='bas'){
    $insert="INSERT INTO `partidos_basquetbol`( `jornada`, `fecha`, `torneo_id`, `idLocal`, `idVisita`)
 VALUES ('$jornada',NOW(),'$idTorneo','$idLocal','$idVisita')";
    $query = mysqli_query($conexion, $insert);
    if ($query){
        $data['estatus']="ok";
    }
}

echo json_encode($data);



?>
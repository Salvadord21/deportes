<?php
include '../../php/conexion.php';

$jornada=$_POST['jornada'];
$idLocal= $_POST['local'];
$idVisita=$_POST['visita'];
$idTorneo=$_POST['torneo'];
$set1l=$_POST['set1l'];
$set2l=$_POST['set2l'];
$set3l=$_POST['set3l'];
$set1v=$_POST['set1v'];
$set2v=$_POST['set2v'];
$set3v=$_POST['set3v'];
if ($set3l==''){$set3l=0;}
if ($set3v==''){$set3v=0;}
$ganadol=0;
$perdidol=0;
$ganadov=0;
$perdidov=0;
if ($set1l>$set1v){ $ganadol++;$perdidov++; }else{$ganadov++;$perdidol++; }
if ($set2l>$set2v){ $ganadol++;$perdidov++; }else{$ganadov++;$perdidol++; }
if ($set3l>$set3v){ $ganadol++;$perdidov++; }else{$ganadov++;$perdidol++; }
if ($ganadol>$ganadov){$resultado=1;}else{$resultado=2;}


$insert="UPDATE `partidos_vole` SET `set1L`='$set1l',`set2L`='$set2l',`set3L`='$set3l',`set1V`='$set2l',`set2V`='$set2v',`set3V`='$set3v',`fecha`=NOW() ,`resultado`='$resultado' WHERE `id_local`='$idLocal' and `id_visita`='$idVisita' and `jornada`='$jornada'";
$query = mysqli_query($conexion, $insert);
if ($query){
        $pfl=$set1l+$set2l+$set3l;
        $pfv=$set1v+$set2v+$set3v;
        if ($pfl>$pfv){$jgl=1;$jpl=0;$jgv=0;$jpv=1;}else{$jgl=0;$jpl=1;$jgv=1;$jpv=0;}

    $maxid="SELECT MAX(id) as id FROM `partidos_vole`";
    $queryid=mysqli_query($conexion, $maxid);
    $fila3 = mysqli_fetch_assoc($queryid);
    $idPartido = $fila3['id'];

    $golesL="INSERT INTO `puntos_vole`(`equipo_id`, `ptnF`, `ptnC`, `jg`, `jp`, `setF`, `setC`, `partidos_vole_id`, `torneo_id`) 
    VALUES ('$idLocal','$pfl','$pfv','$jgl','$jpl','$ganadol','$perdidol','$idPartido','$idTorneo')";
    $golesV="INSERT INTO `puntos_vole`(`equipo_id`, `ptnF`, `ptnC`, `jg`, `jp`, `setF`, `setC`, `partidos_vole_id`, `torneo_id`) 
    VALUES ('$idVisita','$pfv','$pfl','$jgv','$jpv','$ganadov','$perdidov','$idPartido','$idTorneo')";
    $queryl=mysqli_query($conexion, $golesL);
    $queryv=mysqli_query($conexion, $golesV);
    if ($queryl and $queryv){
        $data['estatus']="ok";
    }


}
echo json_encode($data);


?>
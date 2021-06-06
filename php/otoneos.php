<?php
session_start();

include 'conexion.php';

$usuarioid = $_SESSION['id_usuario'];
$torneo = $_POST['torneo'];
$data = array();


if ($usuarioid!=null and $torneo!=null){
    $comparacion2 = "SELECT `usuarios_id`, `torneo_id` FROM `otros_torneos` where usuarios_id='$usuarioid' and torneo_id='$torneo' ";
    $query2 = mysqli_query($conexion, $comparacion2);
    if (mysqli_fetch_array($query2)){
         $data['status']="ya";
    }else{
        $comparacion = "INSERT INTO `otros_torneos`(`usuarios_id`, `torneo_id`)VALUES ('$usuarioid','$torneo')";
        $query = mysqli_query($conexion, $comparacion);
        if ($query){
             $data['status']="entra";
        }else{
             $data['status']="salida";
        }
    }
}else{
     $data['status']="error";
}
echo json_encode($data);
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
            $comparacion3 = "SELECT * FROM creacion_torneo where id='$torneo'";
            $query3 = mysqli_query($conexion, $comparacion3);
            if ($query3){
                $fila3 = mysqli_fetch_assoc($query3);
                $numero = $fila3['numero_equipos'];
                $numero2=$numero+1;
                $comparacion4 ="UPDATE `creacion_torneo` SET `numero_equipos`='$numero2' WHERE id='$torneo' ";
                $query4 = mysqli_query($conexion, $comparacion4);
                if ($query4){
                    $data['status']="entra";
                }else{
                    $data['status']="falla actualizar";
                }
            }else{
                $data['status']="falla enconctar equipos";
            }
            
        }else{
             $data['status']="salida";
        }
    }
}else{
     $data['status']="error";
}
echo json_encode($data);
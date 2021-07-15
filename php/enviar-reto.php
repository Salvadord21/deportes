<?php
session_start();

include 'conexion.php';

$idusu = $_SESSION['id_usuario'];
$idreto = $_POST['enviar'];
$video = $_POST ['video'];
$data = array();

if (!empty($idusu)){
    if (!empty($video)) {

        $enviar = "INSERT INTO retos_subidos (creacion_reto_id, usuarios_id, url, estado, calificacion, fecha_subida,revisor_id) VALUES ('$idreto', '$idusu','$video', 0, 0, NOW(),1)";

        $query = mysqli_query($conexion, $enviar);

        if ($query) {
            $data['estatus'] = "ok";
        } else {
            $data['estatus'] = "error";
        }

    }else{
        $data['estatus'] = "datos vacios";
    }

}else{
    $data['estatus'] = "sesion";
}
echo json_encode($data);

?>


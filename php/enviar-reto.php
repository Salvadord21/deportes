<?php
session_start();

include 'conexion.php';

$idusu = $_SESSION['id_usuario'];
$idreto = $_POST['enviar'];
$video = $_POST ['video'];

if (!empty($idusu)){

    if (!empty($video)) {

        $enviar = "INSERT INTO retos_subidos (id_reto, usuarios_id, url, estado, calificacion, fecha_subida) VALUES ('$idreto', '$idusu','$video', 0, 0, NOW())";

        $query = mysqli_query($conexion, $enviar);

        if ($query) {
            header('location: ../retos.php');
        } else {
            echo mysqli_error($conexion);
            $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
        }

    }else{
        $_SESSION['msg_error'] = 'Campos vacios';
    }

}else{
    $_SESSION['msg_error'] = 'Debes iniciar sesión para poder participar en los retos';
}
?>


<?php
session_start();
include 'conexion.php';

$idusu = $_SESSION['id_usuario'];

    if (!empty($idusu)){

        $solicitud = "UPDATE usuarios SET status_gym = 2 WHERE id = '$idusu'";

        $query = mysqli_query($conexion, $solicitud);

        if ($query) {


            header('location: ../gym.php');

        } else {

            echo mysqli_error($conexion);
            $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
        }
    }else{
        $_SESSION['msg_error'] = 'Debes iniciar sesión para poder inscribirte al gimnasio';
    }

    ?>
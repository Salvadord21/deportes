<?php
session_start();
require 'conexion.php';

$idusu = $_SESSION['id_usuario'];

$nombre = $_POST['torneonombre'];
$descripcion = $_POST['torneodescrip'];

    if (!empty($idusu)){


        if (!empty($nombre) && !empty($descripcion)){

            $solicitud = "INSERT INTO solicitud_torneo (usuarios_id, nombre_torneo, descripcion, fecha) 
                          VALUES ('$idusu', '$nombre','$descripcion', NOW())";

            $query = mysqli_query($conexion, $solicitud);

            if ($query) {

                header('location: ../torneo.php');

            } else {

                echo mysqli_error($conexion);
                $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
            }

        }else{
            $_SESSION['msg_error'] = 'Favor de llenar todos los campos';
        }

    }else{
        $_SESSION['msg_error'] = 'Debes iniciar sesión para poder participar';
    }

?>

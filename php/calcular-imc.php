<?php
session_start();
include 'conexion.php';

$idusu = $_SESSION['id_usuario'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];

if (!empty($idusu)){

    $insertar = "INSERT INTO imc (usuarios_id, estatura, peso, fecha_creacion) VALUES ('$idusu', '$altura', '$peso', NOW())";

    $query = mysqli_query($conexion, $insertar);

    if ($query) {

        header('location: ../perfil_usuario.php');

    } else {

        echo mysqli_error($conexion);
        $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
    }
}else{
    $_SESSION['msg_error'] = 'Debes iniciar sesión para poder inscribirte al gimnasio';
}
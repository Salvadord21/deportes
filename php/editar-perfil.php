<?php
session_start();
include 'conexion.php';
$prueba=$_SESSION['matricula'];
$idusu = $_SESSION['id_usuario'];
$tel = $_POST['telefono-perfil-usuario'];
//$fotografia = $_POST['fotografia'];

if (!empty($idusu)){

    $insertar = "UPDATE usuarios SET telefono = $tel WHERE id = '$idusu'";

    $query = mysqli_query($conexion, $insertar);

    if ($query) {
        guardarImagen($prueba);
        header('location: ../perfil_usuario.php');

    } else {

        echo mysqli_error($conexion);
        $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
    }
}else{
    $_SESSION['msg_error'] = 'Debes iniciar sesión para poder inscribirte al gimnasio';
}

function guardarImagen( $idxx ){
    if(!empty($_FILES['fotografia']['tmp_name'])) {

        $temporal = $_FILES['fotografia']['tmp_name'];

        $directorio_destino = 'imagenes/';
        $archivo_destino = $idxx . '.jpg';

        $destino = $directorio_destino . $archivo_destino;

        $movido = move_uploaded_file($temporal, $destino);

        return $movido;
    }

    return false;
}


?>
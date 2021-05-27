<?php
session_start();
require 'conexion.php';

$idusu = $_SESSION['id_usuario'];

$nomequipo = $_POST['nom'];
$pwdequipo = $_POST['contra'];
$torneos =  $_POST['disciplinas'];
$estatuspriv = $_POST['invisible'];

if (!empty($idusu)){
    if (!empty($nomequipo) && !empty($torneos)){

        for ($i = 0; $i < count($torneos); $i ++){
            $torneosselect = $torneos[$i];
        }

        $registro = "INSERT INTO equipos (id_lider, nombre_equipo, integrantes, torneo, contrasena,privado, creacion) 
                      VALUES ('$idusu', '$nomequipo',0,'$torneosselect','$pwdequipo','$estatuspriv', NOW())";

        $query = mysqli_query($conexion, $registro);

        if ($query){
            header('location: ../torneo.php');
        }else {
            echo mysqli_error($conexion);
            $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
        }

}else{
        $_SESSION['msg_error'] = 'Complete todos los campos';
    }
}else{
    $_SESSION['msg_error'] = 'Debes inicar sesión para poder participar';
}

?>
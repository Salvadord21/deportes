<?php
session_start();
require 'conexion.php';

$idusu = $_SESSION['id_usuario'];

$nomequipo = $_POST['nom'];
$pwdequipo = $_POST['contra'];
$torneos =  $_POST['disciplinas'];///id del torneo
$estatuspriv = $_POST['invisible'];

if (!empty($idusu)) {

    for ($i = 0; $i < count($torneos); $i ++){
        $torneosselect = $torneos[$i];
    }
        $ver="SELECT * FROM `equipos` WHERE `id_lider`='$idusu' AND`id_torneo`='$torneosselect'";
        $verquery=mysqli_query($conexion, $ver);
        if(mysqli_fetch_array($verquery)){
            $data['status']="ok";
        }else{
            if ($estatuspriv == 0) {
                $registro = "INSERT INTO equipos (id_lider, nombre_equipo, integrantes, id_torneo, contrasena,privado, creacion) 
                      VALUES ('$idusu', '$nomequipo',1,'$torneosselect','$pwdequipo','$estatuspriv', NOW())";
                $query = mysqli_query($conexion, $registro);
                if ($query) {
                    $registro2 = "SELECT MAX(id) as id FROM `equipos`";
                    $query2 = mysqli_query($conexion, $registro2);
                    if ($query2) {
                        $fila2 = mysqli_fetch_assoc($query2);
                        $numero = $fila2['id'];
                        $registro3 = "INSERT INTO `integrantes`( `usuarios_id`, `equipos_id`) VALUES ('$idusu','$numero')";
                        $query3 = mysqli_query($conexion, $registro3);
                        if ($query3) {
                            $data['status']="ya";
                        }

                    }

                } else {
                    echo mysqli_error($conexion);
                    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
                }
            } else if ($estatuspriv == 1) {
                $registro1 = "INSERT INTO equipos (id_lider, nombre_equipo, integrantes, id_torneo, contrasena,privado, creacion) 
                      VALUES ('$idusu', '$nomequipo',1,'$torneosselect','$pwdequipo','$estatuspriv', NOW())";
                $query1 = mysqli_query($conexion, $registro1);
                if ($query1) {
                    $registro2 = "SELECT MAX(id) as id FROM `equipos`";
                    $query2 = mysqli_query($conexion, $registro2);
                    if ($query2) {
                        $fila2 = mysqli_fetch_assoc($query2);
                        $numero = $fila2['id'];
                        $registro3 = "INSERT INTO `integrantes`( `usuarios_id`, `equipos_id`) VALUES ('$idusu','$numero')";
                        $query3 = mysqli_query($conexion, $registro3);
                        if ($query3) {
                            $data['status']="ya";
                        }
                    } else {
                        echo mysqli_error($conexion);
                        $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
                    }
                }

            }
        }

} else {
    $data['status']="sesion";
}

echo json_encode($data);

?>
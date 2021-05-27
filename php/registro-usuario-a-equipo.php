<?php
session_start();
require 'conexion.php';

$usuarioid = $_SESSION['id_usuario'];

$idequipo = $_POST['idEquipo'];
$estatusequipo = $_POST['estatus'];
if ($estatusequipo == 1){
    $pwdequipo = $_POST['contraequipo'];
}


if (!empty($usuarioid)){

    $comparacion = "SELECT * FROM equipos WHERE id ='$idequipo'";
    $query = mysqli_query($conexion, $comparacion);

    $encuentra3 = mysqli_num_rows($query);
if ($encuentra3 == 1){
    $fila3 = mysqli_fetch_assoc($query);
    $nombre_torneo = $fila3['torneo'];
}
$comparacion2 = "SELECT * FROM inscripcion_unica WHERE usuarios_id ='$usuarioid' AND torneo_nombre = '$nombre_torneo'";

    $query2 = mysqli_query($conexion, $comparacion2);
if ($query2){
    header('location: ../index.php');
}else {


    if ($estatusequipo == 0) {

        //PUBLICO

        if ($query) {
            $encuentra = mysqli_num_rows($query);

            if ($encuentra == 1) {
                $fila = mysqli_fetch_assoc($query);

                $nomequipo = $fila['nombre_equipo'];
                $integrantes = $fila['integrantes'];
                $tipotorneo = $fila['torneo'];

                $insertar = "INSERT INTO integrantes (usuarios_id, equipos_id) VALUES ('$usuarioid','$idequipo')";
                $resultado = mysqli_query($conexion, $insertar);

                if ($resultado) {
                    echo "actua inte";
                    $suma = $integrantes + 1;
                    $incremeta_jugadores = "UPDATE equipos SET integrantes = '$suma' WHERE id = '$idequipo' ";

                    $final = mysqli_query($conexion, $incremeta_jugadores);

                    if ($final) {
                        header('location: ../torneo.php');
                    }

                }

            }
        }

    } else {

        //PRIVADO
        if (!empty($pwdequipo)) {

            if ($query) {
                $encuentra = mysqli_num_rows($query);

                if ($encuentra == 1) {
                    $fila = mysqli_fetch_assoc($query);

                    if ($pwdequipo == $fila['contrasena']) {

                        $nomequipo = $fila['nombre_equipo'];
                        $integrantes = $fila['integrantes'];
                        $tipotorneo = $fila['torneo'];

                        $insertar = "INSERT INTO integrantes (usuarios_id, equipos_id) VALUES ('$usuarioid','$idequipo')";
                        $resultado = mysqli_query($conexion, $insertar);

                        if ($resultado) {
                            $suma = $integrantes + 1;
                            $incremeta_jugadores = "UPDATE equipos SET integrantes = '$suma' WHERE id = '$idequipo' ";

                            $final = mysqli_query($conexion, $incremeta_jugadores);

                            if ($final) {
                                header('location: ../torneo.php');
                            }

                        }
                    }

                }
            }

        } else {
            $_SESSION['msg_error'] = 'Favor de ingresar una contraseña';
            header('location: ../toneo.php');
        }
    }
}

}else{
    $_SESSION['msg_error'] = 'Debes iniciar sesión';
    header('location: ../toneo.php');
}
?>
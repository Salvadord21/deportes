<?php
session_start();
require 'conexion.php';
$contra="";

$usuarioid = $_SESSION['id_usuario'];
$idequipo = $_POST['idEquipo'];
$estatusequipo = $_POST['estatus'];
if ($estatusequipo == 1){///compara equipo es privado
    $pwdequipo = $_POST['contraequipo'];
}
if (!empty($usuarioid)){///usuario no es vacio
    $comparacion = "SELECT * FROM equipos WHERE id ='$idequipo'";
    $query = mysqli_query($conexion, $comparacion);
    $encuentra3 = mysqli_num_rows($query);
    if ($encuentra3 == 1){////buscamos al equipo seleccionado
        $fila3 = mysqli_fetch_assoc($query);
        $nombre_torneo = $fila3['id_torneo'];
        $contra=$fila3['contrasena'];
    }
    $comparacion2 = "SELECT * FROM usuariotorneo WHERE usuarios_id ='$usuarioid' AND id_torneo = '$nombre_torneo'";
    $query2 = mysqli_query($conexion, $comparacion2);///mysqli fetch
    ///validamos que tenga mas de uno
    if (mysqli_fetch_array($query2)){
        $data['status']="ya";///ya esta registrado en ese torneo
    }else {///no esta registrado
        ///
        ///
        if ($estatusequipo==0){
            $comparacion = "INSERT INTO `integrantes`(`usuarios_id`, `equipos_id`)VALUES ('$usuarioid','$idequipo')";
            $query = mysqli_query($conexion, $comparacion);
            if ($query){
                $data['status']="entrapublico";
            }else{
                $data['status']="salida";
            }
        }else{
            if ($contra==$pwdequipo){
                $comparacion = "INSERT INTO `integrantes`(`usuarios_id`, `equipos_id`)VALUES ('$usuarioid','$idequipo')";
                $query = mysqli_query($conexion, $comparacion);
                if ($query){
                    $data['status']="entrapriv";
                }else{
                    $data['status']="salidapriv";
                }
            }else{
                $data['status']="equivocado";
            }


        }

    }

}else{
    $data['status']="no";
}
echo json_encode($data);
?>
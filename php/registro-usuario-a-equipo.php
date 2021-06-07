<?php
session_start();
require 'conexion.php';
$contra="";

$usuarioid = $_SESSION['id_usuario'];
$idequipo = $_POST['equipo'];
$torneo= $_POST['torneo'];
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
    $comparacion2 = "SELECT * FROM usuariotorneo WHERE usuarios_id ='$usuarioid' AND id_torneo = '$torneo'";
    $query2 = mysqli_query($conexion, $comparacion2);///mysqli fetch
    ///validamos que tenga mas de uno
    if (mysqli_fetch_array($query2)){
        $data['status']="ya";///ya esta registrado en ese torneo
    }else {///no esta registrado
        if ($estatusequipo==0){
            $comparacion = "INSERT INTO `integrantes`(`usuarios_id`, `equipos_id`)VALUES ('$usuarioid','$idequipo')";
            $query = mysqli_query($conexion, $comparacion);
            if ($query){
                $comparacion3 = "SELECT * FROM equipos where id='$idequipo'";
                $query3 = mysqli_query($conexion, $comparacion3);
                if ($query3){
                    $fila3 = mysqli_fetch_assoc($query3);
                    $numero = $fila3['integrantes'];
                    $numero2=$numero+1;
                    $comparacion4 ="UPDATE `equipos` SET `integrantes`='$numero2' WHERE id='$idequipo' ";
                    $query4 = mysqli_query($conexion, $comparacion4);
                    if ($query4){
                        $data['status']="entrapublico";
                    }else{
                        $data['status']="falla actualizar";
                    }
                }else{
                    $data['status']="falla enconctar equipos";
                }

            }else{
                $data['status']="salida";
            }
        }else{
            if ($contra==$pwdequipo){
                $comparacion = "INSERT INTO `integrantes`(`usuarios_id`, `equipos_id`)VALUES ('$usuarioid','$idequipo')";
                $query = mysqli_query($conexion, $comparacion);
                if ($query){
                    $comparacion3 = "SELECT * FROM equipos where id='$idequipo'";
                    $query3 = mysqli_query($conexion, $comparacion3);
                    if ($query3){
                        $fila3 = mysqli_fetch_assoc($query3);
                        $numero = $fila3['integrantes'];
                        $numero2=$numero+1;
                        $comparacion4 ="UPDATE `equipos` SET `integrantes`='$numero2' WHERE id='$idequipo' ";
                        $query4 = mysqli_query($conexion, $comparacion4);
                        if ($query4){
                            $data['status']="entrapriv";
                        }else{
                            $data['status']="falla actualizar";
                        }
                    }else{
                        $data['status']="falla enconctar equipos";
                    }
                }else{
                    $data['status']="salidapriv";

                }
            }else{
                $data['status']="equivocado";
                $data['staus']=mysqli_fetch_array($query2);
            }


        }

    }

}else{
    $data['status']="no";
}
echo json_encode($data);
?>
<?php
session_start();

$_SESSION = array();

require 'conexion.php';

$matri = $_POST['matriculalog'];
$pass = $_POST['passlog'];

if (!empty($matri) && !empty($pass)){

        $sql = "select * from usuarios where matricula = '$matri'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado){
            $encuentra = mysqli_num_rows($resultado);

            if ($encuentra == 1){
                $encripta = md5($pass);
                $fila = mysqli_fetch_assoc($resultado);

                if ($encripta == $fila['contrasena']){
                    $_SESSION['administrador'] = $fila['administrador'];
                    $_SESSION['matricula'] = $matri;
                    $_SESSION['id_usuario'] = $fila['id'];
                    $_SESSION['nombre'] = $fila['nombre'];


                    if($_SESSION['administrador'] == 0){
                        header("location: ../index.php");
                    }elseif ($_SESSION['administrador'] == 1){
                        header('location: ../admin/index.php');
                    }elseif($_SESSION['administrador'] == 2){
                        header("location: ../revisor/retos.php");
                    }

                }else{
                    echo mysqli_error($conexion);
                    echo 'Usuario o contraseña incorrecta'. mysqli_error($conexion);
                    header("location: ../index.php");
                }
            }else{
                echo mysqli_error($conexion);
                echo 'Usuario o contraseña incorrecta'. mysqli_error($conexion);
                header("location: ../index.php");
            }
        }
}else{
    echo 'Favor de llenar todos los campos';
    header("location: ../index.php");
}
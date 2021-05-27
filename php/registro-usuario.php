<?php
session_start();

include 'conexion.php';

    $nombre = $_POST['nombre'];
    $apellidopat = $_POST['apellido-paterno'];
$apellidomat = $_POST['apellido-materno'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $areas = $_POST['carrera'];
    $departamento = 'pruebaas';

        if (!empty($nombre) && !empty($apellidopat) && !empty($apellidomat)  && !empty($matricula) && !empty($areas) && !empty($email) && !empty($pass1) && !empty($pass2)) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {

                if (strlen($pass1) > 5) {

                    if ($pass2 == $pass1) {

                        $md5 = md5($pass1);

                        //LLAMA AL SELECT LAS CARRERAS viejo
                        /*for ($i = 0; $i < count($areas); $i ++){
                            $areaselect = $areas[$i];
                        }*/

                        //status_gimnasio: 2 cuando no se ha registrado/0 cuando se manda solicitud de registro/1 cuando es aceptado
                        $insert = "insert into usuarios (nombre, apellido_paterno, apellido_materno, contrasena,  correo, area, fecha_creacion, administrador, matricula, status_gym, departamento)
                                        values ( '$nombre','$apellidopat', '$apellidomat','$md5','$email','$areas', NOW(), '0', '$matricula', '0', '$departamento')";

                        $resultado = mysqli_query($conexion, $insert);

                        if ($resultado) {
                            header('location: ../index.php');

                        } else {
                            echo mysqli_error($conexion);
                            $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
                            header('location: ../index.php');
                        }

                    } else {

                        $_SESSION['msg_error'] = 'Las contraseñas no coinciden' ;
                        header('location: ../index.php');
                    }

                } else {
                    $_SESSION['msg_error'] = 'La contraseña debe tener un mínimo de 8 caracteres';
                    header('location: ../index.php');
                }

            } else {
                $_SESSION['msg_error'] = 'Dirección de correo no válida';
                header('location: ../index.php');
            }

        } else {
            $_SESSION['msg_error'] = 'Complete todos los camppos';
            header('location: ../index.php');
        }
    //header('location: ../index.php');
?>
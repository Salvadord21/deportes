<?php
include 'conexion.php';

$busqueda=trim($_POST['matricula']);
//$busqueda = 200520113;
$sql= "SELECT * FROM `usuarios` WHERE matricula = $busqueda"; //BUSCA A EL USUARIO AL QUE PERTENEZCA LA MATRICULA
$resultado = mysqli_query($conexion, $sql);
$data = array();


if($mostrar=mysqli_fetch_array($resultado)) {
    $x=$mostrar['status_gym']; //MUESTRA 1 SI ESTA REGISTRADO AL GYM, 2 SI ESTA PENDIENTE Y 0 SI NO
    $entrada = $mostrar['status_entrada'];//
    $id = $mostrar['id'];

    if ($x == 1) {
        if ($entrada == NULL) {
            $insert = "insert into registro_gym ( entrada, estado, usuarios_id, creacion) values (NOW(), 5, '$id', NOW())";

            $resultado2 = mysqli_query($conexion, $insert);

            if ($resultado2) {
                $data['status'] = 'entra';
                $insert2 = "UPDATE usuarios SET status_entrada = '5' WHERE id = '$id'";
                $resultado3 = mysqli_query($conexion, $insert2);
            } else {
                echo mysqli_error($conexion);
                $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
            }
        }else{
            $insert = "UPDATE registro_gym SET salida = NOW(), estado = 6 WHERE usuarios_id = '$id' AND estado = 5";

            $resultado2 = mysqli_query($conexion, $insert);

            if ($resultado2) {
                $data['status'] = 'salida';

                $insert2 = "UPDATE usuarios SET status_entrada = NULL WHERE id = '$id'";
                $resultado3 = mysqli_query($conexion, $insert2);
            } else {
                echo mysqli_error($conexion);
                $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
            }
        }

    } elseif($x == 2){
        $data['status'] = 'pendiente';
    }elseif ($x == 0){
        $data['status'] = 'no';
    }

    echo json_encode($data);
}else {
    $data['status'] = 'error';
    echo json_encode($data);
}
?>





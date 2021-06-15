<?php
session_start();
include 'conexion.php';

$idusu = $_SESSION['id_usuario'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];
$data = array();

if (!empty($idusu)){

        $insertar = "INSERT INTO imc (usuarios_id, estatura, peso, fecha_creacion) VALUES ('$idusu', '$altura', '$peso', NOW())";

        $query = mysqli_query($conexion, $insertar);

        if ($query) {
            $data['estatus'] = "ok";

        } else {
            $data['estatus'] = "error";
        }
}

echo json_encode($data);
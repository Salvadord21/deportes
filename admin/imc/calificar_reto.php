

<?php


include '../../php/conexion.php';

$id=$_POST['actualizar'];
$notas = $_POST['notas'];
$disciplina = $_POST['diciplinas'];
for ($i = 0; $i < count($disciplina); $i ++){
    $estado = $disciplina[$i];
}
$disciplina2 = $_POST['diciplinas2'];
for ($i = 0; $i < count($disciplina2); $i ++){
    $calificacion = $disciplina2[$i];
}



$insert = "UPDATE retos_subidos SET  calificacion= '$calificacion',nota= '$notas',fecha_revisado= NOW(), estado= '$estado' WHERE id = '$id'";

$resultado = mysqli_query($conexion, $insert);
if ($resultado) {
    header('location: ../retos.php');

} else {
    echo mysqli_error($conexion);
    $_SESSION['msg_error'] = 'Error en sentencia sql: ' . mysqli_error($conexion);
}
?>
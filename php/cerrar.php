<?php
session_start();

$_SESSION['id_usuario'] = null;

$_SESSION['nombre'] = null;

session_unset();

session_destroy();

header("location: ../index.php");
?>

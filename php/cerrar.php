<?php
session_start();

$_SESSION['id_usuario'] = null;

$_SESSION['matricula'] = null;

session_unset();

session_destroy();

header("location: ../index.php");
?>

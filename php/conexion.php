<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'deporte');

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conexion === false){ //¿error?

    exit('Error en la conexión con la bd');
}

mysqli_set_charset($conexion, 'utf8');
?>

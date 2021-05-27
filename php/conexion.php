<?php
define('DB_HOST', '128.199.2.131');
define('DB_USER', 'deporte');
define('DB_PASS', 'deportes21');
define('DB_NAME', 'deportes');

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conexion === false){ //¿error?

    exit('Error en la conexión con la bd');
}

mysqli_set_charset($conexion, 'utf8');
?>

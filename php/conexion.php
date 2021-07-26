<?php
define('DB_HOST', '138.128.165.82');
define('DB_USER', 'ticien_deportes');
define('DB_PASS', 'f!l0w@max-D$');
define('DB_NAME', 'ticien_deportes');

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conexion === false){ //¿error?

    exit('Error en la conexión con la bd');
}


mysqli_set_charset($conexion, 'utf8');
?>

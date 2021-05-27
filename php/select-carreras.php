<?php
 include 'conexion.php';

    $listado = "SELECT * FROM carrera";

    $query = mysqli_query($conexion, $listado);

    while ($carreras = mysqli_fetch_array($query)){
        echo '<option value ="'.$carreras['nombre_carrera'].'">'.$carreras['nombre_carrera'].'</option>';
    }
 ?>


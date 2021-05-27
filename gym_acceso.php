<?php
include 'php/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
    <link rel="stylesheet" href="css/estilos-gym_acceso.css">
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="header">
    <h1>Bienvenido al área de pesas</h1>
</div>

<div class="row">
    <div class="column">
        <img src="imgs/logo_ucc_colores.png" width="450">
    </div>
    <div class="column" align="center">
        <form name="registro" id="registro" method="POST">
            <h2 for="matricula">Ingresa tu matrícula</h2><br>
            <input type="text" id="matricula" name="matricula" maxlength="9" placeholder="Tu matrícula..."  autofocus oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')">
        </form>
        <br><br><br>
        <h3 >La distancia que separa tus sueños de la realidad es la disciplina.</h3>
        <h3 >¡No te rindas!</h3>
    </div>

    <div class="column">
        <img src="imgs/aguilas-ucc%20-%20copia.png" width="300">
    </div>
</div>
<script>

    function  borrar(){
        $('#matricula').val('');
    }

    $(document).ready(function() {
        $("#registro").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'php/gymace.php',
                data:$('#registro').serialize(),
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status  == "entra") {///////aceptado
                        Swal.fire({
                            icon: 'success',
                            title: 'Bienvenido',
                            text: 'recuerda registrar tu salida',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(borrar, 2000);
                    }
                    else if (data.status  == "no") {////registrarse en la pagina
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Debes registrate en la pagina para poder ingresar',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(borrar, 2000);
                    }else if (data.status  == "pendiente") {/////solicitud en proceso
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: 'Tu solicitud esta en proceso',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(borrar, 2000);
                    }else if (data.status == "salida"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Hasta luego',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(borrar, 2000);
                    }else if (data.status == "error"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Registrate en la pagina',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(borrar, 2000);
                    }
                }
            });
        });
    });

</script>

</body>
</html>

<?php

echo "
        <nav aria-label=\"menu-principal\" class=\"navbar navbar-light\" style=\"background-color: #e3f2fd;\">
        
        <a class=\"navbar-brand\" href=\"#\"><img src=\"imgs/aguilas-ucc%20-%20copia.png\" alt=\"#\" width=\"120px\"/></a> <!--logo menu-->
        
             <ul class=\"nav justify-content-center\" id=\"menubar\" role=\"menubar\" aria-label=\"menu-principal\">
             
                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"index.php\">Inicio</a> </li>

                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"torneo.php\">Torneos</a> </li>

                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"gym.php\">Área de pesas</a> </li>

                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"retos.php\">Retos</a> </li>

                <li class=\"nav-item dropdown\" role=\"none\"><a class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\" role=\"menuitem\" aria-haspopup=\"true\" aria-expanded=\"false\" href=\"\">Iniciar sesión</a>
                
                    <form class=\"dropdown-menu p-4\" action=\"php/login.php\" method=\"post\" class =\"needs-validation\">
                        <h4>Iniciar sesión</h4>
                        <div class=\"dropdown-divider\"></div>
                        <div class=\"form-group\">
                            <label for=\"matricula-inicio\">Matrícula/No. trabajador</label>
                            <input type=\"text\" maxlength=\"9\" class=\"form-control border\" name=\"matriculalog\" id=\"matricula-inicio\" required>
                            <div class=\"invalid-feedback\">Complete el campo</div>
                        </div>
                        
                        <div class=\"form-group\">
                            <label for=\"contrasena-inicio\">Contraseña</label>
                            <input type=\"password\" minlength=\"6 \" class=\"form-control border\" name=\"passlog\" id=\"contrasena-inicio\" required>
                            <div class=\"invalid-feedback\">Complete el campo</div>
                        </div>
    
                        <button type=\"submit\" class=\"btn btn-primary btn-block\">Iniciar sesión</button>
                        
                        <div class=\"dropdown-divider\"></div>
                        
                        <button type=\"button\" class=\"btn btn-outline-dark btn-block\" data-toggle=\"modal\" data-target=\"#exampleModalLong\">¡Regístrate!</button>
    
                    </form>                   
                </li>
             </ul>
        </nav> ";
?>

<!-- MODAL DE REGISTRO -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">¡Regístrate!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <form action="php/registro-usuario.php" id="formulario" method="post" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="nombre-registro">Nombre(s)</label>
                        <input type="text" class="form-control border" name="nombre" id="nombre-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>
                    <div class="form-group">
                        <label for="apellidos-paterno-registro">Apellido paterno</label>
                        <input type="text" class="form-control border" name="apellido-paterno" id="apellido-paterno-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>
                    <div class="form-group">
                        <label for="apellidos-materno-registro">Apellido materno</label>
                        <input type="text" class="form-control border" name="apellido-materno" id="apellido-materno-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>
                    <div class="form-group">
                        <label for="matricula-registro">Matrícula/No. trabajador</label>
                        <input type="text" maxlength="9" class="form-control border" name="matricula" id="matricula-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>
                    <div class="form-group">
                        <label for="correo-registro">Correo</label>
                        <input type="email" class="form-control border" name="email" id="correo-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>

                    <div class="form-group">
                        <label for="carrera-registro">Carrera</label>
                        <input type="text" class="form-control border" name="carrera" id="carrera-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>
                    <!--<div class="form-group" aria-required="true">
                        <label for="area-registro">Área</label><br>

                        <div class="form-check form-check-inline" id="ejemplo">
                            <input class="form-check-input" type="radio" name="radioAreas" id="radioEstudiante" value="estudiante" data-toggle="collapse" data-target="#collapseBotonInput" aria-expanded="false" aria-controls="collapseBotonInput">
                            <label class="form-check-label" for="radioEstudiante">Estudiante</label>
                        </div>
                        <div class="form-check form-check-inline" id="ejemplo">
                            <input class="form-check-input" type="radio" name="radioAreas" id="radioEmpleado" value="empleado" data-toggle="collapse" data-target="#collapseBotonSelect" aria-expanded="false" aria-controls="collapseBotonSelect">
                            <label class="form-check-label" for="radioEmpleado">Empleado</label>
                        </div>
                        <div class="form-check form-check-inline" id="ejemplo">
                            <input class="form-check-input" type="radio" name="radioAreas" id="radioMOV" value="MOV" data-toggle="collapse" data-target="#collapseBotonSelect" aria-expanded="false" aria-controls="collapseBotonSelect">
                            <label class="form-check-label" for="radioMOV">MOV</label>
                        </div>
                        <div class="form-check form-check-inline" id="ejemplo">
                            <input class="form-check-input" type="radio" name="radioAreas" id="radioEgresado" value="egresado" data-toggle="collapse" data-target="#collapseBotonInput" aria-expanded="false" aria-controls="collapseBotonInput">
                            <label class="form-check-label" for="radioEgresado">Egresado</label>
                        </div><br><br>-->
                        <!--MODAAL ESTUDIANTE Y EGRESADO-->
                       <!-- <div class="collapse " id="collapseBotonInput">
                            <div class="card card-body">

                                <label for="nombre-equipo-registro">Ingresa tu carrera</label>
                                <input type="text" minlength="4" class="form-control border" name="contra" id="contrasena-equipo-registro">

                            </div>
                        </div>
                        <-MODAAL EMPLEADO Y MOV-
                        <div class="collapse " id="collapseBotonSelect">
                            <div class="card card-body">

                                <label for="nombre-equipo-registro">Selecciona tu area</label>
                                <input type="text" minlength="4" class="form-control border" name="contra" id="contrasena-equipo-registro">

                            </div>
                        </div>-->


                      <!--  <?php
                        //if

                        ?>
                        <select id="area-registro" class="form-control" name="area[]">
                            <option value="">Selecciona tu área</option>
                            <?php
                            require 'php/select-carreras.php';
                            ?>
                        </select>
                    </div>-->

                    <div class="form-group">
                        <label for="contrasena-registro">Contraseña</label>
                        <input type="password" minlength="6" class="form-control border" name="pass1" id="contrasena-registro" required>
                        <small class="text-muted">
                            La contraseña debe tener un mínimo 6 caracteres
                        </small>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>
                    <div class="form-group">
                        <label for="confirma-contra-registro">Confirmación de contraseña</label>
                        <input type="password" minlength="6" class="form-control border" name="pass2" id="confirma-contra-registro" required>
                        <div class="invalid-feedback">Complete el campo</div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" name="register" class="btn btn-outline-primary">REGISTRARSE</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


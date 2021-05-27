
<?php

$matri = $_SESSION['matricula'];


echo "
        <nav aria-label=\"menu-principal\" class=\"navbar navbar-light\" style=\"background-color: #e3f2fd;\">
        <a class=\"navbar-brand\" href=\"#\"><img src=\"imgs/aguilas-ucc%20-%20copia.png\" alt=\"#\" width=\"120px\"/></a> <!--logo menu-->
        
             <ul class=\"nav justify-content-center\" id=\"menubar\" role=\"menubar\" aria-label=\"menu-principal\">
             
             <li class=\"nav-item\" role=\"none\"><i class=\"fas fa-arrow-left\"></i><a type=\"button\" class=\"btn btn-link\" href=\"revisor/retos.php\">Regresar</a>
             
                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"index.php\">Inicio</a> </li>

                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"torneo.php\">Torneos</a> </li>

                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"gym.php\">Área de pesas</a> </li>

                <li class=\"nav-item\" role=\"none\"><a class=\"nav-link\" role=\"menuitem\" href=\"retos.php\">Retos</a> </li>

                <div class=\"dropdown show\">
                    <li class=\"nav-item dropdown\" role=\"none\"><a id=\"usuario-perfil\" class=\"nav-link dropdown-toggle\"  data-toggle=\"dropdown\" role=\"menuitem\" aria-haspopup=\"true\" aria-expanded=\"false\" href=\"#\"> $matri </a>
                
                         <div class=\"dropdown-menu dropdown-menu-right shadow animated--grow-in\" aria-labelledby=\"usuario-perfil\">
                                <a class=\"dropdown-item\" href=\"perfil_usuario.php\">
                                    <i class=\"fas fa-user fa-sm fa-fw mr-2 text-gray-400\"></i>
                                    Perfil
                                </a>
                                
                                <div class=\"dropdown-divider\"></div>
                                
                                <a class=\"dropdown-item\" href=\"php/cerrar.php\">
                                <i class=\"fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400\"></i>
                                Cerrar sesión
                                </a>
                         </div>
                    </li>
                </div>
             </ul>
        </nav>";
?>
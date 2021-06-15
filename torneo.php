<?php
session_start();
require 'php/conexion.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
<div class="top_section">
    <div class="top_inner">
        <?php
        if(!empty($_SESSION['nombre']) && $_SESSION['administrador'] == 0) {
            include 'php/navbar-iniciado.php';
        }elseif(!empty($_SESSION['nombre']) && $_SESSION['administrador'] == 1){
            include 'php/nav-iniciado-admin.php';
        }elseif(!empty($_SESSION['nombre']) && $_SESSION['administrador'] == 2){
            include 'php/nav-inciado-revisor.php';
        }
        else{

            require 'php/navbar.php';
        }
        ?>
    </div>
</div>


<div id="classes" class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text_align_center">
                <h2 style="margin-bottom: 65px;">Torneos</h2>
            </div>
        </div>

        <div class="container">

            <!--BOTONES DE FORMULARIOS-->
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                    <button type="button" class="btn btn-outline-primary justify-content-md-end" data-toggle="modal" data-target="#crearTorneo">
                        ¡Proponer torneo!
                    </button>
                </div>


                <div class="col">
                    <?php
                    if (!empty($_SESSION['id_usuario'])){

                        ?>
                        <button type="button" class="btn btn-outline-primary justify-content-md-end" data-toggle="modal" data-target="#crearEquipo">
                            ¡Crea tu equipo!
                        </button>
                        <?php
                    }else{
                        ?>
                        <button type="button" class="btn btn-outline-primary justify-content-md-end" data-toggle="modal" data-target="#errorsesion">
                            ¡Crea tu equipo!
                        </button>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </div>
        <br>

        <!--FORMULARIO DE SOLICITUD DE TORNEO-->
        <div class="modal fade" id="crearTorneo" tabindex="-1" role="dialog" aria-labelledby="crearTorneoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearTorneoTitle">Solicitud de torneo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>¿Quieres participar en un torneo pero los que hay no son de tu agrado?</h5>
                        <p>¡No te quedes con las ganas y cuentanos tus ideas de torneo!</p>
                        <p>¡Envianos tu solicutud!</p>

                        <form id="solicitud" method="post" class="needs-validation">
                            <div class="form-group">
                                <label for="disciplina-torneo-registro">Nombre del torneo</label>
                                <input type="text" class="form-control" name="torneonombre" id="disciplina-torneo-registro" required>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>

                            <div class="form-group">
                                <label for="descripcion-torneo-registro">Descripción</label>
                                <textarea class="form-control" maxlength="200" name="torneodescrip" id="descripcion-torneo-registro" rows="3" required></textarea>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>

                            <div class="modal-footer justify-content-center">

                                <?php
                                if (!empty($_SESSION['id_usuario'])){

                                    ?>

                                    <button type="submit" class="btn btn-outline-primary">ENVIAR SOLICITUD</button>

                                    <?php
                                }else{
                                    ?>
                                    <button type="button" class="btn btn-outline-info justify-content-md-end" data-dismiss="modal" data-toggle="modal" data-target="#errorsesion">
                                        ENVIAR SOLICITUD
                                    </button>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--FORMULARIO DE EQUIPO-->
        <div class="modal fade" id="crearEquipo" tabindex="-1" role="dialog" aria-labelledby="crearEquipoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearEquipoTitle">¡Regístra tu equipo!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="registrar-equipo" method="post" class="needs-validation">
                            <div class="form-group">
                                <?php $nombre = $_SESSION['nombre']?>

                                <label for="lider-equipo-registro">Líder</label>
                                <input type="text" readonly class="form-control-plaintext" id="lider-equipo-registro" value="<?php echo $nombre?>">
                            </div>

                            <div class="form-group">
                                <label for="nombre-equipo-registro">Nombre del equipo</label>
                                <input type="text" class="form-control border" name="nom" id="nombre-equipo-registro" required>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>

                            <div class="form-group">
                                <label for="disciplina-equipo-registro">Disciplina</label>

                                <div class="input-group">
                                    <select class="custom-select" id="disciplina-equipo-registro" name="disciplinas[]" required>
                                        <option value="">Disciplina</option>
                                        <?php
                                        require 'php/select-torneos.php';
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">Seleccione una opción</div>
                                </div>
                            </div>

                            <!--BOTON PRIVADO-->
                            <div class="form-group">
                                <p><small>Si deseas que solo tus amigos sean parte de tú equipo, ¡puedes hacerlo privado! Haz clic en el botón de 'Privado', establece una contraseña y pasala a aquellos que quieras en tu equipo</small></p>
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col">Privado</div>
                                    <div class="col">
                                        <label class="switch">
                                            <input type="checkbox"  id="privado" name="privado" data-toggle="collapse" data-target="#collapseBotonPrivado" aria-expanded="false" aria-controls="collapseBotonPrivado">

                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" id="invisible" name="invisible" value="0">
                                    </div>
                                </div>

                                <script>

                                    $(document).on('change','input[type="checkbox"]' ,function(e) {

                                        if(this.checked) $('#invisible').val(1);
                                        else $('#invisible').val(0);

                                    });

                                </script>

                                <!-- COLLAPSE CON EL BOTON DE PRIVADO-->

                                <div class="collapse " id="collapseBotonPrivado">
                                    <div class="card card-body">

                                        <label for="nombre-equipo-registro">Contraseña</label>
                                        <input type="text" minlength="4" class="form-control border" name="contra" id="contrasena-equipo-registro">
                                        <p><small>*Debe contar con al menos 4 caracteres</small></p>

                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-outline-primary">REGISTRAR EQUIPO</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--MENSAJE DE ERROR-->
        <div class="modal fade" id="errorsesion" tabindex="-1" role="dialog" aria-labelledby="errorsesionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorsesionTitle">¡Alto!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Si deseas participar debes primero iniciar sesión</h5>
                        <p>Para poder participar en nuestras actividades deber primero iniciar sesión</p>
                        <p>Si no tienes una cuenta, ¡Registrate!</p>

                        <div class="modal-footer justify-content-center">
                            <button type="button" data-dismiss="modal" class="btn btn-outline-primary">Cerrar</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <br>

        <!--Menu principal-->
        <div class="nav nav-pills nav-fill" id="menu-torneos-disciplinas" role="tablist">
            <a class="nav-item nav-link active" id="menu-torneos-futbol" data-toggle="pill" href="#torneos-futbol" role="tab" aria-controls="torneos-futbol" aria-selected="true">Fútbol</a>
            <a class="nav-item nav-link" id="menu-torneos-fifa" data-toggle="pill" href="#torneos-fifa" role="tab" aria-controls="torneos-fifa" aria-selected="false">FIFA</a>
            <a class="nav-item nav-link" id="menu-torneos-volley" data-toggle="pill" href="#torneos-volley" role="tab" aria-controls="torneos-volley" aria-selected="false">Voleibol</a>
            <a class="nav-item nav-link" id="menu-torneos-basquet" data-toggle="pill" href="#torneos-basquet" role="tab" aria-controls="torneos-basquet" aria-selected="false">Basquétbol</a>
            <a class="nav-item nav-link" id="menu-torneos-otros" data-toggle="pill" href="#torneos-otros" role="tab" aria-controls="torneos-otros" aria-selected="false">  Otros torneos</a>
            <a class="nav-item nav-link" id="menu-torneos-equipos" data-toggle="pill" href="#torneos-equipos" role="tab" aria-controls="torneos-equipos" aria-selected="false">Equipos</a>

        </div>
        <br>
        <div class="tab-content" id="menu-torneos-disciplinas-categorias">

            <!--FUTBOL-->
            <div class="tab-pane fade show active" id="torneos-futbol" role="tabpanel" aria-labelledby="menu-torneos-futbol">
                <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#futbol-general" role="tab" aria-controls="futbol-general" aria-selected="true">Tabla General</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-ofensiva" data-toggle="tab" href="#futbol-ofensiva" role="tab" aria-controls="futbol-ofensiva" aria-selected="false">Mejor ofensiva</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva" data-toggle="tab" href="#futbol-defensiva" role="tab" aria-controls="futbol-defensiva" aria-selected="false">Mejor defensiva</a>
                    </li>
                </ul>

                <!--SUBMENU FUTBOL-->
                <div class="tab-content" id="tab-futbol-contenido">
                    <div class="tab-pane fade show active" id="futbol-general" role="tabpanel" aria-labelledby="tab-futbol-general">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos jugados">JJ</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos ganados">JG</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos empatados">JE</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos perdidos">JP</th>
                                <th data-toggle="tooltip" data-placement="top" title="Goles a favor">GF</th>
                                <th data-toggle="tooltip" data-placement="top" title="Goles en contra">GE</th>
                                <th data-toggle="tooltip" data-placement="top" title="Diferencia de goles">Dif</th>
                                <th data-toggle="tooltip" data-placement="top" title="Puntos">Puntos</th>
                            </tr>
                            <?php
                            $sql2= " Select nombre_equipo, golesF, golesC, df,jj, puntos,jg,jp,je FROM `tabla_fut`";
                            $resulta=mysqli_query($conexion,$sql2);
                            $cont=1;
                            while($mostrar=mysqli_fetch_array($resulta)){
                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['jj'] ?></td>
                                    <td><?php echo $mostrar['jg'] ?></td>
                                    <td><?php echo $mostrar['je'] ?></td>
                                    <td><?php echo $mostrar['jp'] ?></td>
                                    <td><?php echo $mostrar['golesF'] ?></td>
                                    <td><?php echo $mostrar['golesC'] ?></td>
                                    <td><?php echo $mostrar['df'] ?></td>
                                    <td><?php echo $mostrar['puntos'] ?></td>
                                </tr>
                                <?
                                $cont++;
                            }
                            ?>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="futbol-ofensiva" role="tabpanel" aria-labelledby="tab-futbol-ofensiva">

                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th>Goles</th>
                            </tr>
                            <?php
                            $sql2= "SELECT `nombre_equipo`, `golesF` FROM `tabla_fut` ORDER BY golesF DESC";
                            $resulta=mysqli_query($conexion,$sql2);
                            $cont=1;
                            while($mostrar=mysqli_fetch_array($resulta)){
                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['golesF'] ?></td>

                                </tr>
                                <?
                                $cont++;
                            }
                            ?>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="futbol-defensiva" role="tabpanel" aria-labelledby="tab-futbol-defensiva">

                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th>Goles</th>
                            </tr>
                            <?php
                            $sql2= "SELECT `nombre_equipo`, `golesC` FROM `tabla_fut` ORDER BY golesF DESC";
                            $resulta=mysqli_query($conexion,$sql2);
                            $cont=1;
                            while($mostrar=mysqli_fetch_array($resulta)){
                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['golesC'] ?></td>

                                </tr>
                                <?
                                $cont++;
                            }
                            ?>
                        </table>

                    </div>
                </div>
            </div>

            <!--FIFA-->
            <div class="tab-pane fade" id="torneos-fifa" role="tabpanel" aria-labelledby="menu-torneos-fifa">
                <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#fifa-general" role="tab" aria-controls="futbol-general" aria-selected="true">Tabla General</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-ofensiva" data-toggle="tab" href="#fifa-goleadores" role="tab" aria-controls="futbol-ofensiva" aria-selected="false">Goleadores</a>
                    </li>
                </ul>

                <!--SUBMENU FIFA-->
                <div class="tab-content" id="tab-futbol-contenido">
                    <div class="tab-pane fade show active" id="fifa-general" role="tabpanel" aria-labelledby="tab-futbol-general">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos jugados">JJ</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos ganados">JG</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos empatados">JE</th>
                                <th data-toggle="tooltip" data-placement="top" title="Juegos perdidos">JP</th>
                                <th data-toggle="tooltip" data-placement="top" title="Goles a favor">GF</th>
                                <th data-toggle="tooltip" data-placement="top" title="Goles en contra">GE</th>
                                <th data-toggle="tooltip" data-placement="top" title="Diferencia de goles">Dif</th>
                                <th data-toggle="tooltip" data-placement="top" title="Puntos">Puntos</th>
                            </tr>
                            <?php
                            $sql2= " Select nombre_equipo, golesF, golesC, df,jj, puntos,jg,jp,je FROM `tabla_fifa`";
                            $resulta=mysqli_query($conexion,$sql2);
                            $cont=1;
                            while($mostrar=mysqli_fetch_array($resulta)){
                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['jj'] ?></td>
                                    <td><?php echo $mostrar['jg'] ?></td>
                                    <td><?php echo $mostrar['je'] ?></td>
                                    <td><?php echo $mostrar['jp'] ?></td>
                                    <td><?php echo $mostrar['golesF'] ?></td>
                                    <td><?php echo $mostrar['golesC'] ?></td>
                                    <td><?php echo $mostrar['df'] ?></td>
                                    <td><?php echo $mostrar['puntos'] ?></td>
                                </tr>
                                <?
                                $cont++;
                            }
                            ?>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="fifa-goleadores" role="tabpanel" aria-labelledby="tab-futbol-ofensiva">

                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Jugador</th>
                                <th>Equipo</th>
                                <th>Goles</th>
                            </tr>
                            <?php
                            $sql2= "SELECT usuarios.nombre, SUM(goleadores_fifa.goles) as goles, equipos.nombre_equipo FROM `goleadores_fifa` INNER JOIN usuarios on usuarios.id=goleadores_fifa.id_usuario INNER JOIN equipos on equipos.id=goleadores_fifa.equipo_id GROUP by goleadores_fifa.equipo_id";
                            $resulta=mysqli_query($conexion,$sql2);
                            $cont=1;
                            while($mostrar=mysqli_fetch_array($resulta)){
                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre'] ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['goles'] ?></td>
                                </tr>
                                <?
                                $cont++;
                            }
                            ?>
                        </table>

                    </div>
                </div>


            </div>

            <!--VOLLEY-->
            <div class="tab-pane fade" id="torneos-volley" role="tabpanel" aria-labelledby="menu-torneos-volley">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Equipo</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos jugados">JJ</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos ganados">JG</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos empatados">JE</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos perdidos">JP</th>
                        <th data-toggle="tooltip" data-placement="top" title="Goles a favor">GF</th>
                        <th data-toggle="tooltip" data-placement="top" title="Goles en contra">GE</th>
                        <th data-toggle="tooltip" data-placement="top" title="Diferencia de goles">Dif</th>
                        <th data-toggle="tooltip" data-placement="top" title="Puntos">P</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Somos la noche</td>
                        <td>5</td>
                        <td>4</td>
                        <td>0</td>
                        <td>1</td>
                        <td>22</td>
                        <td>13</td>
                        <td>9</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Águilas</td>
                        <td>5</td>
                        <td>3</td>
                        <td>1</td>
                        <td>1</td>
                        <td>13</td>
                        <td>9</td>
                        <td>4</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Deportivo MC</td>
                        <td>5</td>
                        <td>3</td>
                        <td>0</td>
                        <td>2</td>
                        <td>20</td>
                        <td>14</td>
                        <td>6</td>
                        <td>9</td>
                    </tr>
                </table>
            </div>

            <!--BASQUET-->
            <div class="tab-pane fade" id="torneos-basquet" role="tabpanel" aria-labelledby="menu-torneos-basquet">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Equipo</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos jugados">JJ</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos ganados">JG</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos empatados">JE</th>
                        <th data-toggle="tooltip" data-placement="top" title="Juegos perdidos">JP</th>
                        <th data-toggle="tooltip" data-placement="top" title="Goles a favor">GF</th>
                        <th data-toggle="tooltip" data-placement="top" title="Goles en contra">GE</th>
                        <th data-toggle="tooltip" data-placement="top" title="Diferencia de goles">Dif</th>
                        <th data-toggle="tooltip" data-placement="top" title="Puntos">P</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Somos la noche</td>
                        <td>5</td>
                        <td>4</td>
                        <td>0</td>
                        <td>1</td>
                        <td>22</td>
                        <td>13</td>
                        <td>9</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Águilas</td>
                        <td>5</td>
                        <td>3</td>
                        <td>1</td>
                        <td>1</td>
                        <td>13</td>
                        <td>9</td>
                        <td>4</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Deportivo MC</td>
                        <td>5</td>
                        <td>3</td>
                        <td>0</td>
                        <td>2</td>
                        <td>20</td>
                        <td>14</td>
                        <td>6</td>
                        <td>9</td>
                    </tr>
                </table>
            </div>

            <!--OTROS TORNEOS-->
            <div class="tab-pane fade" id="torneos-otros" role="tabpanel" aria-labelledby="menu-torneos-otros">
                <table class="table table-hover">
                    <tr>
                        <th>Nombre del Equipo</th>
                        <th>Disciplina</th>
                    </tr>
                    <tbody>
                        <?php
                        $sql= "select id,nombre_torneo, fecha_inicio from creacion_torneo where disciplina = 'otro'";
                        $result=mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $mostrar['nombre_torneo'] ?></td>
                                <td><?php echo $mostrar['fecha_inicio'] ?>
                                </td>
                                <td><button type="button" class="btn btn-outline-primary" data-toggle="modal" onclick="ingresarTorneo(<?php echo $mostrar['id'] ?>)" >Ingresar</button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>

            <!--EQUIPOS-->
            <div class="tab-pane fade" id="torneos-equipos" role="tabpanel" aria-labelledby="menu-torneos-equipos">

                <table class="table table-hover">
                    <tr>
                        <th>Nombre del Equipo</th>
                        <th>Disciplina</th>
                        <th>Tipo de equipo</th>
                        <th></th>
                    </tr>
                    <tbody>
                        <?php
                        $sql= "SELECT `equipos`.`id`,`equipos`.`integrantes`, `equipos`.`contrasena`, 
                                `equipos`.`nombre_equipo`, `equipos`.`creacion`, `equipos`.`id_lider`, 
                                `equipos`.`privado`, `equipos`.`torneo`, `equipos`.`id_torneo`, 
                                `creacion_torneo`.`nombre_torneo` FROM `equipos` INNER JOIN `creacion_torneo` 
                                ON `equipos`.`id_torneo` = creacion_torneo.id";
                        $result=mysqli_query($conexion,$sql);
                        $pop = 0;

                        while($mostrar=mysqli_fetch_array($result)){
                        $pop = $mostrar['id'];
                        $pop2=$mostrar['id_torneo'];
                        ?>
                        <tr>
                            <td><?php echo $mostrar['nombre_equipo'] ?></td>
                            <td><?php echo $mostrar['nombre_torneo'] ?></td>
                            <td><?php if($mostrar['privado']==0){echo "publico";}else{echo "privado";} ?></td>
                            <?php if ($mostrar['privado'] == 0){ ?>
                                <td><!--BOTON PUBLICO-->
                                    <button type="button" class="btn btn-outline-primary" onclick="ingresarEquipoPublico(<?php echo $mostrar['id'] ?>,<?php echo $mostrar['id_torneo'] ?>,0)">Ingresar</button>

                                </td>
                                <?php }else{ ?><td><button type="button" class="btn btn-outline-primary" data-toggle="modal" name="unirse" value="<?php echo $mostrar['id'] ?>" data-target="#AgregarContraEquipo">Ingresar</button></td>
                                <?php } ?>

                        </tr>
                            <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!--MODAL INGRESAR CONTRASEÑA DE EQUIPO-->
<div class="modal fade" id="AgregarContraEquipo" tabindex="-1" role="dialog" aria-labelledby="ingresaContraEquipo" aria-hidden="true"e>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingresaContraEquipo">Ingresa la contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Ingresa la contraseña que tu líder de equipo te proporcionó</p>
                <p>Una vez ingresada podrás ser parte del equipo</p>

                <form id="prueba" method="post">
                    <input type="hidden" name="estatus" value="1">
                    <div class="form-group">
                        <label for="disciplina-torneo-registro"></label>
                        <input type="text" minlength="4" class="form-control" name="contraequipo" id="pwd-equipo" required>
                        <input type="hidden" value="1" name="estatus">
                        <input type="text" class="form-control" name="equipo" value="<?php echo $pop ?>" hidden>
                        <input type="hidden" name="torneo" value="<?php echo $pop2 ?>">
                    </div>

                    <div class="modal-footer justify-content-center">

                        <?php
                        if (!empty($_SESSION['id_usuario'])){

                            ?>
                            <button type="submit" class="btn btn-outline-primary">INGRESAR</button>

                            <?php
                        }else{
                            ?>
                            <button type="button" id="cerrarbtn" class="btn btn-outline-info justify-content-md-end close" data-dismiss="modal" data-toggle="modal" data-target="#errorsesion">
                                ENVIAR SOLICITUD
                            </button>
                            <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    function ingresarTorneo(idTorneo){
        console.log(idTorneo);
        $.ajax({
            type: 'POST',
            url: 'php/otoneos.php',
            data: {torneo:idTorneo},
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == "entra") {///////registro exitoso
                    Swal.fire({
                        icon: 'success',
                        title: 'Estas registrado',
                        text: 'Se te enviará un correo para ver los detalles del torneo',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                } else if (data.status == "ya") {///////registrado
                    Swal.fire({
                        icon: 'info',
                        title: 'Ya estas registrado',
                        text: 'No puedes registrate de nuevo',

                        showConfirmButton: false,
                    });
                } else if (data.status == "error") {///////registrado
                    Swal.fire({
                        icon: 'error',
                        title: 'Inicia sesión',
                        text: 'Debes iniciar sesión para poder inscribirte',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }else if (data.status == "salida") {///////registrado
                    Swal.fire({
                        icon: 'info',
                        title: 'El torneo ya llego a su maximo de participantes',
                        text: 'Debes iniciar sesión para poder inscribirte',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            }
        });
    }

    function ingresarEquipoPublico(equipo,torneo,estatus){
        $.ajax({
            type: 'POST',
            url: 'php/registro-usuario-a-equipo.php',
            data:{torneo:torneo,equipo:equipo, estatus:estatus },
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == "ya") {///////registrado
                    Swal.fire({
                        icon: 'info',
                        title: 'Ya estás registrado',
                        text: 'No puedes registrate de nuevo',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                } else if (data.status == "entrapublico") {///////registrado
                    Swal.fire({
                        icon: 'success',
                        title: 'Ya estás registrado',
                        text: 'No puedes registrate de nuevo',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }else if (data.status == "salida") {///////registrado
                    Swal.fire({
                        icon: 'error',
                        title: 'ocurrio un error',
                        text: 'Debes iniciar sesión para poder inscribirte',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }else if (data.status == "no") {///////registrado
                    Swal.fire({
                        icon: 'error',
                        title: 'Inicia sesión',
                        text: 'Debes iniciar sesión para poder inscribirte',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            }
        });
    }

    function cerrarCrearTorneo(){
        $('#crearTorneo').modal('hide');
        $('#disciplina-torneo-registro').val('');
        $('#descripcion-torneo-registro').val('')
    }

    function cerrarPirvado(){
        $('#AgregarContraEquipo').modal('hide');
        $('#pwd-equipo').val('');
    }

    function cerrarCrearEquipo(){
        $('#crearEquipo').modal('hide');
        $('#privado').val('');
        $('#nombre-equipo-registro').val('')
        $('#privado').val('false')
        $('#contrasena-equipo-registro').val('')

    }

    $(document).ready(function() {
////////torneos privados
        $("#prueba").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'php/registro-usuario-a-equipo.php',
                data: $('#prueba').serialize(),
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if (data.status == "entraprivado") {///////registro exitoso
                        Swal.fire({
                            icon: 'success',
                            title: 'Estás registrado',
                            text: 'Se te enviará un correo para ver los detalles del torneo',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(cerrarPirvado, 2000);
                    } else if (data.status == "ya") {///////registrado
                        Swal.fire({
                            icon: 'info',
                            title: 'Ya estás registrado',
                            text: 'No puedes registrate de nuevo',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(cerrarPirvado, 2000);
                    } else if (data.status == "no") {///////registrado
                        Swal.fire({
                            icon: 'error',
                            title: 'Inicia sesión',
                            text: 'Debes iniciar sesión para poder inscribirte',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                }
            });
        });
////////crearEquipo
        $("#registrar-equipo").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'php/registro-de-equipos.php',
                data: $('#registrar-equipo').serialize(),
                cache: false,
                dataType: 'json',
                success: function (data) {

                    if (data.status == "ya") {///////registrado
                        Swal.fire({
                            icon: 'success',
                            title: 'Tu equipo fue regristrado',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(cerrarCrearEquipo, 2000);
                    }
                    else if (data.status == "no") {///////registrado
                        Swal.fire({
                            icon: 'error',
                            title: 'Inicia sesión',
                            text: 'Debes iniciar sesión para poder inscribirte',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(cerrarCrearEquipo, 2000);
                    }else if (data.status == "ok") {///////registrado
                        Swal.fire({
                            icon: 'info',
                            title: 'Ya tienes equipo en el torneo',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(cerrarCrearEquipo, 2000);
                    }
                }
            });
        });
////////solicitud torneo
        $("#solicitud").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'php/solicitud-torneo.php',
                data: $('#solicitud').serialize(),
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if (data.status == "ya") {///////registrado
                        Swal.fire({
                            icon: 'success',
                            title: 'Se envio tu solicitud',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        setTimeout(cerrarCrearTorneo, 2000);
                    }

                    else if (data.status == "no") {///////registrado
                        Swal.fire({
                            icon: 'error',
                            title: 'Inicia sesión',
                            text: 'Debes iniciar sesión para poder inscribirte',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                }
            });
        });
    });
</script>

<script>

</script>
</body>

<?php
require 'php/footer.php'
?>

</html>
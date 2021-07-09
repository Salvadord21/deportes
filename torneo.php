<?php
session_start();
require 'php/conexion.php';


$fbardas="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='futbol bardas'";
$resultadoB = mysqli_query($conexion, $fbardas);
$mostrarB=mysqli_fetch_array($resultadoB);
$idBaas=$mostrarB['id'];

$fascenso="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='ascenso'";
$resultadoA = mysqli_query($conexion, $fascenso);
$mostrarA=mysqli_fetch_array($resultadoA);
$idAs = $mostrarA['id'];

$fifa="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='fifa'";
$resultadoF = mysqli_query($conexion, $fifa);
$mostrarF=mysqli_fetch_array($resultadoF);
$idFif = $mostrarF['id'];

$voley="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='voleibol'";
$resultadoV = mysqli_query($conexion, $voley);
$mostrarV=mysqli_fetch_array($resultadoV);
$idVol = $mostrarV['id'];

$basquet="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='Basquetbol'";
$resultadoBa = mysqli_query($conexion, $basquet);
$mostrarBa=mysqli_fetch_array($resultadoBa);
$idBasquet = $mostrarBa['id'];
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
            <a class="nav-item nav-link active" id="menu-torneos-futbol" data-toggle="pill" href="#torneos-futbol" role="tab" aria-controls="torneos-futbol" aria-selected="true">Bardas Premier</a>
            <a class="nav-item nav-link " id="menu-torneos-futbol-2" data-toggle="pill" href="#torneos-asenso" role="tab" aria-controls="torneos-futbol" aria-selected="true">Bardas Ascenso</a>
            <a class="nav-item nav-link" id="menu-torneos-fifa" data-toggle="pill" href="#torneos-fifa" role="tab" aria-controls="torneos-fifa" aria-selected="false">FIFA</a>
            <a class="nav-item nav-link" id="menu-torneos-volley" data-toggle="pill" href="#torneos-volley" role="tab" aria-controls="torneos-volley" aria-selected="false">Voleibol</a>
            <a class="nav-item nav-link" id="menu-torneos-basquet" data-toggle="pill" href="#torneos-basquet" role="tab" aria-controls="torneos-basquet" aria-selected="false">Basquétbol</a>
            <a class="nav-item nav-link" id="menu-torneos-basquet" data-toggle="pill" href="#resultado" role="tab" aria-controls="resultado" aria-selected="false">Resultados</a>
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
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva" data-toggle="tab" href="#futbol-goleadores" role="tab" aria-controls="futbol-defensiva" aria-selected="false">Goleadores</a>
                    </li>
                </ul>

                <!--SUBMENU FUTBOL-->
                <div class="tab-content" id="tab-futbol-contenido">
                    <div class="tab-pane fade show active" id="futbol-general" role="tabpanel" aria-labelledby="tab-futbol-general">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= " Select * FROM `tabla_fut` WHERE`torneo_id`='$idBaas' ORDER BY `tabla_fut`.`gf` DESC";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['jj'] ?></td>
                                    <td><?php echo $mostrar['jg'] ?></td>
                                    <td><?php echo $mostrar['je'] ?></td>
                                    <td><?php echo $mostrar['jp'] ?></td>
                                    <td><?php echo $mostrar['gf'] ?></td>
                                    <td><?php echo $mostrar['gc'] ?></td>
                                    <td><?php echo $mostrar['df'] ?></td>
                                    <td><?php echo $mostrar['puntos'] ?></td>
                                </tr>

                                <?php  $cont++; } ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="futbol-ofensiva" role="tabpanel" aria-labelledby="tab-futbol-ofensiva">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre_equipo`, `gf` FROM `tabla_fut` WHERE `torneo_id`='$idBaas' ORDER BY gf DESC";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gf'] ?></td>

                                </tr>

                                <?php  $cont++; } ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="futbol-defensiva" role="tabpanel" aria-labelledby="tab-futbol-defensiva">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre_equipo`, `gc` FROM `tabla_fut` WHERE`torneo_id`='$idBaas' ORDER BY gc";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gc'] ?></td>

                                </tr>

                                <?php  $cont++; } ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="futbol-goleadores" role="tabpanel" aria-labelledby="tab-futbol-defensiva">

                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Goleador</th>
                                <th>Equipo</th>
                                <th>Goles</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre`,SUM( `goles`) as goles, `nombre_equipo`FROM `goleadoresfut` WHERE`torneo_id`='$idBaas' GROUP BY `nombre` ORDER BY `goles` DESC ";
                            $result=mysqli_query($conexion,$sql);
                            $pop = 0;

                            while($mostrar=mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?php echo $mostrar['nombre'] ?></td>
                                    <td><?php echo $mostrar['goles'] ?></td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <!--FUTBOL ascenso-->
            <div class="tab-pane fade show " id="torneos-asenso" role="tabpanel" aria-labelledby="menu-torneos-futbol-2">
                <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-futbol-general-a" data-toggle="tab" href="#futbol-general-a" role="tab" aria-controls="futbol-general" aria-selected="true">Tabla General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-ofensiva-a" data-toggle="tab" href="#futbol-ofensiva-a" role="tab" aria-controls="futbol-ofensiva" aria-selected="false">Mejor ofensiva</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva-a" data-toggle="tab" href="#futbol-defensiva-a" role="tab" aria-controls="futbol-defensiva" aria-selected="false">Mejor defensiva</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva-ab" data-toggle="tab" href="#futbol-defensiva-ab" role="tab" aria-controls="futbol-defensiva" aria-selected="false">Goleadores</a>
                    </li>
                </ul>

                <!--SUBMENU FUTBOL-->
                <div class="tab-content" id="tab-futbol-contenido">
                    <div class="tab-pane fade show active" id="futbol-general-a" role="tabpanel" aria-labelledby="tab-futbol-general-a">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= " Select nombre_equipo, gf, gc, df,jj, puntos,jg,jp,je FROM `tabla_ascenso` WHERE 'torneo_id' = '$idAs' ORDER BY `tabla_ascenso`.`df` DESC";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['jj'] ?></td>
                                    <td><?php echo $mostrar['jg'] ?></td>
                                    <td><?php echo $mostrar['je'] ?></td>
                                    <td><?php echo $mostrar['jp'] ?></td>
                                    <td><?php echo $mostrar['gf'] ?></td>
                                    <td><?php echo $mostrar['gc'] ?></td>
                                    <td><?php echo $mostrar['df'] ?></td>
                                    <td><?php echo $mostrar['puntos'] ?></td>
                                </tr>

                                <?php  $cont++; } ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="futbol-ofensiva-a" role="tabpanel" aria-labelledby="tab-futbol-ofensiva-a">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre_equipo`, `gf` FROM `tabla_ascenso` WHERE 'torneo_id' = '$idAs' ORDER BY gf DESC";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gf'] ?></td>

                                </tr>

                                <?php  $cont++; } ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="futbol-defensiva-a" role="tabpanel" aria-labelledby="tab-futbol-defensiva-a">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre_equipo`, `gc` FROM `tabla_ascenso` WHERE 'torneo_id' = '$idAs' ORDER BY gc";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gc'] ?></td>

                                </tr>
                                <?php  $cont++; } ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="futbol-defensiva-ab" role="tabpanel" aria-labelledby="tab-futbol-defensiva-a">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre`, SUM(`goles`) as goles, `nombre_equipo` FROM `goleadoresascenso` WHERE 'torneo_id' = '$idAs' GROUP by nombre ORDER BY `goles` DESC";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre'] ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['goles'] ?></td>
                                </tr>
                                <?php  $cont++; } ?>
                            </tbody>

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
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "Select * FROM `tabla_fifa` WHERE 'torneo_id' = '$idFif' ORDER BY `tabla_fifa`.`puntos` DESC, tabla_fifa.df, tabla_fifa.gf DESC";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['jj'] ?></td>
                                    <td><?php echo $mostrar['jg'] ?></td>
                                    <td><?php echo $mostrar['je'] ?></td>
                                    <td><?php echo $mostrar['jp'] ?></td>
                                    <td><?php echo $mostrar['gf'] ?></td>
                                    <td><?php echo $mostrar['gc'] ?></td>
                                    <td><?php echo $mostrar['df'] ?></td>
                                    <td><?php echo $mostrar['puntos'] ?></td>
                                </tr>
                                <?php  $cont++; } ?>
                            </tbody>

                        </table>
                    </div>

                    <div class="tab-pane fade" id="fifa-goleadores" role="tabpanel" aria-labelledby="tab-futbol-ofensiva">

                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT `nombre`, SUM(`goles`) as goles, `nombre_equipo` FROM `goleadoresfifa` WHERE 'torneo_id' = '$idFif' GROUP by nombre ORDER BY `goles` DESC";                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $cont ?></td>
                                    <td><?php echo $mostrar['nombre'] ?></td>
                                    <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['goles'] ?></td>
                                </tr>
                                <?php  $cont++; } ?>
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
            <!--VOLLEY-->
            <div class="tab-pane fade" id="torneos-volley" role="tabpanel" aria-labelledby="menu-torneos-volley">
                <table class="table table-hover">
                    <tr>
                        <th>local</th>
                        <th>gol</th>
                        <th>vs</th>
                        <th>Goles</th>
                        <th>visitante</th>
                    </tr>
                    <tbody>
                    <?php
                    $sql= " Select * FROM `tabla_vole` WHERE 'torneo_id' = '$idVol'";
                    $cont =1;
                    while($mostrar=mysqli_fetch_array($result)){

                        ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $mostrar['nombre_equipo'] ?></td>
                            <td><?php echo $mostrar['jj'] ?></td>
                            <td><?php echo $mostrar['jg'] ?></td>
                            <td><?php echo $mostrar['jp'] ?></td>
                            <td><?php echo $mostrar['pf'] ?></td>
                            <td><?php echo $mostrar['pc'] ?></td>
                            <td><?php echo $mostrar['pp'] ?></td>
                            <td><?php echo $mostrar['setF'] ?></td>
                            <td><?php echo $mostrar['setC'] ?></td>
                            <td><?php echo $mostrar['ps'] ?></td>
                        </tr>
                        <?php  $cont++; } ?>
                    </tbody>

                </table>

            </div>
            <!--BASQUET-->
            <div class="tab-pane fade" id="torneos-basquet" role="tabpanel" aria-labelledby="menu-torneos-basquet">
                <table class="table table-hover">
                    <tr>
                        <th>local</th>
                        <th>gol</th>
                        <th>vs</th>
                        <th>Goles</th>
                        <th>visitante</th>
                    </tr>
                    <tbody>
                    <?php
                    $sql= "Select * FROM `tabla_basquetbol` WHERE 'torneo_id' = '$idBasquet'";
                    $cont =1;
                    while($mostrar=mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $mostrar['nombre_equipo'] ?></td>
                            <td><?php echo $mostrar['jj'] ?></td>
                            <td><?php echo $mostrar['jg'] ?></td>
                            <td><?php echo $mostrar['jp'] ?></td>
                            <td><?php echo $mostrar['gf'] ?></td>
                            <td><?php echo $mostrar['gc'] ?></td>
                            <td><?php echo $mostrar['df'] ?></td>
                            <td><?php echo $mostrar['puntos'] ?></td>
                        </tr>
                        <?php  $cont++; } ?>
                    </tbody>

                </table>

            </div>
            <!--Resultado-->
            <div class="tab-pane fade" id="resultado" role="tabpanel" aria-labelledby="menu-resultado">
                <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#futbol-bardas" role="tab" aria-controls="futbol-bardas" aria-selected="true">Futbol Bardas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-ofensiva" data-toggle="tab" href="#futbol-ascenso" role="tab" aria-controls="futbol-ascenso" aria-selected="false">Futbol Ascenso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva" data-toggle="tab" href="#fifa" role="tab" aria-controls="fifa" aria-selected="false">FIFA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva" data-toggle="tab" href="#basquetbol" role="tab" aria-controls="futbol-defensiva" aria-selected="false">Basquetbol</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-futbol-defensiva" data-toggle="tab" href="#voleibol" role="tab" aria-controls="futbol-defensiva" aria-selected="false">Voleibol</a>
                    </li>
                </ul>

                <!--SUBMENU FUTBOL-->
                <div class="tab-content" id="tab-futbol-contenido">
                    <div class="tab-pane fade show active" id="futbol-bardas" role="tabpanel" aria-labelledby="tab-futbol-general">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT * FROM `partidos_futbol` WHERE jornada=(SELECT MAX(jornada) FROM partidos_futbol) AND torneo_id='$idBaas'";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){
                                $locales=$mostrar['id_local'];
                                $visitantes=$mostrar['id_visita'];
                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                $resultaL=mysqli_query($conexion,$equipoL);
                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                $resultaV=mysqli_query($conexion,$equipoV);
                                $localL=mysqli_fetch_array($resultaL);
                                $visitaV=mysqli_fetch_array($resultaV);
                                ?>
                                <tr>
                                    <td><?php echo $localL['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gol_local'] ?></td>
                                    <td>vs</td>
                                    <td><?php echo $mostrar['gol_visita'] ?></td>
                                    <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                </tr>
                            <?php  } ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="futbol-ascenso" role="tabpanel" aria-labelledby="tab-futbol-ofensiva">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT * FROM `partidos_ascenso` WHERE jornada=(SELECT MAX(jornada) FROM partidos_ascenso) and torneo_id='$idAs'";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){
                                $locales=$mostrar['id_local'];
                                $visitantes=$mostrar['id_visita'];
                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                $resultaL=mysqli_query($conexion,$equipoL);
                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                $resultaV=mysqli_query($conexion,$equipoV);
                                $localL=mysqli_fetch_array($resultaL);
                                $visitaV=mysqli_fetch_array($resultaV);
                                ?>
                                <tr>
                                    <td><?php echo $localL['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gol_local'] ?></td>
                                    <td>vs</td>
                                    <td><?php echo $mostrar['gol_visita'] ?></td>
                                    <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                </tr>
                            <?php  } ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="fifa" role="tabpanel" aria-labelledby="tab-futbol-defensiva">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT * FROM `partidos_fifa` WHERE jornada=(SELECT MAX(jornada) FROM partidos_fifa) and torneo_id='$idFif'";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){
                                $locales=$mostrar['id_local'];
                                $visitantes=$mostrar['id_visita'];
                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                $resultaL=mysqli_query($conexion,$equipoL);
                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                $resultaV=mysqli_query($conexion,$equipoV);
                                $localL=mysqli_fetch_array($resultaL);
                                $visitaV=mysqli_fetch_array($resultaV);
                                ?>
                                <tr>
                                    <td><?php echo $localL['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['gol_local'] ?></td>
                                    <td>vs</td>
                                    <td><?php echo $mostrar['gol_visita'] ?></td>
                                    <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                </tr>
                            <?php  } ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="basquetbol" role="tabpanel" aria-labelledby="tab-futbol-defensiva">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT * FROM `partidos_basquetbol` WHERE jornada=(SELECT MAX(jornada) FROM partidos_basquetbol) and creacion_torneo_id='$idBasquet'";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){
                                $locales=$mostrar['idLocal'];
                                $visitantes=$mostrar['idVisita'];
                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                $resultaL=mysqli_query($conexion,$equipoL);
                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                $resultaV=mysqli_query($conexion,$equipoV);
                                $localL=mysqli_fetch_array($resultaL);
                                $visitaV=mysqli_fetch_array($resultaV);
                                ?>
                                <tr>
                                    <td><?php echo $localL['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['canastasL'] ?></td>
                                    <td>vs</td>
                                    <td><?php echo $mostrar['canastasV'] ?></td>
                                    <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                </tr>
                            <?php  } ?>
                            </tbody>

                        </table>


                    </div>
                    <div class="tab-pane fade" id="voleibol" role="tabpanel" aria-labelledby="tab-futbol-defensiva">
                        <table class="table table-hover">
                            <tr>
                                <th>local</th>
                                <th>gol</th>
                                <th>vs</th>
                                <th>Goles</th>
                                <th>visitante</th>
                            </tr>
                            <tbody>
                            <?php
                            $sql= "SELECT * FROM `partidos_vole` WHERE jornada=(SELECT MAX(jornada) FROM partidos_vole) and creacion_torneo_id='$idVol'";
                            $result=mysqli_query($conexion,$sql);
                            $cont =1;
                            while($mostrar=mysqli_fetch_array($result)){
                                $locales=$mostrar['id_local'];
                                $visitantes=$mostrar['id_visita'];
                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                $resultaL=mysqli_query($conexion,$equipoL);
                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                $resultaV=mysqli_query($conexion,$equipoV);
                                $localL=mysqli_fetch_array($resultaL);
                                $visitaV=mysqli_fetch_array($resultaV);
                                ?>
                                <tr>
                                    <td><?php echo $localL['nombre_equipo'] ?></td>
                                    <td><?php echo $mostrar['set1L'] ?></td>
                                    <td><?php echo $mostrar['set2L'] ?></td>
                                    <td><?php echo $mostrar['set3L'] ?></td>
                                    <td>vs</td>
                                    <td><?php echo $mostrar['set3V'] ?></td>
                                    <td><?php echo $mostrar['set2V'] ?></td>
                                    <td><?php echo $mostrar['set1V'] ?></td>
                                    <td><?php echo $visitaV['nombre_equipo'] ?></td>

                                </tr>
                            <?php  } ?>
                            </tbody>

                        </table>


                    </div>

                </div>
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
                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='otro' AND fecha_limite>=CURDATE() AND fecha_inicio<=CURDATE() and `delete` is null";
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
                    $sql10= "SELECT * FROM `fechaequipos`";
                    $result10=mysqli_query($conexion,$sql10);
                    $pop = 0;

                    while($mostrar10=mysqli_fetch_array($result10)){
                        $pop = $mostrar10['id'];
                        $pop2=$mostrar10['id_torneo'];
                        ?>
                        <tr>
                            <td><?php echo $mostrar10['nombre_equipo'] ?></td>
                            <td><?php echo $mostrar10['torneo'] ?></td>
                            <td><?php if($mostrar10['privado']==0){echo "publico";}else{echo "privado";} ?></td>
                            <?php if ($mostrar10['privado'] == 0){ ?>
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
<div class="modal fade" id="AgregarContraEquipo" tabindex="-1" role="dialog" aria-labelledby="ingresaContraEquipo" aria-hidden="true">
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
        $('#nombre-equipo-registro').val('');
        $('#privado').val('false');
        $('#contrasena-equipo-registro').val('');

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
                    if (data.status == "entrapriv") {///////registro exitoso
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
</body>

<?php
require 'php/footer.php'
?>

</html>
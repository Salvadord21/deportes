<?php
session_start();
require 'php/conexion.php';


$fbardas="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='futbol bardas'";
$resultadoB = mysqli_query($conexion, $fbardas);
$mostrarB=mysqli_fetch_array($resultadoB);
$idBaas2=$mostrarB['id'];

$fascenso="SELECT MAX(`id`) as id2 FROM creacion_torneo WHERE disciplina='ascenso'";
$resultadoA = mysqli_query($conexion, $fascenso);
$mostrarA=mysqli_fetch_array($resultadoA);
$idAs2 = $mostrarA['id2'];

$fifa="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='fifa'";
$resultadoF = mysqli_query($conexion, $fifa);
$mostrarF=mysqli_fetch_array($resultadoF);
$idFif2 = $mostrarF['id'];

$voley="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='voleibol'";
$resultadoV = mysqli_query($conexion, $voley);
$mostrarV=mysqli_fetch_array($resultadoV);
$idVol2 = $mostrarV['id'];

$basquet="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='Basquetbol'";
$resultadoBa = mysqli_query($conexion, $basquet);
$mostrarBa=mysqli_fetch_array($resultadoBa);
$idBasquet2 = $mostrarBa['id'];
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
                <h2 style="margin-bottom: 65px;">Partidos</h2>
            </div>
        </div>
        <br>



        <br>

        <!--Menu principal-->
        <div class="nav nav-pills nav-fill" id="menu-torneos-disciplinas" role="tablist">
            <a class="nav-item nav-link active" id="menu-torneos-futbol" data-toggle="pill" href="#torneos-futbol" role="tab" aria-controls="torneos-futbol" aria-selected="true">Bardas Premier</a>
            <a class="nav-item nav-link " id="menu-torneos-futbol-2" data-toggle="pill" href="#torneos-asenso" role="tab" aria-controls="torneos-futbol" aria-selected="true">Bardas Ascenso</a>
            <a class="nav-item nav-link" id="menu-torneos-fifa" data-toggle="pill" href="#torneos-fifa" role="tab" aria-controls="torneos-fifa" aria-selected="false">FIFA</a>
            <a class="nav-item nav-link" id="menu-torneos-volley" data-toggle="pill" href="#torneos-volley" role="tab" aria-controls="torneos-volley" aria-selected="false">Voleibol</a>
            <a class="nav-item nav-link" id="menu-torneos-basquet" data-toggle="pill" href="#torneos-basquet" role="tab" aria-controls="torneos-basquet" aria-selected="false">Basquétbol</a>
        </div>
        <br>

        <div class="tab-content" id="menu-torneos-disciplinas-categorias">

            <!--FUTBOL-->
            <div class="tab-pane fade show active" id="torneos-futbol" role="tabpanel" aria-labelledby="menu-torneos-futbol">
                <?php
                $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='futbol bardas'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'futbol bardas')";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)) {
                    $id_torn=$mostrar['id'];
                    $jornadas = $mostrar['jornadas'];
                    $xsem=0;
                    ?>
                    <!-- Resultado de partidos  -->
                    <div class="card-body">

                        <!-- Muestran total de jornadas  -->
                        <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#fut1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#fut<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>


                        <!-- Muestran los resultados de partidos en jornada 1  va php-->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="fut1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Local</th>
                                        <th></th>
                                        <th>vs</th>
                                        <th></th>
                                        <th>vistante</th>
                                    </tr>
                                    <?php
                                    $sql= "SELECT * FROM `partidos_futbol` WHERE jornada='1' and `torneo_id`='$idBaas2'";
                                    $result=mysqli_query($conexion,$sql);
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
                                            <td><?php echo $mostrar['fecha'] ?></td>
                                            <td><?php if ($mostrar['resultado']== NULL){
                                                    echo "Por Jugar";
                                                }else{echo "Jugado";}?></td>
                                        </tr>
                                    <?php  } ?>
                                </table>

                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="fut<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>vistante</th>
                                        </tr>
                                        <!--imprime valores  aqui va php -->
                                        <?php
                                        $sql= "SELECT * FROM `partidos_futbol` WHERE jornada='$jornadascont2' and `torneo_id`='$idBaas2'  ";
                                        $result=mysqli_query($conexion,$sql);
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
                                                <td><?php echo $mostrar['fecha'] ?></td>
                                                <td><?php if ($mostrar['resultado']== NULL){
                                                        echo "Por Jugar";
                                                    }else{echo "Jugado";}?></td>
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--FUTBOL ascenso-->
            <div class="tab-pane fade show " id="torneos-asenso" role="tabpanel" aria-labelledby="menu-torneos-futbol-2">
                <?php
                $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='ascenso'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'ascenso')";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)) {
                    $id_torn=$mostrar['id'];
                    $jornadas = $mostrar['jornadas'];
                    $y= $mostrar['numero_equipos'];
                    if (($y%2)==0){
                        $partidos=($y/2);
                    }else{
                        $partidos=($y/2)-0.5;
                    }

                    $xsem=0;
                    ?>
                    <!-- Resultado de partidos  -->
                    <div class="card-body">

                        <!-- Muestran total de jornadas  -->
                        <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#ass1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#ass<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <!-- Muestran los resultados de partidos en jornada 1 -->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="ass1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <form action="imc/partidosFIFA.php" method="post">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_ascenso` WHERE jornada='1' and `torneo_id`='$idAs2'";
                                        $result=mysqli_query($conexion,$sql);
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
                                                <td><?php echo $mostrar['fecha'] ?></td>
                                                <td><?php if ($mostrar['resultado']== NULL){
                                                        echo "Por Jugar";
                                                    }else{echo "Jugado";}?></td>
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </form>
                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="ass<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                    <form action="imc/partidosFIFA.php" method="post" >
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Local</th>
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <?php
                                            $sql= "SELECT * FROM `partidos_ascenso` WHERE jornada='$jornadascont2' and `torneo_id`='$idAs2'";
                                            $result=mysqli_query($conexion,$sql);
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
                                                    <td><?php echo $mostrar['fecha'] ?></td>
                                                    <td><?php if ($mostrar['resultado']== NULL){
                                                            echo "Por Jugar";
                                                        }else{echo "Jugado";}?></td>
                                                </tr>
                                            <?php  } ?>
                                        </table>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--FIFA-->
            <div class="tab-pane fade" id="torneos-fifa" role="tabpanel" aria-labelledby="menu-torneos-fifa">
                <?php
                $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='FIFA'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'FIFA')";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)) {
                    $id_torn=$mostrar['id'];
                    $jornadas = $mostrar['jornadas'];
                    $y= $mostrar['numero_equipos'];
                    if (($y%2)==0){
                        $partidos=($y/2);
                    }else{
                        $partidos=($y/2)-0.5;
                    }

                    $xsem=0;
                    ?>
                    <!-- Resultado de partidos  -->
                    <div class="card-body">

                        <!-- Muestran total de jornadas  -->
                        <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#fifa1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#fifa<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <!-- Muestran los resultados de partidos en jornada 1 -->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="fifa1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Local</th>
                                        <th></th>
                                        <th>vs</th>
                                        <th></th>
                                        <th>vistante</th>
                                    </tr>
                                    <?php
                                    $sql= "SELECT * FROM `partidos_fifa`  WHERE jornada='1' and `torneo_id`='$idFif2'  ";
                                    $result=mysqli_query($conexion,$sql);
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
                                            <td><?php echo $mostrar['fecha'] ?></td>
                                            <td><?php if ($mostrar['resultado']== NULL){
                                                    echo "Por Jugar";
                                                }else{echo "Jugado";}?></td>
                                        </tr>
                                    <?php  } ?>

                                </table>
                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="fifa<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>vistante</th>
                                        </tr>
                                        <!--imprime valores -->
                                        <?php
                                        $sql= "SELECT * FROM `partidos_fifa` WHERE jornada='$jornadascont2' and `torneo_id`='$idFif2'";
                                        $result=mysqli_query($conexion,$sql);
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
                                                <td><?php echo $mostrar['fecha'] ?></td>
                                                <td><?php if ($mostrar['resultado']== NULL){
                                                        echo "Por Jugar";
                                                    }else{echo "Jugado";}?></td>
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--VOLLEY-->
            <div class="tab-pane fade" id="torneos-volley" role="tabpanel" aria-labelledby="menu-torneos-volley">
                <?php
                $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='voleibol'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'voleibol')";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)) {
                    $id_torn=$mostrar['id'];
                    $jornadas = $mostrar['jornadas'];
                    $xsem=0;
                    ?>
                    <!-- Resultado de partidos  -->
                    <div class="card-body">

                        <!-- Muestran total de jornadas  -->
                        <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#vole1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#vole<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <!-- Muestran los resultados de partidos en jornada 1 -->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="vole1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <form action="imc/partidosFIFA.php" method="post">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th>SET 1</th>
                                            <th>SET 2</th>
                                            <th>SET 3</th>
                                            <th>vs</th>
                                            <th>SET 3</th>
                                            <th>SET 2</th>
                                            <th>SET 1</th>
                                            <th>vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_vole`   WHERE jornada='1' and torneo_id= '$idVol2' ";
                                        $result=mysqli_query($conexion,$sql);
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
                                                <td><?php echo $mostrar['fecha'] ?></td>
                                                <td><?php if ($mostrar['resultado']== NULL){
                                                        echo "Por Jugar";
                                                    }else{echo "Jugado";}?></td>
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </form>
                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="vole<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                    <form action="imc/partidosFIFA.php" method="post" >
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Local</th>
                                                <th>SET 1</th>
                                                <th>SET 2</th>
                                                <th>SET 3</th>
                                                <th>vs</th>
                                                <th>SET 3</th>
                                                <th>SET 2</th>
                                                <th>SET 1</th>
                                                <th>vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <?php
                                            $sql3= "SELECT * FROM `partidos_vole` WHERE jornada='$jornadascont2' AND torneo_id= '$idVol2'";
                                            $result3=mysqli_query($conexion,$sql3);
                                            while($mostrar3=mysqli_fetch_array($result3)){
                                                $locales=$mostrar3['id_local'];
                                                $visitantes=$mostrar3['id_visita'];
                                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                                $resultaL=mysqli_query($conexion,$equipoL);
                                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                                $resultaV=mysqli_query($conexion,$equipoV);
                                                $localL=mysqli_fetch_array($resultaL);
                                                $visitaV=mysqli_fetch_array($resultaV);
                                                ?>
                                                <tr>
                                                    <td><?php echo $localL['nombre_equipo'] ?></td>
                                                    <td><?php echo $mostrar3['set1L'] ?></td>
                                                    <td><?php echo $mostrar3['set2L'] ?></td>
                                                    <td><?php echo $mostrar3['set3L'] ?></td>
                                                    <td>vs</td>
                                                    <td><?php echo $mostrar3['set3V'] ?></td>
                                                    <td><?php echo $mostrar3['set2V'] ?></td>
                                                    <td><?php echo $mostrar3['set1V'] ?></td>
                                                    <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                                    <td><?php echo $mostrar['fecha'] ?></td>
                                                    <td><?php if ($mostrar['resultado']== NULL){
                                                            echo "Por Jugar";
                                                        }else{echo "Jugado";}?></td>
                                                </tr>
                                            <?php  } ?>
                                        </table>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--BASQUET-->
            <div class="tab-pane fade" id="torneos-basquet" role="tabpanel" aria-labelledby="menu-torneos-basquet">
                <?php
                $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='basquetbol'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'basquetbol')";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)) {
                    $id_torn=$mostrar['id'];
                    $jornadas = $mostrar['jornadas'];
                    $y= $mostrar['numero_equipos'];
                    if (($y%2)==0){
                        $partidos=($y/2);
                    }else{
                        $partidos=($y/2)-0.5;
                    }

                    $xsem=0;
                    ?>
                    <!-- Resultado de partidos  -->
                    <div class="card-body">

                        <!-- Muestran total de jornadas  -->
                        <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#bask1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#bask<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>


                        <!-- Muestran los resultados de partidos en jornada 1 -->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="bask1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <form action="imc/partidosFIFA.php" method="post">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_basquetbol` WHERE jornada='1' and `torneo_id`='$idBasquet2' ";
                                        $result=mysqli_query($conexion,$sql);
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
                                                <td><?php echo $mostrar['fecha'] ?></td>
                                                <td><?php if ($mostrar['resultado']== NULL){
                                                        echo "Por Jugar";
                                                    }else{echo "Jugado";}?></td>
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </form>
                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="bask<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                    <form action="imc/partidosFIFA.php" method="post" >
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Local</th>
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <?php
                                            $sql= "SELECT * FROM `partidos_basquetbol`   WHERE jornada='$jornadascont2' and `torneo_id`='$idBasquet2' ";
                                            $result=mysqli_query($conexion,$sql);
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
v                                                   <td><?php echo $mostrar['fecha'] ?></td>
                                                    <td><?php if ($mostrar['resultado']== NULL){
                                                        echo "Por Jugar";
                                                        }else{echo "Jugado";}?></td>
                                                </tr>
                                            <?php  } ?>
                                        </table>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>


    </div>
</div>
+



<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

<?php
require 'php/footer.php'
?>

</html>
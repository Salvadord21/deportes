<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';

$voley="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='voleibol'";
$resultadoV = mysqli_query($conexion, $voley);
$mostrarV=mysqli_fetch_array($resultadoV);
$idVol = $mostrarV['id'];
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- inicio pagina -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Calendario de partidos -->
        <div class="col-12" id="result2">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Voleibol - Agregar resultados</h6>

                </div>
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
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#pruena1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#pruena<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <!-- Muestran los resultados de partidos en jornada 1 -->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="pruena1" role="tabpanel" aria-labelledby="tab-futbol-general">
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
                                            <th>Vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_vole`   WHERE jornada='1' AND torneo_id= '$idVol' and `resultado` is null";
                                        $result=mysqli_query($conexion,$sql);
                                        $cont=1;
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
                                                <td><?php echo $localL['nombre_equipo'] ?> <input type="hidden" value="<?php echo $mostrar['id_local']?>"id="idL1-<?php echo $cont?>"></td>
                                                <td><input type="text" class="form-control" id="setL1-1-<?php echo $cont?>" style="width: 75px"></td>
                                                <td><input type="text" class="form-control" id="setL2-1-<?php echo $cont?>"style="width: 75px"></td>
                                                <td><input type="text" class="form-control" id="setL3-1-<?php echo $cont?>" style="width: 75px"></td>
                                                <td>vs</td>
                                                <td><input type="text" class="form-control" id="setV3-1-<?php echo $cont?>" style="width: 75px"></td>
                                                <td><input type="text" class="form-control" id="setV2-1-<?php echo $cont?>" style="width: 75px"></td>
                                                <td><input type="text" class="form-control" id="setV1-1-<?php echo $cont?>" style="width: 75px"></td>
                                                <td><?php echo $visitaV['nombre_equipo'] ?> <input type="hidden" value="<?php echo $mostrar['id_visita']?>"id="idV1-<?php echo $cont?>">
                                                    <input type="hidden" value="<?php echo $mostrar['torneo_id']?>" id="torneo1-<?php echo $cont?>"></td>
                                                <td><button type="button" class="btn btn-primary" onclick="guardar(1,<?php echo $cont?>)" >Guardar</button> </td>
                                            </tr>
                                        <?php $cont++; } ?>
                                    </table>
                                </form>
                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="pruena<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
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
                                                <th>Vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <?php
                                            $sql3= "SELECT * FROM `partidos_vole` WHERE jornada='$jornadascont2' AND torneo_id= '$idVol' and `resultado` is null";
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
                                                $cont=1;
                                                ?>
                                                <tr>
                                                    <td><?php echo $localL['nombre_equipo'] ?><input type="hidden" value="<?php echo $mostrar3['id_local']?>"id="idL<?php echo $jornadascont2?>-<?php echo $cont?>"></td>
                                                    <td><input type="text" class="form-control" id="setL1-<?php echo $jornadascont2?>-<?php echo $cont?>" style="width: 75px"></td>
                                                    <td><input type="text" class="form-control" id="setL2-<?php echo $jornadascont2?>-<?php echo $cont?>"style="width: 75px"></td>
                                                    <td><input type="text" class="form-control" id="setL3-<?php echo $jornadascont2?>-<?php echo $cont?>" style="width: 75px"></td>
                                                    <td>vs</td>
                                                    <td><input type="text" class="form-control" id="setV3-<?php echo $jornadascont2?>-<?php echo $cont?>" style="width: 75px"></td>
                                                    <td><input type="text" class="form-control" id="setV2-<?php echo $jornadascont2?>-<?php echo $cont?>" style="width: 75px"></td>
                                                    <td><input type="text" class="form-control" id="setV1-<?php echo $jornadascont2?>-<?php echo $cont?>" style="width: 75px"></td>
                                                    <td><?php echo $visitaV['nombre_equipo'] ?><input type="hidden" value="<?php echo $mostrar3['id_visita']?>"id="idV<?php echo $jornadascont2?>-<?php echo $cont?>">
                                                        <input type="hidden" value="<?php echo $mostrar3['torneo_id']?>" id="torneo<?php echo $jornadascont2?>-<?php echo $cont?>"></td>
                                                    <td><button type="button" class="btn btn-primary" onclick="guardar(<?php echo $jornadascont2?>,<?php echo $cont?>)" >Guardar</button> </td>
                                                </tr>
                                            <?php  $cont++;} ?>
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

        <script>
            function guardar(x,y){
                var equipoV=$('#idV'+x+'-'+y).val();
                var equipoL=$('#idL'+x+'-'+y).val();
                var set1L=$('#setL1-'+x+'-'+y).val();
                var set2L=$('#setL2-'+x+'-'+y).val();
                var set3L=$('#setL3-'+x+'-'+y).val();
                var set1V=$('#setV1-'+x+'-'+y).val();
                var set2V=$('#setV2-'+x+'-'+y).val();
                var set3V=$('#setV3-'+x+'-'+y).val();
                var jornada=x;
                var torneo=$('#torneo'+x+'-'+y).val();
                $.ajax({
                    type: 'POST',
                    url: 'imc/partidosVoli.php',
                    data: {set1l:set1L,set2l:set2L,set3l:set3L,set1v:set1V,set2v:set2V,set3v:set3V,local:equipoL,visita:equipoV,jornada:jornada, torneo:torneo},
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        if (data.estatus == "ok") {///////registro exitoso
                            Swal.fire({
                                icon: 'success',
                                title: 'Partido Registrado',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            actualizar();
                        } else if (data.estatus == "salida") {///////registrado
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
            function actualizar(){
                $( "#result" ).load( "voleibol.php #result" );
                $( "#result2" ).load( "voleibol.php #result2" );
            }
        </script>


        <!-- ver resltados -->
        <div class="col-12" id="result">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>

                </div>
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
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#semana1" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                            </li>
                            <!-- imprime jornadas -->
                            <?php
                            for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#semana<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <!-- Muestran los resultados de partidos en jornada 1 -->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="semana1" role="tabpanel" aria-labelledby="tab-futbol-general">
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
                                            <th>Vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_vole`   WHERE jornada='1' and torneo_id= '$idVol' and `resultado` is not null ";
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
                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </form>
                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="semana<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
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
                                                <th>Vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <?php
                                            $sql3= "SELECT * FROM `partidos_vole` WHERE jornada='$jornadascont2' AND torneo_id= '$idVol' and `resultado` is not null";
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

        <!-- ver equipos -->
        <div class="col-xl-12 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Equipos</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Equipo</th>
                            <th>Jugadores</th>
                        </tr>
                        <?php
                        $sql= "SELECT `id`,`nombre_equipo` FROM `equipos` WHERE `id_torneo`=(SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=(SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='voleibol'))";
                        $result=mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <form action="jugadoresV.php" method="post">
                                    <td><?php echo $mostrar['nombre_equipo']?></td>
                                    <td>
                                        <input type="hidden" name="id_equipo" value="<?php echo $mostrar['id']?>">
                                        <button type="submit" class="btn btn-primary justify-content-md-end" data-toggle="modal" data-target="#crearEquipo">
                                            Ver
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <?php
    require 'imc/footer.php';
    ?>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>
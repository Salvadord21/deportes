<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
$fbardas="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='futbol bardas'";
$resultadoB = mysqli_query($conexion, $fbardas);
$mostrarB=mysqli_fetch_array($resultadoB);
$idBaas=$mostrarB['id'];


?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- inicio pagina -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Agregar resultados -->
        <div class="col-xl-12 col-lg-7" id="result2">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Fútbol premier - Agregar resultado</h6>
                </div>
                <div class="card-body">
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
                                    <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#partidos" role="tab" aria-controls="futbol-general" aria-selected="true">Semana 1</a>
                                </li>
                                <!-- imprime jornadas -->
                                <?php
                                for ($jornadascont=2; $jornadascont<$jornadas+1; $jornadascont++){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#partidos<?php echo $jornadascont; ?>" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Semana <?php echo $jornadascont; ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>


                            <!-- Muestran los resultados de partidos en jornada 1  va php-->
                            <div class="tab-content" id="tab-futbol-contenido">
                                <div class="tab-pane fade show active" id="partidos" role="tabpanel" aria-labelledby="tab-futbol-general">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>Vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_futbol` WHERE jornada='1' and `torneo_id`='$idBaas' and`resultado`is null";
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
                                                <td><?php echo $localL['nombre_equipo']?> <input type="hidden" value="<?php echo $mostrar['id_local']?>" id="idL1-<?php echo $cont?>"> </td>
                                                <td><input type="text" class="form-control" value="" id="golL1-<?php echo $cont?>"></td>
                                                <td>vs</td>
                                                <td><input type="text" class="form-control" value="" id="golV1-<?php echo $cont?>"></td>
                                                <td><?php echo $visitaV['nombre_equipo'] ?> <input type="hidden" value="<?php echo $mostrar['id_visita']?>"id="idV1-<?php echo $cont?>">
                                                    <input type="hidden" value="<?php echo $mostrar['torneo_id']?>" id="torneo1-<?php echo $cont?>">
                                                </td>
                                                <td><button class="btn btn-primary" onclick="guardar(1,<?php echo $cont?>)">Guardar</button>
                                                </td>
                                            </tr>
                                        <?php $cont++; } ?>
                                    </table>

                                </div>


                                <!-- muestra cuando hay mas de una jornada-->
                                <?php
                                for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                    ?>
                                    <div class="tab-pane fade" id="partidos<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Local</th>
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>Vistante</th>
                                            </tr>
                                            <!--imprime valores  aqui va php -->
                                            <?php
                                            $sql= "SELECT * FROM `partidos_futbol` WHERE jornada='$jornadascont2' and `torneo_id`='$idBaas' and`resultado`is null";
                                            $result=mysqli_query($conexion,$sql);
                                            $cont2=0;
                                            while($mostrar=mysqli_fetch_array($result)){
                                                $locales=$mostrar['id_local'];
                                                $visitantes=$mostrar['id_visita'];
                                                $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                                $resultaL=mysqli_query($conexion,$equipoL);
                                                $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                                $resultaV=mysqli_query($conexion,$equipoV);
                                                $localL=mysqli_fetch_array($resultaL);
                                                $visitaV=mysqli_fetch_array($resultaV);
                                                $cont2=1;
                                                ?>
                                                <tr>
                                                    <td><?php echo $localL['nombre_equipo']?> <input type="hidden" value="<?php echo $mostrar['id_local']?>" id="idL<?php echo $jornadascont2?>-<?php echo $cont?>"> </td>
                                                    <td><input type="text" class="form-control" value="" id="golL<?php echo $jornadascont2?>-<?php echo $cont?>"></td>
                                                    <td>vs</td>
                                                    <td><input type="text" class="form-control" value="" id="golV<?php echo $jornadascont2?>-<?php echo $cont?>"></td>
                                                    <td><?php echo $visitaV['nombre_equipo'] ?> <input type="hidden" value="<?php echo $mostrar['id_visita']?>"id="idV<?php echo $jornadascont2?>-<?php echo $cont?>">
                                                        <input type="hidden" value="<?php echo $mostrar['torneo_id']?>" id="torneo<?php echo $jornadascont2?>-<?php echo $cont?>">
                                                    </td>
                                                    <td><button class="btn btn-primary" onclick="guardar(<?php echo $jornadascont2?>,<?php echo $cont2?>)">Guardar</button></td>
                                                </tr>
                                            <?php $cont2++; } ?>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <script>
                    function guardar(x,y){
                        var equipoV=$('#idV'+x+'-'+y).val();
                        var equipoL=$('#idL'+x+'-'+y).val();
                        var golL=$('#golL'+x+'-'+y).val();
                        var golV=$('#golV'+x+'-'+y).val();
                        var jornada=x;
                        var torneo=$('#torneo'+x+'-'+y).val();
                        console.log(torneo)
                        $.ajax({
                            type: 'POST',
                            url: 'imc/partidosFut.php',
                            data: {golL:golL,golV:golV,local:equipoL,visita:equipoV,jornada:jornada, torneo:torneo},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.estatus == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Partido registrado correctamente',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                    actualizar();
                                } else if (data.estatus == "salida") {///////registrado
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'El torneo ya llegó a su máximo de participantes',
                                        text: '',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });

                    }
                    function actualizar(){
                        $( "#result" ).load( "fut.php #result" );
                        $( "#result2" ).load( "fut.php #result2" );
                    }
                </script>

            </div>
        </div>

        <!-- ver resltados -->
        <div class="col-xl-12 col-lg-7" id="result">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>

                </div>
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


                        <!-- Muestran los resultados de partidos en jornada 1  va php-->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="semana1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>Vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_futbol` WHERE jornada='1' and `torneo_id`='$idBaas' and resultado is not null";
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

                                            </tr>
                                            <?php  } ?>
                                    </table>

                            </div>


                            <!-- muestra cuando hay mas de una jornada-->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="semana<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Local</th>
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>Vistante</th>
                                            </tr>
                                            <!--imprime valores  aqui va php -->
                                            <?php
                                            $sql= "SELECT * FROM `partidos_futbol` WHERE jornada='$jornadascont2' and `torneo_id`='$idBaas'  and resultado is not null";
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
                        $sql= "SELECT `id`,`nombre_equipo` FROM `equipos` WHERE `id_torneo`=(SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=(SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='futbol bardas'))";
                        $result=mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <form action="jugadoresFut.php" method="get">
                                    <td><?php echo $mostrar['nombre_equipo']?></td>
                                    <td>
                                        <input type="hidden" name="id_equipo" value="<?php echo $mostrar['id']?>">
                                        <button type="submit" class="btn btn-primary justify-content-md-end" data-toggle="modal" data-target="#crearEquipo"data-toggle="modal" data-target="#crearEquipo">
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

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

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
<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';

$voley="SELECT MAX(`id`) as id FROM creacion_torneo WHERE disciplina='ascenso'";
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
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agregar Resultado</h6>

                </div>
                <div class="card-body form-group ">
                    <form id="FIFA" method="post">
                        <table class="table table-hover table-responsive">
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
                                <th>Jornada</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="local">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/EquiposVole.php';
                                        ?>
                                    </select>
                                </td>
                                <td><input type="number" style="width: 75px" id="set1l"></td>
                                <td><input type="number"style="width: 75px"id="set2l"></td>
                                <td><input type="number"style="width: 75px"id="set3l"></td>
                                <td>vs</td>
                                <td><input type="number"style="width: 75px" id="set3v"></td>
                                <td><input type="number"style="width: 75px" id="set2v"></td>
                                <td><input type="number"style="width: 75px" id="set1v"></td>
                                <td><select name="visita" id="visita">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/EquiposVole.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornada">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='voleibol' AND torneo_id= '$idVol'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>
                                    <?php
                                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='voleibol'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'voleibol' AND torneo_id= '$idVol')";
                                    $result=mysqli_query($conexion,$sql);
                                    $idTorneo=mysqli_fetch_array($result);
                                    ?>
                                    <input type="hidden"value="<?php echo $idTorneo['id'] ?>" id="torneo">
                                </td>
                                <td><button type="button" onclick="guardar()" > Guardar Resultado</button> </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <script>
                    function guardar(){
                        var equipov=$('#visita').val();
                        var equipol=$('#local').val();
                        var jornada=$('#jornada').val();
                        var set1l=$('#set1l').val();
                        var set2l=$('#set2l').val();
                        var set3l=$('#set3l').val();
                        var set1v=$('#set1v').val();
                        var set2v=$('#set2v').val();
                        var set3v=$('#set3v').val();
                        var torneo=$('#torneo').val();
                        $.ajax({
                            type: 'POST',
                            url: 'imc/partidosVoli.php',
                            data: {local:equipol,visita:equipov,jornada:jornada,torneo:torneo,set1l:set1l,set2l:set2l,set3l:set3l,set1v:set1v,set2v:set2v,set3v:set3v},
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
                    }
                </script>

            </div>
        </div>

        <!-- ver resltados -->
        <div class="col-12" id="result">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>

                </div>
                <?php
                $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='voleibol'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'voleibol' torneo_id= '$idVol')";
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
                                            <th>vistante</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_vole`   WHERE jornada='1'";
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
                                                <th>vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <?php
                                            $sql= "SELECT * FROM `partidos_vole`   WHERE jornada='$jornadascont2' AND torneo_id= '$idVol'";
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
                            <th>ver jugadores</th>
                        </tr>
                        <?php
                        $sql= "SELECT `id`,`nombre_equipo` FROM `equipos` WHERE `id_torneo`=(SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=(SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='voleibol'))";
                        $result=mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <form action="jugadoresFut.php" method="post">
                                    <td><?php echo $mostrar['nombre_equipo']?></td>
                                    <td>
                                        <input type="hidden" name="id_equipo" value="<?php echo $mostrar['id']?>">
                                        <button type="submit" class="btn btn-primary justify-content-md-end" data-toggle="modal" data-target="#crearEquipo"data-toggle="modal" data-target="#crearEquipo">
                                            jugadores
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
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
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
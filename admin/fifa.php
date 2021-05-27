<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
?>

<!-- inicio pagina -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Calendario de partidos -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>

                </div>
                <!-- llama al torneo -->
                <?php
                $sql= "SELECT * FROM `torneos` WHERE diciplina='FIFA' AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `torneos` WHERE diciplina = 'FIFA')";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)) {
                    $id_torn=$mostrar['id'];
                    $jornadas = $mostrar['jornadas'];
                    $y= $mostrar['num_equipos'];
                    if (($y%2)==0){
                        $partidos=($y/2);
                    }else{
                        $partidos=($y/2)-0.5;
                    }

                    $xsem=0;
                    ?>
                    <!-- Resultado de partidos  -->
                    <div class="card-body">
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
                        <!--SUBMENU calendario-->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="semana1" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <form action="imc/partidosFIFA.php" method="post">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>vistante</th>
                                        </tr>
                                        <!--imprime sino tiene valore-->
                                        <?php
                                        for ($partidoscont2=1; $partidoscont2<$partidos+1; $partidoscont2++){
                                            $sql2 = "select * from partidos_fifa where semana=1";
                                            $resultado2 = mysqli_query($conexion, $sql2);
                                            if($resultado2){
                                                $partidos1 = array();
                                                while($fila = mysqli_fetch_assoc($resultado2)){
                                                    $partidos1[] = $fila;
                                                }
                                                if (empty($partidos1)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <select id="aequiposfifa" name="local1-<?php echo $partidoscont2?>[]" class="form-control">
                                                                <option value="value1">Local</option>
                                                                <?php
                                                                require 'imc/equiposFifa.php';
                                                                ?>
                                                                >
                                                            </select>
                                                        </td>
                                                        <td><input type="number" id="agolesfifa" name="gollocal1-<?php echo $partidoscont2?>" value=""></td>
                                                        <td>vs</td>
                                                        <td><input type="number" id="agolesfifa" name="golvisita1-<?php echo $partidoscont2?>" value="">
                                                            <input type="number"style="width: 0px; border: none" value="1" name="oculto" readonly >
                                                        </td>
                                                        <td>
                                                            <select id="aequiposfifa" name="visita1-<?php echo $partidoscont2?>[]" class="form-control">
                                                                <option value="value1">Visita</option>
                                                                <?php
                                                                require 'imc/equiposFifa.php';
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }else{
                                                    $nombreEquipolocal = $partidos1[$partidoscont2-1]['localx'];
                                                    $nombreEquipovisita = $partidos1[$partidoscont2-1]['visitante'];
                                                    $gollocal = $partidos1[$partidoscont2-1]['goles_local'];
                                                    $golvisitas = $partidos1[$partidoscont2-1]['goles_visitante'];
                                                    ?>
                                                    <!-- imprime valores con resultados -->
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            echo $nombreEquipolocal;
                                                            ?>
                                                        </td>
                                                        <td><input type="number" id="agolesfifa" name="gollocal1-<?php echo $partidoscont2?>" value="<?php echo $gollocal?>"readonly></td>
                                                        <td>vs</td>
                                                        <td><input type="number" id="agolesfifa" name="golvisita1-<?php echo $partidoscont2?>" value="<?php echo $golvisitas?>"readonly>
                                                            <input type="number"style="width: 0px; border: none" value="1" name="oculto" readonly >
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $nombreEquipovisita;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }

                                        ?>
                                        <div class="modal-footer justify-content-center">
                                            <input type="hidden" name="idtor" value="<?php echo $id_torn?>">
                                            <input type="hidden" name="equipos" value="<?php echo $y?>">
                                            <button type="submit" class="btn btn-primary">guardar jornada</button>
                                        </div>
                                    </table>
                                </form>
                            </div>
                            <!-- imprime donde guardar resultados -->
                            <?php
                            for ($jornadascont2=2; $jornadascont2<$jornadas+1; $jornadascont2++){
                                ?>
                                <div class="tab-pane fade" id="semana<?php echo $jornadascont2; ?>" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                                    <form action="imc/partidosFIFA.php" method="post" >
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Local</th>
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>vistante</th>
                                            </tr>
                                            <!--imprime sino tiene valore-->
                                            <?php
                                            for ($partidoscont2=1; $partidoscont2<$partidos+1; $partidoscont2++){
                                                $sql2 = "select * from partidos_fifa where semana=$jornadascont2";
                                                $resultado2 = mysqli_query($conexion, $sql2);
                                                if($resultado2){
                                                    $partidos1 = array();
                                                    while($fila = mysqli_fetch_assoc($resultado2)){
                                                        $partidos1[] = $fila;
                                                    }
                                                    if (empty($partidos1)){
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <select id="aequiposfifa" name="local<?php echo $jornadascont2; ?>-<?php echo $partidoscont2; ?>[]" class="form-control">
                                                                    <option value="value1">Local</option>
                                                                    <?php
                                                                    require 'imc/equiposFifa.php';
                                                                    ?>

                                                                </select>
                                                            </td>
                                                            <td><input type="number" id="agolesfifa" name="gollocal<?php echo $jornadascont2; ?>-<?php echo $partidoscont2; ?>" value=""></td>
                                                            <td>vs</td>
                                                            <td>
                                                                <input type="number" id="agolesfifa" name="golvisita<?php echo $jornadascont2; ?>-<?php echo $partidoscont2; ?>" value="">
                                                                <input type="number"style="width: 0px; border: none" value="<?php echo $jornadascont2; ?>" name="oculto" readonly >
                                                            </td>
                                                            <td>
                                                                <select id="aequiposfifa" name="visita<?php echo $jornadascont2; ?>-<?php echo $partidoscont2; ?>[]" class="form-control">
                                                                    <option value="value1">Visita</option>
                                                                    <?php
                                                                    require 'imc/equiposFifa.php';
                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }else{
                                                        $nombreEquipolocal = $partidos1[$partidoscont2-1]['localx'];
                                                        $nombreEquipovisita = $partidos1[$partidoscont2-1]['visitante'];
                                                        $gollocal = $partidos1[$partidoscont2-1]['goles_visitante'];
                                                        $golvisitas = $partidos1[$partidoscont2-1]['goles_visitante'];
                                                        ?>
                                                        <!-- imprime valores con resultados -->
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                echo $nombreEquipolocal;
                                                                ?>
                                                            </td>
                                                            <td><input type="number" id="agolesfifa" name="gollocal<?php echo $jornadascont2; ?>-<?php echo $partidoscont2; ?>" value="<?php echo $gollocal; ?>"readonly></td>
                                                            <td>vs</td>
                                                            <td>
                                                                <input type="number" id="agolesfifa" name="golvisita<?php echo $jornadascont2; ?>-<?php echo $partidoscont2; ?>" value="<?php echo $golvisitas; ?>"readonly>
                                                                <input type="number"style="width: 0px; border: none" value="<?php echo $jornadascont2; ?>" name="oculto" readonly >
                                                            </td>
                                                            <td>
                                                                <?php
                                                                echo $nombreEquipovisita;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }

                                            ?>
                                            <div class="modal-footer justify-content-center">
                                                <input type="hidden" name="idtor" value="<?php echo $id_torn?>">
                                                <input type="hidden" name="equipos" value="<?php echo $y?>">
                                                <button type="submit" class="btn btn-primary">guardar jornada</button>
                                            </div>
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

        <!-- ver jugadores -->
        <div class="col-xl-12 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jugadores</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Equipo</th>
                            <th>ver jugadores</th>
                        </tr>
                        <?php
                        $sql= "SELECT equipos.id, equipos.nombre FROM equipos_participantes LEFT JOIN equipos 
                                        ON equipos.id = equipos_participantes.id_equipo LEFT JOIN torneos ON 
                                        equipos_participantes.id_torneo = torneos.id WHERE torneos.id = 10";
                        $result=mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <form action="jugadoresFifa.php" method="post">
                                    <td><?php echo $mostrar['nombre']?></td>
                                    <td>
                                        <input type="hidden" name="id_tor" value="<?php echo $mostrar['id']?>">
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
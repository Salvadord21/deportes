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
                    <h6 class="m-0 font-weight-bold text-primary">Agregar Resultado</h6>

                </div>
                <div class="card-body">
                    <form id="FIFA" method="post">
                        <table class="table table-hover">
                            <tr>
                                <th>Local</th>
                                <th></th>
                                <th>vs</th>
                                <th></th>
                                <th>Vistante</th>
                                <th>Jornada</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="local">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/EquiposFut2.php';
                                        ?>
                                    </select>
                                </td>
                                <td><input type="number" name="golLocal" id="golLocal"></td>
                                <td>vs</td>
                                <td><input type="number" name="golVisita" id="golVisita"></td>
                                <td><select name="visita" id="visita">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/EquiposFut2.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornada">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='ascenso'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>
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
                        var goll=$('#golLocal').val();
                        var golv=$('#golVisita').val();
                        var jornada=$('#jornada').val();
                        console.log(jornada);
                        console.log(goll,"golLocal")
                        console.log(equipol,"equipol")
                        console.log(golv,"golVisita");
                        console.log(equipov,"equipov");
                        $.ajax({
                            type: 'POST',
                            url: 'imc/partidosFIFA.php',
                            data: {golL:goll,golV:golv,local:equipol,visita:equipov,jornada:jornada},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.status == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Estas registrado',
                                        text: 'Se te enviará un correo para ver los detalles del torneo',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                } else if (data.status == "salida") {///////registrado
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
                </script>

            </div>
        </div>

        <!-- ver resltados -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>

                </div>
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
                                            <th></th>
                                            <th>vs</th>
                                            <th></th>
                                            <th>vistante</th>
                                        </tr>
                                        <!--imprime sino tiene valore-->

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
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>vistante</th>
                                            </tr>
                                            <!--imprime valores -->
                                            <tr>
                                                <th>Local</th>
                                                <th></th>
                                                <th>vs</th>
                                                <th></th>
                                                <th>vistante</th>
                                            </tr>
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
                    <h6 class="m-0 font-weight-bold text-primary">Equipos</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Equipo</th>
                            <th>ver jugadores</th>
                        </tr>
                        <?php
                        $sql= "SELECT `id`,`nombre_equipo` FROM `equipos` WHERE `id_torneo`=(SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=(SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='ascenso'))";
                        $result=mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <form action="jugadoresFifa.php" method="post">
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
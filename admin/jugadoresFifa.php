<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
$id=$_GET['id_equipo'];
?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">FIFA - Agregar goles</h6>

            </div>
            <div class="card-body">
                <form id="FIFA" method="post">
                    <table class="table table-hover">
                        <tr>
                            <th>Jugador</th>
                            <th>No. goles</th>
                            <th>Jornada</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <select name="jugador"  class="form-control" id="jugador">
                                    <option value="value1">Jugador</option>
                                    <?php
                                    $listado = "SELECT `integrantes`.`usuarios_id`, CONCAT(`usuarios`.`nombre`,' ', usuarios.apellido_paterno,' ',usuarios.apellido_materno) as nombre, `equipos`.`id` FROM `equipos` INNER JOIN `integrantes` ON `equipos`.`id` = `integrantes`.`equipos_id` INNER JOIN `usuarios` ON `integrantes`.`usuarios_id` = `usuarios`.`id`
                        WHERE equipos.id='$id';";

                                    $query = mysqli_query($conexion, $listado);

                                    while ($FIFAequi = mysqli_fetch_array($query)){
                                        echo '<option value ="'.$FIFAequi['usuarios_id'].'">'.$FIFAequi['nombre'].'</option>';
                                    }

                                    ?>
                                </select>
                            </td>
                            <td><input type="number"  class="form-control" name="gol" id="gol"></td>
                            <td>
                                <select name="jornada"  class="form-control" id="jornada">
                                    <?php
                                    $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='fifa'))";

                                    $query = mysqli_query($conexion, $listado);

                                    while ($FIFAequi = mysqli_fetch_array($query)){

                                        for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                            echo '<option value ="'.$x.'">'.$x.'</option>';
                                        }

                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="hidden" value="<?php echo $id?>" id="equipo">
                                <button type="button" onclick="guardar()" class="btn btn-primary">Guardar</button> </td>
                        </tr>
                    </table>
                </form>
            </div>

            <script>
                function guardar(){
                    var jugador=$('#jugador').val();
                    var jornada=$('#jornada').val();
                    var gol=$('#gol').val();
                    var equipo=$('#equipo').val();
                    $.ajax({
                        type: 'POST',
                        url: 'imc/goleadoresFIFA.php',
                        data: {gol:gol,jugador:jugador,jornada:jornada,equipo:equipo},
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            if (data.estatus == "ok") {///////registro exitoso
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Se guardó de manera correcta',
                                    text: '',
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                                actualizar();
                            } else if (data.estatus == "salida") {///////registrado
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ups',
                                    text: 'Ocurrió un error, intentelo nuevamente',
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                                actualizar();
                            }
                        }
                    });
                }

                function actualizar(){
                    $('#jugador').val('value1');
                    $('#gol').val('');
                    $("#result").load(" #result");
                }
            </script>

        </div>
    </div>

    <!-- jugadores -->
    <div class="col-xl-12 col-lg-7" id="result">
        <div class="card shadow mb-4" >
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
                                        <th>Jugador</th>
                                        <th>No. goles</th>
                                    </tr>

                                    <?php
                                    $sql= "SELECT * FROM `goleadoresfifa`  WHERE jornada='1' and equipo_id='$id'";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td><?php echo $mostrar['nombre'] ?></td>
                                            <td><?php echo $mostrar['goles'] ?></td>

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
                                            <th>Jugador</th>
                                            <th>No. goles</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `goleadoresfifa`  WHERE jornada='$jornadascont2' and equipo_id='$id'";
                                        $result=mysqli_query($conexion,$sql);
                                        while($mostrar=mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $mostrar['nombre'] ?></td>
                                                <td><?php echo $mostrar['goles'] ?></td>

                                            </tr>
                                        <?php  } ?>
                                    </table>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div >
            <?php } ?>
        </div>
    </div>
</div>
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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>



<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
$id=$_POST['id_equipo'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agregar Goles</h6>

            </div>
            <div class="card-body">
                <form id="FIFA" method="post">
                    <table class="table table-hover">
                        <tr>
                            <th>Jugador</th>
                            <th>Goles</th>
                            <th>Jornada</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <select name="jugador"  id="jugador">
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
                            <td><input type="number" name="gol" id="gol"></td>
                            <td>
                                <select name="jornada" id="jornada">
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
                            <td><input type="hidden" value="<?php echo $id?>" id="equipo"><button type="button" onclick="guardar()" > Guardar Resultado</button> </td>
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
                    console.log(jornada);
                    console.log(gol,"GOL")
                    console.log(jugador,"JUGADOR");
                    console.log(equipo)
                    $.ajax({
                        type: 'POST',
                        url: 'imc/goleadoresFIFA.php',
                        data: {gol:gol,jugador:jugador,jornada:jornada,equipo:equipo},
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

    <!-- jugadores -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">jugadores</h6>
        </div>
        <!--tablas-->
        <div class="card-body">
            <div class="table-responsive">
                <br>
                <div class="table-responsive">
                    <br>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>matricula</th>
                            <th>nombre del jugador</th>
                            <th>Equipo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql= "SELECT `integrantes`.`usuarios_id`, CONCAT(`usuarios`.`nombre`,' ', usuarios.apellido_paterno,' ',usuarios.apellido_materno) as nombre, `equipos`.`id` FROM `equipos` INNER JOIN `integrantes` ON `equipos`.`id` = `integrantes`.`equipos_id` INNER JOIN `usuarios` ON `integrantes`.`usuarios_id` = `usuarios`.`id`
                        WHERE equipos.id='$id';";
                        $result= mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)){

                            ?>
                            <tr>
                                <td><?php echo $mostrar['nombre'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary"><a href="fut.php" style="color: white">Cancelar</a></button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>



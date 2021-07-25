<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php'
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Equipos</h6>
                        </div>
                        <!--tablas-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Torneo</th>
                                        <th>No. jugadores</th>
                                        <th>Información</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql= "SELECT equipos.`id`,equipos.`integrantes`, equipos.`nombre_equipo`, creacion_torneo.nombre_torneo FROM `equipos` INNER JOIN creacion_torneo on creacion_torneo.id=equipos.id_torneo WHERE equipos.delete is null";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){

                                    ?>
                                    <tr>

                                        <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                        <td><?php echo $mostrar['nombre_torneo'] ?></td>
                                        <td><?php echo $mostrar['integrantes'] ?></td>
                                        <td>
                                            <form action="verJugadores.php" method="post">
                                            <input type="hidden" value="<?php echo $mostrar['id'] ?>" name="ver" size="0px">
                                            <button type="submit" class="btn btn-primary">Ver</button>
                                            </form>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
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
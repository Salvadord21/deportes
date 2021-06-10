<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php'
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!--FORMULARIO ver jugadores-->
                    <div class="modal fade" id="editarEquipo" tabindex="-1" role="dialog" aria-labelledby="crearEquipoTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="crearEquipoTitle">ver jugadores</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-10" for="email">Nombre de los jugadores</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email"  name="email" >
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- crear torneo -->

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
                                        <th>Nombre del Equipo</th>
                                        <th>Torneo</th>
                                        <th>No. jugadores</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql= "SELECT equipos.`integrantes`, equipos.`nombre_equipo`, creacion_torneo.nombre_torneo FROM `equipos` INNER JOIN creacion_torneo on creacion_torneo.id=equipos.id_torneo";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){

                                    ?>
                                    <tr>
                                        <form action="imc/EliEquipo.php" method="post">
                                        <td><?php echo $mostrar['nombre_equipo'] ?></td>
                                        <td><?php echo $mostrar['nombre_torneo'] ?></td>
                                        <td><?php echo $mostrar['integrantes'] ?></td>
                                        <td>
                                            <input type="hidden" value="<?php echo $mostrar['id'] ?>" name="eliminar" size="0px">
                                            <button type="submit" class="btn btn-primary">Eliminar equipo</button>
                                        </td>
                                        </form>
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
<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                        </div>
                        <!--tablas-->
                        <div class="card-body">
                            <form action="usuario_espe.php" method="get">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Matrícula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Información</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql= "select * from usuarios";
                                        $result=mysqli_query($conexion,$sql);
                                        while($mostrar=mysqli_fetch_array($result)){

                                        ?>
                                        <tr>
                                            <td><?php echo $mostrar['matricula'] ?></td>
                                            <td><?php echo $mostrar['nombre'] ?></td>
                                            <td><?php echo $mostrar['apellido_paterno'] ?> <?php echo $mostrar['apellido_materno'] ?></td>
                                            <td><button class="btn btn-primary" type="submit" name="revisar" value="<?php echo $mostrar['id'] ?>">Ver</button></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
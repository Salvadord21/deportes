<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php'
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <div class="row">

                        <!-- crear reto -->
                        <div class="col-xl-7 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Crear Reto</h6>

                                </div>
                                <!-- formulario reto -->
                                <div class="card-body">
                                    <form action="imc/reto.php" method="post">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nombre del reto</label>
                                            <input type="text" class="form-control" id="anreto"name="reton">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">URL del video</label>
                                            <input type="url" class="form-control" id="aurlreto" name="returl">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Fecha de inicio</label>
                                            <input type="date" class="form-control" id="afireto" name="retofi">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Fecha de Fin</label>
                                            <input type="date" class="form-control" id="affreto" name="retoff">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Descripcion</label>
                                            <textarea class="form-control" id="adreto" rows="3" name="retod"></textarea>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="submit" class="btn btn-primary">crear reto</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- tabla de retos -->
                        <div class="col-xl-5 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Retos</h6>
                                    </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <tr>
                                            <td>nombre</td>
                                            <td>fecha inicio</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $sql= "select id, nombre_reto, descripcion, fecha_inicio from creacion_reto";
                                        $result=mysqli_query($conexion,$sql);
                                        while($mostrar=mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $mostrar['nombre_reto'] ?></td>
                                                <td><?php echo $mostrar['fecha_inicio'] ?></td>
                                                <td>
                                                    <form action="editar_reto.php" method="post">
                                                        <input type="hidden" value="<?php echo $mostrar['id'] ?>" name="editar">
                                                        <button type="submit" class="btn btn-primary">editar</button>
                                                    </form>
                                                </td>
                                                <form action="imc/eliminar_reto.php" method="post">
                                                    <input type="hidden" value="<?php echo $mostrar['id'] ?>"name="eliminar">
                                                    <td><button type="submit"  class="btn btn-primary">eliminar</button></td>
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

</body>

</html>
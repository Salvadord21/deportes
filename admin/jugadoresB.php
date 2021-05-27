<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
$id=$_POST['id_tor'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- jugadores -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">jugadores</h6>
        </div>
        <!--tablas-->
        <div class="card-body">
            <div class="table-responsive">
                <br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>matricula</th>
                        <th>nombre del jugador</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql= "SELECT usuarios.nombre, usuarios.apellidos, usuarios.matricula FROM `integrantes` 
                    LEFT JOIN `usuarios` ON usuarios.id = integrantes.id_usuario LEFT JOIN `equipos` ON 
                    equipos.id = integrantes.id_equipo WHERE integrantes.id_equipo = $id";
                    $result= mysqli_query($conexion,$sql);
                    while($mostrar=mysqli_fetch_array($result)){

                        ?>
                        <tr>
                            <td><?php echo $mostrar['matricula'] ?></td>
                            <td><?php echo $mostrar['nombre'] ?> <?php echo $mostrar['apellidos'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary"><a href="basket.php" style="color: white">Cancelar</a></button>
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



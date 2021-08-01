<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
$id=$_POST['id_equipo'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- jugadores -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Basquetbol - Jugadores</h6>
        </div>
        <!--tablas-->
        <div class="card-body">
            <div class="table-responsive">
                <br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre del jugador</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql= "SELECT  usuarios.matricula,CONCAT(`usuarios`.`nombre`,' ', usuarios.apellido_paterno,' ',usuarios.apellido_materno) as nombre, `equipos`.`id` FROM `equipos` INNER JOIN `integrantes` ON `equipos`.`id` = `integrantes`.`equipos_id` INNER JOIN `usuarios` ON `integrantes`.`usuarios_id` = `usuarios`.`id`
                        WHERE equipos.id='$id';";
                    $result= mysqli_query($conexion,$sql);
                    while($mostrar=mysqli_fetch_array($result)){

                        ?>
                        <tr>
                            <td><?php echo $mostrar['matricula'] ?></td>
                            <td><?php echo $mostrar['nombre'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary"><a href="basket.php" style="color: white">Regresar</a></button>
                </div>
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



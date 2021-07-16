<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';

$id_usua = 0;

if( !empty($_POST['editar']) ){
    $id_usua = $_POST['editar'];

    $sql ="select * from creacion_reto where id = $id_usua ";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        $encontrados = mysqli_num_rows($resultado);
        if($encontrados == 1){
            $fila = mysqli_fetch_assoc($resultado);
            $nombre_reto = $fila['nombre_reto'];
            $descripcion = $fila['descripcion'];
            $url = $fila['url'];
            $fecha_crea = $fila['fecha_inicio'];
            $fecha_lim = $fila['fecha_fin'];
        }
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="row">

        <!-- crear reto -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Editar reto</h6>

                </div>
                <!-- formulario reto -->
                <div class="card-body">
                    <form action="imc/editarreto.php" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre del reto</label>
                            <input type="text" class="form-control" id="anreto" name="reton1" value="<?php echo $nombre_reto ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">URL del vídeo demostrativo</label>
                            <input type="text" class="form-control" id="aurlreto" name="returl1" value="<?php echo $url ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Fecha de inicio</label>
                            <input type="date" class="form-control" id="afireto" name="retofi1" value="<?php echo $fecha_crea ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Fecha de Fin</label>
                            <input type="date" class="form-control" id="affreto" name="retoff1" value="<?php echo $fecha_lim ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripción</label>
                            <textarea class="form-control" id="adreto" rows="3" name="retod1"> <?php echo $descripcion ?></textarea>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="hidden" value="<?php echo $id_usua ?>" name="actualizar">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="submit" class="btn btn-primary"><a href="index.php" style="color: white">Cancelar</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <?php
    include 'imc/footer.php';
    ?>
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

<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';

$id_usua = 0;

if( !empty($_POST['editar']) ){
    $id_usua = $_POST['editar'];

    $sql ="select * from creacion_torneo where id = $id_usua ";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        $encontrados = mysqli_num_rows($resultado);
        if($encontrados == 1){
            $fila = mysqli_fetch_assoc($resultado);
            $nombre = $fila['nombre_torneo'];
            $areas = $fila['disciplina'];
            $jornadas = $fila['jornadas'];
            $fech_ini = $fila['fecha_inicio'];
            $fecha_lim = $fila['fecha_limite'];
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Editar torneo</h6>
                </div>
                <!-- formulario reto -->
                <div class="card-body">
                    <form action="imc/editartorneo.php" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Nombre del torneo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email"  name="nomtor" value="<?php echo $nombre?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Disciplina:</label>
                            <div class="col-sm-10">
                                <select name="diciplinas[]" class="form-control" id="disciplinas">
                                    <option value="Futbol Bardas" <?php echo $areas == 'Futbol Bardas' ? 'selected="selected"'  : '' ?>>Fútbol bardas</option>
                                    <option value="ascenso" <?php echo $areas == 'ascenso' ? 'selected="selected"'  : '' ?>>Fútbol bardas ascenso</option>
                                    <option value="FIFA" <?php echo $areas == 'FIFA' ? 'selected="selected"'  : '' ?>>FIFA</option>
                                    <option value="Voleibol" <?php echo $areas == 'Voleibol' ? 'selected="selected"'  : '' ?>>Voleibol</option>
                                    <option value="Basquetbol" <?php echo $areas == 'Basquetbol' ? 'selected="selected"'  : '' ?>>Basquetbol</option>
                                    <option value="Otro" <?php echo $areas == 'Otro' ? 'selected="selected"'  : '' ?>>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Número de jornadas:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nojornadas" name="nojorna" value="<?php echo $jornadas?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Fecha de inicio:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="afi"  name="feini" value="<?php echo $fech_ini?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Fecha límite de inscripción:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="aflim"  name="felim" value="<?php echo $fecha_lim?>" required>
                            </div>
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
    <?
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
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>


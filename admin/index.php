<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php'
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- crear reto -->
        <div class="col-xl-7 col-lg-7" >
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Crear retos</h6>
                </div>
                <!-- formulario reto -->
                <div class="card-body" id="result">
                    <form id="crearReto" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre del reto</label>
                            <input type="text" class="form-control" id="anreto"name="reton" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">URL del vídeo</label>
                            <input type="url" class="form-control" id="aurlreto" name="returl">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Fecha de inicio</label>
                            <input type="date" class="form-control" id="afireto" name="retofi" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Fecha de fin</label>
                            <input type="date" class="form-control" id="affreto" name="retoff" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripción</label>
                            <textarea class="form-control" id="adreto" rows="3" name="retod" required></textarea>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Crear reto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- tabla de retos -->
        <div class="col-xl-5 col-lg-5" >
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Retos</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="result2">
                    <table class="table table-hover">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha inicio</th>
                            <td></td>
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
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                    </form>
                                </td>
                                <form action="imc/eliminar_reto.php" method="post">
                                    <input type="hidden" value="<?php echo $mostrar['id'] ?>"name="eliminar">
                                    <td><button type="submit"  class="btn btn-primary">Eliminar</button></td>
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
    <script>
        $("#crearReto").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'imc/reto.php',
                data: $('#crearReto').serialize(),
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if (data.estatus == "ok") {///////registro exitoso
                        Swal.fire({
                            icon: 'success',
                            title: 'Se creo de manera correcta',
                            text: '',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        actualizar();
                    } else if (data.estatus == "error") {///////registrado
                        Swal.fire({
                            icon: 'info',
                            title: 'Ups',
                            text: 'Hubo un error al guardar',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        $( "#result" ).load( "index.php #result" );
                    }
                }
            });
        });
        function actualizar(){
            $( "#result2" ).load( " #result2" );
            $( "#result" ).load( "index.php #result" );
        }
    </script>
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
<script src="vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>


</body>
</html>
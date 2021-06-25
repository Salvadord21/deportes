<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Retos</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#futbol-general" role="tab" aria-controls="futbol-general" aria-selected="true">Pendientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#futbol-jugadores" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Revisados</a>
                </li>
            </ul>
            <!--SUBMENU calendario-->
            <div class="tab-content" id="tab-futbol-contenido">
                <div class="tab-pane fade show active" id="futbol-general" role="tabpanel" aria-labelledby="tab-futbol-general">
                    <br>
                    <form action="imc/calificar_reto.php" method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Reto</th>
                                    <th>URL</th>
                                    <th>calificacion</th>
                                    <th>nota</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql= "SELECT retos_subidos.id,CONCAT(usuarios.nombre,' ', usuarios.apellido_paterno,' ', usuarios.apellido_materno)as nombre,
                                creacion_reto.nombre_reto, retos_subidos.url, retos_subidos.estado, 
                                retos_subidos.calificacion FROM retos_subidos INNER JOIN usuarios
                                on usuarios.id=retos_subidos.usuarios_id INNER JOIN creacion_reto
                                on retos_subidos.creacion_reto_id= creacion_reto.id WHERE retos_subidos.estado=0";

                                $result= mysqli_query($conexion,$sql);
                                while($mostrar=mysqli_fetch_array($result)){
                                    $areas = $mostrar['calificacion'];
                                    $areas2 = $mostrar['estado'];
                                    ?>
                                    <tr>
                                        <form action="imc/calificar_reto.php" method="post">
                                            <td><?php echo $mostrar['nombre'] ?></td>
                                            <td><?php echo $mostrar['nombre_reto'] ?></td>
                                            <td><a href="<?php echo $mostrar['url'] ?>">link</a></td>
                                            <td><select name="diciplinas2[]" class="form-control" id="disciplinas">
                                                    <option value="0"<?php echo $areas == '0' ? 'selected="selected"'  : '' ?>>Calificacion</option>
                                                    <option value="1"<?php echo $areas == '1' ? 'selected="selected"'  : '' ?>>Regular</option>
                                                    <option value="2"<?php echo $areas == '2' ? 'selected="selected"'  : '' ?>>Bien</option>
                                                    <option value="3"<?php echo $areas == '3' ? 'selected="selected"'  : '' ?>>Excelente</option>
                                                    <option value="4"<?php echo $areas == '4' ? 'selected="selected"'  : '' ?>>Rechazado</option>
                                                </select></td>
                                            <td><input type="text" id="notaret"  name="notas"></td>
                                            <td>
                                                <input type="hidden" value="<?php echo $mostrar['id'] ?>" name="actualizar">
                                                <button type="submit" class="btn btn-primary">Calificar</button>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show" id="futbol-jugadores" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                    <br>
                    <form action="imc/calificar_reto.php" method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Reto</th>
                                    <th>URL</th>
                                    <th>calificacion</th>
                                    <th>nota</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql= "SELECT retos_subidos.id, CONCAT(usuarios.nombre,' ',usuarios.apellido_paterno,' ', usuarios.apellido_materno) as nombre, creacion_reto.nombre_reto, retos_subidos.url, retos_subidos.estado,retos_subidos.calificacion, retos_subidos.nota FROM retos_subidos INNER JOIN usuarios on usuarios.id= retos_subidos.usuarios_id INNER JOIN creacion_reto on creacion_reto.id= retos_subidos.creacion_reto_id WHERE estado=1";

                                $result= mysqli_query($conexion,$sql);
                                while($mostrar=mysqli_fetch_array($result)){
                                    $areas = $mostrar['calificacion'];
                                    $areas2 = $mostrar['estado'];
                                    $x=$mostrar['calificacion'];
                                    ?>
                                    <tr>
                                        <form action="imc/calificar_reto.php" method="post">
                                            <td><?php echo $mostrar['nombre'] ?></td>
                                            <td><?php echo $mostrar['nombre_reto'] ?></td>
                                            <td><a href="<?php echo $mostrar['url'] ?>"  target="_blank">link</a></td>
                                            <td ><?php
                                                if ($x=='1'){
                                                    echo '<p>Regular</p>';
                                                }elseif ($x=='2'){
                                                    echo '<p>Bien</p> ';
                                                }elseif ($x=='3'){
                                                    echo '<p>Excelente</p>';
                                                }
                                                ?></td>
                                            <td><?php echo $mostrar['nota'] ?></td>
                                        </form>
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



<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>





</body>

</html>
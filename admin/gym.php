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
            <h6 class="m-0 font-weight-bold text-primary">Area de Pesas</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#futbol-general" role="tab" aria-controls="futbol-general" aria-selected="true">Acesso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#futbol-jugadores" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Solicitudes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-futbol-jugadores2" data-toggle="tab" href="#futbol-jugadores2" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Usuarios</a>
                </li>
            </ul>
            <!--SUBMENU gym-->
            <div class="tab-content" id="tab-futbol-contenido">
                <!--entrada del dia hoy gym -->
                <div class="tab-pane fade show active" id="futbol-general" role="tabpanel" aria-labelledby="tab-futbol-general">
                    <br>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>entrada</th>
                            <th>salida</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql= "SELECT usuarios.matricula, CONCAT(usuarios.nombre,' ',usuarios.apellido_paterno,' ', usuarios.apellido_materno) 
                        as nombre, registro_gym.entrada, registro_gym.salida FROM registro_gym INNER JOIN
                         usuarios on usuarios.id = registro_gym.usuarios_id WHERE registro_gym.creacion=curdate()";

                        $result= mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $mostrar['matricula'] ?></td>
                                <td><?php echo $mostrar['nombre'] ?></td>
                                <td><?php echo $mostrar['entrada'] ?></td>
                                <td><?php echo $mostrar['salida'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <!--solicitudes de entrada de gym -->
                <div class="tab-pane fade" id="futbol-jugadores" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                    <br>

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Matrícula</th>
                                <th>Nombre</th>
                                <th>solicitud</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql= "SELECT id, matricula, nombre, apellido_paterno, apellido_materno from usuarios where  status_gym=2";

                            $result= mysqli_query($conexion,$sql);
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <form action="imc/gym_aceptat.php" method="post">
                                        <td><?php echo $mostrar['matricula'] ?> </td>
                                        <td><?php echo $mostrar['nombre'] ?> <?php echo $mostrar['apellido_paterno'] ?> <?php echo $mostrar['apellido_materno'] ?></td>
                                        <td><input type="hidden" name="ids" value="<?php echo $mostrar['id'] ?>">
                                            <button type="submit" class="btn btn-primary">Aceptar</button</td>
                                    </form>
                                </tr>

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                </div>
                <!--usuarios con acceso de gym -->
                <div class="tab-pane fade" id="futbol-jugadores2" role="tabpanel" aria-labelledby="tab-futbol-jugadores2">
                    <form action="imc/borra_usuarios_gym.php">
                        <input type="hidden" value="1" name="borra">
                        <button type="submit" class="btn btn-primary">borrar ususarios</button>
                    </form>
                    <br>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Matrícula</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql= "SELECT id, matricula, nombre, apellido_paterno,apellido_materno from usuarios where  status_gym=1";

                            $result= mysqli_query($conexion,$sql);
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <form action="imc/gym_user_eliminar.php" method="post">
                                        <td><?php echo $mostrar['matricula'] ?> </td>
                                        <td><?php echo $mostrar['nombre'] ?> <?php echo $mostrar['apellido_paterno'] ?> <?php echo $mostrar['apellido_materno'] ?></td>
                                        <td>
                                            <input type="hidden" value="<?php echo $mostrar['id'] ?>" name="ids">
                                            <button type="submit" class="btn btn-primary">Eliminar</button>
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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
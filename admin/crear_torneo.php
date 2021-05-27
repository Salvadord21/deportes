<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!--FORMULARIO torneo-->
    <div class="modal fade" id="crearEquipo" tabindex="-1" role="dialog" aria-labelledby="crearEquipoTitle" aria-hidden="true">
        <!-- crear torneo -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearEquipoTitle">Crear torneo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="imc/crear_torneo.php" method="post" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Nombre del torneo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email"  name="nomtor" required >
                            </div>
                            <div class="invalid-feedback">Complete el campo</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">disciplina:</label>
                            <div class="col-sm-10">
                                <select name="diciplinas[]" class="form-control" id="disciplinas">
                                    <option value="Futbol bardas">futbol bardas</option>
                                    <option value="FIFA">fifa</option>
                                    <option value="Voleibol">voleibol</option>
                                    <option value="Basquetbol">basquetbol</option>
                                    <option value="Otro">otro</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Complete el campo</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Numero de jornadas:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nojornadas" name="nojorna" >
                            </div>
                            <div class="invalid-feedback">Complete el campo</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Fecha de inicio:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="afi"  name="feini" required>
                            </div>
                            <div class="invalid-feedback">Complete el campo</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-10" for="email">Fecha limite de inscripcion:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="aflim"  name="felim" required>
                            </div>
                            <div class="invalid-feedback">Complete el campo</div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-outline-primary">Crear</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- solicitudes del torneo -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Torneos</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#futbol-general" role="tab" aria-controls="futbol-general" aria-selected="true">Torneos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#futbol-jugadores" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Solicitudes de Torneos</a>
                </li>
            </ul>
            <!--SUBMENU torneo-->
            <div class="tab-content" id="tab-futbol-contenido">
                <!--torneos Nuevo-->
                <div class="tab-pane fade show active" id="futbol-general" role="tabpanel" aria-labelledby="tab-futbol-general">
                    <br>
                    <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#crearEquipo">Crear Torneo</button>
                    <br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nombre del torneo</th>
                                <th>Disciplina</th>
                                <th>Numero de equipos</th>
                                <th>Fecha inicio de torneo</th>
                                <th>Fecha limite inscripcion</th>
                                <th>Numero de jornadas</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql= "select id, nombre_torneo, disciplina, numero_equipos,fecha_inicio,fecha_limite, jornadas from creacion_torneo";
                            $result= mysqli_query($conexion,$sql);
                            while($mostrar=mysqli_fetch_array($result)){

                                ?>
                                <tr>
                                    <td><?php echo $mostrar['nombre_torneo'] ?></td>
                                    <td><?php echo $mostrar['disciplina'] ?></td>
                                    <td><?php echo $mostrar['numero_equipos'] ?></td>
                                    <td><?php echo $mostrar['fecha_inicio'] ?></td>
                                    <td><?php echo $mostrar['fecha_limite'] ?></td>
                                    <td><?php echo $mostrar['jornadas'] ?></td>
                                    <form action="editorn.php" method="post">
                                        <input type="hidden" value="<?php echo $mostrar['id'] ?>"name="editar">
                                        <td><button type="submit"  class="btn btn-primary">editar</button></td>
                                    </form>
                                    <form action="imc/eliminar_toreno.php" method="post">
                                        <input type="hidden" value="<?php echo $mostrar['id'] ?>"name="eliminar">
                                        <td><button type="submit"  class="btn btn-primary">eliminar</button></td>
                                    </form>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--torneos solicitudes-->
                <div class="tab-pane fade" id="futbol-jugadores" role="tabpanel" aria-labelledby="tab-futbol-jugadores">
                    <br>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nombre del torneo</th>
                            <th>Descripcion del torneo</th>
                            <th>nombre </th>
                            <th>Eliminar solicitud</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql= "select solicitud_torneo.id, solicitud_torneo.nombre_torneo, solicitud_torneo.descripcion, solicitud_torneo.fecha, 
                                CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno,' ', usuarios.apellido_materno) as nombre 
                                from solicitud_torneo INNER JOIN usuarios on usuarios.id =solicitud_torneo.usuarios_id";

                        $result= mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)){

                            ?>
                            <tr>
                                <form action="imc/EliSoliTor.php" method="post">
                                    <td><?php echo $mostrar['nombre_torneo'] ?></td>
                                    <td><?php echo $mostrar['descripcion'] ?></td>
                                    <td><?php echo $mostrar['nombre'] ?></td>
                                    <td>
                                        <input type="hidden" value="<?php echo $mostrar['id'] ?>" name="eliminar">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
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


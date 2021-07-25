<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';
$id_usua = 0;

    $id_usua = $_GET['revisar'];



    $sql ="select nombre, apellido_paterno, apellido_materno, correo, matricula,area, telefono, administrador from usuarios where id = $id_usua ";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        $encontrados = mysqli_num_rows($resultado);

        if($encontrados == 1){

            $fila = mysqli_fetch_assoc($resultado);
            $admin = $fila['administrador'];
            $nombre = $fila['nombre'];
            $apellidopat = $fila['apellido_paterno'];
            $apellidomat = $fila['apellido_materno'];
            $matricula = $fila['matricula'];
            $cel = $fila['telefono'];
            $are = $fila['area'];
            $correo = $fila['correo'];
            $archivo = $matricula  . '.jpg';
            $dirsubida="../php/imagenes/$archivo";

        }
    
}

if ($admin==0){
    $usua='Usuario';
}elseif ($admin==1){
    $usua='Administrador';
}elseif ($admin==2){
    $usua='Revisor';
}



?>

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <div class="row">
                        <?php
                        if(!file_exists($dirsubida)){
                            ?>
                            <div class="col-md-4">
                                <img src="../imgs/usuarios.png" class="rounded-circle" alt="Cinque Terre" width="250px">
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="col-md-4">
                                <img src="../php/imagenes/<?php echo $archivo ?>" class="rounded-circle" alt="Cinque Terre" width="250px">
                            </div>
                            <?php
                        }
                        ?>
                        <!-- crear reto -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Información</h6>

                                </div>
                                <!-- formulario reto -->
                                <div class="card-body" id="result">


                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Estado:</label>
                                            <div class="col-sm-10">
                                                <form class="form-horizontal" id="adminAct" method="post">
                                                <select name="admin[]" id="optadmin" class="form-control">
                                                    <option value="Usuario" <?php echo $usua == 'Usuario' ? 'selected="selected"'  : '' ?>>Usuario</option>
                                                    <option value="Administrador" <?php echo $usua == 'Administrador' ? 'selected="selected"'  : '' ?>>Administrador</option>
                                                    <option value="Revisor" <?php echo $usua == 'Revisor' ? 'selected="selected"'  : '' ?>>Revisor</option>
                                                </select>
                                                <input type="hidden" value="<?php echo $id_usua ?>" name="idadmin"><br>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"><strong>Nombre:</strong></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext" id="anombre" value="<?php echo $nombre ?> <?php echo $apellidopat ?> <?php echo $apellidomat ?>" name="email" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"><strong>Matrícula:</strong></label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control-plaintext" id="amatricula" value="<?php echo $matricula ?>" name="email" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"><strong>Área:</strong></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control-plaintext" id="acarrera" value="<?php echo $are ?>" name="email" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"><strong>Correo:</strong></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control-plaintext" id="aemail" value="<?php echo $correo ?>" name="email" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"><strong>Teléfono:</strong></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control-plaintext" id="acel" value="<?php echo $cel ?>" name="email" readonly>
                                            </div>
                                        </div>


                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne1">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        IMC
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <thead>
                                                            <tr>
                                                                <th>Estatura</th>
                                                                <th>Peso</th>
                                                                <th>IMC</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $sql= "select usuarios_id, estatura, peso, fecha_creacion from imc where usuarios_id= '$id_usua'";
                                                            $result=mysqli_query($conexion,$sql);
                                                            while($mostrar=mysqli_fetch_array($result)){

                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $mostrar['estatura'] ?></td>
                                                                    <td><?php echo $mostrar['peso'] ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $x=10000*($mostrar['peso']/($mostrar['estatura']*$mostrar['estatura']));
                                                                        echo round($x, 2);
                                                                        if($x<=17){
                                                                            echo " Infrapeso";
                                                                        }
                                                                        elseif(($x>17)and($x<=18)){
                                                                            echo " Bajo peso";
                                                                        }
                                                                        elseif(($x>18)and($x<=25)){
                                                                            echo " Normal";
                                                                        }
                                                                        elseif(($x>25)and($x<=30)){
                                                                            echo " Sobrepeso de grado I";
                                                                        }
                                                                        elseif(($x>30)and($x<=35)){
                                                                            echo " Sobrepeso de grado II";
                                                                        }
                                                                        elseif(($x>35)and($x<=40)){
                                                                            echo " Sobrepeso de grado III";
                                                                        }
                                                                        elseif($x>40){
                                                                            echo " Obesidad de grado IV";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $mostrar['fecha_creacion'] ?></td>
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
                                        <div class="card">
                                            <div class="card-header" id="headingTwo2">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo">
                                                        Retos
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <thead>
                                                            <tr>
                                                                <th>Reto</th>
                                                                <th>Descripción</th>
                                                                <th>Calificación</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $sql= "SELECT creacion_reto.nombre_reto, retos_subidos.nota, retos_subidos.calificacion, retos_subidos.fecha_subida FROM retos_subidos INNER JOIN creacion_reto on retos_subidos.creacion_reto_id= creacion_reto.id INNER JOIN usuarios on retos_subidos.usuarios_id=usuarios.id WHERE usuarios.id='$id_usua'";
                                                            $result=mysqli_query($conexion,$sql);
                                                            while($mostrar=mysqli_fetch_array($result)){
                                                                $x=$mostrar['calificacion'];
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $mostrar['nombre_reto'] ?></td>
                                                                    <td><?php echo $mostrar['nota'] ?></td>
                                                                    <td><?php
                                                                        if ($x=='1'){
                                                                            echo '<img src="../imgs/christmas-star_112199.png" alt="" width="30px">';
                                                                        }elseif ($x=='2'){
                                                                            echo '<img src="../imgs/christmas-star_112199.png" alt="" width="30px"> <img src="../imgs/christmas-star_112199.png" alt="" width="30px"> ';
                                                                        }elseif ($x=='3'){
                                                                            echo '<img src="../imgs/christmas-star_112199.png" alt="" width="30px"> <img src="../imgs/christmas-star_112199.png" alt="" width="30px"> <img src="../imgs/christmas-star_112199.png" alt="" width="30px">';
                                                                        }elseif ($x=='4'){
                                                                            echo 'tu reto fue rechazado';
                                                                        }
                                                                        ?></td>
                                                                    <td><?php echo $mostrar['fecha_subida'] ?></td>
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
                            </div>
                        </div>
                        <script>
                            $("#adminAct").on('submit', function (e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'POST',
                                    url: 'imc/admin.php',
                                    data: $('#adminAct').serialize(),
                                    cache: false,
                                    dataType: 'json',
                                    success: function (data) {
                                        if (data.estatus == "ok") {///////registro exitoso
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'IMC Generado',
                                                text: '',
                                                timer: 2000,
                                                showConfirmButton: false,
                                            });
                                            actualizar();
                                        } else if (data.estatus == "error") {///////registrado
                                            Swal.fire({
                                                icon: 'info',
                                                title: 'Error',
                                                text: 'Datos invalidos',
                                                timer: 2000,
                                                showConfirmButton: false,
                                            });
                                            actualizar();
                                        }
                                    }
                                });
                            });
                            function actualizar(){
                                $( "#result" ).load( " #result" );
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
<?php
session_start();
require 'php/conexion.php';

$matric = $_SESSION['matricula'];
$archivo = $matric  . '.jpg';
$dirsubida="php/imagenes/$archivo";
$idprueba=$_SESSION['id_usuario'];;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://www.w3.org/TR/wai-aria-practices/examples/disclosure/js/disclosureButton.js"></script>


</head>
<body>
<div class="top_section">
    <div class="top_inner">
        <?php
        if(!empty($_SESSION['matricula']) && $_SESSION['administrador'] == 0) {
            include 'php/navbar-iniciado.php';
        }elseif(!empty($_SESSION['matricula']) && $_SESSION['administrador'] == 1){
            include 'php/nav-iniciado-admin.php';
        }elseif(!empty($_SESSION['matricula']) && $_SESSION['administrador'] == 2){
            include 'php/nav-inciado-revisor.php';
        }
        else{

            require 'php/navbar.php';
        }
        ?>
    </div>
</div>


<div id="classes" class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text_align_center">
                <h2 style="margin-bottom: 65px;">PERFIL</h2>
            </div>
            <?php
            if(!file_exists($dirsubida)){
                ?>
                <div class="col-md-4">
                    <img src="imgs/usuarios.png" class="rounded-circle" alt="Cinque Terre" width="250px">
                </div>
                <?php
            }else{
                ?>
                <div class="col-md-4">
                    <img src="php/imagenes/<?php echo $archivo ?>" class="rounded-circle" alt="Cinque Terre" width="250px">
                </div>
                <?php
            }
            ?>

            <div class="col-md-8">
                <form class="form-horizontal" action="php/editar-perfil.php" method="post" enctype="multipart/form-data">

                    <?php
                    $sql ="select nombre, apellido_paterno, apellido_materno, correo, matricula,area, telefono from usuarios where matricula = '$_SESSION[matricula]' ";
                    $resultado = mysqli_query($conexion, $sql);

                    if($resultado){
                        $encontrados = mysqli_num_rows($resultado);

                        if($encontrados == 1){

                            $fila = mysqli_fetch_assoc($resultado);

                            $nombre = $fila['nombre'];
                            $apellidopat = $fila['apellido_paterno'];
                            $apellidomat = $fila['apellido_materno'];
                            $matricula = $fila['matricula'];
                            $telefono = $fila['telefono'];
                            $area = $fila['area'];
                            $correo = $fila['correo'];

                        }
                    }
                    ?>

                    <!--MUESTRA NOMBRE-->
                    <div class="form-group row">

                        <label class="col-sm-4 col-form-label" for="nombre-perfil-usuario">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control-plaintext" id="nombre-perfil-usuario" value="<?php echo $nombre ?> <?php echo $apellidopat ?> <?php echo $apellidomat ?>" name="nombre-perfil" readonly>
                        </div>
                    </div>

                    <!--MUESTRA MATRICULA-->
                    <div class="form-group row">

                        <label class="col-sm-4 col-form-label" for="matricula-perfil-usuario">Matrícula</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control-plaintext" id="matricula-perfil-usuario" value="<?php echo $matricula ?>" name="matricula-perfil" readonly>
                        </div>
                    </div>

                    <!--MUESTRA AREA-->
                    <div class="form-group row">

                        <label class="col-sm-4 col-form-label" for="carrera-perfil-usuario">Área</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control-plaintext" id="carrera-perfil-usuario" value="<?php echo $area ?>" name="carrera-perfil" readonly>
                        </div>
                    </div>

                    <!--MUESTRA CORREO-->
                    <div class="form-group row">

                        <label class="col-sm-4 col-form-label" for="email-perfil-usuario">Correo</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control-plaintext" id="email-perfil-usuario" value="<?php echo $correo ?>" name="email-perfil" readonly>
                        </div>
                    </div>

                    <!--MUESTRA TELEFONO-->
                    <div class="form-group row">

                        <label class="col-sm-4 col-form-label" for="telefono-perfil-usuario">Teléfono</label>
                        <div class="col-sm-8">
                            <input type="text" minlength="10" maxlength="10" class="form-control col-sm-4" id="telefono-perfil-usuario" value="<?php echo $telefono ?>" name="telefono-perfil-usuario" disabled>
                        </div>
                    </div>
                    <!--MUESTRA imagen-->
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="telefono-perfil-usuario">Cambiar foto de perfil</label>
                        <div class="col-sm-8">
                            <input type="file" id="foto_perfil" value="" disabled name="fotografia" >
                        </div>
                    </div>

                    <!--BOTONES DE EDITAR  Y GUARDAR, IMG-->
                    <div class="row">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col">
                            <button class="btn btn-outline-success" onclick="javascript:window.open('perfil_usuario.php','_self')" id="btnGuardar" type="submit" style="visibility: hidden">Guardar</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-danger" onclick="javascript:window.open('perfil_usuario.php','_self')" id="btnCancelar" type="button" style="visibility: hidden">Cancelar</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-primary" onclick="editnum()" type="button">Editar</button>
                        </div>

                    </div>
                </form>

                <!--HABILITA LA EDICION DEL TELEFONO E IMAGEN-->
                <script>
                    function editnum(){
                        document.getElementById("foto_perfil").disabled = "";
                        document.getElementById("telefono-perfil-usuario").disabled = "";
                        document.getElementById("btnGuardar").style.visibility="visible";
                        document.getElementById("btnCancelar").style.visibility="visible";
                    }
                </script>
                <br>

                <div id="accordion">

                    <!--IMC-->
                    <div class="card">
                        <div class="card-header" id="heading-imc">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#imc-registros" aria-expanded="false" aria-controls="imc-registros">
                                    IMC
                                </button>
                            </h5>
                        </div>

                        <div id="imc-registros" class="collapse show" aria-labelledby="heading-imc" data-parent="#accordion">
                            <div class="card-body">
                                <p>¿Quieres saber tu IMC?</p>
                                <p>¡Da clic en 'Calcula tu IMC' e ingresa tus datos!</p>
                                <img src="imgs/IMC%20feo.jpg" class="img-thumbnail"><br><br>

                                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#datos-calculo-imc" aria-expanded="false" aria-controls="datos-calculo-imc">
                                    Calcula tu IMC
                                </button>
                                </p>
                                <div class="collapse" id="datos-calculo-imc">
                                    <div class="card card-body">
                                        <form id="imc" method="post">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="peso-imc">Peso (KG)</label>
                                                    <input type="text" name="peso" id="peso-imc" class="form-control">
                                                </div>

                                                <div class="col">
                                                    <label for="altura-imc">Altura (cm)</label>
                                                    <input type="text" name="altura" id="altura-imc" class="form-control">
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col"></div>
                                                <div class="col"></div>
                                                <div class="col">
                                                    <button class="btn btn-secondary" type="submit" data-toggle="collapse" data-target="#calculo-imc" aria-expanded="false" aria-controls="calculo-imc">
                                                        Calcular
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <table class="table table-sm">
                                    <thead>

                                    <tr>
                                        <th scope="col">Peso</th>
                                        <th scope="col">Altura</th>
                                        <th scope="col">IMC</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sql= "select  estatura, peso, fecha_creacion from imc where usuarios_id= '$_SESSION[id_usuario]'";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){

                                        ?>
                                        <tr>
                                            <td><?php echo $mostrar['peso'] ?></td>
                                            <td><?php echo $mostrar['estatura'] ?></td>
                                            <td><?php $x=(10000*(($mostrar['peso']/($mostrar['estatura']*$mostrar['estatura']))));

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

                                                ?></td>

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

                    <!--RETOS-->
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Retos
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Reto</th>
                                        <th>Estado</th>
                                        <th>Calificación</th>
                                        <th>nota</th>
                                    </tr>
                                    <?php
                                    $sql= "select retos_subidos.usuarios_id, creacion_reto.nombre_reto, retos_subidos.estado, retos_subidos.calificacion, retos_subidos.nota from retos_subidos INNER join creacion_reto on creacion_reto.id= retos_subidos.creacion_reto_id WHERE retos_subidos.usuarios_id= '$_SESSION[id_usuario]'";

                                    $result=mysqli_query($conexion,$sql);

                                    while($mostrar=mysqli_fetch_array($result)){
                                        $cali=$mostrar['calificacion'];

                                        ?>
                                        <tr>
                                            <td><?php echo $mostrar['nombre_reto'] ?></td>
                                            <td><?php
                                                if ($mostrar['estado']==0){
                                                    echo 'Revisando';
                                                }elseif($mostrar['estado']==1){
                                                    echo 'Revisado';
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                if ($cali=='1'){
                                                    echo '<img src="imgs/christmas-star_112199.png" alt="" width="30px">';
                                                }elseif ($cali=='2'){
                                                    echo '<img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px">';
                                                }elseif ($cali=='3'){
                                                    echo '<img src="imgs/christmas-star_112199.png" alt="" width="30px">  <img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px">';
                                                }elseif ($cali=='4'){
                                                    echo 'tu reto fue rechazado';
                                                }
                                                ?></td>
                                            <td><?php echo $mostrar['nota'] ?></td>
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
        </div>
    </div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $("#imc").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'php/calcular-imc.php',
            data: $('#imc').serialize(),
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == "ok") {///////registro exitoso
                    Swal.fire({
                        icon: 'success',
                        title: 'IMC Generado',
                        text: '',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                } else if (data.status == "error") {///////registrado
                    Swal.fire({
                        icon: 'info',
                        title: 'Error',
                        text: 'No puedes registrate de nuevo',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            }
        });
    });
</script>
</body>

<?php
require 'php/footer.php'
?>

</html>
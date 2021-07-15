<?php
session_start();
include 'imc/header.php';
include '../php/conexion.php';



?>


<!-- inicio pagina -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Calendario de partidos -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agregar Partidos</h6>

                </div>
                <div class="card-body">
                    <div class="col-12">
                        <label class="required" for="inmueble_id">Seleccione un torneo</label>
                        <select class="form-control " name="torneo" id="torneo" required style="width:100%" >
                            <option value="">Seleccione un torneo</option>
                            <?php
                            include 'imc/select-torneo.php'
                            ?>
                        </select>


                    </div>
                    <br>
                    <form id="bardas" method="post">
                        <table class="table table-hover" style="display: none" id="bardas2">
                            <tr>
                                <th>Local</th>
                                <th>vs</th>
                                <th>Vistante</th>
                                <th>Jornada</th>
                                <th>fecha</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="localB">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/EquiposFut.php';
                                        ?>
                                    </select>
                                </td>
                                <td>vs</td>
                                <td>
                                    <select name="visita" id="visitaB">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/EquiposFut.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornadaB">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='futbol bardas'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>

                                </td>
                                <td><input type="datetime-local" id="fechaB"></td>
                                <td>
                                    <?php
                                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='futbol bardas'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'futbol bardas')";
                                    $result=mysqli_query($conexion,$sql);
                                    $idTorneo=mysqli_fetch_array($result);
                                    ?>
                                    <input type="hidden"value="<?php echo $idTorneo['id'] ?>" id="torneoB">
                                    <button type="button" onclick="guardarBardas()" > Guardar Resultado</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <form id="asenso" method="post">
                        <table class="table table-hover" style="display: none" id="ascenso2">
                            <tr>
                                <th>Local</th>
                                <th>vs</th>
                                <th>Vistante</th>
                                <th>Jornada</th>
                                <th>fecha</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="localA">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/EquiposFut2.php';
                                        ?>
                                    </select>
                                </td>
                                <td>vs</td>
                                <td>
                                    <select name="visita" id="visitaA">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/EquiposFut2.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornadaA">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='ascenso'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>
                                    <?php
                                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='ascenso'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'ascenso')";
                                    $result=mysqli_query($conexion,$sql);
                                    $idTorneo=mysqli_fetch_array($result);
                                    ?>
                                    <input type="hidden"value="<?php echo $idTorneo['id'] ?>" id="torneoA">
                                </td>
                                <td><input type="datetime-local" id="fechaA"></td>
                                <td><button type="button" onclick="guardarAscenso()" > Guardar Resultado</button> </td>
                            </tr>
                        </table>
                    </form>
                    <form id="fifa" method="post">
                        <table class="table table-hover" style="display: none" id="fifa2">
                            <tr>
                                <th>Local</th>
                                <th>vs</th>
                                <th>Vistante</th>
                                <th>Jornada</th>
                                <th>fecha</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="localF">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/equiposFifa.php';
                                        ?>
                                    </select>
                                </td>
                                <td>vs</td>
                                <td>
                                    <select name="visita" id="visitaF">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/equiposFifa.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornadaF">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='FIFA'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>
                                    <?php
                                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='FIFA'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'FIFA')";
                                    $result=mysqli_query($conexion,$sql);
                                    $idTorneo=mysqli_fetch_array($result);
                                    ?>
                                    <input type="hidden"value="<?php echo $idTorneo['id'] ?>" id="torneoF">
                                </td>
                                <td><input type="datetime-local" id="fechaF"></td>
                                <td><button type="button" onclick="guardarFIFA()" > Guardar Resultado</button> </td>
                            </tr>
                        </table>
                    </form>
                    <form id="volei" method="post">
                        <table class="table table-hover" style="display: none" id="vole2">
                            <tr>
                                <th>Local</th>
                                <th>vs</th>
                                <th>Vistante</th>
                                <th>Jornada</th>
                                <th>fecha</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="localV">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/EquiposVole.php';
                                        ?>
                                    </select>
                                </td>
                                <td>vs</td>
                                <td>
                                    <select name="visita" id="visitaV">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/EquiposVole.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornadaV">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='Voleibol'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>
                                    <?php
                                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='Voleibol'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'Voleibol')";
                                    $result=mysqli_query($conexion,$sql);
                                    $idTorneo=mysqli_fetch_array($result);
                                    ?>
                                    <input type="hidden"value="<?php echo $idTorneo['id'] ?>" id="torneoV">
                                </td>
                                <td><input type="datetime-local" id="fechaV"></td>

                                <td><button type="button" onclick="guardarVole()" > Guardar Resultado</button> </td>
                            </tr>
                        </table>
                    </form>
                    <form id="basket" method="post">
                        <table class="table table-hover" style="display: none" id="bask2">
                            <tr>
                                <th>Local</th>
                                <th>vs</th>
                                <th>Vistante</th>
                                <th>Jornada</th>
                                <th>fecha</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="local"  id="localBa">
                                        <option value="value1">Local</option>
                                        <?php
                                        require 'imc/EquiposBas.php';
                                        ?>
                                    </select>
                                </td>
                                <td>vs</td>
                                <td>
                                    <select name="visita" id="visitaBa">
                                        <option value="value1">Visitante</option>
                                        <?php
                                        require 'imc/EquiposBas.php';
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="jornada" id="jornadaBa">
                                        <?php
                                        $listado = "SELECT `jornadas` FROM `creacion_torneo` WHERE `id`=( SELECT id from creacion_torneo where creacion_torneo.fecha_creacion=( SELECT MAX(`fecha_creacion`) from creacion_torneo WHERE `disciplina`='Basquetbol'))";

                                        $query = mysqli_query($conexion, $listado);

                                        while ($FIFAequi = mysqli_fetch_array($query)){

                                            for ($x=1;$x<$FIFAequi['jornadas']+1;$x++){
                                                echo '<option value ="'.$x.'">'.$x.'</option>';
                                            }

                                        }
                                        ?>
                                    </select>
                                    <?php
                                    $sql= "SELECT * FROM `creacion_torneo` WHERE disciplina='Basquetbol'AND fecha_creacion = ( SELECT MAX(fecha_creacion) FROM `creacion_torneo` WHERE disciplina = 'Basquetbol')";
                                    $result=mysqli_query($conexion,$sql);
                                    $idTorneo=mysqli_fetch_array($result);
                                    ?>
                                    <input type="hidden"value="<?php echo $idTorneo['id'] ?>" id="torneoBa">
                                </td>
                                <td><input type="datetime-local" id="fechaBa"></td>
                                <td><button type="button" onclick="guardarBas()" > Guardar Resultado</button> </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <script>
                    $('select#torneo').on('change',function(){
                        var valor = $(this).val();
                        console.log(valor);
                        if (valor=='Futbol Bardas'){
                            document.getElementById("bardas2").style.display = "";
                            document.getElementById("bask2").style.display = "none";
                            document.getElementById("vole2").style.display="none";
                            document.getElementById("fifa2").style.display="none";
                            document.getElementById("ascenso2").style.display="none";
                        }else if (valor=='ascenso'){
                            document.getElementById("bardas2").style.display = "none";
                            document.getElementById("bask2").style.display = "none";
                            document.getElementById("vole2").style.display="none";
                            document.getElementById("fifa2").style.display="none";
                            document.getElementById("ascenso2").style.display="";
                        }else if(valor=='FIFA'){
                            document.getElementById("bardas2").style.display = "none";
                            document.getElementById("bask2").style.display = "none";
                            document.getElementById("vole2").style.display="none";
                            document.getElementById("fifa2").style.display="";
                            document.getElementById("ascenso2").style.display="none";
                        }else if(valor=='Voleibol'){
                            document.getElementById("bardas2").style.display = "none";
                            document.getElementById("bask2").style.display = "none";
                            document.getElementById("vole2").style.display="";
                            document.getElementById("fifa2").style.display="none";
                            document.getElementById("ascenso2").style.display="none";
                        }else if(valor=='Basquetbol'){
                            document.getElementById("bardas2").style.display = "none";
                            document.getElementById("bask2").style.display = "";
                            document.getElementById("vole2").style.display="none";
                            document.getElementById("fifa2").style.display="none";
                            document.getElementById("ascenso2").style.display="none";
                        }
                    });

                    function guardarBardas() {
                        var equipov=$('#visitaB').val();
                        var equipol=$('#localB').val();
                        var jornada=$('#jornadaB').val();
                        var torneo=$('#torneoB').val();
                        var fecha=$('#fechaB').val();
                        var tipo='bardas';
                        $.ajax({
                            type: 'POST',
                            url: 'imc/generarPartido.php',
                            data: {local:equipol,visita:equipov,jornada:jornada, torneo:torneo,tipo:tipo, fecha:fecha},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.estatus == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Partido Registrado',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });
                    }
                    function guardarAscenso() {
                        var equipov=$('#visitaA').val();
                        var equipol=$('#localA').val();
                        var jornada=$('#jornadaA').val();
                        var torneo=$('#torneoA').val();
                        var fecha=$('#fechaA').val();
                        var tipo='ascenso';
                        $.ajax({
                            type: 'POST',
                            url: 'imc/generarPartido.php',
                            data: {local:equipol,visita:equipov,jornada:jornada, torneo:torneo,tipo:tipo,fecha:fecha},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.estatus == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Partido Registrado',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });
                    }
                    function guardarFIFA() {
                        var equipov=$('#visitaF').val();
                        var equipol=$('#localF').val();
                        var jornada=$('#jornadaF').val();
                        var torneo=$('#torneoF').val();
                        var fecha=$('#fechaF').val();
                        var tipo='fifa';
                        $.ajax({
                            type: 'POST',
                            url: 'imc/generarPartido.php',
                            data: {local:equipol,visita:equipov,jornada:jornada, torneo:torneo,tipo:tipo,fecha:fecha},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.estatus == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Partido Registrado',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });
                    }
                    function guardarVole() {
                        var equipov=$('#visitaV').val();
                        var equipol=$('#localV').val();
                        var jornada=$('#jornadaV').val();
                        var torneo=$('#torneoV').val();
                        var fecha=$('#fechaV').val();
                        var tipo='vole';
                        $.ajax({
                            type: 'POST',
                            url: 'imc/generarPartido.php',
                            data: {local:equipol,visita:equipov,jornada:jornada, torneo:torneo,tipo:tipo,fecha:fecha},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.estatus == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Partido Registrado',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });
                    }
                    function guardarBas() {
                        var equipov=$('#visitaBa').val();
                        var equipol=$('#localBa').val();
                        var jornada=$('#jornadaBa').val();
                        var torneo=$('#torneoBa').val();
                        var fecha=$('#fechaBa').val();
                        var tipo='bas';
                        $.ajax({
                            type: 'POST',
                            url: 'imc/generarPartido.php',
                            data: {local:equipol,visita:equipov,jornada:jornada, torneo:torneo,tipo:tipo,fecha:fecha},
                            cache: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.estatus == "ok") {///////registro exitoso
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Partido Registrado',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });
                    }

                </script>

            </div>
        </div>

        <!-- ver resltados -->
        <div class="col-xl-12 col-lg-7" id="result">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>

                </div>

                    <div class="card-body">

                        <!-- Muestran total de jornadas  -->
                        <ul class="nav nav-tabs" id="tab-futbol" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-futbol-general" data-toggle="tab" href="#bardas" role="tab" aria-controls="futbol-general" aria-selected="true">Futbol Bardas</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#asenso" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Ascenso</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#FIFA" role="tab" aria-controls="futbol-jugadores" aria-selected="false">FIFA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#voleibol" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Voleibol</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-futbol-jugadores" data-toggle="tab" href="#basquetbol" role="tab" aria-controls="futbol-jugadores" aria-selected="false">Basquetbol</a>
                            </li>
                        </ul>


                        <!-- Muestran los resultados de partidos en jornada 1  va php-->
                        <div class="tab-content" id="tab-futbol-contenido">
                            <div class="tab-pane fade show active" id="bardas" role="tabpanel" aria-labelledby="tab-futbol-general">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Local</th>
                                            <th>vs</th>
                                            <th>vistante</th>
                                            <th>Jornada</th>
                                        </tr>
                                        <?php
                                        $sql= "SELECT * FROM `partidos_futbol` WHERE `torneo_id`=(SELECT MAX(id) FROM creacion_torneo WHERE `disciplina`='Futbol Bardas');";
                                        $result=mysqli_query($conexion,$sql);
                                        while($mostrar=mysqli_fetch_array($result)){
                                            $locales=$mostrar['id_local'];
                                            $visitantes=$mostrar['id_visita'];
                                            $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                            $resultaL=mysqli_query($conexion,$equipoL);
                                            $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                            $resultaV=mysqli_query($conexion,$equipoV);
                                            $localL=mysqli_fetch_array($resultaL);
                                            $visitaV=mysqli_fetch_array($resultaV);
                                            ?>
                                            <tr>
                                                <td><?php echo $localL['nombre_equipo'] ?></td>
                                                <td>vs</td>
                                                <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                                <td><?php echo $mostrar['jornada'] ?></td>

                                            </tr>
                                        <?php  } ?>
                                    </table>

                            </div>

                            <div class="tab-pane fade " id="asenso" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Local</th>
                                        <th>vs</th>
                                        <th>vistante</th>
                                        <th>Jornada2</th>
                                    </tr>
                                    <?php
                                    $sql= "SELECT * FROM `partidos_ascenso` WHERE `torneo_id`=(SELECT MAX(id) FROM creacion_torneo WHERE `disciplina`='ascenso');";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){
                                        $locales=$mostrar['id_local'];
                                        $visitantes=$mostrar['id_visita'];
                                        $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                        $resultaL=mysqli_query($conexion,$equipoL);
                                        $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                        $resultaV=mysqli_query($conexion,$equipoV);
                                        $localL=mysqli_fetch_array($resultaL);
                                        $visitaV=mysqli_fetch_array($resultaV);
                                        ?>
                                        <tr>
                                            <td><?php echo $localL['nombre_equipo'] ?></td>
                                            <td>vs</td>
                                            <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                            <td><?php echo $mostrar['jornada'] ?></td>

                                        </tr>
                                    <?php  } ?>
                                </table>

                            </div>

                            <div class="tab-pane fade " id="FIFA" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Local</th>
                                        <th>vs</th>
                                        <th>vistante</th>
                                        <th>Jornada</th>
                                    </tr>
                                    <?php
                                    $sql= "SELECT * FROM `partidos_fifa` WHERE `torneo_id`=(SELECT MAX(id) FROM creacion_torneo WHERE `disciplina`='FIFA');";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){
                                        $locales=$mostrar['id_local'];
                                        $visitantes=$mostrar['id_visita'];
                                        $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                        $resultaL=mysqli_query($conexion,$equipoL);
                                        $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                        $resultaV=mysqli_query($conexion,$equipoV);
                                        $localL=mysqli_fetch_array($resultaL);
                                        $visitaV=mysqli_fetch_array($resultaV);
                                        ?>
                                        <tr>
                                            <td><?php echo $localL['nombre_equipo'] ?></td>
                                            <td>vs</td>
                                            <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                            <td><?php echo $mostrar['jornada'] ?></td>

                                        </tr>
                                    <?php  } ?>
                                </table>

                            </div>

                            <div class="tab-pane fade " id="voleibol" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Local</th>
                                        <th>vs</th>
                                        <th>vistante</th>
                                        <th>Jornada</th>
                                    </tr>
                                    <?php
                                    $sql= "SELECT * FROM `partidos_vole` WHERE `torneo_id`=(SELECT MAX(id) FROM creacion_torneo WHERE `disciplina`='Voleibol');";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){
                                        $locales=$mostrar['id_local'];
                                        $visitantes=$mostrar['id_visita'];
                                        $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                        $resultaL=mysqli_query($conexion,$equipoL);
                                        $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                        $resultaV=mysqli_query($conexion,$equipoV);
                                        $localL=mysqli_fetch_array($resultaL);
                                        $visitaV=mysqli_fetch_array($resultaV);
                                        ?>
                                        <tr>
                                            <td><?php echo $localL['nombre_equipo'] ?></td>
                                            <td>vs</td>
                                            <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                            <td><?php echo $mostrar['jornada'] ?></td>

                                        </tr>
                                    <?php  } ?>
                                </table>

                            </div>

                            <div class="tab-pane fade " id="basquetbol" role="tabpanel" aria-labelledby="tab-futbol-general">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Local</th>
                                        <th>vs</th>
                                        <th>vistante</th>
                                        <th>Jornada</th>
                                    </tr>
                                    <?php
                                    $sql= "SELECT * FROM `partidos_basquetbol` WHERE `torneo_id`=(SELECT MAX(id) FROM creacion_torneo WHERE `disciplina`='Basquetbol');";
                                    $result=mysqli_query($conexion,$sql);
                                    while($mostrar=mysqli_fetch_array($result)){
                                        $locales=$mostrar['idLocal'];
                                        $visitantes=$mostrar['idVisita'];
                                        $equipoL="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$locales'";
                                        $resultaL=mysqli_query($conexion,$equipoL);
                                        $equipoV="SELECT `nombre_equipo` FROM `equipos` WHERE `id`='$visitantes'";
                                        $resultaV=mysqli_query($conexion,$equipoV);
                                        $localL=mysqli_fetch_array($resultaL);
                                        $visitaV=mysqli_fetch_array($resultaV);
                                        ?>
                                        <tr>
                                            <td><?php echo $localL['nombre_equipo'] ?></td>
                                            <td>vs</td>
                                            <td><?php echo $visitaV['nombre_equipo'] ?></td>
                                            <td><?php echo $mostrar['jornada'] ?></td>

                                        </tr>
                                    <?php  } ?>
                                </table>

                            </div>

                        </div>
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
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>
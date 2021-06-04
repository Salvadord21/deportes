<?php
session_start();
include 'php/conexion.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Volim</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/fontawesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
                  <h2 style="margin-bottom: 65px;">Retos</h2>
               </div>
            </div>
             <div class="row">
                 <div class="col-md-7">
                     <?php
                     $sql= "SELECT * FROM `creacion_reto` WHERE fecha_inicio = ( SELECT MAX(fecha_inicio)  FROM creacion_reto)";
                     $result= mysqli_query($conexion,$sql);
                     while($mostrar=mysqli_fetch_array($result)){

                         ?>
                         <h4><?php echo $mostrar['nombre_reto'] ?></h4>
                         <h6>Inicia: <?php echo $mostrar['fecha_inicio'] ?> - Termina: <?php echo $mostrar['fecha_fin'] ?></h6>
                         <p><br> <?php echo $mostrar['descripcion'] ?>
                         <p> Graba tu vídeo realizando el ejercicio.<br>
                             ¡Súbelo a Youtube de forma No Listada o en GOOGLE Drive y envianos el link!
                         </p>
                         <p>Recuerda que sólo puedes participar una vez en cada reto</p>

                         <form action="php/enviar-reto.php" method="post">
                             <div class="input-group" >
                                 <input type="url" class="form-control" name="video" aria-label="subir-video" aria-describedby="basic-addon2">
                                 <div class="input-group-append">
                                     <input type="hidden" value="<?php echo $mostrar['id']?>" name="enviar">

                                     <?php
                                     if (!empty($_SESSION['id_usuario'])){

                                         $sql = "select * from retos_subidos where usuarios_id = '$_SESSION[id_usuario]'";
                                         $resultado = mysqli_query($conexion, $sql);

                                         if ($resultado){
                                             $encuentra = mysqli_num_rows($resultado);

                                             if ($encuentra == 1){

                                                 $fila = mysqli_fetch_assoc($resultado);

                                                 $opcion = $fila['estado'];

                                                 if ($opcion == 0) { //ESTA PENDIENTE DE CALIFICAR
                                                     ?>
                                                     <button class="btn btn-outline-secondary" type="submit" disabled>Enviar</button>
                                                     <?php
                                                 }elseif ($opcion == 1){ //YA ESTA CALIFICADO
                                                     ?>
                                                     <button class="btn btn-outline-secondary" type="submit" disabled>Enviar</button>
                                                     <?php
                                                 }


                                             }else{ //NO SE HA ENVIADO NINGUN RETO Y PUEDE HACERLO
                                                 ?>
                                                 <button class="btn btn-outline-secondary" type="submit">Enviar</button>
                                                 <?php
                                             }
                                         }
                                     }else{//NO HA INICIADO SESIÓN
                                         ?>
                                         <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#errorsesion">
                                             Enviar
                                         </button>
                                         <?php
                                     }
                                     ?>
                                 </div>
                             </div>
                         </form>

                         <?php

                     }
                     ?>


                     <!--MENSAJE DE ERROR-->
                     <div class="modal fade" id="errorsesion" tabindex="-1" role="dialog" aria-labelledby="errorsesionTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="errorsesionTitle">¡Alto!</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <h5>Si deseas participar debes primero iniciar sesión</h5>
                                     <p>Si no tienes una cuenta, ¡Registrate!</p>

                                     <div class="modal-footer justify-content-center">
                                         <button type="button" data-dismiss="modal" class="btn btn-outline-primary">Cerrar</button>
                                     </div>
                                     </form>

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-5">
                     <div class="embed-responsive embed-responsive-16by9">
                         <?php
                         $sql= "SELECT * FROM `creacion_reto` WHERE fecha_inicio = ( SELECT MAX(fecha_inicio) FROM `creacion_reto`)";
                         $result= mysqli_query($conexion,$sql);
                         while($mostrar=mysqli_fetch_array($result)){
                             $url=$mostrar['url'];
                             $xt=parse_url($url, PHP_URL_QUERY);
                             $arr1 = str_split($xt);;
                             unset($arr1[0]);
                             unset($arr1[1]);
                             $xy= implode($arr1);
                             if ($url==null){
                                 ?>
                                 <iframe width="560" height="315" src="https://www.youtube.com/embed/aeQg_ZE2-7s"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                 <?php
                             }else{
                                 ?>

                                 <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $xy?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                 <?php
                             }

                             ?>
                             <?php
                         }
                         ?>
                     </div>
                 </div>
             </div>
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <h4>Los Mejores Retos</h4><br>
                    <table class="table table-hover">

                        <tr>
                            <th>Nombre</th>
                            <th>Nombre del reto</th>
                            <th style="text-align: center">Calificacion <img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px"> </th>
                        </tr>
                        <?php
                        $sql= "SELECT usuarios.nombre, creacion_reto.nombre_reto, retos_subidos.calificacion 
FROM retos_subidos INNER JOIN usuarios on usuarios.id=retos_subidos.usuarios_id INNER JOIN creacion_reto 
    on creacion_reto.id=retos_subidos.creacion_reto_id";
                        $result= mysqli_query($conexion,$sql);
                        while($mostrar=mysqli_fetch_array($result)){
                            $x=$mostrar['calificacion'];
                            ?>
                            <tr>
                                <td><?php echo $mostrar['nombre'] ?> </td>
                                <td><?php echo $mostrar['nombre_reto'] ?></td>
                                <td style="text-align: center"><?php
                                    if ($x=='1'){
                                        echo '<img src="imgs/christmas-star_112199.png" alt="" width="30px">';
                                    }elseif ($x=='2'){
                                        echo '<img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px"> ';
                                    }elseif ($x=='3'){
                                        echo '<img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px"> <img src="imgs/christmas-star_112199.png" alt="" width="30px">';
                                    }
                                    ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
         </div>
      </div>

      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>

   <?php
   require 'php/footer.php'
   ?>
</html>
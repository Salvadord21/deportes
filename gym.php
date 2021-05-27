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
   </head>
   <body>

   <?php
   if(!empty($_SESSION['msg_error'])){
       ?>

       <div class="alert alert-danger">
           <?php echo $_SESSION['msg_error'] ?>
       </div>
       <?php
       $_SESSION['msg_error'] = '';
   };
   ?>

      <div class="top_section">
         <div class="top_inner">
            <div id="header" class="header">
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
      </div>

      
      <div id="classes" class="layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text_align_center">
                  <h2 style="margin-bottom: 65px;">Área de pesas</h2>
               </div>
            </div>

            <div class="row">

               <div class="col-md-7">

                  <p>En el área de pesas podrás desarrollar tus capacidades físicas de forma recreativa o mejorar tu condición física como parte de la disciplina deportiva que realizas.

                     El ejercicio es una parte importante de un estilo de vida saludable, el cual te dará los siguientes beneficios:

                     <ul>
                        <li>Desarrollo de las capacidades físicas</li>
                        <li>Prevención de enfermedades</li>
                        <li>Reduce el estrés</li>
                        <li>Incrementa la autoestima</li>
                        <li>Conciliar el sueño</li>
                     </ul>

                     El área de pesas se encuentra ubicado en el mezzanine dentro del Gimnasio del Campus Torrente Viver. </p>
                     <br>
                  <h4>Reglas de uso del área de pesas</h4>
                  <ol>
                     <li>Los participantes del área de pesas deben mantener una conducta de respeto y sana convivencia.</li>
                     <li>Todo participante deberá anotar su entrada y salida en (aquí pon el nombre correcto del dispositivo).</li>
                     <li>El participante deberá vestir ropa deportiva: short, pants o licra, playera y tenis. </li>
                     <li>El participante deberá hacer uso de los vestidores para realizar su cambio de ropa. </li>
                     <li>El participante deberá secar con toalla individual los aparatos o área utilizada.</li>
                     <li>Se prohíbe introducir alimentos y bebidas en envases de vidrio.</li>
                     <li>El participante deberá regresar a su lugar el material deportivo: mancuernas, barras, discos, etc., y/o descargar el peso utilizado en cada aparato una vez que termine de utilizarlo. </li>
                     <li>No mover las máquinas, aparatos, espejos y ventiladores ni extraer material deportivo del área de pesas.</li>
                     <li>No se permite el acceso a acompañantes que no vayan a realizar ejercicio. </li>
                     <li>.Prohibido hacer uso indebido u ocasionar daño o desperfecto a cualquier aparato, material o equipo complementario ubicado en el área de pesas. </li>
                     <li>Prohibido operar o manipular el sistema de audio. </li>
                     <li>Toda persona que no respete estas reglas, será acreedora a una amonestación verbal, y en caso de reincidir, será suspendido de manera temporal o definitiva, según sea el caso.</li>
                  </ol>
               </div>

               <div class="col-md-5">

                   <form action="php/solicitud-registro-gym.php" method="post">
                  <h4>Envía tu solicitud de inscripción</h4>

                       <?php
                       if (!empty($_SESSION['id_usuario'])){

                           $sql = "select * from usuarios where id = '$_SESSION[id_usuario]'";
                           $resultado = mysqli_query($conexion, $sql);

                           if ($resultado){
                           $encuentra = mysqli_num_rows($resultado);

                               if ($encuentra == 1){

                                   $fila = mysqli_fetch_assoc($resultado);

                                   $opcion = $fila['status_gym'];

                                    if ($opcion == 2) {
                                           ?>
                                           <p>Tu solicitud esta pendiente</p>
                                           <button type="submit" class="btn btn-outline-dark" disabled>Inscribirme</button>
                                           <?php
                                       }elseif ($opcion == 1){
                                           ?>
                                           <p>Ya estas inscrito al área de pesas</p>
                                           <button type="submit" class="btn btn-outline-dark" disabled>Inscribirme</button>
                                           <?php
                                       }elseif($opcion == 0){
                                           ?>
                                           <button type="submit" class="btn btn-outline-dark">Inscribirme</button>
                                           <?php
                                       }
                               }
                           }
                       }else{
                           ?>
                           <button type="button" class="btn btn-outline-info justify-content-md-end" data-toggle="modal" data-target="#errorsesion">
                               Inscribirme
                           </button>
                           <?php
                       }
                       ?>
                   </form>


                  <br><br>
                  <h4>Horario</h4>
                  <p>Lunes a Viernes 9:00 - 21:00 <br>
                     Sábados 9:00 - 14:00</p>
                  <h4>Horario de entrenadores</h4>
                  <p>Lunes a Viernes 9:00 - 21:00 <br>
                     Sábados 9:00 - 14:00</p>
               </div>


            </div>
         </div>
      </div>


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
                   <p>Para poder participar en nuestras actividades primero debes iniciar sesión</p>
                   <p>Si no tienes una cuenta, ¡Registrate!</p>

                   <div class="modal-footer justify-content-center">
                       <button type="button" data-dismiss="modal" class="btn btn-outline-primary">Cerrar</button>
                   </div>
                   </form>

               </div>
           </div>
       </div>
   </div>

      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>

   </body>



</html>
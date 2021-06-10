<?php
session_start();
require 'php/conexion.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educación Deportiva</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v8.0" nonce="iJgaIgrH"></script>
</head>
<body>
<?php
if(!empty($_SESSION['msg_error'])){

    $_SESSION['msg_error'] = '';
}else{

}
?>

<!--BARRA DE MENU-->
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
<!--FIN BARRA DE MENU-->

<div class="top_section">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#main_slider" data-slide-to="0" class="active"></li>
            <li data-target="#main_slider" data-slide-to="1"></li>
            <li data-target="#main_slider" data-slide-to="2"></li>
            <li data-target="#main_slider" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="imgs/prueba%20imagen.jpg" alt="slider_img">
                <div class="ovarlay_slide_cont"></div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="imgs/SliderPáginaDeportes2.jpg" alt="slider_img"> <!--otra imagen*-->
                <div class="ovarlay_slide_cont"></div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="imgs/SliderPáginaDeportes3.jpg" alt="slider_img"> <!--otra imagen*-->
                <div class="ovarlay_slide_cont"></div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="imgs/SliderPáginaDeportes4.jpg" alt="slider_img"> <!--otra imagen*-->
                <div class="ovarlay_slide_cont"></div>
            </div>
        </div>
    </div>
</div>

<!-- PARTE TORNEOS-->
<div id="trainings_blog" class="layout_padding" style="background: #F2F2F2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text_align_center">
                <h2 style="margin-bottom: 65px;">Torneos</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="full dance_form_name">
                    <a href="torneo.php"><img src="imgs/futbol-bardas-2020-banner.jpg" alt="#" /></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="full dance_form_name">
                    <a href="torneo.php"><img src="imgs/UCCopaMundialFifa20_Banner.jpg" alt="#" /></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="full dance_form_name">
                    <a href="torneo.php"><img src="imgs/torneo-voleibol-2020-banner.jpg" alt="#" /></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="full dance_form_name">
                    <a href="torneo.php"><img src="imgs/torneo-basquet-2020-banner.jpg" alt="#" /></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PARTE pesas-->
<div id="classes" class="layout_padding" style="background: rgb(0,127,175);">
    <div class="container">

        <div class="row">
            <div class="col-md-5">
                <h3 class="text_align_left">Área de pesas</h3>
                <br>
                <h6>
                    En el área de pesas podrás desarrollar tus capacidades físicas de forma recreativa
                    o mejorar tu condición física como parte de la disciplina deportiva que realizas.
                    El ejercicio es una parte importante de un estilo de vida saludable, el cual te dará
                    los siguientes beneficios:
                    <br>
                    <ul>
                        <li>Desarrollo de las capacidades físicas</li>
                        <li>Prevención de enfermedades</li>
                        <li>Reduce el estrés</li>
                        <li>Incrementa la autoestima</li>
                        <li>Conciliar el sueño</li>
                    </ul>
                </h6><br>
                <a class="btn btn-info" href="gym.php" role="button">Inscríbete</a>
            </div>
            <div class="col-md-7 video_img">
                <img class="img-responsive" src="imgs/ÁreaDePesas440x450.jpg" width="450px" alt="#" />
            </div>
        </div>
    </div>
</div>

<!--PARTE reto-->
<div id="trainings_blog" class="layout_padding" style="background: #F2F2F2">
    <div class="container">
        <div class="row">

            <div class="col-md-7 video_img">
                <img class="img-responsive" src="imgs/RetoSemanal440x450.jpg" width="450px" alt="#" />
            </div>

            <div class="col-md-5">
                <?php
                $sql= "SELECT * FROM `creacion_reto` WHERE fecha_inicio = ( SELECT MAX(fecha_inicio)  FROM creacion_reto)";
                $result= mysqli_query($conexion,$sql);
                if($mostrar=mysqli_fetch_array($result)){
                    ?>
                    <h3 class="text_align_left">RETOS</h3>
                    <br><br>
                    <h4><?php echo $mostrar['nombre_reto'] ?></h4>
                    <h6> <?php echo $mostrar['descripcion'] ?><br><br><br>¿Te atreves a retarte a ti mismo?<br></h6>
                    <br>
                    <h6>¿Te atreves a retarte a ti mismo?<br></h6>
                    <a class="btn btn-info" href="retos.php" role="button">Iniciar retos</a>
                    <?php
                }else{
                    ?>
                    <h3 class="text_align_left">RETOS<br><br></h3>
                    <h6>Sabemos que no puedes esperar a ponerte a prueba<br><br><br></h6>
                    <h6>¡Se paciente! Pronto se publicará un reto<br><br><br></h6>
                    <br>
                    <a class="btn btn-info" href="retos.php" role="button">Ver retos</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- PARTE FACE-->

<div id="shows">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text_align_center layout_padding" style="background: rgb(0,127,175);; min-height: 450px">
                <h3>FACEBOOK<br><br></h3>
                <div class="fb-page" data-href="https://www.facebook.com/AguilasUCC/" data-tabs="timeline" data-width="900" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/AguilasUCC/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/AguilasUCC/">UCC Educación Deportiva</a></blockquote></div>
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

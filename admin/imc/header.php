<?php

$matri = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- parte izquierda -->
    <!-- Sidebar -->
    <ul class="navbar-nav bg-admin sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="bg-top-adm sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
            <div class="sidebar-brand-icon ">
                <img src="../imgs/aguilas-ucc%20-%20copia.png" style="width: 65px; height: 60px">
            </div>
            <div class="sidebar-brand-text mx-3">Usuarios</div>
        </a>


        <!-- Heading -->
        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="index.php">
                <img src="iconos/crearreto.png" style="width: 16px; height: 16px">
                <span>Crear retos</span></a>
        </li>
        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="crear_torneo.php">
                <img src="iconos/CrearTorneo.png" style="width: 16px; height: 16px">
                <span>Torneos</span></a>
        </li>

        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="otorneos.php">
                <img src="iconos/puzzle.png" style="width: 16px; height: 16px">
                <span>Otros Torneos</span></a>
        </li>
        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="partidos.php">
                <img src="iconos/puzzle.png" style="width: 16px; height: 16px">
                <span>Partidos</span></a>
        </li>
        <li class="nav-item active">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
               aria-controls="collapseTwo">
                <img src="iconos/Jornadas.png" style="width: 16px; height: 16px">
                <span>Jornadas</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="fut.php">Fútbol Premier</a>
                    <a class="collapse-item" href="ascenso.php">Fútbol Ascenso</a>
                    <a class="collapse-item " href="fifa.php">FIFA</a>
                    <a class="collapse-item " href="basket.php">Básquebol</a>
                    <a class="collapse-item " href="voleibol.php">Voleibol</a>
                </div>
            </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <!-- Nav Item - Charts -->


        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="equipos.php">
                <img src="iconos/equipos.png" style="width: 16px; height: 16px">
                <span>Equipos</span></a>
        </li>

        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="usuarios.php">
                <img src="iconos/user.png" style="width: 16px; height: 16px">
                <span>Usuarios</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="retos.php">
                <img src="iconos/Retos.png" style="width: 16px; height: 16px">
                <span>Retos</span></a>
        </li>
        <!--
        <li class="nav-item">
            <a class="btn bg-admin nav-link" style="box-shadow: none" href="gym.php">
                <img src="iconos/gym.png" style="width: 16px; height: 13px">
                <span>Área de Pesas</span></a>
        </li>
        -->
    </ul>


    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <nav class="navbar navbar-expand navbar-light bg-top-adm topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <form class="form-inline">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </form>



                <!-- Topbar Navbar ???-->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class=" nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>
                    </li>



                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown -arrow-down">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-white "><?php echo $matri ?></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../perfil_usuario.php">
                                <img src="iconos/useradmin.png" style="width: 13px; height: 16px">
                                Perfil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../php/cerrar.php">
                                <img src="iconos/out.png" style="width: 16px; height: 16px">
                                Cerrar sesión
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
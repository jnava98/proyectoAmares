<?php
session_start();
include "assets/php/conexion.php";
//include "selects.php";
//include "funciones_agenda.php";

//if(!(empty($_SESSION["nombre_user"]))){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Configuración de Usuarios</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <script src="assets/js/jquery/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/FontAwesome.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="assets/js/usuarios.js"></script>
        <link rel="stylesheet" href="assets/css/FontAwesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css">
        <script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert2.min.css">
        <script type="text/javascript" src="assets/sweetalert/sweetalert2.min.js" ></script>

        <!-- Favicons -->
        <link href="assets\img\iconAmares.svg" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
        
        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet"><link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <style>
        </style> 
    </head>
    
    <body onload="cargar_tabla_usuarios();">

    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logoAmares.svg" alt="">
        <span class="d-none d-lg-block">Cobranza</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
        </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
            </div>
            </li>

            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
            </div>
            </li>

            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
            <i class="bi bi-check-circle text-success"></i>
            <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
            </div>
            </li>

            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
            </div>
            </li>

            <li>
            <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
            </li>

        </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="message-item">
            <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                <h4>Maria Hudson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>4 hrs. ago</p>
                </div>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="message-item">
            <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                <h4>Anna Nelson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>6 hrs. ago</p>
                </div>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="message-item">
            <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                <h4>David Muldon</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>8 hrs. ago</p>
                </div>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
            <a href="#">Show all messages</a>
            </li>

        </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6>Kevin Anderson</h6>
            <span>Web Designer</span>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </a>
            </li>

        </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

    </ul>
    </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->


    <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link collapsed" href="?page=control">
        <i class="bi bi-grid"></i>
        <span>Panel de Control</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Clientes</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="components-alerts.html">
            <i class="bi bi-circle"></i><span>Alta de Clientes</span>
            </a>
        </li>
        <li>
            <a href="components-accordion.html">
            <i class="bi bi-circle"></i><span>Consulta de Clientes</span>
            </a>
        </li>
        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Lotes</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="forms-elements.html">
            <i class="bi bi-circle"></i><span>Alta de lotes</span>
            </a>
        </li>
        </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Reportes</span>
        </a>
    </li><!-- End Tables Nav -->
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

    <div class="pagetitle">
    <h1>Configuración de usuarios</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
        <li class="breadcrumb-item">Usuarios</li>
        <li class="breadcrumb-item active">Agregar usuarios</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->

        <section class="container-fluid text-justify">
            <form method='POST' action='?page=usuarios_acuse' target='_blank'>
                
                <br>
                <div class="form-group row">
                    <div class="col-sm-8 text-left">
                        <input type="button" name="agregar_usuario" id="agregar_usuario" class="btn btn-primary texto_boton" value="Agregar" onclick="mostrar_formato_usuarios();"></input>
                        <input type="button" name="cancelar" id="cancelar" class="btn btn-danger texto_boton" value="Cancelar" onclick="cancelar_formato_usuarios();"></input>
                        <!--<button type='submit' name='imprimir_reporte_usuario' id='imprimir_reporte_usuario' class='btn boton_editar btn-sm' >Imprimir</button> <br><br>-->
                    </div>
                </div>
                <div class="form-group text-justify" id="formato_usuario" style="overflow: hidden; display: none;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title">Crear una Cuenta</h5>
                                <p>Introduce los siguientes datos para crear la cuenta de usuario</p>
                            </div>
                            <form class="row g-3 needs-validation">
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <label for="usuario" class="form-label">Usuario</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="usuario" class="form-control form-control-sm" id="usuario">                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <br>
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                        </br>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <label for="nombre_usuario" class="form-label">Nombre</label>
                                        <input type="text" name="name" class="form-control" id="nombre_usuario">
                                    </div>
                                </div>
                                
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <br>
                                        <button class="btn btn-primary texto_boton" type="button" id="guardar_usuario" onclick="guardar_formato_usuario();">Crear usuario</button>
                                        </br>  
                                    </div>      
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="table-responsive" id="div_tabla_usuarios">
                    </div>
                </div>
            </form>
        </section>
    </body>
    <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/js/main.js"></script>
<?php

/*}else{
	header("Location:?page=login");
}//Fin del else...*/
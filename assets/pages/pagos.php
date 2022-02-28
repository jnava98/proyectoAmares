<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!(empty($_SESSION["usuario"]))){
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Amares Cobranza - Pagos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Referencias Cesar -->
  <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/js/pagos.js"></script>
  <!--
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  -->
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
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

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
              <i class="bi bi-circle"></i><span>Detalle Pagos</span>
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
      <h1>Detalle Clientes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item">Pagos</li>
          <li class="breadcrumb-item active">Detalle Pagos</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <input id="id_cliente" type="hidden" value="">
      <div class="row">
        <div id="div_buscar_cliente" class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Clientes</h5>
              <div class="row">
                <div class="col-lg-6">
                  <input id="input_cliente" class="form-control" type="text" autocomplete="off" placeholder="Nombre del cliente" onkeyup="busca_cliente()">
                </div>
                <div class="col-lg-6">
                  <button type="button" id="buscar" id_cliente="" class="success" onclick="trae_contratos_cliente();"> Buscar</button>&nbsp
                  <button class="success" id="cancelar" onclick="cancelar_busqueda(this.id);">Cancelar</button>
                </div>
              </div>
              <div class="row" id="div_cliente_lista" style="display: none;">
                <div class="col-lg-6" style="margin-left: -12px;">
                  <table class="table table-responsive">
                    <tbody id="tbody_cliente"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row card">
        <div class="table-responsive" id="div_tabla_contratos" style="display:none;"></div>           
      </div>
      <div class="row">
        <div id="div_form_pagos" class="col-lg-12">
        <div class="card">
    <div class="card-body">
        <h5 class="card-title">Captura un pago nuevo.</h5>

        <div class="row mb-12">
            <label for="input_concepto" class="col-sm-2 col-form-label">Concepto</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inp_concepto">
            </div>
            <label for="inp_formpago" class="col-sm-2 col-form-label">Forma de pago</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inp_formpago">
            </div>
            <label for="inp_mensualidad" class="col-sm-2 col-form-label">Cant Mensualidad</label>
            <div class="col-sm-2">
                <input type="email" class="form-control" id="inp_mensualidad" disabled>
            </div>
        </div>

        <div class="row mb-12">
            <label for="input_fpago" class="col-sm-2 col-form-label">Fecha Pago</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="inp_fpago">
            </div>
            <label for="inp_recargo" class="col-sm-2 col-form-label">Recargo</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inp_recargo">
            </div>
            <label for="inp_diferencia" class="col-sm-2 col-form-label">Diferencia</label>
            <div class="col-sm-2">
                <input type="email" class="form-control" id="inp_diferencia" disabled>
            </div>
        </div>

        <div class="row mb-12">
            <label for="input_cpagada" class="col-sm-2 col-form-label">Cantidad Pagada</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inp_cpagada">
            </div>
            <label for="inp_interes" class="col-sm-2 col-form-label">Interés</label>
            <div class="col-sm-2">
            <input type="email" class="form-control" id="inp_interes">
            </div>
            <label for="inp_totpagar" class="col-sm-2 col-form-label">Total a pagar</label>
            <div class="col-sm-2 ">
            <input type="email" class="form-control" id="inp_totpagar" disabled>
            </div>
        </div>
        <div class="row mb-12 justify-content-end">
            <label for="inp_estatus" class="col-sm-2 col-form-label">Estatus</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inp_estatus" disabled>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary" onclick="guarda_pago();">Capturar Pago</button>
            </div>
        </div>
    </div>
</div>
    </div>
        </div>
        <div id="div_historial_pagos" class="card">          
          <table id="table_pagos" style="display:none;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha Mensualidad</th>
                <th scope="col">Fecha pago</th>
                <th scope="col">$ Pagada</th>
                <th scope="col">Mensualidad</th>
                <th scope="col">Diferencia</th>
                <th scope="col">Concepto</th>
                <th scope="col">Observaciones</th>
              </tr>
            </thead>
            <tbody id="body_table_pagos">
              <tr>
                <th scope="row">1</th>
                <td>12/01/2022 - 12/02/2022</td>
                <td>17/01/2022</td>
                <td>1500</td>
                <td>1500</td>
                <td>0</td>
                <td>Enganche 1</td>
              </tr>
            </tbody>
          </table>
        </div>           
      </div>
    </div>
  </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>


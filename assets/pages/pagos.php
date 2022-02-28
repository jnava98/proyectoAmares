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

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  



  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

  <!-- Favicons -->
  <link href="assets\img\iconAmares.svg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

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

    <!-- BUSCADOR CLIENTES -->
    <section class="section">
      <input id="id_cliente" type="hidden" value="">
      <div class="row">
        <div id="div_buscar_cliente" class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Clientes</h5>
              <h6 class="card-subtitle mb-2 text-muted">Consulta el historial de pagos de un cliente.</h6>
              <div class="row">
                <div class="col-lg-6">
                  <input id="input_cliente" class="form-control" type="text" autocomplete="off" placeholder="Nombre del cliente" onkeyup="busca_cliente()">
                </div>
                <div class="col-lg-6">
                  <button type="button" id="buscar" id_cliente="" class="btn btn-success" onclick="trae_contratos_cliente();"> Buscar</button>&nbsp
                  <button class="btn btn-warning" id="cancelar" onclick="cancelar_busqueda(this.id);">Cancelar</button>
                </div>
              </div>
              <div class="row" id="div_cliente_lista" style="display: none;">
                <div class="row col-lg-6" >
                  <table class="table table-responsive">
                    <tbody id="tbody_cliente"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- DATOS ADICIONALES CONTRATO -->
      <div class="row">
        <div class="card" id="div_card_contratos" style=""></div>           
      </div>
      <!-- FIN DATOS ADICIONALES CONTRATO -->
      

      <!-- CAPTURA UN PAGO NUEVO -->
      <div class="row card" id="div_form_pagos" style="display: none;">
        <div class="col-lg-12">
            <div class="card-body">
              <h5 class="card-title">Captura un pago nuevo.</h5>
              <div class="card-text">

              
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
                </div>
                      <a href="#" class="btn btn-primary justify-content-end" onclick="guarda_pago();">Guardar Pago</a>
              </div>
          </div>
        </div>
        <!-- FIN UN PAGO NUEVO -->


        <!-- HISTORIAL PAGOS -->
        <div id="div_historial_pagos" class="card" style="display: none;">
          <div class="card-body">
            <div>
              <h5 class="card-title">Historial de pagos del contrato</h5>
              <button data-id_contrato="" class="btn btn-primary" onclick="pago_nuevo()">Agregar</button>
            </div>
            
            <table id="table_pagos" class="table table-responsive table-bordered table-striped table-hover table-condensed">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Fecha pago</th>
                  <th scope="col">$ Pagada</th>
                  <th scope="col">Mensualidad</th>
                  <th scope="col">Diferencia</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Observaciones</th>
                </tr>
              </thead>
              <tbody id="body_table_pagos"></tbody>
            </table>
          </div>         
        </div> 
        <!-- HISTORIAL PAGOS -->          
      </div>
    </div>
  </section>

  </main><!-- End #main -->
  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>
</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>


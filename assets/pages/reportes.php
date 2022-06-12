<?php
session_start();
include('menu.php');
include "assets/php/selects.php";
if(!(empty($_SESSION["usuario"]))){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Amares Cobranza - Clientes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Referencias Cesar -->
  <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/js/reportes.js"></script>
  <!--
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  -->
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
  <?php
  menu();
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reportes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item">Reportes</li>
          <li class="breadcrumb-item active">Modulo Reportes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <input id="id_cliente" type="hidden" value="">
      <div class="row">
        <div id="div_buscar_cliente" class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reportes</h5>
              <div class="row">
                <div class="col-lg-5">
                  <?php echo select_tipo_reporte(); ?>
                </div>
                <div class="col-lg-5">
                  <button type="button" id="tipo_reporte" name="tipo_reporte" class="btn boton_uno" onclick="cargar_tabla_reporte()">Generar Reporte</button>
                </div>
              </div>
              <br>
              <div class="row" id="inputs_fechas" style="display: none;">
                <div class="col-lg-1">
                  <label > Del </label>
                </div>
                <div class="col-lg-4">
                  <input type="date" id="fecha_uno" name="fecha_uno" class="form-control">
                </div>
                <div class="col-lg-1">
                  <label > Al </label>
                </div>
                <div class="col-lg-4">
                  <input type="date" id="fecha_dos" name="fecha_dos" class="form-control">
                </div>
              </div>
              <br>
              <div class="row">
                <div id="div_reportes" class="col-lg-12" style="display:none;">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="table-responsive col-lg-12" id="div_tabla_reportes">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="row" id="div_formato_cliente" >
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>
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

  <title>Amares Cobranza - Reportes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Referencias Cesar -->
  <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/js/reportes.js"></script>

  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css">
  <script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert2.min.css">
  <script type="text/javascript" src="assets/sweetalert/sweetalert2.min.js" ></script>

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
              <form action="?page=cargar_reportes" method="POST" target="_blank">
                <h5 class="card-title">Reportes</h5>
                <div class="row">
                  <div class="col-lg-5">
                    <?php echo select_tipo_reporte(); ?>
                  </div>
                  <div class="col-lg-5">
                    <button type="button" id="tipo_reporte" name="tipo_reporte" class="btn boton_uno" onclick="validar_formato_reportes();">Generar Reporte</button>
                    <button type="submit" id="boton_formulario" style="display:none;">
                    <!--<button type="button" id="tipo_reporte" name="tipo_reporte" class="btn boton_uno" onclick="actualizar_fechas_entrega()">Aux Fechas Entrega</button>-->
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
              </form>
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
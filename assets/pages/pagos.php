<?php
session_start();
include('menu.php');
if(!(empty($_SESSION["usuario"]))){
?>
<!DOCTYPE htm
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Amares Cobranza - Pagos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Referencias Cesar -->
  <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script defer type="text/javascript" src="assets/js/pagos.js"></script>

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
<?=menu();?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pagos</h1>
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
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option_cliente" onclick="filtrar_datos_busqueda(this.value)" checked>
                    <label class="form-check-label" for="inlineRadio1">Por Cliente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option_lote" onclick="filtrar_datos_busqueda(this.id)">
                    <label class="form-check-label" for="inlineRadio2">Por Lote</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <input id="input_cliente" class="form-control" type="text" autocomplete="off" placeholder="Nombre del cliente" onkeyup="busca_cliente()">
                  <input id="input_buscar_lote" style="display:none;" class="form-control" type="text" autocomplete="off" placeholder='Ingresa el lote separado por "-"' onkeyup="busca_lote()">
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
      <div class="row">
        <div class="card" id="div_tabla_contratos" style="display:none;"></div>           
      </div>
      <!-- DATOS ADICIONALES CONTRATO -->
      <div class="row">
        <div class="card" id="div_card_contratos" style=""></div>           
      </div>
      <!-- FIN DATOS ADICIONALES CONTRATO -->

      <!-- CAPTURA UN PAGO NUEVO -->
      <div class="row" id="div_form_pagos" style="display: none;">
        
      </div>
        <!-- FIN UN PAGO NUEVO -->


        <!-- HISTORIAL PAGOS -->
        <div id="div_historial_pagos" class="card" style="display: none;">
          <div class="card-body">
            <div>
              <h5 class="card-title">Historial de pagos del contrato</h5>
              
            </div>
            <div id="div_table_pagos"></div>
            
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


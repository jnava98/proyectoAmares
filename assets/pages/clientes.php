<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('menu.php');
if(!(empty($_SESSION["usuario"]))){
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Amares Cobranza - Clientes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Referencias Cesar -->
  <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/js/clientes.js"></script>
  <!--
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  -->
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
      <h1>Detalle Clientes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item">Clientes</li>
          <li class="breadcrumb-item active">Detalle Clientes</li>
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
                    <button type="button" id="buscar" class="success" onclick="cargar_datos_cliente(this.id);" disabled> Buscar</button>&nbsp
                    <button class="success" id="agregar" onclick="cargar_datos_cliente(this.id);">Agregar</button>&nbsp
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
      </div>
      <div class="row" id="div_formato_cliente" >
      </div>
      <div class="row">
        <div id="div_contratos" class="col-lg-12" style="display:none;">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="table-responsive col-lg-9" id="div_tabla_contratos">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="div_boton_contrato" class="col-lg-12" style="display:none;">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-2">
                  <button type="button" id="buscar" class="btn btn-success" onclick="cargar_datos_precontrato('0');">Agregar Compra</button>
                  <br>
                </div>
              </div>
            </div>
          </div>            
        </div>
      </div>
      <div class="row" id="div_formato_precontrato">
      </div>
      <div class="row" id="div_formato_contrato">
      </div>
    </section>

  </main><!-- End #main -->

</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>


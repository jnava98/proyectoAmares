<?php
session_start();
include('menu.php');
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
                    <button type="button" id="buscar" class="btn boton_uno" onclick="cargar_datos_cliente(this.id);" disabled> Buscar</button>&nbsp
                    <button class="btn boton_dos" id="agregar" onclick="cargar_datos_cliente(this.id);">Agregar</button>&nbsp
                    <button class="btn boton_tres" id="cancelar" onclick="cancelar_busqueda(this.id);">Cancelar</button>
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
                <div class="table-responsive col-lg-12" id="div_tabla_contratos">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="div_boton_contrato" class="col-lg-12" style="display:none;">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-5">
                  <h5 class="card-title">Agregar Nueva Promesa de Compra</h5>
                  <button type="button" id="buscar" class="btn boton_uno" onclick="cargar_datos_precontrato('0');">Agregar Compra</button>
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
  <!-- Modal -->
  <button type="button" id="boton_modal_clientes" class="btn btn-primary" style="display: none;" data-toggle="modal" data-target="#modalClientes">
  </button>
  <div class="modal fade col-xs-12 col-sm-12 col-md-12 col-lg-12" id="modalClientes" style="padding-top: 7%;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
              </div>
              <div class="modal-body" id="contenidoClientes" style="height:450px;">
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>

</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>


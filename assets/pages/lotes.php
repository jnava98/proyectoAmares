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

  <title>Amares Cobranza - Lotes</title>
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
      <h1>Alta de lotes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item">Lotes</li>
          <li class="breadcrumb-item active">Alta de lotes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div id="div_lote" class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datos del lote</h5>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Fase <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Fase a la que pertenece el lote"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="fase">
                    </div>
                </div>   
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Super manzana <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Super manzana del lote"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="super_mza">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Manzana <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Manzana a la que pertenece el lote"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="mza">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Lote</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="lote">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Metros cuadrados <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Número de metros cuadrados que tiene el lote"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="m2">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Cos <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Coeficiente de ocupación del suelo"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="cos">
                    </div>
                </div>   
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Cus <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Coeficiente de utilización del suelo"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="cus">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Uso </label>
                    <div class="col-sm-10">
                      <input placeholder="Select" type="text" class="form-control" id="uso_lote">
                    </div>
                </div>    
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Disponibilidad - Estatus venta <b>Select?</b></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="estatus_venta">
                    </div>
                </div>   
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Fecha de entrega <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha en la que se prevé entregar el lote"></span></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="fecha_entrega">
                    </div>
                </div>   
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tipo de lote</label>
                    <div class="col-sm-10">
                      <input placeholder="Select" type="text" class="form-control">
                    </div>
                </div> <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Precio de lista <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Precio más alto posible por el que se venderá el lote"></span></label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="precio_lista">
                    </div>
                </div> 
            </div>
        </div>
    </section>

  </main><!-- End #main -->

  <!-- Script para el toggle de los "?"-->
  <script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
  </script>
 

</body>
<?php
}else{
	header("Location:?page=login");
}//Fin del else...
?>
</html>


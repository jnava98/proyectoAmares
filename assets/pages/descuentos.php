<?php
session_start();
include "assets/php/conexion.php";
include('menu.php');
//include "selects.php";
//include "funciones_agenda.php";

if(!(empty($_SESSION["usuario"]))){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Descuentos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/FontAwesome.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css">
    <script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert2.min.css">
    <script type="text/javascript" src="assets/sweetalert/sweetalert2.min.js"></script>
</head>

<body onload="cargar_tabla_descuentos();">

    <?php
    menu();
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Alta de descuentos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item">Descuentos</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="container-fluid text-justify">
            <form method='POST' target='_blank'>

                <br>
                <div class="form-group row">
                    <div class="col-sm-8 text-left">
                        <!-- BOTON AGREGAR DESCUENTOS -->
                        <input type="button" name="agregar_descuento" id="agregar_descuento"
                            class="btn boton_dos" value="Agregar"
                           ></input>
                        <!--  BOTON OCULTAR DESCUENTOS-->
                        <input type="button" name="cancelar" id="cancelar" class="btn boton_tres"
                            value="Cancelar"></input>
                    </div>
                </div>
                <!-- FORMATO ALTA DE DESCUENTOS -->
                <div class="form-group text-justify" id="formato_descuentos" style="overflow: hidden; display: none;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title">Crear un descuento</h5>
                                <p>Introduce los siguientes datos para crear un descuento</p>
                            </div>
                            <form class="row g-3 needs-validation" id="form_descuentos">
                                <div class="row">
                                <div class="col-lg-4">
                                    <div class="col-lg-12">
                                        <label for="descuento" class="form-label">Nombre</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="nombre_descuento" class="form-control form-control-sm fontsize-input"
                                                id="nombre_descuento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-lg-6">
                                        <label for="descuento" class="form-label">Tasa (%)</label>
                                        <div class="input-group has-validation">
                                            <input type="number" name="tasa_descuento" class="form-control form-control-sm fontsize-input"
                                                id="tasa_descuento" placeholder="0-100">
                                                
                                        </div>
                                    </div>
                                </div>                        
                                </div>
                                <div class="row">
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <br>
                                        <button class="btn boton_dos" type="button" id="guardar_descuento"
                                        >Crear descuento</button>
                                        </br>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="table-responsive m-auto pb-3 pt-4 row" id="div_tabla_descuentos">
                    </div>
                </div>
            </form>
        </section>
        <script type="text/javascript" src="assets/js/descuentos.js"></script>
</body>

<?php

}else{
    header("Location:?page=login");
}//Fin del else...*/
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
    <title>Cuentas Bancarias</title>
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

<body onload="cargar_tabla_cuentas_bancarias();">

    <?php
    menu();
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Alta de cuentas bancarias</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item">Cuentas Bancarias</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="container-fluid text-justify">
            <div id="div_lote" class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method='POST' target='_blank'>

                            <br>
                            <div class="form-group row">
                                <div class="col-sm-8 text-left">
                                    <!-- BOTON AGREGAR CUENTA BANCARIA -->
                                    <input type="button" name="agregar_cuenta_bancaria" id="agregar_cuenta_bancaria"
                                        class="btn boton_dos" value="Agregar"
                                    ></input>
                                    <!--  BOTON OCULTAR CUENTA BANCARIA-->
                                    <input type="button" name="cancelar" id="cancelar" class="btn boton_tres"
                                        value="Cancelar"></input>
                                </div>
                            </div>
                            <!-- FORMATO ALTA DE CUENTA BANCARIA -->
                            <div class="form-group text-justify" id="formato_cuentas_bancarias" style="overflow: hidden; display: none;">
                                <div class="">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title">Alta de cuenta bancaria</h5>
                                            <p>Introduce los siguientes datos para dar de alta una cuenta bancaria</p>
                                        </div>
                                        <form class="row g-3 needs-validation" id="forms_cuenta_bancaria">
                                            <div class="row">
                                            <div class="col-lg-4">
                                                <div class="col-lg-12">
                                                    <label for="identificador_cuenta" class="form-label">Identificador de cuenta</label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="identificador_cuenta" class="form-control form-control-sm fontsize-input"
                                                            id="identificador_cuenta">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-6">
                                                    <label for="nombre_banco" class="form-label">Banco</label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="nombre_banco" class="form-control form-control-md fontsize-input"
                                                            id="nombre_banco">
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-6">
                                                    <label for="cuenta_divisa" class="form-label">Divisa</label>
                                                    <div class="input-group has-validation">
                                                        <input type="text" name="cuenta_divisa" class="form-control form-control-md fontsize-input"
                                                            id="cuenta_divisa">
                                                            
                                                    </div>
                                                </div>
                                            </div>                            
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-7">
                                                <div class="col-lg-6">
                                                    <br>
                                                    <button class="btn boton_dos" type="button" id="guardar_cuenta"
                                                    >Crear cuenta bancaria</button>
                                                    </br>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="">
                                <div class="table-responsive m-auto pb-3 pt-4 row" id="div_tabla_cuentas_bancarias">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript" src="assets/js/cuentas_bancarias.js"></script>
</body>

<?php

}else{
    header("Location:?page=login");
}//Fin del else...*/
<?php
session_start();
include "assets/php/conexion.php";
include('menu.php');
//include "selects.php";
//include "funciones_agenda.php";

//if(!(empty($_SESSION["nombre_user"]))){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Configuración de Usuarios</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <script src="assets/js/jquery/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/FontAwesome.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="assets/js/usuarios.js"></script>
        <link rel="stylesheet" href="assets/css/FontAwesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css">
        <script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert2.min.css">
        <script type="text/javascript" src="assets/sweetalert/sweetalert2.min.js" ></script>

        <style>
        </style> 
    </head>
    
    <body onload="cargar_tabla_usuarios();">

    <?php
    menu();
    ?>

    <main id="main" class="main">

    <div class="pagetitle">
    <h1>Configuración de usuarios</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
        <li class="breadcrumb-item">Usuarios</li>
        <li class="breadcrumb-item active">Agregar usuarios</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->

        <section class="container-fluid text-justify">
            <form method='POST' action='?page=usuarios_acuse' target='_blank'>
                
                <br>
                <div class="form-group row">
                    <div class="col-sm-8 text-left">
                        <input type="button" name="agregar_usuario" id="agregar_usuario" class="btn btn-primary texto_boton" value="Agregar" onclick="mostrar_formato_usuarios();"></input>
                        <input type="button" name="cancelar" id="cancelar" class="btn btn-danger texto_boton" value="Cancelar" onclick="cancelar_formato_usuarios();"></input>
                        <!--<button type='submit' name='imprimir_reporte_usuario' id='imprimir_reporte_usuario' class='btn boton_editar btn-sm' >Imprimir</button> <br><br>-->
                    </div>
                </div>
                <div class="form-group text-justify" id="formato_usuario" style="overflow: hidden; display: none;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title">Crear una Cuenta</h5>
                                <p>Introduce los siguientes datos para crear la cuenta de usuario</p>
                            </div>
                            <form class="row g-3 needs-validation">
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <label for="usuario" class="form-label">Usuario</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="usuario" class="form-control form-control-sm" id="usuario">                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <br>
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                        </br>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <label for="nombre_usuario" class="form-label">Nombre</label>
                                        <input type="text" name="name" class="form-control" id="nombre_usuario">
                                    </div>
                                </div>
                                
                                <div class="col-lg-7">
                                    <div class="col-lg-6">
                                        <br>
                                        <button class="btn btn-primary texto_boton" type="button" id="guardar_usuario" onclick="guardar_formato_usuario();">Crear usuario</button>
                                        </br>  
                                    </div>      
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="table-responsive" id="div_tabla_usuarios">
                    </div>
                </div>
            </form>
        </section>
    </body>

<?php

/*}else{
	header("Location:?page=login");
}//Fin del else...*/
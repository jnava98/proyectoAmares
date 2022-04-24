<?php
/*
Función: cargar_contratos.php
Invocada por: js/clientes.js/cargar_formato_impresion()
Objetivo: Carga el formato para la impresion del contrato.
*/
session_start();
include "../conexion.php";
include "../selects.php";
include "../funciones.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

$respuesta=Array();
if($id_contrato!="0"){
    $respuesta['valor']="ok";
    $respuesta['formato']=mostrar_formato_impresion($id_contrato);
}else{
    $respuesta['valor']="No se encontró ningún contrato";
}//Fin del else
echo json_encode($respuesta);
?>
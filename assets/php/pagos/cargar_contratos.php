<?php
/*
Función: cargar_contratos.php
Invocada por: js/pagos.js/trae_contratos_cliente()
Objetivo: Trae todos los contratos que tiene un cliente.
*/
session_start();
include "../conexion.php";
include "../funciones.php";

if(empty($_GET["id_cliente"])){
	$id_cliente="0";
}else{
	$id_cliente=$_GET["id_cliente"];
}//Fin del else

$response=Array();

$sql="SELECT c.id_cliente, co.id_contrato, co.fecha_contrato, lo.fase, lo.super_manzana, lo.mza, lo.lote 
from clientes as c 
inner join cliente_contrato as cc 
ON c.id_cliente = cc.id_cliente 
inner join contrato as co 
on cc.id_contrato = co.id_contrato 
inner join lotes_contrato as lc 
on co.id_contrato = lc.id_contrato 
inner join lotes as lo 
on lc.id_lote = lo.id_lote 
WHERE c.id_cliente LIKE '".$id_cliente."' order by co.id_contrato"; //Consultar id de la variable
//echo $sql;
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
//Validamos que existan los contratos
if($num>0){
	$html="";
	$i=1;
	$html.="<h5 class='card-title'>Contratos del cliente</h5>"; 
	$html.="<table id='tabla_contratos' class='table table-responsive table-bordered table-striped table-hover table-condensed'>";
		$html.="<thead class='thead-dark'>";
			$html.="<tr>";
				$html.="<th style='text-align:center'>#</th>";
				$html.="<th style='text-align:center'>Lotes Comprados</th>";
				$html.="<th style='text-align:center'>Fecha Contrato</th>";
				$html.="<th style='text-align:center'>Acciones</th>";
			$html.="</tr>";
		$html.="</thead>";
		$html.="<tbody>";
	while($col=mysqli_fetch_array($result)){
		$html.="<tr>";
			$html.="<td style='text-align:center'>".$i."</td>";
			$html.="<td style='text-align:center'><input disabled='disabled' class='form-control' value='(".$col['fase']."-".$col['super_manzana']."-".$col['mza']."-".$col['lote'].")'></input></td>";
			$html.="<td style='text-align:center'><input disabled='disabled' class='form-control' value='".$col['fecha_contrato']."'></input></td>";
			//Botones para las acciones
			$html.="<td style='text-align:center'>";
				$html.="<button class='btn btn-success' data-id_contrato='".$col['id_contrato']."' id='".$col['id_contrato']."' onclick='consulta_historial_pagos(this.dataset.id_contrato);'><i class='ri-money-dollar-circle-fill';></i></button>";
			$html.="</td>";
		$html.="</tr>";
		$i++;
	}//Fin del while
	$response['html']= $html;
	$response['existe']=1;
}else{
    $response['existe']=0;
}//Fin del else
echo json_encode($response);


?>
<?php
	include "assets/php/conexion.php";
	include "assets/php/reportes/funciones_reportes.php";

	if(empty($_POST["tipo_reporte"])){
		$tipo_reporte="0";
	}else{
		$tipo_reporte=$_POST["tipo_reporte"];
	}//Fin del else

	header("Content-Type: application/xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	

	
	
	switch ($tipo_reporte){
		case "clientes":
			header("Content-Disposition: attachment; filename=reporte_clientes_" . date('Y:m:d').".xls");
			reporte_clientes();
			break;
		case "lotes":
			header("Content-Disposition: attachment; filename=reporte_lotes_" . date('Y:m:d').".xls");
			reporte_lotes();
			break;
	}//fin del switch
	
?>
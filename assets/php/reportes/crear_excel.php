<?php
	include "assets/php/conexion.php";
	include "assets/php/reportes/funciones_reportes.php";

	if(empty($_POST["select_tipo_reporte"])){
		$tipo_reporte="0";
	}else{
		$tipo_reporte=$_POST["select_tipo_reporte"];
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
		case "ventas_mensuales":
			header("Content-Disposition: attachment; filename=reporte_lotes_" . date('Y:m:d').".xls");
			if(empty($_POST["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_POST["fecha_uno"]; }//Fin del else
			if(empty($_POST["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_POST["fecha_dos"]; }//Fin del else
			reporte_ventas_mensuales($fecha_uno, $fecha_dos);
			break;
	}//fin del switch
	
?>
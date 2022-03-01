<?php
	include "../conexion.php";
	include "funciones_reportes.php";

	if(empty($_GET["tipo_reporte"])){
		$tipo_reporte="0";
	}else{
		$tipo_reporte=$_GET["tipo_reporte"];
	}//Fin del else
    $respuesta=Array();
	switch ($tipo_reporte){
		case "clientes":
            $respuesta['valor']="ok";
            $respuesta['tabla']=reporte_clientes();
            $respuesta['id_tabla']="tabla_clientes";
			break;
		case "lotes":
            $respuesta['valor']="ok";
            $respuesta['tabla']=reporte_lotes();
            $respuesta['id_tabla']="tabla_lotes";
			break;
		case "ventas_mensuales":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
            $respuesta['valor']="ok";
            $respuesta['tabla']=reporte_ventas_mensuales($fecha_uno, $fecha_dos);
            $respuesta['id_tabla']="tabla_reporte_ventas_mensuales";
			break;
	}//fin del switch
    echo json_encode($respuesta);
	
?>
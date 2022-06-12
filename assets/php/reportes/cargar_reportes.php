<?php
/*
Función: cargar_reportes.php
Invocada por: js/reportes.js/cargar_tabla_repotes()
Objetivo: Carga el reporte seleccionado en el select.
*/
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
            $respuesta['id_tabla']="tabla_reportes";
			break;
		case "lotes":
            $respuesta['valor']="ok";
            $respuesta['tabla']=reporte_lotes();
            $respuesta['id_tabla']="tabla_reportes";
			break;
		case "ingresos_unidades":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
			if(($fecha_uno=="0")||($fecha_dos=="0")){
				$respuesta['valor']="Debes seleccionar ambas fechas";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=reporte_ingresos_unidades($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
		case "ingresos":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
		if(($fecha_uno=="0")||($fecha_dos=="0")){
				$respuesta['valor']="Debes seleccionar ambas fechas";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=reporte_ingresos($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
		case "ingresos_ambos":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
			if(($fecha_uno=="0")||($fecha_dos=="0")){
				$respuesta['valor']="Debes seleccionar ambas fechas";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=reporte_ingresos_ambos($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
		case "reservas_mensuales":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
			if(($fecha_uno=="0")&&($fecha_dos=="0")){
				$respuesta['valor']="error";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=reporte_reservas_mensuales($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
		case "reservas_pendientes":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
			if(($fecha_uno=="0")&&($fecha_dos=="0")){
				$respuesta['valor']="error";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=reporte_reservas_pendientes($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
		case "contratos_elaborados":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
			if(($fecha_uno=="0")&&($fecha_dos=="0")){
				$respuesta['valor']="error";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=contratos_elaborados($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
		case "promesas_contratos":
			if(empty($_GET["fecha_uno"])){ $fecha_uno="0"; }else{ $fecha_uno=$_GET["fecha_uno"]; }//Fin del else
			if(empty($_GET["fecha_dos"])){ $fecha_dos="0"; }else{ $fecha_dos=$_GET["fecha_dos"]; }//Fin del else
			if(($fecha_uno=="0")&&($fecha_dos=="0")){
				$respuesta['valor']="error";
			}else{
				$respuesta['valor']="ok";
				$respuesta['tabla']=promesas_contratos($fecha_uno, $fecha_dos);
				$respuesta['id_tabla']="tabla_reportes";
			}//fin del else
			break;
	}//fin del switch
    echo json_encode($respuesta);
?>
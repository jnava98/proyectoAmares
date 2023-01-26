<?php
/*
Función: cargar_reportes.php
Invocada por: js/reportes.js/cargar_tabla_repotes()
Objetivo: Carga el reporte seleccionado en el select.
*/
	require_once "assets/vendor/autoload.php";
	include "assets/php/conexion.php";
	include "assets/php/reportes/funciones_reportes.php";

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	$con = new PDO('mysql:host=condorconsultoria.com;dbname=condorc2_cobranza_amares', 'condorc2_test', '123456789');

	if(empty($_POST["select_tipo_reporte"])){
		$select_tipo_reporte="0";
	}else{
		$select_tipo_reporte=$_POST["select_tipo_reporte"];
	}//Fin del else

	if(empty($_POST["fecha_uno"])){ 
		$fecha_uno="0"; 
	}else{ 
		$fecha_uno=$_POST["fecha_uno"];
	}//Fin del else

	if(empty($_POST["fecha_dos"])){
		$fecha_dos="0"; 
	}else{
		$fecha_dos=$_POST["fecha_dos"]; 
	}//Fin del else
	
	$documento = new Spreadsheet();
	$documento
	->getProperties()
	->setLastModifiedBy('Amares Riviera Maya')
	->setTitle('Reportes')
	->setDescription('Reportes');

	$hojaDeReportes = $documento->getActiveSheet();
	$hojaDeReportes->setTitle("Reportes");

    $respuesta=Array();
	switch ($select_tipo_reporte){
		case "clientes":
			# Encabezado
			$encabezado = ["ID", "Nombre", "Apellidos", "Nacionalidad", "Correo", "Telefono"];
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			$consulta = "select * from clientes";
			$sentencia = $con->prepare($consulta, [
			PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
			]);
			$sentencia->execute();
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			while ($clientes = $sentencia->fetchObject()) {
				# Obtener registros de MySQL
				$id_cliente = $clientes->id_cliente;
				$nombre = $clientes->nombre;
				$apellido_paterno = $clientes->apellido_paterno;
				$apellido_materno = $clientes->apellido_materno;
				$nacionalidad = $clientes->nacionalidad;
				$correo = $clientes->correo;
				$telefono = $clientes->telefono;
				# Escribir registros en el documento
				$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $id_cliente);
				$hojaDeReportes->setCellValueByColumnAndRow(2, $numeroDeFila, $nombre);
				$hojaDeReportes->setCellValueByColumnAndRow(3, $numeroDeFila, $apellido_paterno." ".$apellido_materno);
				$hojaDeReportes->setCellValueByColumnAndRow(4, $numeroDeFila, $nacionalidad);
				$hojaDeReportes->setCellValueByColumnAndRow(5, $numeroDeFila, $correo);
				$hojaDeReportes->setCellValueByColumnAndRow(6, $numeroDeFila, $telefono);
				$numeroDeFila++;
			}//fin del while
			$nombreDelDocumento = "Reporte_Clientes.xlsx";
			break;
		case "lotes":
			# Encabezado
			$encabezado = ["Fase", "Super Manzana", "Manzana", "Lote", "M2", "Precio Lista"];
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			$consulta = "select * from lotes";
			$sentencia = $con->prepare($consulta, [
			PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
			]);
			$sentencia->execute();
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			while ($lotes = $sentencia->fetchObject()) {
				# Obtener registros de MySQL
				$fase = $lotes->fase;
				$super_manzana = $lotes->super_manzana;
				$mza = $lotes->mza;
				$lote = $lotes->lote;
				$m2 = $lotes->m2;
				$precio_lista = $lotes->precio_lista;
				# Escribir registros en el documento
				$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $fase);
				$hojaDeReportes->setCellValueByColumnAndRow(2, $numeroDeFila, $super_manzana);
				$hojaDeReportes->setCellValueByColumnAndRow(3, $numeroDeFila, $mza);
				$hojaDeReportes->setCellValueByColumnAndRow(4, $numeroDeFila, $lote);
				$hojaDeReportes->setCellValueByColumnAndRow(5, $numeroDeFila, $m2);
				$hojaDeReportes->setCellValueByColumnAndRow(6, $numeroDeFila, $precio_lista);
				$numeroDeFila++;
			}//fin del while
			$nombreDelDocumento = "Reporte_Lotes.xlsx";
			break;
		case "ingresos_unidades":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Ventas + Reservas";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$sql="SELECT c.fecha_firma from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND fecha_enganche <> '0000-00-00' AND ((c.fecha_enganche>='".$periodo1."')AND(c.fecha_enganche<='".$periodo2."'))";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								$aux++;
								$total++;
							}//fin del while
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $aux);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Ingresos_Unidades.xlsx";
			break;
		case "ingresos":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Ventas + Reservas";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$sql="SELECT c.fecha_firma, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND fecha_enganche <> '0000-00-00' AND ((c.fecha_enganche>='".$periodo1."')AND(c.fecha_enganche<='".$periodo2."'))";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								$precio_venta = $col['precio_venta'];
								$aux+=$precio_venta;
								$total+=$precio_venta;
							}//fin del while
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $aux);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Ingresos.xlsx";
			break;
		case "ingresos_ambos":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Ventas + Reservas";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$encabezado[]= "Unidades";
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$contador_unidades = 0;
						$sql="SELECT c.fecha_firma, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND fecha_enganche <> '0000-00-00' AND ((c.fecha_enganche>='".$periodo1."')AND(c.fecha_enganche<='".$periodo2."'))";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								$precio_venta = $col['precio_venta'];
								$aux+=$precio_venta;
								$total+=$precio_venta;
								$contador_unidades++;
							}//fin del while
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $aux);
						$i++;
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $contador_unidades);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_IngresosyUnidades.xlsx";
			break;
		case "reservas_mensuales":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Reservas Mensuales";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$contador_unidades = 0;
						$sql="SELECT c.fecha_firma, c.fecha_contrato from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_enganche <> '0000-00-00' AND ((c.fecha_enganche>='".$periodo1."')AND(c.fecha_enganche<='".$periodo2."')) ";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								$contador_unidades++;
							}//fin del while
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $contador_unidades);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Reservas_Mensuales.xlsx";
			break;
		case "reservas_pendientes":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Reservas Pendientes";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$contador_unidades = 0;
						$sql="SELECT c.fecha_firma, c.fecha_contrato from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_firma LIKE '0000-00-00' AND c.fecha_contrato LIKE '0000-00-00' AND ((c.dia_pago>='".$periodo1."')AND(c.dia_pago<='".$periodo2."')) ";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								$contador_unidades++;
							}//fin del while
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $contador_unidades);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Reservas_Pendientes.xlsx";
			break;
		case "contratos_elaborados":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Reservas Pendientes";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$encabezado[]= "Precio Prom.";
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$contador_unidades = 0;
						$sql="SELECT c.fecha_firma, c.fecha_contrato, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_enganche <> '0000-00-00' AND ((c.fecha_enganche>='".$periodo1."')AND(c.fecha_enganche<='".$periodo2."')) ";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$contador_unidades++;
								$fecha_firma = $col['fecha_firma'];
								$precio_venta = $col['precio_venta'];
							}//fin del while
							$aux = $precio_venta/$contador_unidades;
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $contador_unidades);
						$i++;
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $aux);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Contratos_Elaborados.xlsx";
			break;
		case "promesas_contratos":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Reservas Pendientes";
			$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
			while($fecha1 <= $fecha2){
				$periodo = date("y",strtotime($fecha1));					
				$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
				$encabezado[]= $mes." ' ".$periodo;
				$encabezado[]= "Precio Prom.";
				$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
			}//fin del while
			$encabezado[] = "Total";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT * from cat_tipo_lote";
			$resultado_tipo_lote=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($resultado_tipo_lote);
			if($num>0){
				while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
					$total=0;
					# Escribir registros en el documento
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col_tipo_lote['nombre']);
					$i = 2;
					$fecha1 = $fecha_uno;
					$fecha2 = $fecha_dos;
					while($fecha1 <= $fecha2){
						$periodo = date("Y",strtotime($fecha1));					
						$mes = date("m",strtotime($fecha1));
						$periodo1 = $periodo."-".$mes."-01";
						if(($mes=="01")||($mes=="03")||($mes=="05")||($mes=="07")||($mes=="08")||($mes=="10")||($mes=="12")){
							$dia = "31";
						}else{
							if(($mes=="02")){
								$dia = "28";
							}else{
								$dia = "30";
							}//fin del else
						}//fin del else
						$periodo2 = $periodo."-".$mes."-".$dia;
						$aux = 0;
						$contador_unidades = 0;
						$sql="SELECT c.fecha_firma, c.fecha_contrato, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_firma like '0000-00-00' AND c.fecha_contrato like '0000-00-00' AND ((c.dia_pago>='".$periodo1."')AND(c.dia_pago<='".$periodo2."')) ";
						$result = mysqli_query(conectar(),$sql);
						desconectar();
						$num = mysqli_num_rows($result);
						if($num>0){
							while($col=mysqli_fetch_array($result)){
								$contador_unidades++;
								$fecha_firma = $col['fecha_firma'];
								$precio_venta = $col['precio_venta'];
							}//fin del while
							$aux = $precio_venta/$contador_unidades;
						}//fin del if
						# Escribir registros en el documento
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $contador_unidades);
						$i++;
						$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $aux);
						$i++;
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
					$hojaDeReportes->setCellValueByColumnAndRow($i, $numeroDeFila, $total);
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Promesas_Contratos.xlsx";
			break;

		case "disponibilidad":
			# Encabezado
			$encabezado = array();
			$encabezado[]= "Identificador Lote";
			$encabezado[]= "Tipo Lote";
			$encabezado[]= "Nombre del cliente";
			$encabezado[]= "Fecha Reserva";
			$encabezado[]= "Fecha Firma";
			$encabezado[]= "Tipo de compra";
			$encabezado[]= "Estatus"; //Disponibilidad/vendido
			$encabezado[]= "Precio de Venta";
			# El último argumento es por defecto A1
			$hojaDeReportes->fromArray($encabezado, null, 'A1');
			# Comenzamos en la fila 2
			$numeroDeFila = 2;
			$sql="SELECT l.identificador, ctl.nombre as tipo_lote, c.id_contrato, c.precio_venta, c.fecha_contrato, c.fecha_firma, ctc.nombre as tipo_compra from lotes as l inner join cat_tipo_lote as ctl on l.id_tipo_lote = ctl.id_tipo_lote left join contrato as c on l.id_lote = c.id_lote inner join cat_tipo_compra as ctc on c.id_tipo_compra = ctc.id_tipo_compra";
			$result=mysqli_query(conectar(),$sql);
			desconectar();
			$num = mysqli_num_rows($result);
			if($num>0){
				while($col=mysqli_fetch_array($result)){
					# Escribir registros en el documento
					$estatus = "";
					$hojaDeReportes->setCellValueByColumnAndRow(1, $numeroDeFila, $col['identificador']);
					$hojaDeReportes->setCellValueByColumnAndRow(2, $numeroDeFila, $col['tipo_lote']);
					$fecha_contrato=date("d/m/Y",strtotime($col["fecha_contrato"]));
					$hojaDeReportes->setCellValueByColumnAndRow(4, $numeroDeFila, $fecha_contrato);
					$fecha_firma=date("d/m/Y",strtotime($col["fecha_firma"]));
					$hojaDeReportes->setCellValueByColumnAndRow(5, $numeroDeFila, $fecha_firma);
					$hojaDeReportes->setCellValueByColumnAndRow(6, $numeroDeFila, $col['tipo_compra']);
					if($col["id_contrato"]!=""){
						$estatus = "Vendido";
					}else{
						$estatus = "Disponible";
					}//fin del else
					$hojaDeReportes->setCellValueByColumnAndRow(7, $numeroDeFila, $estatus);
					$hojaDeReportes->setCellValueByColumnAndRow(8, $numeroDeFila, $col['precio_venta']);
					$sql = "SELECT c.nombre, c.apellido_paterno, c.apellido_materno from cliente_contrato as cc inner join clientes as c on cc.id_cliente = c.id_cliente where cc.id_contrato like '".$col["id_contrato"]."'";
					$result_cliente = mysqli_query(conectar(),$sql);
					desconectar();
					$num_cliente = mysqli_num_rows($result_cliente);
					if($num_cliente > 0){
						$cliente = "";
						$aux = 1;
						while($col_cliente = mysqli_fetch_array($result_cliente)){
							if($aux == 1){
								$cliente.= $col_cliente["nombre"]." ".$col_cliente["apellido_paterno"]." ".$col_cliente["apellido_materno"];
							}else{
								$cliente.= ", ".$col_cliente["nombre"]." ".$col_cliente["apellido_paterno"]." ".$col_cliente["apellido_materno"];
							}//else
							$aux++;
						}//while
						$hojaDeReportes->setCellValueByColumnAndRow(3, $numeroDeFila, $cliente);
					}else{
						$hojaDeReportes->setCellValueByColumnAndRow(3, $numeroDeFila, "No disponible");
					}//else
					$numeroDeFila++;
				}//fin del while
			}//fin del if
			$nombreDelDocumento = "Reporte_Disponibilidad.xlsx";
		break;
		}//fin del switch
    #Exportar archivo y que se abra
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$nombreDelDocumento.'"');
	header('Cache-Control: max-age=0');
	$writer = new Xlsx($documento);
	$writer->save('php://output');
?>
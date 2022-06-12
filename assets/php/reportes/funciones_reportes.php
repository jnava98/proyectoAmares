<?php
function reporte_clientes(){
    $html = "";
	$sql="SELECT * from clientes";
	$result=mysqli_query(conectar(),$sql);
	desconectar();
	$num = mysqli_num_rows($result);
	if($num>0){
		$html .="
			<table id='tabla_clientes' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
				<thead>
					<tr>
						<th style='text-align:center'>ID</th>
						<th style='text-align:center'>Nombre</th>
						<th style='text-align:center'>Apellidos</th>
						<th style='text-align:center'>Nacionalidad</th>
						<th style='text-align:center'>Correo</th>
						<th style='text-align:center'>Telefono</th>
					</tr>
				</thead>
				<tbody>
		";
		while($col = mysqli_fetch_array($result)){
		$html .= "
			<tr>
				<td style='text-align:center;'>".$col['id_cliente']."</td>
				<td style='text-align:center;'>".$col['nombre']."</td>
				<td style='text-align:center;'>".$col['apellido_paterno']." ".$col['apellido_materno']."</td>
				<td style='text-align:center;'>".$col['nacionalidad']."</td>
				<td style='text-align:center;'>".$col['correo']."</td>
				<td style='text-align:center;'>".$col['telefono']."</td>
			</tr>
		";
		}//fin del while
		$html .="
				</tbody>
				
			</table>
		";
	}//fin del if
	return $html;
}//fin de reporte clientes

function reporte_lotes(){
    $html = "";
	$sql="SELECT * from lotes";
	$result=mysqli_query(conectar(),$sql);
	desconectar();
	$num = mysqli_num_rows($result);
	if($num>0){
		$html .="
			<table id='tabla_lotes' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
				<thead>
					<tr>
						<th style='text-align:center'>Fase</th>
						<th style='text-align:center'>Super Manzana</th>
						<th style='text-align:center'>Manzana</th>
						<th style='text-align:center'>Lote</th>
						<th style='text-align:center'>M2</th>
						<th style='text-align:center'>Precio Lista</th>
					</tr>
				</thead>
				<tbody>
		";
		while($col = mysqli_fetch_array($result)){
		$html .= "
				<tr>
					<td style='text-align:center;'>".$col['fase']."</td>
					<td style='text-align:center;'>".$col['super_manzana']."</td>
					<td style='text-align:center;'>".$col['mza']."</td>
					<td style='text-align:center;'>".$col['lote']."</td>
					<td style='text-align:center;'>".$col['m2']."</td>
					<td style='text-align:center;'>".$col['precio_lista']."</td>
				</tr>
		";
		}//fin del while
		
		$html .="
				</tbody>
			</table>
		";
	}//fin del if
	return $html;
}//fin de reporte clientes

function obtener_nombre_mes($numero_mes){
	$respuesta="";
	switch ($numero_mes){
		case "1":
			$respuesta = "Ene";
			break;
		case "2":
			$respuesta = "Feb";
			break;
		case "3":
			$respuesta = "Mar";
			break;
		case "4":
			$respuesta = "Abr";
			break;
		case "5":
			$respuesta = "May";
			break;
		case "6":
			$respuesta = "Jun";
			break;
		case "7":
			$respuesta = "Jul";
			break;
		case "8":
			$respuesta = "Ago";
			break;
		case "9":
			$respuesta = "Sep";
			break;
		case "10":
			$respuesta = "Oct";
			break;
		case "11":
			$respuesta = "Nov";
			break;
		case "12":
			$respuesta = "Dic";
			break;
	}//fin del switch
	return $respuesta;
}//fin de obtener nombre mes

function reporte_ingresos($fecha_uno, $fecha_dos){
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<br>";
	$html.="<h4>Reporte Ingresos</h4>"; 
	$html .="
		<table id='tabla_reporte_ingresos' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
			<thead>
				<tr>
					<th style='text-align:center;'>Ventas + Reservas</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='text-align:center;'>".$mes." ' ".$periodo."</th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="<th style='text-align:center;'>Total</th>
				</tr>
			</thead>
			<tbody>";
				$sql="SELECT * from cat_tipo_lote";
				$resultado_tipo_lote=mysqli_query(conectar(),$sql);
				desconectar();
				$num = mysqli_num_rows($resultado_tipo_lote);
				if($num>0){
					while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
						$html.="<tr>";
							$total=0;
							$html.="<td style='text-align:center;'>".$col_tipo_lote['nombre']."</td>";
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
									$sql="SELECT c.fecha_firma, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND fecha_firma <> '0000-00-00' AND ((c.fecha_firma>='".$periodo1."')AND(c.fecha_firma<='".$periodo2."'))";
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
									$html.="<td style='text-align:center;'>".$aux."</td>";
									$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
								}//fin del while
							$html.="<td style='text-align:center;'>".$total."</td>";
						$html.="</tr>";
					}//fin del while
				}//fin del if
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas y reservas

function reporte_ingresos_unidades($fecha_uno, $fecha_dos){
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<br>";
	$html.="<h4>Reporte Ingresos Unidades</h4>"; 
	$html .="
		<table id='tabla_reporte_ingresos_unidades' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
			<thead>
				<tr>
					<th style='text-align:center;'>Ventas + Reservas</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='text-align:center;'>".$mes." ' ".$periodo."</th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="<th style='text-align:center;'>Total</th>
				</tr>
			</thead>
			<tbody>";
				$sql="SELECT * from cat_tipo_lote";
				$resultado_tipo_lote=mysqli_query(conectar(),$sql);
				desconectar();
				$num = mysqli_num_rows($resultado_tipo_lote);
				if($num>0){
					while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
						$html.="<tr>";
							$total=0;
							$html.="<td style='text-align:center;'>".$col_tipo_lote['nombre']."</td>";
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
									$sql="SELECT c.fecha_firma from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND fecha_firma <> '0000-00-00' AND ((c.fecha_firma>='".$periodo1."')AND(c.fecha_firma<='".$periodo2."'))";
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
									$html.="<td style='text-align:center;'>".$aux."</td>";
									$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
								}//fin del while
							$html.="<td style='text-align:center;'>".$total."</td>";
						$html.="</tr>";
					}//fin del while
				}//fin del if
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas

function reporte_ingresos_ambos($fecha_uno, $fecha_dos){
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<br>";
	$html.="<h4>Reporte Ingresos</h4>"; 
	$html .="
		<table id='tabla_reporte_ingresos' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
			<thead>
				<tr>
					<th style='text-align:center;'>Ventas + Reservas</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='text-align:center;'>".$mes." ' ".$periodo."</th>";
						$html.="<th style='text-align:center;'>Unidades</th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="<th style='text-align:center;'>Total</th>
				</tr>
			</thead>
			<tbody>";
				$sql="SELECT * from cat_tipo_lote";
				$resultado_tipo_lote=mysqli_query(conectar(),$sql);
				desconectar();
				$num = mysqli_num_rows($resultado_tipo_lote);
				if($num>0){
					while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
						$html.="<tr>";
							$total=0;
							$html.="<td style='text-align:center;'>".$col_tipo_lote['nombre']."</td>";
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
									$sql="SELECT c.fecha_firma, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_firma <> '0000-00-00' AND l.estatus LIKE '1' AND ((c.fecha_firma>='".$periodo1."')AND(c.fecha_firma<='".$periodo2."')) ";
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
									$html.="<td style='text-align:center;'>".$aux."</td>";
									$html.="<td style='text-align:center;'>".$contador_unidades."</td>";
									$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
								}//fin del while
							$html.="<td style='text-align:center;'>".$total."</td>";
						$html.="</tr>";
					}//fin del while
				}//fin del if
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas

function reporte_reservas_mensuales($fecha_uno, $fecha_dos){	
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<br>";
	$html.="<h4>Reporte Reservas Mensuales</h4>"; 
	$html .="
		<table id='tabla_reservas_mensuales' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
			<thead>
				<tr>
					<th style='text-align:center;'>Reservas Mensuales</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='text-align:center;'>".$mes." ' ".$periodo."</th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="<th style='text-align:center;'>Total</th>
				</tr>
			</thead>
			<tbody>";
				$sql="SELECT * from cat_tipo_lote";
				$resultado_tipo_lote=mysqli_query(conectar(),$sql);
				desconectar();
				$num = mysqli_num_rows($resultado_tipo_lote);
				if($num>0){
					while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
						$html.="<tr>";
							$total=0;
							$html.="<td style='text-align:center;'>".$col_tipo_lote['nombre']."</td>";
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
									$sql="SELECT c.fecha_firma, c.fecha_contrato from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_firma <> '0000-00-00' AND c.fecha_contrato <> '0000-00-00' AND l.estatus LIKE '1' AND ((c.fecha_firma>='".$periodo1."')AND(c.fecha_firma<='".$periodo2."')) ";
									$result = mysqli_query(conectar(),$sql);
									desconectar();
									$num = mysqli_num_rows($result);
									if($num>0){
										while($col=mysqli_fetch_array($result)){
											$fecha_firma = $col['fecha_firma'];
											$contador_unidades++;
										}//fin del while
									}//fin del if
									$html.="<td style='text-align:center;'>".$contador_unidades."</td>";
									$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
								}//fin del while
							$html.="<td style='text-align:center;'>".$total."</td>";
						$html.="</tr>";
					}//fin del while
				}//fin del if
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas y reservas

function reporte_reservas_pendientes($fecha_uno, $fecha_dos){
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<br>";
	$html.="<h4>Reporte Reservas Mensuales</h4>"; 
	$html .="
		<table id='tabla_reservas_mensuales' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
			<thead>
				<tr>
					<th style='text-align:center;'>Reservas Mensuales</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='text-align:center;'>".$mes." ' ".$periodo."</th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="<th style='text-align:center;'>Total</th>
				</tr>
			</thead>
			<tbody>";
				$sql="SELECT * from cat_tipo_lote";
				$resultado_tipo_lote=mysqli_query(conectar(),$sql);
				desconectar();
				$num = mysqli_num_rows($resultado_tipo_lote);
				if($num>0){
					while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
						$html.="<tr>";
							$total=0;
							$html.="<td style='text-align:center;'>".$col_tipo_lote['nombre']."</td>";
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
									$sql="SELECT c.fecha_firma, c.fecha_contrato from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_firma LIKE '0000-00-00' AND c.fecha_contrato LIKE '0000-00-00' AND l.estatus LIKE '1' AND ((c.fecha_firma>='".$periodo1."')AND(c.fecha_firma<='".$periodo2."')) ";
									$result = mysqli_query(conectar(),$sql);
									desconectar();
									$num = mysqli_num_rows($result);
									if($num>0){
										while($col=mysqli_fetch_array($result)){
											$fecha_firma = $col['fecha_firma'];
											$contador_unidades++;
										}//fin del while
									}//fin del if
									$html.="<td style='text-align:center;'>".$contador_unidades."</td>";
									$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
								}//fin del while
							$html.="<td style='text-align:center;'>".$total."</td>";
						$html.="</tr>";
					}//fin del while
				}//fin del if
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas y reservas

function contratos_elaborados($fecha_uno, $fecha_dos){
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<br>";
	$html.="<h4>Reporte Reservas Mensuales</h4>"; 
	$html .="
		<table id='tabla_contratos_elaborados' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer'>
			<thead>
				<tr>
					<th style='text-align:center;'>Reservas Mensuales</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='text-align:center;'>".$mes." ' ".$periodo."</th>";
						$html.="<th style='text-align:center;'></th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="<th style='text-align:center;'></th>
				</tr>
			</thead>
			<tbody>
			";	
				$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
				$html.="<th style='text-align:center;'></th>";
				while($fecha1 <= $fecha2){
					$periodo = date("y",strtotime($fecha1));					
					$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
					$html.="<th style='text-align:center;'>Lotes</th>";
					$html.="<th style='text-align:center;'>Precio Prom.</th>";
					$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
				}//fin del while
				$html.="<th style='text-align:center;'>Total</th>
			</tbody>
			<tbody>";
				$sql="SELECT * from cat_tipo_lote";
				$resultado_tipo_lote=mysqli_query(conectar(),$sql);
				desconectar();
				$num = mysqli_num_rows($resultado_tipo_lote);
				if($num>0){
					while($col_tipo_lote=mysqli_fetch_array($resultado_tipo_lote)){
						$html.="<tr>";
							$total=0;
							$html.="<td style='text-align:center;'>".$col_tipo_lote['nombre']."</td>";
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
									$sql="SELECT c.fecha_firma, c.fecha_contrato, c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE l.id_tipo_lote LIKE '".$col_tipo_lote['id_tipo_lote']."' AND c.fecha_firma <> '0000-00-00' AND c.fecha_contrato <> '0000-00-00' AND l.estatus LIKE '1' AND ((c.fecha_firma>='".$periodo1."')AND(c.fecha_firma<='".$periodo2."')) ";
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
									$html.="<td style='text-align:center;'>".$contador_unidades."</td>";
									$html.="<td style='text-align:center;'>$".$aux."</td>";
									$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
								}//fin del while
							$html.="<td style='text-align:center;'>".$total."</td>";
						$html.="</tr>";
					}//fin del while
				}//fin del if
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas y reservas
<?php
function reporte_clientes(){
    $html = "";
	$sql="SELECT * from clientes";
	$result=mysqli_query(conectar(),$sql);
	desconectar();
	$num = mysqli_num_rows($result);
	if($num>0){
		$html .="
			<table id='tabla_clientes' class='table.table-striped table-bordered table-hover table-condensed'>
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
			<table id='tabla_lotes' class='table.table-striped table-bordered table-hover table-condensed'>
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

function reporte_ventas_mensuales($fecha_uno, $fecha_dos){
	$html="";
	if(($fecha_uno!="0")&&($fecha_dos!="0")){
	$fecha1 = $fecha_uno; $fecha2 = $fecha_dos;
	$html.="<h4>Reporte Ventas Mensuales</h4>"; 
	$html .="
		<table id='tabla_reporte_ventas_mensuales' class='table.table-striped table-bordered table-hover table-condensed'>
			<thead>
				<tr>
					<th style='text-align:center;'>Ventas + Reservas</th>
				";
					while($fecha1 <= $fecha2){
						$periodo = date("y",strtotime($fecha1));					
						$mes = obtener_nombre_mes(date("m",strtotime($fecha1)));
						$html.="<th style='style='text-align:center;''>".$mes." ' ".$periodo."</th>";
						$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
					}//fin del while
				$html.="</tr>
			</thead>
			<tbody>";
				//Premium
				$html.="<tr>";
					$html.="<td style='text-align:center;'>Premium</td>";
					$sql="SELECT c.fecha_firma from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '1'";
					$result = mysqli_query(conectar(),$sql);
					desconectar();
					$num = mysqli_num_rows($result);
					if($num>0){
						$fecha1 = $fecha_uno;
						$fecha2 = $fecha_dos;
						while($fecha1 <= $fecha2){
							$periodo = date("y",strtotime($fecha1));					
							$mes = date("m",strtotime($fecha2));
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
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								if((strtotime(date("d-m-Y",$fecha_firma));>=strtotime(date("d-m-Y",$periodo1));)&&(strtotime(date("d-m-Y",$fecha_firma));<=strtotime(date("d-m-Y",$periodo2));)){
									$aux++;
								}//fin del if
							}//fin del while
							$html.="<td style='text-align:center;'>".$aux."</td>";
							$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
						}//fin del while
					}//fin del if
				$html.="</tr>";

				//Estandar
				$html.="<tr>";
					$html.="<td style='text-align:center;'>Estandar</td>";
					$sql="SELECT c.fecha_firma from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '2'";
					$result = mysqli_query(conectar(),$sql);
					desconectar();
					$num = mysqli_num_rows($result);
					if($num>0){
						$fecha1 = $fecha_uno;
						$fecha2 = $fecha_dos;
						while($fecha1 <= $fecha2){
							$periodo = date("y",strtotime($fecha1));					
							$mes = date("m",strtotime($fecha2));
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
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								if((strtotime(date("d-m-Y",$fecha_firma));>=strtotime(date("d-m-Y",$periodo1));)&&(strtotime(date("d-m-Y",$fecha_firma));<=strtotime(date("d-m-Y",$periodo2));)){
									$aux++;
								}//fin del if
							}//fin del while
							$html.="<td style='text-align:center;'>".$aux."</td>";
							$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
						}//fin del while
					}//fin del if
				$html.="</tr>";

				//Plus
				$html.="<tr>";
					$html.="<td style='text-align:center;'>Plus</td>";
					$sql="SELECT c.fecha_firma from contrato as c inner join lotes as l on c.id_lote = l.id_lote WHERE c.id_estatus_venta LIKE '1' AND l.id_tipo_lote LIKE '3'";
					$result = mysqli_query(conectar(),$sql);
					desconectar();
					$num = mysqli_num_rows($result);
					if($num>0){	
						$fecha1 = $fecha_uno;
						$fecha2 = $fecha_dos;
						while($fecha1 <= $fecha2){
							$periodo = date("y",strtotime($fecha1));					
							$mes = date("m",strtotime($fecha2));
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
							while($col=mysqli_fetch_array($result)){
								$fecha_firma = $col['fecha_firma'];
								if((strtotime(date("d-m-Y",$fecha_firma));>=strtotime(date("d-m-Y",$periodo1));)&&(strtotime(date("d-m-Y",$fecha_firma));<=strtotime(date("d-m-Y",$periodo2));)){
									$aux++;
								}//fin del if
							}//fin del while
							$html.="<td style='text-align:center;'>".$aux."</td>";
							$fecha1=date("Y-m-d",strtotime($fecha1."+ 1 month"));
						}//fin del while
					}//fin del if
				$html.="</tr>";
			$html.="</tbody>";
	}//fin del if
	return $html;
}//fin de reporte total ventas y reservas
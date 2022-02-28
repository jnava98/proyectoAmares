<?php
function reporte_clientes(){
    $html = "";
	$sql="SELECT * from clientes";
	$result=mysqli_query(conectar(),$sql);
	desconectar();
	$num = mysqli_num_rows($result);
	if($num>0){
		$html .="
			<table>
				<thead>
					<tr>
						<th style='background-color:#FFC300;'>ID</th>
						<th style='background-color:#FFC300;'>Nombre</th>
						<th style='background-color:#FFC300;'>Apellidos</th>
						<th style='background-color:#FFC300;'>Nacionalidad</th>
						<th style='background-color:#FFC300;'>Correo</th>
						<th style='background-color:#FFC300;'>Telefono</th>
					</tr>
				<tbody>
		";
		while($col = mysqli_fetch_array($result)){
		$html .= "
					<tr>
						<td>".$col['id_cliente']."</td>
						<td>".$col['nombre']."</td>
						<td>".$col['apellido_paterno']." ".$col['apellido_materno']."</td>
						<td>".$col['nacionalidad']."</td>
						<td>".$col['correo']."</td>
						<td>".$col['telefono']."</td>
					</tr>
		";
		}//fin del while
		
		$html .="
				</tbody>
				
			</table>
		";
		
		echo $html;
	}//fin del if
}//fin de reporte clientes

function reporte_lotes(){
    $html = "";
	$sql="SELECT * from lotes";
	$result=mysqli_query(conectar(),$sql);
	desconectar();
	$num = mysqli_num_rows($result);
	if($num>0){
		$html .="
			<table>
				<thead>
					<tr>
						<th style='background-color:#FFC300;'>Fase</th>
						<th style='background-color:#FFC300;'>Super Manzana</th>
						<th style='background-color:#FFC300;'>Manzana</th>
						<th style='background-color:#FFC300;'>Lote</th>
						<th style='background-color:#FFC300;'>M2</th>
						<th style='background-color:#FFC300;'>Precio Lista</th>
					</tr>
				<tbody>
		";
		while($col = mysqli_fetch_array($result)){
		$html .= "
					<tr>
						<td>".$col['fase']."</td>
						<td>".$col['super_manzana']."</td>
						<td>".$col['mza']."</td>
						<td>".$col['lote']."</td>
						<td>".$col['m2']."</td>
						<td>".$col['precio_lista']."</td>
					</tr>
		";
		}//fin del while
		
		$html .="
				</tbody>
				
			</table>
		";
		
		echo $html;
	}//fin del if
}//fin de reporte clientes
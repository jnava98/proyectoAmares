<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=reporte_clientes_" . date('Y:m:d').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	include "assets/php/conexion.php";
	
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
?>
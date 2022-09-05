<?php
include('../conexion.php');

if(empty($_GET["lote"])){
	$identificador="0";
}else{
	$identificador=$_GET["lote"];
}//Fin del else

$consulta = "SELECT l.id_lote, l.identificador, cli.id_cliente, cli.nombre, cli.apellido_paterno, cli.apellido_materno FROM lotes as l inner join contrato as c on l.id_lote = c.id_lote inner join cliente_contrato as cc on c.id_contrato = cc.id_contrato inner join clientes as cli on cc.id_cliente = cli.id_cliente WHERE l.identificador LIKE '%$identificador%'"; 
$resultado=mysqli_query(conectar(),$consulta);
desconectar();
while($row=mysqli_fetch_assoc($resultado)){
    $identificador_aux= $row['identificador'];
    $id_cliente= $row['id_cliente'];
    $nombre= $row['apellido_paterno']." ";
    $nombre.= $row['apellido_materno']." ";
    $nombre.= $row['nombre'];
    echo '<tr id="'.$id_cliente.'&'.$nombre.'" onclick="seleccionar_lote(this.id)">';
        echo '<td id="tdcliente_buscado">'.($identificador_aux.' - '.$nombre).'</td>';
    echo '</tr>';
}//fin del while
?>
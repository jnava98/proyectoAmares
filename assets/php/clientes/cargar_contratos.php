<?php
session_start();
include "../conexion.php";
include "../funciones.php";

if(empty($_GET["id_cliente"])){
	$id_cliente="0";
}else{
	$id_cliente=$_GET["id_cliente"];
}//Fin del else

$respuesta=Array();
$sql="SELECT c.id_cliente, cc.id_cliente_contrato, co.id_contrato from clientes as c inner join cliente_contrato as cc ON c.id_cliente = cc.id_cliente inner join contrato as co on cc.id_contrato = co.id_contrato  WHERE id_cliente LIKE '".$id_cliente."' order by co.id_contrato;" //Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
if($num>0){
    $respuesta['valor']="ok";
    $respuesta['tabla']=mostrar_tabla_contratos($id_cliente);
    $respuesta['id_tabla']="tabla_usuarios";
}else{
    $respuesta['valor']="¡No se encontró ningún contrato!";
}//Fin del else
echo json_encode($respuesta);
?>
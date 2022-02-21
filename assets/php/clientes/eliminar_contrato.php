<?php
session_start();
include "../conexion.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

$respuesta=Array();
$sql="DELETE from contrato where id_contrato LIKE '".$id_contrato."';" //Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
if($result){
    $respuesta['valor']="ok";
}else{
    $respuesta['valor']="error";
}//Fin del else
echo json_encode($respuesta);
?>
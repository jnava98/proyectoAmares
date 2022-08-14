<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_GET["id_cliente"])){
	$id_cliente="0";
}else{
	$id_cliente=$_GET["id_cliente"];
}//Fin del else

if(empty($_GET["id"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id"];
}//Fin del else

if(empty($_GET["input_cliente"])){
	$input_cliente="0";
}else{
	$input_cliente=$_GET["input_cliente"];
}//Fin del else

$respuesta=Array();
if(($id_cliente!="0")){
	if($id_contrato!="0"){
		$sql="SELECT * from contrato where id_contrato like '".$id_contrato."'";//Consultar id de la variable
		$result=mysqli_query(conectar(),$sql);
		desconectar();
		$num=mysqli_num_rows($result);
		if($result){
			$respuesta['valor']="ok";
			$respuesta['formato']=mostrar_formato_precontrato($id_contrato);
		}else{
			$respuesta['valor']="¡No se encontró ningún apartado para ese periodo!";
		}//Fin del else
	}else{
        $respuesta['valor']="ok";
        $respuesta['formato']=mostrar_formato_precontrato_vacio($input_cliente, $id_cliente);
	}//fin del else
}else{

}//fin del else
echo json_encode($respuesta);
?>
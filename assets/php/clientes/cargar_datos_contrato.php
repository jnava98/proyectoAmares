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

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

$respuesta=Array();
if(($id_cliente!="0")){
	if($id_contrato!="0"){
		$aux = validar_datos_precontrato($id_contrato);
		if($aux=="ok"){
			$sql="SELECT * from contrato where id_contrato like '".$id_contrato."'";//Consultar id de la variable
			$result=mysqli_query(conectar(),$sql);
			desconectar();
			$num=mysqli_num_rows($result);
			if($result){
				$respuesta['valor']="ok";
				$respuesta['formato']=mostrar_formato_contrato($id_contrato);
			}else{
				$respuesta['valor']="No se encontró ese contrato";
			}//Fin del else
		}else{
			$respuesta['valor']="error";
		}//fin del else 
	}else{
        $respuesta['valor']="error";
	}//fin del else
}else{
	$respuesta['valor']="error";
}//fin del else
echo json_encode($respuesta);
?>
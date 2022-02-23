<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_GET["cliente"])){
	$cliente="0";
}else{
	$cliente=$_GET["cliente"];
}//Fin del else

if(empty($_GET["id"])){
	$id_input="0";
}else{
	$id_input=$_GET["id"];
}//Fin del else


$respuesta=Array();
if(($cliente!="0")||($id_input!="0")){
	if($id_input=="buscar"){
		$sql="SELECT * from clientes where id_cliente like '".$cliente."'";//Consultar id de la variable
		$result=mysqli_query(conectar(),$sql);
		desconectar();
		$num=mysqli_num_rows($result);
		if($result){
			$respuesta['valor']="ok";
			$respuesta['formato']=mostrar_formato_cliente($cliente);
			$respuesta['id_cliente']=$cliente;
		}else{
			$respuesta['valor']="¡No se encontró ningún cliente!";
			$respuesta['id_cliente']="";
		}//Fin del else
	}else{
		$respuesta['valor']="ok";
		$respuesta['formato']=mostrar_formato_cliente_vacio();
		$respuesta['id_cliente']="";
	}//fin del else
}else{

}//fin del else
echo json_encode($respuesta);
?>
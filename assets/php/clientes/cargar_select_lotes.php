<?php
session_start();
include "../conexion.php";
include "../funciones.php";

if(empty($_GET["manzana"])){
	$manzana="0";
}else{
	$manzana=$_GET["manzana"];
}//Fin del else

if($manzana!="0"){
    //Validamos si existe el cliente
    $sql="SELECT DISTINCT lote from lotes where manzana LIKE '".$manzana."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta['valor']="ok";
		$respuesta['select']=select_lotes($manzana);
    }else{
        $respuesta['valor']="error";
    }//fin del else
}//fin del if

echo json_encode($respuesta);
?>
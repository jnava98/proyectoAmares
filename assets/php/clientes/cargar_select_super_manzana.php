<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_GET["fase"])){
	$fase="0";
}else{
	$fase=$_GET["fase"];
}//Fin del else

if($fase!="0"){
    //Validamos si existe el cliente
    $sql="SELECT DISTINCT super_manzana from lotes where fase LIKE '".$fase."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta['valor']="ok";
		$respuesta['select']=select_super_manzana($fase);
    }else{
        $respuesta['valor']="error";
    }//fin del else
}//fin del if

echo json_encode($respuesta);
?>
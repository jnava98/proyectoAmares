<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_GET["manzana"])){
	$manzana="0";
}else{
	$manzana=$_GET["manzana"];
}//Fin del else

if(empty($_GET["super_manzana"])){
	$super_manzana="0";
}else{
	$super_manzana=$_GET["super_manzana"];
}//Fin del else

if(empty($_GET["fase"])){
	$fase="0";
}else{
	$fase=$_GET["fase"];
}//Fin del else

if($manzana!="0"){
    //Validamos si existe el cliente
    $sql="SELECT DISTINCT lote from lotes where mza LIKE '".$manzana."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta['valor']="ok";
		$respuesta['select']=select_lotes($manzana, $super_manzana, $fase, "");
    }else{
        $respuesta['valor']="error";
    }//fin del else
}//fin del if

echo json_encode($respuesta);
?>
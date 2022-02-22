<?php
session_start();
include "../conexion.php";
include "../funciones.php";

if(empty($_GET["super_manzana"])){
	$super_manzana="0";
}else{
	$super_manzana=$_GET["super_manzana"];
}//Fin del else

if($super_manzana!="0"){
    //Validamos si existe el cliente
    $sql="SELECT DISTINCT mza from lotes where super_manzana LIKE '".$super_manzana."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta['valor']="ok";
		$respuesta['select']=select_manzana($super_manzana);
    }else{
        $respuesta['valor']="error";
    }//fin del else
}//fin del if

echo json_encode($respuesta);
?>
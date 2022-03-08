<?php
session_start();
include "../conexion.php";

if(empty($_GET["id_lote"])){
	$id_lote="0";
}else{
	$id_lote=$_GET["id_lote"];
}//Fin del else

$respuesta=Array();
if(($id_lote!="0")){
    $sql="SELECT precio_lista from lotes where id_lote like '".$id_lote."'";//Consultar id de la variable
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $respuesta['valor']="ok";
        $respuesta['precio_lista']=$col[0];
    }else{
        $respuesta['valor']="Error";
    }//Fin del else
}else{
    $respuesta['valor']="Error";
}//Fin del else
echo json_encode($respuesta);
?>
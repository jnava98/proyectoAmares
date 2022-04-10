<?php
session_start();
include "../conexion.php";

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

if(empty($_GET["fecha_contrato"])){
	$fecha_contrato="";
}else{
	$fecha_contrato=$_GET["fecha_contrato"];
}//Fin del else

if(empty($_GET["fecha_firma"])){
	$fecha_firma="";
}else{
	$fecha_firma=$_GET["fecha_firma"];
}//Fin del else

$respuesta=Array();

//Programar guardado para las tabla lotes-contrato, cliente-contrato

if(($id_contrato!="0")){
    //Validamos si existe el cliente
    $sql="SELECT * from contrato where id_contrato LIKE '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        //Si existe editamos
        $sql="UPDATE contrato set fecha_contrato = '".$fecha_contrato."', fecha_firma = '".$fecha_firma."' WHERE id_contrato LIKE '".$id_contrato."'";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
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
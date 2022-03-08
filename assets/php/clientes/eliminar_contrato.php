<?php
session_start();
include "../conexion.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

$respuesta=Array();
//Validamos si el contrato tiene pagos
$sql="SELECT * from pagos where id_contrato LIKE '".$id_contrato."'";
$result=mysqli_query(conectar(),$sql);
desconectar();
$num = mysqli_num_rows($result);
if($num>0){
    $respuesta['valor']="warning";
    $respuesta['mensaje']="Este contrato cuenta con pagos registrados, para poder eliminar el contrato, primero debes eliminar los pagos";
}else{
    $sql="DELETE from contrato where id_contrato LIKE '".$id_contrato."'"; //Consultar id de la variable
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    if($result){
        $respuesta['valor']="ok";
        $respuesta['mensaje']="Contrato eliminado";
    }else{
        $respuesta['valor']="error";
        $respuesta['mensaje']="Error";
    }//Fin del else
}//fin del else
echo json_encode($respuesta);
?>
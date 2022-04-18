<?php
session_start();
include "../conexion.php";
date_default_timezone_set ('America/Cancun');
$fecha_modificacion= date("Y-m-d H:i:s");

if(empty($_SESSION["id"])){
    $usuario_modificacion="0";
}else{
    $usuario_modificacion=$_SESSION["id"];
}

if(empty($_GET['id'])){
	$id="0";
}else{
    $id=trim($_GET['id']);
}//fin del else

if(empty($_GET['descripcion'])){
	$descripcion="0";
}else{
    $descripcion=trim($_GET['descripcion']);
}//fin del else

if(empty($_GET['tasa'])){
	$tasa="0";
}else{
    $tasa=trim($_GET['tasa']);
}//fin del else



$respuesta = Array();

if(($usuario_modificacion!="0")&&($id!="0")&&($descripcion!="0")&&($tasa!="0")){
    $sql="UPDATE cat_descuentos SET descripcion = '".$descripcion."', tasa = '".$tasa."', uum='".$usuario_modificacion."',fecha_modificacion='".$fecha_modificacion."' WHERE id_descuento = '".$id."'";
    //echo $sql;
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $respuesta['valor']="ok";
    $respuesta['mensaje']="Descuento actualizado";
}else{
    $respuesta['valor']="error";
}//fin del else

echo json_encode($respuesta);

?>
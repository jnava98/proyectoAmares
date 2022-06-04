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

if(empty($_GET['identificador'])){
	$identificador="0";
}else{
    $identificador=trim($_GET['identificador']);
}//fin del else

if(empty($_GET['banco'])){
	$banco="0";
}else{
    $banco=trim($_GET['banco']);
}//fin del else

if(empty($_GET['divisa'])){
	$divisa="0";
}else{
    $divisa=trim($_GET['divisa']);
}//fin del else



$respuesta = Array();

if(($usuario_modificacion!="0")&&($id!="0")&&($identificador!="0")&&($banco!="0")&&($divisa!="0")){
    $sql="UPDATE cat_cuentas_bancarias SET identificador_cuenta = '".$identificador."', banco = '".$banco."', divisa = '".$divisa."', uum='".$usuario_modificacion."',fecha_modificacion='".$fecha_modificacion."' WHERE id_cuenta_bancaria = '".$id."'";
    //echo $sql;
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $respuesta['valor']="ok";
    $respuesta['mensaje']="Cuenta bancaria actualizada";
}else{
    $respuesta['valor']="error";
}//fin del else

echo json_encode($respuesta);

?>
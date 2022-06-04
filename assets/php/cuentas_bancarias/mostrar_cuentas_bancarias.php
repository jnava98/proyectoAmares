<?php
session_start();
include "../conexion.php";
include "../funciones.php";

$respuesta=Array();
$sql="select * from cat_cuentas_bancarias";//Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
if($result){    
    $respuesta['valor']="ok";
    $respuesta['tabla']=mostrar_tabla_cuentas_bancarias();
    $respuesta['id_tabla']="tabla_cuentas_bancarias";
}else{
    $respuesta['valor']="¡No se encontró ningúna cuenta bancaria!";
    $respuesta['error']='error';
}//Fin del else
echo json_encode($respuesta);
?>
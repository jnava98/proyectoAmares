<?php
session_start();
include "../conexion.php";
include "../funciones.php";

$respuesta=Array();
$sql="select * from cat_descuentos";//Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
if($result){    
    $respuesta['valor']="ok";
    $respuesta['tabla']=mostrar_tabla_descuentos();
    $respuesta['id_tabla']="tabla_descuentos";
}else{
    $respuesta['valor']="¡No se encontró ningún descuento!";
    $respuesta['error']='error';
}//Fin del else
echo json_encode($respuesta);
?>
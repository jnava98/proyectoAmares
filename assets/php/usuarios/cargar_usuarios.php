<?php
session_start();
include "../conexion.php";
include "../funciones.php";

$respuesta=Array();
$sql="select * from cuentas_usuario order by usuario";//Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
if($result){
    $respuesta['valor']="ok";
    $respuesta['tabla']=mostrar_tabla_usuarios();
    $respuesta['id_tabla']="tabla_usuarios";
}else{
    $respuesta['valor']="¡No se encontró ningún usuario!";
}//Fin del else
echo json_encode($respuesta);
?>
<?php
session_start();
include "conexion.php";

if(empty($_GET['id'])){
	$id="0";
}else{
    $id=$_GET['id'];
}//fin del else

if(empty($_GET['usuario'])){
	$usuario="0";
}else{
    $usuario=$_GET['usuario'];
}//fin del else

if(empty($_GET['password'])){
	$password="0";
}else{
    $password=$_GET['password'];
}//fin del else

if(empty($_GET['nombre'])){
	$nombre="0";
}else{
    $nombre=$_GET['nombre'];
}//fin del else

$respuesta = Array();

if(($usuario!="0")&&($password!="0")&&($nombre!="0")){
    $sql="UPDATE cuentas_usuario SET usuario = '".$usuario."', nombre = '".$nombre."', password = '".$password."' WHERE id_usuario like '".$id."'";
    //echo $sql;
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $respuesta['valor']="ok";
    $respuesta['mensaje']="Usuario actualizado";
}else{
    $respuesta['valor']="error";
}//fin del else

echo json_encode($respuesta);

?>
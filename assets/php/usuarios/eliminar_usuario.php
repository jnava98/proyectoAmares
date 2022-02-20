<?php
session_start();
include "../conexion.php";
include "../funciones.php";


    if(empty($_GET["id"])){
		$id="0";
	}else{
		$id=$_GET["id"];
	}//Fin del else...
    $respuesta=Array();

    if($clave_empleado!="0"){
        $sql="DELETE from cuentas_usuario WHERE id_usuario like '".$id."'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $respuesta['valor']="Usuario eliminado";
    }
    echo json_encode($respuesta);
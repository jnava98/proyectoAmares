<?php
session_start();
    include "conexion.php";
	include "funciones_agenda.php";

    if(empty($_GET["usuario"])){
		$usuario="0";
	}else{
		$usuario=$_GET["usuario"];
	}//Fin del else...
    
    if(empty($_GET["nombre"])){
		$nombre="0";
	}else{
		$nombre=$_GET["nombre"];
	}//Fin del else...

    if(empty($_GET["password"])){
		$password="0";
	}else{
		$password=$_GET["password"];
	}//Fin del else..

    $respuesta=Array();

    if(($usuario!="0")&&($nombre!="0")&&($password!="0")){
        $sql="INSERT into cuentas_usuario (usuario, nombre, password) values ('".$usuario."', '".$nombre."', '".$password."')";
        //echo $sql;
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        if($result){
            $respuesta['valor']="ok";
            $respuesta['mensaje']="Usuario agregado con éxito";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        $respuesta['valor']="error";
    }//fin del else

    echo json_encode($respuesta);

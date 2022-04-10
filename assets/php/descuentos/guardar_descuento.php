<?php
session_start();
include "../conexion.php";
include "../funciones.php";
$fecha_creacion= date("Y-m-d H:i:s");
$fecha_modificacion= date("Y-m-d H:i:s");

$usuario_creacion=$_SESSION["id"];
$usuario_modificacion=$_SESSION["id"];

    if(empty($_POST["nombreDescuento"])){
		$nombre="0";
    }else{
        $nombre=$_POST["nombreDescuento"];
    }

    if(empty($_POST["tasaDescuento"])){
        $tasa="0";
    }else{
		$tasa=$_POST["tasaDescuento"];
	}//Fin del else...


    $respuesta=Array();

    if(($nombre!="0")&&($tasa!="0")){
        $sql="INSERT into cat_descuentos (descripcion, tasa, fecha_creacion,fecha_modificacion,uc,uum) values ('".$nombre."', '".$tasa."', '".$fecha_creacion."','".$fecha_modificacion."','".$usuario_creacion."','".$usuario_modificacion."')";
        //echo $sql;
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        if($result){
            $respuesta['valor']="ok";
            $respuesta['mensaje']="Descuento agregado con éxito";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        $respuesta['valor']="error";
    }//fin del else

    echo json_encode($respuesta);

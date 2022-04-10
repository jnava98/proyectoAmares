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

    if($id!="0"){
        $sql="DELETE from cat_descuentos WHERE id_descuento like '".$id."'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $respuesta['valor']="Descuento eliminado";
    }
    echo json_encode($respuesta);
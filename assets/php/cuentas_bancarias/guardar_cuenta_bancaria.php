<?php
session_start();
include "../conexion.php";
include "../funciones.php";
$fecha_creacion= date("Y-m-d H:i:s");
$fecha_modificacion= date("Y-m-d H:i:s");
date_default_timezone_set ('America/Cancun');
$usuario_creacion=$_SESSION["id"];
$usuario_modificacion=$_SESSION["id"];

    if(empty($_POST["identificador_cuenta"])){
		$identificador="0";
    }else{
        $identificador=trim($_POST["identificador_cuenta"]);
    }

    if(empty($_POST["nombre_banco"])){
        $banco="0";
    }else{
		$banco=trim($_POST["nombre_banco"]);
	}//Fin del else...

    
    if(empty($_POST["cuenta_divisa"])){
        $divisa="0";
    }else{
		$divisa=trim($_POST["cuenta_divisa"]);
	}//Fin del else...


    $respuesta=Array();

    if(($identificador!="0")&&($banco!="0")&&($divisa)){
        $sql="INSERT INTO cat_cuentas_bancarias (identificador_cuenta, banco, divisa, fecha_creacion,fecha_modificacion,uc,uum) values ('".$identificador."', '".$banco."', '".$divisa."', '".$fecha_creacion."','".$fecha_modificacion."','".$usuario_creacion."','".$usuario_modificacion."')";
        //echo $sql;
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        if($result){
            $respuesta['valor']="ok";
            $respuesta['mensaje']="Cuenta bancaria agregada con éxito";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        $respuesta['valor']="error";
    }//fin del else

    echo json_encode($respuesta);

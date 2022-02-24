<?php
session_start();
include "../conexion.php";

if(empty($_GET["id_cliente"])){
	$id_cliente="0";
}else{
	$id_cliente=$_GET["id_cliente"];
}//Fin del else

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

if(empty($_GET["cantidad_apartado"])){
	$cantidad_apartado="";
}else{
	$cantidad_apartado=$_GET["cantidad_apartado"];
}//Fin del else

if(empty($_GET["fecha_apartado"])){
	$fecha_apartado="";
}else{
	$fecha_apartado=$_GET["fecha_apartado"];
}//Fin del else

if(empty($_GET["cantidad_enganche"])){
	$cantidad_enganche="";
}else{
	$cantidad_enganche=$_GET["cantidad_enganche"];
}//Fin del else

if(empty($_GET["fecha_enganche"])){
	$fecha_enganche="";
}else{
	$fecha_enganche=$_GET["fecha_enganche"];
}//Fin del else

if(empty($_GET["mensualidad_enganche"])){
	$mensualidad_enganche="";
}else{
	$mensualidad_enganche=$_GET["mensualidad_enganche"];
}//Fin del else

if(empty($_GET["clientes"])){
	$clientes="";
}else{
	$clientes=$_GET["clientes"];
}//Fin del else

if(empty($_GET["lote"])){
	$lote="";
}else{
	$lote=$_GET["lote"];
}//Fin del else

$respuesta=Array();

//Programar guardado para las tabla lotes-contrato, cliente-contrato

if(($id_contrato!="0")){
    //Validamos si existe el cliente
    $sql="SELECT * from contrato where id_contrato LIKE '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        //Si existe editamos
        $sql="UPDATE contrato set cantidad_apartado = '".$cantidad_apartado."', fecha_apartado = '".$fecha_apartado."', cant_enganche = '".$cantidad_enganche."', fecha_enganche = '".$fecha_enganche."', mensualidades_enganche = '".$mensualidad_enganche."', clientes = '".$clientes."' where id_contrato LIKE '".$id_contrato."' ";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        //Si no existe el cliente insertamos
        $sql="INSERT into contrato (cantidad_apartado, fecha_apartado, cantidad_enganche, fecha_enganche, mensualidad_enganche, clientes) values ('".$cantidad_apartado."', '".$fecha_apartado."', '".$cantidad_enganche."', '".$fecha_enganche."', '".$mensualidad_enganche."', '".$clientes."')";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $sql="SELECT max(id_contrato) from contrato";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            $col = mysqli_fetch_array($result);
            $id_contrato = $col[0];
            $cadena = explode(",", $clientes);
            $array_size = count($cadena);
            for ($i = 1; $array_size; $i++) {
                $cliente = $cadena[$i];
                $cadena2 = explode(" ", $lotes);
                $sql="SELECT id_cliente FROM clientes WHERE apellido_paterno LIKE '".$cadena2[0]."' AND apellido_materno LIKE '".$cadena2[1]."'";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
                $col_cliente = mysqli_fetch_array($resultado);
                $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$col['id_cliente']."', '".$id_contrato."') ";
                $result=mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del for
            if($result){
                $sql="INSERT into lotes_contrato (id_lote, id_contrato) values ('".$lote."', '".$id_contrato."')";
                $result = mysqli_query(conectar(),$sql);
                desconectar();
                if($result){
                    $respuesta['valor']="ok";
                }else{
                    $respuesta['valor']="error4";
                }//fin del else
            }//fin del if
        }else{
            $respuesta['valor']="error3";
        }//fin del else
    }//fin del else
}else{
    $sql="INSERT into contrato (cantidad_apartado, fecha_apartado, cantidad_enganche, fecha_enganche, mensualidad_enganche, clientes) values ('".$cantidad_apartado."', '".$fecha_apartado."', '".$cantidad_enganche."', '".$fecha_enganche."', '".$mensualidad_enganche."', '".$clientes."')";
    $result=mysqli_query(conectar(),$sql);
    if($result){
        $sql="SELECT max(id_contrato) from contrato";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $col = mysqli_fetch_array($result);
        $id_contrato = $col[0];
        $cadena = explode(",", $clientes);
        $array_size = count($cadena);
        for ($i = 1; $array_size; $i++) {
            $cliente = $cadena[$i];
            $cadena2 = explode(" ", $lotes);
            $sql="SELECT id_cliente FROM clientes WHERE apellido_paterno LIKE '".$cadena2[0]."' AND apellido_materno LIKE '".$cadena2[1]."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $col_cliente = mysqli_fetch_array($resultado);
            $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$col['id_cliente']."', '".$id_contrato."') ";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
        }//fin del for
        if($result){
            $sql="INSERT into lotes_contrato (id_lote, id_contrato) values ('".$lote."', '".$id_contrato."')";
            $result = mysqli_query(conectar(),$sql);
            desconectar();
            if($result){
                $respuesta['valor']="ok";
            }else{
                $respuesta['valor']="error4";
            }//fin del else
        }//fin del if
    }else{
        $respuesta['valor']="error1";
    }//fin del else
}//fin del else

echo json_encode($respuesta);
?>
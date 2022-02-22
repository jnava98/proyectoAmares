<?php
session_start();
include "../conexion.php";

if(empty($_GET["id_cliente"])){
	$id_cliente="0";
}else{
	$id_cliente=$_GET["id_cliente"];
}//Fin del else

if(empty($_GET["nombre"])){
	$nombre="";
}else{
	$nombre=$_GET["nombre"];
}//Fin del else

if(empty($_GET["apellido_pa"])){
	$apellido_pa="";
}else{
	$apellido_pa=$_GET["apellido_pa"];
}//Fin del else

if(empty($_GET["apellido_ma"])){
	$apellido_ma="";
}else{
	$apellido_ma=$_GET["apellido_ma"];
}//Fin del else

if(empty($_GET["residencia"])){
	$residencia="";
}else{
	$residencia=$_GET["residencia"];
}//Fin del else

if(empty($_GET["nacionalidad"])){
	$nacionalidad="";
}else{
	$nacionalidad=$_GET["nacionalidad"];
}//Fin del else

if(empty($_GET["correo"])){
	$correo="";
}else{
	$correo=$_GET["correo"];
}//Fin del else

if(empty($_GET["telefono"])){
	$telefono="";
}else{
	$telefono=$_GET["telefono"];
}//Fin del else

if(empty($_GET["estado_civil"])){
	$estado_civil="";
}else{
	$estado_civil=$_GET["estado_civil"];
}//Fin del else

if(empty($_GET["actividad_economica"])){
	$actividad_economica="";
}else{
	$actividad_economica=$_GET["actividad_economica"];
}//Fin del else

$respuesta=Array();

//Programar guardado para las tabla lotes-contrato, cliente-contrato

if($id_cliente!="0"){
    //Validamos si existe el cliente
    $sql="SELECT * from clientes where id_cliente LIKE '".$id_cliente."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        //Si existe editamos
        $sql="UPDATE clientes set nombre = '".$nombre."', apellido_paterno = '".$apellido_pa."', apellido_materno = '".$apellido_ma."', residencia = '".$residencia."', nacionalidad = '".$nacionalidad."', correo = '".$correo."', telefono = '".$telefono."', estado_civil = '".$estado_civil."' actividad_economica = '".$actividad_economica."' ";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        //Si no existe el cliente insertamos
        $sql="INSERT into clientes (nombre, apellido_paterno, apellido_materno, residencia, nacionalidad, correo, telefono, estado_civil, act_economica) values ('".$nombre."', '".$apellido_pa."', '".$apellido_ma."', '".$residencia."', '".$nacionalidad."', '".$correo."', '".$telefono."', '".$estado_civil."', '".$actividad_economica."' )";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }//fin del else
}else{
    $sql="INSERT into clientes (nombre, apellido_paterno, apellido_materno, residencia, nacionalidad, correo, telefono, estado_civil, act_economica) values ('".$nombre."', '".$apellido_pa."', '".$apellido_ma."', '".$residencia."', '".$nacionalidad."', '".$correo."', '".$telefono."', '".$estado_civil."', '".$actividad_economica."' )";
    $result=mysqli_query(conectar(),$sql);
    if($result){
        $respuesta['valor']="ok";
    }else{
        $respuesta['valor']="error";
    }//fin del else
}//fin del else

echo json_encode($respuesta);
?>
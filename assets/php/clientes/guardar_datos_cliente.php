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

if(empty($_GET["direccion"])){
	$direccion="";
}else{
	$direccion=$_GET["direccion"];
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

if(empty($_GET["rfc"])){
	$rfc="";
}else{
	$rfc=$_GET["rfc"];
}//Fin del else

$respuesta=Array();

if($id_cliente!="0"){
    //Validamos si existe el cliente
    $sql="SELECT * from clientes where id_cliente LIKE '".$id_cliente."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        //Si existe editamos
        $sql="UPDATE clientes set nombre = '".trim($nombre)."', apellido_paterno = '".trim($apellido_pa)."', apellido_materno = '".trim($apellido_ma)."', residencia = '".trim($residencia)."', nacionalidad = '".trim($nacionalidad)."', correo = '".trim($correo)."', direccion='".trim($direccion)."', telefono = '".trim($telefono)."', estado_civil = '".trim($estado_civil)."', act_economica = '".trim($actividad_economica)."', rfc = '".trim($rfc)."' WHERE id_cliente LIKE '".$id_cliente."' ";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
            $respuesta['id_cliente']=$id_cliente;
            $respuesta['nombre_cliente']=$apellido_pa.' '.$apellido_ma.' '.$nombre;
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        //Si no existe el cliente insertamos
        $sql="INSERT into clientes (nombre, apellido_paterno, apellido_materno, residencia, nacionalidad, correo, direccion, telefono, estado_civil, act_economica, rfc) values ('".trim($nombre)."', '".trim($apellido_pa)."', '".trim($apellido_ma)."', '".trim($residencia)."', '".trim($nacionalidad)."', '".trim($correo)."', '".trim($direccion)."', '".trim($telefono)."', '".trim($estado_civil)."', '".trim($actividad_economica)."', '".trim($rfc)."' )";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
            $sql="SELECT max(id_cliente) FROM clientes";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            $col = mysqli_fetch_array($result);
            $id_cliente = $col[0];
            $respuesta['id_cliente']=$id_cliente;
            $respuesta['nombre_cliente']=$apellido_pa.' '.$apellido_ma.' '.$nombre;
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }//fin del else
}else{
    $sql="INSERT into clientes (nombre, apellido_paterno, apellido_materno, residencia, nacionalidad, correo, direccion, telefono, estado_civil, act_economica, rfc) values ('".$nombre."', '".$apellido_pa."', '".$apellido_ma."', '".$residencia."', '".$nacionalidad."', '".$correo."', '".$direccion."', '".$telefono."', '".$estado_civil."', '".$actividad_economica."', '".$rfc."' )";
    $result=mysqli_query(conectar(),$sql);
    if($result){
        $respuesta['valor']="ok";
        $sql="SELECT max(id_cliente) FROM clientes";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $col = mysqli_fetch_array($result);
        $id_cliente = $col[0];
        $respuesta['id_cliente']=$id_cliente;
        $respuesta['nombre_cliente']=$apellido_pa.' '.$apellido_ma.' '.$nombre;
    }else{
        $respuesta['valor']="error";
    }//fin del else
}//fin del else

echo json_encode($respuesta);
?>
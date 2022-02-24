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

if(empty($_GET["fecha_contrato"])){
	$fecha_contrato="";
}else{
	$fecha_contrato=$_GET["fecha_contrato"];
}//Fin del else

if(empty($_GET["fecha_firma"])){
	$fecha_firma="";
}else{
	$fecha_firma=$_GET["fecha_firma"];
}//Fin del else

if(empty($_GET["precio_venta"])){
	$precio_venta="";
}else{
	$precio_venta=$_GET["precio_venta"];
}//Fin del else

if(empty($_GET["tipo_compra"])){
	$tipo_compra="";
}else{
	$tipo_compra=$_GET["tipo_compra"];
}//Fin del else

if(empty($_GET["n_mensualidades"])){
	$n_mensualidades="";
}else{
	$n_mensualidades=$_GET["n_mensualidades"];
}//Fin del else

if(empty($_GET["monto_mensual"])){
	$monto_mensual="";
}else{
	$monto_mensual=$_GET["monto_mensual"];
}//Fin del else

if(empty($_GET["pago_final"])){
	$pago_final="";
}else{
	$pago_final=$_GET["pago_final"];
}//Fin del else

if(empty($_GET["estatus_venta"])){
	$estatus_venta="";
}else{
	$estatus_venta=$_GET["estatus_venta"];
}//Fin del else

if(empty($_GET["dia_pago"])){
	$dia_pago="";
}else{
	$dia_pago=$_GET["dia_pago"];
}//Fin del else

if(empty($_GET["nombre_descuento"])){
	$nombre_descuento="";
}else{
	$nombre_descuento=$_GET["nombre_descuento"];
}//Fin del else

if(empty($_GET["tasa"])){
	$tasa="";
}else{
	$tasa=$_GET["tasa"];
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
        $sql="UPDATE contrato set fecha_contrato = '".$fecha_contrato."', fecha_firma = '".$fecha_firma."', precio_venta = '".$precio_venta."', id_tipo_compra = '".$tipo_compra."', mensualidades = '".$n_mensualidades."', monto_mensual = '".$monto_mensual."', pago_final = '".$pago_final."', id_estatus_venta = '".$estatus_venta."', dia_pago = '".$dia_pago."', nombre_descuento = '".$nombre_descuento."', tasa = '".$tasa."' WHERE id_contrato LIKE '".$id_contrato."'";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        $respuesta['valor']="error";
    }//fin del else
}else{
    $respuesta['valor']="error";
}//fin del else

echo json_encode($respuesta);
?>
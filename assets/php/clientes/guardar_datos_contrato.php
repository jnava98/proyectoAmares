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

if(empty($_GET["txtArea_lotes"])){
	$txtArea_lotes="";
}else{
	$txtArea_lotes=$_GET["txtArea_lotes"];
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
echo $id_contrato;

//Programar guardado para las tabla lotes-contrato, cliente-contrato

if(($id_contrato!="0")){
    //Validamos si existe el cliente
    $sql="SELECT * from contrato where id_contrato LIKE '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        //Si existe editamos
        $sql="UPDATE contrato set fecha_contrato = '".$fecha_contrato."', fecha_firma = '".$fecha_firma."', precio_venta = '".$precio_venta."', id_tipo_compra = '".$tipo_compra."', cantidad_apartado = '".$cantidad_apartado."', fecha_apartado = '".$fecha_apartado."', cant_enganche = '".$cantidad_enganche."', fecha_enganche = '".$fecha_enganche."', mensualidades = '".$n_mensualidades."', monto_mensual = '".$monto_mensual."', pago_final = '".$pago_final."', id_estatus_venta = '".$estatus_venta."', dia_pago = '".$dia_pago."', nombre_descuento = '".$nombre_descuento."', tasa = '".$tasa."' ";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $respuesta['valor']="ok";
        }else{
            $respuesta['valor']="error";
        }//fin del else
    }else{
        //Si no existe el cliente insertamos
        $sql="INSERT into contrato (fecha_contrato, fecha_firma, precio_venta, id_tipo_compra, cant_apartado, fecha_apartado, cant_enganche, fecha_enganche, mensualidades, monto_mensual, pago_final, id_estatus_venta, dia_pago, nombre_descuento, tasa) values ('".$fecha_contrato."', '".$fecha_firma."', '".$precio_venta."', '".$tipo_compra."', '".$cantidad_apartado."', '".$fecha_apartado."', '".$cantidad_enganche."', '".$fecha_enganche."', '".$n_mensualidades."', '".$monto_mensual."', '".$pago_final."', '".$estatus_venta."', '".$dia_pago."', '".$nombre_descuento."', '".$tasa."' )";
        $result=mysqli_query(conectar(),$sql);
        if($result){
            $sql="SELECT max(id_contrato) from contrato";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            $col = mysqli_fetch_array($result);
            $id_contrato = $col[0];
            $cadena = explode(",", $txtArea_lotes);
            $array_size = count($cadena);
            $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$id_cliente."', '".$id_contrato."') ";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            if($result){
                for ($i = 1; $array_size; $i++) {
                    $lotes = $cadena[$i];
                    $cadena2 = explode("-", $lotes);
                    $sql="SELECT id_lote FROM lotes WHERE fase LIKE '".$cadena2[0]."' AND super_manzana LIKE '".$cadena2[1]."' AND mza LIKE '".$cadena2[2]."' AND lote LIKE '".$cadena2[3]."'";
                    $resultado = mysqli_query(conectar(),$sql);
                    desconectar();
                    $col_lotes = mysqli_fetch_array($resultado);
                    $sql="INSERT into lotes_contrato (id_lote, id_contrato) values ('".$col_lotes[0]."', '".$id_contrato."')";
                    $result = mysqli_query(conectar(),$sql);
                    desconectar();
                    if($result){
                        $respuesta['valor']="ok";
                    }else{
                        $respuesta['valor']="error4";
                    }//fin del else
                }//fin del for
            }//fin del if
        }else{
            $respuesta['valor']="error3";
        }//fin del else
    }//fin del else
}else{
    $sql="INSERT into contrato (fecha_contrato, fecha_firma, precio_venta, id_tipo_compra, cant_apartado, fecha_apartado, cant_enganche, fecha_enganche, mensualidades, monto_mensual, pago_final, id_estatus_venta, dia_pago, nombre_descuento, tasa) values ('".$fecha_contrato."', '".$fecha_firma."', '".$precio_venta."', '".$tipo_compra."', '".$cantidad_apartado."', '".$fecha_apartado."', '".$cantidad_enganche."', '".$fecha_enganche."', '".$n_mensualidades."', '".$monto_mensual."', '".$pago_final."', '".$estatus_venta."', '".$dia_pago."', '".$nombre_descuento."', '".$tasa."' )";
    $result=mysqli_query(conectar(),$sql);
    echo "sql 1".$sql;
    if($result){
        $sql="SELECT max(id_contrato) from contrato";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $col = mysqli_fetch_array($result);
        $id_contrato = $col[0];
        $cadena = explode(",", $txtArea_lotes);
        $array_size = count($cadena);
        $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$id_cliente."', '".$id_contrato."') ";
        echo "sql 2".$sql;
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        if($result){
            for ($i = 1; $array_size; $i++) {
                $lotes = $cadena[$i];
                $cadena2 = explode("-", $lotes);
                $sql="SELECT id_lote FROM lotes WHERE fase LIKE '".$cadena2[0]."' AND super_manzana LIKE '".$cadena2[1]."' AND mza LIKE '".$cadena2[2]."' AND lote LIKE '".$cadena2[3]."'";
                $resultado = mysqli_query(conectar(),$sql);
                echo "sql 2".$resultado;
                desconectar();
                $col_lotes = mysqli_fetch_array($resultado);
                $sql="INSERT into lotes_contrato (id_lote, id_contrato) values ('".$col_lotes[0]."', '".$id_contrato."')";
                $result = mysqli_query(conectar(),$sql);
                echo "sql 3".$result;
                desconectar();
                if($result){
                    $respuesta['valor']="ok";
                }else{
                    $respuesta['valor']="error2";
                }//fin del else
            }//fin del for
        }//fin del if
    }else{
        $respuesta['valor']="error1";
    }//fin del else
}//fin del else

echo json_encode($respuesta);
?>
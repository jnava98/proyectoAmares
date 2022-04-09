<?php
session_start();
include "../conexion.php";

if(empty($_GET["id_cliente"])){
	$id_cliente="0";
}else{
	$id_cliente=$_GET["id_cliente"];
}//Fin del else

if(empty($_GET["id_contrato"])){
	$id_contrato="";
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

if(empty($_GET["cant_mensual_enganche"])){
	$cant_mensual_enganche="";
}else{
	$cant_mensual_enganche=$_GET["cant_mensual_enganche"];
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

if(empty($_GET["dia_pago"])){
	$dia_pago="";
}else{
	$dia_pago=$_GET["dia_pago"];
}//Fin del else

if(empty($_GET["descuentos"])){
	$descuentos="";
}else{
	$descuentos=$_GET["descuentos"];
}//Fin del else

if(empty($_GET["tasa_interes"])){
	$tasa_interes="";
}else{
	$tasa_interes=$_GET["tasa_interes"];
}//Fin del else

if(empty($_GET["nombre_broker"])){
	$nombre_broker="";
}else{
	$nombre_broker=$_GET["nombre_broker"];
}//Fin del else

if(empty($_GET["comision_broker"])){
	$comision_broker="";
}else{
	$comision_broker=$_GET["comision_broker"];
}//Fin del else

if(empty($_GET["observaciones"])){
	$observaciones="";
}else{
	$observaciones=$_GET["observaciones"];
}//Fin del else

if(empty($_GET["descuentos"])){
	$desc_aplicados="";
}else{
	$desc_aplicados=$_GET["descuentos"];
}//Fin del else

if($fecha_apartado==""){
    $estatus_venta = "2";
}else{
    $estatus_venta = "3";
}//fin del else

//Fecha de hoy
$hoy = date("Y-m-d");

$respuesta=Array();

//Programar guardado para las tabla lotes-contrato, cliente-contrato
if(($id_contrato!="")){
    //Validamos si existe el cliente
    $sql="SELECT * from contrato where id_contrato LIKE '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        //Si existe editamos
        $col=mysqli_fetch_array($result);
        $clientes_antiguos = $col['clientes'];
        if($clientes_antiguos==$clientes){
            $sql="UPDATE contrato set cant_apartado = '".$cantidad_apartado."', fecha_apartado = '".$fecha_apartado."', cant_enganche = '".$cantidad_enganche."', fecha_enganche = '".$fecha_enganche."', mensualidades_enganche = '".$mensualidad_enganche."', clientes = '".$clientes."', precio_venta = '".$precio_venta."', id_tipo_compra = '".$tipo_compra."', mensualidades = '".$n_mensualidades."', monto_mensual = '".$monto_mensual."', pago_final = '".$pago_final."', id_estatus_venta = '".$estatus_venta."', dia_pago = '".$dia_pago."', tasa_interes = '".$tasa_interes."', nombre_broker = '".$nombre_broker."', comision_broker = '".$comision_broker."', observaciones = '".$observaciones."', id_lote = '".$lote."', cant_mensual_enganche = '".$cant_mensual_enganche."', fecha_modificacion = '".$hoy."', uum = '".$_SESSION["id"]."' where id_contrato LIKE '".$id_contrato."' ";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            if($result){
                //Se actualiza la parte de descuentos
                $sql="DELETE from descuentos_contrato where id_contrato LIKE '".$id_contrato."'";
                $result=mysqli_query(conectar(),$sql);
                desconectar();
                if($descuentos!="0"){
                    $cadena = explode(",", $desc_aplicados);
                    $array_size = count($cadena);
                    for ($i = 0; $i<$array_size; $i++) {
                        $descuento = $cadena[$i];
                        $sql="SELECT id_descuento FROM cat_descuentos WHERE descripcion LIKE '".$descuento."' ";
                        $resultado = mysqli_query(conectar(),$sql);
                        desconectar();
                        $col = mysqli_fetch_array($resultado);
                        $id_descuento = $col[0];
                        $sql="INSERT into descuentos_contrato (id_contrato, id_descuento) values ('".$id_contrato."', '".$id_descuento."')";
                        $resultado = mysqli_query(conectar(),$sql);
                        desconectar();
                    }//fin del for
                }//fin del if
                $respuesta['valor']="ok";
                $respuesta['id_contrato']=$id_contrato;
            }else{
                $respuesta['valor']="error";
            }//fin del else
        }else{
            $sql="UPDATE contrato set cant_apartado = '".$cantidad_apartado."', fecha_apartado = '".$fecha_apartado."', cant_enganche = '".$cantidad_enganche."', fecha_enganche = '".$fecha_enganche."', mensualidades_enganche = '".$mensualidad_enganche."', clientes = '".$clientes."', precio_venta = '".$precio_venta."', id_tipo_compra = '".$tipo_compra."', mensualidades = '".$n_mensualidades."', monto_mensual = '".$monto_mensual."', pago_final = '".$pago_final."', id_estatus_venta = '".$estatus_venta."', dia_pago = '".$dia_pago."', tasa_interes = '".$tasa_interes."', nombre_broker = '".$nombre_broker."', comision_broker = '".$comision_broker."', observaciones = '".$observaciones."', id_lote = '".$lote."', cant_mensual_enganche = '".$cant_mensual_enganche."', fecha_modificacion = '".$hoy."', uum = '".$_SESSION["id"]."' where id_contrato LIKE '".$id_contrato."' ";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            if($result){
                $sql="DELETE from cliente_contrato where id_contrato LIKE '".$id_contrato."'";
                $result=mysqli_query(conectar(),$sql);
                desconectar();
                if($result){
                    $cadena = explode(",", $clientes);
                    $array_size = count($cadena);
                    for ($i = 0; $i<$array_size; $i++){
                        $cliente = $cadena[$i];
                        $cadena2 = explode(" ", $cliente);
                        $sql="SELECT id_cliente FROM clientes WHERE apellido_paterno LIKE '".$cadena2[0]."' AND apellido_materno LIKE '".$cadena2[1]."'";
                        $resultado = mysqli_query(conectar(),$sql);
                        desconectar();
                        $col_cliente = mysqli_fetch_array($resultado);
                        $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$col_cliente['id_cliente']."', '".$id_contrato."') ";
                        $result=mysqli_query(conectar(),$sql);
                        desconectar();
                    }//fin del for
                    //Se actualiza la parte de descuentos
                    $sql="DELETE from descuentos_contrato where id_contrato LIKE '".$id_contrato."'";
                    $result=mysqli_query(conectar(),$sql);
                    desconectar();
                    if($descuentos!="0"){
                        $cadena = explode(",", $desc_aplicados);
                        $array_size = count($cadena);
                        for ($i = 0; $i<$array_size; $i++) {
                            $descuento = $cadena[$i];
                            $sql="SELECT id_descuento FROM cat_descuentos WHERE descripcion LIKE '".$descuento."' ";
                            $resultado = mysqli_query(conectar(),$sql);
                            desconectar();
                            $col = mysqli_fetch_array($resultado);
                            $id_descuento = $col[0];
                            $sql="INSERT into descuentos_contrato (id_contrato, id_descuento) values ('".$id_contrato."', '".$id_descuento."')";
                            $resultado = mysqli_query(conectar(),$sql);
                            desconectar();
                        }//fin del for
                    }//fin del if
                    $respuesta['valor']="ok";
                    $respuesta['id_contrato']=$id_contrato;
                }else{
                    $respuesta['valor']="error";
                }//fin del else
            }else{
                $respuesta['valor']="error";
            }//fin del else
        }//fin del else
    }else{
        $sql = "SELECT * from contrato where id_lote LIKE '".$lote."' AND clientes LIKE '".$clientes."'";
        $result = mysqli_query(conectar(),$sql);
        desconectar();
        $num = mysqli_num_rows($result);
        if($num>0){
            $respuesta['valor'] = "warning";
            $respuesta['mensaje']= "Ya se guardó este contrato";
        }else{
            $sql = "SELECT * from contrato where id_lote LIKE '".$lote."'";
            $result = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($result);
            if($num>0){
                $respuesta['valor'] = "warning";
                $respuesta['mensaje']= "Ya existe un contrato relacionado con este lote";
            }else{
                $sql="INSERT into contrato (cant_apartado, fecha_apartado, cant_enganche, fecha_enganche, mensualidades_enganche, clientes, id_lote, precio_venta, id_tipo_compra, mensualidades, monto_mensual, pago_final, dia_pago, tasa_interes, nombre_broker, comision_broker, observaciones, id_estatus_venta, cant_mensual_enganche, fecha_captura, fecha_modificacion, uc, uum) values ('".$cantidad_apartado."', '".$fecha_apartado."', '".$cantidad_enganche."', '".$fecha_enganche."', '".$mensualidad_enganche."', '".$clientes."', '".$lote."', '".$precio_venta."', '".$tipo_compra."', '".$n_mensualidades."', '".$monto_mensual."', '".$pago_final."', '".$dia_pago."', '".$tasa_interes."', '".$nombre_broker."', '".$comision_broker."', '".$observaciones."', '".$estatus_venta."', '".$cant_mensual_enganche."', '".$hoy."', '".$hoy."', '".$_SESSION["id"]."', '".$_SESSION["id"]."')";
                $result=mysqli_query(conectar(),$sql);
                desconectar();
                //echo $sql;
                if($result){
                    $sql="SELECT max(id_contrato) from contrato";
                    $result=mysqli_query(conectar(),$sql);
                    desconectar();
                    $col = mysqli_fetch_array($result);
                    $id_contrato = $col[0];
                    $cadena = explode(",", $clientes);
                    $array_size = count($cadena);
                    for ($i = 0; $i<$array_size; $i++) {
                        $cliente = $cadena[$i];
                        $cadena2 = explode(" ", $cliente);
                        $sql="SELECT id_cliente FROM clientes WHERE apellido_paterno LIKE '".$cadena2[0]."' AND apellido_materno LIKE '".$cadena2[1]."'";
                        $resultado = mysqli_query(conectar(),$sql);
                        desconectar();
                        $col_cliente = mysqli_fetch_array($resultado);
                        $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$col_cliente['id_cliente']."', '".$id_contrato."') ";
                        $result=mysqli_query(conectar(),$sql);
                        desconectar();
                    }//fin del for
                    //Se actualiza la parte de descuentos
                    if($descuentos!="0"){
                        $cadena = explode(",", $desc_aplicados);
                        $array_size = count($cadena);
                        for ($i = 0; $i<$array_size; $i++) {
                            $descuento = $cadena[$i];
                            $sql="SELECT id_descuento FROM cat_descuentos WHERE descripcion LIKE '".$descuento."' ";
                            $resultado = mysqli_query(conectar(),$sql);
                            desconectar();
                            $col = mysqli_fetch_array($resultado);
                            $id_descuento = $col[0];
                            $sql="INSERT into descuentos_contrato (id_contrato, id_descuento) values ('".$id_contrato."', '".$id_descuento."')";
                            $resultado = mysqli_query(conectar(),$sql);
                            desconectar();
                        }//fin del for
                    }//fin del if
                    if($result){
                        $respuesta['valor']="ok";
                        $respuesta['id_contrato']=$id_contrato;
                    }else{
                        $respuesta['valor']="error";
                    }//fin del else
                }else{
                    $respuesta['valor']="error";
                }//fin del else
            }//fin del else
        }//fin del else
    }//fin del else
}else{
    $sql = "SELECT * from contrato where id_lote LIKE '".$lote."' AND clientes LIKE '".$clientes."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $respuesta['valor'] = "warning";
        $respuesta['mensaje']= "Ya se guardó este contrato";
    }else{
        $sql = "SELECT * from contrato where id_lote LIKE '".$lote."'";
        $result = mysqli_query(conectar(),$sql);
        desconectar();
        $num = mysqli_num_rows($result);
        if($num>0){
            $respuesta['valor'] = "warning";
            $respuesta['mensaje']= "Ya existe un contrato relacionado con este lote";
        }else{
            $sql="INSERT into contrato (cant_apartado, fecha_apartado, cant_enganche, fecha_enganche, mensualidades_enganche, clientes, id_lote, precio_venta, id_tipo_compra, mensualidades, monto_mensual, pago_final, dia_pago, tasa_interes, nombre_broker, comision_broker, observaciones, id_estatus_venta, cant_mensual_enganche, fecha_captura, fecha_modificacion, uc, uum) values ('".$cantidad_apartado."', '".$fecha_apartado."', '".$cantidad_enganche."', '".$fecha_enganche."', '".$mensualidad_enganche."', '".$clientes."', '".$lote."', '".$precio_venta."', '".$tipo_compra."', '".$n_mensualidades."', '".$monto_mensual."', '".$pago_final."', '".$dia_pago."', '".$tasa_interes."', '".$nombre_broker."', '".$comision_broker."', '".$observaciones."', '".$estatus_venta."', '".$cant_mensual_enganche."', '".$hoy."', '".$hoy."', '".$_SESSION["id"]."', '".$_SESSION["id"]."')";
            $result=mysqli_query(conectar(),$sql);
            desconectar();
            //echo $sql;
            if($result){
                $sql="SELECT max(id_contrato) from contrato";
                $result=mysqli_query(conectar(),$sql);
                desconectar();
                $col = mysqli_fetch_array($result);
                $id_contrato = $col[0];
                $cadena = explode(",", $clientes);
                $array_size = count($cadena);
                for ($i = 0; $i<$array_size; $i++) {
                    $cliente = $cadena[$i];
                    $cadena2 = explode(" ", $cliente);
                    $sql="SELECT id_cliente FROM clientes WHERE apellido_paterno LIKE '".$cadena2[0]."' AND apellido_materno LIKE '".$cadena2[1]."'";
                    $resultado = mysqli_query(conectar(),$sql);
                    desconectar();
                    $col_cliente = mysqli_fetch_array($resultado);
                    $sql="INSERT into cliente_contrato (id_cliente, id_contrato) VALUES ('".$col_cliente['id_cliente']."', '".$id_contrato."') ";
                    $result=mysqli_query(conectar(),$sql);
                    desconectar();
                }//fin del for
                //Se actualiza la parte de descuentos
                if($descuentos!="0"){
                    $cadena = explode(",", $desc_aplicados);
                    $array_size = count($cadena);
                    for ($i = 0; $i<$array_size; $i++) {
                        $descuento = $cadena[$i];
                        $sql="SELECT id_descuento FROM cat_descuentos WHERE descripcion LIKE '".$descuento."' ";
                        $resultado = mysqli_query(conectar(),$sql);
                        desconectar();
                        $col = mysqli_fetch_array($resultado);
                        $id_descuento = $col[0];
                        $sql="INSERT into descuentos_contrato (id_contrato, id_descuento) values ('".$id_contrato."', '".$id_descuento."')";
                        $result = mysqli_query(conectar(),$sql);
                        desconectar();
                    }//fin del for
                }//fin del if
                if($result){
                    $respuesta['valor']="ok";
                    $respuesta['id_contrato']=$id_contrato;
                }else{
                    $respuesta['valor']="error";
                }//fin del else
            }else{
                $respuesta['valor']="error";
            }//fin del else
        }//fin del else
    }//fin del else
}//fin del else

echo json_encode($respuesta);
?>
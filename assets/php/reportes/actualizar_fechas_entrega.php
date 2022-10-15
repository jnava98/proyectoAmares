<?php

include "../conexion.php";
include "funciones_reportes.php";

$respuesta=Array();
/*
$sql="SELECT * from aux_fecha_entrega where estatus like '0' LIMIT 50";
$result = mysqli_query(conectar(),$sql);
desconectar();
$num = mysqli_num_rows($result);
if($num>0){
    $contador = 0;
    while($col = mysqli_fetch_array($result)){
        $fecha_entrega = $col['fecha_entrega'];
        $sql="SELECT id_lote from lotes where identificador like '".$col['concatenacion']."' ";
        $result_lote = mysqli_query(conectar(),$sql);
        desconectar();
        $num_aux = mysqli_num_rows($result_lote);
        if($num_aux>0){
            $row = mysqli_fetch_array($result_lote);
            $sql="UPDATE contrato set fecha_entrega = '".$col['fecha_entrega']."' where id_lote like '".$row['id_lote']."'";
            $result_update = mysqli_query(conectar(),$sql);
            desconectar();
            if($result_update){
                $contador++;
            }//fin del if
            $sql="UPDATE aux_fecha_entrega set estatus = '1' where concatenacion like '".$col['concatenacion']."'";
            $result_update = mysqli_query(conectar(),$sql);
            desconectar();
        }//fin del if
    }//fin del while
    echo "Se actualizaron ".$contador;
}//fin del if
*/

//$sql="SELECT dia_pago, id_contrato, id_tipo_compra from contrato where id_contrato like '310' and (id_tipo_compra like '1' or id_tipo_compra like '4')";
$sql="SELECT dia_pago, id_contrato, id_tipo_compra from contrato where (id_tipo_compra like '3' or id_tipo_compra like '1' or id_tipo_compra like '4') and id_contrato NOT IN ( SELECT id_contrato FROM aux_fecha_pagos ) LIMIT 10";
$result_contrato = mysqli_query(conectar(),$sql);
desconectar();
$num = mysqli_num_rows($result_contrato);
if($num>0){
    $contador = 0;
    $registro = 0;
    while($col = mysqli_fetch_array($result_contrato)){
        $dia_pago = $col['dia_pago'];
        $id_contrato = $col['id_contrato'];
        $tipo_compra = $col['id_tipo_compra'];
        //Seleccionamos todos los pagos con concepto 3, para empezar a realizar la actualizacion
        $sql="SELECT id_pago from pagos where id_contrato like '".$id_contrato."' and id_concepto like '3'";
        //echo $sql;
        $result_pago = mysqli_query(conectar(),$sql);
        desconectar();
        $num_aux = mysqli_num_rows($result_pago);
        if($num_aux>0){
            $aux_fecha = 1;
            $fecha_pago = $dia_pago;
            while($row = mysqli_fetch_array($result_pago)){
                $id_pago = $row['id_pago'];
                if($aux_fecha == 1){
                    $sql = "UPDATE pagos set fecha_mensualidad = '".$fecha_pago."' where id_pago like '".$id_pago."' and id_contrato like '".$id_contrato."'";
                    $result_update = mysqli_query(conectar(),$sql);
                    desconectar();
                    if($result_update){
                        $contador++;
                    }//fin del if
                    $aux_fecha ++;
                }else{
                    $fecha_pago = date("Y-m-d",strtotime($fecha_pago."+ 1 month"));
                    $sql = "UPDATE pagos set fecha_mensualidad = '".$fecha_pago."' where id_pago like '".$id_pago."' and id_contrato like '".$id_contrato."'";
                    $result_update = mysqli_query(conectar(),$sql);
                    desconectar();
                    if($result_update){
                        $contador++;
                    }//fin del if
                    $aux_fecha ++;
                }//fin del else
            }//fin del while pagos
        }//fin del if
        $sql = "INSERT into aux_fecha_pagos (id_contrato, id_tipo_compra, estatus) values ('".$id_contrato."', '".$tipo_compra."', '1')";
        $result = mysqli_query(conectar(),$sql);
        desconectar();
    }//fin del while
    echo "Se actualizaron ".$contador;
}else{
    echo "Proceso terminado";
}//fin del else

echo json_encode($respuesta);
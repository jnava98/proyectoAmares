<?php

session_start();
include "../conexion.php";
$response = [];
//Recibimos datos
$id_contrato = filter_input(INPUT_POST,'id_contrato',FILTER_SANITIZE_NUMBER_INT);
$opcionAbono = filter_input(INPUT_POST,'opcionAbono',FILTER_SANITIZE_NUMBER_INT);
$abonadoCapital = filter_input(INPUT_POST,'abonadoCapital',FILTER_SANITIZE_NUMBER_FLOAT);
$divisa = filter_input(INPUT_POST,'divisa',FILTER_DEFAULT);
$tipoCambio = filter_input(INPUT_POST,'tipoCambio',FILTER_SANITIZE_NUMBER_FLOAT);
$cuentaBancaria = filter_input(INPUT_POST,'cuentaBancaria',FILTER_SANITIZE_NUMBER_INT);
$fechaPago = filter_input(INPUT_POST,'fechaPago',FILTER_DEFAULT);
$cantInicial = filter_input(INPUT_POST,'cantInicial',FILTER_SANITIZE_NUMBER_FLOAT);
//Validamos datos
if($id_contrato==0||$id_contrato==""){
    $response['error'] = "No se recibió id_contrato";
    exit(json_encode($response));
} 
if($opcionAbono==0||$opcionAbono=="") {
    $response['error'] = "No se recibió opcionAbono";
    exit(json_encode($response));
}

//Opciones posibles para opcionAbono
$reducirMensualidades = 1;
$reducirCantidadMensual = 2;
$concepto = 5; //CONCEPTO ABONO A CAPITAL


$ultimoPago = traeUltimoPago($id_contrato);
$datosContrato = traeDatosContrato($id_contrato);



if ($ultimoPago!=false) {
    $fecha_pago = $fechaPago;
    $id_cuenta_bancaria = $cuentaBancaria;
    $no_mensualidad = 0; //No se contabiliza como mensualidad
    $monto_pagado = $abonadoCapital;
    $tipo_cambio = $tipoCambio;
    $mensualidadHistorica = $ultimoPago['mensualidad_historica'];
    $fecha_captura = date("Y-m-d");
    $estatus_contrato = $ultimoPago['estatus_contrato'];
    $balance_final = ($ultimoPago['balance_final'] - $abonadoCapital);

    if($opcionAbono==$reducirCantidadMensual){
        $mensualidadHistorica = (($datosContrato['precio_venta'] -$abonadoCapital) / $datosContrato['mensualidades']);
    }
    if($opcionAbono==$reducirMensualidades){
        //No se hace nada ya que no almacenamos el total de las mensualidades.
    }

    $sql = "INSERT INTO pagos (id_contrato,fecha_pago,id_cuenta_bancaria,no_mensualidad,monto_pagado,divisa,tipo_cambio,abonado_capital,abonado_interes,diferencia,id_estatus_pago, comentario, id_concepto,cant_inicial, mensualidad_historica, fecha_mensualidad,fecha_captura,balance_final, estatus_contrato, habilitado) VALUES ($id_contrato,'$fecha_pago',$id_cuenta_bancaria,$no_mensualidad,$monto_pagado,'$divisa',$tipo_cambio,$abonadoCapital,0,0,1,'',$concepto,$cantInicial,$mensualidadHistorica,null,'$fecha_captura',$balance_final,$estatus_contrato, 1)";
    $result=mysqli_query(conectar(),$sql);


}else{
    $no_mensualidad = 0;
    $mensualidadHistorica = $datosContrato['monto_mensual'];
    $fecha_captura = date("Y-m-d");
    $estatus_contrato = $datosContrato['id_estatus_venta'];
    $balance_final = ($datosContrato['precio_venta'] - $abonadoCapital);

    if($opcionAbono==$reducirCantidadMensual){
        $mensualidadHistorica = (($datosContrato['precio_venta'] -$abonadoCapital) / $datosContrato['mensualidades']);
    }
    if($opcionAbono==$reducirMensualidades){
        //No se hace nada ya que no almacenamos el total de las mensualidades.
    }

    $sql = "INSERT INTO pagos (id_contrato,fecha_pago,id_cuenta_bancaria,no_mensualidad,monto_pagado,divisa,tipo_cambio,abonado_capital,abonado_interes,diferencia,id_estatus_pago, comentario, id_concepto,cant_inicial, mensualidad_historica, fecha_mensualidad,fecha_captura,balance_final, estatus_contrato, habilitado) VALUES ($id_contrato,$fechaPago,$cuentaBancaria,$no_mensualidad,$abonadoCapital,'$divisa',$tipoCambio,$abonadoCapital,0,0,1,'',$concepto,$cantInicial,$mensualidadHistorica,null,$fecha_captura,$balance_final,$estatus_contrato, 1)";
    $result=mysqli_query(conectar(),$sql);


}
$response['sql'] = $sql;
$response['id_contrato'] =  $id_contrato;
echo json_encode($response); 

function traeUltimoPago($id_contrato){
    $sql="SELECT  * FROM pagos WHERE id_contrato = '$id_contrato' AND habilitado = 1 ORDER BY id_pago DESC LIMIT 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    if ($result==true) {
        $row=mysqli_fetch_array($result);
        return $row;
    }else{
        return false;
    }
    
};
function traeDatosContrato($id_contrato){
    $sql="SELECT * FROM contrato WHERE id_contrato = '$id_contrato'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    if ($result==true) {
        $row=mysqli_fetch_array($result);
        return $row;
    }else{
        return false;
    }
};  
<?php

$id_contrato = filter_input(INPUT_POST,'id_contrato',FILTER_SANITIZE_NUMBER_INT);
$id_concepto = filter_input(INPUT_POST,'id_concepto',FILTER_SANITIZE_NUMBER_INT);

if ($id_concepto == 0||$id_contrato==0) return false;

include "../conexion.php";

$apartado = 1;
$enganche = 2;
$mensualidadContrato = 3;
$pagoFinal = 4;

$datosContrato = traeDatosContrato($id_contrato);
$mensaje = "";
$mensaje2 = "";

switch ($id_concepto) {
    case $apartado:
        //Validamos si existe algun pago de apartado
        $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
        if ($ultimoPago!=false) {
            //Traemos la sumatoria de los pagos de ese concepto
            $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
            $totalPagado = $datosTotalPagado->totalPagado;
            //Traemos la cantidad estipulada en el contrato
            $montoTotal = $datosContrato->cant_apartado;
            $mensaje = "Apartado pagado.";
            $mensaje2 = "El apartado ya fué pagado.";
            $cantidadxPagar = $montoTotal-$totalPagado;
        }else{
            //Si es el primer pago...
            $cantidadxPagar = $datosContrato->cant_apartado;
        }
        break;
   case $enganche:
        //Validamos si está definida la cantidad mensual del enganche.
        if ($datosContrato->mensualidades_enganche == 0 || $datosContrato->mensualidades_enganche ==1 || $datosContrato->cant_mensual_enganche==0) {
            //TOTAL DEL ENGANCHE
            $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
            if ($ultimoPago!=false) {
                $cantidadxPagar = 0;
                $mensaje = "Enganche pagado.";
                $mensaje2 = "El enganche ya se encuentra pagado o no se estipularon mensualidades para este concepto en el contrato.";
            }else{
                $cantidadxPagar = $datosContrato->cant_enganche;
            }
        }else{
            //Si hay mensualidades estipuladas...
            //Validamos si existe algún pago
            $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
            if ($ultimoPago!=false) {
                //Validamos si lo restante por pagar es mayor a lo definido mensual. De ser así colocamos la cantidad del contrato, si no colocamos lo restante.
                $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
                $restantexPagar = ($datosContrato->cant_enganche - $datosTotalPagado->totalPagado);
                if($restantexPagar > $datosContrato->cant_mensual_enganche){
                    $cantidadxPagar = $datosContrato->cant_mensual_enganche;
                }else{
                    if($restantexPagar == 0){
                        $mensaje = "Enganche pagado.";
                        $mensaje2 = "El enganche ya se encuentra pagado.";
                    }
                    $cantidadxPagar = $restantexPagar;
                    
                }
                // //Traemos la sumatoria de los pagos de ese concepto
                // $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
                // $totalPagado = $datosTotalPagado->totalPagado;
                // //Traemos la cantidad estipulada en el contrato
                // $montoTotal = $datosContrato->cant_enganche;
                // $cantidadxPagar = $montoTotal-$totalPagado;
            }else{
                //Si es el primer pago...
                $cantidadxPagar = $datosContrato->cant_mensual_enganche;
            }
        }

        //Si es el primer pago...

    break;
}

$response = [];
$response['cantidadxPagar'] = $cantidadxPagar;
$response['mensaje'] = $mensaje;
$response['mensaje2'] = $mensaje2;
$response['a'] = $cantidadxPagar;

echo json_encode($response);

function consultaPagoxConcepto($id_contrato,$id_concepto){
    //Consulta si existe algún pago de un concepto en específico
    $sql="SELECT * FROM pagos WHERE id_contrato = $id_contrato AND id_concepto = $id_concepto AND habilitado = 1 LIMIT 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row = mysqli_fetch_assoc($result);
    $num_rows = mysqli_num_rows($result);
     if ($num_rows>0) {
         return $row;
     }else{
         return false;
     }
    
}

function totalPagadoxConcepto($id_contrato,$id_concepto){
    $sql="SELECT sum(monto_pagado) as totalPagado FROM pagos WHERE id_contrato = $id_contrato AND id_concepto = $id_concepto AND habilitado = 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row = mysqli_fetch_assoc($result);
    $row = json_encode($row);
    $row = json_decode($row,false);
    return $row;
}

function traeDatosContrato($id_contrato){
    $sql="SELECT * FROM contrato WHERE id_contrato = '$id_contrato'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    if ($result==true) {
        $row=mysqli_fetch_assoc($result);
        $row = json_encode($row);
        $row = json_decode($row,false);
        return $row;
    }else{
        return false;
    }
};  

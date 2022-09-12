<?php

$id_contrato = filter_input(INPUT_POST,'id_contrato',FILTER_SANITIZE_NUMBER_INT);
$id_concepto = filter_input(INPUT_POST,'id_concepto',FILTER_SANITIZE_NUMBER_INT);

if ($id_concepto == 0||$id_contrato==0) return false;

include "../conexion.php";

$apartado = 1;
$enganche = 2;
$mensualidadContrato = 3;
$pagoFinal = 4;

//TIPOS DE CONTRATO O TIPOS DE VENTA
const FINANCIADO = 1;
const CONTADO = 2;
const CONTADO_COMERCIAL = 3;
const MSI = 4;

//TIPOS DE CONCEPTO
const APARTADO = 1;
const ENGANCHE = 2;
const MENSUALIDAD_CONTRATO = 3;
const ABONO_CAPITAL = 4;
const PAGO_FINAL = 5;

$datosContrato = traeDatosContrato($id_contrato);
$ultimoPagoxConcepto = consultaPagoxConcepto($id_contrato,$id_concepto);
$ultimoPago = consultaUltimoPago($id_contrato);
if ($ultimoPago == false) {
    $ultimoPago['diferencia'] = 0;
}
$datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
$mensaje = "";
$mensaje2 = "";
$cantidadxPagar = 0;
$saldoMesAnterior = 0;
$interesMesAnterior = 0;
$aux = 0;

if ($id_concepto == APARTADO) {
    if ($datosContrato->cant_apartado == 0) {
        $mensaje = "Contrato sin apartado.";
        $mensaje2 = "No se especificó una cantidad para el apartado en el contrato de este lote.";
        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }
    if ($datosTotalPagado->totalPagado === null) {
        $cantidadxPagar = $datosContrato->cant_apartado;
        if ($ultimoPago['diferencia'] > 0) {
            $saldoMesAnterior = 0;
        }else{
            $saldoMesAnterior = $ultimoPago['diferencia'];
        }
        $saldoMesAnterior = $ultimoPago['diferencia'];
        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }
    if ($datosTotalPagado->totalPagado != null) {
        if (number_format($datosTotalPagado->totalPagado,0, '.', '') >= number_format($datosContrato->cant_apartado,0, '.', '')) {
            $mensaje = "Apartado pagado.";
            $mensaje2 = "El apartado ya fue pagado.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }else{
            $cantidadxPagar = $datosContrato->cant_apartado-$datosTotalPagado->totalPagado;
            if ($ultimoPago['diferencia'] > 0) {
                $saldoMesAnterior = 0;
            }else{
                $saldoMesAnterior = $ultimoPago['diferencia'];
            }
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }  
}
if ($id_concepto == ENGANCHE) {
    //Verificamos si se definió apartado
    if ($datosContrato->cant_apartado != 0) {
        //Verificamos si ya se pago el apartado
        $totalPagadoApartado = totalPagadoxConcepto($id_contrato,APARTADO);
        if ($totalPagadoApartado->totalPagado === null ||number_format($totalPagadoApartado->totalPagado,0, '.', '')  < number_format($datosContrato->cant_apartado,0, '.', '') ) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "No es posible pagar el enganche si el apartado no ha sido pagado.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }
    //ENGANCHE A 1 PAGO.
    if ($datosContrato->mensualidades_enganche == 0 || $datosContrato->mensualidades_enganche ==1 || $datosContrato->cant_mensual_enganche==0) {
        //Verificamos si ya pagó todo el enganche
        if ($datosTotalPagado->totalPagado === null) {
            $cantidadxPagar = $datosContrato->cant_enganche;
            if ($ultimoPago['diferencia'] > 0) {
                $saldoMesAnterior = 0;
            }else{
                $saldoMesAnterior = $ultimoPago['diferencia'];
            }
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
        if ($datosTotalPagado != null) {
            if (number_format($datosTotalPagado->totalPagado,0, '.', '') >= number_format($datosContrato->cant_enganche,0, '.', '')) {
                $mensaje = "Enganche pagado.";
                $mensaje2 = "El enganche ya fue pagado.";
                exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
            }else{
                $cantidadxPagar = $datosContrato->cant_enganche-$datosTotalPagado->totalPagado;
                if ($ultimoPago['diferencia'] > 0) {
                    $saldoMesAnterior = 0;
                }else{
                    $saldoMesAnterior = $ultimoPago['diferencia'];
                }
                exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
            }
        }
    }else{
        //ENGANCHE POR MENSUALIDADES
        if ($datosTotalPagado->totalPagado === null) {
            $cantidadxPagar = $datosContrato->cant_mensual_enganche;
            $saldoMesAnterior = $ultimoPago['diferencia'];
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
        if ($datosTotalPagado != null) {
            if (number_format($datosTotalPagado->totalPagado,0, '.', '') >= number_format($datosContrato->cant_enganche,0, '.', '')) {
                $mensaje = "Enganche pagado.";
                $mensaje2 = "El enganche ya fue pagado.";
                exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
            }else{
                $restantexPagar = $datosContrato->cant_enganche-$datosTotalPagado->totalPagado;
                if ($restantexPagar >= $datosContrato->cant_mensual_enganche) {
                    $cantidadxPagar = $datosContrato->cant_mensual_enganche;
                }else {
                    $cantidadxPagar = $restantexPagar;
                }
                $saldoMesAnterior = $ultimoPago['diferencia'];
                exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
            }
        }
    }
}
if ($id_concepto == MENSUALIDAD_CONTRATO) {
    //Verificamos que el contrato no sea de contado.
    if ($datosContrato->id_tipo_compra == CONTADO) {
        $mensaje = "Verificación de pago.";
        $mensaje2 = "Los contratos de contado no tienen mensualidades, solo pago final.";
        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }
    //Verificamos si se definio un apartado y que ya haya sido pagado.
    if ($datosContrato->cant_apartado != 0) {
        //Verificamos si ya se pago el apartado
        $totalPagadoApartado = totalPagadoxConcepto($id_contrato,APARTADO);
        if ($totalPagadoApartado->totalPagado === null ||number_format($totalPagadoApartado->totalPagado,0, '.', '')  < number_format($datosContrato->cant_apartado,0, '.', '') ) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "No es posible pagar mensualidades si el apartado no ha sido pagado.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }
    //Verificamos que el enganche ya haya sido pagado
    $totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
    if (($totalPagadoEnganche->totalPagado === null) || (number_format($totalPagadoEnganche->totalPagado,0, '.', '') < number_format($datosContrato->cant_enganche,0, '.', ''))) {
        $mensaje = "Verificación de pago.";
        $mensaje2 = "No es posible pagar mensualidades si el enganche no ha sido pagado. $totalPagadoEnganche->totalPagado";
        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }

    if ($datosTotalPagado->totalPagado === null) {
        $cantidadxPagar = $datosContrato->monto_mensual;
        if ($ultimoPago['id_concepto'] == ABONO_CAPITAL) {
            $cantidadxPagar = $ultimoPago['mensualidad_historica'];
        }
        $saldoMesAnterior = $ultimoPago['diferencia'];

        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }
    if ($datosTotalPagado != null) {
        $totalEstipuladoMensualidades = ($datosContrato->monto_mensual*$datosContrato->mensualidades);
        $totalPagadoAbonoCapital = totalPagadoxConcepto($id_contrato,ABONO_CAPITAL);
        $totalPagado = $datosTotalPagado->totalPagado + $totalPagadoAbonoCapital->totalPagado;
        if (number_format($totalPagado,0, '.', '') >= number_format($totalEstipuladoMensualidades,0, '.', '')) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "Las mensualidades ya han sido pagadas.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }else{
            $restantexPagar = $totalEstipuladoMensualidades-($datosTotalPagado->totalPagado +  $totalPagadoAbonoCapital->totalPagado);
            if ($restantexPagar >= $datosContrato->monto_mensual) {
                //Tenemos que ver si existe un abono a capital.
                if ($ultimoPago['id_concepto'] == ABONO_CAPITAL || $ultimoPago['id_concepto'] == MENSUALIDAD_CONTRATO) {
                    $cantidadxPagar = $ultimoPago['mensualidad_historica'];
                }else {
                    $cantidadxPagar = $datosContrato->monto_mensual;
                }
            }else {
                $cantidadxPagar = $restantexPagar;
            }
            $saldoMesAnterior = $ultimoPago['diferencia'];
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }
}
if ($id_concepto == PAGO_FINAL) {
    //Verificamos que haya definido un apartado y que ya haya sido pagado.
    if ($datosContrato->cant_apartado != 0) {
        //Verificamos si ya se pago el apartado
        $totalPagadoApartado = totalPagadoxConcepto($id_contrato,APARTADO);
        if ($totalPagadoApartado->totalPagado === null || number_format($totalPagadoApartado->totalPagado,0, '.', '') < number_format($datosContrato->cant_apartado,0, '.', '')) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "No es posible pagar el pago final si el apartado no ha sido pagado.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }
    //Verificamos que el enganche ya haya sido pagado.
    $totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
    if ($totalPagadoEnganche->totalPagado === null || number_format($totalPagadoEnganche->totalPagado,0, '.', '') < number_format($datosContrato->cant_enganche,0, '.', '')) {
        $mensaje = "Verificación de pago.";
        $mensaje2 = "No es posible realizar el pago final si el enganche no ha sido pagado.";
        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }
    //Verificamos que las mensualidades ya hayan sido pagadas.
    if ($datosContrato->id_tipo_compra != CONTADO) {
        $totalPagadoMensualidades = totalPagadoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
        if ($totalPagadoMensualidades->totalPagado === null || number_format($totalPagadoMensualidades->totalPagado,0, '.', '') < number_format(($datosContrato->monto_mensual*$datosContrato->mensualidades),0, '.', '')) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "No es posible hacer el pago final si no se han pagado las mensualidades.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }
    //Verificacion normal...
    
    if ($datosTotalPagado->totalPagado === null) {
        $cantidadxPagar = $datosContrato->pago_final;
        $saldoMesAnterior = $ultimoPago['diferencia'];
        exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
    }
    if ($datosTotalPagado != null) {
        if ($datosTotalPagado->totalPagado >= $datosContrato->pago_final) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "El contrato ya se ha pagado por completo.";
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }else{
            $restantexPagar = $datosContrato->pago_final-$datosTotalPagado->totalPagado;
            if ($restantexPagar >= $datosContrato->pago_final) {
                $cantidadxPagar = $datosContrato->pago_final;
            }else {
                $cantidadxPagar = $restantexPagar;
            }
            $saldoMesAnterior = $ultimoPago['diferencia'];
            exit(response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2));
        }
    }
}







function response($aux,$interesMesAnterior,$saldoMesAnterior,$cantidadxPagar,$mensaje,$mensaje2){
    $response = [];  
    $response['aux'] = $aux;
    $response['interesMesAnterior'] = $interesMesAnterior;
    $response['interesMesAnterior'] = $interesMesAnterior;
    $response['saldoMesAnterior'] = $saldoMesAnterior;
    $response['cantidadxPagar'] = number_format((float)$cantidadxPagar, 2, '.', '') ;
    $response['mensaje'] = $mensaje;
    $response['mensaje2'] = $mensaje2;

    echo json_encode($response);
}

function consultaPagoxConcepto($id_contrato,$id_concepto){
    //Consulta si existe algún pago de un concepto en específico
    $sql="SELECT * FROM pagos WHERE id_contrato = $id_contrato AND id_concepto = $id_concepto AND habilitado = 1 ORDER BY id_pago DESC LIMIT 1";
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

function consultaUltimoPago($id_contrato){
    //Consulta si existe algún pago de un concepto en específico
    $sql="SELECT  * FROM pagos WHERE id_contrato = '$id_contrato' AND habilitado = 1 ORDER BY id_pago DESC LIMIT 1";
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
    $sql="SELECT (sum(abonado_capital) + sum(abonado_interes)) as totalPagado FROM pagos WHERE id_contrato = $id_contrato AND id_concepto = $id_concepto AND habilitado = 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row = mysqli_fetch_assoc($result);
    $row = json_encode($row);
    $row = json_decode($row,false);
    return $row;
}

function totalPagadoMensualidadesyAbonoCapital($id_contrato,$id_concepto){
    $sql="SELECT sum(abonado_capital) as totalPagado FROM pagos WHERE id_contrato = $id_contrato AND id_concepto in (3,4)  AND habilitado = 1";
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
}
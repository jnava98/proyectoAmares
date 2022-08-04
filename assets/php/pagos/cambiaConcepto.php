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
const PAGO_FINAL = 5;

$datosContrato = traeDatosContrato($id_contrato);
$ultimoPagoxConcepto = consultaPagoxConcepto($id_contrato,$id_concepto);
$ultimoPago = consultaUltimoPago($id_contrato);
$datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
$mensaje = "";
$mensaje2 = "";
$cantidadxPagar = 0;
$saldoMesAnterior = 0;
$interesMesAnterior = 0;
$aux = 0;

if ($datosContrato->id_tipo_compra == CONTADO_COMERCIAL) {
    if ($id_concepto == APARTADO) {
        if ($datosContrato->cant_apartado == 0 || $datosContrato->cant_apartado == null) {
            $mensaje = "Contrato sin apartado.";
            $mensaje2 = "No se especificó una cantiad para el apartado en el contrato de este lote.";
        }
        if ($ultimoPagoxConcepto == false) {
            $cantidadxPagar = $datosContrato->cant_apartado;
        }else{
             $totalPagadoxConcepto = $datosTotalPagado->totalPagado;
             $totalEstipuladoxConcepto = $datosContrato->cant_apartado;
             if ($totalPagadoxConcepto >= $totalEstipuladoxConcepto) {
                $mensaje = "Apartado pagado.";
                $mensaje2 = "El apartado ya fué pagado.";
             }else{
                $cantidadxPagar = $totalEstipuladoxConcepto-$totalPagadoxConcepto;
                if ($ultimoPago['diferencia'] < 0) {
                    $saldoMesAnterior = $ultimoPago['diferencia'];
                }
             }   
        }
    }
    if ($id_concepto == ENGANCHE) {

        if ($datosContrato->mensualidades_enganche == 0 || $datosContrato->mensualidades_enganche ==1 || $datosContrato->cant_mensual_enganche==0) {
            if ($ultimoPagoxConcepto == false) {
                $cantidadxPagar = $datosContrato->cant_enganche;
            }else{
                $totalPagadoxConcepto = $datosTotalPagado->totalPagado;
                $totalEstipuladoxConcepto = $datosContrato->cant_enganche;
                if ($totalPagadoxConcepto >= $totalEstipuladoxConcepto) {
                    $mensaje = "Enganche pagado.";
                    $mensaje2 = "El enganche ya fué pagado.";
                 }else{
                    $cantidadxPagar = $totalEstipuladoxConcepto-$totalPagadoxConcepto;
                    if ($ultimoPago['diferencia'] < 0) {
                        $saldoMesAnterior = $ultimoPago['diferencia'];
                    }
                 }
            }
        }else{
            //ENGANCHE POR MENSUALIDADES
            if ($ultimoPagoxConcepto == false) {
                $cantidadxPagar = $datosContrato->cant_mensual_enganche;
            }else{
                $totalPagadoxConcepto = $datosTotalPagado->totalPagado;
                $totalEstipuladoxConcepto = $datosContrato->cant_enganche;
                if ($totalPagadoxConcepto >= $totalEstipuladoxConcepto) {
                    $mensaje = "Enganche pagado.";
                    $mensaje2 = "El enganche ya fué pagado.";
                 }else{
                    $restantexPagar = $totalEstipuladoxConcepto-$totalPagadoxConcepto;
                    $cant_mensual_enganche = $datosContrato->cant_mensual_enganche;
                    if ($restantexPagar >= $cant_mensual_enganche) {
                        $cantidadxPagar = $cant_mensual_enganche;
                    }else {
                        $cantidadxPagar = $restantexPagar;
                    }
                    if ($ultimoPago['diferencia'] < 0) {
                        $saldoMesAnterior = $ultimoPago['diferencia'];
                    }
                 }
            }
        }
    }
    if ($id_concepto == MENSUALIDAD_CONTRATO) {
        //Verificamos que existan pagos.
        if ($ultimoPago == false) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "No es posible pagar una mensualidad si no existen pagos registrados antes.";
        }else {
            //Verificamos que el enganche este pagado por completo.
            $totalEstipuladoEnganche = $datosContrato->cant_enganche;
            $totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
            if ($totalPagadoEnganche->totalPagado === null || $totalPagadoEnganche <= $totalEstipuladoEnganche) {
                $mensaje = "Verificación de pago.";
                $mensaje2 = "No es posible pagar una mensualidad si el enganche no ha sido pagado.";
            }
            //Verificamos si existe algun pago de mensualidad
            $ultimoPagoxConcepto = consultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
            if ($ultimoPagoxConcepto === false) {
                $cantidadxPagar = $datosContrato->monto_mensual;    
                if ($ultimoPago['diferencia'] < 0) {
                    $saldoMesAnterior = $ultimoPago['diferencia'];
                }
            }else{
                //Verificamos que si el cliente ya pago las mensualidades por completo
                $totalEstipuladoMensualidades = ($datosContrato->monto_mensual*$datosContrato->mensualidades);
                $totalPagadoxConcepto = totalPagadoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
                $totalPagadoMensualidades = $totalPagadoxConcepto->totalPagado;

                if ($totalPagadoMensualidades >= $totalEstipuladoMensualidades) {
                    $aux = "$totalPagadoMensualidades -- $totalEstipuladoMensualidades";
                    $mensaje = "Verificación de pago.";
                    $mensaje2 = "Las mensualidades ya han sido pagadas.";
                }

                if ($totalPagadoMensualidades <= $totalEstipuladoMensualidades) {
                    $restantexPagar = $totalEstipuladoMensualidades-$totalPagadoMensualidades;
                    if ($restantexPagar < $datosContrato->monto_mensual) {
                        $cantidadxPagar = $restantexPagar;
                    }else{
                        $cantidadxPagar = $datosContrato->monto_mensual;
                    }
                    if ($ultimoPago['diferencia'] < 0) {
                        $saldoMesAnterior = $ultimoPago['diferencia'];
                    }
                }
            }
            
        }

        
    }

    if ($id_concepto == PAGO_FINAL) {
        //Verificamos que existan pagos.
        if ($ultimoPago == false) {
            $mensaje = "Verificación de pago.";
            $mensaje2 = "No es posible realizar el pago final si no existen pagos registrados antes.";
        }else{
             //Verificamos que el enganche este pagado por completo.
             $totalEstipuladoEnganche = $datosContrato->cant_enganche;
             $totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
             if ($totalPagadoEnganche->totalPagado === null || $totalPagadoEnganche <= $totalEstipuladoEnganche) {
                 $mensaje = "Verificación de pago.";
                 $mensaje2 = "No es posible realizar el pago final si el enganche no ha sido pagado.";
             }
            //Verificamos que las mensualidades ya hayan sido pagadas.
            $totalEstipuladoMensualidades = ($datosContrato->monto_mensual*$datosContrato->mensualidades);
            $totalPagadoxConcepto = totalPagadoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
            $totalPagadoMensualidades = $totalPagadoxConcepto->totalPagado;
            if ($totalPagadoMensualidades === null ||$totalPagadoMensualidades <= $totalEstipuladoMensualidades) {
                $mensaje = "Verificación de pago.";
                $mensaje2 = "No es posible realizar el pago final si las mensualidades no han sido pagado.";
            }
            //Verificamos si el cliente ya pago por completo el pago final.
            $totalEstipuladoPagoFinal = $datosContrato->pago_final;
            $totalPagadoxConcepto = totalPagadoxConcepto($id_contrato,PAGO_FINAL);
            $totalPagadoPagoFinal = $totalPagadoxConcepto->totalPagado;
            if ($totalPagadoPagoFinal >= $totalEstipuladoPagoFinal) {
                $mensaje = "Verificación de pago.";
                $mensaje2 = "El monto definido para el pago final ya ha sido pagado por completo.";
            }
            if ($totalPagadoPagoFinal <= $totalEstipuladoPagoFinal) {
                $restantexPagar = $totalEstipuladoPagoFinal - $totalPagadoPagoFinal;
                if ($restantexPagar < $datosContrato->pago_final) {
                    $cantidadxPagar = $restantexPagar;
                }else{
                    $cantidadxPagar = $datosContrato->pago_final;
                }
                if ($ultimoPago['diferencia'] < 0) {
                    $saldoMesAnterior = $ultimoPago['diferencia'];
                }
            }
        }
        
        // if ($ultimoPago == false) {
        //     $mensaje = "Verificación de pago.";
        //     $mensaje2 = "No es posible realizar el pago final si no existen pagos registrados antes.";
        // }else{
        //     $totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
        //     $totalEstipuladoEnganche = $datosContrato->cant_enganche;
        //     if ($totalPagadoEnganche >= $totalEstipuladoEnganche) {
        //         //Verificamos que las mensualidades ya esten pagadas.
        //         $totalPagadoMensualidades = totalPagadoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
        //         $totalEstipuladoMensualidades = ($datosContrato->monto_mensual * $datosContrato->mensualidades);
        //         if ($totalPagadoMensualidades >= $totalEstipuladoMensualidades) {
        //             $cantidadxPagar = $datosContrato->monto_mensual;
        //         }
        //         if ($ultimoPago['diferencia'] < 0) {
        //             $saldoMesAnterior = $ultimoPago['diferencia'];
        //         }
        //         if ($ultimoPago['balance_final']<=0) {
        //             $cantidadxPagar = 0;
        //             $saldoMesAnterior = 0;
        //             $interesMesAnterior = 0;
        //             $mensaje = "Contrato Pagado.";
        //             $mensaje2 = "El cliente ya pagó por completo el contrato.";
        //         }
        //     }
        // }
    }
}


if ($datosContrato->id_tipo_compra == CONTADO) {
    
    if ($id_concepto == APARTADO) {
        if ($datosContrato->cant_apartado == 0 || $datosContrato->cant_apartado == null) {
            $mensaje = "Contrato sin apartado.";
            $mensaje2 = "No se especificó una cantid ad para el apartado en el contrato de este lote.";
        }
        if ($ultimoPagoxConcepto == false) {
            $cantidadxPagar = $datosContrato->cant_apartado;
        }else{
             $totalPagadoxConcepto = $datosTotalPagado->totalPagado;
             $totalEstipuladoxConcepto = $datosContrato->cant_apartado;
             if ($totalPagadoxConcepto >= $totalEstipuladoxConcepto) {
                $mensaje = "Apartado pagado.";
                $mensaje2 = "El apartado ya fué pagado.";
             }else{
                $cantidadxPagar = $totalEstipuladoxConcepto-$totalPagadoxConcepto;
                if ($ultimoPago['diferencia'] < 0) {
                    $saldoMesAnterior = $ultimoPago['diferencia'];
                }
             }   
        }
    }
    if ($id_concepto == ENGANCHE) {
        if ($datosContrato->mensualidades_enganche == 0 || $datosContrato->mensualidades_enganche ==1 || $datosContrato->cant_mensual_enganche==0) {
            if ($ultimoPagoxConcepto == false) {
                $cantidadxPagar = $datosContrato->cant_enganche;
            }else{
                $totalPagadoxConcepto = $datosTotalPagado->totalPagado;
                $totalEstipuladoxConcepto = $datosContrato->cant_enganche;
                if ($totalPagadoxConcepto >= $totalEstipuladoxConcepto) {
                    $mensaje = "Enganche pagado.";
                    $mensaje2 = "El enganche ya fué pagado.";
                 }else{
                    $cantidadxPagar = $totalEstipuladoxConcepto-$totalPagadoxConcepto;
                    if ($ultimoPago['diferencia'] < 0) {
                        $saldoMesAnterior = $ultimoPago['diferencia'];
                    }
                 }
            }
        }else{
            //ENGANCHE POR MENSUALIDADES
            if ($ultimoPagoxConcepto == false) {
                $cantidadxPagar = $datosContrato->cant_mensual_enganche;
            }else{
                $totalPagadoxConcepto = $datosTotalPagado->totalPagado;
                $totalEstipuladoxConcepto = $datosContrato->cant_enganche;
                if ($totalPagadoxConcepto >= $totalEstipuladoxConcepto) {
                    $mensaje = "Enganche pagado.";
                    $mensaje2 = "El enganche ya fué pagado.";
                 }else{
                    $restantexPagar = $totalEstipuladoxConcepto-$totalPagadoxConcepto;
                    $cant_mensual_enganche = $datosContrato->cant_mensual_enganche;
                    if ($restantexPagar >= $cant_mensual_enganche) {
                        $cantidadxPagar = $cant_mensual_enganche;
                    }else {
                        $cantidadxPagar = $restantexPagar;
                    }
                    if ($ultimoPago['diferencia'] < 0) {
                        $saldoMesAnterior = $ultimoPago['diferencia'];
                    }
                 }
            }
        }
    }
    if ($id_concepto == MENSUALIDAD_CONTRATO) {
        $mensaje = "No hay mensualidades.";
        $mensaje2 = "Los contratos de contado no tienen mensualidades, solo pago final.";

    }
    if ($id_concepto == PAGO_FINAL) {
        if ($ultimoPago==false) {   
            $cantidadxPagar = $datosContrato->precio_venta;
            $saldoMesAnterior = 0;
            $interesMesAnterior = 0;
        }else{
            if ($ultimoPago['diferencia'] < 0) {
                $saldoMesAnterior = $ultimoPago['diferencia'];
            }else {
                $saldoMesAnterior = 0;
                $interesMesAnterior = 0;
            }
            if ($ultimoPago['balance_final']<=0) {
                $cantidadxPagar = 0;
                $saldoMesAnterior = 0;
                $interesMesAnterior = 0;
                $mensaje = "Contrato Pagado.";
                $mensaje2 = "El cliente ya pagó por completo el contrato.";
            }else{
                $cantidadxPagar = $ultimoPago['balance_final'];
            }
            
            
        }
    }

}//Fin contado y contado comercial.





// switch ($id_concepto) {
//     case $apartado:
        
//         if ($datosContrato->cant_apartado == 0 || $datosContrato->cant_apartado == null) {
//             $mensaje = "No hay apartado";
//             $mensaje2 = "No se especificó una cantiad para el apartado en el contrato de este lote.";
//         }
//         if ($ultimoPago == false) {
//             $cantidadxPagar = $datosContrato->cant_apartado;
//         }else{
//              //Traemos la sumatoria de los pagos de ese concepto
//              $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
//              $totalPagado = $datosTotalPagado->totalPagado;
//              //Traemos la cantidad estipulada en el contrato
//              $montoTotal = $datosContrato->cant_apartado;
//              $mensaje = "Apartado pagado.";
//              $mensaje2 = "El apartado ya fué pagado.";
//              $cantidadxPagar = $montoTotal-$totalPagado;
//         }

        
//         //Validamos si existe algun pago de apartado
       
//         // if ($ultimoPago!=false) {
//         //     //Traemos la sumatoria de los pagos de ese concepto
//         //     $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
//         //     $totalPagado = $datosTotalPagado->totalPagado;
//         //     //Traemos la cantidad estipulada en el contrato
//         //     $montoTotal = $datosContrato->cant_apartado;
//         //     $mensaje = "Apartado pagado.";
//         //     $mensaje2 = "El apartado ya fué pagado.";
//         //     $cantidadxPagar = $montoTotal-$totalPagado;
//         // }else{
//         //     //Si es el primer pago...
//         //     $cantidadxPagar = $datosContrato->cant_apartado;
//         // }
//         break;
//    case $enganche:
//         //Validamos si está definida la cantidad mensual del enganche.
//         if ($datosContrato->mensualidades_enganche == 0 || $datosContrato->mensualidades_enganche ==1 || $datosContrato->cant_mensual_enganche==0) {
//             if ($ultimoPagoxConcepto == false) {
//                 $cantidadxPagar = $datosContrato->cant_enganche;
//             }else{
//                 $totalPagado = 
//             }

//             //TOTAL DEL ENGANCHE
//             $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
//             if ($ultimoPago!=false) {
//                 $cantidadxPagar = 0;
//                 $mensaje = "Enganche pagado.";
//                 $mensaje2 = "El enganche ya se encuentra pagado o no se estipularon mensualidades para este concepto en el contrato.";
//             }else{
//                 $cantidadxPagar = $datosContrato->cant_enganche;
//             }
//         }else{
//             //Si hay mensualidades estipuladas...
//             //Validamos si existe algún pago
//             $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
//             if ($ultimoPago!=false) {
//                 //Validamos si lo restante por pagar es mayor a lo definido mensual. De ser así colocamos la cantidad del contrato, si no colocamos lo restante.
//                 $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
//                 $restantexPagar = ($datosContrato->cant_enganche - $datosTotalPagado->totalPagado);
//                 if($restantexPagar > $datosContrato->cant_mensual_enganche){
//                     $cantidadxPagar = $datosContrato->cant_mensual_enganche;
//                 }else{
//                     $cantidadxPagar = $restantexPagar;
//                     if($restantexPagar == 0){
//                         $mensaje = "Enganche pagado.";
//                         $mensaje2 = "El enganche ya se encuentra pagado.";
//                     }
//                 }
//             }else{
//                 //Si es el primer pago...
//                 $cantidadxPagar = $datosContrato->cant_mensual_enganche;
//             }
//         }
//     break;
//     case $mensualidadContrato:
        

//         if ($datosContrato->id_tipo_compra == contado || $datosContrato->id_tipo_compra == contadoComercial) {
//             if ($ultimoPago==false) {
//                 $cantidadxPagar = $datosContrato->precio_venta;
//                 $saldoMesAnterior = 0;
//                 $interesMesAnterior = 0;
//             }else{
//                 if ($ultimoPago['balance_final']<=0) {
//                     $cantidadxPagar = 0;
//                     $saldoMesAnterior = 0;
//                     $interesMesAnterior = 0;
//                     $mensaje = "Contrato Pagado.";
//                     $mensaje2 = "El cliente ya pagó por completo el contrato.";
//                 }
//                 $cantidadxPagar = $ultimoPago['balance_final'];
//                 if ($ultimoPago['diferencia'] < 0) {
//                     $saldoMesAnterior = $ultimoPago['diferencia'];
//                 }else {
//                     $saldoMesAnterior = 0;
//                     $interesMesAnterior = 0;
//                 }
//             }
//         }



//         if ($datosContrato->id_tipo_compra == financiado || $datosContrato->id_tipo_compra == msi) {
//              //Validamos que haya una mensualidad definida.
//             if ($datosContrato->monto_mensual!=0) {
//                 //Validamos si existe un ultimo pago.
//                 $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
//                 if($ultimoPago!=false){
//                     $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
//                     $restantexPagar = ($datosContrato->precio_venta - $datosTotalPagado->totalPagado);
//                     if($restantexPagar > $datosContrato->monto_mensual){
//                         $cantidadxPagar = $datosContrato->monto_mensual;
//                     }else{
//                         $cantidadxPagar = $restantexPagar;
//                         if($restantexPagar == 0){
//                             $mensaje = "Contrato pagado.";
//                             $mensaje2 = "El contrato ya se encuentra pagado.";
//                         }
//                     }                
//                 }else{
//                 //Si es el primer pago...
//                 $cantidadxPagar = $datosContrato->monto_mensual; 
//                 }
//             }else{
//                 //Validamos si existe un ultimo pago.
//                 $ultimoPago = consultaPagoxConcepto($id_contrato,$id_concepto);
//                 if($ultimoPago!=false){
//                     $datosTotalPagado = totalPagadoxConcepto($id_contrato,$id_concepto);
//                     $restantexPagar = ($datosContrato->precio_venta - $datosTotalPagado->totalPagado);
//                     if($restantexPagar > $datosContrato->monto_mensual){
//                         $cantidadxPagar = $datosContrato->monto_mensual;
//                     }else{
//                         $cantidadxPagar = $restantexPagar;
//                         if($restantexPagar == 0){
//                             $mensaje = "Contrato pagado.";
//                             $mensaje2 = "El contrato ya se encuentra pagado.";
//                         }
//                     }
//                 }else{
//                     //Si es el primer pago...
//                     $cantidadxPagar = $datosContrato->pago_final;
//                 }
//             }
//         }

       


//     break;
// }

$response = []; 
$response['aux'] = $aux;
$response['interesMesAnterior'] = $interesMesAnterior;
$response['saldoMesAnterior'] = $saldoMesAnterior;
$response['cantidadxPagar'] = $cantidadxPagar;
$response['mensaje'] = $mensaje;
$response['mensaje2'] = $mensaje2;

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

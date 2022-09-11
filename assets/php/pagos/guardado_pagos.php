<?php

session_start();

include "../conexion.php";

$datos = Array();

if(empty($_GET["input_concepto"])){
	$input_concepto="0";
}else{
	$input_concepto=$_GET["input_concepto"];
}//Fin del else

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else
if(empty($_GET["inp_fpago"])){
	$inp_fpago="0";
}else{
	$inp_fpago=$_GET["inp_fpago"];
}//Fin del else

if(empty($_GET["inp_cuenta"])){
	$inp_fpago="0";
}else{
	$inp_cuenta=$_GET["inp_cuenta"];
}//Fin del else

if(empty($_GET["inp_cpagada"])){
	$inp_cpagada="0";
}else{
	$inp_cpagada=$_GET["inp_cpagada"];
}//Fin del else

if(empty($_GET["inp_cuenta"])){
	$inp_cuenta="0";
}else{
	$inp_cuenta=$_GET["inp_cuenta"];
}//Fin del else

if(empty($_GET["inp_recargo"])){
	$inp_recargo="0";
}else{
	$inp_recargo=$_GET["inp_recargo"];
}//Fin del else

if(empty($_GET["inp_interes"])){
	$inp_interes="0";
}else{
	$inp_interes=$_GET["inp_interes"];
}//Fin del else

if(empty($_GET["inp_mensualidad"])){
	$inp_mensualidad="0";
}else{
	$inp_mensualidad=$_GET["inp_mensualidad"];
}//Fin del else

if(empty($_GET["inp_diferencia"])){
	$inp_diferencia="0";
}else{
	$inp_diferencia=$_GET["inp_diferencia"];
}//Fin del else

if(empty($_GET["inp_totpagar"])){
	$inp_totpagar="0";
}else{
	$inp_totpagar=$_GET["inp_totpagar"];
}//Fin del else

if(empty($_GET["inp_comentario"])){
	$inp_comentario="";
}else{
	$inp_comentario=$_GET["inp_comentario"];
}//Fin del else

if(empty($_GET["cambia_estatus"])){
	$cambia_estatus="0";
}else{
	$cambia_estatus=$_GET["cambia_estatus"];
}//Fin del else
if(empty($_GET["inp_tipocambio"])){
	$inp_tipocambio="0";
}else{
	$inp_tipocambio=$_GET["inp_tipocambio"];
}//Fin del else
if(empty($_GET["inp_divisa"])){
	$inp_divisa="0";
}else{
	$inp_divisa=$_GET["inp_divisa"];
}//Fin del else
if(empty($_GET["cant_inicial"])){
	$cant_inicial="0";
}else{
    $cant_inicial=$_GET["cant_inicial"];
}
if(empty($_GET["input_concepto"])){
	$input_concepto="0";
}else{
	$input_concepto=$_GET["input_concepto"];
}//Fin del else
if(empty($_GET["inp_formapago"])){
	$inp_formapago="0";
}else{
	$inp_formapago=$_GET["inp_formapago"];
}//Fin del else

/*
//Formula para calcular la cantidad abonada a capital y abonado a interes
		Abonado a interes:	Balance inicial(Tasa de interés/Cantidad de Mensualidades anuales)
		Abonado a capital: Cantidad_Mensual-Abonado a interés
	TODO: Guardado de datos. 
	Datos a ingresar en la base de datos

*/


$datosContrato = traeDatosContrato($id_contrato);
$ultimoPago = traeUltimoPago($id_contrato);

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

if ($input_concepto == 0) {
    return false;
}

if ($inp_totpagar <= 0) {
    $inp_totpagar = $inp_mensualidad;
}

//CALCULANDO LA FECHA Y NUMERO DE MENSUALIDAD
if ($input_concepto == APARTADO) {
    $no_mensualidad = 1;
    $fecha_mensualidad = $datosContrato['fecha_apartado'];
}
if ($input_concepto == ENGANCHE) {
    if ($datosContrato->mensualidades_enganche == 0 || $datosContrato->mensualidades_enganche ==1 || $datosContrato->cant_mensual_enganche==0) {
        $no_mensualidad = 1;
        $fecha_mensualidad = $datosContrato['fecha_enganche'];
    }else{
        $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,ENGANCHE);
        if ($ultimoPagoMensualidad==false) {
            $no_mensualidad = 1;
            $fecha_mensualidad = $datosContrato['fecha_enganche'];
        }else{
            $no_mensualidad = $ultimoPagoMensualidad['no_mensualidad'] + 1;
            $fecha_ultima_mensualidad = $ultimoPagoMensualidad['fecha_enganche'];
            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
        }
    }
}
if ($input_concepto == MENSUALIDAD_CONTRATO) {
        $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
        if ($ultimoPagoMensualidad==false) {
            $no_mensualidad = 1;
            $fecha_mensualidad = $datosContrato['dia_pago'];
        }else{
            $no_mensualidad = $ultimoPagoMensualidad['no_mensualidad'] + 1;
            $fecha_ultima_mensualidad = $ultimoPagoMensualidad['dia_pago'];
            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
        }
}
if ($input_concepto == PAGO_FINAL) {
    $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
    if ($ultimoPagoMensualidad==false) {
        $no_mensualidad = 1;
        $fecha_mensualidad = $datosContrato['dia_pago'];
    }else{
        $no_mensualidad = $ultimoPagoMensualidad['no_mensualidad'] + 1;
        $fecha_ultima_mensualidad = $ultimoPagoMensualidad['dia_pago'];
        $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
    }
}

if ($datosContrato['id_tipo_compra'] != FINANCIADO) {
    
    $abonado_interes = 0;

    if ($inp_recargo < 0) {
        $saldoAFavor = abs($inp_recargo);
        $totalAFavor = $inp_cpagada + $saldoAFavor;
        if ($totalAFavor > $inp_totpagar) {
            if ($inp_totpagar <= $inp_mensualidad) {
                $abonado_capital = $inp_mensualidad;
                $diferencia = $inp_mensualidad - $totalAFavor;
            }else{
                $abonado_capital = $inp_totpagar;
                $diferencia = $inp_totpagar - $totalAFavor;
            }
        }else{
            if ($inp_totpagar <= $inp_mensualidad) {
                $abonado_capital = $inp_mensualidad;
                $diferencia = $inp_mensualidad - $totalAFavor;
            }else{
                $abonado_capital = $inp_totpagar;
                $diferencia = $inp_totpagar - $totalAFavor;
            }
        } 
    }else{
        $totalAFavor = $inp_cpagada;
        if ($totalAFavor > $inp_totpagar) {
            if ($inp_totpagar <= $inp_mensualidad) {
                $abonado_capital = $inp_mensualidad;
                $diferencia = $inp_mensualidad - $totalAFavor;
            }else{
                $abonado_capital = $inp_totpagar;
                $diferencia = $inp_totpagar - $totalAFavor;
            }
            // $abonado_capital = $inp_totpagar;
            // $diferencia = $inp_totpagar - $totalAFavor;
        }else{  
            if ($inp_totpagar <= $inp_mensualidad) {
                $abonado_capital = $totalAFavor;
                $diferencia = $inp_mensualidad - $totalAFavor;
            }else{
                $abonado_capital = $totalAFavor;
                $diferencia = $inp_totpagar - $totalAFavor;
            }
            // $abonado_capital = $totalAFavor;
            // $diferencia = $inp_totpagar  - $totalAFavor;
        }
    }

    if ($ultimoPago == true) {
        $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
    }else{
        $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
    }
    $id_estatus_pago = calculaIdDiferencia($diferencia);
    $estatus_contrato = $datosContrato['id_estatus_venta'];

    $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
    
    actualizaEstatusContrato($id_contrato);
}



if ($datosContrato['id_tipo_compra'] == FINANCIADO) {
   
    //SI PAGA APARTADO O ENGANCHE TODO SE ABONA A CAPITAL
    if ($input_concepto == APARTADO || $input_concepto == ENGANCHE) {

        $abonado_interes = 0;

        if ($inp_recargo < 0) {
            $saldoAFavor = abs($inp_recargo);
            $totalAFavor = $inp_cpagada + $saldoAFavor;
            if ($totalAFavor > $inp_totpagar) {
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonado_capital = $totalAFavor;
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonado_capital = $inp_totpagar;
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
            }else{
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonado_capital = $totalAFavor;
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonado_capital = $inp_totpagar;
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
            } 
        }else{
            $totalAFavor = $inp_cpagada;
            if ($totalAFavor > $inp_totpagar) {
                $abonado_capital = $inp_totpagar;
                $diferencia = $inp_totpagar - $totalAFavor;
            }else{  
                $abonado_capital = $totalAFavor;
                $diferencia = $inp_totpagar  - $totalAFavor;
            }
        }
    
        if ($ultimoPago == true) {
            $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
        }else{
            $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
        }
        $id_estatus_pago = calculaIdDiferencia($diferencia);
        $estatus_contrato = $datosContrato['id_estatus_venta'];
    
        $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
        
        actualizaEstatusContrato($id_contrato);

    }
    //SI PAGA MENSUALIDAD CONTRATO SE APLICA LA FORMULA DE INTERES.
    if ($input_concepto == MENSUALIDAD_CONTRATO) {
        if ($ultimoPago == true) {
            $balance = $ultimoPago['balance_final'];
        }

        if ($inp_recargo < 0) {
            $saldoAFavor = abs($inp_recargo);
            $totalAFavor = $inp_cpagada + $saldoAFavor;
            if ($totalAFavor > $inp_totpagar) {
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_mensualidad);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_totpagar);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
            }else{
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_mensualidad);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_totpagar);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
            }
        }else{
            $totalAFavor = $inp_cpagada;
            if ($totalAFavor > $inp_totpagar) {
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_mensualidad);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_totpagar);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
                // $abonos = calculaAbononoInteresyCapital($balance, 8, $inp_totpagar);
                // $abonado_capital = $abonos['capital'];
                // $abonado_interes = $abonos['interes'];
                // $diferencia = $inp_totpagar - $totalAFavor;
            }else{
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $totalAFavor);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonos = calculaAbononoInteresyCapital($balance, 8, $totalAFavor);
                    $abonado_capital = $abonos['capital'];
                    $abonado_interes = $abonos['interes'];
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
                // $abonos = calculaAbononoInteresyCapital($balance, 8, $totalAFavor);
                // $abonado_capital = $abonos['capital'];
                // $abonado_interes = $abonos['interes'];
                // $diferencia = $inp_totpagar  - $totalAFavor;
            }
        }

        if ($ultimoPago == true) {
            $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
        }else{
            $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
        }

        $id_estatus_pago = calculaIdDiferencia($diferencia);
        $estatus_contrato = $datosContrato['id_estatus_venta'];
    
        $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
        
        actualizaEstatusContrato($id_contrato);
    }
    //SI PAGA PAGO FINAL.
    if ($input_concepto == PAGO_FINAL) {
       
        $abonado_interes = 0;

        if ($inp_recargo < 0) {
            $saldoAFavor = abs($inp_recargo);
            $totalAFavor = $inp_cpagada + $saldoAFavor;
            if ($totalAFavor > $inp_totpagar) {
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonado_capital = $totalAFavor;
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonado_capital = $inp_totpagar;
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
            }else{
                if ($inp_totpagar <= $inp_mensualidad) {
                    $abonado_capital = $totalAFavor;
                    $diferencia = $inp_mensualidad - $totalAFavor;
                }else{
                    $abonado_capital = $inp_totpagar;
                    $diferencia = $inp_totpagar - $totalAFavor;
                }
            } 
        }else{
            $totalAFavor = $inp_cpagada;
            if ($totalAFavor > $inp_totpagar) {
                $abonado_capital = $inp_totpagar;
                $diferencia = $inp_totpagar - $totalAFavor;
            }else{  
                $abonado_capital = $totalAFavor;
                $diferencia = $inp_totpagar  - $totalAFavor;
            }
        }
    
        if ($ultimoPago == true) {
            $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
        }else{
            $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
        }
        $id_estatus_pago = calculaIdDiferencia($diferencia);
        $estatus_contrato = $datosContrato['id_estatus_venta'];
    
        $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
        
        actualizaEstatusContrato($id_contrato);
    }
}
// if ($datosContrato['id_tipo_compra'] == CONTADO_COMERCIAL) {
//     if ($inp_recargo <= 0) {
//         $saldoAFavor = abs($inp_recargo);
//         $totalAFavor = $inp_cpagada + $saldoAFavor;

//         if ($totalAFavor > $inp_totpagar) {
//             $abonado_capital = $inp_totpagar;
//             $diferencia = $inp_totpagar - $totalAFavor;
//         }else{
//             $abonado_capital = $totalAFavor;
//             $diferencia = $inp_totpagar  - $totalAFavor;
//         } 
//     }else{
//         $totalAFavor = $inp_cpagada;
//         if ($totalAFavor > $inp_totpagar) {
//             $abonado_capital = $inp_totpagar;
//             $diferencia = $inp_totpagar - $totalAFavor;
//         }else{  
//             $abonado_capital = $totalAFavor;
//             $diferencia = $totalAFavor - $inp_totpagar;
//         }
//     }

//     if ($ultimoPago == true) {
//         $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
//     }else{
//         $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
//     }
//     $id_estatus_pago = calculaIdDiferencia($diferencia);
//     $estatus_contrato = $datosContrato['id_estatus_venta'];

//     $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
    
//     actualizaEstatusContrato($id_contrato);
// }
// if ($datosContrato['id_tipo_compra'] == MSI) {
    
//     $abonado_interes = 0;

//     if ($inp_recargo <= 0) {
//         $saldoAFavor = abs($inp_recargo);
//         $totalAFavor = $inp_cpagada + $saldoAFavor;
//         if ($totalAFavor > $inp_totpagar) {
//             if ($inp_totpagar <= $inp_mensualidad) {
//                 $abonado_capital = $totalAFavor;
//                 $diferencia = $inp_mensualidad - $totalAFavor;
//             }else{
//                 $abonado_capital = $inp_totpagar;
//                 $diferencia = $inp_totpagar - $totalAFavor;
//             }
//         }else{
//             if ($inp_totpagar <= $inp_mensualidad) {
//                 $abonado_capital = $totalAFavor;
//                 $diferencia = $inp_mensualidad - $totalAFavor;
//             }else{
//                 $abonado_capital = $inp_totpagar;
//                 $diferencia = $inp_totpagar - $totalAFavor;
//             }
//             // $abonado_capital = $totalAFavor;
//             // $diferencia = $inp_totpagar  - $totalAFavor;
//         } 
//     }else{
//         $totalAFavor = $inp_cpagada;
//         if ($totalAFavor > $inp_totpagar) {
//             $abonado_capital = $inp_totpagar;
//             $diferencia = $inp_totpagar - $totalAFavor;
//         }else{  
//             $abonado_capital = $totalAFavor;
//             $diferencia = $inp_totpagar  - $totalAFavor;
//         }
//     }

//     if ($ultimoPago == true) {
//         $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
//     }else{
//         $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
//     }
//     $id_estatus_pago = calculaIdDiferencia($diferencia);
//     $estatus_contrato = $datosContrato['id_estatus_venta'];

//     $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
    
//     actualizaEstatusContrato($id_contrato);
// }

// if ($datosContrato['id_tipo_compra'] == CONTADO) {
//     $abonado_interes = 0; 
//     if ($inp_recargo <= 0) {
//         $saldoAFavor = abs($inp_recargo);
//         $totalAFavor = $inp_cpagada + $saldoAFavor;

//         if ($totalAFavor > $inp_totpagar) {
//             $abonado_capital = $inp_totpagar;
//             $diferencia = $inp_totpagar - $totalAFavor;
//         }else{
//             $abonado_capital = $totalAFavor;
//             $diferencia = $inp_totpagar  - $totalAFavor;
//         } 
//     }else{
//         $totalAFavor = $inp_cpagada;
//         if ($totalAFavor > $inp_totpagar) {
//             $abonado_capital = $inp_totpagar;
//             $diferencia = $inp_totpagar - $totalAFavor;
//         }else{  
//             $abonado_capital = $totalAFavor;
//             $diferencia = $totalAFavor - $inp_totpagar;
//         }
//     }

//     if ($ultimoPago == true) {
//         $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
//     }else{
//         $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
//     }
//     $id_estatus_pago = calculaIdDiferencia($diferencia);
//     $estatus_contrato = $datosContrato['id_estatus_venta'];

//     $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);      
    
//     actualizaEstatusContrato($id_contrato);

// }





function actualizaEstatusContrato($id_contrato){
    $datosContrato = traeDatosContrato($id_contrato);
    $totalPagadoApartado = totalPagadoxConcepto($id_contrato,APARTADO);
    $totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
    $totalPagadoMensualidad = totalPagadoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
    $totalPagadoPagoFinal = totalPagadoxConcepto($id_contrato,PAGO_FINAL);
    $totalPagadoGlobal = totalPagadoGlobal($id_contrato);

    if ($datosContrato['cant_apartado'] <= $totalPagadoApartado) {
        $nuevoEstatus = 1;
    }
    if ($datosContrato['mensualidades_enganche'] == 0 && $datosContrato['cant_mensual_enganche'] == 0) {
        if ($datosContrato['cant_enganche'] <= $totalPagadoEnganche) {
            $nuevoEstatus = 2;
        }
    }
    if ($datosContrato['mensualidades_enganche'] != 0 && $datosContrato['cant_mensual_enganche'] != 0) {
        $engenchexPagar = $datosContrato['mensualidades_enganche'] * $datosContrato['cant_mensual_enganche'];
        if ($engenchexPagar <= $totalPagadoEnganche) {
            $nuevoEstatus = 2;
        }
    }
    if ($datosContrato['id_tipo_compra']!=CONTADO) {
        $totalAPagar = $datosContrato['monto_mensual'] * $datosContrato['mensualidades'];
        if ($totalAPagar <= $totalPagadoMensualidad ) {
            $nuevoEstatus = 3;
        }
    }
    if ($datosContrato['precio_venta'] <= $totalPagadoGlobal) {
        $nuevoEstatus = 4;
    }
    if ($nuevoEstatus) {
        $sql = "UPDATE contrato set id_estatus_venta = $nuevoEstatus where id_contrato = $id_contrato";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
    }
    


   
}

function totalPagadoGlobal($id_contrato){
    $sql="SELECT sum(abonado_capital) as totalPagado FROM pagos WHERE id_contrato = $id_contrato AND habilitado = 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row = mysqli_fetch_assoc($result);
    return $row['totalPagado'];
}

function totalPagadoxConcepto($id_contrato,$id_concepto){
    $sql="SELECT (sum(abonado_capital) + sum(abonado_interes)) as totalPagado FROM pagos WHERE id_contrato = $id_contrato AND id_concepto = $id_concepto AND habilitado = 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row = mysqli_fetch_assoc($result);
    return $row['totalPagado'];
}


function calculaIdDiferencia($diferencia){
    if($diferencia == "" || $diferencia <= 0){
        return 1;
    }else{
        return 2;
    };
}

function calculaAbononoInteresyCapital($balanceFinal, $tasaInteres, $cantidadPagada){
    $abonos = [];
    $abonos['interes'] = $balanceFinal * ( ($tasaInteres / 100) / 12);
    $abonos['capital'] = $cantidadPagada - $abonos['interes'];
    return $abonos;
}

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

function guardaPago($id_contrato,$fecha_pago,$id_cuenta_bancaria,$no_mensualidad,$monto_pagado,$divisa,$tipo_cambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,$comentario,$id_concepto,$mensualidad_historica,$fecha_mensualidad,$balance_final,$forma_pago,$estatus_contrato){
   
    $fecha_captura = date('Y-m-d');

    $sql=" INSERT INTO pagos (id_contrato, fecha_pago, id_cuenta_bancaria, no_mensualidad, monto_pagado, divisa, tipo_cambio, cant_inicial, abonado_capital, abonado_interes, diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad, fecha_captura, balance_final, forma_pago, estatus_contrato, habilitado) values ($id_contrato,'$fecha_pago',$id_cuenta_bancaria,$no_mensualidad,$monto_pagado,'$divisa',$tipo_cambio,$cant_inicial,$abonado_capital,$abonado_interes,$diferencia,$id_estatus_pago,'$comentario',$id_concepto,$mensualidad_historica,'$fecha_mensualidad','$fecha_captura',$balance_final,'$forma_pago',$estatus_contrato,1)";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    if ($result==true){
        return $sql;
    }else{
        return $sql;
    }
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


ob_clean();
$datosSalida = Array();
$datosSalida['guardado'] = $guardadoPago;
$datosSalida['id_contrato'] = $id_contrato;
$datosSalida['inp_diferencia'] = $inp_diferencia;

echo json_encode($datosSalida);



?>
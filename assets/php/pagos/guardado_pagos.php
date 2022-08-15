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
$input_concepto =  $_GET["input_concepto"];
$id_contrato =  $_GET["id_contrato"];
$inp_fpago =  $_GET["inp_fpago"];
$inp_cpagada =  $_GET["inp_cpagada"];
$inp_formpago =  $_GET["inp_formpago"];
$inp_recargo =  $_GET["inp_recargo"];
$inp_interes =  $_GET["inp_interes"];
$inp_mensualidad =  $_GET["inp_mensualidad"];
$inp_diferencia =  $_GET["inp_diferencia"];
$inp_totpagar =  $_GET["inp_totpagar"];
$inp_comentario =  $_GET["inp_comentario"];
$cambia_estatus =  $_GET["cambia_estatus"];
inp_formapago

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


/*

" INSERT INTO pagos (id_contrato, fecha_pago, id_cuenta_bancaria, no_mensualidad, monto_pagado, divisa, tipo_cambio, cant_inicial, abonado_capital, abonado_interes, diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad, fecha_captura, balance_final, forma_pago, estatus_contrato, habilitado) values (195,'2022-08-25',1,,386.57,'USD',1,300,327.09,59.48,-2985.43,1,'',3,386.57,'2021-11-10','2022-08-14',35360.91,'0',1,1)"
 */
if ($datosContrato['id_tipo_compra'] == CONTADO) {
    $no_mensualidad = 1;
    $abonado_interes = 0; 
    $abonado_capital = $inp_cpagada;
    
    $balance_final = $datosContrato['precio_venta'] - $abonado_capital;

    if($inp_diferencia == "" || $inp_diferencia <= 0){
        $id_estatus_pago = 1;
    }else{
        $id_estatus_pago = 2;
    };

    $estatus_contrato = $datosContrato['id_estatus_venta'];
    
    $fecha_mensualidad = date("Y-m-d");//En una compra de contado no hay mensualidades, colocamos la fecha en que se captura el pago.

    if ($ultimoPago == true) {
        $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
        $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
    }

    if ($inp_cpagada <=0 && $inp_recargo < 0) {
        //Si tenemos un saldo a favor y no se introduce una cantidad pagada. Se toma el saldo a favor para pagar.
        //Se coloca abs() para obtener el valor absoluto del numero, ya que la cantidad puede ser negativa.
        if ($inp_mensualidad > abs($inp_recargo)) {
            $monto_pagado = abs($inp_recargo);
            $abonado_capital = abs($inp_recargo);
            $inp_diferencia =  $inp_mensualidad - abs($inp_recargo); 
        }else{
            $monto_pagado = abs($inp_recargo);
            $abonado_capital = abs($inp_recargo);
            $inp_diferencia = $inp_mensualidad - abs($inp_recargo); 
        }
    }
    $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 

}

if ($datosContrato['id_tipo_compra'] == FINANCIADO) {
   
    //SI PAGA APARTADO O ENGANCHE TODO SE ABONA A CAPITAL
    if ($input_concepto == APARTADO || $input_concepto == ENGANCHE) {
            $abonado_capital = $inp_cpagada;
            $abonado_interes = 0;
            $no_mensualidad = 0;
            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $fecha_mensualidad = date("Y-m-d");
            $estatus_contrato = $datosContrato['id_estatus_venta'];
            $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
            if ($ultimoPago == true) {
                $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
                $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
            }
            //Si paga mas de su mensualidad
            if ($inp_cpagada > $inp_mensualidad) {
                $abonado_capital = $inp_mensualidad;
            }
            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);

    }
    //SI PAGA MENSUALIDAD CONTRATO SE APLICA LA FORMULA DE INTERES.
    if ($input_concepto == MENSUALIDAD_CONTRATO) {

        //Calculando la fecha de la mensualidad
        $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
        if ($ultimoPagoMensualidad==false) {
            $no_mensualidad = 1;
            $fecha_mensualidad = $datosContrato['dia_pago'];
        }else{
            $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
            $fecha_ultima_mensualidad = $ultimoPago['fecha_mensualidad'];
            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
        }
        //Paga menos de la mensualidad pero tiene saldo a favor
        if ($inp_cpagada < $inp_mensualidad && $inp_recargo<0) {
            $aFavor = $inp_cpagada + abs($inp_recargo);   
            if ($aFavor >= $inp_mensualidad) {
                $inp_cpagada = $inp_mensualidad;
            }else{
                $inp_cpagada = $aFavor;
            }
            $inp_diferencia = $inp_mensualidad - $aFavor;
            //Formula para calcular interes.
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];

            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);
        }
        //Pagando con el saldo a favor.
        if ($inp_cpagada <=0 && $inp_recargo < 0) {
            //Si tenemos un saldo a favor y no se introduce una cantidad pagada. Se toma el saldo a favor para pagar.
            //Se coloca abs() para obtener el valor absoluto del numero, ya que la cantidad puede ser negativa.
            if ($inp_mensualidad > abs($inp_recargo)) {
                $inp_cpagada = abs($inp_recargo);
                $restante =  $inp_mensualidad - abs($inp_recargo); 
            }else{
                $inp_cpagada = $inp_mensualidad;
                $restante = $inp_mensualidad - abs($inp_recargo); 
            }
            //Formula para calcular interes.
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];

            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);
        }
        if ($inp_cpagada >= $inp_mensualidad) {
            
            $inp_cpagada = $inp_mensualidad;
            //Formula para calcular interes.
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];
            
            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 
        }   
        if ($inp_cpagada < $inp_mensualidad && $inp_diferencia >= 0) {
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];
            
            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 
            
        }    
        

        // //Formula para calcular interes.
        // $balance = $datosContrato['precio_venta'];
        // if ($ultimoPago == true) {
        //     $balance = $ultimoPago['balance_final'];
        // }
        // $abonado_interes = $balance*((2/100)/12);
        // $abonado_capital = $inp_cpagada-$abonado_interes;
        // $balance_final = $balance-$abonado_capital;
    
        // $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);
    }
    //Si paga menos de la mensualidad pero tiene saldo a favor.
    //Si paga mas de la mensualidad.
    //Si no paga nada.



    // //Paga menos de la mensualidad pero tiene saldo a favor
    // if ($inp_cpagada < $inp_mensualidad && $inp_recargo<0) {
    //     $aFavor = $inp_cpagada + abs($inp_recargo);   
    //     if ($aFavor >= $inp_mensualidad) {
    //         $abonado_capital = $inp_mensualidad;
    //     }else{
    //         $abonado_capital = $aFavor;
    //     }
    //     $inp_diferencia = $inp_mensualidad - $aFavor;
    // }
    // //Calculando la fecha de la mensualidad
    // $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
    // if ($ultimoPagoMensualidad==false) {
    //     $fecha_mensualidad = $datosContrato['dia_pago'];
    // }else{
    //     $fecha_ultima_mensualidad = $ultimoPago['fecha_mensualidad'];
    //     $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
    // }
    // //Pagando con el saldo a favor.
    // if ($inp_cpagada <=0 && $inp_recargo < 0) {
    //     //Si tenemos un saldo a favor y no se introduce una cantidad pagada. Se toma el saldo a favor para pagar.
    //     //Se coloca abs() para obtener el valor absoluto del numero, ya que la cantidad puede ser negativa.
    //     if ($inp_mensualidad > abs($inp_recargo)) {
    //         $inp_cpagada = abs($inp_recargo);
    //         $abonado_capital = abs($inp_recargo);
    //         $restante =  $inp_mensualidad - abs($inp_recargo); 
    //     }else{
    //         $inp_cpagada = $inp_mensualidad;
    //         $abonado_capital = $inp_mensualidad;
    //         $restante = $inp_mensualidad - abs($inp_recargo); 
    //     }
    // }
    // if ($ultimoPago == true) {
    //     $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
    //     $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
    // }
    // //Aplicando la formula sobre los valores modificados.
    // if ($ultimoPago == true && $input_concepto == MENSUALIDAD_CONTRATO) {
    //     $balance = $ultimoPago['balance_final'];
    //     $abonado_interes = $balance*((2/100)/12);
    //     $abonado_capital = $inp_cpagada-$abonado_interes;
    //     $balance_final = $balance-$abonado_capital;
    // }
    // if($inp_diferencia == "" || $inp_diferencia <= 0){
    //     $id_estatus_pago = 1;
    // }else{
    //     $id_estatus_pago = 2;
    // };
    // $estatus_contrato = $datosContrato['id_estatus_venta'];

    // $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 

}

if ($datosContrato['id_tipo_compra'] == CONTADO_COMERCIAL) {
    $no_mensualidad = 1;
    $abonado_interes = 0; 

    
    if ($inp_mensualidad > $inp_cpagada) {
        $abonado_capital = $inp_cpagada;
    }else{
        $abonado_capital = $inp_mensualidad;
    }
    $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
    if($inp_diferencia == "" || $inp_diferencia <= 0){
        $id_estatus_pago = 1;
    }else{
        $id_estatus_pago = 2;
    };
    $estatus_contrato = $datosContrato['id_estatus_venta'];
    
    $fecha_mensualidad = date("Y-m-d");//En una compra de contado no hay mensualidades, colocamos la fecha en que se captura el pago.
    $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
    if ($input_concepto == MENSUALIDAD_CONTRATO) {
        if ($ultimoPagoMensualidad==false) {
            $fecha_mensualidad = $datosContrato['dia_pago'];
        }else{
            $fecha_ultima_mensualidad = $ultimoPago['fecha_mensualidad'];
            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
        }
    }

    if ($inp_cpagada < $inp_mensualidad && $inp_recargo<0) {
        $aFavor = $inp_cpagada + abs($inp_recargo);   
        if ($aFavor >= $inp_mensualidad) {
            $abonado_capital = $inp_mensualidad;
        }else{
            $abonado_capital = $aFavor;
        }
        $inp_diferencia = $inp_mensualidad - $aFavor;
    }

    if ($ultimoPago == true) {
        $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
        $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
    }
    
    if ($inp_cpagada <=0 && $inp_recargo < 0) {
        //Si tenemos un saldo a favor y no se introduce una cantidad pagada. Se toma el saldo a favor para pagar.
        //Se coloca abs() para obtener el valor absoluto del numero, ya que la cantidad puede ser negativa.
        if ($inp_mensualidad > abs($inp_recargo)) {
            $monto_pagado = abs($inp_recargo);
            $abonado_capital = abs($inp_recargo);
            $restante =  $inp_mensualidad - abs($inp_recargo); 
        }else{
            $monto_pagado = $inp_mensualidad;
            $abonado_capital = $inp_mensualidad;
            $restante = $inp_mensualidad - abs($inp_recargo); 
        }

        $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$monto_pagado,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);
    }else{
        

        $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 
    }
}
if ($datosContrato['id_tipo_compra'] == MSI) {
   
    //SI PAGA APARTADO O ENGANCHE TODO SE ABONA A CAPITAL
    if ($input_concepto == APARTADO || $input_concepto == ENGANCHE) {
            $abonado_capital = $inp_cpagada;
            $abonado_interes = 0;
            $no_mensualidad = 0;
            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $fecha_mensualidad = date("Y-m-d");
            $estatus_contrato = $datosContrato['id_estatus_venta'];
            $balance_final = $datosContrato['precio_venta'] - $abonado_capital;
            if ($ultimoPago == true) {
                $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
                $balance_final = $ultimoPago['balance_final'] - $abonado_capital;  
            }
            //Si paga mas de su mensualidad
            if ($inp_cpagada > $inp_mensualidad) {
                $abonado_capital = $inp_mensualidad;
            }
            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);

    }
    //SI PAGA MENSUALIDAD CONTRATO SE APLICA LA FORMULA DE INTERES.
    if ($input_concepto == MENSUALIDAD_CONTRATO) {

        //Calculando la fecha de la mensualidad
        $ultimoPagoMensualidad = ConsultaPagoxConcepto($id_contrato,MENSUALIDAD_CONTRATO);
        if ($ultimoPagoMensualidad==false) {
            $no_mensualidad = 1;
            $fecha_mensualidad = $datosContrato['dia_pago'];
        }else{
            $no_mensualidad = $ultimoPago['no_mensualidad'] + 1;
            $fecha_ultima_mensualidad = $ultimoPago['fecha_mensualidad'];
            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
        }
        //Paga menos de la mensualidad pero tiene saldo a favor
        if ($inp_cpagada < $inp_mensualidad && $inp_recargo<0) {
            $aFavor = $inp_cpagada + abs($inp_recargo);   
            if ($aFavor >= $inp_mensualidad) {
                $inp_cpagada = $inp_mensualidad;
            }else{
                $inp_cpagada = $aFavor;
            }
            $inp_diferencia = $inp_mensualidad - $aFavor;
            //Formula para calcular interes.
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];

            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);
        }
        //Pagando con el saldo a favor.
        if ($inp_cpagada <=0 && $inp_recargo < 0) {
            //Si tenemos un saldo a favor y no se introduce una cantidad pagada. Se toma el saldo a favor para pagar.
            //Se coloca abs() para obtener el valor absoluto del numero, ya que la cantidad puede ser negativa.
            if ($inp_mensualidad > abs($inp_recargo)) {
                $inp_cpagada = abs($inp_recargo);
                $restante =  $inp_mensualidad - abs($inp_recargo); 
            }else{
                $inp_cpagada = $inp_mensualidad;
                $restante = $inp_mensualidad - abs($inp_recargo); 
            }
            //Formula para calcular interes.
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];

            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato);
        }
        if ($inp_cpagada >= $inp_mensualidad) {
            
            $inp_cpagada = $inp_mensualidad;
            //Formula para calcular interes.
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];
            
            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 
        }   
        if ($inp_cpagada < $inp_mensualidad && $inp_diferencia >= 0) {
            $balance = $datosContrato['precio_venta'];
            if ($ultimoPago == true) {
                $balance = $ultimoPago['balance_final'];
            }
            $abonado_interes = $balance*((2/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $balance_final = $balance-$abonado_capital;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $estatus_contrato = $datosContrato['id_estatus_venta'];
            
            $guardadoPago = guardaPago($id_contrato,$inp_fpago, $inp_cuenta,$no_mensualidad,$inp_cpagada,$inp_divisa,$inp_tipocambio,$cant_inicial,$abonado_capital,$abonado_interes,$inp_diferencia,$id_estatus_pago,$inp_comentario,$input_concepto,$inp_mensualidad,$fecha_mensualidad,$balance_final,$inp_formapago,$estatus_contrato); 
            
        }    
        
    }
    
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
        return true;
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





/*

//Obtenemos el estatus que tenía el contrato
$sql = "SELECT id_estatus_venta, tasa_interes, monto_mensual, precio_venta FROM contrato WHERE id_contrato = '$id_contrato'";
$result=mysqli_query(conectar(),$sql);
desconectar();
$row=mysqli_fetch_array($result);
$ultima_mensualidad = 0;
$estatus_contrato = $row['id_estatus_venta'];
$balance = $row['precio_venta'];
$monto_mensual = $row['monto_mensual'];
$interes = $row['tasa_interes']; //TODO: Cambiar el nombre del campo en la bd a tasa_interes

//Obtenemos la fecha correspondiente a la mensualidad del enganche

//Obtenemos el número de la última mensualidad pagada
$sql = "SELECT balance_final, no_mensualidad = (SELECT max(no_mensualidad) from pagos) from pagos where id_contrato = '$id_contrato'";
$result=mysqli_query(conectar(),$sql);
desconectar();
$rows = mysqli_num_rows($result);
if($rows > 0){
    $row=mysqli_fetch_array($result);
    $ultima_mensualidad = $row['no_mensualidad'];
    $balance = $row['balance_final'];
}
//Obteniendo abonado a interés
//Formula Abonado a interes:	Balance inicial(Tasa de interés/Cantidad de Mensualidades anuales)
//Si no hay una última mensualidad tomamos el balance valor del contrato



//Generando el estatus del pago.
if($inp_diferencia == "" || $inp_diferencia == 0){
    $id_estatus_pago = 1;
}else{
    $id_estatus_pago = 2;
};





//Ahora aplicamos la formula

$abonado_interes = $balance*(($tasa_interes/100)/12); 

//Obteniendo abonado a capital
//Abonado a capital: Cantidad_Mensual-Abonado a interés
$abonado_capital = $inp_cpagada-$abonado_interes;

//Obteniendo balance final
$balance_final = $balance - $abonado_capital;

//nueva mensualidad
$ultima_mensualidad++;


$sql = "INSERT INTO pagos (id_contrato, fecha_pago, no_mensualidad, abonado_capital, abonado_interes,
        diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad,
        balance, estatus_contrato, habilitado
    ) 
values ($id_contrato,$inp_fpago,$ultima_mensualidad,$abonado_capital,$abonado_interes
        $inp_diferencia, $id_estatus_pago, $inp_comentario, $input_concepto, $inp_mensualidad, 2022-03-15, 
        $balance, $estatus_contrato,1
)";

	Abonado a interes:	Balance inicial(Tasa de interés/Cantidad de Mensualidades anuales)
		Abonado a capital: Cantidad_Mensual-Abonado a interés
	TODO: Guardado de datos.
	Datos a ingresar en la base de datos

	id_contrato
	fecha_pago✅
	no_mensualidad✅
	monto_pagado✅
	abonado_capital (obtenido por formula)
	abonado_interes	(obtenido por formula)
	diferencia✅
	id_estatus_pago	(obtenido por formula)✅
	comentario✅
	id_concepto✅
	mensualidad_historica✅
	fecha_mensualidad
	fecha_captura(auto)
	$balance (obtenido por formula)
	balance_final (obtenido por formula)
    estatus_contrato✅
	habilitado✅


	*/




ob_clean();
$datosSalida = Array();
//$datosSalida['abonado_interes'] = $abonado_interes;
//$datosSalida['ultima_mensualidad'] = $ultima_mensualidad;
//$datosSalida['abonado_capital'] = $abonado_capital;
//$datosSalida['id_estatus_pago'] = $id_estatus_pago;
//$datosSalida['estatus_contrato'] = $estatus_contrato;
//$datosSalida['monto_mensual'] = $monto_mensual;
//$datosSalida['balance_final'] = $balance_final;
//$datosSalida['interes'] = $interes;
// $datosSalida['sql'] = utf8_encode($sql);
$datosSalida['guardado'] = $guardadoPago;
$datosSalida['id_contrato'] = $id_contrato;
$datosSalida['inp_diferencia'] = $inp_diferencia;
// $datosSalida['result'] = $result;

//$datosSalida['cambia_estatus'] = $cambia_estatus;


echo json_encode($datosSalida);



?>
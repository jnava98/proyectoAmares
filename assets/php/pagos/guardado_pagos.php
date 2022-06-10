<?php

session_start();

include "../conexion.php";
/*  input_concepto:input_concepto,
    inp_fpago:inp_fpago,
    inp_cpagad:inp_cpagada,
    inp_formpago:inp_formpago,
    inp_recargo:inp_recargo,
    inp_interes:inp_interes,
    inp_mensualidad:inp_mensualidad,
    inp_diferencia:inp_diferencia,
    inp_totpagar:inp_totpagar,
    inp_comentario:inp_comentario
*/ 
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


//Formula para calcular la cantidad abonada a capital y abonado a interes
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
	id_estatus_pago	(obtenido por formula)
	comentario✅
	id_concepto✅
	mensualidad_historica
	fecha_mensualidad✅
	fecha_captura(auto)
	balance_final (obtenido por formula)
    estatus_contrato
	habilitado✅
*/

$datosContrato = traeDatosContrato($id_contrato);
$ultimoPago = traeUltimoPago($id_contrato);

        //Obtenemos los datos del contrato
        $cant_mensual_enganche = $datosContrato['monto_mensual'];
        $total_pagar = $datosContrato['precio_venta'];
        $fecha_mensualidad = $datosContrato['dia_pago'];
        $estatus_contrato = $datosContrato['id_estatus_venta'];
        $balance = $datosContrato['precio_venta'];
        $tasa_interes = $datosContrato['tasa_interes'];
        //Consultamos si existe un pago anterior
        if ($ultimoPago == true) {
            $ultima_mensualidad = $ultimoPago['no_mensualidad'];
            $fecha_ultima_mensualidad = $ultimoPago['fecha_mensualidad'];
            $balance = $ultimoPago['balance_final'];
            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));

            //Comenzamos a generar los datos para insertar
            $fecha_pago = $inp_fpago;
            $cuenta = $inp_cuenta;
            $no_mensualidad = $ultima_mensualidad + 1;
            $monto_pagado = $inp_cpagada;
            $divisa = $inp_divisa;
            $tipo_cambio = $inp_tipocambio;
            $abonado_interes = $balance*(($tasa_interes/100)/12);
            $abonado_capital = $inp_cpagada-$abonado_interes;
            $diferencia = $inp_diferencia;
            if($inp_diferencia == "" || $inp_diferencia == 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };
            $comentario = $inp_comentario;
            $concepto = $input_concepto;
            $mensualidad_historica = $inp_mensualidad;

            $fecha_captura = date("Y-m-d");
            $balance_final = $balance - $abonado_capital;
            
            $fecha_ultima_mensualidad;

            $fecha_mensualidad;

            $sql = "INSERT INTO pagos (id_contrato, fecha_pago, id_cuenta_bancaria, no_mensualidad,monto_pagado, divisa, tipo_cambio, cant_inicial, abonado_capital, abonado_interes,
        diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad,
        balance_final, estatus_contrato, habilitado, fecha_captura
            ) 
        values ('$id_contrato','$inp_fpago','$cuenta','$no_mensualidad','$inp_cpagada','$divisa','$tipo_cambio',$cant_inicial,'$abonado_capital','$abonado_interes',
                '$inp_diferencia', '$id_estatus_pago', '$inp_comentario', '$input_concepto', '$inp_mensualidad', '$fecha_mensualidad', 
                '$balance_final', '$estatus_contrato','1',$fecha_captura)";
        $result=mysqli_query(conectar(),$sql);

        }else{
            //CUANDO ES EL PRIMER PAGO
            
            $fecha_pago = $inp_fpago;

            $cuenta = $inp_cuenta;

            $no_mensualidad = 1;

            $monto_pagado = $inp_cpagada;

            $divisa = $inp_divisa;

            $tipo_cambio = $inp_tipocambio;

            $abonado_interes = $balance*(($tasa_interes/100)/12); 

            $abonado_capital = $inp_cpagada-$abonado_interes;

            $diferencia = $inp_diferencia;

            if($inp_diferencia == "" || $inp_diferencia <= 0){
                $id_estatus_pago = 1;
            }else{
                $id_estatus_pago = 2;
            };

            $comentario = $inp_comentario;

            $concepto = $input_concepto;

            $mensualidad_historica = $inp_mensualidad;

            $fecha_mensualidad = date("Y-m-d",strtotime($fecha_mensualidad."+ 1 month")); 

            $fecha_captura = date("Y-m-d");

            $balance_final = $balance - $abonado_capital;
            
            $fecha_ultima_mensualidad;

            $fecha_mensualidad;
            $sql = "INSERT INTO pagos (id_contrato, fecha_pago, id_cuenta_bancaria, no_mensualidad,monto_pagado, divisa, tipo_cambio, cant_inicial, abonado_capital, abonado_interes,
        diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad,
        balance_final, estatus_contrato, habilitado
            ) 
        values ('$id_contrato','$inp_fpago','$cuenta','$no_mensualidad','$inp_cpagada','$divisa','$tipo_cambio',$cant_inicial,'$abonado_capital','$abonado_interes',
                '$inp_diferencia', '$id_estatus_pago', '$inp_comentario', '$input_concepto', '$inp_mensualidad', '$fecha_mensualidad', 
                '$balance_final', '$estatus_contrato','1')";
        $result=mysqli_query(conectar(),$sql);
        }

        




/*Comenzamos con el concepto del pago
//Dependiendo del concepto es la información que vamos a guardar-
switch($input_concepto){
    case 1:
        //Apartado

        $sql="SELECT fecha_apartado, id_estatus_venta from contrato where id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $fecha_apartado = $row['fecha_apartado'];
        $id_estatus_venta = $row['id_estatus_venta'];

        //Generando el estatus del pago.
        if($inp_diferencia == "" || $inp_diferencia == 0){
            $id_estatus_pago = 1;
        }else{
            $id_estatus_pago = 2;
        };
        //Insertamos monto pagado
        $sql = "INSERT INTO pagos (id_contrato, fecha_pago, no_mensualidad, monto_pagado, abonado_capital, abonado_interes, diferencia, id_estatus_pago,comentario, id_concepto, mensualidad_historica, fecha_mensualidad, balance_final, estatus_contrato, habilitado) 
                VALUES ('$id_contrato','$inp_fpago','1', '$inp_cpagada', '0', '0', '$inp_diferencia', '$id_estatus_pago', '$inp_comentario','$input_concepto','0','$fecha_apartado','0','$id_estatus_venta','1')";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        //Cambiamos el estatus del contrato
        $sql = "UPDATE contrato set id_estatus_venta = id_estatus_venta + 1 where id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        break;
    case 2:
        //Enganche
        //Insertamos monto pagado
        $sql = "INSERT ";
        //Cambiamos el estatus del contrato
        $sql = "UPDATE contrato set id_estatus_venta = id_estatus_venta + 2 where id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);

        break;
    case 3:
    
        $sql ="SELECT * FROM pagos where id_contrato = '$id_contrato' and id_concepto = 3 and habilitado = 1 limit 1"; //TODO: Optimizar
        //$sql = "SELECT no_mensualidad = (SELECT max(no_mensualidad) from pagos) from pagos where id_contrato = '$id_contrato' and id_concepto = 3 and habilitado = 1";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $sql ="SELECT max(no_mensualidad) as no_mensualidad FROM pagos where id_contrato = '$id_contrato' and id_concepto = 3 and habilitado = 1";
            $result=mysqli_query(conectar(),$sql);
            $row=mysqli_fetch_array($result);
            desconectar();
            $ultima_mensualidad = $row['no_mensualidad'];

            //Consultamos si existe otro pago anterior de cualquier tipo para obtener el contador de la última mensualidad
            //$sql="SELECT max(no_mensualidad) fecha_mensualidad from pagos where id_contrato = '$id_contrato' and habilitado = 1";
            $sql = "SELECT id_pago from pagos where id_contrato = '$id_contrato' and habilitado = 1 limit 1";  //TODO: Optimizar
            $result=mysqli_query(conectar(),$sql);
            $rows = mysqli_num_rows($result);
            if($rows>0){
                $sql="SELECT max(no_mensualidad) as no_mensualidad,  fecha_mensualidad FROM pagos WHERE id_contrato = '$id_contrato' AND habilitado = 1";
                //$sql="SELECT no_mensualidad, fecha_mensualidad = (SELECT max(fecha_mensualidad) from pagos) from pagos where id_contrato = '$id_contrato' and habilitado = 1";
                $result=mysqli_query(conectar(),$sql);
                $row=mysqli_fetch_array($result);
                desconectar();
                $ultima_mensualidad = $row['no_mensualidad'];
                $fecha_ultima_mensualidad = $row['fecha_mensualidad'];
                //Agregamos un mes extra a la mensualidad de ese pago
                $fecha_mensualidad = date("Y-m-d",strtotime($fecha_ultima_mensualidad."+ 1 month"));
            }
        }
        //Generando el estatus del pago.
        if($inp_diferencia == "" || $inp_diferencia == 0){
            $id_estatus_pago = 1;
        }else{
            $id_estatus_pago = 2;
        };

        //Obtenemos la fecha correspondiente a la mensualidad del enganche
        $ultima_mensualidad++;

        
        
        //Insertamos el pago
        $sql = "INSERT INTO pagos (id_contrato, fecha_pago, no_mensualidad, abonado_capital, abonado_interes,
        diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad,
        balance_final, estatus_contrato, habilitado
            ) 
        values ('$id_contrato','$inp_fpago','$ultima_mensualidad','0','0',
                '$inp_diferencia', '$id_estatus_pago', '$inp_comentario', '$input_concepto', '$inp_mensualidad', '$fecha_mensualidad', 
                '0', '$estatus_contrato','1'
        )";
        $result=mysqli_query(conectar(),$sql);

        //Comprobamos si el pago va a cambiar el estatus del contrato.
        //Obtenemos la cantidad pagada por el usuario
        //$sql="SELECT sum(monto_pagado) from pagos where id_contrato = '$id_contrato' and id_concepto = 3 and habilitado = 1";
       // $result=mysqli_query(conectar(),$sql);
        //$row=mysqli_fetch_array($result);
       // $total_pagado_enganche = $row['monto_pagado'];
        //Generamos el restante a pagar
       // $restante = $total_pagar_enganche - $total_pagado_enganche;
       // if($restante <= $cant_mensual_enganche){

       // }
        
        break;
    case 4:
        //Pendiente Firma de Contrato 
        break;  
    case 5:
        //Contrato Firmado
        break;
        
        //1 apartado
        //2 mensualidad enganche
        //3 mensualidad enganche
}*/

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
    $sql="SELECT  * FROM pagos WHERE id_contrato = '$id_contrato' AND habilitado IS true ORDER BY no_mensualidad DESC LIMIT 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    if ($result==true) {
        $row=mysqli_fetch_array($result);
        return $row;
    }else{
        return false;
    }
    
};






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
$datosSalida['sql'] = utf8_encode($sql);
$datosSalida['id_contrato'] = $id_contrato;
$datosSalida['inp_diferencia'] = $inp_diferencia;
$datosSalida['result'] = $result;

//$datosSalida['cambia_estatus'] = $cambia_estatus;


echo json_encode($datosSalida);



?>
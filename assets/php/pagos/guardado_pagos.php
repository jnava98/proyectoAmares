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
	/*	Abonado a interes:	Balance inicial(Tasa de interés/Cantidad de Mensualidades anuales)
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
	$balance (obtenido por formula)
	balance_final (obtenido por formula)
    estatus_contrato
	habilitado✅


*/
//Comenzamos con el concepto del pago
//Dependiendo del concepto es la información que vamos a guardar-
switch($input_concepto){
    case 1:
        //Apartado
        //Insertamos monto pagado
        $sql = "INSERT ";
        //Cambiamos el estatus del contrato
        $sql = "UPDATE contrato set id_estatus_venta = id_estatus_venta + 1 where id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        
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
        //Enganche Mensualidad
        //Consultamos la mensualidad del contrato
        $sql = "SELECT cant_mensual_enganche, cant_enganche FROM contrato WHERE id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $cant_mensual_enganche = $row['cant_mensual_enganche'];
        $total_pagar_enganche = $row['cant_enganche'];
        //Consultamos si existe un pago anterior de tipo mensualidad enganche
        $sql = "SELECT no_mensualidad = (SELECT max(no_mensualidad) from pagos) from pagos where id_contrato = '$id_contrato' and id_concepto = 3 and habilitado = 1";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $row=mysqli_fetch_array($result);
            $ultima_mensualidad = $row['no_mensualidad'];
        }else{
            //Consultamos si existe otro pago anterior de cualquier tipo para obtener el contador de la última mensualidad
            $sql="SELECT max(no_mensualidad) from pagos where id_contrato = '$id_contrato'";
            $result=mysqli_query(conectar(),$sql);
            $row=mysqli_fetch_array($result);
            desconectar();
            $ultima_mensualidad = $row['no_mensualidad'];
        }
        //Generando el estatus del pago.
        if($inp_diferencia == "" || $inp_diferencia == 0){
            $id_estatus_pago = 1;
        }else{
            $id_estatus_pago = 2;
        };
        
        //Insertamos el pago
        $sql = "INSERT INTO pagos (id_contrato, fecha_pago, no_mensualidad, abonado_capital, abonado_interes,
        diferencia, id_estatus_pago, comentario, id_concepto, mensualidad_historica, fecha_mensualidad,
        balance, estatus_contrato, habilitado
            ) 
        values ($id_contrato,$inp_fpago,$ultima_mensualidad,0,0
                $diferencia, $id_estatus_pago, $inp_comentario, $input_concepto, $inp_mensualidad, 2022-03-15, 
                0, $estatus_contrato,1
        )";
        $result=mysqli_query(conectar(),$sql);
        $row=mysqli_fetch_array($result);

        //Comprobamos si el pago va a cambiar el estatus del contrato.
        //Obtenemos la cantidad pagada por el usuario
        $sql="SELECT sum(monto_pagado), cant from pagos where id_contrato = '$id_contrato' and id_concepto = 3 and habilitado = 1";
        $result=mysqli_query(conectar(),$sql);
        $row=mysqli_fetch_array($result);
        $total_pagado_enganche = $row['monto_pagado'];
        //Generamos el restante a pagar
        $restante = $total_pagar_enganche - $total_pagado_enganche;
        if($restante <= $cant_mensual_enganche){

        }
        
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
}






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

/*	Abonado a interes:	Balance inicial(Tasa de interés/Cantidad de Mensualidades anuales)
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






$datosSalida = Array();
$datosSalida['abonado_interes'] = $abonado_interes;
$datosSalida['ultima_mensualidad'] = $ultima_mensualidad;
$datosSalida['abonado_capital'] = $abonado_capital;
$datosSalida['id_estatus_pago'] = $id_estatus_pago;
$datosSalida['estatus_contrato'] = $estatus_contrato;
$datosSalida['monto_mensual'] = $monto_mensual;
$datosSalida['balance_final'] = $balance_final;
$datosSalida['interes'] = $interes;
$datosSalida['sql'] = $sql;
$datosSalida['cambia_estatus'] = $cambia_estatus;


echo json_encode($datosSalida);



?>
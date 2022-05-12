<?php

session_start();

include "../conexion.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

//Comenzamos consultando el estatus del contrato
$datosContrato = traeDatosContrato($id_contrato);
$ultimoPago = traeUltimoPago($id_contrato);
$cuentasBancarias = traeCatCuentasBancarias();
$conceptos = traeCatConceptos();
// TODO: Agregar formula para calcular el interes por retraso (2%/30.5)*dias_vencidos
if ($ultimoPago==false) {
    //Datos del formulario
    $mensaje=null;
    $cambia_estatus=0;
    //Consultamos el monto mensual del contrato
    $a="si";
    $mensualidad = $datosContrato['monto_mensual'];
    $recargo = 0;
    $interes = 0;
    $tot_a_pagar = $mensualidad;
    //Consultamos pagos anteriores
    
}else{
    $a="no";
    $cambia_estatus = 0;
    $mensaje=null;
    $mensualidad = $datosContrato['monto_mensual'];
    $recargo = $ultimoPago['diferencia'];
    $interes = $recargo * 0.02;
    $tot_a_pagar = $interes + $recargo + $datosContrato['monto_mensual'];

}


/*
switch($datosContrato['id_estatus_venta']){
    case 1:
        //Apartado
        $etiqueta_concepto = "Pago Apartado";
        $concepto=1;
        //Tomamos los valores del contrato
        $sql="SELECT cant_apartado FROM contrato WHERE id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $cant_apartado = $row['cant_apartado'];
        //Datos del formulario
        $mensualidad = $cant_apartado;
        $tot_a_pagar = $mensualidad;
        $interes = 0;
        $recargo = 0;
        $cambia_estatus=1; //TODO: Verificar cuando el pago va a cambiar el estatus
        $mensaje=null;
        break;
    case 2||3||4:
        //Enganche, Enganche Mensualidad, Pendiente de Firma
        $etiqueta_concepto = "Pago mensualidad";
        $concepto=2;
        //Tomamos los valores del contrato
        $cant_enganche = $datosContrato['cant_enganche'];
        //Datos del formulario
        $mensualidad = $cant_enganche;
        $tot_a_pagar = $mensualidad;
        $interes = 0;
        $recargo = 0;
        $mensaje=null;
        $cambia_estatus=1;
        break;
    
    case 4:
        // 4 = Pendiende de firma de contrato
        $concepto=4;
        $etiqueta_concepto = "Pago Mensualidad";
        $mensaje = "Falta registrar fecha de firma y fecha de contrato";
        //Datos del formulario
        $mensualidad = 0;
        $tot_a_pagar = 0;
        $interes = 0;
        $recargo = 0;
        $cambia_estatus=0;
        //Consultamos el monto mensual del contrato
        $monto_mensual = $datosContrato['monto_mensual'];
        $mensualidad = $monto_mensual;
        //Consultamos pagos anteriores
        if(!is_null($ultimoPago)){
            //Si trajo algo, añadimos la diferencia del mes anterior  TODO: Agregar formula para calcular el interes por retraso (2%/30.5)*dias_vencidos
            //TODO: Añadir eIII de caso de uso. (Verificar la cantidad restante a pagar)
            $recargo += $ultimoPago['diferencia'];
            $interes += $recargo * 0.02;
            $tot_a_pagar += $interes + $recargo;
        }
        $mensualidad;
        $tot_a_pagar += $mensualidad;
        break;
    case 5:
        // 5 = Contrato Firmado
        $concepto=4;
        $etiqueta_concepto = "Mensualidad";
        $mensaje = null;
        //Datos del formulario
        $mensualidad = 0;
        $tot_a_pagar = 0;
        $interes = 0;
        $recargo = 0;
        $mensaje=null;
        $cambia_estatus=0;
        //Consultamos el monto mensual del contrato
        $monto_mensual=$datosContrato['monto_mensual'];
        $mensualidad = $monto_mensual;
        //Consultamos pagos anteriores
        if(!is_null($ultimoPago)){
            //Si trajo algo, añadimos la diferencia del mes anterior  TODO: Agregar formula para calcular el interes por retraso (2%/30.5)*dias_vencidos
            $recargo += $ultimoPago['diferencia'];
            $interes += $recargo * 0.02;
            $tot_a_pagar += $interes + $recargo;
        }
        $mensualidad;
        $tot_a_pagar = $mensualidad;
        break;
    case 6:
        //Pagado
        $mensaje = "Este contrato ya se encuentra pagado";
        break;
}*/

$response = Array();
//TODO: Agregar funcion para hacer abonos a capital.
$html="
<div class='card'>
    <div class='card-body'>
        
        <h5 class='card-title'>Captura un pago nuevo</h5>
        <div class='row'>
            <div class='col-sm-4'>
                <label for='input_concepto' class='form-label'>Concepto:</label>
                <select class='form-select' id='input_concepto' name='input_concepto'>
                    $conceptos
                </select>
            </div>
            <div class='col-sm-4'>
                <label for='inp_cuenta' class='form-label'>Cuenta depositada:</label>
                <select class='form-select' id='inp_cuenta' name='inp_cuenta'>
                $cuentasBancarias
                </select>
            </div>
            <div class='col-sm-4'>
            <label for='inp_mensualidad' class='form-label'>Cant Mensualidad</label>
                <input type='number' class='form-control' id='inp_mensualidad' value='$mensualidad' disabled>
            </div>
            
            <div class='col-sm-4'>
                <label for='input_fpago' class='form-label'>Fecha Pago</label>
                <input type='date' class='form-control' id='inp_fpago'>
            </div>    
            <div class='col-sm-4'>
                <label for='inp_recargo' class='form-label'>Saldo mes anterior</label>
                <input type='number' class='form-control' onkeyup='actualiza_datos_pago()' id='inp_recargo' value='$recargo'>
            </div>
            <div class='col-sm-4'>
                <label for='inp_diferencia' class='form-label'>Diferencia</label>
                <input type='number' onkeyup='actualiza_datos_pago()' class='form-control' id='inp_diferencia' disabled>
            </div>  
            <div class='col-sm-4'>
                <label for='input_cpagada' class='form-label'>Cantidad Pagada</label>
                <input type='number' class='form-control' onkeyup='actualiza_datos_pago()' value='0' id='inp_cpagada'>
            </div>
            <div class='col-sm-4'>
                <label for='inp_interes' class='form-label'>Interés mes anterior</label>
                <input type='number' class='form-control' id='inp_interes' onkeyup='actualiza_datos_pago()'  value='$interes'>
            </div>
            <div class='col-sm-4'>
                <label for='inp_totpagar' class='form-label'>Total a pagar:</label>
                <input type='number' class='form-control' id='inp_totpagar' value='$tot_a_pagar' disabled >
            </div>
            <div class='col-sm-4'>
                <label for='inp_tipocambio' class='form-label'>Tipo de cambio:</label>
                <input type='number' class='form-control' id='inp_tipocambio'>
            </div>
            <div class='col-sm-4'>
                <label for='inp_divisa' class='form-label'>Divisa:</label>
                <input type='text' class='form-control' id='inp_divisa'>
            </div>
            <div class='col-sm-4'>
                <label for='inp_comentario' class='form-label'>Comentario</label>
                <textarea class='form-control' id='inp_comentario' rows='3'></textarea>
            </div>
            <div class='row mb-4'>
                <div class='col-sm-4'>
                    <button type='button' class='btn btn-primary' onclick='guarda_pago($id_contrato,$cambia_estatus);'>Guardar Pago</button>
                </div>
            </div>
            

";


/*
$html2="
    <div class='card'>

        <div class='card-body'>
            <h5 class='card-title'>Captura un pago nuevo.</h5>
            <div class='row mb-3'>
                <label for='input_concepto' class='col-sm-2 col-form-label'>Concepto</label>
                <div class='col-sm-2'>
                <select class='form-select' id='input_concepto' name='input_concepto'>
                    <option data-id_concepto='$concepto' value='$concepto' selected>$etiqueta_concepto</option>
                    <option data-id_concepto='ab_capital' value='ab_capital'>Abono a Capital</option>
                </select>
                </div>
                <label for='inp_formpago' class='col-sm-2 col-form-label'>Forma de pago</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='inp_formpago'>
                </div>
                <label for='inp_mensualidad' class='col-sm-2 col-form-label'>Cant Mensualidad</label>
                <div class='col-sm-2'>
                    <input type='number' class='form-control' id='inp_mensualidad' value='$mensualidad' disabled>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='input_fpago' class='col-sm-2 col-form-label'>Fecha Pago</label>
                <div class='col-sm-2'>
                    <input type='date' class='form-control' id='inp_fpago'>
                </div>
                <label for='inp_recargo' class='col-sm-2 col-form-label'>Recargo mes anterior</label>
                <div class='col-sm-2'>
                    <input type='number' class='form-control' onkeyup='actualiza_datos_pago()' id='inp_recargo' value='$recargo'>
                </div>
                <label for='inp_diferencia' class='col-sm-2 col-form-label'>Diferencia</label>
                <div class='col-sm-2'>
                    <input type='number' onkeyup='actualiza_datos_pago()' class='form-control' id='inp_diferencia' disabled>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='input_cpagada' class='col-sm-2 col-form-label'>Cantidad Pagada</label>
                <div class='col-sm-2'>
                    <input type='number' class='form-control' onkeyup='actualiza_datos_pago()' value='0' id='inp_cpagada'>
                </div>
                <label for='inp_interes' class='col-sm-2 col-form-label'>Interés mes anterior</label>
                <div class='col-sm-2'>
                    <input type='number' class='form-control' id='inp_interes' onkeyup='actualiza_datos_pago()'  value='$interes'>
                </div>
                <label for='inp_totpagar' class='col-sm-2 col-form-label'>Total a pagar</label>
                <div class='col-sm-2 '>
                    <input type='number' class='form-control' id='inp_totpagar' value='$tot_a_pagar' disabled >
                </div>
            </div>
            <div class='row mb-3'>
                <label for='inp_comentario' class='col-sm-2 col-form-label'>Comentario</label>
                <div class='col-sm-6'>
                    <textarea class='form-control' id='inp_comentario' rows='3'></textarea>
                </div>
            </div>
            
            <div class='row mb-4'>
                <div class='col-sm-4'>
                    <button type='button' class='btn btn-primary' onclick='guarda_pago($id_contrato,$cambia_estatus);'>Guardar Pago</button>
                </div>
            </div>
        </div>
    </div>
    ";*/
$response['html'] = $html;
$response['mensaje'] = $mensaje;
$response['cambia_estatus'] = $cambia_estatus;
$response['id_estatus_venta'] = $datosContrato['id_estatus_venta'];

echo json_encode($response);


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

function traeCatCuentasBancarias(){
    $sql="SELECT * FROM cat_cuentas_bancarias";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $options = "";

    if ($result==true) {
        while($cuentasBancarias=mysqli_fetch_array($result)) {
            $id = $cuentasBancarias['id_cuenta_bancaria'];
            $banco = $cuentasBancarias['banco'];
            $numero = $cuentasBancarias['identificador_cuenta'];
           $options .= "<option value='$id'>$banco - $numero</option>";
        }
    }
    else{
        $options .="<option value=''>No se encontraron cuentas bancarias</option>";
    }
    return $options;
    
}
function traeCatConceptos(){
    $sql="SELECT * FROM concepto";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $options = "";

    if ($result==true) {
        while($concepto=mysqli_fetch_array($result)) {
            $id = $concepto['id_concepto'];
            $nombre = $concepto['nombre'];
           $options .= "<option value='$id'>$nombre</option>";
        }
    }
    else{
        $options .="<option value=''>No se encontraron conceptos</option>";
    }
    return $options;
    
}



?>

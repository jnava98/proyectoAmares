<?php

session_start();

include "../conexion.php";

//Recibimos datos
$id_contrato = filter_input(INPUT_GET,'id_contrato',FILTER_SANITIZE_NUMBER_INT);

if($id_contrato==0||$id_contrato=="") return false;

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
    if($datosContrato['monto_mensual']=="0"){
        $mensualidad = $datosContrato['pago_final'];
    }else{
        $mensualidad = $datosContrato['monto_mensual'];
    }//fin del else
    $recargo = 0;
    $interes = 0;
    $tot_a_pagar = $mensualidad;
    //Consultamos pagos anteriores
    
}else{
    $cambia_estatus = 0;
    $mensaje=null;
    if($datosContrato['monto_mensual']=="0"){
        $mensualidad = $datosContrato['pago_final'];
    }else{
        $mensualidad = $datosContrato['monto_mensual'];
    }//fin del else
    $recargo = $ultimoPago['diferencia'];
    if($recargo <= 0){
        $interes = 0;//Se coloca por si el recargo es negativo. Si el recargo es negativo, tenemos una cantidad a favor. Por lo que no hay interés
    }else{
        $interes = $recargo * 0.02;
    }

    
    $tot_a_pagar = $interes + $recargo + $datosContrato['monto_mensual'];

}//fin del else

$response = Array();
//TODO: Agregar funcion para hacer abonos a capital.
$html="
<div class='card'>
    <div class='card-body'>
        
        <h5 class='card-title'>Captura un pago nuevo</h5>

        <div class='row'>
            <div class='col-sm-4'>
                <label for='input_concepto' class='form-label'>Concepto:</label>
                <select class='form-select' onchange='cambiaConcepto($id_contrato,this.value)'  id='input_concepto' name='input_concepto'>
                    <option value='0'>Seleccione una opción.</option>
                    $conceptos
                </select>
            </div>
            <div class='col-sm-4'>
                <label for='inp_cuenta' class='form-label'>Cuenta depositada:</label>
                <select class='form-select' onchange='coloca_moneda(this)'  id='inp_cuenta' name='inp_cuenta'>
                <option value='0'>Seleccione una opción</option>
                    $cuentasBancarias
                </select>
            </div>
            <div class='col-sm-4'>
                <label for='input_fpago' class='form-label'>Fecha Pago</label>
                <input type='date' class='form-control' id='inp_fpago'>
            </div> 
        </div>


        <div class='row'>
            <div class='col-sm-4'>
                <label for='cantInicial' class='form-label'>Cantidad inicial:</label>
                <input type='number' class='form-control' oninput='cantInicialxtipoCambio2()' id='cantInicial' value='' >
            </div> 
            <div class='col-sm-4'>
                <label for='inp_divisa' class='form-label' >Divisa:</label>
                <input type='text' class='form-control' id='inp_divisa' disabled>
            </div>
            <div class='col-sm-4'>
                <label for='inp_tipocambio' class='form-label'>Tipo de cambio:</label>
                <input type='number' oninput='cantInicialxtipoCambio2()' class='form-control' id='inp_tipocambio'>
            </div>
            <div class='col-sm-4'>
                <label for='input_cpagada' class='form-label'>Cantidad Pagada</label>
                <input type='number' class='form-control' oninput='actualiza_datos_pago()' value='0' id='inp_cpagada'>
            </div>
            <div class='col-sm-4'>
                <label for='inp_recargo' class='form-label'>Saldo mes anterior</label>
                <input type='number' class='form-control' oninput='actualiza_datos_pago()' id='inp_recargo' value=''>
            </div>
            
            
            <div class='col-sm-4'>
                <label for='inp_interes' class='form-label'>Interés mes anterior</label>
                <input type='number' class='form-control' id='inp_interes' oninput='actualiza_datos_pago()'  value=''>
            </div>
            
            
            
            <div class='col-sm-4'>
                <label for='inp_comentario' class='form-label'>Comentario</label>
                <textarea class='form-control' id='inp_comentario' rows='3'></textarea>
            </div>
            <div class='col-sm-4'>
                <label for=' ' class='form-label'>Forma de pago</label>
                <textarea class='form-control' id='inp_formapago' rows='3'></textarea>
            </div>

            <div class='row'>
                <div class='col-sm-4'>
                <label for='inp_mensualidad' class='form-label'>Cant Mensualidad</label>
                    <input type='number' class='form-control' id='inp_mensualidad' oninput='actualiza_datos_pago()' value='' disabled>
                </div>
                <div class='col-sm-4'>
                    <label for='inp_diferencia' class='form-label'>Diferencia</label>
                    <input type='number' oninput='actualiza_datos_pago()' class='form-control' id='inp_diferencia' disabled>
                </div>
                <div class='col-sm-4'>
                    <label for='inp_totpagar' class='form-label'>Total a pagar:</label>
                    <input type='number' class='form-control' id='inp_totpagar' value='' disabled >
                </div>
            </div>

            <div class='row mb-4'>
                <div class='col-sm-4'>
                    <button type='button' class='btn btn-primary' onclick='guarda_pago($id_contrato,$cambia_estatus);'>Guardar Pago</button>
                </div>
            </div>";


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
    $sql="SELECT  * FROM pagos WHERE id_contrato = '$id_contrato' AND habilitado IS true ORDER BY id_pago DESC LIMIT 1";
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
            $moneda = $cuentasBancarias['divisa'];
            $options .= "<option data-moneda='$moneda' value='$id'>$banco - $numero - $moneda</option>";
        }
    }
    else{
        $options .="<option value=''>No se encontraron cuentas bancarias</option>";
    }
    return $options;
    
}
function traeCatConceptos(){
    $sql="SELECT * FROM concepto where id_concepto != 4 order by id_concepto asc";
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

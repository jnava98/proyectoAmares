<?php

session_start();

include "../conexion.php";

//Recibimos datos
$id_contrato = filter_input(INPUT_GET,'id_contrato',FILTER_SANITIZE_NUMBER_INT);

if($id_contrato==0||$id_contrato=="") return false;

$response = Array();

//TIPOS DE CONCEPTO
const APARTADO = 1;
const ENGANCHE = 2;
const MENSUALIDAD_CONTRATO = 3;
const ABONO_CAPITAL = 4;
const PAGO_FINAL = 5;

$cuentasBancarias = traeCatCuentasBancarias();
$datosContrato = traeDatosContrato($id_contrato);
/* Validamos que ya se haya pagado el apartado y el enganche, ya que las modificaciones
    que generamos para calcular la reduccion de la mensualidad a pagar, se hacen sobre las mensualidades del contrato.
*/
$msg = "";
//Verificamos si se definio un apartado y que ya haya sido pagado.
if ($datosContrato->cant_apartado != 0) {
    //Verificamos si ya se pago el apartado
    $totalPagadoApartado = totalPagadoxConcepto($id_contrato,APARTADO);
    if ($totalPagadoApartado->totalPagado === null ||number_format($totalPagadoApartado->totalPagado,0, '.', '')  < number_format($datosContrato->cant_apartado,0, '.', '') ) {
        $msg = "No se ha pagado el apartado";
    }
}
//Verificamos que el enganche ya haya sido pagado
$totalPagadoEnganche = totalPagadoxConcepto($id_contrato,ENGANCHE);
if (($totalPagadoEnganche->totalPagado === null) || (number_format($totalPagadoEnganche->totalPagado,0, '.', '') < number_format($datosContrato->cant_enganche,0, '.', ''))) {
    $msg = "No se ha pagado el enganche.";
}



$html="
<div class='card'>
    <div class='card-body'>
        
        <h5 class='card-title'>Captura un abono a capital</h5>
        <div class='row'>
            <div class='col-sm-4'>
                <label for='opcionAbono' class='form-label'>Resultado del abono a capital</label>
                <select class='form-select' id='opcionAbono' name='opcionAbono'>
                    <option value='1'>Reducir total de mensualidades</option>
                    <option value='2'>Reducir cantidad a pagar</option>
                </select>
            </div>
            <div class='col-sm-4'>
                <label for='cuentaBancaria' class='form-label'>Cuenta depositada:</label>
                <select class='form-select' id='cuentaBancaria' name='cuentaBancaria'>
                $cuentasBancarias
                </select>
            </div>
        </div>
            <div class='row mt-2'>
                <div class='col-sm-3'>
                    <label for='fechaPago' class='form-label'>Fecha del Abono:</label>
                    <input onkeyup='cantInicialxtipoCambio();' type='date' class='form-control' id='fechaPago' >
                </div>
                <div class='col-sm-3'>
                    <label for='inpCantInicial' class='form-label'>Cantidad inicial:</label>
                    <input onkeyup='cantInicialxtipoCambio();' type='number' class='form-control' id='inpCantInicial' >
                </div>
                <div class='col-sm-3'>
                    <label for='inpDivisa' class='form-label'>Divisa:</label>
                    <input type='text' class='form-control' id='inpDivisa' >
                </div>
                <div class='col-sm-3'>
                    <label for='inpTipoCambio' class='form-label'>Tipo de Cambio:</label>
                    <input onkeyup='cantInicialxtipoCambio();' type='number' class='form-control' id='inpTipoCambio' >
                </div>
            </div>
            <div class='col-sm-4'>
                <label for='inpAbonadoCapital' class='form-label'>Cantidad a Abonar a Capital:</label>
                    <input type='number' class='form-control' id='inpAbonadoCapital' >
                </div>
            <div class='row mt-2'>
                <div class='col-sm-4'>
                    <button type='button' class='btn btn-primary' onclick='guardaAbono($id_contrato);'>Guardar</button>
                </div>
            </div>
            

";

function totalPagadoxConcepto($id_contrato,$id_concepto){
    $sql="SELECT sum(abonado_capital) as totalPagado FROM pagos WHERE id_contrato = $id_contrato AND id_concepto = $id_concepto AND habilitado = 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row = mysqli_fetch_assoc($result);
    $row = json_encode($row);
    $row = json_decode($row,false);
    return $row;
}


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


$response['html'] = $html;
$response['id_contrato'] = $id_contrato;
$response['msg'] = $msg;

echo json_encode($response);



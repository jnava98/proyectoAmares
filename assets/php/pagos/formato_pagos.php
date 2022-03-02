<?php

session_start();

include "../conexion.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

//VAMOS A TRAER LA INFORMACION DEL CONTRATO PARA COLOCARLA EN EL FORMULARIO DE PAGO
	/*TRAEMOS: Concepto en el que esta el contrato
		Cantidad mensual estipulada
		Algun recargo del mes anterior		
	*/
$response=Array();
$sql="SELECT 
    monto_mensual,
    id_estatus_venta,   
    (SELECT MAX(mensualidad) FROM pagos WHERE id_contrato = '$id_contrato') AS ultima_mensualidad,
    (SELECT diferencia from pagos where mensualidad = ultima_mensualidad) AS ultima_diferencia
    FROM contrato
    WHERE id_contrato LIKE '$id_contrato'"; //Consultar id de la variable
//echo $sql;
$result=mysqli_query(conectar(),$sql);
desconectar();
$row=mysqli_fetch_array($result);
$num=mysqli_num_rows($result);

//Verificamos el estatus del contrato, para saber que concepto tendra el pago
//1 - Contrato Firmado -> Concepto - Mensualidad
//2 - Enganche -> Concepto - Mensualidad Enganche
//3 - Reservado -> Concepto - Mensualidad Reservado
$concepto = '';

switch ($row['id_estatus_venta']) {
    case 1:
        $concepto = "Mensualidad";
        break;
    case 2:
        $concepto = "Mensualidad Enganche";
        break;
    case 3:
        $concepto = "Pago Apartado";
        break;
}
$response = Array();

//Datos que se usan en el formulario
$int_mes_anterior = ($row['ultima_diferencia']*0.02);
$tot_a_pagar = ($row['monto_mensual']+$row['ultima_diferencia']+$int_mes_anterior);

$html="
<div class='card'>
    <div class='card-body'>
        <h5 class='card-title'>Captura un pago nuevo.</h5>

        <div class='row mb-3'>
            <label for='input_concepto' class='col-sm-2 col-form-label'>Concepto</label>
            <div class='col-sm-2'>
            <input type='text' class='form-control' id='inp_concepto' value='$concepto' disabled>
            </div>
            <label for='inp_formpago' class='col-sm-2 col-form-label'>Forma de pago</label>
            <div class='col-sm-2'>
                <input type='text' class='form-control' id='inp_formpago'>
            </div>
            <label for='inp_mensualidad' class='col-sm-2 col-form-label'>Cant Mensualidad</label>
            <div class='col-sm-2'>
                <input type='email' class='form-control' id='inp_mensualidad' value='".$row['monto_mensual']."' disabled>
            </div>
        </div>

        <div class='row mb-3'>
            <label for='input_fpago' class='col-sm-2 col-form-label'>Fecha Pago</label>
            <div class='col-sm-2'>
                <input type='date' class='form-control' id='inp_fpago'>
            </div>
            <label for='inp_recargo' class='col-sm-2 col-form-label'>Recargo mes anterior</label>
            <div class='col-sm-2'>
                <input type='number' class='form-control' id='inp_recargo' value='".$row['ultima_diferencia']."'>
            </div>
            <label for='inp_diferencia' class='col-sm-2 col-form-label'>Diferencia</label>
            <div class='col-sm-2'>
                <input type='number' onkeyup='actualiza_datos_pago()' class='form-control' id='inp_diferencia' disabled>
            </div>
        </div>

        <div class='row mb-3'>
            <label for='input_cpagada' class='col-sm-2 col-form-label'>Cantidad Pagada</label>
            <div class='col-sm-2'>
            <input type='text' class='form-control' onkeyup='actualiza_datos_pago()' id='inp_cpagada'>
            </div>
            <label for='inp_interes' class='col-sm-2 col-form-label'>Interés mes anterior</label>
            <div class='col-sm-2'>
            <input type='number' class='form-control' id='inp_interes' onkeyup='actualiza_datos_pago()'  value='$int_mes_anterior'>
            </div>
            <label for='inp_totpagar' class='col-sm-2 col-form-label'>Total a pagar</label>
            <div class='col-sm-2 '>
            <input type='number' class='form-control' actualiza_datos_pago() id='inp_totpagar' value='$tot_a_pagar'  >
            </div>
        </div>
        <div class='row mb-3 justify-content-end'>
            <label for='inp_estatus' class='col-sm-2 col-form-label'>Estatus</label>
            <div class='col-sm-2'>
            <input type='text' class='form-control' id='inp_estatus' disabled>
            </div>
        </div>
        
        <div class='row mb-4'>
            <div class='col-sm-4'>
                <button type='button' class='btn btn-primary' onclick='guarda_pago();'>Capturar Pago</button>
            </div>
        </div>
    </div>
</div>
";

    $response['html'] = $html;
    echo json_encode($response);
?>

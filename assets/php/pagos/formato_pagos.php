<?php

session_start();

include "../conexion.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

//Comenzamos consultando el estatus del contrato
$sql="SELECT id_estatus_venta FROM contrato WHERE id_contrato = '$id_contrato'";
$result=mysqli_query(conectar(),$sql);
desconectar();
$row=mysqli_fetch_array($result);
$id_estatus_venta = $row['id_estatus_venta'];

switch($id_estatus_venta){
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
    case 2:
        //Enganche
        $etiqueta_concepto = "Pago Enganche";
        $concepto=2;
        //Tomamos los valores del contrato
        $sql="SELECT cant_enganche FROM contrato WHERE id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $cant_enganche = $row['cant_enganche'];
        //Datos del formulario
        $mensualidad = $cant_enganche;
        $tot_a_pagar = $mensualidad;
        $interes = 0;
        $recargo = 0;
        $mensaje=null;
        $cambia_estatus=1;
        break;
    case 3:
        //Enganche Diferido
        $etiqueta_concepto = "Mensualidad Enganche";
        $concepto=3;
        //Tomamos los valores del contrato
        $sql="SELECT cant_enganche, mensualidades_enganche, cant_mensual_enganche FROM contrato WHERE id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $cant_mensual_enganche = $row['cant_mensual_enganche'];
        $mensualidades_enganche = $row['mensualidades_enganche'];
        //Datos del formulario
        $mensualidad = $cant_mensual_enganche;
        $tot_a_pagar = 0;
        $interes = 0;
        $recargo = 0;
        $mensaje=null; 
        $cambia_estatus=0;
        //Consultamos si existe algún pago anterior      TODO: Agregar formula para calcular el interes por retraso (2%/30.5)*dias_vencidos
        $sql="SELECT  MAX(p.no_mensualidad), diferencia
            FROM contrato c
            INNER JOIN pagos p
            ON c.id_contrato = p.id_contrato
            WHERE p.id_contrato = '$id_contrato' AND p.habilitado IS true";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $rows = mysqli_num_rows($result);
        //Verificamos si la consulta trajo algun pago
        if($rows > 0){
            //Si trajo algo, añadimos la diferencia del mes anterior
            $row=mysqli_fetch_array($result);
            $recargo += $row['diferencia'];
            $interes += $recargo * 0.02;
            $tot_a_pagar += $interes + $recargo;
        }
        $tot_a_pagar += $mensualidad;
        $mensualidad = $cant_mensual_enganche;
        break;
    case 4:
        // 4 = Pendiende de firma de contrato
        $concepto=4;
        $etiqueta_concepto = "Mensualidad";
        $mensaje = "Falta registrar fecha de firma y fecha de contrato";
        //Datos del formulario
        $mensualidad = 0;
        $tot_a_pagar = 0;
        $interes = 0;
        $recargo = 0;
        $cambia_estatus=0;
        //Consultamos el monto mensual del contrato
        $sql="SELECT monto_mensual FROM contrato WHERE id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $monto_mensual=$row['monto_mensual'];
        $mensualidad = $monto_mensual;
        //Consultamos pagos anteriores
        $sql="SELECT  MAX(p.no_mensualidad), diferencia
            FROM contrato c
            INNER JOIN pagos p
            ON c.id_contrato = p.id_contrato
            WHERE p.id_contrato = '$id_contrato' AND p.habilitado IS true";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            //Si trajo algo, añadimos la diferencia del mes anterior  TODO: Agregar formula para calcular el interes por retraso (2%/30.5)*dias_vencidos
            //TODO: Añadir eIII de caso de uso. (Verificar la cantidad restante a pagar)
            $row=mysqli_fetch_array($result);
            $recargo += $row['diferencia'];
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
        $sql="SELECT monto_mensual FROM contrato WHERE id_contrato = '$id_contrato'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $row=mysqli_fetch_array($result);
        $monto_mensual=$row['monto_mensual'];
        $mensualidad = $monto_mensual;
        //Consultamos pagos anteriores
        $sql="SELECT  MAX(p.no_mensualidad), diferencia
            FROM contrato c
            INNER JOIN pagos p
            ON c.id_contrato = p.id_contrato
            WHERE p.id_contrato = '$id_contrato' AND p.habilitado IS true";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            //Si trajo algo, añadimos la diferencia del mes anterior  TODO: Agregar formula para calcular el interes por retraso (2%/30.5)*dias_vencidos
            $row=mysqli_fetch_array($result);
            $recargo += $row['diferencia'];
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
}

$response = Array();

//TODO: Agregar funcion para hacer abonos a capital.
$html="
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
    ";
$response['html'] = $html;
$response['mensaje'] = $mensaje;
$response['cambia_estatus'] = $cambia_estatus;
$response['id_estatus_venta'] = $id_estatus_venta;

echo json_encode($response);
?>

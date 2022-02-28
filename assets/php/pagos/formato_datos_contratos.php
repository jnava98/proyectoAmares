<?php


include('../conexion.php');
$id_contrato = $_GET['id_contrato'];
if($id_contrato==" "||$id_contrato==""){
    return false;
}else{

//lote comprado
//dia de pago
//estatus contrato
//tipo de compra
//enganche
//cantidad mensual ??
//fecha de la firma del contrato ??
//fecha del apartado del terreno ??
    $consulta = "SELECT
    cl.nombre,
    cl.apellido_paterno,
    cl.apellido_materno,
    l.fase,
    l.super_manzana,
    l.mza,
    l.lote,
    cat_ev.nombre,
    cat_tc.nombre,
    c.cant_enganche
    FROM contrato c 
    INNER JOIN cliente_contrato c_co
    ON cl.id_cliente = c.id_cliente
    INNER JOIN clientes cl
    ON c_co.id_cliente = c_co.id_cliente
    INNER JOIN lotes l
    ON c.id_lote = c.id_lote
    INNER JOIN cat_estatus_venta cat_ev
    ON cat_ev.id_estatus_venta = c.id_estatus_venta
    INNER JOIN cat_tipo_compra cat_tc
    ON cat_tc.id_tipo_compra = c.id_tipo_compra
    WHERE c.id_contrato = '$id_contrato'"; 
$resultado=mysqli_query(conectar(),$consulta);
desconectar();
while($row=mysqli_fetch_assoc($resultado)){
    $mensualidad = $row['mensualidad']; //Numero de la mensualidad
    $dia_pago = $row['dia_pago']; //Dia estipulado en el contrato
    $fecha_pago = $row['fecha_pago']; //Fecha en la que paga el cliente
    $monto_pagado = $row['monto_pagado']; //Cantidad que paga el cliente
    $monto_mensual = $row['monto_mensual'];//Cantidad mensual del contrato
    $estatus_pago = $row['nombre'];//Estatus del pago
    echo "
        <tr>
            <th scope='row'>$mensualidad</th>
            <td>$fecha_pago</td>
            <td>$fecha_pago</td>
            <td>$monto_pagado</td>
            <td>$monto_mensual</td>
            <td>".($monto_mensual - $monto_pagado)."</td>
            <td>$estatus_pago</td>
        </tr>
    ";
};//fin del while 


$html="
<div class='card-body'>
    <h5 class='card-title'>Datos del contrato</h5>
        <h6 class='card-subtitle mb-2 text-muted'>Datos adicionales del contrato seleccionado.</h6>
            <div class='card-text'>
                <div class='row mb-3'>
                  <label for='input_concepto' class='col-sm-2 col-form-label'>Nombre del cliente</label>
                  <div class='col-sm-2'>
                  <input type='text' class='form-control' id='inp_concepto' disabled>
            </div>
            <label for='inp_formpago' class='col-sm-2 col-form-label'>Lote Comprado</label>
            <div class='col-sm-2'>
                <input type='text' class='form-control' id='inp_formpago' disabled>
            </div>
            <label for='inp_mensualidad' class='col-sm-2 col-form-label'>Día de pago</label>
            <div class='col-sm-2'>
                <input type='email' class='form-control' id='inp_mensualidad' disabled>
            </div>
            </div>
                <div class='row mb-12'>
                    <label for='input_fpago' class='col-sm-2 col-form-label'>Estatus del contrato</label>
                    <div class='col-sm-2'>
                        <input type='date' class='form-control' id='inp_fpago' disabled>
                    </div>
                    <label for='inp_recargo' class='col-sm-2 col-form-label'>Tipo de compra</label>
                    <div class='col-sm-2'>
                        <input type='text' class='form-control' id='inp_recargo' disabled>
                    </div>
                    <label for='inp_diferencia' class='col-sm-2 col-form-label'>Enganche</label>
                    <div class='col-sm-2'>
                        <input type='email' class='form-control' id='inp_diferencia' disabled>
                    </div>
                </div>
              </div>
        </div>
        ";
    };//fin del else
?>
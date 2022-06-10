<?php


include('../conexion.php');
$id_contrato = $_GET['id_contrato'];
if($id_contrato==" "||$id_contrato==""){
    return false;
}else{
    $ultimoPago = traeUltimoPago($id_contrato);
    $historialPagos = consultaHistorialPagos($id_contrato);
    $response = [];
    $html="";
    //Formulario para impresion del recibo de pago
    $html.='<form target="_blank" action="?page=impresion_recibo_pago" method="POST">
                <input id="input_id_pago" name="input_id_pago" value="" type="hidden"/>
                <button id="enviar_formulario_recibo_pago" type="submit" style="display:none;"></button>
            </form>';
    $num = count($historialPagos);
    $html.="
        <table id='table_pagos' class='table table-responsive table-bordered table-striped table-hover table-condensed table-responsive'>
                <thead class='table-primary'>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Concepto</th>
                        <th scope='col'>Fecha pago</th>
                        <th scope='col'>Cuenta Bancaria</th>
                        <th scope='col'>Cant inicial</th>
                        <th scope='col'>Divisa</th>
                        <th scope='col'>Tipo Cambio</th>
                        <th scope='col'>Cant Pagada</th>
                        <th scope='col'>Abonado Capital</th>
                        <th scope='col'>Abonado Interés</th>
                        <th scope='col'>Monto Mensual</th>
                        <th scope='col'>Diferencia</th>
                        <th scope='col'>Estatus</th>
                        <th scope='col'>Comentarios</th>
                        <th scope='col'>Imprimir recibo</th>
                    </tr>
                </thead>
                <tbody id='body_table_pagos'>";

    if($num != 0){
        foreach($historialPagos as $pago){

            $id_pago = $pago->id_pago; //Numero de la mensualidad

            if($ultimoPago['id_pago']==$pago->id_pago){
                $boton = "<button id='$pago->id_pago' class='btn btn-danger' onclick='elimina_pago($id_pago,$id_contrato);' >Eliminar</button>";
            }else{
                $boton = "";
            }

           
            $banco = $pago->banco." - ".$pago->identificador_cuenta;
 
            $html.= "
                <tr>
                    <th scope='row'>$pago->no_mensualidad</th>
                    <td>$pago->concepto</td>
                    <td>$pago->fecha_pago</td>
                    <td>$banco</td>
                    <td>$pago->cant_inicial</td>
                    <td>$pago->divisa</td>
                    <td>$pago->tipo_cambio</td>
                    <td>$pago->monto_pagado</td>
                    <td>$pago->abonado_capital</td>
                    <td>$pago->abonado_interes</td>
                    <td>$pago->monto_mensual</td>
                    <td>$pago->diferencia</td>
                    <td>$pago->estatus_pago</td>
                    <td>$pago->comentario</td>
                    <td>
                        <button id='$pago->id_pago' class='btn boton_tres' onclick='recibo_pago(this.id);' >Imprimir</button>
                        $boton
                    </td>
                    
                </tr>
            ";
        };//fin del while
    }else{
        //Si la consulta no trajo nada devolvemos
        $html.= "
        <tr>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
            <td class='text-center'>-</td>
        </tr>
    ";
    };
    $html.="
                </tbody>
            </table>
        ";
    $response['html'] = $html; 
    $response['prueba'] = consultaHistorialPagos($id_contrato); 
    echo json_encode($response);
};

function consultaHistorialPagos($id_contrato){
    $consulta = "SELECT p.id_pago,
    p.no_mensualidad,
    catconc.nombre as concepto,
    c.dia_pago,
    p.cant_inicial,
    p.fecha_pago,
    p.abonado_capital,
    p.abonado_interes,
    p.divisa,
    p.tipo_cambio, 
    p.monto_pagado,
    c.monto_mensual,
    p.diferencia, 
    cep.nombre,
    cb.identificador_cuenta,
    cb.banco,
    p.comentario ,
    cep.nombre as estatus_pago
    FROM pagos p INNER JOIN contrato c
    ON p.id_contrato = c.id_contrato
    INNER JOIN cat_estatus_pago cep
    ON p.id_estatus_pago = cep.id_estatus_pago
    INNER JOIN concepto catconc
    ON p.id_concepto = catconc.id_concepto
    INNER JOIN cat_cuentas_bancarias cb
    ON p.id_cuenta_bancaria = cb.id_cuenta_bancaria
    WHERE c.id_contrato = '$id_contrato' AND p.habilitado = 1 ORDER BY p.id_pago DESC";
    $result=mysqli_query(conectar(),$consulta);
    desconectar();
    if ($result==true) {
        $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $rows = json_encode($rows);
        $rows = json_decode($rows,false);
        return $rows;
    }else{
        return false;
    }
    
        
}
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

?>
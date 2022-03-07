<?php


include('../conexion.php');
$id_contrato = $_GET['id_contrato'];
if($id_contrato==" "||$id_contrato==""){
    return false;
}else{
    
//No
//Fecha mensualidad
//Fecha pago
//$ pagada
//Cantidad mensualidad
//Diferencia
//Concepto
//Observaciones
    $consulta = "SELECT
        p.no_mensualidad,
        catconc.nombre as concepto,
        c.dia_pago,
        p.fecha_pago, 
        p.monto_pagado,
        c.monto_mensual,
        p.diferencia, 
        cep.nombre,
        p.comentario 
        FROM pagos p INNER JOIN contrato c
        ON p.id_contrato = c.id_contrato
        INNER JOIN cat_estatus_pago cep
        ON p.id_estatus_pago = cep.id_estatus_pago
        INNER JOIN concepto catconc
        ON p.id_concepto = catconc.id_concepto
        WHERE c.id_contrato = '$id_contrato' ORDER BY p.no_mensualidad DESC"; 
    $resultado=mysqli_query(conectar(),$consulta);
    desconectar();
    $response = Array();
    $html="";
    $num = mysqli_num_rows($resultado);
    $html.="
        <table id='table_pagos' class='table table-responsive table-bordered table-striped table-hover table-condensed table-responsive'>
                <thead class='thead-dark'>
                    <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Concepto</th>
                    <th scope='col'>Fecha pago</th>
                    <th scope='col'>$ Pagada</th>
                    <th scope='col'>Monto Mensual</th>
                    <th scope='col'>Diferencia</th>
                    <th scope='col'>Estatus</th>
                    <th scope='col'>Comentarios</th>
                    </tr>
                </thead>
                <tbody id='body_table_pagos'>
                
        ";
    if($num > 0){
        while($row=mysqli_fetch_assoc($resultado)){
            $no_mensualidad = $row['no_mensualidad']; //Numero de la mensualidad
            $concepto = $row['concepto']; //Numero de la mensualidad
            $dia_pago = $row['dia_pago']; //Dia estipulado en el contrato
            $fecha_pago = $row['fecha_pago']; //Fecha en la que paga el cliente
            $monto_pagado = $row['monto_pagado']; //Cantidad que paga el cliente
            $monto_mensual = $row['monto_mensual'];//Cantidad mensual del contrato
            $diferencia = $row['diferencia'];//Cantidad mensual del contrato
            $estatus_pago = $row['nombre'];//Estatus del pago
            $comentario = $row['comentario'];//Comentario
            $html.= "
                <tr>
                    <th scope='row'>".$no_mensualidad."</th>
                    <td>".$concepto."</td>
                    <td>".$fecha_pago."</td>
                    <td>".$monto_pagado."</td>
                    <td>".$monto_mensual."</td>
                    <td>".$diferencia."</td>
                    <td>".$estatus_pago."</td>
                    <td>".$comentario."</td>
                </tr>
            ";
        };//fin del while
    }elseif($num==0){
        //Si la consulta no trajo nada devolvemos
        $html.= "
        <tr>
            <th scope='row'>#</th>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
    ";
    };
    $html.="
                </tbody>
            </table>
        ";
    $response['html'] = $html; 
    echo json_encode($response);
};
?>
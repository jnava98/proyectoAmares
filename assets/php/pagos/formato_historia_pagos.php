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
        c.dia_pago,
        p.mensualidad,
        p.fecha_pago, 
        p.monto_pagado,
        c.monto_mensual, 
        cep.nombre 
        FROM pagos p INNER JOIN contrato c
        ON p.id_contrato = c.id_contrato
        INNER JOIN cat_estatus_pago cep
        ON p.id_estatus_pago = cep.id_estatus_pago
        WHERE c.id_contrato = '$id_contrato' ORDER BY p.mensualidad DESC"; 
    $resultado=mysqli_query(conectar(),$consulta);
    desconectar();
    while($row=mysqli_fetch_assoc($resultado)){
        $mensualidad = $row['mensualidad']; //Numero de la mensualidad
        $dia_pago = $row['dia_pago']; //Dia estipulado para pagar
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
};//fin del else

/*
$html='
<tr>
    <th scope="row">1</th>
    <td>12/01/2022 - 12/02/2022</td>
    <td>17/01/2022</td>
    <td>1500</td>
    <td>1500</td>
    <td>0</td>
    <td>Enganche 1</td>
</tr>
'*/

?>
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



//ELIMINAR LA TABLA LOTES-CONTRATO
    $consulta = "SELECT
    c.id_contrato,
    cl.nombre,
    cl.apellido_paterno,
    cl.apellido_materno,
    c.dia_pago,
    l.fase,
    l.super_manzana, 
    l.mza,
    l.lote,
    cat_ev.nombre AS estatus_venta,
    cat_tc.nombre AS tipo_compra,
    c.cant_enganche
    FROM contrato c 
    INNER JOIN cliente_contrato c_co
    ON c.id_contrato = c_co.id_contrato
    INNER JOIN clientes cl
    ON c_co.id_cliente = cl.id_cliente
    INNER JOIN lotes l
    ON c.id_lote = l.id_lote
    INNER JOIN cat_estatus_venta cat_ev
    ON cat_ev.id_estatus_venta = c.id_estatus_venta
    INNER JOIN cat_tipo_compra cat_tc
    ON cat_tc.id_tipo_compra = c.id_tipo_compra
    WHERE c.id_contrato = '$id_contrato'"; 
$resultado=mysqli_query(conectar(),$consulta);
$row=mysqli_fetch_assoc($resultado);
desconectar();

$fase = $row['fase'];
$estatus_venta = $row['estatus_venta'];
$tipo_compra = $row['tipo_compra'];
$cant_enganche = $row['cant_enganche'];
$dia_pago = $row['dia_pago'];


$nombre_completo = $row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno'];

$lote = $row['fase']."-".$row['super_manzana']."-".$row['mza']."-".$row['lote'];   

//Consulta abonado intereses y capital
$sql="SELECT * from pagos where id_contrato like '".$id_contrato."' ";
$result = mysqli_query(conectar(),$sql);
desconectar();
$num = mysqli_num_rows($result);
if($num!=0){
    $sql_capital = "SELECT sum(abonado_capital) from pagos where id_contrato like '".$id_contrato."' ";
    $result_capital = mysqli_query(conectar(),$sql_capital);
    desconectar();
    $col_capital = mysqli_fetch_array($result_capital);
    $abonado_capital = $col_capital[0];
    $sql_intereses = "SELECT sum(abonado_interes) from pagos where id_contrato like '".$id_contrato."' ";
    $result_intereses = mysqli_query(conectar(),$sql_intereses);
    desconectar();
    $col_intereses = mysqli_fetch_array($result_intereses);
    $abonado_intereses = $col_intereses[0];
    $sql_deuda = "SELECT max(id_pago) from pagos where id_contrato like '".$id_contrato."' ";
    $result_deuda = mysqli_query(conectar(),$sql_deuda);
    desconectar();
    $col_deuda = mysqli_fetch_array($result_deuda);
    $id_pago = $col_deuda[0];
    $sql_deuda = "SELECT balance_final from pagos where id_pago like '".$id_pago."' ";
    $result_deuda = mysqli_query(conectar(),$sql_deuda);
    desconectar();
    $row_deuda = mysqli_fetch_array($result_deuda);
    $deuda_restante = $row_deuda[0];

}else{
    $abonado_capital="NO DISPONIBLE";
    $abonado_intereses="NO DISPONIBLE";
    $deuda_restante="NO DISPONIBLE";
}//fin del else


//Inicio del formulario

/*
Datos a agregar:
-Cantidad restante a pagar
-Tipo de pago del enganche
-
*/

$html="
<div class='card-body'>

    <h5 class='card-title'>Datos del contrato</h5>
        <h6 class='card-subtitle mb-2 text-muted'>Datos adicionales del contrato seleccionado.</h6>
            <div class='card-text'>
                <div class='row mb-3'>
                  <label for='inp_nombre_cliente' class='col-sm-2 col-form-label'>Nombre del cliente</label>
                  <div class='col-sm-2'>
                  <input type='text' class='form-control' id='inp_nombre_cliente' value='$nombre_completo' disabled>
            </div>
            <label for='inp_lote' class='col-sm-2 col-form-label'>Lote Comprado</label>
            <div class='col-sm-2'>
                <input type='text' class='form-control' id='inp_lote' value='$lote' disabled>
            </div>
            <label for='inp_dpago' class='col-sm-2 col-form-label'>Día límite de pago</label>
            <div class='col-sm-2'>
                <input type='text' class='form-control' id='inp_dpago' value='$dia_pago' disabled>
            </div>
            </div>
            <div class='row mb-3'>
                <label for='inp_eventa' class='col-sm-2 col-form-label'>Estatus del contrato</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='inp_eventa' value='$estatus_venta' disabled>
                </div>
                <label for='inp_tcompra' class='col-sm-2 col-form-label'>Tipo de compra</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='inp_tcompra' value='$tipo_compra' disabled>
                </div>
                <label for='inp_eng' class='col-sm-2 col-form-label'>Enganche</label>
                <div class='col-sm-2'>
                    <input type='number' class='form-control' id='inp_eng' value='$cant_enganche' disabled>
                </div>
            </div>
            <div class='row mb-3'>
                <label for='abo_capital' class='col-sm-2 col-form-label'>Abonado Capital</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='abo_capital' value='$abonado_capital' disabled>
                </div>
                <label for='abo_int' class='col-sm-2 col-form-label'>Abonado Intereses</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='abo_int' value='$abonado_intereses' disabled>
                </div>
                <label for='abo_int' class='col-sm-2 col-form-label'>Deuda Restante</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='abo_int' value='$deuda_restante' disabled>
                </div>
            </div>
                <button data-id_contrato='' class='col-sm-2 btn btn-primary' onclick='pago_nuevo(".$row['id_contrato'].")'>Agregar Pago Nuevo</button>
              </div>
        </div>
        ";
        echo $html;
    };//fin del else
    
?>
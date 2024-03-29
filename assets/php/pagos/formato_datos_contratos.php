<?php
include('../conexion.php');
$id_contrato = filter_input(INPUT_POST,'id_contrato',FILTER_SANITIZE_NUMBER_INT);
if($id_contrato==" "||$id_contrato==""||$id_contrato==0) return false;

$datosContrato = datosAdicionalesContrato($id_contrato);
$html = "";
if($datosContrato!=false){
    //Extraemos los datos de la consulta
    $fase = $datosContrato['fase'];
    $p_venta = number_format($datosContrato['precio_venta'],2);
    $estatus_venta = $datosContrato['estatus_venta'];
    $tipo_compra = $datosContrato['tipo_compra'];
    $cant_enganche = number_format($datosContrato['cant_enganche'],2);
    $dia_pago = $datosContrato['dia_pago'];
    $nombre_completo = $datosContrato['nombre']." ".$datosContrato['apellido_paterno']." ".$datosContrato['apellido_materno'];
    $lote = $datosContrato['fase']."-".$datosContrato['super_manzana']."-".$datosContrato['mza']."-".$datosContrato['lote'];  
    
    $deuda_restante = traeDeudaRestante($id_contrato);
    $deuda_restante = number_format($deuda_restante,2);
    $abonado = traeAbonadoCapitaleInteres($id_contrato);
    $abonado_capital = number_format($abonado['abonadoCapital'],2);
    $abonado_intereses = number_format($abonado['abonadoInteres'],2);
    $datosContrato['precio_lista'] = number_format($datosContrato['precio_lista'],2);
    $datosContrato['precio_venta'] = number_format($datosContrato['precio_venta'],2);

    if ($deuda_restante == false || $deuda_restante === "0.00") {
        $deuda_restante=$p_venta;
    }

    if ($abonado_capital == null) {
        $abonado_capital="0";  
    }

    if ($abonado_intereses == null) {
        $abonado_intereses="0";
    }
    
}
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
                    <input type='text' class='form-control' id='inp_eng' value='$cant_enganche' disabled>
                </div>
            </div>
            <div class='row mb-3'>
                <label for='precio_lista' class='col-sm-2 col-form-label'>Precio de Lista</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='precio_lista' value='{$datosContrato['precio_lista']}' disabled>
                </div>
                <label for='precio_venta' class='col-sm-2 col-form-label'>Precio de venta</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='precio_venta' value='{$datosContrato['precio_venta']}' disabled>
                </div>
                <label for='abo_int' class='col-sm-2 col-form-label'>Deuda Restante</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='abo_int' value='$deuda_restante' disabled>
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
                <label for='fecha_firma' class='col-sm-2 col-form-label'>Fecha de firma de contrato</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' id='fecha_firma' value='{$datosContrato['fecha_firma']}' disabled>
                </div>
            </div>
            <div class='row'>
                <button data-id_contrato='' class='col-sm-2 btn btn-primary' onclick='pago_nuevo($id_contrato)'>Agregar Pago Nuevo</button>
                <button data-id_contrato='' class='col-sm-2 btn btn-warning' onclick='abono_capital($id_contrato)'>Agregar Abono a Capital</button>
            </div>
        </div>";

function datosAdicionalesContrato($id_contrato){
    $sql = "SELECT
        c.id_contrato,
        c.precio_venta,
        c.cant_apartado,
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
        c.cant_enganche,
        l.precio_lista,
        c.fecha_firma
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

    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0&&$result!=false){
        $row = mysqli_fetch_array($result);
        return $row;
    }else{
        return false;
    }
}

function traeAbonadoCapitaleInteres($id_contrato){
    $sql = "SELECT 
        sum(abonado_interes) as abonadoInteres, 
        sum(abonado_capital) as abonadoCapital  
        from pagos 
        where id_contrato = $id_contrato 
        and habilitado = 1 ";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0&&$result!=false){
        $row = mysqli_fetch_array($result);
        return $row;
    }else{
        return false;
    }
}
function traeDeudaRestante($id_contrato){
    $sql = "SELECT balance_final from pagos where id_contrato = $id_contrato and habilitado = 1 ORDER BY id_pago desc LIMIT 1";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        return $row['balance_final'];
    }else{
        return false;
    }

}
echo $html;




?>
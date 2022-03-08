<?php

session_start();

include "../conexion.php";

if(empty($_GET["id_contrato"])){
	$id_contrato="0";
}else{
	$id_contrato=$_GET["id_contrato"];
}//Fin del else

//VAMOS A TRAER LA INFORMACION DEL CONTRATO PARA COLOCARLA EN EL FORMULARIO DE PAGO
	/*
    Primero consultamos en que estado se encuentra el contrato.

    Si el contrato se encuentra en Reservado, significa que aun no hay ningun pago registrado.
    Por lo que vamos a colocar el concepto como "Apartado"

    Si el contrato se encuentra en Enganche, significa que el apartado ya esta pagado

    Primero consultamos si existe algun pago para ese contrato.
    Si no existe ningun pago, entonces 
    
    
    TRAEMOS: Concepto en el que esta el contrato
		Cantidad mensual estipulada
		Algun recargo del mes anterior		
        
	*/

    
//Comenzamos revisando si el contrato tiene algun pago registrado y habilitado
$sql="SELECT
    (SELECT monto_mensual FROM contrato WHERE id_contrato = '$id_contrato') AS monto_mensual,
    (SELECT id_estatus_venta FROM contrato WHERE id_contrato = '$id_contrato') AS id_estatus_venta,
    (SELECT mensualidades_enganche FROM contrato WHERE id_contrato = '$id_contrato') AS mensualidades_enganche,
    (SELECT cant_apartado FROM contrato WHERE id_contrato = '$id_contrato') AS cant_apartado,
    (SELECT cant_enganche FROM contrato WHERE id_contrato = '$id_contrato') AS cant_enganche,
    (SELECT MAX(no_mensualidad) from pagos where habilitado IS true) as ultima_mensualidad,
    (SELECT diferencia from pagos where no_mensualidad = ultima_mensualidad and habilitado IS true) as ultima_diferencia,
    (SELECT mensualidad_historica from pagos where no_mensualidad = ultima_mensualidad and habilitado IS true) as mensualidad_historica
    FROM
    pagos WHERE id_contrato = '$id_contrato'";
     
$result=mysqli_query(conectar(),$sql);
desconectar();
$rows = mysqli_num_rows($result);
if($rows > 0){
    //Si existe algún pago...
    $epa = 1; //(Existe Pago Anterior)Nos sirve para indicar que formulario enviaremos.
    $row=mysqli_fetch_array($result);
    $no_mensualidad = $row['ultima_mensualidad'];
    $ultima_diferencia = $row['ultima_diferencia'];
    $mensualidad_historica = $row['mensualidad_historica'];
    $monto_mensual = $row['monto_mensual'];
    $id_estatus_venta = $row['id_estatus_venta'];
    $mensualidades_enganche = $row['mensualidades_enganche'];
    $cant_apartado = $row['cant_apartado'];
    $cant_enganche = $row['cant_enganche'];

    //Datos que se usan en el formulario
    $int_mes_anterior = ($row['ultima_diferencia']*0.02);
    $tot_a_pagar = ($row['monto_mensual']+$row['ultima_diferencia']+$int_mes_anterior);
}else{
    //Si no existe algún pago consultamos la mensualidad del contrato
    $epa = 0;//Indicamos que no existe ningun pago
    $sql = "SELECT monto_mensual, id_estatus_venta, mensualidades_enganche, cant_apartado, cant_enganche FROM contrato WHERE id_contrato LIKE '$id_contrato'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $row=mysqli_fetch_array($result);
    $monto_mensual = $row['monto_mensual'];
    $id_estatus_venta = $row['id_estatus_venta'];
    $mensualidades_enganche = $row['mensualidades_enganche'];
    $cant_apartado = $row['cant_apartado'];
    $cant_enganche = $row['cant_enganche'];
}

/*
CONSULTA ANTERIOR
$sql="SELECT
    monto_mensual,
    id_estatus_venta,   
    (SELECT MAX(no_mensualidad) FROM pagos WHERE id_contrato = '$id_contrato') AS ultima_mensualidad,
    (SELECT diferencia from pagos where mensualidad = ultima_mensualidad) AS ultima_diferencia
    FROM contrato
    WHERE id_contrato LIKE '$id_contrato'"; //Consultar id de la variable
//echo $sql;
$result=mysqli_query(conectar(),$sql);
desconectar();
$row=mysqli_fetch_array($result);
$num=mysqli_num_rows($result);
*/

$response=Array();

//Verificamos el estatus del contrato, para saber que concepto tendra el pago
//1 - Contrato Firmado -> Concepto - Mensualidad
//2 - Enganche -> Concepto - Mensualidad Enganche
//3 - Reservado -> Concepto - Mensualidad Reservado
$concepto = '';

switch ($id_estatus_venta) {
    case 1:
        //Contrato Firmado
        $concepto = "MENSUALIDAD";
        $id_concepto = 4;
        break;
    case 2:
        //Enganche
        if($mensualidades_enganche==0||$mensualidades_enganche==null){
            //Si no existen mensualidades para el enganche
            $concepto = "ENGANCHE";
            $id_concepto = 2;
            $monto_mensual = $cant_enganche;
            $tot_a_pagar = $cant_enganche;
        }else{
            //Si existe alguna mensualidad para el enganche
            $concepto = "MENSUALIDAD ENGANCHE";
            $monto_mensual = $cant_enganche/$mensualidades_enganche;
            $tot_a_pagar = $monto_mensual;
            $id_concepto = 3;
        }
        break;
    case 3:
        //Reservado
        $concepto = "APARTADO";
        $monto_mensual = $cant_apartado;
        $tot_a_pagar = $monto_mensual;
        $id_concepto = 1;
        break;
}
$response = Array();

//Aqui indicamos que formulario enviaremos.
//epa = 1 indica que existe un pago anterior y jalaremos el recargo e interés del pago anterior
if($epa == 1){
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
                    <input type='email' class='form-control' id='inp_mensualidad' value='$monto_mensual' disabled>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='input_fpago' class='col-sm-2 col-form-label'>Fecha Pago</label>
                <div class='col-sm-2'>
                    <input type='date' class='form-control' id='inp_fpago'>
                </div>
                <label for='inp_recargo' class='col-sm-2 col-form-label'>Recargo mes anterior</label>
                <div class='col-sm-2'>
                    <input type='number' class='form-control' id='inp_recargo' value='$ultima_diferencia'>
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
}else{
    //epa = 0 indica que NO existe un pago anterior, por lo que presentaremos la mensualidad correspondiente
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
                <input type='email' class='form-control' id='inp_mensualidad' value='$monto_mensual' disabled>
            </div>
        </div>

        <div class='row mb-3'>
            <label for='input_fpago' class='col-sm-2 col-form-label'>Fecha Pago</label>
            <div class='col-sm-2'>
                <input type='date' class='form-control' id='inp_fpago'>
            </div>
            <label for='inp_recargo' class='col-sm-2 col-form-label'>Recargo mes anterior</label>
            <div class='col-sm-2'>
                <input type='number' class='form-control' id='inp_recargo' value=''>
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
            <input type='number' class='form-control' id='inp_interes' onkeyup='actualiza_datos_pago()'  value=''>
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
}

    $response['html'] = $html;
    echo json_encode($response);
?>

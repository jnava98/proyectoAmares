<?php
//require('assets/fpdf/fpdf.php');
require('assets/php/NumeroALetras.php');
include "assets/php/conexion.php";
include "assets/php/funciones.php";
require('assets/php/rotation.php');

class PDF extends PDF_Rotate{
    /*function Header(){
        //Put the watermark
        $this->SetFont('Arial','B',75);
        $this->SetTextColor(147, 149, 152);
        $this->RotatedText(30,230,'E N   P R O C E S O',45);
    }//fin header*/

    function RotatedImage($file,$x,$y,$w,$h,$angle){
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        $this->Image($file,$x,$y,$w,$h);
        $this->Rotate(0);
    }
}//fin class
$pdf=new PDF();

if(empty($_POST["input_id_pago"])){
    $id_pago="0";
}else{
    $id_pago=$_POST["input_id_pago"];
}//Fin del else...

$sql="SELECT id_contrato, monto_pagado, fecha_pago from pagos where id_pago like '".$id_pago."'";
$result=mysqli_query(conectar(),$sql);
desconectar();
$row = mysqli_fetch_array($result);
$id_contrato = $row['id_contrato'];
$monto_pagado = $row['monto_pagado'];
$fecha_pago = $row['fecha_pago'];

$Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Line(20, 45, 210-20, 45); // 20mm from each edge
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position+=10);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('RECIBO DE PAGO'),0,'J',0);
    $pdf->Ln();

    $pdf->SetFont('Arial','B',12);
    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=10);
    $pdf->MultiCell(180,5,utf8_decode('Nombre de la empresa: Amares Riviera Maya'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $fecha_aux = date("d/m/Y", strtotime($fecha_pago));
    $pdf->MultiCell(180,5,utf8_decode('Fecha: '.$fecha_aux),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $formatter = new NumeroALetras();
    $valor_letras = $formatter->toMoney($monto_pagado, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(180,5,utf8_decode('Cantidad pagada: '.$monto_pagado.' '.$valor_letras),0,'J',0);
    $pdf->Ln();

    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato, c.correo, c.direccion, c.telefono from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $pdf->SetFont('Arial','B',14);
        $pdf->SetY($Y_Table_Position+=30);
        $pdf->SetX($X_Table_Position);
        $pdf->MultiCell(180,5,utf8_decode('Clientes'),0,'J',0);
        $pdf->Ln();
        while($col=mysqli_fetch_array($result)){
            $pdf->SetY($Y_Table_Position+=15);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',12);
            $pdf->MultiCell(180,5,utf8_decode('Nombre del cliente: '.$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']),0,'J',0);
            $pdf->Ln();

            $pdf->SetY($Y_Table_Position+=10);
            $pdf->SetX($X_Table_Position);
            $pdf->MultiCell(180,5,utf8_decode('Dirección: '.$col['direccion']),0,'J',0);
            $pdf->Ln();

            $pdf->SetY($Y_Table_Position+=10);
            $pdf->SetX($X_Table_Position);
            $pdf->MultiCell(180,5,utf8_decode('Correo: '.$col['correo']),0,'J',0);
            $pdf->Ln();

            $pdf->SetY($Y_Table_Position+=10);
            $pdf->SetX($X_Table_Position);
            $pdf->MultiCell(180,5,utf8_decode('Teléfono: '.$col['telefono']),0,'J',0);
            $pdf->Ln();
        }//fin del while
    }//fin del if  

    $pdf->Output();
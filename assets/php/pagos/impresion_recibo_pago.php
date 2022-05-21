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
    $pdf->Image('assets/img/FourCardinalsLogo.png',15,15,40,20);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    //$pdf->Line(20, 45, 210-20, 45); // 20mm from each edge
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position+=10);
    $pdf->SetFont('Arial','B',20);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(160,5,utf8_decode('RECIBO'),0,'C',0);
    $pdf->Ln();

    $pdf->SetFont('Arial','',12);
    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=10);
    $fecha_aux = date("d/m/Y", strtotime($fecha_pago));
    $pdf->MultiCell(180,5,utf8_decode('Fecha: '.$fecha_aux),0,'R',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('Playa del Carmen, Solidaridad, Q. Roo'),0,'R',0);
    $pdf->Ln();

    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato, c.correo, c.direccion, c.telefono from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux == 0){
                $clientes = $col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno'];
                $aux = 1;
            }else{
                $clientes.=", ".$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno'];
            }//fin del else

            /*$pdf->SetY($Y_Table_Position+=10);
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
            $pdf->Ln();*/
        }//fin del while
        $pdf->SetFont('Arial','',12);
        $pdf->SetY($Y_Table_Position+=20);
        $pdf->SetX($X_Table_Position);
        $pdf->MultiCell(50,5,utf8_decode('Recibí por parte de:'),0,'J',0);
        $pdf->Ln();
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX($X_Table_Position+=50);
        $pdf->MultiCell(130,5,utf8_decode(strtoupper($clientes)),0,'J',0);
        $pdf->Ln();

        $pdf->SetFont('Arial','',12);
        $pdf->SetY($Y_Table_Position+=20);
        $pdf->SetX($X_Table_Position-=50);
        $pdf->MultiCell(50,5,utf8_decode('La cantidad de:'),0,'J',0);
        $pdf->Ln();
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX($X_Table_Position+=50);
        $formatter = new NumeroALetras();
        $valor_letras = $formatter->toMoney($monto_pagado, 2, 'DÓLARES', 'CENTAVOS');
        $pdf->MultiCell(130,5,utf8_decode($monto_pagado.' USD.'),0,'J',0);
        $pdf->Ln();
        $pdf->SetY($Y_Table_Position+=10);
        $pdf->SetX($X_Table_Position);
        $formatter = new NumeroALetras();
        $valor_letras = $formatter->toMoney($monto_pagado, 2, 'DÓLARES', 'CENTAVOS');
        $pdf->MultiCell(130,5,utf8_decode($valor_letras."."),0,'J',0);
        $pdf->Ln();

        $pdf->SetFont('Arial','',12);
        $pdf->SetY($Y_Table_Position+=20);
        $pdf->SetX($X_Table_Position-=50);
        $pdf->MultiCell(50,5,utf8_decode('En concepto de:'),0,'J',0);
        $pdf->Ln();
        $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
        $result=mysqli_query(conectar(),$sql);
        desconectar();
        $lote="";
        $num = mysqli_num_rows($result);
        if($num>0){
            $row = mysqli_fetch_array($result);
            $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'];
        }//fin del if
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX($X_Table_Position+=50);
        $pdf->MultiCell(130,5,utf8_decode($lote),0,'J',0);
        $pdf->Ln();

        $pdf->SetY($Y_Table_Position+=110);
        $pdf->SetX($X_Table_Position-=50);
        $pdf->Image('assets/img/FourCardinals.png',65,180,80,40);
        $pdf->Line(60, 230, 210-60, 230);
        $pdf->MultiCell(180,5,utf8_decode('Cesar Gomez Paredes'),0,'C',0);
        $pdf->Ln();
        $pdf->SetY($Y_Table_Position+=12);
        $pdf->SetX($X_Table_Position);
        $pdf->MultiCell(180,5,utf8_decode('Director Administrativo Amares'),0,'C',0);
        $pdf->Ln();
    }//fin del if  

    

    $pdf->Output();
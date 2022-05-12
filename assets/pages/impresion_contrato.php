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

if(empty($_POST["input_impresion_contrato"])){
    $id_contrato="0";
}else{
    $id_contrato=$_POST["input_impresion_contrato"];
}//Fin del else...

if(empty($_POST["porcentaje_apartado"])){
    $porcentaje_apartado="0";
}else{
    $porcentaje_apartado=$_POST["porcentaje_apartado"];
}//Fin del else...

if(empty($_POST["porcentaje_enganche"])){
    $porcentaje_enganche="0";
}else{
    $porcentaje_enganche=$_POST["porcentaje_enganche"];
}//Fin del else...

if(empty($_POST["fecha_entrega"])){
    $fecha_entrega="0";
}else{
    $fecha_entrega=$_POST["fecha_entrega"];
}//Fin del else...

if(empty($_POST["select_idioma_contrato"])){
    $idioma="0";
}else{
    $idioma=$_POST["select_idioma_contrato"];
}//Fin del else...

if(empty($_POST["deposito_garantia"])){
    $deposito_garantia="0";
}else{
    $deposito_garantia=$_POST["deposito_garantia"];
}//Fin del else...

switch ($idioma){
    /*case "ING":
        echo contrato_ing($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche);
        break;
    case "ESP":
        echo contrato_esp($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche);
        break;*/
    case "cont_extra":
        echo contrato_contado_extranjero($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche, $fecha_entrega);
        break;
    case "financiado_extra":
        echo contrato_financiado_extranjero($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche, $fecha_entrega, $deposito_garantia);
        break;
    case "financiado":
        echo contrato_financiado($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche, $fecha_entrega, $deposito_garantia);
        break;
}//fin del switch

/*function contrato_esp($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche){
    $Y_Table_Position=18;
    $X_Table_Position=15;
    
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->SetTextColor(0,0,0);
    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $clientes = "";
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $clientes.=$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
                $aux=1;
            }else{
                $clientes.=", ".$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->MultiCell(180,6,utf8_decode('CONTRATO DE PROMESA DE COMPRAVENTA QUE CELEBRAN, POR UNA PARTE, LA SOCIEDAD DENOMINADA FOUR CARDINALS DEVELOPMENTS MÉXICO S.A. DE C.V. REPRESENTADA EN ESTE ACTO POR EL SR. ISAAC HENARES DUCLOS, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE VENDEDOR" Y POR OTRA PARTE EL SR./ SRA. '.strtoupper($clientes).', A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE COMPRADOR", DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=58);
    $pdf->SetX($X_Table_Position);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(180,6,'DECLARACIONES',0,'C',0);
    $pdf->Ln();
    //I
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(180,6,'I. "EL PROMITENTE VENDEDOR", declara por conducto de su representante legal:',0,'L',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Que es una sociedad mercantil legalmente constituida de acuerdo con las leyes mexicanas mediante Escritura Pública número 5,092 de fecha 11 de junio del año 2021, pasada ante la fe del Lic. Ramon Rolando Heredia Ruiz, Notario Público No. 83 de la Ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo e inscrita bajo el folio mercantil número 2021002199210014 del Registro Público de la Propiedad y el Comercio de la ciudad de Playa del Carmen.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position);
    
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Que su representada, comercializa el desarrollo Inmobiliario denominado "AMARES", localizado en Predio El Martillo, carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo, el cual estará compuesto por lotes unifamiliares, multifamiliares, acceso controlado, áreas verdes, vialidades y áreas de amenidades de uso común para los Propietarios del mencionado desarrollo, en lo sucesivo "EL INMUEBLE".'),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", con una superficie de ".$row['m2']."m2";
    }//fin del if
    $pdf->MultiCell(170,5,utf8_decode('Que sobre "EL INMUEBLE" referido en la declaración b), se han realizado las subdivisiones pertinentes, a través de las cuales se han obtenido las manzanas de las que resulta el lote individual, objeto del presente contrato en adelante "EL LOTE", identificado como '.$lote.', y cuyas características y descripción quedan establecidas en el Anexo A.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Que es voluntad de su representada celebrar el presente contrato de promesa de compraventa y obligarse en los términos establecidos en este contrato.'),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(180,6,utf8_decode('II. "EL PROMITENTE COMPRADOR", declara bajo protesta de decir verdad:'),0,0,'L',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Que cuenta con la capacidad jurídica y económica suficiente para obligarse y cumplir en los términos del presente contrato.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'];
    }//fin del if
    $pdf->MultiCell(170,5,utf8_decode('Que conoce la situación jurídica de "EL LOTE", identificado como '.$lote.', y está conforme con las características y descripción de éste, tal y como consta en el ANEXO A del presente contrato.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Que es su libre voluntad firmar el presente contrato de promesa de compraventa y manifiesta que en su momento el pago del precio de "EL LOTE" lo realiza con recursos de procedencia lícita.'),0,'J',0);
    $pdf->Ln();
    
    //III
    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,'III. AMBAS PARTES DECLARAN:',0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Se reconocen mutuamente la capacidad y personalidad jurídica para celebrar el presente contrato y lo suscriben por su propia y libre voluntad.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Estipulan y reconocen que los anexos de este contrato son parte integrante del mismo, por lo que deberán interpretarse, ejecutarse y concluirse de acuerdo con la información contenida en cada uno de ellos.'),0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(170,5,'Ambas partes se comprometen y obligan al tenor de las siguientes:',0,'L',0);
    $pdf->Ln();
    
    //CLAUSULAS
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->MultiCell(180,6,'CLAUSULAS',0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',11);
    $sql="SELECT c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote where c.id_contrato like '".$id_contrato."' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $valor_lote = $col[0];
    }else{
        $valor_lote=0;
    }//fin del else
    $formatter = new NumeroALetras();
    $valor_letras = $formatter->toMoney($valor_lote, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(180,5,utf8_decode('PRIMERA. - El Objeto del presente contrato es la promesa de "EL PROMITENTE VENDEDOR" de vender y transferir la propiedad de "EL LOTE" debidamente identificado en el ANEXO A del presente instrumento a "EL PROMITENTE COMPRADOR", quien promete adquirir el inmueble por la cantidad total de '.$valor_lote.' ('.$valor_letras.')'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('SEGUNDA. El precio pactado por "EL LOTE" será pagado por "EL PROMITENTE COMPRADOR", en los términos del presente contrato, de la siguiente manera:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(180,6,$porcentaje_enganche.'% de enganche a la firma del presente contrato de promesa de compraventa.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Los siguientes pagos se realizarán conforme a la tabla de pagos que se acompaña al presente contrato como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=14);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('En caso de que "EL PROMITENTE COMPRADOR" incumpla con uno o más de los pagos correspondientes por "EL LOTE" de acuerdo con el ANEXO B, la 3 totalidad del adeudo que en ese Anexo se señala se hará exigible; y pagará además a "EL PROMITENTE VENDEDOR" un interés moratorio adicional del 2% (dos por ciento) mensual, sobre todas las cantidades vencidas, desde el día del vencimiento, hasta la fecha del pago mismo.'),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('"EL PROMITENTE COMPRADOR", para garantizar el pago por el valor de "EL LOTE", firmará de su puño y letra al momento en que éste le sea entregado, los pagarés que se mencionan en la tabla de pagos identificada como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('TERCERA. - "EL PROMITENTE VENDEDOR" trasmitirá ad-corpus "EL LOTE", a favor de "EL PROMITENTE COMPRADOR", mediante la celebración y firma de la escritura pública de compraventa.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('Para poder proceder a la firma de la escritura pública de compraventa "EL PROMITENTE COMPRADOR" deberá acreditar haber realizado todos los pagos que se mencionan en el ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('Asimismo, "EL PROMITENTE COMPRADOR" deberá acreditar haber realizado el pago de los derechos y gastos notariales correspondientes.'),0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('Ambas partes establecen que hasta en tanto no se firme la escritura pública correspondiente, "EL PROMITENTE VENDEDOR" conservará el dominio pleno sobre el lote.'),0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('CUARTA. - "EL PROMITENTE VENDEDOR" se obliga a firmar la escritura pública correspondiente en un plazo no mayor a tres meses posteriores a la fecha en la cual "EL PROMITENTE COMPRADOR" demuestre haber dado cumplimiento a la cláusula que antecede, la cual ha de celebrarse con el notario público estipulado por "EL PROMITENTE VENDEDOR".'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('QUINTA - Ambas partes establecen que la entrega de "EL LOTE" deberá llevarse a cabo el día 15 de Julio de 2024, con un plazo adicional de 6 meses, fecha en la cual "EL LOTE" contará con el acceso, y servicios de luz, agua y drenaje a pie de lote.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('"EL PROMITENTE COMPRADOR" únicamente podrá hacer uso y tener el goce de "EL LOTE" siempre y cuando cumpla con las disposiciones federales, estatales y municipales, atendiendo íntegramente a lo ordenado en el Reglamento de construcción del proyecto AMARES, mismo que forma parte del ANEXO C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('A tales efectos "EL PROMITENTE COMPRADOR" deberá presentar para aprobación de "EL PROMITENTE VENDEDOR", a través del comité de arquitectura de la Asociación de Colonos, el proyecto de construcción que pretender edificar en "EL LOTE".'),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('A partir de la fecha de entrega de "EL LOTE" "EL PROMITENTE COMPRADOR" asume la obligación de realizar el pago de cuotas de mantenimiento de la Asociación de Colonos, impuesto predial, derechos por uso de agua y energía eléctrica individual y comunal.'),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('SEXTA - "EL PROMITENTE COMPRADOR", desde el momento de recibir el uso y goce de "EL LOTE", acepta entrar a formar parte de la Asociación de Colonos, de la cual será miembro. "EL PROMITENTE COMPRADOR" acepta y se obliga a que una vez reciba el derecho de uso y goce de "EL LOTE", respetará y acatará todas y cada una de las disposiciones que contenga el reglamento de uso y mantenimiento, reglamento de sana convivencia y reglamento arquitectónico establecidos por la Asociación de Colonos, así como las disposiciones legales o reglamentarias que tengan o llegaran a tener relación con "EL LOTE", incluyéndose de manera enunciativa más no limitativa, reglamentos de construcción municipal y/o estatal, y sus correspondientes usos de suelo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=58);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"EL PROMITENTE COMPRADOR" acepta que cederá su voto a "EL PROMITENTE VENDEDOR" en las asambleas de la Asociación de Colonos, hasta el momento en que haya realizado el pago total del precio pactado por "EL LOTE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('SEPTIMA. - "EL PROMITENTE COMPRADOR", no podrá ceder, vender o traspasar los derechos derivados del presente contrato sin el consentimiento previo por escrito de "EL PROMITENTE VENDEDOR", y en todo caso, las partes acuerdan desde ahora que, en caso de cualquier tipo de cesión, venta o traspaso, "EL PROMITENTE COMPRADOR" se obliga a pagar el 2.5% del valor de "EL LOTE" a "EL PROMITENTE VENDEDOR", por concepto de gastos administrativos por la autorización de la cesión de derechos.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('OCTAVA. - Las partes acuerdan y se obligan mediante el presente pacto comisorio a dar por terminado el presente contrato, sin necesidad de declaración judicial previa y sin responsabilidad alguna para "EL PROMITENTE VENDEDOR", como consecuencia de las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('Si "EL PROMITENTE COMPRADOR" deja de pagar dos o más pagos consecutivos del precio convenido por "EL LOTE" objeto de contrato;'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('Si "EL PROMITENTE COMPRADOR" vende, cede, traspasa o de alguna manera enajena o grava, sin la autorización de "EL PROMITENTE VENDEDOR", los derechos derivados del presente contrato.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('En caso de terminación del presente contrato por las causas de los incisos a) y b) aludidas en la presente cláusula, las partes acuerdan en concepto de indemnización, el pago del equivalente al 15% (quince por ciento) del precio total de "EL LOTE".'),0,'J',0);
    $pdf->Ln();
    
    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"EL PROMITENTE COMPRADOR" autoriza que el pago indemnizatorio mencionado, sea retenido por "EL PROMITENTE VENDEDOR" de las cantidades que haya cubierto como parte del pago del precio de "EL LOTE" o bien del depósito en garantía entregado, y en su caso, una vez notificado, devolverá el saldo resultante a "EL PROMITENTE COMPRADOR" en un plazo máximo de 20 días hábiles posteriores a la notificación de terminación de contrato. Quedando obligado "EL PROMITENTE COMPRADOR" a entregar de inmediato "EL LOTE" a "EL PROMITENTE VENDEDOR" con las construcciones y mejoras que hubiere efectuado y sin derecho a indemnización alguna.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=50);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('Adicional a lo anterior, se establece como causal de rescisión imputable a "EL PROMITENTE VENDEDOR" si cae en las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('Que "EL PROMITENTE VENDEDOR" se negare a otorgar la escritura pública de compraventa en el plazo máximo convenido.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('La falta de entrega oportuna del uso y goce de "EL LOTE" en los términos y plazos contenidos en el presente contrato;'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"EL PROMITENTE COMPRADOR" podrá optar por exigir el cumplimiento forzoso del contrato prometido, o bien el pago de una pena convencional sustitutiva de daños y perjuicios a su favor, equivalente a la cantidad que resulte de obtener el interés promedio conforme a la tasa de interés interbancaria que fije el Banco de México en el mes inmediato anterior al incumplimiento, sobre las cantidades efectivamente pagadas y desde la fecha en que se realicen y hasta su devolución, por concepto de indemnización.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('NOVENA- Las partes establecen que para que sea válida cualquier modificación, en todo o en parte, de lo acordado en este contrato, éstedeberá ser firmada por las partes por escrito.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('DÉCIMA. - Para los efectos de lo pactado en el presente contrato, las partes señalan como sus domicilios para recibir toda clase de notificaciones y comunicaciones que se cursen entre sí:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"EL PROMITENTE VENDEDOR": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550. Correo electrónico: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.direccion FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $direccion ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $direccion.=$col[0];
                $aux++;
            }else{
                $direccion.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"EL PROMITENTE COMPRADOR": SM 24 Mza. 100 Lt.1 #03 Conjunto 6 UP 6 '.$direccion),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.correo FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $correo ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $correo.=$col[0];
                $aux++;
            }else{
                $correo.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('Correo electrónico: '.$correo),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('DÉCIMA PRIMERA. - Para todo lo relativo a la interpretación y cumplimiento del presente contrato serán aplicables las leyes y tribunales competentes de la ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo. Ambas partes renuncian al fuero que por su domicilio presente o futuro pudiera resultar competente.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('LEÍDO Y ENTENDIDO QUE FUE EL PRESENTE CONTRATO, LO FIRMAN DE CONFORMIDAD, POR TRIPLICADO, AL MARGEN Y AL CALCE EN PLAYA DEL CARMEN. MUNICIPIO DE SOLIDARIDAD, QUINTANA ROO, MÉXICO A 19 DE NOVIEMBRE DEL 2021. ENTREGANDO A CADA PARTE UN DOCUMENTO ORIGINAL CON FIRMA AUTOGRAFA DEL MISMO Y SUS ANEXOS.'),0,'J',0);
    $pdf->Ln();

    //FIRMAS
    $pdf->SetY($Y_Table_Position+=70);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(10,6,"",0,'C');
    $pdf->Cell(40,6,"___________________________",0,'C');
    $pdf->Cell(50,6,"",0,'C');
    $pdf->Cell(40,6,"_____________________________",0,'C');
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(10,6,"",0,'C');
    $pdf->Cell(40,6,'"EL PROMITENTE VENDEDOR"',0,'C');
    $pdf->Cell(50,6,"",0,'C');
    $pdf->Cell(40,6,'"EL PROMITENTE COMPRADOR"',0,'C');
    $pdf->Ln();


    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,6,'ANEXO A',0,'J');
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO B',0,'J');
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO C',0,'J');
    $pdf->Ln();

    $pdf->Output();
}fin de contrato esp*/

/*function contrato_ing($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche){
    $Y_Table_Position=18;
    $X_Table_Position=15;
    
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->SetTextColor(0,0,0);
    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $clientes = "";
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $clientes.=$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
                $aux=1;
            }else{
                $clientes.=", ".$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->MultiCell(180,6,utf8_decode('PROMISE TO CREATE A TRUST ENTERED INTO BY ONE PART AS THE PROMISSORY TRUSTOR FOUR CARDINALS DEVELOPMENTS MEXICO S.A. DE C.V., REPRESENTED HEREIN BY ISAAC HENARES DUCLOS, AND BY THE OTHER PART AS PROMISSORY TRUSTEE '.strtoupper($clientes).', BY HIS OWN RIGHT, IN ACCORDANCE WITH THE FOLLOWING RECITALS AND CLAUSES:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=50);
    $pdf->SetX($X_Table_Position);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(180,6,'RECITALS',0,'C',0);
    $pdf->Ln();
    //I
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(180,6,'I. "THE PROMISSORY TRUSTOR" declares, through its legal representative, that:',0,'L',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('It is a corporation legally incorporated according to the laws of Mexico, as formalized in public document number 5,092 dated June 11, 2021, granted before Ramon Rolando Heredia Ruiz, Notary Public Number 83 for Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, entered in the Public Registry of Property and Commerce of Playa del Carmen under commercial folio number N-2021069757.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('It markets the real estate development known as "AMARES", located at Predio El Martillo, Carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo, that shall be made up of single-family and multi-family tourist residences, with controlled access, green areas, roadways and common facilities for the use of the residents of said development hereinafter "THE REAL ESTATE".'),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", whith an area of ".$row['m2']."m2";
    }//fin del if
    $pdf->MultiCell(170,5,utf8_decode('"THE REAL ESTATE" referred to in Recital b) above has been sub-divided into blocks in which the individual lot subject matter hereof is located, hereinafter "THE LOT", identified as '.$lote.', and whose features and description are specified in EXHIBIT A.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('It wishes to enter into the Promise of Create a Trust and to bind itself under the terms established herein.'),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(180,6,utf8_decode('II. "THE PROMISSORY TRUSTEE" declares that:'),0,0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('It has the legal capacity and financial means to bind itself under and comply with the terms hereof.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'];
    }//fin del if
    $pdf->MultiCell(170,5,utf8_decode('It is acquainted with the legal situation of "THE LOT", identified as '.$lote.', and agrees with its features and description, as specified in EXHIBIT A hereto.'),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('It freely wishes to enter into the Promise of Create a Trust and that the funds it shall use to pay the price of "THE LOT" are from a lawful source.'),0,'J',0);
    $pdf->Ln();
    
    //III
    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,'III. BOTH PARTIES DECLARE THAT:',0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Each recognizes the legal capacity of the other to enter into the Agreement and that they sign it of their own free will.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('They stipulate and acknowledge that the exhibits hereto are an integral part hereof, so they must be construed, perform and concluded according to the information contained in each.'),0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(170,5,'They agree to be bound by the following clauses:',0,'L',0);
    $pdf->Ln();
    
    //CLAUSULAS
    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->MultiCell(180,6,'CLAUSES',0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',11);
    $sql="SELECT c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote where c.id_contrato like '".$id_contrato."' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $valor_lote = $col[0];
    }else{
        $valor_lote=0;
    }//fin del else
    $formatter = new NumeroALetras();
    $valor_letras = $formatter->toMoney($valor_lote, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(180,5,utf8_decode('ONE. The purpose of the Agreement is the promise of "THE PROMISSORY TRUSTOR" to execute a Final Trust Agreement with Irrevocable Transfer of Ownership with respect to "THE LOT" specified in EXHIBIT A hereto to "THE PROMISSORY TRUSTEE", who promises to acquire trustee rights for the total sum of US $'.$valor_lote),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('TWO. "THE PROMISSORY TRUSTEE" shall pay the price agreed for "THE LOT" under the terms hereof, as follows:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(180,6,$porcentaje_enganche.'% as down-payment upon signing the Agreement, deferred in 9 monthly payments.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('Subsequent payments shall be made as per the payment schedule attached hereto as EXHIBIT B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=14);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('If the "THE PROMISSORY TRUSTEE" fails to make one or more of the payments for the "THE LOT" as per EXHIBIT B, the total amount specified in EXHIBIT B shall become due demandable. "THE PROMISSORY TRUSTEE" shall also pay "THE PROMISSORY TRUSTOR" additional default interest at a rate of 2% (two percent) a month on all sums due and payable, as from the due date up until payment is made in full.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(170,5,utf8_decode('In order to guarantee payment of the value of "THE LOT", "THE PROMISSORY TRUSTEE" shall sign the promissory notes referred to in the payment schedule in EXHIBIT B, when it receives possession of "THE LOT".'),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('THREE. In order to guarantee performance of its obligations hereunder, "THE PROMISSORY TRUSTEE" undertakes to deposit a sum equivalent to 20% of the total price specified in Clause One hereof, as security deposit. "THE PROMISSORY TRUSTOR" shall return said deposit once "THE PROMISSORY TRUSTEE" has met its payment obligations established in Clause Two hereof, which shall be deposited in the bank account that "THE PROMISSORY TRUSTEE" nominates for said purpose.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=32);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('Notwithstanding the foregoing, "THE PROMISSORY TRUSTEE" may ask "THE PROMISSORY TRUSTOR", over any medium that both parties establish mutually, that the security deposit provided is used to cover any outstanding payments that "THE PROMISSORY TRUSTEE" has to make, in which case "THE PROMISSORY TRUSTOR" shall not be required to return the security deposit to "THE PROMISSORY TRUSTEE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('For this purpose, the security deposit may only be used to cover payment of the last 20% of the sale value of "THE LOT".'),0,'L',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('FOUR. "THE PROMISSORY TRUSTOR" shall transfer "THE LOT" ad-corpus to "THE PROMISSORY TRUSTEE" by signing a public document that formalizes the Final Trust Agreement with Irrevocable Transfer of Ownership.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('So that the public document of sale may be signed, "THE PROMISSORY TRUSTEE" must prove that it has made all payments referred to in EXHIBIT B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('"THE PROMISSORY TRUSTEE" must also prove that it has paid all notary costs and expenses.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('Both parties establish that "THE PROMISSORY TRUSTOR" shall retain full ownership of the lot until the public document has been signed.'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('FIVE. "THE PROMISSORY TRUSTOR" undertakes to sign the public document within three months of the date on which "THE PROMISSORY TRUSTEE" proves that it has complied with the provisions of the preceding clause, which must be granted before a notary public nominated by the "THE PROMISSORY TRUSTOR".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('SIX. Both parties established that possession of "THE LOT" shall be handed over on 7/15/2024, with an additional period of six months in which "THE LOT" shall be connected to electricity, water and drainage utilities.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"THE PROMISSORY TRUSTEE" may only use and enjoy "THE LOT" provided that it meets all federal, state and local laws, in particular, the provisions of the building regulations of the AMARES project, attached hereto as EXHIBIT C.'),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('To this end, "THE PROMISSORY TRUSTEE" must submit its project for the building that it intends to build on "THE LOT" to the architectural committee of the Residents Association, so that "THE PROMISSORY TRUSTOR" may approve it.'),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('As from when possession of "THE LOT" is handed over, "THE PROMISSORY TRUSTEE" assumes the obligation to pay the maintenance fees established by the Residents Association, plus property tax and water and electricity bills for "THE LOT" and for common areas.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('SEVEN. "THE PROMISSORY TRUSTEE" agrees to join the Residents Association as from when it begins to use and enjoy "THE LOT". "THE PROMISSORY TRUSTEE" agrees and undertakes that once it has receives the right to use and enjoy "THE LOT", it shall respect and observe all provisions of the use and maintenance regulations, community regulations and the architectural regulations established by the Residents Association, plus all legal or regulatory provisions that are or may be related to "THE LOT", including, but not limited to, local and/or state building regulations and their corresponding land use.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=46);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"THE PROMISSORY TRUSTEE" agrees that it shall assign its vote to "THE PROMISSORY TRUSTOR" at meetings of the Residents Association until the price agreed for "THE LOT" has been paid in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('EIGHT. "THE PROMISSORY TRUSTEE" may not assign, sell or transfer its rights hereunder without the prior consent of "THE PROMISSORY TRUSTOR" in writing and, in any case, the parties agree that if there is any type of assignment, sale or transfer hereafter, "THE PROMISSORY TRUSTEE" undertakes to pay "THE PROMISSORY TRUSTOR" 2.5% of the value of "THE LOT" to cover administrative expenses for authorizing assignment of rights.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=32);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('NINE. The parties agree that the Agreement may be terminated, without the need for a court order and with no liability for "THE PROMISSORY TRUSTOR", under any of the following circumstances:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('If "THE PROMISSORY TRUSTEE" fails to make two or more consecutive payments of the price agreed for "THE LOT" subject matter hereof.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('If "THE PROMISSORY TRUSTEE" sells, assigns, transfers or in any other manner encumbers or disposes of its rights hereunder, without the authorization of "THE PROMISSORY TRUSTOR".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('If the Agreement is terminated under the circumstances stipulated in paragraphs a) and b) above, the parties agree that a sum of 15% of the total price of "THE LOT" shall be payable as indemnity.'),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"THE PROMISSORY TRUSTEE" authorizes "THE PROMISSORY TRUSTOR" to withhold the indemnity payment referred to above from sums paid as part of the price of "THE LOT" or the security deposit provided and, once notified, it shall return the resulting balance to "THE PROMISSORY TRUSTEE" within twenty business days as from when termination of the Agreement has been notified, in which case, "THE PROMISSORY TRUSTEE" shall undertake to immediately return possession of "THE LOT" to "THE PROMISSORY TRUSTOR", with any buildings upon it and improvements made to it, without being entitled to any indemnity.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=46);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('Furthermore, the Agreement may be rescinded if "THE PROMISSORY TRUSTOR":'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=14);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('Refuses to grant the public document for the sale of "THE LOT" within the time agreed.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=14);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(170,6,utf8_decode('Fails to hand over the use and enjoyment of " T H E  L O T " under the terms and in the time specified herein.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('Should this be the case, "THE PROMISSORY TRUSTEE" may either demand obligatory performance of the Agreement or demand the reimbursement of the amounts paid, and the payment of a conventional penalty to cover any damage and losses that may be caused to it, charged at the average interest rate arrived at by multiplying the inter-bank interest rate set by the Banco de Mexico for the month prior to the default, by sums actually paid, as from when said payments are made until they are actually refunded, for indemnity.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('TEN. The parties establish that any amendments to all or part of the Agreement must be in writing and signed by the parties, so that they are valid.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('ELEVEN. - For the purpose hereof, the parties state that their addresses for receiving all types of notices and correspondence between them are as follows:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"THE PROMISSORY TRUSTOR": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550 E-mail address: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();


    $sql="SELECT cl.direccion FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $direccion ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $direccion.=$col[0];
                $aux++;
            }else{
                $direccion.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('"THE PROMISSORY TRUSTEE": '.$direccion),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.correo FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $correo ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $correo.=$col[0];
                $aux++;
            }else{
                $correo.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('E-mail address: '.$correo),0,'J',0);
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('TWELVE.- For all matters concerning construal and performance of the Agreement, the parties shall submit themselves to the laws and competent courts of Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, and waive any jurisdiction that may correspond to them on account of their current or future domicile.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=32);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,6,utf8_decode('HAVING READ AND UNDERSTOOD THE AGREEMENT, THE PARTIES SIGN IT IN TRIPLICATE, IN THE MARGIN AND AT THE FOOT, IN PLAYA DEL CARMEN, MUNICIPALITY OF SOLIDARIDAD, QUINTANA ROO, MEXICO, ON THE 28 DAY OF JANUARY 2022, EACH PARTY RETAINING AN ORIGINAL COPY, WHICH BEAR THEIR ORIGINAL SIGNATURE, AND THE EXHIBITS THERETO.'),0,'J',0);
    $pdf->Ln();

    //FIRMAS
    $pdf->SetY($Y_Table_Position+=70);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(10,6,"",0,'C');
    $pdf->Cell(40,6,"___________________________",0,'C');
    $pdf->Cell(50,6,"",0,'C');
    $pdf->Cell(40,6,"_____________________________",0,'C');
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(10,6,"",0,'C');
    $pdf->Cell(40,6,'"THE PROMISSORY TRUSTOR"',0,'C');
    $pdf->Cell(50,6,"",0,'C');
    $pdf->Cell(40,6,'"THE PROMISSORY TRUSTEE"',0,'C');
    $pdf->Ln();


    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,6,'EXHIBIT A',0,'J');
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'EXHIBIT B',0,'J');
    $pdf->Ln();

    //Nueva pagina
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'EXHIBIT C',0,'J');
    $pdf->Ln();

    $pdf->Output();
}fin de contrato esp*/

function contrato_contado_extranjero($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche, $fecha_entrega){
    $Y_Table_Position=18;
    $X_Table_Position=15;
    
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $clientes = "";
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $clientes.=$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
                $aux=1;
            }else{
                $clientes.=", ".$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->MultiCell(85,5,utf8_decode('CONTRATO DE PROMESA DE AFECTACION FIDUCIARIA CON FINANCIAMIENTO QUE CELEBRAN, POR UNA PARTE, LA SOCIEDAD DENOMINADA FOUR CARDINALS DEVELOPMENTS MÉXICO S.A. DE C.V. REPRESENTADA EN ESTE ACTO POR EL SR. ISAAC HENARES DUCLOS, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE FIDEICOMITENTE" Y POR OTRA PARTE EL SR. '.strtoupper($clientes).', A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE FIDEICOMISARIO", DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('PROMISE TO CREATE A TRUST ENTERED INTO BY ONE PART AS THE PROMISSORY TRUSTOR FOUR CARDINALS DEVELOPMENTS MEXICO S.A. DE C.V., REPRESENTED HEREIN BY ISAAC HENARES DUCLOS, AND BY THE OTHER PART AS PROMISSORY TRUSTEE '.strtoupper($clientes).', BY HIS OWN RIGHT, IN ACCORDANCE WITH THE FOLLOWING RECITALS AND CLAUSES: '),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=75);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('DECLARACIONES'),0,'C',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('RECITALS'),0,'C',0);
    $pdf->Ln();
    //I
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('I. "EL PROMITENTE FIDEICOMITENTE", declara por conducto de su representante legal: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('I. "THE PROMISSORY TRUSTOR" declares, through its legal representative, that:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que es una sociedad mercantil legalmente constituida de acuerdo con las leyes mexicanas mediante Escritura Pública número 5,092 de fecha 11 de junio del año 2021, pasada ante la fe del Lic. Ramon Rolando Heredia Ruiz, Notario Público No. 83 de la Ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo e inscrita bajo el folio mercantil número N-2021069757 del Registro Público de la Propiedad y el Comercio de la ciudad de Playa del Carmen.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It is a corporation legally incorporated according to the laws of Mexico, as formalized in public document number 5,092 dated June 11, 2021, granted before Ramon Rolando Heredia Ruiz, Notary Public Number 83 for Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, entered in the Public Registry of Property and Commerce of Playa del Carmen under commercial folio number N-2021069757'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=80);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que su representada, comercializa el desarrollo Inmobiliario denominado "AMARES", localizado en Predio El Martillo, carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo. '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It markets the real estate development known as "AMARES", located at Predio El Martillo, Carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo. '),0,'J',0);
    $pdf->Ln();
    
    //Page 2
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('El cual estará compuesto por lotes unifamiliares, multifamiliares, acceso controlado, áreas verdes, vialidades y áreas de amenidades de uso común para los Propietarios del mencionado desarrollo, en lo sucesivo "EL INMUEBLE".'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('That shall be made up of single-family and multi-family tourist residences, with controlled access, green areas, roadways and common facilities for the use of the residents of said development, hereinafter "THE REAL ESTATE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=45);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", con una superficie de ".$row['m2']."m2";
        $lote2 = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", whith an area of ".$row['m2'];
    }//fin del if
    $pdf->MultiCell(80,5,utf8_decode('Que sobre "EL INMUEBLE" referido en la declaración b), se han realizado las subdivisiones pertinentes, a través de las cuales se han obtenido las manzanas de las que resulta el lote individual, objeto del presente contrato en adelante "EL LOTE", identificado como '.$lote.', y cuyas características y descripción quedan establecidas en el Anexo A.'),0,'J',0);
    $pdf->Ln();
    $pdf->MultiCell(80,6,utf8_decode(''),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('"THE REAL ESTATE" referred to in Recital b) above has been sub-divided into blocks in which the individual lot subject matter hereof is located, hereinafter "THE LOT", identified as '.$lote2.' whose features and description are specified in EXHIBIT A.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=58);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que es voluntad de su representada celebrar el presente contrato de promesa de afectación fiduciaria y obligarse en los términos establecidos en este contrato.'),0,'J',0);
    $pdf->Ln();
    $pdf->MultiCell(80,6,utf8_decode(''),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It wishes to enter into the Promise of Create a Trust and to bind itself under the terms established herein.'),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('II. "EL PROMITENTE FIDEICOMISARIO", declara bajo protesta de decir verdad: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('II. "THE PROMISSORY TRUSTEE" declares that:'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que cuenta con la capacidad jurídica y económica suficiente para obligarse y cumplir en los términos del presente contrato.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It has the legal capacity and financial means to bind itself under and comply with the terms hereof. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'];
    }//fin del if
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que conoce la situación jurídica de "EL LOTE", identificado como '.$lote.', y está conforme con las características y descripción de éste, tal y como consta en el ANEXO A del presente contrato.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It is acquainted with the legal situation of "THE LOT", identified as '.$lote.', and agrees with its features and description, as specified in EXHIBIT A hereto.'),0,'J',0);
    $pdf->Ln();

    //Page 3
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que es su libre voluntad firmar el presente contrato de promesa de afectación fiduciaria y manifiesta que en su momento el pago del precio de "EL LOTE" lo realiza con recursos de procedencia lícita. '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It freely wishes to enter into the Promise of Create a Trust and that the funds it shall use to pay the price of "THE LOT" are from a lawful source. '),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('III. AMBAS PARTES DECLARAN:'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('III. BOTH PARTIES DECLARE THAT:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Se reconocen mutuamente la capacidad y personalidad jurídica para celebrar el presente contrato y lo suscriben por su propia y libre voluntad.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Each recognizes the legal capacity of the other to enter into the Agreement and that they sign it of their own free will.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Estipulan y reconocen que los anexos de este contrato son parte integrante del mismo, por lo que deberán interpretarse, ejecutarse y concluirse de acuerdo con la información contenida en cada uno de ellos.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('They stipulate and acknowledge that the exhibits hereto are an integral part hereof, so they must be construed, perform and concluded according to the information contained in each.  '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Ambas partes se comprometen y obligan al tenor de las siguientes: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('They agree to be bound by the following clauses:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('CLAUSULAS'),0,'C',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('CLAUSES'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position-=95);
    $sql="SELECT c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote where c.id_contrato like '".$id_contrato."' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $valor_lote = $col[0];
    }else{
        $valor_lote=0;
    }//fin del else
    $formatter = new NumeroALetras();
    $valor_letras = $formatter->toMoney($valor_lote, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(85,5,utf8_decode('PRIMERA. - El Objeto del presente contrato es la promesa de "EL PROMITENTE VENDEDOR" de vender y transferir la propiedad de "EL LOTE" debidamente identificado en el ANEXO A del presente instrumento a "EL PROMITENTE COMPRADOR", quien promete adquirir el inmueble por la cantidad total de '.$valor_lote.' ('.$valor_letras.')'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('ONE. The purpose of the Agreement is the promise of "THE PROMISSORY TRUSTOR" to execute a Final Trust Agreement with Irrevocable Transfer of Ownership with respect to "THE LOT" specified in EXHIBIT A hereto to "THE PROMISSORY TRUSTEE", who promises to acquire trustee rights for the total sum of US $'.$valor_lote),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=50);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('SEGUNDA. El precio pactado por "EL LOTE" será pagado por "EL PROMITENTE COMPRADOR", en los términos del presente contrato, de la siguiente manera:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TWO. "THE PROMISSORY TRUSTEE" shall pay the price agreed for "THE LOT" under the terms hereof, as follows:'),0,'J',0);
    $pdf->Ln();

    //Page 4
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(85,6,$porcentaje_enganche.'% de enganche a la firma del presente contrato de promesa de compraventa.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(85,6,$porcentaje_enganche.'% as down-payment upon signing the Agreement, deferred in 9 monthly payments.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Los siguientes pagos se realizarán conforme a la tabla de pagos que se acompaña al presente contrato como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Subsequent payments shall be made as per the payment schedule attached hereto as EXHIBIT B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('En caso de que "EL PROMITENTE COMPRADOR" incumpla con uno o más de los pagos correspondientes por "EL LOTE" de acuerdo con el ANEXO B, la 3 totalidad del adeudo que en ese Anexo se señala se hará exigible; y pagará además a "EL PROMITENTE VENDEDOR" un interés moratorio adicional del 2% (dos por ciento) mensual, sobre todas las cantidades vencidas, desde el día del vencimiento, hasta la fecha del pago mismo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If the "THE PROMISSORY TRUSTEE" fails to make one or more of the payments for the "THE LOT" as per EXHIBIT B, the total amount specified in EXHIBIT B shall become due demandable. "THE PROMISSORY TRUSTEE" shall also pay "THE PROMISSORY TRUSTOR" additional default interest at a rate of 2% (two percent) a month on all sums due and payable, as from the due date up until payment is made in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=60);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO", para garantizar el pago por el valor de "EL LOTE", firmará de su puño y letra al momento en que este le sea entregado, los pagarés que se mencionan en la tabla de pagos identificada como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('In order to guarantee payment of the value of "THE LOT", "THE PROMISSORY TRUSTEE" shall sign the promissory notes referred to in the payment schedule in EXHIBIT B, when it receives possession of "THE LOT".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('TERCERA. - "EL PROMITENTE FIDEICOMITENTE" trasmitirá ad-corpus "EL LOTE", a favor de "EL PROMITENTE FIDEICOMISARIO", mediante la celebración y firma de la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('THREE. "THE PROMISSORY TRUSTOR" shall transfer "THE LOT" ad-corpus to "THE PROMISSORY TRUSTEE" by signing a public document that formalizes the Final Trust Agreement with Irrevocable Transfer of Ownership.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=32);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Para poder proceder a la firma de la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio "EL PROMITENTE FIDEICOMISARIO" deberá acreditar haber realizado todos los pagos que se mencionan en el ANEXO B. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('So that the public document of sale may be signed, "THE PROMISSORY TRUSTEE" must prove that it has made all payments referred to in EXHIBIT B. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Asimismo, "EL PROMITENTE FIDEICOMISARIO" deberá acreditar haber realizado el pago de los derechos y gastos notariales correspondientes. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" must also prove that it has paid all notary costs and expenses. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Ambas partes establecen que hasta en tanto no se firme la escritura pública correspondiente, "EL PROMITENTE FIDEICOMITENTE" conservará el dominio pleno sobre el lote. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Both parties establish that "THE PROMISSORY TRUSTOR" shall retain full ownership of the lot until the public document has been signed.'),0,'J',0);
    $pdf->Ln();

    //Page 5
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('CUARTA. - "EL PROMITENTE FIDEICOMITENTE" se obliga a firmar la escritura pública correspondiente en un plazo no mayor a tres meses posteriores a la fecha en la cual "EL PROMITENTE FIDEICOMISARIO" demuestre haber dado cumplimiento a la cláusula que antecede, la cual ha de celebrarse con el notario público estipulado por "EL PROMITENTE FIDEICOMITENTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('FOUR. "THE PROMISSORY TRUSTOR" undertakes to sign the public document within three months of the date on which "THE PROMISSORY TRUSTEE" proves that it has complied with the provisions of the preceding clause, which must be granted before a notary public nominated by the "THE PROMISSORY TRUSTOR".'),0,'J',0);
    $pdf->Ln();

    $aux_dia = date("d", strtotime($fecha_entrega));
    $aux_mes = date("m", strtotime($fecha_entrega));
    $aux_anio = date("Y", strtotime($fecha_entrega));
    $pdf->SetY($Y_Table_Position+=50);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('QUINTA. - Ambas partes establecen que la entrega de "EL LOTE" deberá llevarse a cabo el día '.$aux_dia.' de '.$aux_mes.' de '.$aux_anio.', con un plazo adicional de 6 meses, fecha en la cual "EL LOTE" contará con el acceso, y servicios de luz, agua y drenaje a pie de lote.'),0,'J',0);
    $pdf->Ln();

    $aux = date("d/m/Y", strtotime($fecha_entrega));
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('FIVE. Both parties established that possession of "THE LOT" shall be handed over on '.$aux.', with an additional period of six months in which "THE LOT" shall be connected to electricity, water and drainage utilities.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=36);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" únicamente podrá hacer uso y tener el goce de "EL LOTE" siempre y cuando cumpla con las disposiciones federales, estatales y municipales, atendiendo íntegramente a lo ordenado en el Reglamento de construcción del proyecto AMARES, mismo que forma parte del ANEXO C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" may only use and enjoy "THE LOT" provided that it meets all federal, state and local laws, in particular, the provisions of the building regulations of the AMARES project, attached hereto as EXHIBIT C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('A tales efectos "EL PROMITENTE FIDEICOMISARIO" deberá presentar para aprobación de "EL PROMITENTE FIDEICOMITENTE", a través del comité de arquitectura de la Asociación de Colonos, el proyecto de construcción que pretender edificar en "EL LOTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('To this end, "THE PROMISSORY TRUSTEE" must submit its project for the building that it intends to build on "THE LOT" to the architectural committee of the Residents Association, so that "THE PROMISSORY TRUSTOR" may approve it.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('A partir de la fecha de entrega de "EL LOTE" "EL PROMITENTE FIDEICOMISARIO" asume la obligación de realizar el pago de cuotas de mantenimiento de la Asociación de Colonos, impuesto predial, derechos por uso de agua y energía eléctrica individual y comunal.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('As from when possession of "THE LOT" is handed over, "THE PROMISSORY TRUSTEE" assumes the obligation to pay the maintenance fees established by the Residents Association, plus property tax and water and electricity bills for "THE LOT" and for common areas.  '),0,'J',0);
    $pdf->Ln();

    //Page 6
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('SEXTA - "EL PROMITENTE FIDEICOMISARIO", desde el momento de recibir el uso y goce de "EL LOTE", acepta entrar a formar parte de la Asociación de Colonos, de la cual será miembro. "EL PROMITENTE FIDEICOMISARIO" acepta y se obliga a que una vez reciba el derecho de uso y goce de "EL LOTE", respetará y acatará todas y cada una de las disposiciones que contenga el reglamento de uso y mantenimiento, reglamento de sana convivencia y reglamento arquitectónico establecidos por la Asociación de Colonos, así como las disposiciones legales o reglamentarias que tengan o llegaran a tener relación con "EL LOTE", incluyéndose de manera enunciativa más no limitativa, reglamentos de construcción municipal y/o estatal, y sus correspondientes usos de suelo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('SIX. "THE PROMISSORY TRUSTEE" agrees to join the Residents Association as from when it begins to use and enjoy "THE LOT". "THE PROMISSORY TRUSTEE" agrees and undertakes that once it has receives the right to use and enjoy "THE LOT", it shall respect and observe all provisions of the use and maintenance regulations, community regulations and the architectural regulations established by the Residents Association, plus all legal or regulatory provisions that are or may be related to "THE LOT", including, but not limited to, local and/or state building regulations and their corresponding land use. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=90);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" acepta que cederá su voto a "EL PROMITENTE FIDEICOMITENTE" en las asambleas de la Asociación de Colonos, hasta el momento en que haya realizado el pago total del precio pactado por "EL LOTE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" agrees that it shall assign its vote to "THE PROMISSORY TRUSTOR" at meetings of the Residents Association until the price agreed for "THE LOT" has been paid in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=36);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('SEPTIMA. - "EL PROMITENTE FIDEICOMISARIO", no podrá ceder, vender o traspasar los derechos derivados del presente contrato sin el consentimiento previo por escrito de "EL PROMITENTE FIDEICOMITENTE", y en todo caso, las partes acuerdan desde ahora que, en caso de cualquier tipo de cesión, venta o traspaso, "EL PROMITENTE FIDEICOMISARIO" se obliga a pagar el 2.5% del valor de "EL LOTE" a "EL PROMITENTE FIDEICOMITENTE", por concepto de gastos administrativos por la autorización de la cesión de derechos.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('SEVEN. "THE PROMISSORY TRUSTEE" may not assign, sell or transfer its rights hereunder without the prior consent of "THE PROMISSORY TRUSTOR" in writing and, in any case, the parties agree that if there is any type of assignment, sale or transfer hereafter, "THE PROMISSORY TRUSTEE" undertakes to pay "THE PROMISSORY TRUSTOR" 2.5% of the value of "THE LOT" to cover administrative expenses for authorizing assignment of rights. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=66);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('OCTAVA - Las partes acuerdan y se obligan mediante el presente pacto comisorio a dar por terminado el presente contrato, sin necesidad de declaración judicial previa y sin responsabilidad alguna para "EL PROMITENTE FIDEICOMITENTE", como consecuencia de las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('EIGHT. The parties agree that the Agreement may be terminated, without the need for a court order and with no liability for "THE PROMISSORY TRUSTOR", under any of the following circumstances:'),0,'J',0);
    $pdf->Ln();

    //Page 7
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Si "EL PROMITENTE FIDEICOMISARIO" deja de pagar dos o más pagos consecutivos del precio convenido por "EL LOTE" objeto de contrato'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If "THE PROMISSORY TRUSTEE" fails to make two or more consecutive payments of the price agreed for "THE LOT" subject matter hereof.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Si "EL PROMITENTE FIDEICOMISARIO" vende, cede, traspasa o de alguna manera enajena o grava, sin la autorización de "EL PROMITENTE FIDEICOMITENTE", los derechos derivados del presente contrato. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If "THE PROMISSORY TRUSTEE" sells, assigns, transfers or in any other manner encumbers or disposes of its rights hereunder, without the authorization of "THE PROMISSORY TRUSTOR".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('En caso de terminación del presente contrato por las causas de los incisos a) y b) aludidas en la presente cláusula, las partes acuerdan en concepto de indemnización, el pago del equivalente al 15% (quince por ciento) del precio total de "EL LOTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('If the Agreement is terminated under the circumstances stipulated in paragraphs a) and b) above, the parties agree that a sum of 15% of the total price of “THE LOT” shall be payable as indemnity.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" autoriza que el pago indemnizatorio mencionado, sea retenido por "EL PROMITENTE FIDEICOMITENTE" de las cantidades que haya cubierto como parte del pago del precio de "EL LOTE" o bien del depósito en garantía entregado, y en su caso, una vez notificado, devolverá el saldo resultante a "EL PROMITENTE FIDEICOMISARIO" en un plazo máximo de 20 días hábiles posteriores a la notificación de terminación de contrato. Quedando obligado "EL PROMITENTE FIDEICOMISARIO" a entregar de inmediato "EL LOTE" a "EL PROMITENTE FIDEICOMITENTE" con las construcciones y mejoras que hubiere efectuado y sin derecho a indemnización alguna.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" authorizes "THE PROMISSORY TRUSTOR" to withhold the indemnity payment referred to above from sums paid as part of the price of "THE LOT" or the security deposit provided and, once notified, it shall return the resulting balance to "THE PROMISSORY TRUSTEE" within twenty business days as from when termination of the Agreement has been notified, in which case, "THE PROMISSORY TRUSTEE" shall undertake to immediately return possession of "THE LOT" to "THE PROMISSORY TRUSTOR", with any buildings upon it and improvements made to it, without being entitled to any indemnity.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=84);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Adicional a lo anterior, se establece como causal de rescisión imputable a "EL PROMITENTE FIDEICOMITENTE" si cae en las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Furthermore, the Agreement may be rescinded if "THE PROMISSORY TRUSTOR":'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que "EL PROMITENTE FIDEICOMITENTE" se negare a otorgar la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio en el plazo máximo convenido.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Refuses to grant the public document for the sale of "THE LOT" within the time agreed.'),0,'J',0);
    $pdf->Ln();

    //Page 8
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('La falta de entrega oportuna del uso y goce de "EL LOTE" en los términos y plazos contenidos en el presente contrato;'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Fails to hand over the use and enjoyment of "THE LOT" under the terms and in the time specified herein. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" podrá optar por exigir el cumplimiento forzoso del contrato prometido o bien la devolución de las cantidades abonadas y el pago de una pena convencional sustitutiva de daños y perjuicios a su favor, equivalente a la cantidad que resulte de obtener el interés promedio conforme a la tasa de interés interbancaria que fije el Banco de México en el mes inmediato anterior al incumplimiento, sobre las cantidades efectivamente pagadas y desde la fecha en que se realicen y hasta su devolución, por concepto de indemnización.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Should this be the case, "THE PROMISSORY TRUSTEE" may either demand obligatory performance of the Agreement or demand the reimbursement of the amounts paid, and the payment of a conventional penalty to cover any damage and losses that may be caused to it, charged at the average interest rate arrived at by multiplying the inter-bank interest rate set by the Banco de Mexico for the month prior to the default, by sums actually paid, as from when said payments are made until they are actually refunded, for indemnity. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=64);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('NOVENA- Las partes establecen que para que sea válida cualquier modificación, en todo o en parte, de lo acordado en este contrato, éste deberá ser firmada por las partes por escrito. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('NINE. The parties establish that any amendments to all or part of the Agreement must be in writing and signed by the parties, so that they are valid.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('DÉCIMA. - Para los efectos de lo pactado en el presente contrato, las partes señalan como sus domicilios para recibir toda clase de notificaciones y comunicaciones que se cursen entre sí:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TEN. - For the purpose hereof, the parties state that their addresses for receiving all types of notices and correspondence between them are as follows:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMITENTE": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550. Correo electrónico: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTOR": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550 E-mail address: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.direccion FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $direccion ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $direccion.=$col[0];
                $aux++;
            }else{
                $direccion.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,6,utf8_decode('"EL PROMITENTE COMPRADOR": '.$direccion),0,'J',0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('"THE PROMISSORY TRUSTEE": '.$direccion),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.correo FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $correo ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $correo.=$col[0];
                $aux++;
            }else{
                $correo.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,6,utf8_decode('Correo electrónico: '.$correo),0,'J',0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('E-mail address: '.$correo),0,'J',0);
    $pdf->Ln();

    //Page 8
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('DÉCIMA PRIMERA. - Para todo lo relativo a la interpretación y cumplimiento del presente contrato serán aplicables las leyes y tribunales competentes de la ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo. Ambas partes renuncian al fuero que por su domicilio presente o futuro pudiera resultar competente. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('ELEVEN.- For all matters concerning construal and performance of the Agreement, the parties shall submit themselves to the laws and competent courts of Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, and waive any jurisdiction that may correspond to them on account of their current or future domicile. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=44);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('LEÍDO Y ENTENDIDO QUE FUE EL PRESENTE CONTRATO, LO FIRMAN DE CONFORMIDAD, POR TRIPLICADO, AL MARGEN Y AL CALCE EN PLAYA DEL CARMEN. MUNICIPIO DE SOLIDARIDAD, QUINTANA ROO, MÉXICO A LOS 22 DIAS DEL MES DE OCTUBRE. ENTREGANDO A CADA PARTE UN DOCUMENTO ORIGINAL CON FIRMA AUTOGRAFA DEL MISMO Y SUS ANEXOS.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('HAVING READ AND UNDERSTOOD THE AGREEMENT, THE PARTIES SIGN IT IN TRIPLICATE, IN THE MARGIN AND AT THE FOOT, IN PLAYA DEL CARMEN, MUNICIPALITY OF SOLIDARIDAD, QUINTANA ROO, MEXICO, ON THE XXXXXX DAY OF XXXXXX, EACH PARTY RETAINING AN ORIGINAL COPY, WHICH BEAR THEIR ORIGINAL SIGNATURE, AND THE EXHIBITS THERETO.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=74);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________ '),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE VENDEDOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE  COMPRADOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE"'),0,'C',0);
    $pdf->Ln();
    
    //Anexo A
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,6,'ANEXO A',0,'J');
    $pdf->Ln();

    //Anexo B
    $pdf->AddPage();
    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO B',0,'J');
    $pdf->Ln();
    
    $sql="SELECT mensualidades, monto_mensual, mensualidades_enganche, cant_mensual_enganche, fecha_enganche, dia_pago from contrato where id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $mensualidades = $col['mensualidades'];
        $monto_mensual = $col['monto_mensual'];
        $mensualidades_enganche = $col['mensualidades_enganche'];
        $cant_mensual_enganche = $col['cant_mensual_enganche'];
        $fecha_enganche = $col['fecha_enganche'];
        $dia_pago = $col['dia_pago'];

        $pdf->SetY($Y_Table_Position+=10);
        $pdf->SetX($X_Table_Position);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10,8,"#",1,0,'C',1);
        $pdf->Cell(50,8,"Mensualidades",1,0,'C',1);
        $pdf->Cell(50,8,"Fecha",1,0,'C',1);
        $pdf->Cell(70,8,"Monto USD",1,0,'C',1);
        $pdf->Ln();
        if($mensualidades_enganche=="0"){
            $pdf->SetY($Y_Table_Position+=8);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(10,8,"1",1,0,'C',0);
            $pdf->Cell(50,8,"Enganche",1,0,'C',0);
            $pdf->Cell(50,8,utf8_decode(date("d/m/Y", strtotime($fecha_enganche))),1,0,'C',0);
            $pdf->Cell(70,8,utf8_decode($cant_mensual_enganche),1,0,'C',0);
            $pdf->Ln();
        }else{
            for($i = 1; $i <= $mensualidades_enganche; $i++){
                $pdf->SetY($Y_Table_Position+=8);
                $pdf->SetX($X_Table_Position);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(10,8,utf8_decode($i),1,0,'C',0);
                $pdf->Cell(50,8,"Enganche",1,0,'C',0);
                $fecha_inicio = date("d/m/Y", strtotime($fecha_enganche."+ ".$i." month"));
                $pdf->Cell(50,8,utf8_decode($fecha_inicio),1,0,'C',0);
                $pdf->Cell(70,8,utf8_decode($cant_mensual_enganche),1,0,'C',0);
                $pdf->Ln();
                
            }//fin del for
        }//fin del else

        $pdf->SetY($Y_Table_Position+=20);
        $pdf->SetX($X_Table_Position);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10,8,"#",1,0,'C',1);
        $pdf->Cell(40,8,"Fecha",1,0,'C',1);
        $pdf->Cell(65,8,"Balance Inicial",1,0,'C',1);
        $pdf->Cell(65,8,"Monto USD",1,0,'C',1);
        $pdf->Ln();
        if($mensualidades=="0"){
            $pdf->SetY($Y_Table_Position+=8);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(10,8,"1",1,0,'C',0);
            $pdf->Cell(40,8,utf8_decode(date("d/m/Y", strtotime($dia_pago))),1,0,'C',0);
            $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
            $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
            $pdf->Ln();
        }else{
            switch($mensualidades_enganche){
                case "6":
                    $primera_hoja = 16;
                break;
                case "5":
                    $primera_hoja = 18;
                break;
                case "4":
                    $primera_hoja = 20;
                break;
                case "3":
                    $primera_hoja = 22;
                break;
                case "2":
                    $primera_hoja = 23;
                break;
                case "1":
                    $primera_hoja = 24;
                break;
            }//fin del switch
            $aux=0;
            $filas=0;
            for($i = 1; $i <= $mensualidades; $i++){
                if($i==($primera_hoja+1)){
                    $pdf->AddPage();
                    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
                    $pdf->SetY($Y_Table_Position=18);
                    $pdf->SetX($X_Table_Position=15);
                    $pdf->SetY($Y_Table_Position);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Image('assets/img/Amares.png',155,15,40,15);
                    $pdf->Ln();
                    $pdf->SetY($Y_Table_Position+=20);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Ln();
                    $aux=0;
                    $filas=0;
                }//fin del if
                if($filas==28){
                    $aux=1;
                }//fin del if
                if($aux==1){
                    $pdf->AddPage();
                    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
                    $pdf->SetY($Y_Table_Position=18);
                    $pdf->SetX($X_Table_Position=15);
                    $pdf->SetY($Y_Table_Position);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Image('assets/img/Amares.png',155,15,40,15);
                    $pdf->Ln();
                    $pdf->SetY($Y_Table_Position+=20);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Ln();
                    $aux=0;
                    $filas=0;
                }//fin del if
                $pdf->SetY($Y_Table_Position+=8);
                $pdf->SetX($X_Table_Position);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(10,8,utf8_decode($i),1,0,'C',0);
                $fecha_aux = date("d/m/Y", strtotime($dia_pago."+ ".$i." month"));
                $pdf->Cell(40,8,utf8_decode($fecha_aux),1,0,'C',0);
                $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
                $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
                $pdf->Ln();
                $filas++;
            }//fin del for
        }//fin del else
    }//fin del if

    //Anexo C
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO C',0,'J');
    $pdf->Ln();

    $pdf->Output();

}

function contrato_financiado_extranjero($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche, $fecha_entrega, $deposito_garantia){
    $Y_Table_Position=18;
    $X_Table_Position=15;
    
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $clientes = "";
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $clientes.=$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
                $aux=1;
            }else{
                $clientes.=", ".$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->MultiCell(85,5,utf8_decode('CONTRATO DE PROMESA DE AFECTACION FIDUCIARIA CON FINANCIAMIENTO QUE CELEBRAN, POR UNA PARTE, LA SOCIEDAD DENOMINADA FOUR CARDINALS DEVELOPMENTS MÉXICO S.A. DE C.V. REPRESENTADA EN ESTE ACTO POR EL SR. ISAAC HENARES DUCLOS, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE FIDEICOMITENTE" Y POR OTRA PARTE EL SR. '.strtoupper($clientes).', A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE FIDEICOMISARIO", DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('PROMISE TO CREATE A TRUST ENTERED INTO BY ONE PART AS THE PROMISSORY TRUSTOR FOUR CARDINALS DEVELOPMENTS MEXICO S.A. DE C.V., REPRESENTED HEREIN BY ISAAC HENARES DUCLOS, AND BY THE OTHER PART AS PROMISSORY TRUSTEE '.strtoupper($clientes).', BY HIS OWN RIGHT, IN ACCORDANCE WITH THE FOLLOWING RECITALS AND CLAUSES: '),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=75);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('DECLARACIONES'),0,'C',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('RECITALS'),0,'C',0);
    $pdf->Ln();
    //I
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('I. "EL PROMITENTE FIDEICOMITENTE", declara por conducto de su representante legal: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('I. "THE PROMISSORY TRUSTOR" declares, through its legal representative, that:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que es una sociedad mercantil legalmente constituida de acuerdo con las leyes mexicanas mediante Escritura Pública número 5,092 de fecha 11 de junio del año 2021, pasada ante la fe del Lic. Ramon Rolando Heredia Ruiz, Notario Público No. 83 de la Ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo e inscrita bajo el folio mercantil número N-2021069757 del Registro Público de la Propiedad y el Comercio de la ciudad de Playa del Carmen.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It is a corporation legally incorporated according to the laws of Mexico, as formalized in public document number 5,092 dated June 11, 2021, granted before Ramon Rolando Heredia Ruiz, Notary Public Number 83 for Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, entered in the Public Registry of Property and Commerce of Playa del Carmen under commercial folio number N-2021069757'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=80);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que su representada, comercializa el desarrollo Inmobiliario denominado "AMARES", localizado en Predio El Martillo, carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo. '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It markets the real estate development known as "AMARES", located at Predio El Martillo, Carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo. '),0,'J',0);
    $pdf->Ln();
    
    //Page 2
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('El cual estará compuesto por lotes unifamiliares, multifamiliares, acceso controlado, áreas verdes, vialidades y áreas de amenidades de uso común para los Propietarios del mencionado desarrollo, en lo sucesivo "EL INMUEBLE".'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('That shall be made up of single-family and multi-family tourist residences, with controlled access, green areas, roadways and common facilities for the use of the residents of said development, hereinafter "THE REAL ESTATE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=45);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", con una superficie de ".$row['m2']."m2";
        $lote2 = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", whith an area of ".$row['m2'];
    }//fin del if
    $pdf->MultiCell(80,5,utf8_decode('Que sobre "EL INMUEBLE" referido en la declaración b), se han realizado las subdivisiones pertinentes, a través de las cuales se han obtenido las manzanas de las que resulta el lote individual, objeto del presente contrato en adelante "EL LOTE", identificado como '.$lote.', y cuyas características y descripción quedan establecidas en el Anexo A.'),0,'J',0);
    $pdf->Ln();
    $pdf->MultiCell(80,6,utf8_decode(''),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('"THE REAL ESTATE" referred to in Recital b) above has been sub-divided into blocks in which the individual lot subject matter hereof is located, hereinafter "THE LOT", identified as '.$lote2.' whose features and description are specified in EXHIBIT A.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=58);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que es voluntad de su representada celebrar el presente contrato de promesa de afectación fiduciaria y obligarse en los términos establecidos en este contrato.'),0,'J',0);
    $pdf->Ln();
    $pdf->MultiCell(80,6,utf8_decode(''),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It wishes to enter into the Promise of Create a Trust and to bind itself under the terms established herein.'),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('II. "EL PROMITENTE FIDEICOMISARIO", declara bajo protesta de decir verdad: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('II. "THE PROMISSORY TRUSTEE" declares that:'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que cuenta con la capacidad jurídica y económica suficiente para obligarse y cumplir en los términos del presente contrato.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It has the legal capacity and financial means to bind itself under and comply with the terms hereof. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'];
    }//fin del if
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que conoce la situación jurídica de "EL LOTE", identificado como '.$lote.', y está conforme con las características y descripción de éste, tal y como consta en el ANEXO A del presente contrato.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It is acquainted with the legal situation of "THE LOT", identified as '.$lote.', and agrees with its features and description, as specified in EXHIBIT A hereto.'),0,'J',0);
    $pdf->Ln();

    //Page 3
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que es su libre voluntad firmar el presente contrato de promesa de afectación fiduciaria y manifiesta que en su momento el pago del precio de "EL LOTE" lo realiza con recursos de procedencia lícita. '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It freely wishes to enter into the Promise of Create a Trust and that the funds it shall use to pay the price of "THE LOT" are from a lawful source. '),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('III. AMBAS PARTES DECLARAN:'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('III. BOTH PARTIES DECLARE THAT:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Se reconocen mutuamente la capacidad y personalidad jurídica para celebrar el presente contrato y lo suscriben por su propia y libre voluntad.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Each recognizes the legal capacity of the other to enter into the Agreement and that they sign it of their own free will.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Estipulan y reconocen que los anexos de este contrato son parte integrante del mismo, por lo que deberán interpretarse, ejecutarse y concluirse de acuerdo con la información contenida en cada uno de ellos.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('They stipulate and acknowledge that the exhibits hereto are an integral part hereof, so they must be construed, perform and concluded according to the information contained in each.  '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Ambas partes se comprometen y obligan al tenor de las siguientes: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('They agree to be bound by the following clauses:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('CLAUSULAS'),0,'C',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('CLAUSES'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position-=95);
    $sql="SELECT c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote where c.id_contrato like '".$id_contrato."' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $valor_lote = $col[0];
    }else{
        $valor_lote=0;
    }//fin del else
    $formatter = new NumeroALetras();
    $valor_letras = $formatter->toMoney($valor_lote, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(85,5,utf8_decode('PRIMERA. - El Objeto del presente contrato es la promesa de "EL PROMITENTE VENDEDOR" de vender y transferir la propiedad de "EL LOTE" debidamente identificado en el ANEXO A del presente instrumento a "EL PROMITENTE COMPRADOR", quien promete adquirir el inmueble por la cantidad total de '.$valor_lote.' ('.$valor_letras.')'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('ONE. The purpose of the Agreement is the promise of "THE PROMISSORY TRUSTOR" to execute a Final Trust Agreement with Irrevocable Transfer of Ownership with respect to "THE LOT" specified in EXHIBIT A hereto to "THE PROMISSORY TRUSTEE", who promises to acquire trustee rights for the total sum of US $'.$valor_lote),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=50);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('SEGUNDA. El precio pactado por "EL LOTE" será pagado por "EL PROMITENTE COMPRADOR", en los términos del presente contrato, de la siguiente manera:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TWO. "THE PROMISSORY TRUSTEE" shall pay the price agreed for "THE LOT" under the terms hereof, as follows:'),0,'J',0);
    $pdf->Ln();

    //Page 4
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(85,6,$porcentaje_enganche.'% de enganche a la firma del presente contrato de promesa de compraventa.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(85,6,$porcentaje_enganche.'% as down-payment upon signing the Agreement, deferred in 9 monthly payments.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Los siguientes pagos se realizarán conforme a la tabla de pagos que se acompaña al presente contrato como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Subsequent payments shall be made as per the payment schedule attached hereto as EXHIBIT B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('En caso de que "EL PROMITENTE COMPRADOR" incumpla con uno o más de los pagos correspondientes por "EL LOTE" de acuerdo con el ANEXO B, la 3 totalidad del adeudo que en ese Anexo se señala se hará exigible; y pagará además a "EL PROMITENTE VENDEDOR" un interés moratorio adicional del 2% (dos por ciento) mensual, sobre todas las cantidades vencidas, desde el día del vencimiento, hasta la fecha del pago mismo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If the "THE PROMISSORY TRUSTEE" fails to make one or more of the payments for the "THE LOT" as per EXHIBIT B, the total amount specified in EXHIBIT B shall become due demandable. "THE PROMISSORY TRUSTEE" shall also pay "THE PROMISSORY TRUSTOR" additional default interest at a rate of 2% (two percent) a month on all sums due and payable, as from the due date up until payment is made in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=60);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO", para garantizar el pago por el valor de "EL LOTE", firmará de su puño y letra al momento en que este le sea entregado, los pagarés que se mencionan en la tabla de pagos identificada como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('In order to guarantee payment of the value of "THE LOT", "THE PROMISSORY TRUSTEE" shall sign the promissory notes referred to in the payment schedule in EXHIBIT B, when it receives possession of "THE LOT".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('TERCERA. - A fin de garantizar el cumplimiento de las obligaciones derivadas del presente Contrato "EL PROMITENTE FIDEICOMISARIO" se obliga a entregar a "EL PROMITENTE FIDEICOMITENTE" en depósito en garantía, la cantidad equivalente al '.$deposito_garantia.'% del precio total señalado en la Cláusula Primera del presente Contrato. Dicho depósito será devuelto por "EL PROMITENTE FIDEICOMITENTE" una vez que "EL PROMITENTE FIDEICOMISARIO" cumpla con los pagos establecidos en la Cláusula Segunda del presente Contrato, el cual será depositado en la cuenta bancaria que señale "EL PROMITENTE FIDEICOMISARIO" para tales efectos.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('THREE. In order to guarantee performance of its obligations hereunder, "THE PROMISSORY TRUSTEE" undertakes to deposit a sum equivalent to '.$deposito_garantia.'% of the total price specified in Clause One hereof, as security deposit. "THE PROMISSORY TRUSTOR" shall return said deposit once "THE PROMISSORY TRUSTEE" has met its payment obligations established in Clause Two hereof, which shall be deposited in the bank account that "THE PROMISSORY TRUSTEE" nominates for said purpose.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=76);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('No obstante, lo anterior "EL PROMITENTE FIDEICOMISARIO", podrá solicitar a "EL PROMITENTE FIDEICOMITENTE" a través de cualquier medio que sea establecido por ambas partes de común acuerdo que el depósito en garantía entregado sea aplicado contra los '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Notwithstanding the foregoing, "THE PROMISSORY TRUSTEE" may ask "THE PROMISSORY TRUSTOR", over any medium that both parties establish mutually, that the security deposit provided is used to cover any outstanding payments that "THE PROMISSORY'),0,'J',0);
    $pdf->Ln();

    //Page 5
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('pagos pendientes que tenga que realizar el "EL PROMITENTE FIDEICOMISARIO", por lo que en dicho caso "EL PROMITENTE FIDEICOMITENTE" no tendrá la obligación de devolver el referido deposito en garantía. Para tales efectos, el depósito en garantía únicamente podrá ser aplicado contra el pago del último 20% del valor de venta de "EL LOTE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TRUSTEE" has to make, in which case "THE PROMISSORY TRUSTOR" shall not be required to return the security deposit to "THE PROMISSORY TRUSTEE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=44);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('CUARTA. - "EL PROMITENTE FIDEICOMITENTE" trasmitirá ad-corpus "EL LOTE", a favor de "EL PROMITENTE FIDEICOMISARIO", mediante la celebración y firma de la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('FOUR. "THE PROMISSORY TRUSTOR" shall transfer "THE LOT" ad-corpus to "THE PROMISSORY TRUSTEE" by signing a public document that formalizes the Final Trust Agreement with Irrevocable Transfer of Ownership.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=32);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Para poder proceder a la firma de la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio "EL PROMITENTE FIDEICOMISARIO" deberá acreditar haber realizado todos los pagos que se mencionan en el ANEXO B. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('So that the public document of sale may be signed, "THE PROMISSORY TRUSTEE" must prove that it has made all payments referred to in EXHIBIT B. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Asimismo, "EL PROMITENTE FIDEICOMISARIO" deberá acreditar haber realizado el pago de los derechos y gastos notariales correspondientes. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" must also prove that it has paid all notary costs and expenses. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Ambas partes establecen que hasta en tanto no se firme la escritura pública correspondiente, "EL PROMITENTE FIDEICOMITENTE" conservará el dominio pleno sobre el lote. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Both parties establish that "THE PROMISSORY TRUSTOR" shall retain full ownership of the lot until the public document has been signed.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('QUINTA. - "EL PROMITENTE FIDEICOMITENTE" se obliga a firmar la escritura pública correspondiente en un plazo no mayor a tres meses posteriores a la fecha en la cual "EL PROMITENTE FIDEICOMISARIO" demuestre haber dado cumplimiento a la cláusula que antecede, la cual ha de celebrarse con el notario público estipulado por "EL PROMITENTE FIDEICOMITENTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('FIVE. "THE PROMISSORY TRUSTOR" undertakes to sign the public document within three months of the date on which "THE PROMISSORY TRUSTEE" proves that it has complied with the provisions of the preceding clause, which must be granted before a notary public nominated by the "THE PROMISSORY TRUSTOR". For this purpose, the security deposit may only be used to cover payment of the last 20% of the sale value of "THE LOT".'),0,'J',0);
    $pdf->Ln();

    //Page 6
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $aux_dia = date("d", strtotime($fecha_entrega));
    $aux_mes = date("m", strtotime($fecha_entrega));
    $aux_anio = date("Y", strtotime($fecha_entrega));
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('SEXTA. - Ambas partes establecen que la entrega de "EL LOTE" deberá llevarse a cabo el día '.$aux_dia.' de '.$aux_mes.' de '.$aux_anio.', con un plazo adicional de 6 meses, fecha en la cual "EL LOTE" contará con el acceso, y servicios de luz, agua y drenaje a pie de lote.'),0,'J',0);
    $pdf->Ln();

    $aux = date("d/m/Y", strtotime($fecha_entrega));
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('SIX. Both parties established that possession of "THE LOT" shall be handed over on '.$aux.', with an additional period of six months in which "THE LOT" shall be connected to electricity, water and drainage utilities.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" únicamente podrá hacer uso y tener el goce de "EL LOTE" siempre y cuando cumpla con las disposiciones federales, estatales y municipales, atendiendo íntegramente a lo ordenado en el Reglamento de construcción del proyecto AMARES, mismo que forma parte del ANEXO C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" may only use and enjoy "THE LOT" provided that it meets all federal, state and local laws, in particular, the provisions of the building regulations of the AMARES project, attached hereto as EXHIBIT C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('A tales efectos "EL PROMITENTE FIDEICOMISARIO" deberá presentar para aprobación de "EL PROMITENTE FIDEICOMITENTE", a través del comité de arquitectura de la Asociación de Colonos, el proyecto de construcción que pretender edificar en "EL LOTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('To this end, "THE PROMISSORY TRUSTEE" must submit its project for the building that it intends to build on "THE LOT" to the architectural committee of the Residents Association, so that "THE PROMISSORY TRUSTOR" may approve it.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('A partir de la fecha de entrega de "EL LOTE" "EL PROMITENTE FIDEICOMISARIO" asume la obligación de realizar el pago de cuotas de mantenimiento de la Asociación de Colonos, impuesto predial, derechos por uso de agua y energía eléctrica individual y comunal.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('As from when possession of "THE LOT" is handed over, "THE PROMISSORY TRUSTEE" assumes the obligation to pay the maintenance fees established by the Residents Association, plus property tax and water and electricity bills for "THE LOT" and for common areas.  '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('SEPTIMA - "EL PROMITENTE FIDEICOMISARIO", desde el momento de recibir el uso y goce de "EL LOTE", acepta entrar a formar parte de la Asociación de Colonos, de la cual será miembro. "EL PROMITENTE FIDEICOMISARIO" acepta y se obliga a que una vez reciba el derecho de uso y goce de "EL LOTE", respetará y acatará todas y cada una de las disposiciones que contenga el reglamento de uso y mantenimiento, reglamento de sana convivencia y reglamento arquitectónico establecidos por la Asociación de Colonos, así como las disposiciones legales o reglamentarias que tengan o llegaran a tener relación con "EL LOTE", incluyéndose de manera enunciativa más no limitativa, reglamentos de construcción municipal y/o estatal, y sus correspondientes usos de suelo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('SEVEN. "THE PROMISSORY TRUSTEE" agrees to join the Residents Association as from when it begins to use and enjoy "THE LOT". "THE PROMISSORY TRUSTEE" agrees and undertakes that once it has receives the right to use and enjoy "THE LOT", it shall respect and observe all provisions of the use and maintenance regulations, community regulations and the architectural regulations established by the Residents Association, plus all legal or regulatory provisions that are or may be related to "THE LOT", including, but not limited to, local and/or state building regulations and their corresponding land use. '),0,'J',0);
    $pdf->Ln();

    //Page 7
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" acepta que cederá su voto a "EL PROMITENTE FIDEICOMITENTE" en las asambleas de la Asociación de Colonos, hasta el momento en que haya realizado el pago total del precio pactado por "EL LOTE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" agrees that it shall assign its vote to "THE PROMISSORY TRUSTOR" at meetings of the Residents Association until the price agreed for "THE LOT" has been paid in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=36);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('OCTAVA. - "EL PROMITENTE FIDEICOMISARIO", no podrá ceder, vender o traspasar los derechos derivados del presente contrato sin el consentimiento previo por escrito de "EL PROMITENTE FIDEICOMITENTE", y en todo caso, las partes acuerdan desde ahora que, en caso de cualquier tipo de cesión, venta o traspaso, "EL PROMITENTE FIDEICOMISARIO" se obliga a pagar el 2.5% del valor de "EL LOTE" a "EL PROMITENTE FIDEICOMITENTE", por concepto de gastos administrativos por la autorización de la cesión de derechos.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('EIGHT. "THE PROMISSORY TRUSTEE" may not assign, sell or transfer its rights hereunder without the prior consent of "THE PROMISSORY TRUSTOR" in writing and, in any case, the parties agree that if there is any type of assignment, sale or transfer hereafter, "THE PROMISSORY TRUSTEE" undertakes to pay "THE PROMISSORY TRUSTOR" 2.5% of the value of "THE LOT" to cover administrative expenses for authorizing assignment of rights. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=66);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('NOVENA - Las partes acuerdan y se obligan mediante el presente pacto comisorio a dar por terminado el presente contrato, sin necesidad de declaración judicial previa y sin responsabilidad alguna para "EL PROMITENTE FIDEICOMITENTE", como consecuencia de las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('NINE. The parties agree that the Agreement may be terminated, without the need for a court order and with no liability for "THE PROMISSORY TRUSTOR", under any of the following circumstances:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Si "EL PROMITENTE FIDEICOMISARIO" deja de pagar dos o más pagos consecutivos del precio convenido por "EL LOTE" objeto de contrato'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If "THE PROMISSORY TRUSTEE" fails to make two or more consecutive payments of the price agreed for "THE LOT" subject matter hereof.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Si "EL PROMITENTE FIDEICOMISARIO" vende, cede, traspasa o de alguna manera enajena o grava, sin la autorización de "EL PROMITENTE FIDEICOMITENTE", los derechos derivados del presente contrato. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If "THE PROMISSORY TRUSTEE" sells, assigns, transfers or in any other manner encumbers or disposes of its rights hereunder, without the authorization of "THE PROMISSORY TRUSTOR".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('En caso de terminación del presente contrato por las causas de los incisos a) y b) aludidas en la presente cláusula, las partes acuerdan en concepto de indemnización, el pago del equivalente al 15% (quince por ciento) del precio total de "EL LOTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('If the Agreement is terminated under the circumstances stipulated in paragraphs a) and b) above, the parties agree that a sum of 15% of the total price of “THE LOT” shall be payable as indemnity.'),0,'J',0);
    $pdf->Ln();

    //Page 8
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" autoriza que el pago indemnizatorio mencionado, sea retenido por "EL PROMITENTE FIDEICOMITENTE" de las cantidades que haya cubierto como parte del pago del precio de "EL LOTE" o bien del depósito en garantía entregado, y en su caso, una vez notificado, devolverá el saldo resultante a "EL PROMITENTE FIDEICOMISARIO" en un plazo máximo de 20 días hábiles posteriores a la notificación de terminación de contrato. Quedando obligado "EL PROMITENTE FIDEICOMISARIO" a entregar de inmediato "EL LOTE" a "EL PROMITENTE FIDEICOMITENTE" con las construcciones y mejoras que hubiere efectuado y sin derecho a indemnización alguna.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE" authorizes "THE PROMISSORY TRUSTOR" to withhold the indemnity payment referred to above from sums paid as part of the price of "THE LOT" or the security deposit provided and, once notified, it shall return the resulting balance to "THE PROMISSORY TRUSTEE" within twenty business days as from when termination of the Agreement has been notified, in which case, "THE PROMISSORY TRUSTEE" shall undertake to immediately return possession of "THE LOT" to "THE PROMISSORY TRUSTOR", with any buildings upon it and improvements made to it, without being entitled to any indemnity.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=84);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Adicional a lo anterior, se establece como causal de rescisión imputable a "EL PROMITENTE FIDEICOMITENTE" si cae en las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Furthermore, the Agreement may be rescinded if "THE PROMISSORY TRUSTOR":'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que "EL PROMITENTE FIDEICOMITENTE" se negare a otorgar la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio en el plazo máximo convenido.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Refuses to grant the public document for the sale of "THE LOT" within the time agreed.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('La falta de entrega oportuna del uso y goce de "EL LOTE" en los términos y plazos contenidos en el presente contrato;'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Fails to hand over the use and enjoyment of "THE LOT" under the terms and in the time specified herein. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMISARIO" podrá optar por exigir el cumplimiento forzoso del contrato prometido o bien la devolución de las cantidades abonadas y el pago de una pena convencional sustitutiva de daños y perjuicios a su favor, equivalente a la cantidad que resulte de obtener el interés promedio conforme a la tasa de interés interbancaria que fije el Banco de México en el mes inmediato anterior al incumplimiento, sobre las cantidades efectivamente pagadas y desde la fecha en que se realicen y hasta su devolución, por concepto de indemnización.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Should this be the case, "THE PROMISSORY TRUSTEE" may either demand obligatory performance of the Agreement or demand the reimbursement of the amounts paid, and the payment of a conventional penalty to cover any damage and losses that may be caused to it, charged at the average interest rate arrived at by multiplying the inter-bank interest rate set by the Banco de Mexico for the month prior to the default, by sums actually paid, as from when said payments are made until they are actually refunded, for indemnity. '),0,'J',0);
    $pdf->Ln();

    //Page 9
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('DECIMA - Las partes establecen que para que sea válida cualquier modificación, en todo o en parte, de lo acordado en este contrato, éste deberá ser firmada por las partes por escrito. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TEN. The parties establish that any amendments to all or part of the Agreement must be in writing and signed by the parties, so that they are valid.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('DÉCIMA PRIMERA. - Para los efectos de lo pactado en el presente contrato, las partes señalan como sus domicilios para recibir toda clase de notificaciones y comunicaciones que se cursen entre sí:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('ELEVEN. - For the purpose hereof, the parties state that their addresses for receiving all types of notices and correspondence between them are as follows:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE FIDEICOMITENTE": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550. Correo electrónico: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTOR": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550 E-mail address: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.direccion FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $direccion ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $direccion.=$col[0];
                $aux++;
            }else{
                $direccion.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,6,utf8_decode('"EL PROMITENTE COMPRADOR": '.$direccion),0,'J',0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('"THE PROMISSORY TRUSTEE": '.$direccion),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.correo FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $correo ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $correo.=$col[0];
                $aux++;
            }else{
                $correo.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,6,utf8_decode('Correo electrónico: '.$correo),0,'J',0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('E-mail address: '.$correo),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('DÉCIMA SEGUNDA. - Para todo lo relativo a la interpretación y cumplimiento del presente contrato serán aplicables las leyes y tribunales competentes de la ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo. Ambas partes renuncian al fuero que por su domicilio presente o futuro pudiera resultar competente. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TWELVE.- For all matters concerning construal and performance of the Agreement, the parties shall submit themselves to the laws and competent courts of Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, and waive any jurisdiction that may correspond to them on account of their current or future domicile. '),0,'J',0);
    $pdf->Ln();

    //Page 10
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('LEÍDO Y ENTENDIDO QUE FUE EL PRESENTE CONTRATO, LO FIRMAN DE CONFORMIDAD, POR TRIPLICADO, AL MARGEN Y AL CALCE EN PLAYA DEL CARMEN. MUNICIPIO DE SOLIDARIDAD, QUINTANA ROO, MÉXICO A LOS 22 DIAS DEL MES DE OCTUBRE. ENTREGANDO A CADA PARTE UN DOCUMENTO ORIGINAL CON FIRMA AUTOGRAFA DEL MISMO Y SUS ANEXOS.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('HAVING READ AND UNDERSTOOD THE AGREEMENT, THE PARTIES SIGN IT IN TRIPLICATE, IN THE MARGIN AND AT THE FOOT, IN PLAYA DEL CARMEN, MUNICIPALITY OF SOLIDARIDAD, QUINTANA ROO, MEXICO, ON THE XXXXXX DAY OF XXXXXX, EACH PARTY RETAINING AN ORIGINAL COPY, WHICH BEAR THEIR ORIGINAL SIGNATURE, AND THE EXHIBITS THERETO.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=74);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________ '),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE VENDEDOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE  COMPRADOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY TRUSTEE"'),0,'C',0);
    $pdf->Ln();
    
    //Anexo A
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,6,'ANEXO A',0,'J');
    $pdf->Ln();

    //Anexo B
    $pdf->AddPage();
    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO B',0,'J');
    $pdf->Ln();
    
    $sql="SELECT mensualidades, monto_mensual, mensualidades_enganche, cant_mensual_enganche, fecha_enganche, dia_pago from contrato where id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $mensualidades = $col['mensualidades'];
        $monto_mensual = $col['monto_mensual'];
        $mensualidades_enganche = $col['mensualidades_enganche'];
        $cant_mensual_enganche = $col['cant_mensual_enganche'];
        $fecha_enganche = $col['fecha_enganche'];
        $dia_pago = $col['dia_pago'];

        $pdf->SetY($Y_Table_Position+=10);
        $pdf->SetX($X_Table_Position);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10,8,"#",1,0,'C',1);
        $pdf->Cell(50,8,"Mensualidades",1,0,'C',1);
        $pdf->Cell(50,8,"Fecha",1,0,'C',1);
        $pdf->Cell(70,8,"Monto USD",1,0,'C',1);
        $pdf->Ln();
        if($mensualidades_enganche=="0"){
            $pdf->SetY($Y_Table_Position+=8);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(10,8,"1",1,0,'C',0);
            $pdf->Cell(50,8,"Enganche",1,0,'C',0);
            $pdf->Cell(50,8,utf8_decode(date("d/m/Y", strtotime($fecha_enganche))),1,0,'C',0);
            $pdf->Cell(70,8,utf8_decode($cant_mensual_enganche),1,0,'C',0);
            $pdf->Ln();
        }else{
            for($i = 1; $i <= $mensualidades_enganche; $i++){
                $pdf->SetY($Y_Table_Position+=8);
                $pdf->SetX($X_Table_Position);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(10,8,utf8_decode($i),1,0,'C',0);
                $pdf->Cell(50,8,"Enganche",1,0,'C',0);
                $fecha_inicio = date("d/m/Y", strtotime($fecha_enganche."+ ".$i." month"));
                $pdf->Cell(50,8,utf8_decode($fecha_inicio),1,0,'C',0);
                $pdf->Cell(70,8,utf8_decode($cant_mensual_enganche),1,0,'C',0);
                $pdf->Ln();
                
            }//fin del for
        }//fin del else

        $pdf->SetY($Y_Table_Position+=20);
        $pdf->SetX($X_Table_Position);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10,8,"#",1,0,'C',1);
        $pdf->Cell(40,8,"Fecha",1,0,'C',1);
        $pdf->Cell(65,8,"Balance Inicial",1,0,'C',1);
        $pdf->Cell(65,8,"Monto USD",1,0,'C',1);
        $pdf->Ln();
        if($mensualidades=="0"){
            $pdf->SetY($Y_Table_Position+=8);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(10,8,"1",1,0,'C',0);
            $pdf->Cell(40,8,utf8_decode(date("d/m/Y", strtotime($dia_pago))),1,0,'C',0);
            $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
            $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
            $pdf->Ln();
        }else{
            switch($mensualidades_enganche){
                case "6":
                    $primera_hoja = 16;
                break;
                case "5":
                    $primera_hoja = 18;
                break;
                case "4":
                    $primera_hoja = 20;
                break;
                case "3":
                    $primera_hoja = 22;
                break;
                case "2":
                    $primera_hoja = 23;
                break;
                case "1":
                    $primera_hoja = 24;
                break;
            }//fin del switch
            $aux=0;
            $filas=0;
            for($i = 1; $i <= $mensualidades; $i++){
                if($i==($primera_hoja+1)){
                    $pdf->AddPage();
                    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
                    $pdf->SetY($Y_Table_Position=18);
                    $pdf->SetX($X_Table_Position=15);
                    $pdf->SetY($Y_Table_Position);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Image('assets/img/Amares.png',155,15,40,15);
                    $pdf->Ln();
                    $pdf->SetY($Y_Table_Position+=20);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Ln();
                    $aux=0;
                    $filas=0;
                }//fin del if
                if($filas==28){
                    $aux=1;
                }//fin del if
                if($aux==1){
                    $pdf->AddPage();
                    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
                    $pdf->SetY($Y_Table_Position=18);
                    $pdf->SetX($X_Table_Position=15);
                    $pdf->SetY($Y_Table_Position);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Image('assets/img/Amares.png',155,15,40,15);
                    $pdf->Ln();
                    $pdf->SetY($Y_Table_Position+=20);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Ln();
                    $aux=0;
                    $filas=0;
                }//fin del if
                $pdf->SetY($Y_Table_Position+=8);
                $pdf->SetX($X_Table_Position);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(10,8,utf8_decode($i),1,0,'C',0);
                $fecha_aux = date("d/m/Y", strtotime($dia_pago."+ ".$i." month"));
                $pdf->Cell(40,8,utf8_decode($fecha_aux),1,0,'C',0);
                $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
                $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
                $pdf->Ln();
                $filas++;
            }//fin del for
        }//fin del else
    }//fin del if

    //Anexo C
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO C',0,'J');
    $pdf->Ln();

    $pdf->Output();

}

function contrato_financiado($pdf, $id_contrato, $porcentaje_apartado, $porcentaje_enganche, $fecha_entrega, $deposito_garantia){
    $Y_Table_Position=18;
    $X_Table_Position=15;
    
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $sql="SELECT c.nombre, c.apellido_paterno, c.apellido_materno, co.id_contrato from contrato as co inner join cliente_contrato as cc on co.id_contrato=cc.id_contrato inner join clientes as c on c.id_cliente = cc.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $clientes = "";
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $clientes.=$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
                $aux=1;
            }else{
                $clientes.=", ".$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']."";
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->MultiCell(85,5,utf8_decode('CONTRATO DE PROMESA DE AFECTACION FIDUCIARIA CON FINANCIAMIENTO QUE CELEBRAN, POR UNA PARTE, LA SOCIEDAD DENOMINADA FOUR CARDINALS DEVELOPMENTS MÉXICO S.A. DE C.V. REPRESENTADA EN ESTE ACTO POR EL SR. ISAAC HENARES DUCLOS, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE FIDEICOMITENTE" Y POR OTRA PARTE EL SR. '.strtoupper($clientes).', A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE COMPRADOR", DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('PROMISE TO CREATE A TRUST ENTERED INTO BY ONE PART AS THE PROMISSORY TRUSTOR FOUR CARDINALS DEVELOPMENTS MEXICO S.A. DE C.V., REPRESENTED HEREIN BY ISAAC HENARES DUCLOS, HEREINAFTER THE "PROMISSORY SELLER", ON THE ONE HAND, AND '.strtoupper($clientes).', HEREINAFTER THE "PROMISSORY BUYER", ON THE OTHER, IN ACCORDANCE WITH THE FOLLOWING RECITALS AND CLAUSES:  '),0,'J',0);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=75);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('DECLARACIONES'),0,'C',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('RECITALS'),0,'C',0);
    $pdf->Ln();
    //I
    $pdf->SetY($Y_Table_Position+=10);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('I. "EL PROMITENTE VENDEDOR", declara por conducto de su representante legal: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('I. "THE PROMISSORY SELLER" declares, through its legal representative, that:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que es una sociedad mercantil legalmente constituida de acuerdo con las leyes mexicanas mediante Escritura Pública número 5,092 de fecha 11 de junio del año 2021, pasada ante la fe del Lic. Ramon Rolando Heredia Ruiz, Notario Público No. 83 de la Ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo e inscrita bajo el folio mercantil número N-2021069757 del Registro Público de la Propiedad y el Comercio de la ciudad de Playa del Carmen.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It is a corporation legally incorporated according to the laws of Mexico, as formalized in public document number 5,092 dated June 11, 2021, granted before Ramon Rolando Heredia Ruiz, Notary Public Number 83 for Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, entered in the Public Registry of Property and Commerce of Playa del Carmen under commercial folio number N-2021069757'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=80);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que su representada, comercializa el desarrollo Inmobiliario denominado "AMARES", localizado en Predio El Martillo, carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo. '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It markets the real estate development known as "AMARES", located at Predio El Martillo, Carretera Federal Cancún - Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo. '),0,'J',0);
    $pdf->Ln();
    
    //Page 2
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('El cual estará compuesto por lotes unifamiliares, multifamiliares, acceso controlado, áreas verdes, vialidades y áreas de amenidades de uso común para los Propietarios del mencionado desarrollo, en lo sucesivo "EL INMUEBLE".'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('That shall be made up of single-family and multi-family tourist residences, with controlled access, green areas, roadways and common facilities for the use of the residents of said development, hereinafter "THE REAL ESTATE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=45);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", con una superficie de ".$row['m2']."m2";
        $lote2 = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'].", whith an area of ".$row['m2'];
    }//fin del if
    $pdf->MultiCell(80,5,utf8_decode('Que sobre "EL INMUEBLE" referido en la declaración b), se han realizado las subdivisiones pertinentes, a través de las cuales se han obtenido las manzanas de las que resulta el lote individual, objeto del presente contrato en adelante "EL LOTE", identificado como '.$lote.', y cuyas características y descripción quedan establecidas en el Anexo A.'),0,'J',0);
    $pdf->Ln();
    $pdf->MultiCell(80,6,utf8_decode(''),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('"THE REAL ESTATE" referred to in Recital b) above has been sub-divided into blocks in which the individual lot subject matter hereof is located, hereinafter "THE LOT", identified as '.$lote2.' whose features and description are specified in EXHIBIT A.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=58);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que es voluntad de su representada celebrar el presente contrato de promesa de afectación fiduciaria y obligarse en los términos establecidos en este contrato.'),0,'J',0);
    $pdf->Ln();
    $pdf->MultiCell(80,6,utf8_decode(''),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It wishes to enter into the Promise of Create a Trust and to bind itself under the terms established herein.'),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('II. "EL PROMITENTE COMPRADOR", declara bajo protesta de decir verdad: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('II. "THE PROMISSORY BUYER" declares that:'),0,'J',0);
    $pdf->Ln();
    
    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que cuenta con la capacidad jurídica y económica suficiente para obligarse y cumplir en los términos del presente contrato.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It has the legal capacity and financial means to bind itself under and comply with the terms hereof. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $sql="SELECT l.super_manzana, l.mza, l.lote, l.m2 from contrato as c inner join lotes as l on c.id_lote=l.id_lote where c.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $lote="";
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_array($result);
        $lote = "Supermanzana ".$row['super_manzana']." Manzana ".$row['mza']." Lote ".$row['lote'];
    }//fin del if
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que conoce la situación jurídica de "EL LOTE", identificado como '.$lote.', y está conforme con las características y descripción de éste, tal y como consta en el ANEXO A del presente contrato.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It is acquainted with the legal situation of "THE LOT", identified as '.$lote.', and agrees with its features and description, as specified in EXHIBIT A hereto.'),0,'J',0);
    $pdf->Ln();

    //Page 3
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Que es su libre voluntad firmar el presente contrato de promesa de compraventa y manifiesta que en su momento el pago del precio de "EL LOTE" lo realiza con recursos de procedencia lícita. '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('It freely wishes to enter into the Promise of Sale Agreement and that the funds it shall use to pay the price of "THE LOT" are from a lawful source. '),0,'J',0);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('III. AMBAS PARTES DECLARAN:'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('III. BOTH PARTIES DECLARE THAT:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Se reconocen mutuamente la capacidad y personalidad jurídica para celebrar el presente contrato y lo suscriben por su propia y libre voluntad.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Each recognizes the legal capacity of the other to enter into the Agreement and that they sign it of their own free will.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Estipulan y reconocen que los anexos de este contrato son parte integrante del mismo, por lo que deberán interpretarse, ejecutarse y concluirse de acuerdo con la información contenida en cada uno de ellos.'),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('They stipulate and acknowledge that the exhibits hereto are an integral part hereof, so they must be construed, perform and concluded according to the information contained in each.  '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=38);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('Ambas partes se comprometen y obligan al tenor de las siguientes: '),0,'J',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,6,utf8_decode('They agree to be bound by the following clauses:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(85,6,utf8_decode('CLAUSULAS'),0,'C',0);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('CLAUSES'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=12);
    $pdf->SetX($X_Table_Position-=95);
    $sql="SELECT c.precio_venta from contrato as c inner join lotes as l on c.id_lote = l.id_lote where c.id_contrato like '".$id_contrato."' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $valor_lote = $col[0];
    }else{
        $valor_lote=0;
    }//fin del else
    $formatter = new NumeroALetras();
    $valor_letras = $formatter->toMoney($valor_lote, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(85,5,utf8_decode('PRIMERA. - El Objeto del presente contrato es la promesa de "EL PROMITENTE VENDEDOR" de vender y transferir la propiedad de "EL LOTE" debidamente identificado en el ANEXO A del presente instrumento a "EL PROMITENTE COMPRADOR", quien promete adquirir el inmueble por la cantidad total de '.$valor_lote.' ('.$valor_letras.')'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('ONE. The purpose of the Agreement is the promise of "THE PROMISSORY TRUSTOR" to execute a Final Trust Agreement with Irrevocable Transfer of Ownership with respect to "THE LOT" specified in EXHIBIT A hereto to "THE PROMISSORY TRUSTEE", who promises to acquire trustee rights for the total sum of US $'.$valor_lote),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=50);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('SEGUNDA. El precio pactado por "EL LOTE" será pagado por "EL PROMITENTE COMPRADOR", en los términos del presente contrato, de la siguiente manera:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TWO. "THE PROMISSORY TRUSTEE" shall pay the price agreed for "THE LOT" under the terms hereof, as follows:'),0,'J',0);
    $pdf->Ln();

    //Page 4
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(85,6,$porcentaje_enganche.'% de enganche a la firma del presente contrato de promesa de compraventa.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(85,6,$porcentaje_enganche.'% as down-payment upon signing the Agreement, deferred in 9 monthly payments.',0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=18);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Los siguientes pagos se realizarán conforme a la tabla de pagos que se acompaña al presente contrato como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Subsequent payments shall be made as per the payment schedule attached hereto as EXHIBIT B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('En caso de que "EL PROMITENTE COMPRADOR" incumpla con uno o más de los pagos correspondientes por "EL LOTE" de acuerdo con el ANEXO B, la 3 totalidad del adeudo que en ese Anexo se señala se hará exigible; y pagará además a "EL PROMITENTE VENDEDOR" un interés moratorio adicional del 2% (dos por ciento) mensual, sobre todas las cantidades vencidas, desde el día del vencimiento, hasta la fecha del pago mismo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"c)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If the "THE PROMISSORY TRUSTEE" fails to make one or more of the payments for the "THE LOT" as per EXHIBIT B, the total amount specified in EXHIBIT B shall become due demandable. "THE PROMISSORY TRUSTEE" shall also pay "THE PROMISSORY TRUSTOR" additional default interest at a rate of 2% (two percent) a month on all sums due and payable, as from the due date up until payment is made in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=60);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('"EL PROMITENTE COMPRADOR", para garantizar el pago por el valor de "EL LOTE", firmará de su puño y letra al momento en que este le sea entregado, los pagarés que se mencionan en la tabla de pagos identificada como ANEXO B.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"d)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('In order to guarantee payment of the value of "THE LOT", "THE PROMISSORY BUYER" shall sign the promissory notes referred to in the payment schedule in EXHIBIT B, when it receives possession of "THE LOT".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('TERCERA. - A fin de garantizar el cumplimiento de las obligaciones derivadas del presente Contrato "EL PROMITENTE COMPRADOR" se obliga a entregar a "EL PROMITENTE VENDEDOR" en depósito en garantía, la cantidad equivalente al '.$deposito_garantia.'% del precio total señalado en la Cláusula Primera del presente Contrato. Dicho depósito será devuelto por "EL PROMITENTE VENDEDOR" una vez que "EL PROMITENTE COMPRADOR" cumpla con los pagos establecidos en la Cláusula Segunda del presente Contrato, el cual será depositado en la cuenta bancaria que señale "EL PROMITENTE COMPRADOR" para tales efectos.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('THREE. In order to guarantee performance of its obligations hereunder, "THE PROMISSORY BUYER" undertakes to deposit a sum equivalent to '.$deposito_garantia.'% of the total price specified in Clause One hereof, as security deposit. "THE PROMISSORY SELLER" shall return said deposit once "THE PROMISSORY BUYER" has met its payment obligations established in Clause Two hereof, which shall be deposited in the bank account that "THE PROMISSORY BUYER" nominates for said purpose.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=76);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('No obstante, lo anterior "EL PROMITENTE COMPRADOR", podrá solicitar a "EL PROMITENTE VENDEDOR" a través de cualquier medio que sea establecido por ambas partes de común acuerdo que el depósito en garantía entregado sea aplicado contra los '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Notwithstanding the foregoing, "THE PROMISSORY BUYER" may ask "THE PROMISSORY SELLER", over any medium that both parties establish mutually, that the security deposit provided is used to cover any outstanding payments that "THE PROMISSORY'),0,'J',0);
    $pdf->Ln();

    //Page 5
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('pagos pendientes que tenga que realizar el "EL PROMITENTE FIDEICOMISARIO", por lo que en dicho caso "EL PROMITENTE FIDEICOMITENTE" no tendrá la obligación de devolver el referido deposito en garantía. Para tales efectos, el depósito en garantía únicamente podrá ser aplicado contra el pago del último 20% del valor de venta de "EL LOTE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('BUYER" has to make, in which case "THE PROMISSORY SELLER" shall not be required to return the security deposit to "THE PROMISSORY BUYER".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=44);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('CUARTA. - "EL PROMITENTE VENDEDOR" trasmitirá ad-corpus "EL LOTE", a favor de "EL PROMITENTE COMPRADOR", mediante la celebración y firma de la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('FOUR. "THE PROMISSORY SELLER" shall transfer "THE LOT" ad-corpus to "THE PROMISSORY BUYER" by signing a public document that formalizes the Final Trust Agreement with Irrevocable Transfer of Ownership.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=32);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Para poder proceder a la firma de la escritura pública de compraventa "EL PROMITENTE COMPRADOR" deberá acreditar haber realizado todos los pagos que se mencionan en el ANEXO B. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('So that the public document of sale may be signed, "THE PROMISSORY BUYER" must prove that it has made all payments referred to in EXHIBIT B. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Asimismo, "EL PROMITENTE COMPRADOR" deberá acreditar haber realizado el pago de los derechos y gastos notariales correspondientes. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY BUYER" must also prove that it has paid all notary costs and expenses. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Ambas partes establecen que hasta en tanto no se firme la escritura pública correspondiente, "EL PROMITENTE VENDEDOR" conservará el dominio pleno sobre el lote. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Both parties establish that "THE PROMISSORY SELLER" shall retain full ownership of the lot until the public document has been signed.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('QUINTA. - "EL PROMITENTE VENDEDOR" se obliga a firmar la escritura pública correspondiente en un plazo no mayor a tres meses posteriores a la fecha en la cual "EL PROMITENTE COMPRADOR" demuestre haber dado cumplimiento a la cláusula que antecede, la cual ha de celebrarse con el notario público estipulado por "EL PROMITENTE VENDEDOR". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('FIVE. "THE PROMISSORY SELLER" undertakes to sign the public document within three months of the date on which "THE PROMISSORY BUYER" proves that it has complied with the provisions of the preceding clause, which must be granted before a notary public nominated by the "THE PROMISSORY SELLER". For this purpose, the security deposit may only be used to cover payment of the last 20% of the sale value of "THE LOT".'),0,'J',0);
    $pdf->Ln();

    //Page 6
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $aux_dia = date("d", strtotime($fecha_entrega));
    $aux_mes = date("m", strtotime($fecha_entrega));
    $aux_anio = date("Y", strtotime($fecha_entrega));
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('SEXTA. - Ambas partes establecen que la entrega de "EL LOTE" deberá llevarse a cabo el día '.$aux_dia.' de '.$aux_mes.' de '.$aux_anio.', con un plazo adicional de 6 meses, fecha en la cual "EL LOTE" contará con el acceso, y servicios de luz, agua y drenaje a pie de lote.'),0,'J',0);
    $pdf->Ln();

    $aux = date("d/m/Y", strtotime($fecha_entrega));
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('SIX. Both parties established that possession of "THE LOT" shall be handed over on '.$aux.', with an additional period of six months in which "THE LOT" shall be connected to electricity, water and drainage utilities.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE COMPRADOR" únicamente podrá hacer uso y tener el goce de "EL LOTE" siempre y cuando cumpla con las disposiciones federales, estatales y municipales, atendiendo íntegramente a lo ordenado en el Reglamento de construcción del proyecto AMARES, mismo que forma parte del ANEXO C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY BUYER" may only use and enjoy "THE LOT" provided that it meets all federal, state and local laws, in particular, the provisions of the building regulations of the AMARES project, attached hereto as EXHIBIT C.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('A tales efectos "EL PROMITENTE COMPRADOR" deberá presentar para aprobación de "EL PROMITENTE VENDEDOR", a través del comité de arquitectura de la Asociación de Colonos, el proyecto de construcción que pretender edificar en "EL LOTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('To this end, "THE PROMISSORY BUYER" must submit its project for the building that it intends to build on "THE LOT" to the architectural committee of the Residents Association, so that "THE PROMISSORY SELLER" may approve it.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('A partir de la fecha de entrega de "EL LOTE" "EL PROMITENTE FIDEICOMISARIO" asume la obligación de realizar el pago de cuotas de mantenimiento de la Asociación de Colonos, impuesto predial, derechos por uso de agua y energía eléctrica individual y comunal.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('As from when possession of "THE LOT" is handed over, "THE PROMISSORY TRUSTEE" assumes the obligation to pay the maintenance fees established by the Residents Association, plus property tax and water and electricity bills for "THE LOT" and for common areas.  '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('SEPTIMA - "EL PROMITENTE COMPRADOR", desde el momento de recibir el uso y goce de "EL LOTE", acepta entrar a formar parte de la Asociación de Colonos, de la cual será miembro. "EL PROMITENTE FIDEICOMISARIO" acepta y se obliga a que una vez reciba el derecho de uso y goce de "EL LOTE", respetará y acatará todas y cada una de las disposiciones que contenga el reglamento de uso y mantenimiento, reglamento de sana convivencia y reglamento arquitectónico establecidos por la Asociación de Colonos, así como las disposiciones legales o reglamentarias que tengan o llegaran a tener relación con "EL LOTE", incluyéndose de manera enunciativa más no limitativa, reglamentos de construcción municipal y/o estatal, y sus correspondientes usos de suelo.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('SEVEN. "THE PROMISSORY BUYER" agrees to join the Residents Association as from when it begins to use and enjoy "THE LOT". "THE PROMISSORY TRUSTEE" agrees and undertakes that once it has receives the right to use and enjoy "THE LOT", it shall respect and observe all provisions of the use and maintenance regulations, community regulations and the architectural regulations established by the Residents Association, plus all legal or regulatory provisions that are or may be related to "THE LOT", including, but not limited to, local and/or state building regulations and their corresponding land use. '),0,'J',0);
    $pdf->Ln();

    //Page 7
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE COMPRADOR" acepta que cederá su voto a "EL PROMITENTE FIDEICOMITENTE" en las asambleas de la Asociación de Colonos, hasta el momento en que haya realizado el pago total del precio pactado por "EL LOTE".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY BUYER" agrees that it shall assign its vote to "THE PROMISSORY SELLER" at meetings of the Residents Association until the price agreed for "THE LOT" has been paid in full.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=36);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('OCTAVA. - "EL PROMITENTE COMPRADOR", no podrá ceder, vender o traspasar los derechos derivados del presente contrato sin el consentimiento previo por escrito de "EL PROMITENTE VENDEDOR", y en todo caso, las partes acuerdan desde ahora que, en caso de cualquier tipo de cesión, venta o traspaso, "EL PROMITENTE COMPRADOR" se obliga a pagar el 2.5% del valor de "EL LOTE" a "EL PROMITENTE VENDEDOR", por concepto de gastos administrativos por la autorización de la cesión de derechos.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('EIGHT. "THE PROMISSORY BUYER" may not assign, sell or transfer its rights hereunder without the prior consent of "THE PROMISSORY SELLER" in writing and, in any case, the parties agree that if there is any type of assignment, sale or transfer hereafter, "THE PROMISSORY BUYER" undertakes to pay "THE PROMISSORY SELLER" 2.5% of the value of "THE LOT" to cover administrative expenses for authorizing assignment of rights. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=66);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('NOVENA - Las partes acuerdan y se obligan mediante el presente pacto comisorio a dar por terminado el presente contrato, sin necesidad de declaración judicial previa y sin responsabilidad alguna para "EL PROMITENTE VENDEDOR", como consecuencia de las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('NINE. The parties agree that the Agreement may be terminated, without the need for a court order and with no liability for "THE PROMISSORY SELLER", under any of the following circumstances:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=40);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Si "EL PROMITENTE COMPRADOR" deja de pagar dos o más pagos consecutivos del precio convenido por "EL LOTE" objeto de contrato'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If "THE PROMISSORY BUYER" fails to make two or more consecutive payments of the price agreed for "THE LOT" subject matter hereof.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=24);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Si "EL PROMITENTE COMPRADOR" vende, cede, traspasa o de alguna manera enajena o grava, sin la autorización de "EL PROMITENTE FIDEICOMITENTE", los derechos derivados del presente contrato. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('If "THE PROMISSORY BUYER" sells, assigns, transfers or in any other manner encumbers or disposes of its rights hereunder, without the authorization of "THE PROMISSORY TRUSTOR".'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('En caso de terminación del presente contrato por las causas de los incisos a) y b) aludidas en la presente cláusula, las partes acuerdan en concepto de indemnización, el pago del equivalente al 15% (quince por ciento) del precio total de "EL LOTE". '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('If the Agreement is terminated under the circumstances stipulated in paragraphs a) and b) above, the parties agree that a sum of 15% of the total price of “THE LOT” shall be payable as indemnity.'),0,'J',0);
    $pdf->Ln();

    //Page 8
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE COMPRADOR" autoriza que el pago indemnizatorio mencionado, sea retenido por "EL PROMITENTE VENDEDOR" de las cantidades que haya cubierto como parte del pago del precio de "EL LOTE" o bien del depósito en garantía entregado, y en su caso, una vez notificado, devolverá el saldo resultante a "EL PROMITENTE COMPRADOR" en un plazo máximo de 20 días hábiles posteriores a la notificación de terminación de contrato. Quedando obligado "EL PROMITENTE COMPRADOR" a entregar de inmediato "EL LOTE" a "EL PROMITENTE VENDEDOR" con las construcciones y mejoras que hubiere efectuado y sin derecho a indemnización alguna.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY BUYER" authorizes "THE PROMISSORY SELLER" to withhold the indemnity payment referred to above from sums paid as part of the price of "THE LOT" or the security deposit provided and, once notified, it shall return the resulting balance to "THE PROMISSORY BUYER" within twenty business days as from when termination of the Agreement has been notified, in which case, "THE PROMISSORY BUYER" shall undertake to immediately return possession of "THE LOT" to "THE PROMISSORY SELLER", with any buildings upon it and improvements made to it, without being entitled to any indemnity.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=84);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('Adicional a lo anterior, se establece como causal de rescisión imputable a "EL PROMITENTE VENDEDOR" si cae en las siguientes causales:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Furthermore, the Agreement may be rescinded if "THE PROMISSORY SELLER":'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Que "EL PROMITENTE VENDEDOR" se negare a otorgar la escritura pública de Fideicomiso Irrevocable Traslativo de Dominio en el plazo máximo convenido.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Refuses to grant the public document for the sale of "THE LOT" within the time agreed.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('La falta de entrega oportuna del uso y goce de "EL LOTE" en los términos y plazos contenidos en el presente contrato;'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->Cell(5,6,"b)",0,0,'C');
    $pdf->MultiCell(80,5,utf8_decode('Fails to hand over the use and enjoyment of "THE LOT" under the terms and in the time specified herein. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=22);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE COMPRADOR" podrá optar por exigir el cumplimiento forzoso del contrato prometido o bien la devolución de las cantidades abonadas y el pago de una pena convencional sustitutiva de daños y perjuicios a su favor, equivalente a la cantidad que resulte de obtener el interés promedio conforme a la tasa de interés interbancaria que fije el Banco de México en el mes inmediato anterior al incumplimiento, sobre las cantidades efectivamente pagadas y desde la fecha en que se realicen y hasta su devolución, por concepto de indemnización.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('Should this be the case, "THE PROMISSORY BUYER" may either demand obligatory performance of the Agreement or demand the reimbursement of the amounts paid, and the payment of a conventional penalty to cover any damage and losses that may be caused to it, charged at the average interest rate arrived at by multiplying the inter-bank interest rate set by the Banco de Mexico for the month prior to the default, by sums actually paid, as from when said payments are made until they are actually refunded, for indemnity. '),0,'J',0);
    $pdf->Ln();

    //Page 9
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('DECIMA - Las partes establecen que para que sea válida cualquier modificación, en todo o en parte, de lo acordado en este contrato, éste deberá ser firmada por las partes por escrito. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TEN. The parties establish that any amendments to all or part of the Agreement must be in writing and signed by the parties, so that they are valid.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('DÉCIMA PRIMERA. - Para los efectos de lo pactado en el presente contrato, las partes señalan como sus domicilios para recibir toda clase de notificaciones y comunicaciones que se cursen entre sí:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('ELEVEN. - For the purpose hereof, the parties state that their addresses for receiving all types of notices and correspondence between them are as follows:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=28);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE VENDEDOR": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550. Correo electrónico: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY SELLER": Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550 E-mail address: ihenares@amaresrivieramaya.com'),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.direccion FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $direccion ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $direccion.=$col[0];
                $aux++;
            }else{
                $direccion.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if
    $pdf->SetY($Y_Table_Position+=34);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,6,utf8_decode('"EL PROMITENTE COMPRADOR": '.$direccion),0,'J',0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('"THE PROMISSORY BUYER": '.$direccion),0,'J',0);
    $pdf->Ln();

    $sql="SELECT cl.correo FROM `contrato` as co INNER JOIN cliente_contrato as cc on co.id_contrato = cc.id_contrato INNER join clientes as cl on cc.id_cliente=cl.id_cliente where co.id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num =  mysqli_num_rows($result);
    $correo ="";
    if($num>0){
        $aux = 0;
        while($col=mysqli_fetch_array($result)){
            if($aux==0){
                $correo.=$col[0];
                $aux++;
            }else{
                $correo.=", ".$col[0];
            }//fin del else
        }//fin del while
    }//fin del if

    $pdf->SetY($Y_Table_Position+=26);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,6,utf8_decode('Correo electrónico: '.$correo),0,'J',0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,6,utf8_decode('E-mail address: '.$correo),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('DÉCIMA SEGUNDA. - Para todo lo relativo a la interpretación y cumplimiento del presente contrato serán aplicables las leyes y tribunales competentes de la ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo. Ambas partes renuncian al fuero que por su domicilio presente o futuro pudiera resultar competente. '),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('TWELVE.- For all matters concerning construal and performance of the Agreement, the parties shall submit themselves to the laws and competent courts of Playa del Carmen, Municipality of Solidaridad, State of Quintana Roo, and waive any jurisdiction that may correspond to them on account of their current or future domicile. '),0,'J',0);
    $pdf->Ln();

    //Page 10
    $Y_Table_Position=18;
    $X_Table_Position=15;
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(85,5,utf8_decode('LEÍDO Y ENTENDIDO QUE FUE EL PRESENTE CONTRATO, LO FIRMAN DE CONFORMIDAD, POR TRIPLICADO, AL MARGEN Y AL CALCE EN PLAYA DEL CARMEN. MUNICIPIO DE SOLIDARIDAD, QUINTANA ROO, MÉXICO A LOS 22 DIAS DEL MES DE OCTUBRE. ENTREGANDO A CADA PARTE UN DOCUMENTO ORIGINAL CON FIRMA AUTOGRAFA DEL MISMO Y SUS ANEXOS.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('HAVING READ AND UNDERSTOOD THE AGREEMENT, THE PARTIES SIGN IT IN TRIPLICATE, IN THE MARGIN AND AT THE FOOT, IN PLAYA DEL CARMEN, MUNICIPALITY OF SOLIDARIDAD, QUINTANA ROO, MEXICO, ON THE XXXXXX DAY OF XXXXXX, EACH PARTY RETAINING AN ORIGINAL COPY, WHICH BEAR THEIR ORIGINAL SIGNATURE, AND THE EXHIBITS THERETO.'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=74);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________ '),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE VENDEDOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY SELLER"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('_____________________________________'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position-=95);
    $pdf->MultiCell(85,5,utf8_decode('"EL PROMITENTE  COMPRADOR"'),0,'C',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position+=95);
    $pdf->MultiCell(85,5,utf8_decode('"THE PROMISSORY BUYER"'),0,'C',0);
    $pdf->Ln();
    
    //Anexo A
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,6,'ANEXO A',0,'J');
    $pdf->Ln();

    //Anexo B
    $pdf->AddPage();
    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO B',0,'J');
    $pdf->Ln();
    
    $sql="SELECT mensualidades, monto_mensual, mensualidades_enganche, cant_mensual_enganche, fecha_enganche, dia_pago from contrato where id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $mensualidades = $col['mensualidades'];
        $monto_mensual = $col['monto_mensual'];
        $mensualidades_enganche = $col['mensualidades_enganche'];
        $cant_mensual_enganche = $col['cant_mensual_enganche'];
        $fecha_enganche = $col['fecha_enganche'];
        $dia_pago = $col['dia_pago'];

        $pdf->SetY($Y_Table_Position+=10);
        $pdf->SetX($X_Table_Position);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10,8,"#",1,0,'C',1);
        $pdf->Cell(50,8,"Mensualidades",1,0,'C',1);
        $pdf->Cell(50,8,"Fecha",1,0,'C',1);
        $pdf->Cell(70,8,"Monto USD",1,0,'C',1);
        $pdf->Ln();
        if($mensualidades_enganche=="0"){
            $pdf->SetY($Y_Table_Position+=8);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(10,8,"1",1,0,'C',0);
            $pdf->Cell(50,8,"Enganche",1,0,'C',0);
            $pdf->Cell(50,8,utf8_decode(date("d/m/Y", strtotime($fecha_enganche))),1,0,'C',0);
            $pdf->Cell(70,8,utf8_decode($cant_mensual_enganche),1,0,'C',0);
            $pdf->Ln();
        }else{
            for($i = 1; $i <= $mensualidades_enganche; $i++){
                $pdf->SetY($Y_Table_Position+=8);
                $pdf->SetX($X_Table_Position);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(10,8,utf8_decode($i),1,0,'C',0);
                $pdf->Cell(50,8,"Enganche",1,0,'C',0);
                $fecha_inicio = date("d/m/Y", strtotime($fecha_enganche."+ ".$i." month"));
                $pdf->Cell(50,8,utf8_decode($fecha_inicio),1,0,'C',0);
                $pdf->Cell(70,8,utf8_decode($cant_mensual_enganche),1,0,'C',0);
                $pdf->Ln();
                
            }//fin del for
        }//fin del else

        $pdf->SetY($Y_Table_Position+=20);
        $pdf->SetX($X_Table_Position);
        $pdf->SetFont('Arial','B',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10,8,"#",1,0,'C',1);
        $pdf->Cell(40,8,"Fecha",1,0,'C',1);
        $pdf->Cell(65,8,"Balance Inicial",1,0,'C',1);
        $pdf->Cell(65,8,"Monto USD",1,0,'C',1);
        $pdf->Ln();
        if($mensualidades=="0"){
            $pdf->SetY($Y_Table_Position+=8);
            $pdf->SetX($X_Table_Position);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(10,8,"1",1,0,'C',0);
            $pdf->Cell(40,8,utf8_decode(date("d/m/Y", strtotime($dia_pago))),1,0,'C',0);
            $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
            $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
            $pdf->Ln();
        }else{
            switch($mensualidades_enganche){
                case "6":
                    $primera_hoja = 16;
                break;
                case "5":
                    $primera_hoja = 18;
                break;
                case "4":
                    $primera_hoja = 20;
                break;
                case "3":
                    $primera_hoja = 22;
                break;
                case "2":
                    $primera_hoja = 23;
                break;
                case "1":
                    $primera_hoja = 24;
                break;
            }//fin del switch
            $aux=0;
            $filas=0;
            for($i = 1; $i <= $mensualidades; $i++){
                if($i==($primera_hoja+1)){
                    $pdf->AddPage();
                    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
                    $pdf->SetY($Y_Table_Position=18);
                    $pdf->SetX($X_Table_Position=15);
                    $pdf->SetY($Y_Table_Position);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Image('assets/img/Amares.png',155,15,40,15);
                    $pdf->Ln();
                    $pdf->SetY($Y_Table_Position+=20);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Ln();
                    $aux=0;
                    $filas=0;
                }//fin del if
                if($filas==28){
                    $aux=1;
                }//fin del if
                if($aux==1){
                    $pdf->AddPage();
                    //$pdf->RotatedImage('assets/img/Amares.png',50,70,120,30,0);
                    $pdf->SetY($Y_Table_Position=18);
                    $pdf->SetX($X_Table_Position=15);
                    $pdf->SetY($Y_Table_Position);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Image('assets/img/Amares.png',155,15,40,15);
                    $pdf->Ln();
                    $pdf->SetY($Y_Table_Position+=20);
                    $pdf->SetX($X_Table_Position);
                    $pdf->Ln();
                    $aux=0;
                    $filas=0;
                }//fin del if
                $pdf->SetY($Y_Table_Position+=8);
                $pdf->SetX($X_Table_Position);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(10,8,utf8_decode($i),1,0,'C',0);
                $fecha_aux = date("d/m/Y", strtotime($dia_pago."+ ".$i." month"));
                $pdf->Cell(40,8,utf8_decode($fecha_aux),1,0,'C',0);
                $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
                $pdf->Cell(65,8,utf8_decode($monto_mensual),1,0,'C',0);
                $pdf->Ln();
                $filas++;
            }//fin del for
        }//fin del else
    }//fin del if
    
    //Anexo C
    $pdf->AddPage();
    $pdf->SetY($Y_Table_Position=18);
    $pdf->SetX($X_Table_Position=15);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('assets/img/Amares.png',155,15,40,15);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=20);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(40,6,'ANEXO C',0,'J');
    $pdf->Ln();

    $pdf->Output();

}

function recibo_pago(){
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
    $pdf->MultiCell(180,5,utf8_decode('Fecha: xxxx/xx/xx'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $formatter = new NumeroALetras();
    $valor = 400;
    $valor_letras = $formatter->toMoney($valor, 2, 'DÓLARES', 'CENTAVOS');
    $pdf->MultiCell(180,5,utf8_decode('Cantidad pagada: '.$valor.' '.$valor_letras),0,'J',0);
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
}


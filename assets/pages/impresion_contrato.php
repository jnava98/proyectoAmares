<?php
require('assets/fpdf/fpdf.php');
include "assets/php/conexion.php";
include "assets/php/funciones.php";

$Y_Table_Position=18;
$X_Table_Position=15;

if(empty($_POST["input_impresion_contrato"])){
    $id_contrato="0";
}else{
    $id_contrato=$_POST["input_impresion_contrato"];
}//Fin del else...

$pdf=new FPDF();
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
        while($col=mysqli_fetch_array($result)){
            $clientes.=$col['nombre']." ".$col['apellido_paterno']." ".$col['apellido_materno']." ";
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
    $sql="SELECT l.precio_lista from contrato as c inner join lotes as l on c.id_lote = l.id_lote where c.id_contrato like '".$id_contrato."' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col=mysqli_fetch_array($result);
        $valor_lote = $col[0];
    }else{
        $valor_lote=0;
    }//fin del else
    $pdf->MultiCell(180,5,utf8_decode('PRIMERA. - El Objeto del presente contrato es la promesa de “EL PROMITENTE VENDEDOR” de vender y transferir la propiedad de "EL LOTE" debidamente identificado en el ANEXO A del presente instrumento a "EL PROMITENTE COMPRADOR", quien promete adquirir el inmueble por la cantidad total de '.$valor_lote.' (Valor del lote en letrasTreinta y Dos Mil Ciento Cuarenta y Ocho USD Con Noventa Centavos)'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=30);
    $pdf->SetX($X_Table_Position);
    $pdf->MultiCell(180,5,utf8_decode('SEGUNDA. El precio pactado por "EL LOTE" será pagado por "EL PROMITENTE COMPRADOR", en los términos del presente contrato, de la siguiente manera:'),0,'J',0);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=16);
    $pdf->SetX($X_Table_Position);
    $pdf->Cell(5,6,"a)",0,0,'C');
    $pdf->MultiCell(180,6,'% del Enganche% de enganche a la firma del presente contrato de promesa de compraventa.',0,'J',0);
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
    /*$pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);*/
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


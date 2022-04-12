<?php
require('fpdf/fpdf.php');
include "conexion.php";
include "funciones.php";

$Y_Table_Position=18;
$X_Table_Position=15;

if(empty($_POST["id_contrato"])){
    $id_contrato="0";
}else{
    $id_contrato=$_POST["id_contrato"];
}//Fin del else...

$pdf=new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX($X_Table_Position);
    $pdf->Image('Imagenes/logo_pj.jpg',160,15,35,25);
    $pdf->Ln();
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'CONTRATO DE PROMESA DE COMPRAVENTA QUE CELEBRAN, POR UNA PARTE, LA SOCIEDAD DENOMINADA FOUR CARDINALS DEVELOPMENTS MÉXICO S.A. DE C.V. REPRESENTADA EN ESTE ACTO POR EL SR. ISAAC HENARES DUCLOS, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PROMITENTE VENDEDOR" Y POR OTRA PARTE EL SR./ SRA. '.nombres de los clientes.', A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “EL PROMITENTE COMPRADOR”, DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'DECLARACIONES',1,0,'L',1);
    $pdf->Ln();

    //I
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'I. “EL PROMITENTE VENDEDOR”, declara por conducto de su representante legal:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'a) Que es una sociedad mercantil legalmente constituida de acuerdo con las leyes mexicanas mediante Escritura Pública número 5,092 de fecha 11 de junio del año 2021, pasada ante la fe del Lic. Ramon Rolando Heredia Ruiz, Notario Público No. 83 de la Ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo e inscrita bajo el folio mercantil número 2021002199210014 del Registro Público de la Propiedad y el Comercio de la ciudad de Playa del Carmen.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'b) Que su representada, comercializa el desarrollo Inmobiliario denominado “AMARES”, localizado en Predio El Martillo, carretera Federal Cancún – Chetumal, km 263.5, Municipio de Solidaridad, Quintana Roo, el cual estará compuesto por lotes unifamiliares, multifamiliares, acceso controlado, áreas verdes, vialidades y áreas de amenidades de uso común para los Propietarios del mencionado desarrollo, en lo sucesivo “EL INMUEBLE”.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'c) Que sobre “EL INMUEBLE” referido en la declaración b), se han realizado las subdivisiones pertinentes, a través de las cuales se han obtenido las manzanas de las que resulta el lote individual, objeto del presente contrato en adelante “EL LOTE”, identificado como Supermanzana 4 Manzana 3 Lote 1, con una superficie de 467.88m2, y cuyas características y descripción quedan establecidas en el Anexo A.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'d) Que es voluntad de su representada celebrar el presente contrato de promesa de compraventa y obligarse en los términos establecidos en este contrato.',1,0,'L',1);
    $pdf->Ln();

    //II
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'II. “EL PROMITENTE COMPRADOR”, declara bajo protesta de decir verdad:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'a) Que cuenta con la capacidad jurídica y económica suficiente para obligarse y cumplir en los términos del presente contrato.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'b) Que conoce la situación jurídica de “EL LOTE”, identificado como Supermanzana 4 Manzana 3 Lote 1, y está conforme con las características y descripción de éste, tal y como consta en el ANEXO A del presente contrato.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'c) Que es su libre voluntad firmar el presente contrato de promesa de compraventa y manifiesta que en su momento el pago del precio de “EL LOTE” lo realiza con recursos de procedencia lícita.',1,0,'L',1);
    $pdf->Ln();

    //III
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'III. AMBAS PARTES DECLARAN:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'a) Se reconocen mutuamente la capacidad y personalidad jurídica para celebrar el presente contrato y lo suscriben por su propia y libre voluntad.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'b) Estipulan y reconocen que los anexos de este contrato son parte integrante del mismo, por lo que deberán interpretarse, ejecutarse y concluirse de acuerdo con la información contenida en cada uno de ellos.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'c) Ambas partes se comprometen y obligan al tenor de las siguientes:',1,0,'L',1);
    $pdf->Ln();

    //CLAUSULAS
    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'CLAUSULAS',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'PRIMERA. - El Objeto del presente contrato es la promesa de “EL PROMITENTE VENDEDOR” de vender y transferir la propiedad de “EL LOTE” debidamente
    identificado en el ANEXO A del presente instrumento a “EL PROMITENTE COMPRADOR”, quien promete adquirir el inmueble por la cantidad total de 'Valor del lote' ('Valor del lote en letras'Treinta y Dos Mil Ciento Cuarenta y Ocho USD Con Noventa Centavos)',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'SEGUNDA. El precio pactado por “EL LOTE” será pagado por “EL PROMITENTE COMPRADOR”, en los términos del presente contrato, de la siguiente manera:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'a) '% del Enganche'% de enganche a la firma del presente contrato de promesa de compraventa.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'b) Los siguientes pagos se realizarán conforme a la tabla de pagos que se acompaña al presente contrato como ANEXO B.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'c) En caso de que “EL PROMITENTE COMPRADOR” incumpla con uno o más de los pagos correspondientes por “EL LOTE” de acuerdo con el ANEXO B, la 3 totalidad del adeudo que en ese Anexo se señala se hará exigible; y pagará además a “EL PROMITENTE VENDEDOR” un interés moratorio adicional del 2% (dos por ciento) mensual, sobre todas las cantidades vencidas, desde el día del vencimiento, hasta la fecha del pago mismo.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'d) “EL PROMITENTE COMPRADOR”, para garantizar el pago por el valor de “EL LOTE,” firmará de su puño y letra al momento en que éste le sea entregado, los pagarés que se mencionan en la tabla de pagos identificada como ANEXO B.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'TERCERA. - “EL PROMITENTE VENDEDOR” trasmitirá ad-corpus “EL LOTE”, a favor de “EL PROMITENTE COMPRADOR”, mediante la celebración y firma de la escritura pública de compraventa.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'Para poder proceder a la firma de la escritura pública de compraventa “EL PROMITENTE COMPRADOR” deberá acreditar haber realizado todos los pagos que se mencionan en el ANEXO B.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'Asimismo, “EL PROMITENTE COMPRADOR” deberá acreditar haber realizado el pago de los derechos y gastos notariales correspondientes.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'Ambas partes establecen que hasta en tanto no se firme la escritura pública correspondiente, “EL PROMITENTE VENDEDOR” conservará el dominio pleno sobre el lote.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'CUARTA. - “EL PROMITENTE VENDEDOR” se obliga a firmar la escritura pública correspondiente en un plazo no mayor a tres meses posteriores a la fecha en la cual “EL PROMITENTE COMPRADOR” demuestre haber dado cumplimiento a la cláusula que antecede, la cual ha de celebrarse con el notario público estipulado por “EL PROMITENTE VENDEDOR”.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'QUINTA - Ambas partes establecen que la entrega de “EL LOTE” deberá llevarse a cabo el día 15 de Julio de 2024, con un plazo adicional de 6 meses, fecha en la cual “EL LOTE” contará con el acceso, y servicios de luz, agua y drenaje a pie de lote.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'“EL PROMITENTE COMPRADOR” únicamente podrá hacer uso y tener el goce de “EL LOTE” siempre y cuando cumpla con las disposiciones federales, estatales y
    municipales, atendiendo íntegramente a lo ordenado en el Reglamento de construcción del proyecto AMARES, mismo que forma parte del ANEXO C.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'A tales efectos “EL PROMITENTE COMPRADOR” deberá presentar para aprobación de “EL PROMITENTE VENDEDOR”, a través del comité de arquitectura de la Asociación de Colonos, el proyecto de construcción que pretender edificar en “EL LOTE”.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'A partir de la fecha de entrega de “EL LOTE” “EL PROMITENTE COMPRADOR” asume la obligación de realizar el pago de cuotas de mantenimiento de la Asociación de Colonos, impuesto predial, derechos por uso de agua y energía eléctrica individual y comunal.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'SEXTA - “EL PROMITENTE COMPRADOR”, desde el momento de recibir el uso y goce de “EL LOTE”, acepta entrar a formar parte de la Asociación de Colonos, de la cual será miembro. “EL PROMITENTE COMPRADOR” acepta y se obliga a que una vez reciba el derecho de uso y goce de “EL LOTE”, respetará y acatará todas y cada una de las disposiciones que contenga el reglamento de uso y mantenimiento, reglamento de sana convivencia y reglamento arquitectónico establecidos por la Asociación de Colonos, así como las disposiciones legales o reglamentarias que tengan o llegaran a tener relación con “EL LOTE”, incluyéndose de manera enunciativa más no limitativa, reglamentos de construcción municipal y/o estatal, y sus correspondientes usos de suelo.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'“EL PROMITENTE COMPRADOR” acepta que cederá su voto a “EL PROMITENTE VENDEDOR” en las asambleas de la Asociación de Colonos, hasta el momento en que haya realizado el pago total del precio pactado por “EL LOTE”.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'SEPTIMA. - “EL PROMITENTE COMPRADOR”, no podrá ceder, vender o traspasar los derechos derivados del presente contrato sin el consentimiento previo por escrito de “EL PROMITENTE VENDEDOR”, y en todo caso, las partes acuerdan desde ahora que, en caso de cualquier tipo de cesión, venta o traspaso, “EL PROMITENTE COMPRADOR” se obliga a pagar el 2.5% del valor de “EL LOTE” a “EL PROMITENTE VENDEDOR “, por concepto de gastos administrativos por la autorización de la cesión de derechos.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'OCTAVA. - Las partes acuerdan y se obligan mediante el presente pacto comisorio a dar por terminado el presente contrato, sin necesidad de declaración judicial previa y sin responsabilidad alguna para “EL PROMITENTE VENDEDOR”, como consecuencia de las siguientes causales:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'a) Si “EL PROMITENTE COMPRADOR” deja de pagar dos o más pagos consecutivos del precio convenido por “EL LOTE” objeto de contrato;',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'b) Si “EL PROMITENTE COMPRADOR” vende, cede, traspasa o de alguna manera enajena o grava, sin la autorización de “EL PROMITENTE VENDEDOR”, los derechos derivados del presente contrato.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'En caso de terminación del presente contrato por las causas de los incisos a) y b) aludidas en la presente cláusula, las partes acuerdan en concepto de indemnización, el pago del equivalente al 15% (quince por ciento) del precio total de “EL LOTE.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'“EL PROMITENTE COMPRADOR” autoriza que el pago indemnizatorio mencionado, sea retenido por “EL PROMITENTE VENDEDOR” de las cantidades que haya cubierto como parte del pago del precio de “EL LOTE” o bien del depósito en garantía entregado, y en su caso, una vez notificado, devolverá el saldo resultante a “EL PROMITENTE COMPRADOR” en un plazo máximo de 20 días hábiles posteriores a la notificación de terminación de contrato. Quedando obligado “EL PROMITENTE COMPRADOR” a entregar de inmediato “EL LOTE” a “EL PROMITENTE VENDEDOR” con las construcciones y mejoras que hubiere efectuado y sin derecho a indemnización alguna.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'Adicional a lo anterior, se establece como causal de rescisión imputable a “EL PROMITENTE VENDEDOR” si cae en las siguientes causales:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'a) Que “EL PROMITENTE VENDEDOR” se negare a otorgar la escritura pública de compraventa en el plazo máximo convenido.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'b) La falta de entrega oportuna del uso y goce de “EL LOTE” en los términos y plazos contenidos en el presente contrato;',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'“EL PROMITENTE COMPRADOR” podrá optar por exigir el cumplimiento forzoso del contrato prometido, o bien el pago de una pena convencional sustitutiva de daños y perjuicios a su favor, equivalente a la cantidad que resulte de obtener el interés promedio conforme a la tasa de interés interbancaria que fije el Banco de México en el mes inmediato anterior al incumplimiento, sobre las cantidades efectivamente pagadas y desde la fecha en que se realicen y hasta su devolución, por concepto de indemnización.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'NOVENA- Las partes establecen que para que sea válida cualquier modificación, en todo o en parte, de lo acordado en este contrato, éstedeberá ser firmada por las partes por escrito.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'DÉCIMA. - Para los efectos de lo pactado en el presente contrato, las partes señalan como sus domicilios para recibir toda clase de notificaciones y comunicaciones que se cursen entre sí:',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'“EL PROMITENTE VENDEDOR”: Avenida Ejercito Nacional 678, Dpto 302. Polanco Sección IV, Colonia Miguel Hidalgo. Ciudad de México. CP 11550. Correo electrónico: ihenares@amaresrivieramaya.com',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'“EL PROMITENTE COMPRADOR”: SM 24 Mza. 100 Lt.1 #03 Conjunto 6 UP 6 'Dirección del comprador,1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'Correo electrónico: 'Correo del comprador,1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'DÉCIMA PRIMERA. - Para todo lo relativo a la interpretación y cumplimiento del presente contrato serán aplicables las leyes y tribunales competentes de la ciudad de Playa del Carmen, Municipio de Solidaridad, Estado de Quintana Roo. Ambas partes renuncian al fuero que por su domicilio presente o futuro pudiera resultar competente.',1,0,'L',1);
    $pdf->Ln();

    $pdf->SetY($Y_Table_Position+=8);
    $pdf->SetX($X_Table_Position);
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(180,6,'LEÍDO Y ENTENDIDO QUE FUE EL PRESENTE CONTRATO, LO FIRMAN DE CONFORMIDAD, POR TRIPLICADO, AL MARGEN Y AL CALCE EN PLAYA DEL CARMEN. MUNICIPIO DE SOLIDARIDAD, QUINTANA ROO, MÉXICO A 19 DE NOVIEMBRE DEL 2021. ENTREGANDO A CADA PARTE UN DOCUMENTO ORIGINAL CON FIRMA AUTOGRAFA DEL MISMO Y SUS ANEXOS.',1,0,'L',1);
    $pdf->Ln();

    //FIRMAS



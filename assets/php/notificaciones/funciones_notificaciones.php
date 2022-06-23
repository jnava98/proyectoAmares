<?php
include "../conexion.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
setlocale(LC_ALL,"es_ES");
    // primero hay que incluir la clase phpmailer para poder instanciar
    //un objeto de la misma
    require __DIR__.'../../vendor/php-mailer/Exception.php';
    require __DIR__.'../../vendor/php-mailer/PHPMailer.php';
    require __DIR__.'../../vendor/php-mailer/SMTP.php';
    $mail = new PHPMailer(true);
    
    $sql="SELECT * FROM notificaciones WHERE estatus LIKE '0' LIMIT 20";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        while($col=mysqli_fetch_array($result)){
            $mail->clearAllRecipients( );
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();     
            //Asignamos a Host el nombre de nuestro servidor smtp
            $mail->Host = "smtp.gmail.com";
            //Le indicamos que el servidor smtp requiere autenticación
            $mail->SMTPAuth = true;
            //Le decimos cual es nuestro nombre de usuario y password
            $mail->Username = "condorconsultoria.pruebas@gmail.com"; 
            $mail->Password = "dhtzigeowaoqopwu";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = 'UTF-8';
            //Indicamos cual es nuestra dirección de correo y el nombre que 
            //queremos que vea el usuario que lee nuestro correo
            $mail->setFrom('condorconsultoria.pruebas@gmail.com', 'Notificacion');
            //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
            //una cuenta gratuita, por tanto lo pongo a 30  
            $mail->Timeout=30;
            $sql="SELECT correo,nombre,apellido_paterno,apellido_materno FROM clientes where id_cliente LIKE  '".$col['id_cliente']."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
                $row=mysqli_fetch_array($resultado);
                $mail->AddAddress($row['correo']);
            }//fin del if
            //Indicamos cual es la dirección de destino del correo
            
            //Asignamos asunto y cuerpo del mensaje
            //El cuerpo del mensaje lo ponemos en formato html, haciendo 
            //que se vea en negrita
            $mail->isHTML(true);  
            $mail->Subject = "Prueba de correo";
            $mail->AddEmbeddedImage('images/image-3.png', 'imagenLogo');
            $mail->AddEmbeddedImage('images/image-5.png', 'imagenCalendario');
            $nombre = $row['nombre'].' '.$row['apellido_paterno'].' '.$row['apellido_materno'];
            $sql_contrato = "SELECT l.super_manzana,l.mza,l.lote,c.dia_notificacion FROM contrato c inner join lotes l on c.id_lote=l.id_lote where c.id_contrato='".$col['id_contrato']."'";
            $query_contrato = mysqli_query(conectar(),$sql_contrato);
            $num2 = mysqli_num_rows($query_contrato);
            
            if($num2>0){
                $datosContrato=mysqli_fetch_array($query_contrato);
            }
            
            
            
            $concepto_pago= 'Supermanzana '.$datosContrato['super_manzana'].' Manzana '.$datosContrato['mza'].' Lote '.$datosContrato['lote'];
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $hoy = $meses[date('n')-1].",".date('d').",".date('Y') ;
            $dia_pago= $datosContrato['dia_notificacion'].' de '.$meses[date('n')-1].' del '.date('Y');
            
            
            $mail->Body    = '<!DOCTYPE HTML
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
            xmlns:o="urn:schemas-microsoft-com:office:office">
          
          <head>
            <!--[if gte mso 9]>
          <xml>
            <o:OfficeDocumentSettings>
              <o:AllowPNG/>
              <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
          </xml>
          <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
          
            <style type="text/css">
              @media only screen and (min-width: 570px) {
                .u-row {
                  width: 550px !important;
                }
          
                .u-row .u-col {
                  vertical-align: top;
                }
          
                .u-row .u-col-100 {
                  width: 550px !important;
                }
          
              }
          
              @media (max-width: 570px) {
                .u-row-container {
                  max-width: 100% !important;
                  padding-left: 0px !important;
                  padding-right: 0px !important;
                }
          
                .u-row .u-col {
                  min-width: 320px !important;
                  max-width: 100% !important;
                  display: block !important;
                }
          
                .u-row {
                  width: calc(100% - 40px) !important;
                }
          
                .u-col {
                  width: 100% !important;
                }
          
                .u-col>div {
                  margin: 0 auto;
                }
              }
          
              body {
                margin: 0;
                padding: 0;
              }
          
              table,
              tr,
              td {
                vertical-align: top;
                border-collapse: collapse;
              }
          
              p {
                margin: 0;
              }
          
              .ie-container table,
              .mso-container table {
                table-layout: fixed;
              }
          
              * {
                line-height: inherit;
              }
          
              a[x-apple-data-detectors="true"] {
                color: inherit !important;
                text-decoration: none !important;
              }
          
              table,
              td {
                color: #000000;
              }
          
              a {
                color: #3598db;
                text-decoration: underline;
              }
            </style>
          
          
          
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css">
            <!--<![endif]-->
          
          </head>
          
          <body class="clean-body u_body"
            style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table
              style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%"
              cellpadding="0" cellspacing="0">
              <tbody>
                <tr style="vertical-align: top">
                  <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #293c4b;"><![endif]-->
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-right: 0px;padding-left: 0px;" align="center">
                                              <a href="https://amaresrivieramaya.com/" target="_blank">
                                                <img align="center" border="0" src="cid:imagenLogo" alt="Logo" title="Logo"
                                                  style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 35%;max-width: 185.5px;"
                                                  width="185.5" />
                                              </a>
                                            </td>
                                          </tr>
                                        </table>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3598db;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3598db;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 0px 15px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <h3
                                          style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal;  font-size: 23px;">
                                          Recordatorio de pago
                                        </h3>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container"
                      style="padding: 0px;background-image: url("%20");background-repeat: no-repeat;background-position: center top;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3598db;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-image: url("%20");background-repeat: no-repeat;background-position: center top;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3598db;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-right: 0px;padding-left: 0px;" align="center">
          
                                              <img align="center" border="0" src="cid:imagenCalendario" alt="Calendar"
                                                title="Calendar"
                                                style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 550px;"
                                                width="550" />
          
                                            </td>
                                          </tr>
                                        </table>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px 20px 20px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px 20px 20px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px 15px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <h3
                                          style="margin: 0px; color: #293c4b; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: "Montserrat",sans-serif; font-size: 18px;">
                                          <strong>Estimado/a '.$nombre.'</strong>
                                        </h3>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <div style="color: #656e72; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;">Este es
                                              un recordatorio de pago en concepto de '.$concepto_pago.' esta a _____ dias de vencer. Favor
                                              de realizar el pago a mas tardar el '.$dia_pago.'.</span></p>
                                          <p style="font-size: 14px; line-height: 140%;">&nbsp;</p>
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;">Si
                                              usted ha realizado su pago, por favor haga caso omiso</span></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <div
                                          style="color: #293c4b; line-height: 140%; text-align: center; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-family: Montserrat, sans-serif; font-size: 16px; line-height: 22.4px; color: #7db00e;"><strong>'.$hoy.'</strong></span></p>
                                          <!-- <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-family: Montserrat, sans-serif; font-size: 14px; line-height: 19.6px;"><strong>Service
                                                call</strong></span></p> -->
                                          <p style="font-size: 14px;"><span
                                              style="font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;"><br />Playa
                                              Del Carmen,Quintana Roo</span></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <div style="color: #656e72; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%;"><span
                                              style="font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;">Si
                                              tiene alguna pregunta, por favor pongase en contacto con nosotros a
                                              <a href="https://amaresrivieramaya.com/" target="_blank" rel="noopener">
                                                <strong>contacto@amaresrivieramaya.com</strong>&nbsp;</a></span></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
          
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 20px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 20px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
                                  cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:arial,helvetica,sans-serif;"
                                        align="left">
          
                                        <div
                                          style="color: #7e8c8d; line-height: 140%; text-align: center; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%;">&copy; '.date('Y').' Amares Riviera Maya. Todos
                                          los derechos reservados.
                                          </p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
            <!--[if mso]></div><![endif]-->
            <!--[if IE]></div><![endif]-->
          </body>
          
          </html>';
            //Definimos AltBody por si el destinatario del correo no admite email con formato html 
            // $mail->AltBody = mensajes($col['id_cliente'],$col['tipo']);
            //se envia el mensaje, si no ha habido problemas 
            //la variable $exito tendra el valor true
            $exito = $mail->Send();
            //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
            //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
            //del anterior, para ello se usa la funcion sleep	
            $intentos=1; 
            // while((!$exito) && ($intentos < 5)){
            //     sleep(5);
            //         //echo $mail->ErrorInfo;
            //         $exito = $mail->Send();
            //         $intentos=$intentos+1;
            // }//fin del while
            
                    
            if(!$exito){
                echo "Problemas enviando correo electrónico a ".$valor;
                echo "<br/>".$mail->ErrorInfo;	
            }else{
                echo "Mensaje enviado correctamente";
                $sql="UPDATE notificaciones set estatus = '1' where id_notificacion LIKE '".$col['id_notificacion']."'";
                $resultado=mysqli_query(Conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
    



?>
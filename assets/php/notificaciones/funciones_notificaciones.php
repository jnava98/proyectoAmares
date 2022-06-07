<?php
include "../conexion.php";

function crear_lista_usuarios_notificar(){
    $hoy = date("d-m-Y");
    //Faltan 5 dias para su fecha de pago
    $nueva_fecha = date("Y-m-d",strtotime($hoy."+ 5 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_pago LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Faltan 3 dias para su fecha de pago
    $nueva_fecha = date("Y-m-d",strtotime($hoy."+ 3 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_pago LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Hoy deben realizar su pago
    $nueva_fecha = date("Y-m-d",strtotime($hoy));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_pago LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Pago vencido 2 días
    $nueva_fecha = date("Y-m-d",strtotime($hoy."- 2 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_pago LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Pago vencido 5 días
    $nueva_fecha = date("Y-m-d",strtotime($hoy."- 5 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_pago LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
}//fin de crear lista de usuarios notificar
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function enviar_correos(){
    // primero hay que incluir la clase phpmailer para poder instanciar
    //un objeto de la misma
    require '../../vendor/php-mailer/Exception.php';
    require '../../vendor/php-mailer/PHPMailer.php';
    require '../../vendor/php-mailer/SMTP.php';
    $mail = new PHPMailer(true);
    
    $sql="SELECT * FROM notificaciones WHERE estatus LIKE '0' LIMIT 20";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        while($col=mysqli_fetch_array($result)){
          
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
            $sql="SELECT correo FROM clientes where id_cliente LIKE  '".$col['id_cliente']."'";
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
            $mail->Body = "<b>Mensaje de prueba mandado con phpmailer en formato html</b>";
            //Definimos AltBody por si el destinatario del correo no admite email con formato html 
            $mail->AltBody = mensajes($col['id_cliente'],$col['tipo']);
            //se envia el mensaje, si no ha habido problemas 
            //la variable $exito tendra el valor true
            $exito = $mail->Send();
            //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
            //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
            //del anterior, para ello se usa la funcion sleep	
            $intentos=1; 
            while((!$exito) && ($intentos < 5)){
                sleep(5);
                    //echo $mail->ErrorInfo;
                    $exito = $mail->Send();
                    $intentos=$intentos+1;
            }//fin del while
            
                    
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
    
}


?>
<?php
include "../conexion.php";

function crear_lista_usuarios_notificar(){
    $hoy = date("d-m-Y");
    //5 dias de pago
    $nueva_fecha = date("d-m-Y",strtotime($hoy."+ 5 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."%'";
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
                $sql="INSERT into notificaciones (fecha_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
    //3 dias de pago
    $nueva_fecha = date("d-m-Y",strtotime($hoy."+ 3 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."%'";
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
                $sql="INSERT into notificaciones (fecha_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
    //Tienen que pagar hoy
    $nueva_fecha = date("d-m-Y",strtotime($hoy."+ 5 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."%'";
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
                $sql="INSERT into notificaciones (fecha_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
    //Pago vencido 2 días
    $nueva_fecha = date("d-m-Y",strtotime($hoy."- 2 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."%'";
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
                $sql="INSERT into notificaciones (fecha_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
    //Pago vencido 5 días
    $nueva_fecha = date("d-m-Y",strtotime($hoy."- 5 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato WHERE dia_pago LIKE  '%-".$aux."%'";
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
                $sql="INSERT into notificaciones (fecha_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
}//fin de crear lista de usuarios notificar

function enviar_correos(){
    // primero hay que incluir la clase phpmailer para poder instanciar
    //un objeto de la misma
    require "includes/class.phpmailer.php";
    $mail = new phpmailer();
    
    $sql="SELECT * FROM notificaciones WHERE estatus LIKE '0' LIMIT 20";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        while($col=mysqli_fetch_array($result)){
            //Definimos las propiedades y llamamos a los métodos 
            //correspondientes del objeto mail
            //Con PluginDir le indicamos a la clase phpmailer donde se 
            //encuentra la clase smtp que como he comentado al principio de 
            //este ejemplo va a estar en el subdirectorio includes
            $mail->PluginDir = "includes/";
            //Con la propiedad Mailer le indicamos que vamos a usar un 
            //servidor smtp
            $mail->Mailer = "smtp";
            //Asignamos a Host el nombre de nuestro servidor smtp
            $mail->Host = "smtp.hotpop.com";
            //Le indicamos que el servidor smtp requiere autenticación
            $mail->SMTPAuth = true;
            //Le decimos cual es nuestro nombre de usuario y password
            $mail->Username = "micuenta@HotPOP.com"; 
            $mail->Password = "mipassword";
            //Indicamos cual es nuestra dirección de correo y el nombre que 
            //queremos que vea el usuario que lee nuestro correo
            $mail->From = "prueba@amaresrivieramaya.com";
            $mail->FromName = "Jorge Navarrete";
            //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
            //una cuenta gratuita, por tanto lo pongo a 30  
            $mail->Timeout=30;
            $sql="SELECT correo FROM clientes where id_cliente LIKE = '".$col['id_cliente']."'";
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
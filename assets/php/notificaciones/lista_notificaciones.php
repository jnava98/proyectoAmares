<?php
include "../conexion.php";
function crear_lista_usuarios_notificar(){
    $hoy = date("Y-m-d");
    //Faltan 5 dias para su fecha de pago
    $nueva_fecha = date("Y-m-d",strtotime($hoy."+ 5 days"));
    
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente, l.id_lote FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato inner join lotes as l on co.id_lote = l.id_lote WHERE co.dia_notificacion LIKE  '".$aux."' and co.dia_pago <= '".$nueva_fecha."'  and l.estatus <> '4' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_mensualidad LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus, id_contrato, tipo_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0', '".$col['id_contrato']."', '1') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Faltan 3 dias para su fecha de pago
    $nueva_fecha = date("Y-m-d",strtotime($hoy."+ 3 days"));
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente, l.id_lote FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato inner join lotes as l on co.id_lote = l.id_lote WHERE co.dia_notificacion LIKE  '".$aux."' and co.dia_pago <= '".$nueva_fecha."'  and l.estatus <> '4' ";
    $result = mysqli_query(conectar(),$sql);
   
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_mensualidad LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus, id_contrato, tipo_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0','".$col['id_contrato']."', '2') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Hoy deben realizar su pago
    $nueva_fecha = date("Y-m-d",strtotime($hoy));
    
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente, l.id_lote FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato inner join lotes as l on co.id_lote = l.id_lote WHERE co.dia_notificacion LIKE  '".$aux."' and co.dia_pago <= '".$hoy."'  and l.estatus <> '4' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_mensualidad LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus,id_contrato, tipo_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0','".$col['id_contrato']."', '3') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Pago vencido 2 días
    $nueva_fecha = date("Y-m-d",strtotime($hoy."- 2 days"));
    
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente, l.id_lote FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato inner join lotes as l on co.id_lote = l.id_lote WHERE co.dia_notificacion LIKE  '".$aux."' and co.dia_pago <= '".$hoy."'  and l.estatus <> '4' ";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_mensualidad LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus,id_contrato, tipo_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0','".$col['id_contrato']."', '4')";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if


    //Pago vencido 5 días
    $nueva_fecha = date("Y-m-d",strtotime($hoy."- 5 days"));
    
    $aux = date("d", strtotime($nueva_fecha));
    $sql="SELECT co.id_contrato, cc.id_cliente, l.id_lote FROM contrato as co inner join cliente_contrato as cc on co.id_contrato = cc.id_contrato inner join lotes as l on co.id_lote = l.id_lote WHERE co.dia_notificacion LIKE  '".$aux."' and co.dia_pago <= '".$hoy."'  and l.estatus <> '4'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col = mysqli_fetch_array($result)){
            $sql="SELECT * FROM pagos WHERE id_contrato LIKE '".$col['id_contrato']."' AND fecha_mensualidad LIKE '".$nueva_fecha."'";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $num = mysqli_num_rows($resultado);
            if($num>0){
            }else{
                $sql="INSERT into notificaciones (fecha_notificacion, id_cliente, estatus, id_contrato, tipo_notificacion) values ('".$hoy."', '".$col['id_cliente']."', '0','".$col['id_contrato']."', '5') ";
                $resultado = mysqli_query(conectar(),$sql);
                desconectar();
            }//fin del else
        }//fin del while
    }//fin del if
}//fin de crear lista de usuarios notificar
crear_lista_usuarios_notificar();
?>
<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

function tabla_notificaciones(){
    $html="";
    $hoy = date("Y-m-d");
    $fecha_hoy = date("d/m/Y",strtotime($hoy));
    $sql="SELECT n.id_cliente, n.id_contrato, n.estatus, c.nombre, c.apellido_paterno, c.apellido_materno, c.correo, p.mensualidad_historica from notificaciones as n inner join clientes as c on n.id_cliente=c.id_cliente inner join pagos as p on n.id_contrato=p.id_contrato where n.fecha_notificacion like '".$hoy."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $html.='<h5 class="card-title">Clientes por Notificar<span> | Hoy '.$fecha_hoy.'</span></h5>
        <table id="tabla_clientes_notificaciones" class="table table-responsive table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th style="text-align:center">#</th>
                    <th style="text-align:center">Cliente</th>
                    <th style="text-align:center">Correo</th>
                    <th style="text-align:center">Monto</th>
                    <th style="text-align:center">Estatus Notificación</th>
                </tr>
            </thead>
            <tbody>';
            $i = 1;
            while($col = mysqli_fetch_array($result)){
                $html.='
                <tr>
                    <th scope="row"><a href="#">'.$i.'</a></th>
                    <td>'.$col['nombre'].' '.$col['apellido_paterno'].' '.$col['apellido_materno'].'</td>
                    <td><a href="#" class="text-primary">'.$col['correo'].'</a></td>
                    <td>'.$col['mensualidad_historica'].'</td>';
                    if($col['estatus'] == "1"){
                        $html.='<td><span class="badge bg-success">Notificado</span></td>';
                    }else{
                        $html.='<td><span class="badge bg-success">Pendiente</span></td>';
                    }//fin del else
                $html.='</tr>';
                $i++;
            }//fin del while
            $html.='
            </tbody>
        </table>';
    }//fin del if
    return $html;
}//fin de funcion tabla_notificaciones

$respuesta=Array();
$hoy = date("Y-m-d");
$fecha_hoy = date("d/m/Y",strtotime($hoy));
$sql="SELECT * from notificaciones where fecha_notificacion like '".$hoy."'";//Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
if($num>0){
    $respuesta['valor']="ok";
    $respuesta['formato']=tabla_notificaciones();
}else{
    $respuesta['valor']="error";
    $respuesta['formato']="<br><h5 class='card-title'>Clientes por Notificar<span> | Hoy ".$fecha_hoy."</span></h5><h5 class='card-title'>No existen datos</h5>";
}//Fin del else
echo json_encode($respuesta);
?>
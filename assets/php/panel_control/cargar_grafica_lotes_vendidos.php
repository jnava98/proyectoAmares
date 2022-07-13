<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

$respuesta=Array();
$meses = Array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$hoy = date("Y-m-d");
$sql="SELECT * from cat_tipo_lote";
$result = mysqli_query(conectar(),$sql);
desconectar();
$num = mysqli_num_rows($result);
if($num>0){
    $respuesta['valor']="ok";
    while($col = mysqli_fetch_array($result)){
        $nombre = $col['nombre'];
        $mes = date("Y-m",strtotime($hoy));
        $fecha_uno = $mes."-01";
        $fecha_uno = date("Y-m-d",strtotime($fecha_uno."- 5 month"));
        $fecha_dos = date("Y-m-d",strtotime($fecha_uno."+ 1 month"));
        for ($i = 0; $i <= 5; $i++) {
            $sql="SELECT count(*) from contrato as c inner join lotes as l on c.id_lote = l.id_lote inner join cat_tipo_lote as ctl on l.id_tipo_lote = ctl.id_tipo_lote where c.fecha_firma >= '$fecha_uno' && c.fecha_firma < '$fecha_dos' && ctl.id_tipo_lote like '".$col['id_tipo_lote']."'";//Consultar id de la variable
            //echo $sql;
            $result_lotes=mysqli_query(conectar(),$sql);
            desconectar();
            $num=mysqli_num_rows($result_lotes);
            $lotes_vendidos = 0;
            if($num>0){
                $row = mysqli_fetch_array($result_lotes);
                $lotes_vendidos = $row[0];
            }//fin del if
            $respuesta[$nombre][$i]=$lotes_vendidos;
            //Aumentan los meses
            $fecha_uno = date("Y-m-d",strtotime($fecha_uno."+ 1 month"));
            $fecha_dos = date("Y-m-d",strtotime($fecha_dos."+ 1 month"));
        }//fin del for  
    }//fin del while
    /*$mes = date("m",strtotime($hoy."- 5 month"));
    for ($i = 0; $i <= 5; $i++) {
        $aux_mes = $meses[$mes];
        $aux_mes=$meses[(date('m',strtotime($mes))*1)];
        
        $respuesta['meses'][$i]=$aux_mes;

        $mes = date("m",strtotime($mes."+ 1 month"));
    }//fin del for  */

}else{
    $respuesta['valor']="error";
}//fin del else



//$respuesta['premium'][]="";
echo json_encode($respuesta);
?>
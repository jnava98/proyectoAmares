<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

$respuesta=Array();
$hoy = date("Y-m-d");
$mes = date("Y-m",strtotime($hoy));
$fecha_uno = $mes."-01";

$fecha_dos = date("Y-m-d",strtotime($fecha_uno."+ 1 month"));

$sql="SELECT SUM(precio_venta) from contrato where fecha_firma >= '$fecha_uno' && fecha_firma < '$fecha_dos'";//Consultar id de la variable

$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
$ingreso = 0;
if($num>0){
    $col = mysqli_fetch_array($result);
    $ingreso = $col[0];
}//fin del if
$sql="SELECT count(*) from contrato where fecha_firma >= '$fecha_uno' && fecha_firma < '$fecha_dos'";//Consultar id de la variable
$result=mysqli_query(conectar(),$sql);
desconectar();
$num=mysqli_num_rows($result);
$lotes_vendidos = 0;
if($num>0){
    $col = mysqli_fetch_array($result);
    $lotes_vendidos = $col[0];
}//fin del if
$respuesta['valor']="ok";
$respuesta['ingreso']="<h6>$".number_format($ingreso, 2)."</h6>";
$respuesta['lotes_vendidos']="<h6>".$lotes_vendidos."</h6>";
echo json_encode($respuesta);
?>
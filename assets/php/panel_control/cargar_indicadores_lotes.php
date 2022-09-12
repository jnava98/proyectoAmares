<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

$respuesta=Array();

function trimestre($mes){
    switch($mes){
        case "01":
            $trimestre = 1;
            break;
        case "02":
            $trimestre = 1;
            break;
        case "03":
            $trimestre = 1;
            break;
        case "04":
            $trimestre = 2;
            break;
        case "05":
            $trimestre = 2;
            break;
        case "06":
            $trimestre = 2;
            break;
        case "07":
            $trimestre = 3;
            break;
        case "08":
            $trimestre = 3;
            break;
        case "09":
            $trimestre = 3;
            break;
        case "10":
            $trimestre = 4;
            break;
        case "11":
            $trimestre = 4;
            break;
        case "12":
            $trimestre = 4;
            break;
    }//fin del switch
    return $trimestre;
}//fin de funcion trimestre
$hoy = date("Y-m-d");
$mes_anio = date("Y-m",strtotime($hoy));
$mes = date("m",strtotime($hoy));
$anio = date("Y",strtotime($hoy));
$trimestre = trimestre($mes);
switch ($trimestre){
    case "1": 
        $fecha_uno = $anio."-01-01";
        $fecha_dos = $anio."-03-31";
        break;
    case "2": 
        $fecha_uno = $anio."-04-01";
        $fecha_dos = $anio."-06-30";
        break;
    case "3": 
        $fecha_uno = $anio."-07-01";
        $fecha_dos = $anio."-09-30";
        break;
    case "4": 
        $fecha_uno = $anio."-10-01";
        $fecha_dos = $anio."-12-31";
        break;
}//fin de switch
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

switch ($trimestre){
    case "1": 
        $trimestre_aux = "Primer trimestre";
        break;
    case "2": 
        $trimestre_aux = "Segundo trimestre";
        break;
    case "3": 
        $trimestre_aux = "Tercer trimestre";
        break;
    case "4": 
        $trimestre_aux = "Cuarto trimestre";
        break;
}//fin de switch

$respuesta['valor']="ok";
$respuesta['ingreso']="<h6>$".number_format($ingreso, 2)."</h6>";
$respuesta['lotes_vendidos']="<h6>".$lotes_vendidos."</h6>";
$respuesta['trimestre']=$trimestre_aux;
echo json_encode($respuesta);
?>
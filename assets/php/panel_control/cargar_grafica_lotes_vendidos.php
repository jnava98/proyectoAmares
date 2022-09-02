<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_POST["periodo"])){
	$periodo="0";
}else{
	$periodo=$_POST["periodo"];
}//Fin del else

function mes($numero_mes){
    switch($numero_mes){
        case "01":
            $respuesta = "Enero";
        break;
        case "02":
            $respuesta = "Febrero";
        break;
        case "03":
            $respuesta = "Marzo";
        break;
        case "04":
            $respuesta = "Abril";
        break;
        case "05":
            $respuesta = "Mayo";
        break;
        case "06":
            $respuesta = "Junio";
        break;
        case "07":
            $respuesta = "Julio";
        break;
        case "08":
            $respuesta = "Agosto";
        break;
        case "09":
            $respuesta = "Septiembre";
        break;
        case "10":
            $respuesta = "Octubre";
        break;
        case "11":
            $respuesta = "Noviembre";
        break;
        case "12":
            $respuesta = "Diciembre";
        break;
    }//fin del switch
    return $respuesta;
}//fin de funcion mes
if($periodo=='0'){
    $periodo = date('Y');
}//fin del if
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
        //$mes = date("Y-m",strtotime($hoy));
        $fecha_uno = $periodo."-01-01";
        //$fecha_uno = date("Y-m-d",strtotime($fecha_uno."- 5 month"));
        $fecha_dos = date("Y-m-d",strtotime($fecha_uno."+ 1 month"));
        for ($i = 0; $i <= 11; $i++) {
            $sql="SELECT count(*) from contrato as c inner join lotes as l on c.id_lote = l.id_lote inner join cat_tipo_lote as ctl on l.id_tipo_lote = ctl.id_tipo_lote where c.fecha_firma >= '$fecha_uno' && c.fecha_firma < '$fecha_dos' && ctl.id_tipo_lote like '".$col['id_tipo_lote']."'";//Consultar id de la variable
            $result_lotes=mysqli_query(conectar(),$sql);
            desconectar();
            $num=mysqli_num_rows($result_lotes);
            $lotes_vendidos = 0;
            if($num>0){
                $row = mysqli_fetch_array($result_lotes);
                $lotes_vendidos = $row[0];
            }else{
                $lotes_vendidos = 0;
            }//fin del else
            $respuesta[$nombre][$i]=$lotes_vendidos;
            //Aumentan los meses
            $fecha_uno = date("Y-m-d",strtotime($fecha_uno."+ 1 month"));
            $fecha_dos = date("Y-m-d",strtotime($fecha_dos."+ 1 month"));
        }//fin del for  
    }//fin del while
    //$fecha_uno = $periodo."-01-01";
    $mes = "01";
    for($i = 0; $i <= 11; $i++) {
        if($mes>="13"){
            $mes = "01";
        }//fin del if
        $aux_mes = mes($mes);
        $respuesta['meses'][$i]=$aux_mes;
        $respuesta['periodo']=$periodo;
        $mes = $mes+1;
    }//fin del for

}else{
    $respuesta['valor']="error";
}//fin del else

echo json_encode($respuesta);
?>
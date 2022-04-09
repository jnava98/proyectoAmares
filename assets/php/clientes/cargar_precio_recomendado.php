<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_GET["id_lote"])){
	$id_lote="0";
}else{
	$id_lote=$_GET["id_lote"];
}//Fin del else

if(empty($_GET["precio_lista"])){
	$precio_lista="0";
}else{
	$precio_lista=$_GET["precio_lista"];
}//Fin del else

if(empty($_GET["descuento_venta"])){
	$descuento_venta="0";
}else{
	$descuento_venta=$_GET["descuento_venta"];
}//Fin del else

if(empty($_GET["desc_aplicados"])){
	$desc_aplicados="0";
}else{
	$desc_aplicados=$_GET["desc_aplicados"];
}//Fin del else

if($id_lote!="0"){
    $sql="SELECT precio_lista from lotes where id_lote like '".$id_lote."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col = mysqli_fetch_array($result);
        $precio_lista = $col[0];
    }//fin del if
    if($descuento_venta!="0"){
        $descuento_venta = number_format($descuento_venta);
        $aux = 100 - $descuento_venta;
        $aux = ($aux/100);
        $precio_lista = ($precio_lista*$aux);
    }//fin del if
    if($desc_aplicados!="0"){
        $cadena = explode(",", $desc_aplicados);
        $array_size = count($cadena);
        for ($i = 0; $i<$array_size; $i++) {
            $descuento = $cadena[$i];
            $sql="SELECT tasa FROM cat_descuentos WHERE descripcion LIKE '".$descuento."' ";
            $resultado = mysqli_query(conectar(),$sql);
            desconectar();
            $col = mysqli_fetch_array($resultado);
            $tasa = $col[0];
            $tasa = number_format($tasa);
            $aux = 100 - $tasa;
            $aux = ($aux/100);
            $precio_lista = ($precio_lista*$aux);
        }//fin del for
    }//fin del if
    $respuesta['valor']="ok";
    $respuesta['precio_recomendado']=$precio_lista;
}else{
    $respuesta['valor']="error";
}//fin del else

echo json_encode($respuesta);
?>

<?php
session_start();
include "../conexion.php";
include "../funciones.php";
include "../selects.php";

if(empty($_GET["id_tipo_compra"])){
	$id_tipo_compra="0";
}else{
	$id_tipo_compra=$_GET["id_tipo_compra"];
}//Fin del else

$respuesta=Array();
if(($id_tipo_compra!="0")){
    $sql="SELECT tasa from cat_tipo_compra where id_tipo_compra like '".$id_tipo_compra."'";//Consultar id de la variable
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($result){
        $col=mysqli_fetch_array($result);
        $tasa = $col[0];
        $respuesta['valor']="ok";
        $respuesta['tasa']=$tasa;
    }else{
        $respuesta['valor']="¡No se encontr&oacute; esta valor!";
    }//Fin del else
}else{

}//fin del else
echo json_encode($respuesta);
?>
<?php

function multiselect_lotes(){
    $respuesta="";
    $sql="";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $respuesta.='<select id="multiselect_lotes" class="select" multiple data-mdb-filter="true">';
        while($col=mysqli_fetch_array($result)){ 
            $respuesta.='<option value="1">One</option>';
            $respuesta.='<option value="2">Two</option>';
            $respuesta.='<option value="3">Three</option>';
            $respuesta.='<option value="4">Four</option>';
            $respuesta.='<option value="5">Five</option>';
            $respuesta.='<option value="6">Six</option>';
            $respuesta.='<option value="7">Seven</option>';
            $respuesta.='<option value="8">Eight</option>';
            $respuesta.='<option value="9">Nine</option>';
            $respuesta.='<option value="10">Ten</option>';
        }//fin del while
        $respuesta.='</select>';
    }//fin del if
    return $respuesta;
}//fun de multiselect_lotes

function select_fase(){
    $respuesta="";
	$consulta="select distinct fase from lotes order by fase";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_fase' id='select_fase' class='form-control' onchange='cargar_select_super_manzana(this.id)'>";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            $respuesta.="<option value='".$registro['fase']."'>".$registro['fase']."</option>";	
        }//Fin del while
        $respuesta.="</select>";
    }else{
        $respuesta.="<h3> Sin datos </h3>";
    }//fin del else
	return $respuesta;
}//fin de select fase

function select_super_manzana($fase){
    $respuesta="";
	$consulta="SELECT DISTINCT super_manzana from lotes where fase LIKE '".$fase."'";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_super_manzana' id='select_super_manzana' class='form-control' onchange='cargar_select_manzana(this.id)'>";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            $respuesta.="<option value='".$registro['super_manzana']."'>".$registro['super_manzana']."</option>";	
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select super manzana

function select_manzana($super_manzana, $fase){
    $respuesta="";
	$consulta="SELECT DISTINCT mza from lotes where super_manzana LIKE '".$super_manzana."' AND fase LIKE '".$fase."'";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_manzana' id='select_manzana' class='form-control' onchange='cargar_select_lotes(this.id)'>";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            $respuesta.="<option value='".$registro['mza']."'>".$registro['mza']."</option>";	
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select super manzana

function select_lotes($manzana, $super_manzana, $fase){
    $respuesta="";
	$consulta="SELECT id_lote, lote, m2 from lotes where mza LIKE '".$manzana."' AND super_manzana LIKE '".$super_manzana."' AND fase LIKE '".$fase."'";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_lotes' id='select_lotes' class='form-control' >";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            $respuesta.="<option value='".$fase."-".$super_manzana."-".$manzana."-".$registro['lote']."'>".$registro['lote']." - ".$registro['m2']."m2</option>";	
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select super manzana
?>
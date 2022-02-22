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
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta.="<select name='select_fase' id='select_fase' class='form-control' onchange='cargar_select_super_manzana(this.id)'>";//onchange='cargar_status()
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            $respuesta.="<option value='".$registro['fase']."'>".$registro['fase']."</option>";	
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select fase
?>
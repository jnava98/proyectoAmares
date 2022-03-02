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

function select_fase($fase){
    $respuesta="";
	$consulta="select distinct fase from lotes order by fase";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_fase' id='select_fase' class='form-control' onchange='cargar_select_super_manzana(this.id)'>";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            if($fase!=""){
                if($fase==$registro['fase']){
                    $respuesta.="<option value='".$registro['fase']."' selected>".$registro['fase']."</option>";	
                }else{
                    $respuesta.="<option value='".$registro['fase']."'>".$registro['fase']."</option>";	
                }//fin del else
            }else{
                $respuesta.="<option value='".$registro['fase']."'>".$registro['fase']."</option>";	
            }//fin del else
        }//Fin del while
        $respuesta.="</select>";
    }else{
        $respuesta.="<h3> Sin datos </h3>";
    }//fin del else
	return $respuesta;
}//fin de select fase

function select_super_manzana($fase,$super_manzana){
    $respuesta="";
	$consulta="SELECT DISTINCT super_manzana from lotes where fase LIKE '".$fase."'";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_super_manzana' id='select_super_manzana' class='form-control' onchange='cargar_select_manzana(this.id)'>";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            if($super_manzana!=""){
                if($super_manzana==$registro['super_manzana']){
                    $respuesta.="<option value='".$registro['super_manzana']."' selected>".$registro['super_manzana']."</option>";	
                }else{
                    $respuesta.="<option value='".$registro['super_manzana']."'>".$registro['super_manzana']."</option>";	
                }//fin del else
            }else{
                $respuesta.="<option value='".$registro['super_manzana']."'>".$registro['super_manzana']."</option>";	
            }//fin del else
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select super manzana

function select_manzana($super_manzana, $fase, $manzana){
    $respuesta="";
	$consulta="SELECT DISTINCT mza from lotes where super_manzana LIKE '".$super_manzana."' AND fase LIKE '".$fase."'";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_manzana' id='select_manzana' class='form-control' onchange='cargar_select_lotes(this.id)'>";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            if($manzana!=""){
                if($manzana==$registro['mza']){
                    $respuesta.="<option value='".$registro['mza']."' selected>".$registro['mza']."</option>";	
                }else{
                    $respuesta.="<option value='".$registro['mza']."'>".$registro['mza']."</option>";	
                }//fin del else
            }else{
                $respuesta.="<option value='".$registro['mza']."'>".$registro['mza']."</option>";	
            }//fin del else
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select super manzana

function select_lotes($manzana, $super_manzana, $fase, $lote){
    $respuesta="";
	$consulta="SELECT id_lote, lote, m2 from lotes where mza LIKE '".$manzana."' AND super_manzana LIKE '".$super_manzana."' AND fase LIKE '".$fase."'";
	$resultado=mysqli_query(conectar(),$consulta);
	desconectar();
    $num=mysqli_num_rows($resultado);
    if($num>0){
        $respuesta.="<select name='select_lotes' id='select_lotes' class='form-control' >";
        $respuesta.="<option value='0'>Elige una opcion</option>";
        while($registro=mysqli_fetch_array($resultado)){
            if($lote!=""){
                if($lote==$registro['lote']){
                    $respuesta.="<option value='".$registro['id_lote']."' selected>".$registro['lote']." - ".$registro['m2']."m2</option>";	
                }else{
                    $respuesta.="<option value='".$registro['id_lote']."'>".$registro['lote']." - ".$registro['m2']."m2</option>";	
                }//fin del else
            }else{
                $respuesta.="<option value='".$registro['id_lote']."'>".$registro['lote']." - ".$registro['m2']."m2</option>";	
            }//fin del else
        }//Fin del while
        $respuesta.="</select>";
    }//fin del if
	return $respuesta;
}//fin de select super manzana

function select_clientes(){
    $respuesta="";
    $sql="SELECT * from clientes order by apellido_paterno";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta.='<select id="select_clientes" class="form-control" >';
            $respuesta.='<option value="0" disabled selected>Selecciona una opcion</option>';
        while($col=mysqli_fetch_array($result)){
            $respuesta.="<option value='".$col['apellido_paterno']." ".$col['apellido_materno']." ".$col['nombre']."'>".$col['apellido_paterno']." ".$col['apellido_materno']." ".$col['nombre']."</option>";
        }//fin del while
        $respuesta.='</select>';
    }
    return $respuesta;
}//fin de select clientes

function select_estatus_venta($estatus_venta){
    $respuesta="";
    $sql="SELECT * from cat_estatus_venta";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta.='<select id="select_estatus_venta" class="form-control" >';
            $respuesta.='<option value="0">Selecciona una opcion</option>';
        while($col=mysqli_fetch_array($result)){
            if($estatus_venta!=""){
                if($estatus_venta==$col['id_estatus_venta']){
                    $respuesta.="<option value='".$col['id_estatus_venta']."' selected>".$col['nombre']."</option>";	
                }else{
                    $respuesta.="<option value='".$col['id_estatus_venta']."'>".$col['nombre']."</option>";	
                }//fin del else
            }else{
                $respuesta.="<option value='".$col['id_estatus_venta']."'>".$col['nombre']."</option>";	
            }//fin del else
        }//fin del while
        $respuesta.='</select>';
    }//fin del if
    return $respuesta;
}//fin de select estatus venta

function select_tipo_compra($id_tipo_compra){
    $respuesta="";
    $sql="SELECT * from cat_tipo_compra";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        $respuesta.='<select id="select_tipo_compra" class="form-control" >';
            $respuesta.='<option value="0">Selecciona una opcion</option>';
        while($col=mysqli_fetch_array($result)){
            if($id_tipo_compra!=""){
                if($id_tipo_compra==$col['id_tipo_compra']){
                    $respuesta.="<option value='".$col['id_tipo_compra']."' selected>".$col['nombre']."</option>";	
                }else{
                    $respuesta.="<option value='".$col['id_tipo_compra']."'>".$col['nombre']."</option>";	
                }//fin del else
            }else{
                $respuesta.="<option value='".$col['id_tipo_compra']."'>".$col['nombre']."</option>";	
            }//fin del else
        }//fin del while
        $respuesta.='</select>';
    }//fin del if
    return $respuesta;
}//fin de select estatus venta

function select_tipo_reporte(){
    $respuesta="";
    $respuesta.='<select id="select_tipo_reporte" name="select_tipo_reporte" class="form-control" onchange="mostrar_input_fecha()">';
    $respuesta.='<option value="0">Selecciona una opcion</option>';
    $respuesta.='<option value="clientes">Clientes</option>';
    $respuesta.='<option value="lotes">Lotes</option>';
    $respuesta.='<option value="ventas_mensuales">Ventas Mensuales</option>';
    $respuesta.='</select>';
    return $respuesta;
}//fin de select estatus venta
?>
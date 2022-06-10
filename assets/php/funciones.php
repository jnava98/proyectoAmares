<?php
function mostrar_tabla_usuarios(){
    $html="";
    $sql="SELECT * FROM cuentas_usuario order by usuario";
    $result_usuarios=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result_usuarios);
    if ($num>0){
        $i=0;
        $html.="<h4>Tabla de usuarios</h4>"; 
        $html.="<table id='tabla_usuarios' class='table.table-striped table-bordered table-hover table-condensed'>";
            $html.="<thead>";
                $html.="<tr>";
                    $html.="<th style='text-align:center'>#</th>";
                    $html.="<th style='text-align:center'>Usuario</th>";
                    $html.="<th style='text-align:center'>Contraseña</th>";
                    $html.="<th style='text-align:center'>Nombre</th>";
                    $html.="<th style='text-align:center'>Acciones</th>";
                $html.="</tr>";
            $html.="</thead>";
            $html.="<tbody>";
            while($col_usuarios=mysqli_fetch_array($result_usuarios)){
                $i+=1;
                $html.="<tr>";
                    $html.="<td style='text-align:center'>".$i."</td>";
                    $html.="<td><input disabled='disabled' class='form-control' name='input_usuario&".$i."' id='input_usuario&".$i."' value='".$col_usuarios['usuario']."'></input></td>";
                    $html.="<td><input disabled='disabled' class='form-control' name='input_password&".$i."' id='input_password&".$i."' value='".$col_usuarios['password']."'></input></td>";
                    $html.="<td><input disabled='disabled' class='form-control' name='input_nombre&".$i."' id='input_nombre&".$i."' value='".$col_usuarios['nombre']."'></input></td>";
                    $html.="<td>";
                        $html.="<button id='".$col_usuarios['id_usuario']."' onclick='editar_usuario(this.id);return false;'><span class='glyphicon glyphicon-edit' style='font-size:15px'></span></button>";
                        $html.="&nbsp;&nbsp;<button id='".$col_usuarios['id_usuario']."' onclick='actualizar_usuario(this.id);return false;'><span class='glyphicon glyphicon-floppy-saved' style='font-size:15px'></span></button>";
                        $html.="&nbsp;&nbsp;<button id='".$col_usuarios['id_usuario']."' onclick='eliminar_usuario(this.id);return false;'><span class='glyphicon glyphicon-trash' style='font-size:15px'></span></button>";
                    $html.="</td>";
                $html.="</tr>";
            }//Fin del while
            $html.="<input type='hidden' id='total_usuarios' name='total_usuarios' value='".$i."'>";
            $html.="</tbody>";    
            $html.="</table>";
    }//Fin del if..
    return $html;
}//fin de mostrar tabla usuarios

function mostrar_formato_cliente_vacio(){
    $html="";
    $html.='<div id="div_cliente" class="col-lg-12">';
        $html.='<div class="card">';
            $html.='<div class="card-body">';
                $html.='<h5 class="card-title">Datos del cliente</h5>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Nombre <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre (s) del cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="nombre_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Ape Pat <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Apellido paterno del cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="apellidopa_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Ape Mat <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Apellido materno del cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                    $html.='<input type="text" class="form-control" id="apellidoma_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Residencia <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Lugar donde reside el cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="residencia_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Nacionalidad <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Nación o territorio en el que vive el cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="nacionalidad_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputEmail" class="col-sm-2 col-form-label">Correo <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Correo electrónico de contacto"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="email" class="form-control" id="correo_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputEmail" class="col-sm-2 col-form-label">Dirección <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Dirección del cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="email" class="form-control" id="direccion_cliente" value="">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputPassword" class="col-sm-2 col-form-label">Telefono <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Teléfono de contacto"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="telefono_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Estado Civil <span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Situación de la persona determinada por sus relaciones de familia, provenientes del matrimonio o del parentesco"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="estadoc_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<label for="inputText" class="col-sm-2 col-form-label">Actividad Económica<span class="bi bi-question-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Labor o actividad a la que se dedica el cliente"></span></label>';
                    $html.='<div class="col-sm-10">';
                        $html.='<input type="text" class="form-control" id="act_cliente">';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-3">';
                    $html.='<div class="col-sm-9">';
                        $html.='<button type="button" class="btn boton_uno" onclick="guardar_datos_cliente();">Guardar Datos Cliente</button>';
                    $html.='</div>';
                $html.='</div>';
            $html.='</div>';
        $html.='</div>';
    $html.='</div>';
    return $html;
}//fin de mostrar formato cliente vacio

function mostrar_formato_cliente($id_cliente){
    $html="";
    $sql="SELECT * from clientes where id_cliente LIKE '".$id_cliente."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col=mysqli_fetch_array($result)){
            $html.='<div id="div_cliente" class="col-lg-12">';
                $html.='<div class="card">';
                    $html.='<div class="card-body">';
                        $html.='<h5 class="card-title">Datos del cliente</h5>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Nombre</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="nombre_cliente" value="'.$col['nombre'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Ape Pat</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="apellidopa_cliente" value="'.$col['apellido_paterno'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Ape Mat</label>';
                            $html.='<div class="col-sm-10">';
                            $html.='<input type="text" class="form-control" id="apellidoma_cliente" value="'.$col['apellido_materno'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Residencia</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="residencia_cliente" value="'.$col['residencia'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Nacionalidad</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="nacionalidad_cliente" value="'.$col['nacionalidad'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputEmail" class="col-sm-2 col-form-label">Correo</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="email" class="form-control" id="correo_cliente" value="'.$col['correo'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputEmail" class="col-sm-2 col-form-label">Dirección</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="email" class="form-control" id="direccion_cliente" value="'.$col['direccion'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputPassword" class="col-sm-2 col-form-label">Telefono</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="telefono_cliente" value="'.$col['telefono'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Estado Civil</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="estadoc_cliente" value="'.$col['estado_civil'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<label for="inputText" class="col-sm-2 col-form-label">Actividad Económica</label>';
                            $html.='<div class="col-sm-10">';
                                $html.='<input type="text" class="form-control" id="act_cliente" value="'.$col['act_economica'].'">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-3">';
                            $html.='<div class="col-sm-9">';
                                $html.='<button type="button" class="btn boton_uno" onclick="guardar_datos_cliente();">Guardar Datos Cliente</button>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
            $html.='</div>';
        }//fin del while
    }else{
        $html="";
    }//fin del else
    return $html;
}//fin de mostrar formato cliente vacio

function mostrar_formato_precontrato_vacio($input_cliente){
    $html="";
    $html.='<div id="div_precontrato" class="col-lg-12">';
        $html.='<div class="card">';
            $html.='<div class="card-body">';
                $html.='<h3 class="card-title">Datos de la Compra</h3>';
                $html.='<input type="hidden" id="id_contrato" value="">';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Descripci&oacuten de la Propiedad</p>';
                    $html.='<div class="col-sm-3">';
                        $html.='<label for="inputText" class="col-form-label">Fase</label><label style="color:red;">*</label>';
                    $html.='</div>';    
                    $html.='<div class="col-sm-3">';
                        $html.='<label for="inputText" class="col-form-label">Super Manzana</label><label style="color:red;">*</label>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<label for="inputText" class="col-form-label">Manzana</label><label style="color:red;">*</label>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<label for="inputText" class="col-form-label">Lote</label><label style="color:red;">*</label>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<div class="row mb-12">';
                    $html.='<div class="col-sm-3">';
                        $html.=select_fase("");
                    $html.='</div>';
                    $html.='<div id="div_select_super_manzana" class="col-sm-3">';
                        $html.=select_super_manzana("", "");
                    $html.='</div>';
                    $html.='<div id="div_select_manzana" class="col-sm-3">';
                        $html.=select_manzana("", "", "");
                    $html.='</div>';
                    $html.='<div id="div_select_lote" class="col-sm-3">';
                        $html.=select_lotes("", "", "", "");
                    $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Tipo de compra</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-5">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Descuentos</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.=select_tipo_compra("");
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-5">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-8">';
                                $html.=select_descuentos();
                            $html.='</div>';
                            $html.='<div class="col-sm-4">';
                                $html.='<button type="button" id="btn_agregarResponsable" class="btn boton_cuatro" onclick="agregar_descuento();cargar_precio_recomendado();">+</button>&nbsp';
                                $html.='<button type="button" class="btn boton_cinco" id="btn_quitarResposable" onclick="quitar_descuento();cargar_precio_recomendado();">-</button>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Descuentos Aplicados</p>';
                    $html.='<div class="col-sm-6">';
                        $html.='<textarea id="desc_aplicados" name="desc_aplicados" class="form-control" disabled></textarea>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Precio de lista</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Precio Recomendado</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Precio de venta</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="precio_lista" value="" disabled>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="precio_recomendado" value="" disabled>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-md-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="precio_venta" value="" onblur="validar_precio_venta(this.id)" disabled>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Observaciones</p>';
                    $html.='<div class="col-sm-12">';
                        $html.='<textarea id="observaciones" class="form-control"></textarea>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<hr>';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Datos Apartado</p>';
                        $html.='<div class="col-sm-4">';
                            $html.='<div class="row">';
                                $html.='<div class="col-sm-12">';
                                    $html.='<label for="inputText" class="col-form-label">Cantidad Apartado</label>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="col-sm-4">';
                            $html.='<div class="row">';
                                $html.='<div class="col-sm-12">';
                                    $html.='<label for="inputDate" class="col-form-label">Fecha pago apartado</label>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="col-sm-4">';
                            $html.='<div class="row">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="col-sm-4">';
                            $html.='<div class="row">';
                                $html.='<div class="col-sm-12">';
                                    $html.='<input type="number" class="form-control" id="cant_apartado" value="">';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="col-sm-4">';
                            $html.='<div class="row">';
                                $html.='<div class="col-sm-12">';
                                    $html.='<input type="date" class="form-control" id="fecha_apartado" value="">';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="col-sm-4">';
                            $html.='<div class="row">';
                            $html.='</div>';
                        $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Datos Enganche</p>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Cantidad enganche</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputDate" class="col-form-label">Fecha pago enganche</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">N. Mensualidades Enganche</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Monto Mensual Enganche</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="cant_enganche" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="date" class="form-control" id="fecha_enganche" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="men_enganche" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="cant_mensual_enganche" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Datos de los pagos</p>';
                    $html.='<div id="div_n_mensualidades" class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">No. de mensualidades</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div id="div_monto_mensual" class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Monto mensual</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Pago final</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputDate" class="col-form-label">D&iacute;a primer pago</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';   
                $html.='<div class="row mb-12">';
                    $html.='<div id="div_n_mensualidades2" class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="n_mensualidades" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div id="div_input_monto_mensual" class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="monto_mensual" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="pago_final" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-3">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="date" class="form-control" id="dia_pago" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<div class="col-sm-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Inter&eacutes (%)</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Nombre del Broker</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<label for="inputText" class="col-form-label">Comisi&oacuten Broker ($)</label>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="tasa_interes" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="text" class="form-control" id="nombre_broker" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                    $html.='<div class="col-sm-4">';
                        $html.='<div class="row">';
                            $html.='<div class="col-sm-12">';
                                $html.='<input type="number" class="form-control" id="comision_broker" value="">';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
                /////
                $html.='<br>';
                $html.='<div class="row mb-12">';
                    $html.='<p class="card-text">Clientes<label style="color:red;">*</label></p>';
                    $html.='<div class="col-sm-4">';
                        $html.=select_clientes();
                    $html.='</div>';
                    $html.='<div class="col-sm-2">';
                        $html.='<button type="button" id="btn_agregarResponsable" class="btn boton_cuatro" onclick="agregar_cliente()">+</button>&nbsp';
                        $html.='<button type="button" class="btn boton_cinco" id="btn_quitarResposable" onclick="quitar_cliente()">-</button>';
                    $html.='</div>';
                    $html.='<div class="col-sm-6">';
                        $html.='<textarea id="txtArea_clientes" disabled class="form-control">'.$input_cliente.'</textarea>';
                    $html.='</div>';
                $html.='</div>'; 
                $html.='<br>';
                $html.='<div class="row mb-3">';
                    $html.='<div class="col-sm-12">';
                        $html.='<button type="button" class="btn boton_uno" onclick="guardar_datos_precontrato();">Guardar Datos Compra</button>&nbsp';
                        $html.='<button type="button" class="btn boton_dos" onclick="cargar_datos_contrato();">Registrar datos contrato</button>';
                    $html.='</div>';
                $html.='</div>';
            $html.='</div>';
        $html.='</div>';
    $html.='</div>';
    return $html;
}//fin de mostrar formato precontrato

function mostrar_formato_precontrato($id_contrato){
    $html="";
    $sql="SELECT * from contrato where id_contrato LIKE '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col=mysqli_fetch_array($result)){
            $sql="SELECT fase, super_manzana, mza, lote, precio_lista FROM lotes where id_lote LIKE '".$col['id_lote']."'";
            //echo $sql;
            $resultado=mysqli_query(conectar(),$sql);
            desconectar();
            $num=mysqli_num_rows($resultado);
            if($num>0){
                $col_lotes = mysqli_fetch_array($resultado);
                $fase = $col_lotes['fase'];
                $super_manzana = $col_lotes['super_manzana'];
                $manzana = $col_lotes['mza'];
                $lote = $col_lotes['lote'];
                $precio_lista = $col_lotes['precio_lista'];
            }else{
                $fase = "";
                $super_manzana = "";
                $manzana = "";
                $lote = "";
                $precio_lista = "";
            }//fin del else
            $html.='<div id="div_precontrato" class="col-lg-12">';
                $html.='<div class="card">';
                    $html.='<div class="card-body">';
                        $html.='<h3 class="card-title">Datos de la Compra</h3>';
                        $html.='<input type="hidden" id="id_contrato" value="'.$col['id_contrato'].'">';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Descripci&oacuten de la Propiedad</p>';
                            $html.='<div class="col-sm-3">';
                                $html.='<label for="inputText" class="col-form-label">Fase</label><label style="color:red;">*</label>';
                            $html.='</div>';    
                            $html.='<div class="col-sm-3">';
                                $html.='<label for="inputText" class="col-form-label">Super Manzana</label><label style="color:red;">*</label>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<label for="inputText" class="col-form-label">Manzana</label><label style="color:red;">*</label>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<label for="inputText" class="col-form-label">Lote</label><label style="color:red;">*</label>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<div class="row mb-12">';
                            $html.='<div class="col-sm-3">';
                                $html.=select_fase($fase);
                            $html.='</div>';
                            $html.='<div id="div_select_super_manzana" class="col-sm-3">';
                                $html.=select_super_manzana($fase, $super_manzana);
                            $html.='</div>';
                            $html.='<div id="div_select_manzana" class="col-sm-3">';
                                $html.=select_manzana($super_manzana, $fase, $manzana);
                            $html.='</div>';
                            $html.='<div id="div_select_lote" class="col-sm-3">';
                                $html.=select_lotes($manzana, $super_manzana, $fase, $lote);
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Tipo de compra</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-5">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Descuentos</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.=select_tipo_compra($col['id_tipo_compra']);
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';    
                            $html.='<div class="col-md-5">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-8">';
                                        $html.=select_descuentos();
                                    $html.='</div>';
                                    $html.='<div class="col-sm-4">';
                                        $html.='<button type="button" id="btn_agregarResponsable" class="btn boton_cuatro" onclick="agregar_descuento();cargar_precio_recomendado();">+</button>&nbsp';
                                        $html.='<button type="button" class="btn boton_cinco" id="btn_quitarResposable" onclick="quitar_descuento();cargar_precio_recomendado();">-</button>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Descuentos Aplicados</p>';
                            $html.='<div class="col-sm-6">'; 
                                $desc_aplicados = "";
                                $sql = "SELECT * from descuentos_contrato where id_contrato like '".$id_contrato."'";
                                $resultado = mysqli_query(conectar(),$sql);
                                desconectar();
                                $num = mysqli_num_rows($resultado);
                                if($num>0){
                                    $aux = 0;     
                                    while($row = mysqli_fetch_array($resultado)){
                                        $sql="SELECT descripcion FROM cat_descuentos where id_descuento like '".$row['id_descuento']."'";
                                        $resultado_descuentos = mysqli_query(conectar(),$sql);
                                        desconectar();
                                        $num = mysqli_num_rows($resultado_descuentos);
                                        if($num>0){
                                            $row_descuentos = mysqli_fetch_array($resultado_descuentos);
                                            if($aux!=0){
                                                $desc_aplicados.= ",".$row_descuentos[0];
                                            }else{
                                                $desc_aplicados.= $row_descuentos[0];
                                            }//fin del else
                                        }//fin del if
                                        $aux++;
                                    }//fin del while
                                }//fin del if
                                $html.='<textarea id="desc_aplicados" name="desc_aplicados" class="form-control" disabled>'.$desc_aplicados.'</textarea>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Precio de lista</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Precio Recomendado</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Precio de venta</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="precio_lista" value="'.$precio_lista.'" disabled>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="precio_recomendado" value="'.$precio_lista.'" disabled>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-md-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="precio_venta" value="'.$col['precio_venta'].'" onblur="validar_precio_venta(this.id)">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Observaciones</p>';
                            $html.='<div class="col-sm-12">';
                                $html.='<textarea id="observaciones" class="form-control">'.$col['observaciones'].'</textarea>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<hr>';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Datos Apartado</p>';
                                $html.='<div class="col-sm-4">';
                                    $html.='<div class="row">';
                                        $html.='<div class="col-sm-12">';
                                            $html.='<label for="inputText" class="col-form-label">Cantidad Apartado</label>';
                                        $html.='</div>';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="col-sm-4">';
                                    $html.='<div class="row">';
                                        $html.='<div class="col-sm-12">';
                                            $html.='<label for="inputDate" class="col-form-label">Fecha pago apartado</label>';
                                        $html.='</div>';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="col-sm-4">';
                                    $html.='<div class="row">';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="col-sm-4">';
                                    $html.='<div class="row">';
                                        $html.='<div class="col-sm-12">';
                                            $html.='<input type="number" class="form-control" id="cant_apartado" value="'.$col['cant_apartado'].'">';
                                        $html.='</div>';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="col-sm-4">';
                                    $html.='<div class="row">';
                                        $html.='<div class="col-sm-12">';
                                            $html.='<input type="date" class="form-control" id="fecha_apartado" value="'.$col['fecha_apartado'].'">';
                                        $html.='</div>';
                                    $html.='</div>';
                                $html.='</div>';
                                $html.='<div class="col-sm-4">';
                                    $html.='<div class="row">';
                                    $html.='</div>';
                                $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Datos Enganche</p>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Cantidad enganche</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputDate" class="col-form-label">Fecha pago enganche</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">N. Mensualidades Enganche</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Monto Mensual Enganche</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="cant_enganche" value="'.$col['cant_enganche'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="date" class="form-control" id="fecha_enganche" value="'.$col['fecha_enganche'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="men_enganche" value="'.$col['mensualidades_enganche'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="cant_mensual_enganche" value="'.$col['cant_mensual_enganche'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Datos de los pagos</p>';
                            $html.='<div id="div_n_mensualidades" class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">No. de mensualidades</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div id="div_monto_mensual" class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Monto mensual</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Pago final</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputDate" class="col-form-label">D&iacute;a primer pago</label><label style="color:red;">*</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';   
                        $html.='<div class="row mb-12">';
                            $html.='<div id="div_n_mensualidades2" class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" id="n_mensualidades" class="form-control" value="'.$col['mensualidades'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div id="div_input_monto_mensual" class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="monto_mensual" value="'.$col['monto_mensual'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="pago_final" value="'.$col['pago_final'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="date" class="form-control" id="dia_pago" value="'.$col['dia_pago'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<div class="col-sm-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Inter&eacutes (%)</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Nombre del Broker</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<label for="inputText" class="col-form-label">Comisi&oacuten Broker ($)</label>';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="tasa_interes" value="'.$col['tasa_interes'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="text" class="form-control" id="nombre_broker" value="'.$col['nombre_broker'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                            $html.='<div class="col-sm-4">';
                                $html.='<div class="row">';
                                    $html.='<div class="col-sm-12">';
                                        $html.='<input type="number" class="form-control" id="comision_broker" value="'.$col['comision_broker'].'">';
                                    $html.='</div>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</div>';
                        /////
                        $html.='<br>';
                        $html.='<div class="row mb-12">';
                            $html.='<p class="card-text">Clientes<label style="color:red;">*</label></p>';
                            $html.='<div class="col-sm-4">';
                                $html.=select_clientes();
                            $html.='</div>';
                            $html.='<div class="col-sm-2">';
                                $html.='<button type="button" id="btn_agregarResponsable" class="btn boton_cuatro" onclick="agregar_cliente()">+</button>&nbsp';
                                $html.='<button type="button" class="btn boton_cinco" id="btn_quitarResposable" onclick="quitar_cliente()">-</button>';
                            $html.='</div>';
                            $html.='<div class="col-sm-6">';
                                $html.='<textarea id="txtArea_clientes" disabled class="form-control">'.$col['clientes'].'</textarea>';
                            $html.='</div>';
                        $html.='</div>'; 
                        $html.='<br>';
                        $html.='<div class="row mb-3">';
                            $html.='<div class="col-sm-12">';
                                $html.='<button type="button" class="btn boton_uno" onclick="guardar_datos_precontrato();">Guardar Datos Compra</button>&nbsp';
                                $html.='<button type="button" class="btn boton_dos" onclick="cargar_datos_contrato();">Registrar datos contrato</button>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
            $html.='</div>';
        }//fin del while
    }else{
        $html="";
    }//fin del else
    return $html;
}//fin de mostrar formato precontrato

function mostrar_formato_contrato($id_contrato){
    $html="";
    $sql="SELECT * from contrato WHERE id_contrato LIKE '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        while($col=mysqli_fetch_array($result)){
            $html="";
            $html.='<div id="div_contrato" class="col-lg-12">';
                $html.='<div class="card">';
                    $html.='<div class="card-body">';
                        $html.='<h5 class="card-title">Datos del contrato</h5>';
                        $html.='<div class="row mb-12">';
                            $html.='<div class="col-sm-2">';
                            $html.='<label for="inputDate" class="col-form-label">Fecha Contrato</label>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                            $html.='<input type="date" class="form-control" id="fecha_contrato" value="'.$col['fecha_contrato'].'">';
                            $html.='</div>';
                            $html.='<div class="col-sm-1">';
                            $html.='</div>';
                            $html.='<div class="col-sm-2">';
                            $html.='<label for="inputDate" class="col-form-label">Fecha firma</label>';
                            $html.='</div>';
                            $html.='<div class="col-sm-3">';
                            $html.='<input type="date" class="form-control" id="fecha_firma" value="'.$col['fecha_firma'].'">';
                            $html.='</div>';
                            $html.='<div class="col-sm-1">';
                            $html.='</div>';
                        $html.='</div>';
                        $html.='<br>';
                        $html.='<div class="row mb-3">';
                            $html.='<div class="col-sm-9">';
                                $html.='<button type="button" class="btn boton_uno" onclick="guardar_datos_contrato();">Guardar Contrato</button>';
                            $html.='</div>';
                        $html.='</div>';
                    $html.='</div>';
                $html.='</div>';
            $html.='</div>';
        }//fin del while
    }//fin del if
    return $html;
}//fin de mostrar formato contrato

function mostrar_tabla_contratos($id_cliente){
    $html="";
    $sql="SELECT c.id_cliente, co.id_contrato, co.fecha_contrato, lo.fase, lo.super_manzana, lo.mza, lo.lote, ev.nombre from clientes as c inner join cliente_contrato as cc ON c.id_cliente = cc.id_cliente inner join contrato as co on cc.id_contrato = co.id_contrato inner join lotes as lo on co.id_lote = lo.id_lote inner join cat_estatus_venta as ev on co.id_estatus_venta = ev.id_estatus_venta WHERE c.id_cliente LIKE '".$id_cliente."' order by co.id_contrato"; //Consultar id de la variable
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result);
    if ($num>0){
        $i=1;
        $html.='<h5 class="card-title">Contratos del Cliente</h5>';
        $html.="<table id='tabla_contratos' class='table table-responsive table-bordered table-striped table-hover table-condensed'>";
            $html.="<thead>";
                $html.="<tr>";
                    $html.="<th style='text-align:center'>#</th>";
                    $html.="<th style='text-align:center'>Lotes Comprados</th>";
                    $html.="<th style='text-align:center'>Estatus</th>";
                    $html.="<th style='text-align:center'>Acciones</th>";
                $html.="</tr>";
            $html.="</thead>";
            $html.="<tbody>";
            while($col=mysqli_fetch_array($result)){
                $html.="<tr>";
                    $html.="<td style='text-align:center'>".$i."</td>";
                    $html.="<td style='text-align:center'><input style='text-align:center' disabled='disabled' class='form-control' value='(".$col['fase']."-".$col['super_manzana']."-".$col['mza']."-".$col['lote'].")'></input></td>";
                    $html.="<td style='text-align:center'><input style='text-align:center' disabled='disabled' class='form-control' value='".$col['nombre']."'></input></td>";
                    //Botones para las acciones
                    $html.="<td style='text-align:center'>";
                        $html.="<button id='".$col['id_contrato']."' class='btn btn-sm boton_uno' onclick='cargar_datos_precontrato(this.id);'>Editar</button>";
                        $html.="&nbsp;<button id='".$col['id_contrato']."' class='btn btn-sm boton_dos' onclick='eliminar_contrato(this.id);'>Eliminar</button>";
                        $html.="&nbsp;<button id='".$col['id_contrato']."' class='btn btn-sm boton_tres' onclick='imprimir_contrato(this.id);'>Imprimir</button>";
                    $html.="</td>";
                $html.="</tr>";
                $i++;
            }//Fin del while
            $html.="</tbody>";    
        $html.="</table>";
    }//Fin del if..
    return $html;
}//fin de mostrar tabla usuarios

function mostrar_formato_impresion($id_contrato){
    $html="";
    $sql="SELECT * from contrato where id_contrato like '".$id_contrato."'";
    $result=mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col = mysqli_fetch_array($result);
        $html.='
        <form target="_blank" action="?page=impresion_contrato" method="POST">
            <input id="input_impresion_contrato" name="input_impresion_contrato" value="'.$id_contrato.'" type="hidden">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row" >
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label>Idioma del Contrato:</label>';  
                    $html.='</div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">';
                        $html.=select_idioma_contrato();
                    $html.='</div>
                </div>';
                if($col['cant_apartado']!="0"){
                    $precio_venta = $col['precio_venta'];
                    $cant_apartado = $col['cant_apartado'];
                    $aux = $cant_apartado*100;
                    $aux = $aux/$precio_venta;
                    $aux = number_format($aux, 2);

                    //$aux = $aux/100;
                    $html.='
                <div class="row" >
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label>% de Apartado:</label>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <input id="porcentaje_apartado" name="porcentaje_apartado" class="form-control" value="'.$aux.'"/>
                    </div>
                </div>';
                }//fin del if
                $precio_venta = $col['precio_venta'];
                    $cant_enganche = $col['cant_enganche'];
                    $aux_enganche = $cant_enganche*100;
                    $aux_enganche = $aux_enganche/$precio_venta;
                    $aux_enganche = number_format($aux_enganche, 2);
                $html.='
                <div class="row" >
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label>% de Enganche:</label>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <input id="porcentaje_enganche" name="porcentaje_enganche" class="form-control" value="'.$aux_enganche.'"/>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label>Fecha de Entrega del Lote:</label>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" value=""/>
                    </div>
                </div>
                <div class="row" id="div_deposito_garantia">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label>Dep&oacute;sito de Garant&iacute;a:</label>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <input id="deposito_garantia" name="deposito_garantia" class="form-control" value=""/>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <button type="submit" id="enviar_formulario_impresion" class="btn boton_uno" >Imprimir</button>
                    </div>
                </div>
            </div>
        </form>';
    }else{

    }//fin del else
    return $html;
}//fin de mostrar formato impresion

function validar_datos_precontrato($id_contrato){
    $respuesta = "";
    $sql="SELECT fecha_enganche, cant_enganche FROM contrato where id_contrato LIKE '".$id_contrato."'";
    $result = mysqli_query(conectar(),$sql);
    desconectar();
    $num = mysqli_num_rows($result);
    if($num>0){
        $col = mysqli_fetch_array($result);
        $enganche = $col['cant_enganche'];
        $fecha_enganche = $col['fecha_enganche'];
        if($enganche!=0){
            $respuesta = "ok";
        }else{
            $respuesta = "error";
        }//fin del else
    }else{
        $respuesta = "error";
    }//fin del else
    return $respuesta;
}//fin de validar datos precontrato


function mostrar_tabla_descuentos()
{
    $html="";
    $sql = "SELECT * FROM cat_descuentos d inner join cuentas_usuario u on d.uc=u.id_usuario order by id_descuento";
    $result_descuentos = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result_descuentos);
    if ($num>0) {     
        $i=0;
        $html.="<h4>Tabla de descuentos</h4>";
        $html.="<table id='tabla_descuentos' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer col-md-12 col-lg-12'>";
        $html.="<thead>";
        $html.="<tr>";
        $html.="<th class='text-center '>#</th>";
        $html.="<th class='text-center '>Nombre</th>";
        $html.="<th class='text-center '>Tasa (%)</th>";
        $html.="<th class='text-center '>Fecha <br>Creacion</th>";
        $html.="<th class='text-center '>Fecha <br>Modificacion</th>";
        // $html.="<th class='text-center '>Usuario <br>creacion</th>";
        $html.="<th class='text-center '>Ultima <br>Modificacion</th>";
        $html.="<th class='text-center ' style='width: 200.052px;'>Acciones</th>";
        $html.="</tr>";
        $html.="</thead>";
        $html.="<tbody>";
        while ($col_descuentos=mysqli_fetch_array($result_descuentos)) {
            $i+=1;
            $html.="<tr>";
            $html.="<td class='text-center'>".$i."</td>";
            //DESCRIPCION DESCUENTO
            $html.="<td  ><input disabled='disabled' class='form-control text-center' name='input_descripcion&".$col_descuentos['id_descuento']."' id='input_descripcion&".$col_descuentos['id_descuento']."' value='".$col_descuentos['descripcion']."'></input></td>";
            //TASA DESCUENTO
            $html.="<td><input type='number' disabled='disabled' class='form-control text-center' name='input_tasa&".$col_descuentos['id_descuento']."' id='input_tasa&".$col_descuentos['id_descuento']."' value='".$col_descuentos['tasa']."'></input></td>";
            //FECHA CREACION
            $html.="<td ><input disabled='disabled' class='form-control text-center' name='input_fcreacion&".$col_descuentos['id_descuento']."' id='input_fcreacion&".$col_descuentos['id_descuento']."' value='".$col_descuentos['fecha_creacion']."'></input></td>";
            //FECHA MODIFICACION
            $html.="<td><input  disabled='disabled' class='form-control text-center' name='input_fmodificacion&".$col_descuentos['id_descuento']."' id='input_fmodificacion&".$col_descuentos['id_descuento']."' value='".$col_descuentos['fecha_modificacion']."'></input></td>";
            //USUARIO CREACION
            // $html.="<td><input disabled='disabled' class='form-control' name='input_usuariocreacion&".$i."' id='input_usuariocreacion&".$i."' value='".$col_descuentos['usuario']."'></input></td>";
            //USUARIO ULTIMA MODIFICACION
            $sql2 = "SELECT d.id_descuento,d.uum,u.id_usuario,u.usuario FROM cat_descuentos d inner join cuentas_usuario u on d.uum=u.id_usuario where d.id_descuento='".$col_descuentos['id_descuento']."' order by fecha_creacion";
            $result_descuentos2 = mysqli_query(conectar(),$sql2);
            while ($col_descuentos2=mysqli_fetch_array($result_descuentos2)) {
            $html.="<td><input disabled='disabled' class='form-control text-center' name='input_usuariomodificacion&".$col_descuentos['id_descuento']."' id='input_usuariomodificacion&".$col_descuentos['id_descuento']."' value='".$col_descuentos2['usuario']."'></input></td>";
            }
            $html.="<td style='text-align:center'>";
            //BTN EDITAR DESCUENTO
            //$html.="<button id='".$col_descuentos['id_descuento']."' onclick='editar_descuento(this.id); return false;'><span class='glyphicon glyphicon-edit' style='font-size:15px'></span></button>";
            $html.="<input  type='button' id='".$col_descuentos['id_descuento']."' onclick='editar_descuento(this.id); return false;' class='btn boton_uno fontsize-btn p-botones' value='Editar'></input>";
            //BTN GUARDAR
            $html.="<input type='button' id='".$col_descuentos['id_descuento']."' onclick='actualizar_descuento(this.id); return false;' class='btn boton_tres fontsize-btn p-botones' style='margin-left:5px;' value='Guardar'></input>";
            //BTN ELIMINAR
            $html.="<input  type='button' id='".$col_descuentos['id_descuento']."'  onclick='eliminar_descuento(this.id); return false;' class='btn boton_dos fontsize-btn p-botones'  style='margin-left:5px;' value='Eliminar'></input>";
            $html.="</td>";
            $html.="</tr>";
        }//Fin del while
        $html.="<input type='hidden' id='total_descuentos' name='total_descuentos' value='".$i."'>";
        $html.="</tbody>";
        $html.="</table>";
    }//Fin del if..
    return $html;
}//fin de mostrar tabla descuentos


function mostrar_tabla_cuentas_bancarias()
{
    $html="";
    $sql = "SELECT * FROM cat_cuentas_bancarias cb order by id_cuenta_bancaria";
    $result_cuentas = mysqli_query(conectar(),$sql);
    desconectar();
    $num=mysqli_num_rows($result_cuentas);
    if ($num>0) {     
        $i=0;
        $html.="<h4>Tabla de cuentas bancarias</h4>";
        $html.="<table id='tabla_cuentas_bancarias' class='table table-responsive table-bordered table-striped table-hover table-condensed dataTable no-footer col-md-12 col-lg-12'>";
        $html.="<thead>";
        $html.="<tr>";
        $html.="<th class='text-center '>#</th>";
        $html.="<th class='text-center '>Identifcador Cuenta</th>";
        $html.="<th class='text-center '>Banco</th>";
        $html.="<th class='text-center '>Divisa</th>";
        $html.="<th class='text-center '>Ultima <br>Modificacion</th>";
        $html.="<th class='text-center ' style='width: 200.052px;'>Acciones</th>";
        $html.="</tr>";
        $html.="</thead>";
        $html.="<tbody>";
        while ($col_cuentas=mysqli_fetch_array($result_cuentas)) {
            $i+=1;
            $html.="<tr>";
            $html.="<td class='text-center'>".$i."</td>";
            //IDENTIFICADOR CUENTA
            $html.="<td  ><input disabled='disabled' class='form-control text-center' name='input_identificador&".$col_cuentas['id_cuenta_bancaria']."' id='input_identificador&".$col_cuentas['id_cuenta_bancaria']."' value='".$col_cuentas['identificador_cuenta']."'></input></td>";
            //BANCO
            $html.="<td><input type='text' disabled='disabled' class='form-control text-center' name='input_banco&".$col_cuentas['id_cuenta_bancaria']."' id='input_banco&".$col_cuentas['id_cuenta_bancaria']."' value='".$col_cuentas['banco']."'></input></td>";
             //DIVISA
             $html.="<td><input type='text' disabled='disabled' class='form-control text-center' name='input_divisa&".$col_cuentas['id_cuenta_bancaria']."' id='input_divisa&".$col_cuentas['id_cuenta_bancaria']."' value='".$col_cuentas['divisa']."'></input></td>";
            //USUARIO CREACION
            // $html.="<td><input disabled='disabled' class='form-control' name='input_usuariocreacion&".$i."' id='input_usuariocreacion&".$i."' value='".$col_descuentos['usuario']."'></input></td>";
            //USUARIO ULTIMA MODIFICACION
            $sql2 = "SELECT cb.id_cuenta_bancaria,cb.uum,u.id_usuario,u.usuario FROM cat_cuentas_bancarias cb inner join cuentas_usuario u on cb.uum=u.id_usuario where cb.id_cuenta_bancaria='".$col_cuentas['id_cuenta_bancaria']."' order by fecha_creacion";
            $result_cuentas2 = mysqli_query(conectar(),$sql2);
            while ($col_cuentas2=mysqli_fetch_array($result_cuentas2)) {
            $html.="<td><input disabled='disabled' class='form-control text-center' name='input_usuariomodificacion&".$col_cuentas['id_cuenta_bancaria']."' id='input_usuariomodificacion&".$col_cuentas['id_cuenta_bancaria']."' value='".$col_cuentas2['usuario']."'></input></td>";
            }
            $html.="<td style='text-align:center'>";
            //BTN EDITAR CUENTA
            $html.="<input  type='button' id='".$col_cuentas['id_cuenta_bancaria']."' onclick='editar_cuenta_bancaria(this.id); return false;' class='btn boton_uno fontsize-btn p-botones' value='Editar'></input>";
            //BTN GUARDAR
            $html.="<input type='button' id='".$col_cuentas['id_cuenta_bancaria']."' onclick='actualizar_cuenta_bancaria(this.id); return false;' class='btn boton_tres fontsize-btn p-botones' style='margin-left:5px;' value='Guardar'></input>";
            //BTN ELIMINAR
            $html.="<input  type='button' id='".$col_cuentas['id_cuenta_bancaria']."'  onclick='eliminar_cuenta(this.id); return false;' class='btn boton_dos fontsize-btn p-botones'  style='margin-left:5px;' value='Eliminar'></input>";
            $html.="</td>";
            $html.="</tr>";
        }//Fin del while
        $html.="<input type='hidden' id='total_cuentas' name='total_cuentas' value='".$i."'>";
        $html.="</tbody>";
        $html.="</table>";
    }//Fin del if..
    return $html;
}//fin de mostrar tabla cuentas bancarias
?>
function cancelar_busqueda(){ //Funcion para recargar la pagina
	location.reload();
}//fin de funcion cancelar busqueda

function validar_correo(valor){
	re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
	if(!re.exec(valor)){
		return "No";
	}else{
		return "Si";
	}//fin del else
}//fin de validar correo

function guardar_datos_cliente(){
	//alert("Entra");
	if(($('#nombre_cliente').val()!="")&&($('#apellidopa_cliente').val()!="")&&($('#residencia_cliente').val()!="")&&($('#nacionalidad_cliente').val()!="")&&($('#correo_cliente').val()!="")&&($('#telefono_cliente').val()!="")){
		if(document.getElementById('telefono_cliente').value.length>=10){
			if(validar_correo($('#correo_cliente').val())=="Si"){
			$(document).ready(function(){
				var id_cliente = $('#id_cliente').val();
				var nombre = $('#nombre_cliente').val();
				var apellido_pa = $('#apellidopa_cliente').val();
				var apellido_ma = $('#apellidoma_cliente').val();
				var residencia = $('#residencia_cliente').val();
				var nacionalidad = $('#nacionalidad_cliente').val();
				var correo = $('#correo_cliente').val();
				var direccion = $('#direccion_cliente').val();
				var telefono = $('#telefono_cliente').val();
				var estado_civil = $('#estadoc_cliente').val();
				var actividad_economica = $('#act_cliente').val();
				var rfc = $('#rfc_cliente').val();
				//Función de Ajax
				$.ajax({
					url:"assets/php/clientes/guardar_datos_cliente.php",
					dataType:"json",//Formato en como se manda la información
					type:"get",
					data:{//Información a enviar o cadena a enviar
						id_cliente:id_cliente, nombre:nombre, apellido_pa:apellido_pa, apellido_ma:apellido_ma, residencia:residencia, nacionalidad:nacionalidad, direccion:direccion,correo:correo, telefono:telefono, estado_civil:estado_civil, actividad_economica:actividad_economica, rfc:rfc
					},
					success:function(respuesta){
						$(document).ready(function(){
							if(respuesta.valor=="ok"){
								swal({
									text:'Datos guardados',
									type: 'success'
								});
								$('#id_cliente').val(respuesta.id_cliente);
								$('#input_cliente').val(respuesta.nombre_cliente);
								$("#input_cliente").prop('disabled', true);
								$('#div_boton_contrato').show('slow');
								cargar_tabla_contratos();
							}else{
								swal({
									text:'Error',
									type: 'error'
								});
							}//fin del else
						});	
					},
					error:function(respuesta){//Si surge un error
						console.log(respuesta);
					}
				});
			});
			}else{
				$(document).ready(function(){
					swal({
						text:'El correo no cuenta con el formato valido',
						type: 'info'
					});
				});	
			}//fin del else
		}else{
			$(document).ready(function(){
				swal({
					text:'El telefono no cuenta con el formato valido',
					type: 'info'
				});
			});	
		}//fin del else
	}else{
		$(document).ready(function(){
			swal({
				text:'No se pueden dejar campos vacíos',
				type: 'info'
			});
		});	
	}//fin del else
}//fin de guardar datos cliente

function guardar_datos_precontrato(){
	//alert("Entra");
	if(($('#cant_enganche').val()!="")&&($('#fecha_enganche').val()!="")&&($('#txtArea_clientes').val()!="")&&($('#select_lotes').val()!="0")&&($('#precio_venta').val()!="")&&($('#select_tipo_compra').val()!="0")&&($('#pago_final').val()!="")&&($('#dia_pago').val()!="")){
		validar_formato_precontrato();
		$(document).ready(function(){
			var id_cliente = $('#id_cliente').val();
			var id_contrato = $('#id_contrato').val();
			var cantidad_apartado = $('#cant_apartado').val();
			var fecha_apartado = $('#fecha_apartado').val();
			var cantidad_enganche = $('#cant_enganche').val();
			var fecha_enganche = $('#fecha_enganche').val();
			var mensualidad_enganche = $('#men_enganche').val();
			var cant_mensual_enganche = $('#cant_mensual_enganche').val();
			var clientes = $('#txtArea_clientes').val();
			var lote = $('#select_lotes').val();
			var precio_venta = $('#precio_venta').val();
			var tipo_compra = $('#select_tipo_compra').val();
			var n_mensualidades = $('#n_mensualidades').val();
			var monto_mensual = $('#monto_mensual').val();
			var pago_final = $('#pago_final').val();
			var dia_pago = $('#dia_pago').val();
			var descuentos = $('#desc_aplicados').val();
			var tasa_interes = $('#tasa_interes').val();
			var nombre_broker = $('#nombre_broker').val();
			var comision_broker = $('#comision_broker').val();
			var observaciones = $('#observaciones').val();
			//Función de Ajax
			$.ajax({
				url:"assets/php/clientes/guardar_datos_precontrato.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id_cliente:id_cliente, id_contrato:id_contrato, cantidad_apartado:cantidad_apartado, fecha_apartado:fecha_apartado, cantidad_enganche:cantidad_enganche, fecha_enganche:fecha_enganche, mensualidad_enganche:mensualidad_enganche, clientes:clientes, lote:lote, precio_venta:precio_venta, tipo_compra:tipo_compra, n_mensualidades:n_mensualidades, monto_mensual:monto_mensual, pago_final:pago_final, dia_pago:dia_pago, descuentos:descuentos, tasa_interes:tasa_interes, nombre_broker:nombre_broker, comision_broker:comision_broker, observaciones:observaciones, cant_mensual_enganche:cant_mensual_enganche
				},
				success:function(respuesta){
					$(document).ready(function(){
						if(respuesta.valor=="ok"){
							swal({
								text:'Datos guardados',
								type: 'success'
							});
							$('#id_contrato').val(respuesta.id_contrato);
							//cargar_datos_contrato();
						}else{
							if(respuesta.valor=="warning"){
								swal({
									text:respuesta.mensaje,
									type: 'warning'
								});
							}else{
								swal({
									text:"Error",
									type: 'error'
								});
							}//fin del if
							console.log(respuesta);		
						}//fin del else
						cargar_tabla_contratos();
					});	
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}else{
		$(document).ready(function(){
			swal({
				text:'No se pueden dejar campos vacíos',
				type: 'info'
			});
		});
		validar_formato_precontrato();
	}//fin del else
}//fin de guardar datos cliente

function validar_formato_precontrato(){
	var tipo_compra = $('#select_tipo_compra').val();
	switch (tipo_compra) {
		case '0':
			validacion = ['cant_enganche','fecha_enganche','txtArea_clientes','precio_venta','select_tipo_compra','pago_final','dia_pago'];
			break;
		case '2':
			validacion = ['cant_enganche','fecha_enganche','txtArea_clientes','precio_venta','select_tipo_compra','pago_final','dia_pago'];
			break;
		case '3':
			validacion = ['cant_enganche','fecha_enganche','txtArea_clientes','precio_venta','select_tipo_compra','pago_final','dia_pago'];
			break;
		default:
			validacion = ['cant_enganche','fecha_enganche','txtArea_clientes','precio_venta','select_tipo_compra','monto_mensual','pago_final','dia_pago'];
	}//fin del switch
	
	for(let p = 0; p < validacion.length; p++){
		switch ($('#'+validacion[p]).val()) {
			case '':
				document.getElementById(validacion[p]).classList.add("inputIncompleto");
				break;
			case '0':
				document.getElementById(validacion[p]).classList.add("inputIncompleto");
				break;
			default:
				if(document.getElementById(validacion[p]).classList.contains("inputIncompleto")){
					document.getElementById(validacion[p]).classList.remove("inputIncompleto");
				}//fin del if
		}//fin del switch
	}//for
}//fin de validar formato precontrato

function guardar_datos_contrato(){
	//alert("Entra");
	if(($('#fecha_contrato').val()!="")&&($('#fecha_firma').val()!="")){
		$(document).ready(function(){
			var id_cliente = $('#id_cliente').val();
			var id_contrato = $('#id_contrato').val();
			var fecha_contrato = $('#fecha_contrato').val();
			var fecha_firma = $('#fecha_firma').val();
			//Función de Ajax
			$.ajax({
				url:"assets/php/clientes/guardar_datos_contrato.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id_cliente:id_cliente, id_contrato:id_contrato, fecha_contrato:fecha_contrato, fecha_firma:fecha_firma
				},
				success:function(respuesta){
					$(document).ready(function(){
						if(respuesta.valor=="ok"){
							swal({
								text:'Datos guardados',
								type: 'success'
							});
						}else{
							swal({
								text:respuesta.valor,
								type: 'error'
							});
							console.log(respuesta);		
						}//fin del else
					});
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}//fin de error
			});//fin del ajax
		});
	}else{
		swal({
			text:'Debes establecer la fecha de contrato y la fecha de firma',
			type: 'warning'
		});
	}//fin del else
}//fin de guardar datos contrato

function eliminar_contrato(id_contrato){
	//alert("Entra");
	$(document).ready(function(){
		swal({
			title: '¿Deseas eliminar el contrato?', 
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#144653',
			cancelButtonColor: '#7F9174',
			confirmButtonText: 'Si',
			cancelButtonText: 'No'
		}).then(function(result){
			if(result.value){
				//Función de Ajax
				$.ajax({
					url:"assets/php/clientes/eliminar_contrato.php",
					dataType:"json",//Formato en como se manda la información
					type:"get",
					data:{//Información a enviar o cadena a enviar
						id_contrato:id_contrato
					},
					success:function(respuesta){
						$(document).ready(function(){
							swal({
								text:respuesta.mensaje,
								type: respuesta.valor
							});
							cargar_tabla_contratos();
						});	
					},
					error:function(respuesta){//Si surge un error
						console.log(respuesta);
					}
				});
			}//fin del if
		});
	});
}//fin de guardar datos cliente

function imprimir_contrato(id_contrato){
	$.ajax({
		url:'assets/php/clientes/cargar_formato_impresion.php',
		dataType:"json",//Formato en como se manda la información
		type:"get",
		data:{//Información a enviar o cadena a enviar
			id_contrato:id_contrato
		},
		success:function(respuesta){
			if(respuesta.valor=="ok"){
				$('#contenidoClientes').html(respuesta.formato);//En donde quiero mostrar la información
				$('#'+respuesta.id_tabla).DataTable();
			}//fin del if
			$('#modalClientes').modal('show'); // abrir
			/*$('#myModalExito').modal('hide'); // cerrar
			var obj = document.getElementById("boton_modal_clientes");
			obj.click();*/
		},
		error:function(respuesta){//Si surge un error
			console.log(respuesta);
		}
	});
}//fin de funcion imprimir contrato

function mostrar_div_deposito_garantia(id_select){
	if(document.getElementById(id_select).value=="financiado_extra"){
		document.getElementById("div_deposito_garantia").style.display="block";
	}else{
		document.getElementById("div_deposito_garantia").style.display="none";
	}//fin del else
}//fin de funcion mostrar div deposito garantia

function busca_cliente(){
	var cliente = $('#input_cliente').val();
	$.ajax({
		type:'get',
		url:'assets/php/clientes/busca_cliente.php',
		data:{
			cliente:cliente
		},
		success:function(response) {
			$('#tbody_cliente').html(response);
			$('#div_cliente_lista').css('display','block');
		}//fin de success
	});
};//Fin busca_cliente

function seleccionar_cliente(id){
	var cadena = id.split("&");
	id_cliente = cadena[0];	
	nombre = cadena[1];
	//nombre = nombre.substring(0, nombre.length - 1);
	$('#input_cliente').val(nombre);
	$("#input_cliente").prop('disabled', true);
	$('#id_cliente').val(id_cliente);
	$('#div_cliente_lista').css('display','none');
	$("#buscar").prop('disabled', false);
};//Fin seleccionar_cliente

function cargar_datos_cliente(id){
	var aux = 0;
	if(id=="buscar"){
		if($('#id_cliente').val()==""){
			aux = 1;
		}//fin del if
		var cliente = $('#id_cliente').val();
		$("#agregar").prop('disabled', true);
		$("#buscar").prop('disabled', true);
	}else{
		aux = 0;
		var cliente = $('#input_cliente').val();
		$("#agregar").prop('disabled', true);
		$("#input_cliente").prop('disabled', true);
		$('#input_cliente').val("");
		$('#div_cliente_lista').hide();
		$('#div_contratos').hide();
		$('#div_boton_contrato').hide();
		$('#div_formato_precontrato').hide();
		$('#div_formato_contrato').hide();
	}//fin del else
	if(aux==0){
		$.ajax({
			url:"assets/php/clientes/cargar_datos_cliente.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				cliente:cliente, id:id
			},
			success:function(respuesta){
				$(document).ready(function(){
					if(respuesta.valor=="ok"){
						$('#div_formato_cliente').html(respuesta.formato);
						$('#id_cliente').val(respuesta.id_cliente);
						cargar_tabla_contratos();
						$('#div_contratos').hide();
						if(respuesta.id_cliente!=""){
							$('#div_boton_contrato').show('slow');
						}//fin del if
					}//fin del if
				});	
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	}else{
		swal({
			text:'Debes seleccionar un cliente',
			type: 'warning'
		});
	}//fin del else
}//fin de cargar datos clientes

function cargar_datos_precontrato(id){
	//alert("Entrando");
	$('#div_formato_precontrato').hide();
	var id_cliente = $('#id_cliente').val();
	var input_cliente = $('#input_cliente').val();
	$('#div_formato_contrato').hide();
	$.ajax({
		url:"assets/php/clientes/cargar_datos_precontrato.php",
		dataType:"json",//Formato en como se manda la información
		type:"get",
		data:{//Información a enviar o cadena a enviar
			id_cliente:id_cliente, id:id, input_cliente:input_cliente
		},
		success:function(respuesta){
			$(document).ready(function(){
				if(respuesta.valor=="ok"){
					$('#div_formato_precontrato').show('slow');
					$('#div_formato_precontrato').html(respuesta.formato);
					//cargar_datos_contrato();
				}//fin del if
			});	
		},
		error:function(respuesta){//Si surge un error
			console.log(respuesta);
		}
	});
}//fin de cargar datos clientes

function cargar_datos_contrato(){
	//Poner validacion para que el estatus sea enganche
	if(($('#id_cliente').val()!="")&&($('#id_contrato').val()!="")){
		$('#div_formato_contrato').show('slow');
		var id_cliente = $('#id_cliente').val();
		var id_contrato = $('#id_contrato').val();
		$.ajax({
			url:"assets/php/clientes/cargar_datos_contrato.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				id_cliente:id_cliente, id_contrato:id_contrato
			},
			success:function(respuesta){
				$(document).ready(function(){
					if(respuesta.valor=="ok"){
						$('#div_formato_contrato').html(respuesta.formato);
					}//fin del if
				});	
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	}else{
		swal({
			text:'Debes llenar los datos de la compra para poder crear un contrato',
			type: 'warning'
		});
	}//fin del else
}//fin de cargar datos clientes

function cargar_tabla_contratos(){
	if($('#id_cliente').val()!=""){
		var id_cliente = $('#id_cliente').val();
		$(document).ready(function(){
			//Defino las variables
			//Función de Ajax
			$.ajax({
				url:"assets/php/clientes/cargar_contratos.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id_cliente:id_cliente
				},
				success:function(respuesta){
					if(respuesta.valor=="ok"){
						$('#div_contratos').show('slow');
						$('#div_tabla_contratos').html(respuesta.tabla);//En donde quiero mostrar la información
						$('#'+respuesta.id_tabla).DataTable();
					}else{
						$('#div_contratos').hide();
					}//fin del else
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}//fin del if
}//fin de funcion cargar tabla contratos

function ocultar_n_mensualidades(id_tipo_compra){
	if((id_tipo_compra==1)||(id_tipo_compra==4)){
		document.getElementById("div_n_mensualidades2").style.display="block";
		document.getElementById("div_n_mensualidades").style.display="block";
		document.getElementById("div_input_monto_mensual").style.display="block";
		document.getElementById("div_monto_mensual").style.display="block";
	}else{
		document.getElementById("div_n_mensualidades2").style.display="none";
		document.getElementById("div_n_mensualidades").style.display="none";
		document.getElementById("div_input_monto_mensual").style.display="none";
		document.getElementById("div_monto_mensual").style.display="none";
	}//fin del else
}//fin de funcion ocultar numero mensualidades

function cargar_precio_lista_lote(id_lote){
	if((id_lote!="0")||(id_lote!="")){
		$.ajax({
			url:"assets/php/clientes/cargar_precio_lista_lote.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				id_lote:id_lote
			},
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#precio_lista').val(respuesta.precio_lista);
					$("#precio_venta").prop('disabled', false);
				}//Fin del if  
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	}//fin del if
}//fin de cargar precio lista lote

function cargar_precio_recomendado(){
	id_lote = $("#select_lotes").val();
	if(id_lote!="0"){
		precio_lista = $("#precio_lista").val();
		desc_aplicados = $("#desc_aplicados").val();
		$.ajax({
			url:"assets/php/clientes/cargar_precio_recomendado.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				id_lote:id_lote, precio_lista:precio_lista, desc_aplicados:desc_aplicados
			},
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#precio_recomendado').val(respuesta.precio_recomendado);
				}//Fin del if  
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	}//fin del if
}//fin de funcion cargar precio recomendado

function validar_precio_venta(input_venta){
	var precio_venta = document.getElementById(input_venta).value;
	var precio_lista = document.getElementById("precio_lista").value;
	//alert("Precio venta: "+precio_venta+" Precio lista: "+precio_lista);
	if(Number(precio_venta)>Number(precio_lista)){
		swal({
			text:'El precio de venta es mayor que el precio de lista',
			type: 'warning'
		});
		//document.getElementById(input_venta).value = "";
	}//fin del if
}//fin de validar precio venta

function validar_entrada(id){
	var aux=document.getElementById(id).value;
	var cant='';
	for(var i=0;i<aux.length;i++){
		if((aux.charAt(i)==",")||(aux.charAt(i)==" ")||(aux.charAt(i)=="$")||(aux.charAt(i)=="")||(aux.charAt(i)=="(")||(aux.charAt(i)==")")||(aux.charAt(i)=="*")){
			swal({
				text:'Caracter inválido',
				type: 'warning'
			});
		}else{
			if((aux.charAt(i)=='0')||(aux.charAt(i)=='1')||(aux.charAt(i)=='2')||(aux.charAt(i)=='3')||(aux.charAt(i)=='4')||(aux.charAt(i)=='5')||(aux.charAt(i)=='6')||(aux.charAt(i)=='7')||(aux.charAt(i)=='8')||(aux.charAt(i)=='9')||(aux.charAt(i)==('.'))){
				if(i==0){
					cant=aux.charAt(i);
				}else{
					cant+=aux.charAt(i);
				}//Fin del else..
			}else{
				swal({
					text:'Solo se permite ingresar numeros',
					type: 'warning'
				});
			}//fin del else
		}//Fin del else
	}//Fin del for
	document.getElementById(id).value=cant;
}//Fin de validar entrada..

function cargar_select_super_manzana(id_select_fase){
	$('#precio_venta').val('');
	$('#select_lotes').val('0');
	$('#div_select_lotes').hide();
	$('#select_manzana').val('0');
	$('#div_super_manzana').hide();
	$('#select_super_manzana').val('0');
	$('#div_select_super_manzana').hide();
	if(document.getElementById(id_select_fase).value!="0"){
		var fase = document.getElementById(id_select_fase).value;
		$.ajax({
			url:"assets/php/clientes/cargar_select_super_manzana.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				fase:fase
			},
			/*beforeSend : function (jqXHR, settings){
				//alert("Entra");
				//document.getElementById("imagen_carga_indicador").style.display="block";
				$('#municipio_postulante').hide();
				$('#municipio_postulante1').hide();
				$('#div_tabla_jueces').hide();
				$('#div_mapa_jueces').hide();
				$('#div_imagen_select').show();
				$('#carga_select').show();
			},*/
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#div_super_manzana').show('slow');
					$('#div_select_super_manzana').show('slow');
					$('#div_select_super_manzana').html(respuesta.select);	
				}//Fin del if
			},
			error:function(respuesta){//Si surge un error
			console.log(respuesta);
			}
		});
	}//fin del if
}//fin de cargar select super manzana

function cargar_select_manzana(id_select_super_manzana){
	$('#precio_venta').val('');
	$('#select_lotes').val('0');
	$('#div_select_lotes').hide();
	$('#select_manzana').val('0');
	$('#div_super_manzana').hide();
	if(document.getElementById(id_select_super_manzana).value!="0"){
		var fase = document.getElementById("select_fase").value;
		var super_manzana = document.getElementById(id_select_super_manzana).value;
		$.ajax({
			url:"assets/php/clientes/cargar_select_manzana.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				super_manzana:super_manzana, fase:fase
			},
			/*beforeSend : function (jqXHR, settings){
				//alert("Entra");
				//document.getElementById("imagen_carga_indicador").style.display="block";
				$('#municipio_postulante').hide();
				$('#municipio_postulante1').hide();
				$('#div_tabla_jueces').hide();
				$('#div_mapa_jueces').hide();
				$('#div_imagen_select').show();
				$('#carga_select').show();
			},*/
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#div_manzana').show('slow');
					$('#div_select_manzana').show('slow');
					$('#div_select_manzana').html(respuesta.select);	
				}//Fin del if
			},
			error:function(respuesta){//Si surge un error
			console.log(respuesta);
			}
		});
	}//fin del if
}//fin de cargar select manzana

function cargar_select_lotes(id_select_manzana){
	$('#precio_venta').val('');
	$('#select_lotes').val('0');
	$('#div_select_lotes').hide();
	if(document.getElementById(id_select_manzana).value!="0"){
		var manzana = document.getElementById(id_select_manzana).value;
		var fase = document.getElementById("select_fase").value;
		var super_manzana = document.getElementById("select_super_manzana").value;
		$.ajax({
			url:"assets/php/clientes/cargar_select_lotes.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				manzana:manzana, super_manzana:super_manzana, fase:fase
			},
			/*beforeSend : function (jqXHR, settings){
				//alert("Entra");
				//document.getElementById("imagen_carga_indicador").style.display="block";
				$('#municipio_postulante').hide();
				$('#municipio_postulante1').hide();
				$('#div_tabla_jueces').hide();
				$('#div_mapa_jueces').hide();
				$('#div_imagen_select').show();
				$('#carga_select').show();
			},*/
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#div_lote').show('slow');
					$('#div_select_lote').show('slow');
					$('#div_select_lote').html(respuesta.select);
				}//Fin del if
			},
			error:function(respuesta){//Si surge un error
			console.log(respuesta);
			}
		});
	}//fin del if
}//fin de cargar select lotes

function agregar_lote(){
	//Comprobamos que el campo no esté vacío
	if(document.getElementById("select_lotes").value=="0"){
		swal({
			text:"Debes seleccionar un lote.",
			type: 'warning'
		});							
	}else{
		lote = document.getElementById("select_lotes").value
		if(document.getElementById("txtArea_lotes").value.length>0){ //Verificamos si ya hay un valor en el textArea
			var arreglo_lotes = document.getElementById("txtArea_lotes").value.split(","); //Creamos un arreglo para almacenar los valores del txtArea
			for (var i = 0; i < arreglo_lotes.length; i++) { //Recorremos el arreglo
				if(arreglo_lotes[i]==document.getElementById("select_lotes").value){ //Comparamos que el valor seleccionado no sea igual a uno que ya esté en el arreglo
					swal({
						text:"Este lote ya se encuentra registrado",
						type: 'warning'
					});
				}//Fin if...
			}//Fin for...
			if(document.getElementById("txtArea_lotes").value!=0){
				aux=document.getElementById("txtArea_lotes").value;
				aux=aux+",";
			}//Fin if...
		}else{
			aux="";
		}//Fin del else...
		aux+=lote;
		document.getElementById("txtArea_lotes").value=aux;
		document.getElementById("select_fase").value = "0";
		document.getElementById("select_super_manzana").value= "0";
		document.getElementById("select_manzana").value= "0";
		document.getElementById("select_lotes").value= "0";
		document.getElementById("div_select_super_manzana").style.display="none";
		document.getElementById("div_select_manzana").style.display="none";
		document.getElementById("div_select_lote").style.display="none";
	}//Fin else...
}//Fin agregar_lote...

function quitar_lote(){
	if(document.getElementById("txtArea_lotes").value.length=="0"){ //Validamos que el txtArea no esté vacio
		swal({
			text:"No hay lotes seleccionados",
			type: 'warning'
		});
	}else{
		var arreglo_lotes = document.getElementById("txtArea_lotes").value.split(","); //Generamos un arreglo con los responsables que ya hay en el textArea
		lotes_largo = arreglo_lotes.length;
		if(lotes_largo==1){
			document.getElementById("txtArea_lotes").value="";
		}else{
			lotes_largo--;
			var aux = "";
			for (var i = 0; i < lotes_largo; i++) {
				if(i==0){
					aux+=arreglo_lotes[i];
				}else{
					aux+=","+arreglo_lotes[i];
				}//fin del else
			}//fin del for
			document.getElementById("txtArea_lotes").value=aux;
		}//fin del else
	}//Fin else...
}//Fin contar_responsables...

function agregar_cliente(){
	//Comprobamos que el campo no esté vacío
	if(document.getElementById("select_clientes").value=="0"){
		swal({
			text:"Debes seleccionar un cliente.",
			type: 'warning'
		});							
	}else{
		cliente = document.getElementById("select_clientes").value
		if(document.getElementById("txtArea_clientes").value.length>0){ //Verificamos si ya hay un valor en el textArea
			var arreglo_clientes = document.getElementById("txtArea_clientes").value.split(","); //Creamos un arreglo para almacenar los valores del txtArea
			for (var i = 0; i < arreglo_clientes.length; i++) { //Recorremos el arreglo
				if(arreglo_clientes[i]==document.getElementById("select_clientes").value){ //Comparamos que el valor seleccionado no sea igual a uno que ya esté en el arreglo
					swal({
						text:"Este cliente ya se encuentra registrado",
						type: 'warning'
					});
					cliente="";
				}//Fin if...
			}//Fin for...
			if(document.getElementById("txtArea_clientes").value!=0){
				aux=document.getElementById("txtArea_clientes").value;
				if(cliente==""){
					aux=aux+"";
				}else{
					aux=aux+",";
				}//fin del else
			}//Fin if...
		}else{
			aux="";
		}//Fin del else...
		aux+=cliente;
		document.getElementById("txtArea_clientes").value=aux;
		document.getElementById("select_clientes").value = "0";
	}//Fin else...
}//Fin agregar_lote...

function quitar_cliente(){
	if(document.getElementById("txtArea_clientes").value.length=="0"){ //Validamos que el txtArea no esté vacio
		swal({
			text:"No hay clientes seleccionados",
			type: 'warning'
		});
	}else{
		var arreglo_clientes = document.getElementById("txtArea_clientes").value.split(","); //Generamos un arreglo con los responsables que ya hay en el textArea
		clientes_largo = arreglo_clientes.length;
		if(clientes_largo==1){
			document.getElementById("txtArea_clientes").value="";
		}else{
			clientes_largo--;
			var aux = "";
			for (var i = 0; i < clientes_largo; i++) {
				if(i==0){
					aux+=arreglo_clientes[i];
				}else{
					aux+=","+arreglo_clientes[i];
				}//fin del else
			}//fin del for
			document.getElementById("txtArea_clientes").value=aux;
		}//fin del else
	}//Fin else...
}//Fin contar_responsables...

function agregar_descuento(){
	//Comprobamos que el campo no esté vacío
	if(document.getElementById("select_descuentos")){
		if(document.getElementById("select_descuentos").value=="0"){
			swal({
				text:"Debes seleccionar un descuento.",
				type: 'warning'
			});							
		}else{
			descuentos = document.getElementById("select_descuentos").value;
			if(document.getElementById("desc_aplicados").value.length>0){ //Verificamos si ya hay un valor en el textArea
				var arreglo_descuentos = document.getElementById("desc_aplicados").value.split(",");//Creamos un arreglo para almacenar los valores del txtArea
				for (var i = 0; i < arreglo_descuentos.length; i++) { //Recorremos el arreglo
					if(arreglo_descuentos[i]==document.getElementById("select_descuentos").value){ //Comparamos que el valor seleccionado no sea igual a uno que ya esté en el arreglo
						swal({
							text:"Este descuento ya se encuentra registrado",
							type: 'warning'
						});
						descuentos="";
					}//Fin if...
				}//Fin for...
				if(document.getElementById("desc_aplicados").value!=0){
					aux=document.getElementById("desc_aplicados").value;
					if(descuentos==""){
						aux=aux+"";
					}else{
						aux=aux+",";
					}//fin del else
				}//Fin if...
			}else{
				aux="";
			}//Fin del else...
			aux+=descuentos;
			document.getElementById("desc_aplicados").value=aux;
			document.getElementById("select_descuentos").value = "0";
		}//Fin else...
	}else{
		swal({
			text:"No se ha registrado ningun descuento.",
			type: 'warning'
		});	
	}//fin del else
}//Fin agregar_lote...

function quitar_descuento(){
	if(document.getElementById("desc_aplicados").value.length=="0"){ //Validamos que el txtArea no esté vacio
		swal({
			text:"No hay descuentos seleccionados",
			type: 'warning'
		});
	}else{
		var arreglo_descuentos = document.getElementById("desc_aplicados").value.split(","); //Generamos un arreglo con los responsables que ya hay en el textArea
		descuentos_largo = arreglo_descuentos.length;
		if(descuentos_largo==1){
			document.getElementById("desc_aplicados").value="";
		}else{
			descuentos_largo--;
			var aux = "";
			for (var i = 0; i < descuentos_largo; i++) {
				if(i==0){
					aux+=arreglo_descuentos[i];
				}else{
					aux+=","+arreglo_descuentos[i];
				}//fin del else
			}//fin del for
			document.getElementById("desc_aplicados").value=aux;
		}//fin del else
	}//Fin else...
}//Fin contar_responsables...
function cancelar_busqueda(){ //Funcion para recargar la pagina
	location.reload();
}//fin de funcion cancelar busqueda

function guardar_datos_cliente(){
	//alert("Entra");
	if(($('#nombre_cliente').val()!="")&&($('#apellidopa_cliente').val()!="")&&($('#residencia_cliente').val()!="")&&($('#nacionalidad_cliente').val()!="")&&($('#correo_cliente').val()!="")&&($('#telefono_cliente').val()!="")&&($('#direccion_cliente').val()!="")){
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
			//Función de Ajax
			$.ajax({
				url:"assets/php/clientes/guardar_datos_cliente.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id_cliente:id_cliente, nombre:nombre, apellido_pa:apellido_pa, apellido_ma:apellido_ma, residencia:residencia, nacionalidad:nacionalidad, direccion:direccion,correo:correo, telefono:telefono, estado_civil:estado_civil, actividad_economica:actividad_economica
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
				text:'No se pueden dejar campos vacíos',
				type: 'info'
			});
		});	
	}//fin del else
}//fin de guardar datos cliente

function guardar_datos_precontrato(){
	//alert("Entra");
	if(($('#cant_enganche').val()!="")&&($('#fecha_enganche').val()!="")&&($('#txtArea_clientes').val()!="")&&($('#select_lotes').val()!="0")&&($('#precio_venta').val()!="")&&($('#select_tipo_compra').val()!="0")&&($('#monto_mensual').val()!="")&&($('#pago_final').val()!="")&&($('#dia_pago').val()!="")){
		$(document).ready(function(){
			var id_cliente = $('#id_cliente').val();
			var id_contrato = $('#id_contrato').val();
			var cantidad_apartado = $('#cant_apartado').val();
			var fecha_apartado = $('#fecha_apartado').val();
			var cantidad_enganche = $('#cant_enganche').val();
			var fecha_enganche = $('#fecha_enganche').val();
			var mensualidad_enganche = $('#men_enganche').val();
			var clientes = $('#txtArea_clientes').val();
			var lote = $('#select_lotes').val();
			var precio_venta = $('#precio_venta').val();
			var tipo_compra = $('#select_tipo_compra').val();
			var n_mensualidades = $('#n_mensualidades').val();
			var monto_mensual = $('#monto_mensual').val();
			var pago_final = $('#pago_final').val();
			var dia_pago = $('#dia_pago').val();
			var nombre_descuento = $('#nombre_descuento').val();
			var descuento = $('#descuento').val();
			var monto_interes = $('#monto_interes').val();
			var nombre_broker = $('#nombre_broker').val();
			var comision_broker = $('#comision_broker').val();
			var observaciones = $('#observaciones').val();
			//Función de Ajax
			$.ajax({
				url:"assets/php/clientes/guardar_datos_precontrato.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id_cliente:id_cliente, id_contrato:id_contrato, cantidad_apartado:cantidad_apartado, fecha_apartado:fecha_apartado, cantidad_enganche:cantidad_enganche, fecha_enganche:fecha_enganche, mensualidad_enganche:mensualidad_enganche, clientes:clientes, lote:lote, precio_venta:precio_venta, tipo_compra:tipo_compra, n_mensualidades:n_mensualidades, monto_mensual:monto_mensual, pago_final:pago_final, dia_pago:dia_pago, nombre_descuento:nombre_descuento, descuento:descuento, monto_interes:monto_interes, nombre_broker:nombre_broker, comision_broker:comision_broker, observaciones:observaciones
				},
				success:function(respuesta){
					$(document).ready(function(){
						if(respuesta.valor=="ok"){
							swal({
								text:'Datos guardados',
								type: 'success'
							});
							//cargar_datos_contrato();
						}else{
							swal({
								text:respuesta.valor,
								type: 'error'
							});
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
	}//fin del else
}//fin de guardar datos cliente

function guardar_datos_contrato(){
	//alert("Entra");
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
			}
		});
	});
}//fin de guardar datos contrato

function eliminar_contrato(id_contrato){
	//alert("Entra");
	$(document).ready(function(){
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
	});
}//fin de guardar datos cliente

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
	}else{
		aux = 0;
		var cliente = $('#input_cliente').val();
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
					}//Fin del if  
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}//fin del if
}//fin de funcion cargar tabla contratos

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
				}//Fin del if  
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	}//fin del if
}//fin de cargar precio lista lote

function validar_precio_venta(input_venta){
	var precio_venta = document.getElementById(input_venta).value;
	var precio_lista = document.getElementById("precio_lista").value;
	if(precio_venta<=precio_lista){

	}else{
		swal({
			text:'El precio de venta no puede ser mayor que el precio de lista',
			type: 'warning'
		});
		document.getElementById(input_venta).value = "";
	}//fin del else
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
	}else{
		$('#select_lotes').val('0');
		$('#select_manzana').val('0');
		$('#select_super_manzana').val('0');
		$('#div_super_manzana').hide();
		$('#div_select_super_manzana').hide();
	}//fin del else
}//fin de cargar select super manzana

function cargar_select_manzana(id_select_super_manzana){
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
	}else{
		$('#select_lotes').val('0');
		$('#select_manzana').val('0');
		$('#div_manzana').hide();
		$('#div_select_manzana').hide();
	}//fin del else
}//fin de cargar select manzana

function cargar_select_lotes(id_select_manzana){
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
	}else{
		$('#select_lotes').val('0');
		$('#div_lotes').hide();
		$('#div_select_lotes').hide();
	}//fin del else
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
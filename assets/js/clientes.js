function guardar_datos_cliente(){
	//alert("Entra");
	$(document).ready(function(){
		var id_cliente = $('#id_cliente').val();
		var nombre = $('#nombre_cliente').val();
		var apellido_pa = $('#apellidopa_cliente').val();
		var apellido_ma = $('#apellidoma_cliente').val();
		var residencia = $('#residencia_cliente').val();
		var nacionalidad = $('#nacionalidad_cliente').val();
		var correo = $('#correo_cliente').val();
		var telefono = $('#telefono_cliente').val();
		var estado_civil = $('#estadoc_cliente').val();
		var actividad_economica = $('#act_cliente').val();
		//Función de Ajax
		$.ajax({
			url:"assets/php/clientes/guardar_datos_cliente.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				id_cliente:id_cliente, nombre:nombre, apellido_pa:apellido_pa, apellido_ma:apellido_ma, residencia:residencia, nacionalidad:nacionalidad, correo:correo, telefono:telefono, estado_civil:estado_civil, actividad_economica:actividad_economica
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
}//fin de guardar datos cliente

function guardar_datos_contrato(){
	//alert("Entra");
	$(document).ready(function(){
		var id_cliente = $('#id_cliente').val();
		var id_contrato = $('#id_contrato').val();
		var fecha_contrato = $('#fecha_contrato').val();
		var fecha_firma = $('#fecha_firma').val();
		var precio_venta = $('#precio_venta').val();
		var tipo_compra = $('#tipo_compra').val();
		var cantidad_apartado = $('#cantidad_apartado').val();
		var fecha_apartado = $('#fecha_apartado').val();
		var cantidad_enganche = $('#cantidad_enganche').val();
		var fecha_enganche = $('#fecha_enganche').val();
		var n_mensualidades = $('#n_mensualidades').val();
		var monto_mensual = $('#monto_mensual').val();
		var pago_final = $('#pago_final').val();
		/*Poner los valores de los selects del lote
		var fecha_contrato = $('#fecha_contrato').val();
		*/
		var estatus_venta = $('#estatus_venta').val();
		var dia_pago = $('#dia_pago').val();
		var nombre_descuento = $('#nombre_descuento').val();
		var tasa = $('#tasa').val();
		
		//Función de Ajax
		$.ajax({
			url:"assets/php/clientes/guardar_datos_contrato.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				id_cliente:id_cliente, id_contrato:id_contrato, fecha_contrato:fecha_contrato, fecha_firma:fecha_firma, precio_venta:precio_venta, tipo_compra:tipo_compra, cantidad_apartado:cantidad_apartado, fecha_apartado:fecha_apartado, cantidad_enganche:cantidad_enganche, fecha_enganche:fecha_enganche, n_mensualidades:n_mensualidades, monto_mensual:monto_mensual, pago_final:pago_final, estatus_venta:estatus_venta, dia_pago:dia_pago, nombre_descuento:nombre_descuento, tasa:tasa
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
}//fin de guardar datos cliente

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
					if(respuesta.valor=="ok"){
						swal({
							text:'Datos guardados',
							type: 'success'
						});
					}else{
						swal({
							text:'Error',
							type: 'error'
						});
					}//fin del else
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
};//Fin busca cliente

function seleccionar_cliente(cod_empleado,nombre){
	console.log(cod_empleado+","+nombre);
	$('#input_cliente').val(nombre+"-"+cod_empleado);
	$('#input_cliente').attr('name', cod_empleado);
	$('#div_cliente_lista').css('display','none');
};//Fin seleccionarPersona

function cargar_datos_cliente(id){
	//alert("Entrando");
	var cliente = $('#input_cliente').val();
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
				}//fin del if
			});	
		},
		error:function(respuesta){//Si surge un error
			console.log(respuesta);
		}
	});
}//fin de cargar datos clientes

function cargar_datos_contrato(id){
	//alert("Entrando");
	var id_cliente = $('#id_cliente').val();
	$.ajax({
		url:"assets/php/clientes/cargar_datos_contrato.php",
		dataType:"json",//Formato en como se manda la información
		type:"get",
		data:{//Información a enviar o cadena a enviar
			id_cliente:id_cliente, id:id
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
}//fin de cargar datos clientes

function cargar_tabla_contratos(){
	if($('#id_cliente').val()!=""){
		$(document).ready(function(){
			//Defino las variables
			//Función de Ajax
			$.ajax({
				url:"assets/php/clientes/cargar_contratos.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
				},
				success:function(respuesta){
					if(respuesta.valor=="ok"){
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
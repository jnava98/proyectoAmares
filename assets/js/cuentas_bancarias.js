

function cargar_tabla_cuentas_bancarias(){
	$(document).ready(function(){
		//Defino las variables
		//Función de Ajax
		$.ajax({
			url:"assets/php/cuentas_bancarias/mostrar_cuentas_bancarias.php",
			dataType:"json",//Formato en como se manda la información
			type:"post",
			data:{//Información a enviar o cadena a enviar
			},
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#div_tabla_cuentas_bancarias').html(respuesta.tabla);//En donde quiero mostrar la información
                    $('#'+respuesta.id_tabla).DataTable();
					console.log('exito');
				}//Fin del if  
			},
			error:function(respuesta,error){//Si surge un error
				console.log(respuesta);
				console.log(error);
			}
		});
	});
}//Fin cargar cuentas bancarias...

///MOSTRAR CUENTAS BANCARIAS///
document.getElementById("agregar_cuenta_bancaria").addEventListener('click',mostrar_formato_cuentas);

function mostrar_formato_cuentas(){
	$(document).ready(function(){
	$('#formato_cuentas_bancarias').show("slow");
});
}//fin de mostrar formato cuentas bancarias

//OCULTAR FORMATO CUENTAS//
document.getElementById("cancelar").addEventListener('click',ocultar_formato_cuentas);

function ocultar_formato_cuentas(){
		$(document).ready(function(){
		$('#formato_cuentas_bancarias').hide("slow");
	});
}//fin ocultar formato cuentas bancarias


//GUARDAR CUENTA BANCARIA

document.getElementById("guardar_cuenta").addEventListener('click',guardar_cuenta);
function guardar_cuenta(){
	const identificador_cuenta = document.getElementById("identificador_cuenta").value;
	const nombre_banco = document.getElementById("nombre_banco").value;
	const cuenta_divisa = document.getElementById("cuenta_divisa").value;
	console.log('antes de entrar')
	if(identificador_cuenta.length!==0 && nombre_banco.length!==0 && cuenta_divisa.length!==0){
		console.log('despues entrar')
		$(document).ready(function(){
			//Defino las variables
			//Función de Ajax
			$.ajax({
				url:"assets/php/cuentas_bancarias/guardar_cuenta_bancaria.php",
				dataType:"json",//Formato en como se manda la información
				type:"post",
				data:{//Información a enviar o cadena a enviar
					identificador_cuenta:identificador_cuenta, nombre_banco:nombre_banco,cuenta_divisa:cuenta_divisa
				},
				success:function(respuesta){
					
					$(document).ready(function(){
						
						swal({
							text:respuesta.mensaje,
							type:'success'
						});
						
						$('#formato_cuentas_bancarias').hide("slow");
						document.getElementById("identificador_cuenta").value='';
						document.getElementById("nombre_banco").value='';
						
					});
					
					
					cargar_tabla_cuentas_bancarias();
					
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}else{
		swal({
			text:"Debes llenar todos los campos",
			type:'warning'
		});
		return;	
	}



	

}



//ELIMINAR CUENTA BANCARIA

function eliminar_cuenta(id){

	swal({
		text: '¿Deseas eliminar esta cuenta bancaria?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#144653',
		cancelButtonColor: '#7F9174',
		confirmButtonText: 'Si',
		cancelButtonText: 'No'
	}).then(function(result){
		if(result.value){
			$(document).ready(function(){
				//Defino las variables
				//Función de Ajax
				$.ajax({
					url:"assets/php/cuentas_bancarias/eliminar_cuenta_bancaria.php",
					dataType:"json",//Formato en como se manda la información
					type:"get",
					data:{//Información a enviar o cadena a enviar
						id:id
					},
					success:function(respuesta){
						$(document).ready(function(){
							swal({
								text:respuesta.valor,
								type:'success'
							});
						});
						cargar_tabla_cuentas_bancarias();
					},
					error:function(respuesta){//Si surge un error
						console.log(respuesta);
					}
				});
			});
		}//fin del if
	});
}


// Editar cuentas bancarias

function editar_cuenta_bancaria(id){
	//Habilito el input de la variable a actualizar conforme al id....
	document.getElementById("input_identificador&"+id).disabled=false;
	document.getElementById("input_banco&"+id).disabled=false;
	document.getElementById("input_divisa&"+id).disabled=false;
}//Fin de editar_entregable_tabla...


function actualizar_cuenta_bancaria(id){
	const input_identificador= document.getElementById("input_identificador&"+id).disabled;
	const input_banco = document.getElementById("input_banco&"+id).disabled;
	const input_divisa = document.getElementById("input_divisa&"+id).disabled;
	if((input_identificador==false)&&(input_banco==false)&&input_divisa==false){
		$(document).ready(function(){
			
			//Defino las variables
			var identificador = document.getElementById("input_identificador&"+id).value;
			var banco = document.getElementById("input_banco&"+id).value;
			var divisa = document.getElementById("input_divisa&"+id).value;

			if((identificador!='')&&(banco!='')&&(divisa!='')){
				
				document.getElementById("input_identificador&"+id).disabled=true;
				document.getElementById("input_banco&"+id).disabled=true;
				document.getElementById("input_divisa&"+id).disabled=true;
			//Función de Ajax
			$.ajax({
				url:"assets/php/cuentas_bancarias/actualizar_cuenta_bancaria.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id:id, identificador:identificador, banco:banco,divisa:divisa
				},
				success:function(respuesta){
					if(respuesta.valor=="ok"){
						$(document).ready(function(){
							swal({
								text:respuesta.mensaje,
								type:'success'
							});
						});
						cargar_tabla_cuentas_bancarias();
					}//Fin del if
				},
					error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
	
		
		}else{
			swal({
				text:'No pueden existir campos vacios',
				type:'warning'
			});
		}
		});
	}//fin del if
}//Fin de guardar_variable_tabla...
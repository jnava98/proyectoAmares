

function cargar_tabla_descuentos(){
	$(document).ready(function(){
		//Defino las variables
		//Función de Ajax
		$.ajax({
			url:"assets/php/descuentos/mostrar_descuentos.php",
			dataType:"json",//Formato en como se manda la información
			type:"post",
			data:{//Información a enviar o cadena a enviar
			},
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#div_tabla_descuentos').html(respuesta.tabla);//En donde quiero mostrar la información
                    $('#'+respuesta.id_tabla).DataTable();
				}//Fin del if  
			},
			error:function(respuesta,error){//Si surge un error
				console.log(respuesta);
				console.log(error);
			}
		});
	});
}//Fin cargar descuentos...

///MOSTRAR DESCUENTOS///
document.getElementById("agregar_descuento").addEventListener('click',mostrar_formato_descuentos);

function mostrar_formato_descuentos(){
	$(document).ready(function(){
	$('#formato_descuentos').show("slow");
});
}//fin de mostrar formato descuentos

//OCULTAR DESCUENTOS//
document.getElementById("cancelar").addEventListener('click',ocultar_formato_descuentos);

function ocultar_formato_descuentos(){
		$(document).ready(function(){
		$('#formato_descuentos').hide("slow");
	});
}//fin ocultar formato descuentos


//GUARDAR DESCUENTO

document.getElementById("guardar_descuento").addEventListener('click',guardar_descuento);
function guardar_descuento(){
	const nombreDescuento = document.getElementById("nombre_descuento").value;
	const tasaDescuento = document.getElementById("tasa_descuento").value;
	if(nombreDescuento.length!==0 && tasaDescuento.length!==0){
		if(tasaDescuento>0&&tasaDescuento<=100){
		$(document).ready(function(){
			//Defino las variables
			//Función de Ajax
			$.ajax({
				url:"assets/php/descuentos/guardar_descuento.php",
				dataType:"json",//Formato en como se manda la información
				type:"post",
				data:{//Información a enviar o cadena a enviar
					nombreDescuento:nombreDescuento, tasaDescuento:tasaDescuento
				},
				success:function(respuesta){
					
					$(document).ready(function(){
						swal({
							text:respuesta.mensaje,
							type:'success'
						});
						$('#formato_descuentos').hide("slow");

					});
					cargar_tabla_descuentos();
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}else{
		swal({
			text:"Ingrese una tasa de descuento valida",
			type:'warning'
		});
		return;	
	}
	}else{
		swal({
			text:"Debes llenar todos los campos",
			type:'warning'
		});
		return;	
	}



	// console.log(`El descuento ${nombreDescuento} es de ${tasaDescuento}`)

}



//ELIMINAR DESCUENTO

function eliminar_descuento(id){

	swal({
		text: '¿Deseas eliminar este descuento?',
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
					url:"assets/php/descuentos/eliminar_descuento.php",
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
						cargar_tabla_descuentos();
					},
					error:function(respuesta){//Si surge un error
						console.log(respuesta);
					}
				});
			});
		}//fin del if
	});
}


// Editar descuento

function editar_descuento(id){
	//Habilito el input de la variable a actualizar conforme al id....
	document.getElementById("input_descripcion&"+id).disabled=false;
	document.getElementById("input_tasa&"+id).disabled=false;
}//Fin de editar_entregable_tabla...


function actualizar_descuento(id){
	if((document.getElementById("input_descripcion&"+id).disabled==false)&&(document.getElementById("input_tasa&"+id).disabled==false)){
		$(document).ready(function(){
			
			//Defino las variables
			var descripcion = document.getElementById("input_descripcion&"+id).value;
			var tasa = document.getElementById("input_tasa&"+id).value;
			if((descripcion!='')&&(tasa!='')){
				if(tasa>0&&tasa<=100){
				document.getElementById("input_descripcion&"+id).disabled=true;
				document.getElementById("input_tasa&"+id).disabled=true;
			//Función de Ajax
			$.ajax({
				url:"assets/php/descuentos/actualizar_descuento.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id:id, descripcion:descripcion, tasa:tasa
				},
				success:function(respuesta){
					if(respuesta.valor=="ok"){
						$(document).ready(function(){
							swal({
								text:respuesta.mensaje,
								type:'success'
							});
						});
						cargar_tabla_descuentos();
					}//Fin del if
				},
					error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		}else{
			swal({
				text:'La tasa debe ser mayor a 0 y menor que 100',
				type:'warning'
			});	
		}
		}else{
			swal({
				text:'No pueden existir campos vacios',
				type:'warning'
			});
		}
		});
	}//fin del if
}//Fin de guardar_variable_tabla...
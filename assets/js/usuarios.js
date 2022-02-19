function cargar_tabla_usuarios(){
	$(document).ready(function(){
		//Defino las variables
		//Función de Ajax
		$.ajax({
			url:"assets/php/usuarios/cargar_usuarios.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
			},
			success:function(respuesta){
				if(respuesta.valor=="ok"){
					$('#div_tabla_usuarios').html(respuesta.tabla);//En donde quiero mostrar la información
                    $('#'+respuesta.id_tabla).DataTable();
				}//Fin del if  
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	});
}//Fin cargar_apartados...

function cancelar_busqueda(){ //Funcion para recargar la pagina
	location.reload();
}//fin de funcion cancelar busqueda

function editar_usuario(id){
	//Habilito el input de la variable a actualizar conforme al id....
	document.getElementById("input_usuario&"+id).disabled=false;
	document.getElementById("input_password&"+id).disabled=false;
    document.getElementById("input_nombre&"+id).disabled=false;
}//Fin de editar_entregable_tabla...

function actualizar_usuario(id){
	if((document.getElementById("input_usuario&"+id).disabled==false)&&(document.getElementById("input_password&"+id).disabled==false)&&(document.getElementById("input_nombre&"+id).disabled==false)){
		$(document).ready(function(){
			document.getElementById("input_usuario&"+id).disabled=true;
			document.getElementById("input_password&"+id).disabled=true;
            document.getElementById("input_nombre&"+id).disabled=true;
			//Defino las variables
			var usuario = document.getElementById("input_usuario&"+id).value;
			var password = document.getElementById("input_correo&"+id).value;
            var nombre = document.getElementById("input_nombre&"+id).value;
			//Función de Ajax
			$.ajax({
				url:"assets/php/usuarios/actualizar_usuario.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					id:id, usuario:usuario, password:password, nombre:nombre
				},
				success:function(respuesta){
					if(respuesta.valor=="ok"){
						$(document).ready(function(){
							swal({
								text:respuesta.mensaje,
								type:'success'
							});
						});
						cargar_tabla_usuarios();
					}//Fin del if
				},
					error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}//fin del if
}//Fin de guardar_variable_tabla...

function eliminar_usuario(id){
	swal({
		text: '¿Deseas eliminar este usuario?',
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
					url:"assets/php/usuarios/eliminar_usuario.php",
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
						cargar_tabla_usuarios();
					},
					error:function(respuesta){//Si surge un error
						console.log(respuesta);
					}
				});
			});
		}//fin del if
	});
}//Fin de eliminar usuario

function mostrar_formato_usuarios(){
	$(document).ready(function(){
		$('#formato_usuario').show("slow");
	});
}//fin de mostrar formato usuarios

function cancelar_formato_usuarios(){
	$(document).ready(function(){
		$('#formato_usuario').hide("slow");
	});
}//fin de mostrar formato usuarios

function guardar_formato_usuario(){
	var aux = 0;
	if(document.getElementById("usuario").value.length==0){
		aux=1;
	}//fin del if
	if(document.getElementById("nombre_usuario").value.length==0){
		aux=1;
	}//fin del if
	if(document.getElementById("password").value.length==0){
		aux=1;
	}//fin del if
	if(aux==1){
		$(document).ready(function(){
			swal({
				text:"Debes llenar todos los campos",
				type:'warning'
			});
		});
	}else{
		$(document).ready(function(){
			//Defino las variables
			var usuario = document.getElementById("usuario").value;
			var nombre = document.getElementById("nombre_usuario").value;
			var password = document.getElementById("password").value;
			//Función de Ajax
			$.ajax({
				url:"assets/php/usuarios/guardar_usuario.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					usuario:usuario, nombre:nombre, password:password
				},
				success:function(respuesta){
					cargar_tabla_usuarios();
					$(document).ready(function(){
						swal({
							text:respuesta.valor,
							type:'success'
						});
						$('#formato_usuario').hide("slow");
					});
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
	}//fin del else
}//fin de funcion guardar usuario
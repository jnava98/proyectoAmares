function cancelar_busqueda(){ //Funcion para recargar la pagina
	location.reload();
}//fin de funcion cancelar busqueda

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
			$('#div_tabla_contratos').css('display','none');
		}//fin de success
	});
};//Fin busca cliente

function seleccionar_cliente(id){
	var cadena = id.split("&");
	id_cliente = cadena[0];	
	nombre = cadena[1];
	$('#input_cliente').val(nombre);
	$('#id_cliente').val(id_cliente);
	$('#div_cliente_lista').css('display','none');
};//Fin seleccionarPersona

function trae_contratos_cliente(){
	var id_cliente = $('#id_cliente').val();
	//Validamos que exista un usuario seleccionado.
	if(id_cliente==""||id_cliente==undefined){
		swal({
			text:'Debe seleccionar a un cliente.',
			type: 'error'
		});
	}else{
		$.ajax({
			type:'get',
			url:'assets/php/pagos/cargar_contratos.php',
			dataType: 'json',
			data:{
				id_cliente:id_cliente
			},
			success:function(response) {
				if((response.existe) == 1){
					//console.log(response.existe);
					//Si encontramos algun contrato
					$('#div_tabla_contratos').html(response.html);
					$('#div_tabla_contratos').css("display", "block");
				//console.log(response.html);
				}else{
					//Si no encontramos ningun contrato
					swal({
						text:'Este cliente no tiene contratos.',
						type: 'error'
					});
					console.log(response.existe);
				}
			},
			error:function(response){
				//Mensaje de error
			}
		})
	}
    
};
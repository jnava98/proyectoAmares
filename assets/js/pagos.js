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
		Swal.fire(
			'Ups!',
			'Debes seleccionar a un cliente!',
			'error'
		);
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
					//Si encontramos algun contrato
					$('#div_tabla_contratos').html(response.html);
					$('#tabla_contratos').DataTable({
						paging: false,
						searching: false,
					});
					//$('#div_tabla_contratos').css("display", "block");
					$('#div_tabla_contratos').hide('slow').show('slow');
					$('#div_historial_pagos').hide('slow');
					$('#div_card_contratos').hide('slow');
				}else{
					//Si no encontramos ningun contrato
					Swal.fire(
						'Este cliente no tiene contratos.',
						'',
						'error'
					);
					console.log(response.existe);
				}
			},
			error:function(response){
				//Mensaje de error
			}
		})
	}
    
};
function consulta_historial_pagos(id_contrato){
	//Comenzamos con las validaciones
	//div_historial_pagos
	//id_contrato

	//tra

	//CONSULTAMOS EL HISTORIAL DE PAGOS
	$.ajax({
		type:'get',
		url:'assets/php/pagos/formato_historia_pagos.php',
		dataType:'json',
		data:{
			id_contrato:id_contrato
		},
		success:function(response) {
			//Si encontramos algun historial de pagos
			$('#div_table_pagos').html(response.html);
			$(document).ready( function () {
				$('#table_pagos').DataTable({
					dom: 'Bfrtip',
        			buttons: ['csv', 'excel', 'pdf', 'print']
				});
			});
			//$('#div_historial_pagos').css("display", "block");
			$('#div_card_contratos').hide('fast');
			$('#div_form_pagos').hide('fast');
			$('#div_historial_pagos').show('fast');
			
			consulta_datos_contrato(id_contrato);
		},
		error:function(response){
			//Mensaje de error
		}
	})
	
};

function consulta_datos_contrato(id_contrato){
	$.ajax({
		type:'get',
		url:'assets/php/pagos/formato_datos_contratos.php',
		data:{
			id_contrato:id_contrato
		},
		success:function(response) {
			//Si encontramos algun historial de pagos
			$('#div_card_contratos').html(response);
			//$('#div_card_contratos').css("display", "block");
			$('#div_card_contratos').show('slow')
		},
		error:function(response){
			Swal.fire(
				'Error de conexión',
				'Error:'+response,
				'error'
							)
		}
	})
};


function pago_nuevo(id_contrato){
	//$('#div_form_pagos').css('display','block');
	//VAMOS A TRAER LA INFORMACION DEL CONTRATO PARA COLOCARLA EN EL FORMULARIO DE PAGO
	/*TRAEMOS: Concepto en el que esta el contrato
		Cantidad mensual estipulada
		Algun recargo del mes anterior		
	*/
	$.ajax({
		type:'get',
		url:'assets/php/pagos/formato_pagos.php',
		dataType:'json',
		data:{
			id_contrato:id_contrato
		},
		success:function(response) {
			$('#div_form_pagos').html(response.html);
			//Si encontramos algun historial de pagos
			$('#div_form_pagos').show('slow');
		},
		error:function(response){
			//Mensaje de error
		}
	})
	
};

function actualiza_datos_pago(){
	//Calculamos el total a pagar
	var recargo = parseFloat($('#inp_recargo').val());
	var interes = parseFloat($('#inp_interes').val());
	var mensualidad = parseFloat($('#inp_mensualidad').val());
	$('#inp_totpagar').val(recargo + interes + mensualidad);

	//Calculamos la diferencia
	var totpagar = parseFloat($('#inp_totpagar').val());
	var cpagada = parseFloat($('#inp_cpagada').val());

	$('#inp_diferencia').val(totpagar - cpagada);	
	

}
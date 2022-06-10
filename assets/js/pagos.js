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

function cantInicialxtipoCambio(){

	var cantInicial = $("#inpCantInicial").val();
	var tipoCambio = $("#inpTipoCambio").val();
	if(cantInicial==""||tipoCambio=="") {
		cantInicial = 0;
		tipoCambio = 0; 
	}
	var cant_convertida = (cantInicial*tipoCambio);
	
	$("#inpAbonadoCapital").val(cant_convertida);
	
};

function cantInicialxtipoCambio2(){
	var cantInicial = $("#cantInicial").val();
	var tipoCambio = $("#inp_tipocambio").val();
	if(cantInicial==""||tipoCambio=="") {
		cantInicial = 0;
		tipoCambio = 0; 
	}
	var cant_convertida = (cantInicial * tipoCambio);
	$("#inp_cpagada").val(cant_convertida).trigger("input");
	
}

function elimina_pago(id_pago,id_contrato){
	$.ajax({
		type:'post',
		url:'assets/php/pagos/elimina_pago.php',
		dataType: 'json',
		data:{
			'id_pago':id_pago,
			'id_contrato':id_contrato
		},
		success:function(response) {
			consulta_historial_pagos(response.id_contrato);
			console.log(response.sql);
			console.log(response.result);
		},
		error:function(response){
			//Mensaje de error
		}
	})

}

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
					$('#div_form_pagos').hide('slow');
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
function abono_capital(id_contrato){
	$.ajax({
		type:'get',
		url:'assets/php/pagos/formato_abonoCapital.php',
		dataType:'json',
		data:{
			id_contrato:id_contrato
		},
		success:function(response) {
			$('#div_form_pagos').hide('slow');
			$('#div_form_pagos').html(response.html);
			$('#div_form_pagos').show('slow');
			consulta_historial_pagos(response.id_contrato);
		},
		error:function(response){
			//Mensaje de error
		}
	})
}
function cambiaConcepto(id_contrato, id_concepto){
	if(id_concepto == 0) return false;
	$.ajax({
		type:'POST',
		url:'assets/php/pagos/cambiaConcepto.php',
		dataType:'json',
		data:{
			id_contrato:id_contrato,
			id_concepto:id_concepto
		},
		success:function(response) {
			console.log(response)
			$("#inp_mensualidad").val(response.cantidadxPagar);
			if(response.cantidadxPagar==0){
				Swal.fire(response.mensaje, response.mensaje2);
				$("#input_concepto").val(0);
			} 
			$("#inp_mensualidad").trigger("input");	
			
		},
		error:function(response){
			//Mensaje de error
		}
	})

}

function guardaAbono(id_contrato){
	//Obtenemos datos
	var abonadoCapital = $("#inpAbonadoCapital").val();
	var divisa = $("#inpDivisa").val();
	var tipoCambio = $("#inpTipoCambio").val();
	var opcionAbono = $("#opcionAbono").val();
	var cuentaBancaria = $("#cuentaBancaria").val();
	var fechaPago = $("#fechaPago").val();
	var cantInicial = $("#inpCantInicial").val();

	//Validamos campos obligatorios
	if (abonadoCapital== ""||abonadoCapital== 0) {
		Swal.fire('Campos incompletos!','Es necesario capturar el abono a capital','warning');	
		return false;
	}
	if (divisa== "") {
		Swal.fire('Campos incompletos!','Es necesario capturar la divisa','warning');	
		return false;
	}
	if (tipoCambio== ""||tipoCambio==0) {
		Swal.fire('Campos incompletos!','Es necesario capturar el tipo de cambio','warning');	
		return false;
	}
	if (fechaPago== ""||fechaPago==0) {
		Swal.fire('Campos incompletos!','Es necesario capturar una fecha de pago','warning');	
		return false;
	}
	if (cantInicial== ""||cantInicial==0) {
		Swal.fire('Campos incompletos!','Es necesario capturar una cantidad inicial','warning');	
		return false;
	}
	//Mandamos datos
	$.ajax({
		type:'post',
		url:'assets/php/pagos/guardaAbonoCapital.php',
		dataType:'json',
		data:{
			'id_contrato':id_contrato,'opcionAbono':opcionAbono, 'abonadoCapital':abonadoCapital,'divisa':divisa,'tipoCambio':tipoCambio,'cuentaBancaria':cuentaBancaria,'fechaPago':fechaPago,'cantInicial':cantInicial
		},
		success:function(response) {
			//Si encontramos algun historial de pagos
			console.log(response+"success");
			// $('#div_form_pagos').html(response.html);
			//Si encontramos algun historial de pagos
			// $('#div_form_pagos').show('slow');
		},
		error:function(response){
			console.log(response.error);
		}
	})


}

function coloca_moneda(elemento){
	//Obtiene el dataset del option seleccionado
	var moneda = $(elemento).find(':selected').data('moneda');
	$("#inp_divisa").val(moneda);
}

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
					order: [[3, 'desc']],
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

function recibo_pago(id_pago){
	document.getElementById("input_id_pago").value = id_pago;
	var obj = document.getElementById("enviar_formulario_recibo_pago");
	obj.click();
}//fin de funcion imprimir contrato

function consulta_datos_contrato(id_contrato){
	$.ajax({
		type:'POST',
		url:'assets/php/pagos/formato_datos_contratos.php',
		data:{
			id_contrato:id_contrato
		},
		success:function(response) {
			//console.log(response);
			//Si encontramos algun historial de pagos
			$('#div_card_contratos').html(response);
			//$('#div_card_contratos').css("display", "block");
			$('#div_card_contratos').show('slow')
		},
		error:function(response){
			Swal.fire(
				'Error de conexión',
				'Error:'+response,
				'error')
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
			if(response.mensaje != null) Swal.fire(response.mensaje,response.mensaje,'warning');
			console.log(response)
			$('#div_form_pagos').hide('slow');
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
	if($('#inp_recargo').val()==""){
		$('#inp_recargo').val(0);
	}
	var recargo = parseFloat($('#inp_recargo').val());

	if($('#inp_interes').val()==""){
		$('#inp_interes').val(0);
	} 
	var interes = parseFloat($('#inp_interes').val());

	if($('#inp_mensualidad').val()==""){
		$('#inp_mensualidad').val(0);
	} 

	var mensualidad = parseFloat($('#inp_mensualidad').val());

	/*if($('#inp_cpagada').val()==""){
		$('#inp_cpagada').val(0);
	} */
	var cpagada = parseFloat($('#inp_cpagada').val());

	//Calculamos el total a pagar
	$('#inp_totpagar').val(recargo + interes + mensualidad);

	//Calculamos la diferencia
	var totpagar = parseFloat($('#inp_totpagar').val());
	
	$('#inp_diferencia').val(totpagar - cpagada);	
}

function cambia_concepto(id_concepto){
	
}

function guarda_pago(id_contrato,cambia_estatus){
	//Validamos que los inputs tengan valores
	if($('#inp_fpago').val()==""){ Swal.fire('Campos incompletos','Falta la: <b>Fecha de pago</b>','error'); return false }
	if($('#inp_cpagada').val()=="") {Swal.fire('Campos incompletos','Falta la: <b>Cantidad pagada</b>','error'); return false}
	if($('#inp_totpagar').val()=="") {Swal.fire('Campos incompletos','Falta el: <b>Fotal a pagar</b>','error'); return false}
	if($('#inp_cuenta').val()==0) {Swal.fire('Campos incompletos','Falta la: <b>Cuenta bancaria</b>','error'); return false}
	
	//Recibimos los datos

	var input_concepto = $('#input_concepto').val()
	var input_concepto = $('#input_concepto').val()
	var inp_cuenta = $('#inp_cuenta').val()
	var inp_cpagada = $('#inp_cpagada').val()
	var inp_formpago = $('#inp_formpago').val()
	var inp_recargo = $('#inp_recargo').val()
	var inp_interes = $('#inp_interes').val()
	var inp_mensualidad = $('#inp_mensualidad').val()
	var inp_diferencia = $('#inp_diferencia').val()
	var inp_totpagar = $('#inp_totpagar').val()
	var inp_comentario = $('#inp_comentario').val()
	var input_concepto = $('#input_concepto').val()
	var inp_fpago = $('#inp_fpago').val()
	var inp_divisa = $('#inp_divisa').val()
	var inp_tipocambio = $('#inp_tipocambio').val()
	var inp_tipocambio = $('#inp_tipocambio').val()
	var cant_inicial = $("#cantInicial").val()

	$.ajax({
		type:'get',
		url:'assets/php/pagos/guardado_pagos.php',
		data:{
			id_contrato:id_contrato,
			input_concepto:input_concepto,
			inp_cuenta:inp_cuenta,
			inp_cpagada:inp_cpagada,
			inp_formpago:inp_formpago,
			inp_recargo:inp_recargo,
			inp_interes:inp_interes,
			inp_mensualidad:inp_mensualidad,
			inp_diferencia:inp_diferencia,
			inp_totpagar:inp_totpagar,
			inp_comentario:inp_comentario,
			inp_fpago:inp_fpago,
			inp_tipocambio:inp_tipocambio,
			inp_divisa:inp_divisa,
			cant_inicial:cant_inicial,
			cambia_estatus:cambia_estatus
		},
		dataType:'json',
		success:function(response) {
			console.log(response);
			console.log(response.result);
			consulta_historial_pagos(response.id_contrato)
		},
		error:function(response){
			alert(response);
			//Mensaje de error
		}
	})



	
	//Formula para calcular la cantidad abonada a capital y abonado a interes
	/*	Abonado a interes:	Balance inicial(Tasa de interés/Cantidad de Mensualidades anuales)
		Abonado a capital: Cantidad_Mensual-Abonado a interés
	TODO: Guardado de datos.
	Datos a ingresar en la base de datos

	id_contrato
	fecha_pago✅
	no_mensualidad✅
	monto_pagado✅
	abonado_capital (obtenido por formula)
	abonado_interes	(obtenido por formula)
	diferencia✅
	id_estatus_pago	(obtenido por formula)
	comentario✅
	id_concepto✅
	mensualidad_historica ✅
	fecha_mensualidad
	fecha_captura(auto)
	balance_inicial (obtenido por formula)
	balance_final (obtenido por formula)
	habilitado


	*/
	
}
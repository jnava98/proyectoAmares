function guardar_cliente(){
	//alert("Entra");
	$(document).ready(function(){
		var nombre = $('#nombre_cliente').val();
		var apellido_pa = $('#apellidopa_cliente').val();
		var apellido_ma = $('#apellidoma_cliente').val();
		var residencia = $('#residencia_cliente').val();
		var nacionalidad = $('#nacionalidad_cliente').val();
		var correo = $('#correo_cliente').val();
		var telefono = $('#telefono_cliente').val();
		var estado_civil = $('#estadoc_cliente').val();
		var actividad_economica = $('#act_cliente').val();
		var cruzamientos_postulante = $('#cruzamientos_postulante').val();
		var numero_postulante = $('#numero_postulante').val();
		var codigopo_postulante = $('#codigopo_postulante').val();
		var select_estadosdg = $('#select_estadosdg').val();
		var select_municipiodg = $('#select_municipiodg').val();
		var select_localidaddg = $('#select_localidaddg').val();
		var telefono_postulante = $('#telefono_postulante').val();
		var celular_postulante = $('#celular_postulante').val();
		var correo_postulante = $('#correo_postulante').val();
		var nivelestudios = $('#nivelestudios').val();
        var otro_nivel = $('#input_otro_nivel').val();
		var porcentaje = $('#porcentaje').val();
        if(porcentaje=="0%"){
            var boton_maya = "No";
        }else{
            boton_maya = "Si";
        }//fin del else
		var select_estadosdm = $('#select_estadosdm').val();
		var select_municipiodm = $('#select_municipiodm').val();
		var select_localidaddm = $('#select_localidaddm').val();
		var select_periodo = $('#select_periodo_actual').val();
		var select_ciclos = $('#select_ciclos').val();
		var ciclo1 = $('#input_ciclo1').val();
		var ciclo2 = $('#input_ciclo2').val();
		var alcalde = $('#input_alcalde').val();
		//Función de Ajax
		$.ajax({
			url:"php/guardar_postulantes.php",
			dataType:"json",//Formato en como se manda la información
			type:"get",
			data:{//Información a enviar o cadena a enviar
				curp:curp, nombre_postulante:nombre_postulante, apellidopa_postulante:apellidopa_postulante, apellidoma_postulante:apellidoma_postulante, sexo_postulante:sexo_postulante,
				edad_postulante:edad_postulante, calle_postulante:calle_postulante, cruzamientos_postulante:cruzamientos_postulante, numero_postulante:numero_postulante,
				codigopo_postulante:codigopo_postulante, select_estadosdg:select_estadosdg, select_municipiodg:select_municipiodg,
				select_localidaddg:select_localidaddg, telefono_postulante:telefono_postulante, celular_postulante:celular_postulante,
				correo_postulante:correo_postulante, nivelestudios:nivelestudios, otro_nivel:otro_nivel, porcentaje:porcentaje, boton_maya:boton_maya,
				select_estadosdm:select_estadosdm, select_municipiodm:select_municipiodm, select_localidaddm:select_localidaddm,
				select_periodo:select_periodo, select_ciclos:select_ciclos, ciclo1:ciclo1, ciclo2:ciclo2, alcalde:alcalde
			},
			success:function(respuesta){
				$(document).ready(function(){
					$('#modal_postulante').modal('toggle');
					$('#encabezado_postulante').text("Registro Postulante");
					$('#body_postulante').html(respuesta.valor);
					$('#input_postulante').val(respuesta.postulante);
				});	
			},
			error:function(respuesta){//Si surge un error
				console.log(respuesta);
			}
		});
	});
}//fin de guardar postulantes pre
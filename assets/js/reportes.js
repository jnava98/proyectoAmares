function cargar_tabla_reporte(){
    if(document.getElementById("select_tipo_reporte").value!="0"){
        if((document.getElementById("select_tipo_reporte").value=="ingresos")||(document.getElementById("select_tipo_reporte").value=="ingresos_unidades")||(document.getElementById("select_tipo_reporte").value=="reservas_mensuales")||(document.getElementById("select_tipo_reporte").value=="ingresos_ambos")){
            fecha_uno = document.getElementById("fecha_uno").value;
            fecha_dos = document.getElementById("fecha_dos").value;
            tipo_reporte = document.getElementById("select_tipo_reporte").value;
        }else{
            fecha_uno = "";
            fecha_dos = "";
            tipo_reporte = document.getElementById("select_tipo_reporte").value;
        }//fin del else
        $(document).ready(function(){
			//Defino las variables
			//Función de Ajax
			$.ajax({
				url:"assets/php/reportes/cargar_reportes.php",
				dataType:"json",//Formato en como se manda la información
				type:"get",
				data:{//Información a enviar o cadena a enviar
					fecha_uno:fecha_uno, fecha_dos:fecha_dos, tipo_reporte:tipo_reporte
				},
				success:function(respuesta){
					if(respuesta.valor=="ok"){
						$('#div_reportes').show('slow');
						$('#div_tabla_reportes').html(respuesta.tabla);//En donde quiero mostrar la información
						$('#'+respuesta.id_tabla).DataTable({
                            dom: 'Bfrtip',
        			        buttons: ['excel', 'pdf', 'print']
                        });
					}else{
                        $(document).ready(function(){
                            swal.fire({
                                text:respuesta.valor,
                                icon: 'error'
                            });
                        });
                    }//fin del else
				},
				error:function(respuesta){//Si surge un error
					console.log(respuesta);
				}
			});
		});
    }else{
        $(document).ready(function(){
            swal({
                text:'Error',
                type: 'error'
            });
        });
    }//fin del else
}//fin de cargar tipo reporte

function mostrar_input_fecha(){
    $(document).ready(function(){
        if(($("#select_tipo_reporte").val()=="ingresos")||($("#select_tipo_reporte").val()=="ingresos_unidades")||($("#select_tipo_reporte").val()=="reservas_mensuales")||($("#select_tipo_reporte").val()=="ingresos_ambos")){
            $("#inputs_fechas").show('slow');
        }else{
            $("#inputs_fechas").hide();
        }//fin del else
    });
}//fin de mostrar input fecha
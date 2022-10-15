/*function cargar_tabla_reporte(){
    if(document.getElementById("select_tipo_reporte").value!="0"){
        if((document.getElementById("select_tipo_reporte").value=="ingresos")||(document.getElementById("select_tipo_reporte").value=="ingresos_unidades")||(document.getElementById("select_tipo_reporte").value=="reservas_mensuales")||(document.getElementById("select_tipo_reporte").value=="ingresos_ambos")||(document.getElementById("select_tipo_reporte").value=="reservas_pendientes")||(document.getElementById("select_tipo_reporte").value=="contratos_elaborados")||(document.getElementById("select_tipo_reporte").value=="promesas_contratos")){
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
						$('#'+respuesta.id_tabla).DataTable();
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
*/

function validar_formato_reportes(){
    var reporte = document.getElementById("select_tipo_reporte").value;
    if(reporte=="0"){
        swal({
            text:'Debes seleccionar un tipo de reporte',
            type: 'warning'
        });
    }else{
        if((reporte=="clientes")||(reporte=="lotes")){
            var objO = document.getElementById("boton_formulario");
	        objO.click();
        }else{
            var fecha_uno = document.getElementById("fecha_uno").value;
            var fecha_dos = document.getElementById("fecha_dos").value;
            if((fecha_uno=="")||(fecha_dos=="")){
                swal({
                    text:'Debes definir ambas fechas',
                    type: 'warning'
                });
            }else{
                var objO = document.getElementById("boton_formulario");
	            objO.click();
            }//fin del else
        }//fin del else
    }//fin del else
}//fin de funcion validar formato reportes

function actualizar_fechas_entrega(){
    $.ajax({
        url:"assets/php/reportes/actualizar_fechas_entrega.php",
        dataType:"json",//Formato en como se manda la información
        type:"get",
        data:{//Información a enviar o cadena a enviar
            
        },
        success:function(respuesta){
            /*if(respuesta.valor=="ok"){
                $('#div_reportes').show('slow');
                $('#div_tabla_reportes').html(respuesta.tabla);//En donde quiero mostrar la información
                $('#'+respuesta.id_tabla).DataTable();
            }else{
                $(document).ready(function(){
                    swal.fire({
                        text:respuesta.valor,
                        icon: 'error'
                    });
                });
            }//fin del else
            */
            console.log(respuesta);
        },
        error:function(respuesta){//Si surge un error
            console.log(respuesta);
        }
    });
}//fin de funcion

function mostrar_input_fecha(){
    $(document).ready(function(){
        var reporte = $("#select_tipo_reporte").val();
        if((reporte=="ingresos")||(reporte=="ingresos_unidades")||(reporte=="reservas_mensuales")||(reporte=="ingresos_ambos")||(reporte=="reservas_pendientes")||(reporte=="contratos_elaborados")||(reporte=="promesas_contratos")){
            $("#inputs_fechas").show('slow');
        }else{
            $("#inputs_fechas").hide('slow');
        }//fin del else
    });
}//fin de mostrar input fecha